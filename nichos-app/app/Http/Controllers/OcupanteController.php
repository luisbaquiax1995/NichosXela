<?php

namespace App\Http\Controllers;

use App\Models\CausaMuerte;
use App\Models\Ocupante;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Termwind\renderUsing;

class OcupanteController extends Controller
{
    //

    public function addOcupante(){
        try {
            $dpi = request('dpi');
            $nombre1 = request('nombre1');
            $nombre2 = request('nombre2');
            $apellido1 = request('apellido1');
            $apellido2 = request('apellido2');
            $genero = request('genero');
            $fechaNacimiento = request('nacimiento');
            $fechaFallecimiento = request('fallecimiento');
            $idMunicipio = request('municipio');
            $procdencia = request('procedencia');
            $causasMuerte = request('muerte');
            $tipo = request('tipo');

            $persona = Persona::where('dpi', $dpi)->first();
            DB::beginTransaction();
            $newOcupante = new Ocupante();
            $newPersona = new Persona();
            if(!$persona){
                $newPersona->dpi = $dpi;
                $newPersona->nombre1 = $nombre1;
                $newPersona->nombre2 = $nombre2;
                $newPersona->apellido1 = $apellido1;
                $newPersona->apellido2 = $apellido2;
                $newPersona->genero = $genero;
                $newPersona->save();
                $newOcupante->id_persona = $newPersona->id_persona;
            }else{
                $newOcupante->id_persona = $persona->id_persona;
            }
            $newOcupante->fecha_nacimiento = $fechaNacimiento;
            $newOcupante->fecha_fallecimiento = $fechaFallecimiento;
            $newOcupante->id_municipio = $idMunicipio;
            $newOcupante->procedencia = $procdencia;
            $newOcupante->estado = 1;
            $newOcupante->tipo = $tipo;
            $newOcupante->save();
            foreach ($causasMuerte as $causaMuerte) {
                CausaMuerte::create([
                    'id_ocupante' => $newOcupante->id_ocupante,
                    'id_tipo_muerte' => $causaMuerte,
                ]);
            }
            DB::commit();
            return redirect('/ocupantes')->with('msg-success', 'Ocupante registrado correctamente.');
        }catch (\Exception $exception){
            return back()->with('msg-error', "No se pudo registrar la ocupante: {$exception->getMessage()}");
        }
    }

    public function updateOcupante($id)
    {
        $ocupante = Ocupante::find($id);
        echo json_encode($ocupante);
    }
    public function ocupantes(){
        return view('admin.ocupantes')->with('ocupantes',$this->getOcupantes(1));
    }
    public function formOcupante()
    {
        return view('admin.register-ocupante');
    }

    public function editOcupante($id)
    {
        $ocupante = $this->getOcupanteById($id);
        return view('admin.register-ocupante')->with('ocupante',$ocupante);
    }

    public function ocupantesEliminados()
    {
        return view('admin.ocupantes')->with('ocupantes',$this->getOcupantes(0));
    }

    public function deleteOcupante($id)
    {
        try {
            $ocupante = Ocupante::find($id);
            $ocupante->estado = 0;
            $ocupante->save();
            return back()->with('msg-success','Ocupante eliminado.');
        }catch (\Exception $exception){
            return back()->with('msg-error','No se pudo eliminar el ocupante');
        }
    }

    public function getOcupanteById($id)
    {
        return DB::select("
            select
                o.id_ocupante, fecha_nacimiento, procedencia, o.estado, o.tipo, o.fecha_fallecimiento,
                p.id_persona, nombre1, nombre2, apellido1, apellido2, genero, dpi,
                m.id_municipio, m.nombre_municipio, d.id_depto, d.nombre_departamento
            from ocupante o
            inner join persona p on o.id_persona = p.id_persona
            inner join municipio m on o.id_municipio = m.id_municipio
            inner join departamento d on m.id_depto = d.id_depto
            where o.id_ocupante = ?
            limit  1;
        ", [$id])[0];
    }

    public function getOcupantes($estado)
    {
        return DB::select("
        select
            o.id_ocupante, fecha_nacimiento, procedencia, o.estado, o.tipo, concat(m.nombre_municipio, ', ', d.nombre_departamento) as lugar,
            p.id_persona, nombre1, nombre2, apellido1, apellido2, genero, dpi
        from ocupante o
        inner join persona p on o.id_persona = p.id_persona
        inner join municipio m on o.id_municipio = m.id_municipio
        inner join departamento d on m.id_depto = d.id_depto
        where estado = ? order by tipo;
        ",[$estado]);
    }
}
