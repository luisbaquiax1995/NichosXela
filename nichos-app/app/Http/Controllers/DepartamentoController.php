<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    //
    public static function departamentos(){
        return Departamento::all();
    }
}
