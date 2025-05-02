<?php

namespace App\Http\Controllers;

use App\enums\EstadoNicho;
use App\enums\TipoContrato;
use App\Models\Contrato;
use App\Models\Nicho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ContratoController extends Controller
{
    //
    public function listaContratos()
    {
        try {
            $estado = request('estado');
            $statusNicho = request('statusNicho');
            $auditor = request('auditor');
            switch ($estado) {
                case TipoContrato::A_PUNTO_DE_VENCER:
                    if($auditor){
                        return view('auditor.contratos')->with('contratos', self::getContratosApuntoDeVencer())
                            ->with('titulo_contrato', "A punto de vencer");
                    }
                    return view('admin.contratos')->with('contratos', self::getContratosApuntoDeVencer())
                        ->with('titulo_contrato', "A punto de vencer");
                default:
                    return view('admin.contratos')->with('contratos', self::getContratos($estado, $statusNicho))
                        ->with('titulo_contrato', $estado);
            }
        } catch (\Exception $e) {
            return back()->with('msg-error', 'Ocurrio un error en el servidor.');
        }
    }

    public function listaContratosPorEncargado()
    {
        try {
            $estado = request('estado');
            $usuario = session('usuario');
            switch ($estado) {
                case TipoContrato::A_PUNTO_DE_VENCER:
                    return view('admin.contratos')->with('contratos', self::getContratosEncargadoApuntoDeVencer($usuario->id_usuario))
                        ->with('titulo_contrato', "A punto de vencer");
                default:
                    return view('admin.contratos')->with('contratos', self::getContratoByEncargado($usuario->id_usuario, $estado))
                        ->with('titulo_contrato', $estado);
            }
        }catch (\Exception $e) {
            return back()->with('msg-error', 'Ocurrio un error en el servidor.');
        }
    }

    public function detalleContrato($id)
    {
        if(self::getContratoById($id)){
            return view('admin.vista-contrato')->with('contrato', self::getContratoById($id));
        }else{
            return view('admin.vista-contrato')->with('contrato', self::getContratoAsociado($id));
        }
    }

    public function historicoNichosContratos(){
        try {
            return view('admin.contratos')
                ->with('contratos', self::getContratos(TipoContrato::CADUCADO, EstadoNicho::STATUS_NORMAL))
                ->with('titulo_contrato', 'caducados');
        }catch (\Exception $e) {
            return back()->with('msg-error', 'Ocurrio un error en el servidor.');
        }
    }

    /**
     * @param $estado
     * @param $estadoNicho
     * @return array contrato por estado y estado_nicho
     */
    public static function getContratos($estado, $estadoNicho)
    {
        return DB::select("
            select n.codigo, id_calle, id_avenida, n.estado as estado_nicho, n.status, n.tipo,
                   c.estado, c.fecha_inicio, c.fecha_finalizacion, c.fecha_limite, c.id_contrato,
                   p.id_persona as o_id, p.nombre1 as onombre1, p.nombre2 as onombre2, p.apellido1 as oapellido1,
                    p.apellido2 as oapellido2, p.genero as ogenero, p.dpi  as odpi, o.fecha_nacimiento, o.fecha_fallecimiento, o.procedencia,
                   p1.id_persona, p1.nombre1, p1.nombre2, p1.apellido1, p1.apellido2, p1.genero, p1.dpi
            from nicho n
            inner join contrato c on n.codigo = c.id_nicho
            inner join ocupante o on c.id_ocupante = o.id_ocupante
            inner join persona p on o.id_persona = p.id_persona
            inner join encargado e on c.id_encargado = e.id_encargado
            inner join persona p1 on e.id_persona = p1.id_persona
            where n.status = ?
            and c.estado = ?;
        ", [$estadoNicho, $estado]);
    }

    public static function getContratoByEncargado($idUsuario, $estado)
    {
        return DB::select("
            select n.codigo, id_calle, id_avenida, n.estado as estado_nicho, n.status, n.tipo,
                   c.estado, c.fecha_inicio, c.fecha_finalizacion, c.fecha_limite, c.id_contrato,
                   p.id_persona as oid, p.nombre1 as onombre1, p.nombre2 as onombre2, p.apellido1 as oapellido1,
                    p.apellido2 as oapellido2, p.genero as ogenero, p.dpi  as odpi, o.fecha_nacimiento, o.fecha_fallecimiento, o.procedencia,
                   p1.id_persona, p1.nombre1, p1.nombre2, p1.apellido1, p1.apellido2, p1.genero, p1.dpi
            from nicho n
            inner join contrato c on n.codigo = c.id_nicho
            inner join ocupante o on c.id_ocupante = o.id_ocupante
            inner join persona p on o.id_persona = p.id_persona
            inner join encargado e on c.id_encargado = e.id_encargado
            inner join persona p1 on e.id_persona = p1.id_persona
            inner join municipio m on o.id_municipio = m.id_municipio
            where c.estado = ?
            and e.id_usuario = ?;
        ", [$estado, $idUsuario]);
    }

    public static function getContratosEncargadoApuntoDeVencer($idUsuario)
    {
        return DB::select("
            select n.codigo, id_calle, id_avenida, n.estado as estado_nicho, n.status, n.tipo,
                   c.estado, c.fecha_inicio, c.fecha_finalizacion, c.fecha_limite, c.id_contrato,
                   p.id_persona as oid, p.nombre1 as onombre1, p.nombre2 as onombre2, p.apellido1 as oapellido1,
                    p.apellido2 as oapellido2, p.genero as ogenero, p.dpi  as odpi, o.fecha_nacimiento, o.fecha_fallecimiento, o.procedencia,
                   p1.id_persona, p1.nombre1, p1.nombre2, p1.apellido1, p1.apellido2, p1.genero, p1.dpi
            from nicho n
            inner join contrato c on n.codigo = c.id_nicho
            inner join ocupante o on c.id_ocupante = o.id_ocupante
            inner join persona p on o.id_persona = p.id_persona
            inner join encargado e on c.id_encargado = e.id_encargado
            inner join persona p1 on e.id_persona = p1.id_persona
            inner join municipio m on o.id_municipio = m.id_municipio
            where c.estado = 'ACTIVO'
            and  datediff(fecha_finalizacion, now()) >=0
            and datediff(fecha_finalizacion, now()) <= 60
            and e.id_usuario = ?;
        ", [$idUsuario]);
    }
    /**
     * @param $id
     * @return mixed
     */
    public static function getContratoById($id)
    {
        $contrato = DB::select("
            select n.codigo, n.estado as estado_nicho, n.status, n.tipo,
                   c.estado, c.fecha_inicio, c.fecha_finalizacion, c.fecha_limite, c.id_contrato,
                   p.id_persona as o_id, p.nombre1 as onombre1, p.nombre2 as onombre2, p.apellido1 as oapellido1,
                    p.apellido2 as oapellido2, p.genero as ogenero, p.dpi  as odpi, o.fecha_nacimiento, o.fecha_fallecimiento, o.procedencia,
                   p1.id_persona, p1.nombre1, p1.nombre2, p1.apellido1, p1.apellido2, p1.genero, p1.dpi,
                   e.direccion, e.telefono, e.correo,
                   m.nombre_municipio, d.nombre_departamento,
                   ca.numero_calle as ncalle, ca.nombre_calle as calle, av.nombre_calle as avenida, av.numero_calle as navenida
            from nicho n
            inner join contrato c on n.codigo = c.id_nicho
            inner join ocupante o on c.id_ocupante = o.id_ocupante
            inner join persona p on o.id_persona = p.id_persona
            inner join encargado e on c.id_encargado = e.id_encargado
            inner join persona p1 on e.id_persona = p1.id_persona
            inner join municipio m on o.id_municipio = m.id_municipio
            inner join departamento d on m.id_depto = d.id_depto
            inner join calle ca on n.id_calle = ca.id_calle
            inner join calle av on n.id_avenida = av.id_calle
            where id_contrato = ?;
        ", [$id]);
        return $contrato!= [] ? $contrato[0] : null;
    }

    public static function getContratoAsociado($idBoleta)
    {
        return DB::select("
            select n.codigo, n.estado as estado_nicho, n.status, n.tipo,
                   c.estado, c.fecha_inicio, c.fecha_finalizacion, c.fecha_limite, c.id_contrato,
                   p.id_persona as o_id, p.nombre1 as onombre1, p.nombre2 as onombre2, p.apellido1 as oapellido1,
                    p.apellido2 as oapellido2, p.genero as ogenero, p.dpi  as odpi, o.fecha_nacimiento, o.fecha_fallecimiento, o.procedencia,
                   p1.id_persona, p1.nombre1, p1.nombre2, p1.apellido1, p1.apellido2, p1.genero, p1.dpi,
                   e.direccion, e.telefono, e.correo,
                   m.nombre_municipio, d.nombre_departamento,
                   ca.numero_calle as ncalle, ca.nombre_calle as calle, av.nombre_calle as avenida, av.numero_calle as navenida
            from nicho n
            inner join contrato c on n.codigo = c.id_nicho
            inner join ocupante o on c.id_ocupante = o.id_ocupante
            inner join persona p on o.id_persona = p.id_persona
            inner join encargado e on c.id_encargado = e.id_encargado
            inner join persona p1 on e.id_persona = p1.id_persona
            inner join municipio m on o.id_municipio = m.id_municipio
            inner join departamento d on m.id_depto = d.id_depto
            inner join calle ca on n.id_calle = ca.id_calle
            inner join calle av on n.id_avenida = av.id_calle
            where c.id_boleta = ?;
        ", [$idBoleta])[0];
    }

    public static function getContratosApuntoDeVencer()
    {
        return DB::select("
            select n.codigo, id_calle, id_avenida, n.estado as estado_nicho, n.status, n.tipo,
                   c.estado, c.fecha_inicio, c.fecha_finalizacion, c.fecha_limite, c.id_contrato,
                   p.id_persona as oid, p.nombre1 as onombre1, p.nombre2 as onombre2, p.apellido1 as oapellido1,
                    p.apellido2 as oapellido2, p.genero as ogenero, p.dpi  as odpi, o.fecha_nacimiento, o.fecha_fallecimiento, o.procedencia,
                   p1.id_persona, p1.nombre1, p1.nombre2, p1.apellido1, p1.apellido2, p1.genero, p1.dpi
            from nicho n
            inner join contrato c on n.codigo = c.id_nicho
            inner join ocupante o on c.id_ocupante = o.id_ocupante
            inner join persona p on o.id_persona = p.id_persona
            inner join encargado e on c.id_encargado = e.id_encargado
            inner join persona p1 on e.id_persona = p1.id_persona
            inner join municipio m on o.id_municipio = m.id_municipio
            where n.status = ?
            and c.estado = ?
            and  datediff(fecha_finalizacion, now()) >=0
            and datediff(fecha_finalizacion, now()) < 60;
        ", [EstadoNicho::STATUS_NORMAL, TipoContrato::ACTIVO]);
    }

    /**
     * @param $id_ocupante
     * @return Contrato|null
     */
    public static function getContratoAnterior($id_ocupante)
    {
        return DB::select("select * from contrato where id_ocupante = ? and estado = 'ACTIVO';",[$id_ocupante])[0];
    }
}
