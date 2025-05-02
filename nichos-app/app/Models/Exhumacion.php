<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string fecha_inicio
 * @property string fecha_finalizacion
 */
class Exhumacion extends Model
{
    protected $table = 'exhumacion';
    protected $primaryKey = 'id_exhumacion';
    public $timestamps = false;
    protected $fillable = [
        'id_exhumacion',
        'id_encargado',
        'id_nicho',
        'motivo',
        'estado',
        'fecha_solicitado',
        'fecha_aprobacion',
        'fecha_inicio',
        'fecha_finalizacion',
    ];
}
