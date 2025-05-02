<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FotosNichoController extends Controller
{
    //
    public function verFotosNicho($id)
    {
        $fotos = self::getFotosNicho($id);
        $codigo = "";
        if (!empty($fotos)) {
            $codigo = "".$fotos[0]->id_nicho;
            return view('admin.fotos-nichos')
                ->with('fotos', $fotos)
                ->with('codigo', $codigo);
        }
        return view('admin.fotos-nichos')->with('fotos', $fotos)->with('codigo', $codigo);
    }

    public static function getFotosNicho($id)
    {
        return DB::select("
            select f.id_foto, id_nicho, archivo_foto
            from foto_nicho f
            inner join nichos.nicho n on f.id_nicho = n.codigo
            where id_nicho = ?;
        ", [$id]);
    }
}
