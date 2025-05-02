<?php

namespace App\Http\Controllers;

use App\enums\EstadoNotificacion;
use App\Models\Notificacion;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class NotificacionController extends Controller
{
    //
    public function verNotificaciones(){
        try {
            /** @var Usuario $user */
            $user = session('usuario');
            if($user == null){
                return redirect('/');
            }
            $leidos = self::getNotificaciones($user->id_usuario, EstadoNotificacion::LEIDO);
            return view('admin.list-notificacion')->with('leidos', $leidos);
        }catch (\Exception $e){
            return back()->with('msg-error', 'Error en el servidor'.$e->getMessage());
        }
    }

    public function updateNotificaciones($id, $estado)
    {
        try {
            $notificacion = Notificacion::find($id);
            $notificacion->estado = $estado;
            $notificacion->save();
            return back()->with('msg-success', "Notificación marcada como leída.");
        }catch (\Exception $e){
            return back()->with('msg-error', 'No se pudo actualizar la notificacion.');
        }
    }

    public static function getNotificaciones($idUsuario, $estado)
    {
        return DB::select("
            select n.id_notificacion, descripcion, fecha, n.estado, u.id_usuario
            from notificacion n
            inner join usuario u on n.id_usuario = u.id_usuario
            where u.id_usuario= ?
            order by fecha desc;
        ",[$idUsuario]);
    }
}
