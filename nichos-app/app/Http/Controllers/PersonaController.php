<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonaController extends Controller
{
    //
    public function searchByDpi(){
        try {
            $dpi = request('dpi');
            $ocupante = self::getPersonaByDpi($dpi);
            if($ocupante){
                return back()->with('msg-error',"El ocupante ya se encuentra registrado, intente nuevamente");
            }
            $persona = Persona::where('dpi', $dpi)->first();
            if($persona){
                return view('admin.register-ocupante')
                    ->with('persona', $persona);
            }
            $persona = new Persona();
            $persona->dpi = $dpi;
            return view('admin.register-ocupante')
                ->with('persona', $persona);
        }catch (\Exception $e){
            return back()->with('msg-error', "Error al buscar a la persona ".$e->getMessage());
        }
    }

    public static function getPersonaByDpi($dpi){
        return DB::select("
            select *
            from persona p
            inner join ocupante o on p.id_persona = o.id_persona
            where dpi = ?;
        ", [$dpi]);
    }

}
