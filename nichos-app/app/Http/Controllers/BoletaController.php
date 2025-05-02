<?php

namespace App\Http\Controllers;

use App\enums\EstadoNotificacion;
use App\enums\TipoBoleta;
use App\enums\TipoContrato;
use App\enums\TipoRol;
use App\enums\Utiles;
use App\Models\Boleta;
use App\Models\Contrato;
use App\Models\Encargado;
use App\Models\Notificacion;
use App\Models\Usuario;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BoletaController extends Controller
{
    public function solicitarBoleta($idContrato)
    {
        try {
            DB::beginTransaction();
            $contrato = Contrato::find($idContrato);
            $buscando = self::getBoletaSolicitado($contrato->id_ocupante);
            if ($buscando) {
                return back()->with('msg-error', "Ya existe una solicitud para este Contrato.");
            }
            $boleta = new Boleta();
            $boleta->estado = TipoBoleta::SOLICITADO;
            $boleta->fecha_solicitado = now();
            $boleta->costo = Boleta::COSTO;
            $boleta->archivo = Utiles::DEFAULT_VALUE_ARCHIVO;
            $boleta->save();

            $newContrato = new Contrato();
            if ($contrato->estado == TipoContrato::EN_AÑO_DE_GRACIA) {
                $newContrato->estado = TipoContrato::SOLICITADO;
            } else {
                $newContrato->estado = TipoContrato::RENOVACION;
            }
            $newContrato->id_boleta = $boleta->correlativo;
            $newContrato->id_anterior = $contrato->id_anterior;
            $newContrato->id_encargado = $contrato->id_encargado;
            $newContrato->id_ocupante = $contrato->id_ocupante;
            $newContrato->id_nicho = $contrato->id_nicho;
            $newContrato->fecha_inicio = now();
            $fechaFinal = Carbon::parse($contrato->fecha_finalizacion);
            $newContrato->fecha_finalizacion = $fechaFinal->copy()->addYears(6);
            $newContrato->fecha_limite = $fechaFinal->copy()->addYears(7);
            $newContrato->save();

            DB::commit();
            return back()->with('msg-success', "Se ha enviado la solicitud de boleta.");
        } catch (\Exception $e) {
            return back()->with('msg-error',
                "Ha ocurrido un error al enviar la solicitud, lo sentimos intente de nuevo más tarde. `{$e->getMessage()}` ");
        }
    }

    /**
     * @param $id
     * @param $estado
     * @return \Illuminate\Http\RedirectResponse actualizar boleta
     */
    public function updatePaymentOrder($id, $estado)
    {
        try {
            DB::beginTransaction();
            //registro de notificaicon
            $notificacion = new Notificacion();
            //
            $boleta = Boleta::find($id);
            $boleta->estado = $estado;
            $contrato = Contrato::where('id_boleta', $boleta->correlativo)->first();
            if ($estado == TipoBoleta::APROBADO) {
                $boleta->fecha_aprobacion = now();
                $boleta->archivo = Utiles::DEFAULT_VALUE_ARCHIVO;

                $notificacion->descripcion = "Se ha aprobado la solicitud de boleta, para renovar el uso del nicho: NI-{$contrato->id_nicho}";

            } elseif ($estado == TipoBoleta::RECHAZADO) {
                $notificacion->descripcion = "Se ha rechazado la solicitud de boleta, para renovar el uso del nicho: NI-{$contrato->id_nicho}";
                $contrato->estado = TipoContrato::CANCELADO;
                $contrato->save();
            } elseif ($estado == TipoBoleta::PAGADO) {
                $contrato->estado = TipoContrato::ACTIVO;
                $contrato->save();

                $contratoAnterior = Contrato::find($contrato->id_anterior);
                $contratoAnterior->estado = TipoContrato::CADUCADO;
                $contratoAnterior->save();

                $notificacion->descripcion = "Se ha renovado el contrato {$contratoAnterior->id_contrato}, para usar el nicho: NI-{$contrato->id_nicho}";
            } elseif ($estado == TipoBoleta::NO_PAGADO){
                $notificacion->descripcion = "Su boleta no se registró como pagada, revise su comprobante de pago. BO-{$boleta->correlativo}";
            }
            $boleta->id_usuario = session('usuario')->id_usuario;
            $boleta->save();
            $user = self::userNotificacion($contrato->id_encargado)[0];
            $notificacion->id_usuario = $user->id_usuario;
            $notificacion->estado = EstadoNotificacion::NO_LEIDO;
            $notificacion->fecha = now();
            $notificacion->save();
            DB::commit();
            return back()->with('msg-success', "Se ha actualizado la solicitud.");
        } catch (\Exception $e) {
            return back()->with('msg-error', "No se puedo actualizar la boelta, lo sentimos. {$e->getMessage()}");
        }
    }

    public function verDetalleBoleta($correlativo)
    {
        return view("admin.vista-boleta")->with('boleta', self::getBoletaByCorrelativo($correlativo));
    }

    public function solicitudesBoletas()
    {
        $estado = request('estado');
        if(session('usuario')->rol_id == TipoRol::AYUDANTE){
            return view('admin.solicitudes-boletas')
                ->with('boletas', self::getBoletasPorEstado2($estado))
                ->with('title', self::getTitleBoleta($estado));
        }
        return view('admin.solicitudes-boletas')
            ->with('boletas', self::getBoletasPorEstado($estado))
            ->with('title', self::getTitleBoleta($estado));
    }

    public function boletasPendientesDePago()
    {
        return view('admin.solicitudes-boletas')
            ->with('boletas', self::getBoletasPendientesDePago())
            ->with('title', 'pendientes de pago');
    }

    public static function getTitleBoleta($estado)
    {
        return match ($estado) {
            TipoBoleta::APROBADO => "aprobadas",
            TipoBoleta::RECHAZADO => "rechazadas",
            TipoBoleta::PAGADO => "pagadas",
            TipoBoleta::NO_PAGADO => "no pagadas",
            TipoBoleta::SOLICITADO => "solicitadas",
            default => "",
        };
    }

    public function boletasPorEncargado()
    {
        $idUsuario = session('usuario')->id_usuario;
        $encargado = Encargado::where('id_usuario', $idUsuario)->first();
        $estado = request('estado');
        return view('admin.solicitudes-boletas')
            ->with('boletas', self::boletasPorEncargadoPorEstado($encargado->id_encargado, $estado))
            ->with('title', self::getTitleBoleta($estado));
    }

    public function descargarBoleta($id)
    {
        $boleta = self::getBoletaByCorrelativo($id);
        $pdf = PDF::loadView('admin.pdf-boleta', compact('boleta'));
        return $pdf->download('boleta_renovacion.pdf');
    }

    public function subirComprobante($correlativo)
    {
        return view('encargado.form-comprobante')->with('correlativo', $correlativo);
    }

    public function archivoBoleta()
    {
        try {
            $correlativo = request('correlativo');
            $comprobante = request()->file('comprobante');
            $nombreArchivo = $correlativo . "-" . $comprobante->getClientOriginalName();

            $boleta = Boleta::find($correlativo);
            $ruta = $comprobante->move('comprobantes', $nombreArchivo);

            $boleta->archivo = $ruta;
            $boleta->save();
            return back()->with('msg-success', "Se ha subido el archivo correctamente.");
        } catch (\Exception $e) {
            return back()->with('msg-error', "No se pudo guardar el archivo");
        }

    }

    public static function getBoletasPorEstado($estado)
    {
        return DB::select("
            select b.correlativo, id_usuario, costo, archivo, b.estado as estado_boleta, fecha_aprobacion, fecha_solicitado,
                   c.id_contrato, id_boleta, id_encargado, id_ocupante, id_nicho, c.estado as estado_contrato, fecha_inicio, fecha_finalizacion, fecha_limite
            from boleta b
            inner join contrato c on b.correlativo = c.id_boleta
            where b.estado = ?;
        ", [$estado]);
    }

    public static function getBoletasPorEstado2($estado)
    {
        return DB::select("
            select b.correlativo, id_usuario, costo, archivo, b.estado as estado_boleta, fecha_aprobacion, fecha_solicitado,
                   c.id_contrato, id_boleta, id_encargado, id_ocupante, id_nicho, c.estado as estado_contrato, fecha_inicio, fecha_finalizacion, fecha_limite
            from boleta b
            inner join contrato c on b.correlativo = c.id_boleta
            where b.estado = ? and c.estado != ?;
        ", [$estado, TipoContrato::SOLICITADO]);
    }


    public static function getBoletasPendientesDepago()
    {
        return DB::select("
            select b.correlativo, id_usuario, costo, archivo, b.estado as estado_boleta, fecha_aprobacion, fecha_solicitado,
                   c.id_contrato, id_boleta, id_encargado, id_ocupante, id_nicho, c.estado as estado_contrato, fecha_inicio, fecha_finalizacion, fecha_limite
            from boleta b
            inner join contrato c on b.correlativo = c.id_boleta
            where b.estado = ? and b.archivo = ?;
        ", [TipoBoleta::APROBADO, Utiles::DEFAULT_VALUE_ARCHIVO]);
    }

    public static function getBoletaByCorrelativo($correlativo)
    {
        return DB::select("
            select b.correlativo, costo, archivo, b.estado as estado_boleta, fecha_aprobacion, fecha_solicitado,
                   c.id_contrato, c.estado as estado_contrato, fecha_inicio, fecha_finalizacion, fecha_limite,
                   concat(nombre1,' ', nombre2, ' ', apellido1,' ', apellido2) as nombre, dpi
            from boleta b
            inner join contrato c on b.correlativo = c.id_boleta
            inner join encargado e on c.id_encargado = e.id_encargado
            inner join persona p on e.id_persona = p.id_persona
            where b.correlativo = ?;
        ", [$correlativo])[0];
    }

    public static function boletasPorEncargadoPorEstado($encargado, $estado)
    {
        return DB::select("
            select b.correlativo, id_usuario, costo, archivo, b.estado as estado_boleta, fecha_aprobacion, fecha_solicitado,
                   c.id_contrato, id_boleta, id_encargado, id_ocupante, id_nicho, c.estado as estado_contrato, fecha_inicio, fecha_finalizacion, fecha_limite
            from boleta b
            inner join contrato c on b.correlativo = c.id_boleta
            where b.estado = ?
            and id_encargado = ?;
        ", [$estado, $encargado]);
    }

    public static function getBoletaSolicitado($id_ocupante)
    {
        $contrato = DB::select("
            select b.correlativo, id_usuario, costo, archivo, b.estado, fecha_aprobacion, fecha_solicitado
            from boleta b
            inner join contrato c on b.correlativo = c.id_boleta
            where id_ocupante = ?
            and b.estado = 'SOLICITADO';
        ", [$id_ocupante]);
        return $contrato ? $contrato[0] : null;
    }

    public static function userNotificacion($idEncargado)
    {
        return DB::select("
            select u.id_usuario
            from usuario u
            inner join encargado e on u.id_usuario = e.id_usuario where id_encargado = ?;
        ",[$idEncargado]);
    }

    public static function dineroRecaudadoPorFecha($fecha1, $fecha2, $estado)
    {
        return DB::select("
            select sum(costo) from boleta
            where estado = ?
            and fecha_aprobacion between ? and ?;
        ", [$fecha1, $fecha2]);
    }
}
