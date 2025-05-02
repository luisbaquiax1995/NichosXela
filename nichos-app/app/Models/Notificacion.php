<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id_notificacion
 * @property int id_usuario
 * @property string descripcion
 * @property string fecha
 * @property string estado
 */
class Notificacion extends Model
{
    protected $table = 'notificacion';
    protected $primaryKey = 'id_notificacion';
    public $timestamps = false;
    protected $fillable = [
        'id_notificacion',
        'id_usuario',
        'descripcion',
        'fecha',
        'estado'
    ];
}
