<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    //
    public function getByDepartamento($id){
        return response()->json(Municipio::where('id_depto', $id)->get());
    }
}
