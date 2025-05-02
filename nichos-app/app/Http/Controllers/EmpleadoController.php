<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleadoController extends Controller
{
    //
    function editUser($id){
        return view('admin.register-user')->with('empleado',$this->getEmployeeById($id)[0]);
    }

    function updateEmployee($id_usuario, $id_persona)
    {
        try {
            $user = Usuario::find($id_usuario);
            $user->username = request('username');
            $persona = Persona::find($id_persona);
            $persona->nombre1 = request('nombre1') ? request('nombre1') : '';
            $persona->nombre2 = request('nombre2') ? request('nombre2') : '';
            $persona->apellido1 = request('apellido1') ? request('apellido1') : '';
            $persona->apellido2 = request('apellido2') ? request('apellido2') : '';
            $persona->genero = request('genero');
            $persona->dpi = request('dpi');
            $persona->save();
            return redirect('/users')->with('msg-success','Usuario actualizado con éxito.');
        }catch (\Exception $e){
            return redirect('/users')->with('msg-error','No se pudo actualizar el usuario, lo sentimos.');
        }
    }

    function getEmployeeById($id){
        $empleado = DB::select('
        select u.id_usuario, u.username, u.estado, r.id_rol, r.nombre_rol, p.id_persona,
        p.nombre1, p.nombre2, p.apellido1, p.apellido2, p.genero, p.dpi
        from usuario u
        inner join rol r on u.rol_id = r.id_rol
        inner join empleado e on u.id_usuario = e.id_usuario
        inner join persona p on e.id_persona = p.id_persona
        where u.rol_id != 3
        and u.id_usuario = ?
        order by estado desc limit 1;
        ', [$id]);
        return $empleado;
    }
}
