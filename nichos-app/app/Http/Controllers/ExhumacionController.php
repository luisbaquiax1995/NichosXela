<?php

namespace App\Http\Controllers;

use App\enums\EstadoExhumacion;
use App\enums\EstadoNicho;
use App\enums\EstadoNotificacion;
use App\enums\TipoContrato;
use App\enums\TipoRol;
use App\Models\Contrato;
use App\Models\Exhumacion;
use App\Models\Nicho;
use App\Models\Notificacion;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExhumacionController extends Controller
{
    //
    public function solictarExhumacion()
    {
        try {
            /** @var Usuario $user */
            $user = session('usuario');
            if ($user == null) {
                return redirect('/');
            }
            if ($user->rol_id != TipoRol::ENCARGADO) {
                return redirect('/')->with('msg-error', 'Acceso no autorizado');
            }
            DB::beginTransaction();
            $motivo = request('motivo');
            $otro = request('otro');
            $auxi = ($otro) ? $motivo . ', ' . $otro : $motivo;
            $nicho = request('nicho');
            $contrato = Contrato::where('id_nicho', $nicho)
                ->where('estado', TipoContrato::ACTIVO)
                ->first();
            $encargado = EncargadoController::getEncargadoByIdUsuario($user->id_usuario);
            $nicho_buscado = Exhumacion::where('id_encargado', $encargado->id_encargado)
                ->where('id_nicho', $nicho)
                ->where('estado', EstadoExhumacion::SOLICITADO)
                ->first();
            if ($nicho_buscado) {
                return back()->with('msg-error', 'Ya existe una solicitud de exhumación para este nicho');
            }
            $nichoStauts = Nicho::find($nicho);
            if ($nichoStauts->status == EstadoNicho::STATUS_ESPECIAL) {
                return back()->with('msg-error', 'No se puede exhumar este nicho. El nicho es especial.');
            }
            Exhumacion::create([
                'id_encargado' => $encargado->id_encargado,
                'id_nicho' => $nicho,
                'motivo' => $auxi,
                'estado' => EstadoExhumacion::SOLICITADO,
                'fecha_solicitado' => now()
            ]);
            Notificacion::create([
                'id_usuario' => $user->id_usuario,
                'descripcion' => "Has enviado una solicitud de exhumación para el nicho NI-{$nicho}",
                'fecha' => now(),
                'estado' => EstadoNotificacion::NO_LEIDO
            ]);
            DB::commit();
            return back()->with('msg-success', "Se ha enviado la solicitud exitosamente.");
        } catch (\Exception $exception) {
            return back()->with('msg-error', "No se pudo enviar la solicitud, por favor intente nuevamente {$exception->getMessage()}");
        }
    }

    public function solicitudesEncaragdo()
    {
        try {
            /** @var Usuario $user */
            $user = session('usuario');
            if ($user == null) {
                return redirect('/');
            }
            if ($user->rol_id != TipoRol::ENCARGADO) {
                return redirect('/')->with('msg-error', 'Acceso no autorizado');
            }
            $estado = request('estado');
            $encargaddo = EncargadoController::getEncargadoByIdUsuario($user->id_usuario);
            $solicitudes = Exhumacion::where('id_encargado', $encargaddo->id_encargado)
                ->where('estado', $estado)
                ->get();
            return view('admin.exhumaciones')->with('solicitudes', $solicitudes);
        } catch (\Exception $exception) {
            return back()->with('msg-error', "No se pudo realizar la consulta.");
        }
    }

    public function solicitudesAdmin()
    {
        try {
            /** @var Usuario $user */
            $user = session('usuario');
            if ($user == null) {
                return redirect('/');
            }
            if ($user->rol_id != TipoRol::ADMINISTRADOR) {
                return redirect('/')->with('msg-error', 'Acceso no autorizado');
            }
            $estado = request('estado');
            $solicitudes = Exhumacion::where('estado', $estado)->get();
            return view('admin.exhumaciones')->with('solicitudes', $solicitudes);
        } catch (\Exception $exception) {
            return back()->with('msg-error', "No se pudo realizar la consulta.");
        }
    }

    public function actualizarExhumacion($id, $estado)
    {
        try {
            echo $estado;
            /** @var Usuario $user */
            $user = session('usuario');
            if ($user == null) {
                return redirect('/');
            }
            if ($user->rol_id != TipoRol::ADMINISTRADOR) {
                return redirect('/')->with('msg-error', 'Acceso no autorizado');
            }
            DB::beginTransaction();
            $solicitud = Exhumacion::find($id);
            /** @var Usuario $usuario */
            $usuario = EncargadoController::getUsuarioByIdEncargado($solicitud->id_encargado);
            switch ($estado) {
                case EstadoExhumacion::APROBADO:
                    $solicitud->estado = EstadoExhumacion::APROBADO;
                    $solicitud->fecha_inicio = now();
                    $solicitud->fecha_aprobacion = now();
                    $nicho = Nicho::find($solicitud->id_nicho);
                    $nicho->estado = EstadoNicho::EN_EXHUMACION;
                    $nicho->save();
                    Notificacion::create([
                        'id_usuario' => $usuario->id_usuario,
                        'descripcion' => "Se ha aprobado su solicitud de exhumacion para el nicho NI-{$solicitud->id_nicho}, se le notificará cuando esté disponible el nicho.",
                        'fecha' => now(),
                        'estado' => EstadoNotificacion::NO_LEIDO,
                    ]);
                    break;
                case EstadoExhumacion::RECHAZADO:
                    $solicitud->estado = EstadoExhumacion::RECHAZADO;
                    Notificacion::create([
                        'id_usuario' => $usuario->id_usuario,
                        'descripcion' => "Se ha rechzado su solicitud de exhumacion para el nicho NI-{$solicitud->id_nicho}",
                        'fecha' => now(),
                        'estado' => EstadoNotificacion::NO_LEIDO,
                    ]);
                    break;
                case EstadoExhumacion::FINALIZADO:
                    $solicitud->estado = EstadoExhumacion::FINALIZADO;
                    $solicitud->fecha_finalizacion = now();
                    $nicho = Nicho::find($solicitud->id_nicho);
                    $nicho->estado = EstadoNicho::DISPONIBLE;
                    $nicho->save();
                    Notificacion::create([
                        'id_usuario' => $usuario->id_usuario,
                        'descripcion' => "Se ha terminado el proceso de exhumación para el nicho NI-{$solicitud->id_nicho}, ya puedes acudir a un ayudante para solicitar nuevo contrato.",
                        'fecha' => now(),
                        'estado' => EstadoNotificacion::NO_LEIDO,
                    ]);
                    break;
            }
            $solicitud->save();
            DB::commit();
            return back()->with('msg-success', "Se ha actualizado la solicitud exitosamente.");
        } catch (\Exception $exception) {
            return back()->with('msg-error', "No se pudo actualizar la solicitud de exhumación. {$exception->getMessage()}");
        }

    }

    public static function getMotivos()
    {
        return [
            'Traslado a otro cementerio',
            'Orden judicial',
            'Solicitud del familiar',
            'Vencimiento del contrato',
            'Reordenamiento del cementerio',
            'Identificación de restos',
            'Incineración posterior',
        ];
    }
}
