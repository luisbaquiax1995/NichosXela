<?php

namespace App\Http\Controllers;

use App\Models\Boleta;
use Illuminate\Http\Request;

class InformesController extends Controller
{
    //
    public function dineroRecaudado()
    {
        return view('admin.dinero-recaudado')->with('recaudado', self::getDineroRecaudado());
    }

    public function dineroRecaudadoPorFecha()
    {
        $fecha1 = request('fecha1');
        $fecha2 = request('fecha2');
        return view('admin.dinero-recaudado')->with('recaudado', self::getRecaudadoPorFecha($fecha1, $fecha2));
    }

    public static function getDineroRecaudado(){
        return Boleta::sum('costo');
    }

    public static function getRecaudadoPorFecha($fecha1, $fecha2){
        return Boleta::whereBetween('fecha_aprobacion', [$fecha1, $fecha2])->sum('costo');
    }
}
