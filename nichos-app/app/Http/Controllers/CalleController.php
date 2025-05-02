<?php

namespace App\Http\Controllers;

use App\Models\Calle;
use Illuminate\Http\Request;

class CalleController extends Controller
{
    //
    public static function getCalles($tipo){
        return Calle::where('tipo', $tipo)->get();
    }

}
