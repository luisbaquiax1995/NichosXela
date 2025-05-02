<?php

namespace App\Http\Controllers;

use App\Models\TipoMuerte;
use Illuminate\Http\Request;

class TipoMuerteController extends Controller
{
    //
    public static function listaTipoMuerte(){
        return TipoMuerte::all();
    }
}
