<?php

namespace App\Http\Controllers;

use App\enums\TipoRol;
use App\Models\Empleado;
use App\Models\Encargado;
use App\Models\Ocupante;
use App\Models\Persona;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\password;


class UsuarioController extends Controller
{
    function register()
    {
        try {
            $username = request('username');
            if (Usuario::where('username', request('username'))->exists()) {
                return back()->with('msg-error', 'El nombre de usuario: ' . $username . '  ya existe.');
            };
            DB::beginTransaction();
            $user = new Usuario();
            $user->username = request('username');
            $user->password = bcrypt(request('password'));
            $user->estado = 1;
            $user->rol_id = request('rol');
            $user->save();

            if (Persona::where('dpi', request('dpi'))->exists()) {
                return back()->with('msg-error', 'El dpi ' . request('dpi') . '  ya se encuentra registrado.');
            }
            $persona = new Persona();
            $persona->nombre1 = request('nombre1') ? request('nombre1') : '';
            $persona->nombre2 = request('nombre2') ? request('nombre2') : '';
            $persona->apellido1 = request('apellido1') ? request('apellido1') : '';
            $persona->apellido2 = request('apellido2') ? request('apellido2') : '';
            $persona->genero = request('genero');
            $persona->dpi = request('dpi');
            $persona->save();
            if ($user->rol_id == TipoRol::ENCARGADO) {
                $correo = \request('email');
                $telefono = \request('telefono');
                $direccion = \request('address');
                if (Encargado::where('correo', $correo)->exists()) {
                    return back()->with('msg-error', 'El correo ' . $correo . ' se encuentra en uso.');
                }
                $encargado = new Encargado();
                $encargado->id_persona = $persona->id_persona;
                $encargado->id_usuario = $user->id_usuario;
                $encargado->correo = $correo;
                $encargado->telefono = $telefono;
                $encargado->direccion = $direccion;
                $encargado->save();
            } else if ($user->rol_id == TipoRol::ADMINISTRADOR
                || $user->rol_id == TipoRol::AUDITOR
                || $user->rol_id == TipoRol::AYUDANTE) {
                $empleado = new Empleado();
                $empleado->id_usuario = $user->id_usuario;
                $empleado->id_persona = $persona->id_persona;
                $empleado->save();
            } else {
                $fechaNacimiento = request('fechaNacimiento');
                $idMunicipio = request('idMunicipio');

                $ocupante = new Ocupante();
                $ocupante->id_persona = $persona->id_persona;
                $ocupante->fecha_nacimiento = $fechaNacimiento;
                $ocupante->id_municipio = $idMunicipio;
                $ocupante->save();
            }
            DB::commit();
            return back()->with('msg-success', 'Se ha realizado el registro correctamente');
        } catch (\Exception $e) {
            return back()->with('msg-error', 'No se pudo registrar el usuario.' . $e->getMessage());
        }
    }

    function login()
    {
        try {
            $username = request('username');
            $password = request('password');
            if (!Usuario::where('username', $username)->exists()) {
                return back()->with('msg-error', 'Usted no se encuentra registrado.');
            }
            $user = Usuario::where('username', $username)->first();
            if (!Hash::check($password, $user->password)) {
                return back()->with('msg-error', 'Contraseña incorrecta.');
            }
            session(['usuario' => $user]);
            if ($user->rol_id == TipoRol::ADMINISTRADOR) {
                return view('admin.home');
            } else if ($user->rol_id == TipoRol::AUDITOR) {
                return view('auditor.home');
            } else if ($user->rol_id == TipoRol::AYUDANTE) {
                return view('ayudante.home');
            } else if ($user->rol_id == TipoRol::ENCARGADO) {
                return view('encargado.home');
            } else {
                return back()->with('msg-error', 'Acceso denegado.');
            }
        } catch (\Exception $e) {
            return back()->with('msg-error', 'Hubo un error en el servidor.');
        }
    }

    function users()
    {
        return view('admin.users')->with('users', $this->getEmpleados());
    }

    function updateStateEmployee($id, $estado)
    {
        $user = Usuario::find($id);
        $user->estado = $estado;
        $user->save();
        return back()->with('title', 'Cambio de estado exitoso')
                    ->with('msg-success', 'Se ha actualizado el estado del usuario.');
    }

    function logout(){
        session()->flush();
        return redirect('/');
    }

    function getEmpleados()
    {
        $users = DB::select('
            select u.id_usuario, u.username, u.estado, r.nombre_rol, p.id_persona,
            p.nombre1, p.nombre2, p.apellido1, p.apellido2, p.genero, p.dpi
            from usuario u
            inner join rol r on u.rol_id = r.id_rol
            inner join empleado e on u.id_usuario = e.id_usuario
            inner join persona p on e.id_persona = p.id_persona
            where u.rol_id != ?
            order by estado desc;
        ', [TipoRol::ADMINISTRADOR]);
        return $users;
    }
}
