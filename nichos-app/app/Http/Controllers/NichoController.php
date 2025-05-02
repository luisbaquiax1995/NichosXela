<?php

namespace App\Http\Controllers;

use App\enums\EstadoNicho;
use App\enums\TipoOcupante;
use App\enums\TipoRol;
use App\Models\Nicho;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NichoController extends Controller
{
    //
    public function addNicho()
    {
        try {
            if (session('usuario') == null) {
                return redirect('/');
            }
            if (session('usuario')->rol_id != TipoRol::ADMINISTRADOR
                && session('usuario')->rol_id != TipoRol::AYUDANTE) {
                return redirect('/')->with('msg-error', 'Acceso no autorizado.');
            }
            $idcalle = request('calle');
            $idAvenida = request('avenida');
            if ($idcalle == $idAvenida) {
                return back()->with('msg-error', "La calle y avenida no pueden ser iguales.");
            }
            $nicho = new Nicho();
            $nicho->id_calle = $idcalle;
            $nicho->id_avenida = $idAvenida;
            $nicho->estado = EstadoNicho::DISPONIBLE;
            $nicho->status = request('status');
            $nicho->tipo = request('tipo');
            $nicho->save();
            return back()->with('msg-success', 'Nicho registrado correctamente');
        } catch (\Exception $e) {
            return back()->with('msg-error', "No se pudieron guardar los datos.");
        }

    }

    public function editarNicho($id)
    {
        try {
            /** @var Usuario $user  */
            $user = session('usuario');
            if($user->rol_id != TipoRol::ADMINISTRADOR){
                return redirect('/')->with('msg-error', 'Acceso no autorizado.');
            }
            $nicho = self::getNichoPorCodigo($id);
            return view('admin.register-nicho')->with('nicho', $nicho);
        }catch (\Exception $e) {
            return back()->with('msg-error', "No se pudieron guardar los datos.");
        }
    }

    public function updateNicho($id)
    {
        try {
            if (session('usuario') == null) {
                return redirect('/');
            }
            if (session('usuario')->rol_id != TipoRol::ADMINISTRADOR) {
                return redirect('/')->with('msg-error', 'Acceso no autorizado.');
            }

            $calle = request('calle');
            $idAvenida = request('avenida');
            $status = request('status');
            $tipo = request('tipo');
            DB::beginTransaction();
            $nicho = Nicho::find($id);
            $nicho->id_calle = $calle;
            $nicho->id_avenida = $idAvenida;
            $nicho->status = $status;
            $nicho->tipo = $tipo;
            $nicho->save();
            DB::commit();
            return back()->with('msg-success', 'Nicho actualizado correctamente');
        }catch (\Exception $e) {
            return back()->with('msg-error', "No se pudieron guardar los datos.");
        }
    }

    public function nichos($estado)
    {
        if (session('usuario') == null) {
            return redirect('/');
        }
        if (session('usuario')->rol_id != TipoRol::ENCARGADO
            && session('usuario')->rol_id != TipoRol::ADMINISTRADOR
            && session('usuario')->rol_id != TipoRol::AYUDANTE) {
            return redirect('/')->with('msg-error', 'Acceso no autorizado.');
        }
        if ($estado == EstadoNicho::OCUPADO) {
            return view('admin.nichos-ocupados')->with('nichos', self::getNichosOcupados())
                ->with('titulo_nicho', self::getTitlesNichos($estado));
        } else {
            return view('admin.nichos-disponibles')->with('nichos', self::getNichosPorEstado($estado))
                ->with('titulo_nicho', self::getTitlesNichos($estado));
        }
    }

    public function nichosPorCodigo()
    {
        try {
            if (session('usuario') == null) {
                return redirect('/');
            }
            if (session('usuario')->rol_id != TipoRol::ENCARGADO) {
                return redirect('/')->with('msg-error', 'Acceso no autorizado.');
            }
            $codigo = request('codigo');
            $estado = request('estado');
            if ($estado == EstadoNicho::DISPONIBLE) {
                return view('admin.nichos-disponibles')->with('nichos', self::getnichosPorCodigo($estado, $codigo))
                    ->with('titulo_nicho', self::getTitlesNichos($estado));
            }
            return view('admin.nichos-ocupados')->with('nichos', self::getNichosOcupdosPorCodigo($codigo))
                ->with('titulo_nicho', self::getTitlesNichos($estado));
        } catch (\Exception $e) {
            return back()->with('msg-error', "Erro al obtener nichos por codigo.");
        }
    }

    public function nichosPorCalle()
    {
        try {
            if (session('usuario') == null) {
                return redirect('/');
            }
            if (session('usuario')->rol_id != TipoRol::ENCARGADO) {
                return redirect('/')->with('msg-error', 'Acceso no autorizado.');
            }
            /*
                  $estado = request('estado');
                  $calle = request('calle');
                  $avenida = request('avenida');
                  if($calle){
                      if ($estado == EstadoNicho::DISPONIBLE) {
                          return view('admin.nichos-disponibles')->with('nichos', self::getNichosPorCalle($estado, $calle))
                              ->with('titulo_nicho', self::getTitlesNichos($estado));
                      }
                      return view('admin.nichos-ocupados')->with('nichos', self::getNichosPorCalle($estado, $calle))
                          ->with('titulo_nicho', self::getTitlesNichos($estado));
                  }

                  if ($estado == EstadoNicho::DISPONIBLE) {
                      return view('admin.nichos-disponibles')->with('nichos', self::getNichosPorAvenida($estado, $avenida))
                          ->with('titulo_nicho', self::getTitlesNichos($estado));
                  }
                  return view('admin.nichos-ocupados')->with('nichos', self::getNichosPorAvenida($estado, $avenida))
                      ->with('titulo_nicho', self::getTitlesNichos($estado));
                  */
            $estado = request('estado');
            $calle = request('calle');
            $avenida = request('avenida');

            $esDisponible = $estado == EstadoNicho::DISPONIBLE;
            $vista = $esDisponible ? 'admin.nichos-disponibles' : 'admin.nichos-ocupados';
            $nichos = $calle
                ? ($esDisponible ? self::getNichosPorCalle($estado, $calle) : self::getNichosOcupadosPorCalle($calle))
                : ($esDisponible ? self::getNichosPorAvenida($estado, $avenida) : self::getNichosOcupadosPorAvenida($avenida));

            return view($vista)
                ->with('nichos', $nichos)
                ->with('titulo_nicho', self::getTitlesNichos($estado));
        } catch (\Exception $e) {
            return back()->with('msg-error', "Hubo un error al intentar obtener nichos por calle.");
        }

    }

    /**
     * @param $estado
     * @return array
     */
    public static function getNichosPorEstado($estado)
    {
        return DB::select("
            select n.codigo, n.estado as estado_nicho, n.status, n.tipo, c1.nombre_calle as calle, c2.nombre_calle as avenida,
                   c1.numero_calle as numero1, c2.numero_calle as numero2
            from nicho n
            inner join calle c1 on n.id_calle = c1.id_calle
            inner join calle c2 on n.id_avenida = c2.id_calle
            where n.estado = ?;
        ", [$estado]);
    }

    /***
     * @return array
     */
    public static function getNichosOcupados()
    {
        return DB::select("
            select n.codigo, n.estado as estado_nicho, n.status, n.tipo, c1.nombre_calle as calle, c2.nombre_calle as avenida,
                   c1.numero_calle as numero1, c2.numero_calle as numero2,
                   c.estado, c.fecha_inicio, c.fecha_finalizacion, c.fecha_limite,
                   p.id_persona, concat(p.nombre1, ' ', p.nombre2,' ', p.apellido1,' ', p.apellido2) as nombre,
                   p.genero, p.dpi, o.fecha_nacimiento, o.fecha_fallecimiento, o.procedencia
            from nicho n
            inner join contrato c on n.codigo = c.id_nicho
            inner join ocupante o on c.id_ocupante = o.id_ocupante
            inner join persona p on o.id_persona = p.id_persona
            inner join calle c1 on n.id_calle = c1.id_calle
            inner join calle c2 on n.id_avenida = c2.id_calle
            where n.status = ?
            and n.estado = ?;
        ", [EstadoNicho::STATUS_NORMAL, EstadoNicho::OCUPADO]);
    }

    public static function getNichosOcupdosPorCodigo($codigo)
    {
        return DB::select("
            select n.codigo, n.estado as estado_nicho, n.status, n.tipo, c1.nombre_calle as calle, c2.nombre_calle as avenida,
                   c1.numero_calle as numero1, c2.numero_calle as numero2,
                   c.estado, c.fecha_inicio, c.fecha_finalizacion, c.fecha_limite,
                   p.id_persona, concat(p.nombre1, ' ', p.nombre2,' ', p.apellido1,' ', p.apellido2) as nombre,
                   p.genero, p.dpi, o.fecha_nacimiento, o.fecha_fallecimiento, o.procedencia
            from nicho n
            inner join contrato c on n.codigo = c.id_nicho
            inner join ocupante o on c.id_ocupante = o.id_ocupante
            inner join persona p on o.id_persona = p.id_persona
            inner join calle c1 on n.id_calle = c1.id_calle
            inner join calle c2 on n.id_avenida = c2.id_calle
            where n.status = 'NORMAL'
            and codigo = ?;
        ", [$codigo]);
    }

    /**
     * @param $calle
     * @return array
     */
    public static function getNichosOcupadosPorCalle($calle)
    {
        return DB::select("
            select n.codigo, n.estado as estado_nicho, n.status, n.tipo, c1.nombre_calle as calle, c2.nombre_calle as avenida,
                   c1.numero_calle as numero1, c2.numero_calle as numero2,
                   c.estado, c.fecha_inicio, c.fecha_finalizacion, c.fecha_limite,
                   p.id_persona, concat(p.nombre1, ' ', p.nombre2,' ', p.apellido1,' ', p.apellido2) as nombre,
                   p.genero, p.dpi, o.fecha_nacimiento, o.fecha_fallecimiento, o.procedencia
            from nicho n
            inner join contrato c on n.codigo = c.id_nicho
            inner join ocupante o on c.id_ocupante = o.id_ocupante
            inner join persona p on o.id_persona = p.id_persona
            inner join calle c1 on n.id_calle = c1.id_calle
            inner join calle c2 on n.id_avenida = c2.id_calle
            where n.estado = 'OCUPADO'
            and c1.id_calle = ?;
        ", [$calle]);
    }

    /**
     * @param $avenida
     * @return array
     */
    public static function getNichosOcupadosPorAvenida($avenida)
    {
        return DB::select("
            select n.codigo, n.estado as estado_nicho, n.status, n.tipo, c1.nombre_calle as calle, c2.nombre_calle as avenida,
                   c1.numero_calle as numero1, c2.numero_calle as numero2,
                   c.estado, c.fecha_inicio, c.fecha_finalizacion, c.fecha_limite,
                   p.id_persona, concat(p.nombre1, ' ', p.nombre2,' ', p.apellido1,' ', p.apellido2) as nombre,
                   p.genero, p.dpi, o.fecha_nacimiento, o.fecha_fallecimiento, o.procedencia
            from nicho n
            inner join contrato c on n.codigo = c.id_nicho
            inner join ocupante o on c.id_ocupante = o.id_ocupante
            inner join persona p on o.id_persona = p.id_persona
            inner join calle c1 on n.id_calle = c1.id_calle
            inner join calle c2 on n.id_avenida = c2.id_calle
            where n.estado = 'OCUPADO'
            and c2.id_calle = ?;
        ", [$avenida]);
    }

    /**
     * @param $estado
     * @param $codigo
     * @return array
     */
    public static function getNichosPorCodigo($estado, $codigo)
    {
        return DB::select("
            select n.codigo, n.estado as estado_nicho, n.status, n.tipo, c1.nombre_calle as calle, c2.nombre_calle as avenida,
                   c1.numero_calle as numero1, c2.numero_calle as numero2
            from nicho n
            inner join calle c1 on n.id_calle = c1.id_calle
            inner join calle c2 on n.id_avenida = c2.id_calle
            where n.estado = ?
            and codigo = ?;
        ", [$estado, $codigo]);
    }

    public static function getNichosPorCalle($estado, $calle)
    {
        return DB::select("
            select n.codigo, n.estado as estado_nicho, n.status, n.tipo, c1.nombre_calle as calle, c2.nombre_calle as avenida,
                   c1.numero_calle as numero1, c2.numero_calle as numero2
            from nicho n
            inner join calle c1 on n.id_calle = c1.id_calle
            inner join calle c2 on n.id_avenida = c2.id_calle
            where n.estado = ?
            and c1.id_calle = ?;
        ", [$estado, $calle]);
    }

    public static function getNichosPorAvenida($estado, $avenida)
    {
        return DB::select("
            select n.codigo, n.estado as estado_nicho, n.status, n.tipo, c1.nombre_calle as calle, c2.nombre_calle as avenida,
                   c1.numero_calle as numero1, c2.numero_calle as numero2
            from nicho n
            inner join calle c1 on n.id_calle = c1.id_calle
            inner join calle c2 on n.id_avenida = c2.id_calle
            where n.estado = ?
            and c2.id_calle = ?;
        ", [$estado, $avenida]);
    }

    public static function getNichosByEstado($estado)
    {
        return Nicho::where('estado', $estado)->get();
    }

    public static function getNichoPorCodigo($codigo){
        return DB::select("
            select n.codigo, n.estado as estado_nicho, n.status, n.tipo, c1.nombre_calle as calle, c2.nombre_calle as avenida,
                   c1.numero_calle as numero1, c2.numero_calle as numero2,
                   c1.id_calle as id_calle, c2.id_calle as id_avenida
            from nicho n
            inner join calle c1 on n.id_calle = c1.id_calle
            inner join calle c2 on n.id_avenida = c2.id_calle
            where codigo = ?;
        ", [$codigo])[0];
    }

    /**
     * @param $estado
     * @return string
     */
    public static function getTitlesNichos($estado)
    {
        return match ($estado) {
            EstadoNicho::OCUPADO => 'ocupados',
            EstadoNicho::DISPONIBLE => 'disponibles',
            EstadoNicho::EN_EXHUMACION => 'en proceso de exhumación',
            default => '',
        };
    }

}
