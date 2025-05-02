<?php

namespace App\Http\Controllers;

use App\enums\TipoOcupante;
use App\Models\Ocupante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InformeOcupantesControl extends Controller
{
    public function reporteOcupantes()
    {
        return view('admin.vista-informe-ocupantes')
            ->with('niños', self::getReporteNinios(1))
            ->with('porGenero', self::getReportePorGenero(1))
            ->with('jovenes', self::getReporteJovenes(1))
            ->with('adultos', self::getAdultos(1))
            ->with('abuelos', self::getAbuelos(1));
    }

    public static function getReportePorGenero($estado){
        $ocupantes = DB::select("
            select count(genero) as cantidad, p.genero
            from ocupante o
            inner join persona p on o.id_persona = p.id_persona
            where o.estado = ?
            group by genero;
        ",[$estado]);
        return !empty($ocupantes) ? $ocupantes : null;
    }
    public static function getReporteNinios($estado)
    {
        $niños = DB::select("
            select count(*) as cantidad, genero
            from ocupante o
            inner join persona p on o.id_persona = p.id_persona
            where datediff(o.fecha_fallecimiento, o.fecha_nacimiento) < 10
            and o.estado = ?
            group by genero;
        ",[$estado]);

        return !empty($niños) ? $niños : null;
    }

    public static function getReporteJovenes($estado)
    {
        $jovenes = DB::select("
            select count(*) as cantidad, genero
            from ocupante o
            inner join persona p on o.id_persona = p.id_persona
            where datediff(o.fecha_fallecimiento, o.fecha_nacimiento) > 10 and datediff(o.fecha_fallecimiento, o.fecha_nacimiento) < 18
            and o.estado = ?
            group by genero;
        ",[$estado]);
        return !empty($jovenes) ? $jovenes : null;
    }

    public static function getAbuelos($estado)
    {
        $abuelos = DB::select("
            select count(*) as cantidad
            from ocupante o
            inner join persona p on o.id_persona = p.id_persona
            where datediff(o.fecha_fallecimiento, o.fecha_nacimiento) > 60
            and o.estado = ?
            group by genero;
        ", [$estado]);
        return !empty($abuelos) ? $abuelos : null;
    }
    public static function getAdultos($estado)
    {
        $adultos = DB::select("
            select count(*) as cantidad
            from ocupante o
            inner join persona p on o.id_persona = p.id_persona
            where datediff(o.fecha_fallecimiento, o.fecha_nacimiento) >= 30 and datediff(o.fecha_fallecimiento, o.fecha_nacimiento) < 60
            and o.estado = ?
            group by genero;
        ",[$estado]);
        return !empty($adultos) ? $adultos : null;
    }
}
