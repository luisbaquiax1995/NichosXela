<?php

namespace App\Http\Controllers;

use App\Models\Encargado;
use App\Models\Persona;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;

class EncargadoController extends Controller
{
    //
    public function encargados()
    {
        return view('admin.encargados')->with('encargados', $this->getEncargados());
    }

    public function updateEncargado($id_usuario, $id_persona, $id_encargado)
    {
        try {
            $user = Usuario::find($id_usuario);
            $user->username = request('username');
            $user->save();
            $persona = Persona::find($id_persona);
            $persona->nombre1 = request('nombre1');
            $persona->nombre2 = request('nombre2');
            $persona->apellido1 = request('apellido1');
            $persona->apellido2 = request('apellido2');
            $persona->dpi = request('dpi');
            $persona->genero = request('genero');
            $persona->save();
            $encargado = Encargado::find($id_encargado);
            $encargado->correo = request('email');
            $encargado->telefono = request('telefono');
            $encargado->direccion = request('address');
            $encargado->save();
            return redirect('/encargados')->with('msg-success', 'Encargado actualizado exitosamente');
        } catch (\Exception $e) {
            return redirect('/encargados')->with('msg-error', 'No se pudo actualizar el encargado, intente nuevamente.');
        }
    }

    public function editEncargado($id)
    {
        return view('admin.register-encargado')->with('encargado', $this->getEncargado($id));
    }

    public function getEncargados()
    {
        $encargados = DB::select('
        select u.id_usuario, u.username, u.estado, r.nombre_rol,
        p.id_persona, p.nombre1, p.nombre2, p.apellido1, p.apellido2, p.genero, p.dpi,
        e.id_encargado, e.correo, e.direccion, e.telefono
        from usuario u
        inner join rol r on u.rol_id = r.id_rol
        inner join encargado e on u.id_usuario = e.id_usuario
        inner join persona p on e.id_persona = p.id_persona
        order by estado desc;
        ');
        return $encargados;
    }

    public function getEncargado($id)
    {
        $encargado = DB::select('
        select u.id_usuario, u.username, u.estado, r.nombre_rol,
        p.id_persona, p.nombre1, p.nombre2, p.apellido1, p.apellido2, p.genero, p.dpi,
        e.id_encargado, e.correo, e.direccion, e.telefono
        from usuario u
        inner join rol r on u.rol_id = r.id_rol
        inner join encargado e on u.id_usuario = e.id_usuario
        inner join persona p on e.id_persona = p.id_persona
        where u.id_usuario = ?
        order by estado desc;
        ', [$id]);
        return $encargado[0];
    }

    /**
     * @param $id_usuario
     * @return mixed
     */
    public static function getEncargadoByIdUsuario($id_usuario)
    {
        return DB::select("
            select e.id_encargado
            from encargado e
            inner join usuario u on e.id_usuario = u.id_usuario
            where e.id_usuario = ?;
        ", [$id_usuario])[0];
    }

    /**
     * @param $id_encargado
     * @return mixed
     */
    public static function getUsuarioByIdEncargado($id_encargado)
    {
        return DB::select("
            select u.id_usuario
            from encargado e
            inner join usuario u on e.id_usuario = u.id_usuario
            where u.id_usuario = ?;
        ", [$id_encargado])[0];
    }
}
