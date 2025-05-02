<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boleta extends Model
{
    //
    protected $table = 'boleta';
    protected $primaryKey = 'correlativo';
    public $timestamps = false;
    protected $fillable = [
        'correlativo',
        'id_usuario',
        'costo',
        'archivo',
        'estado',
        'fecha_aprobacion',
        'fecha_solicitado'
    ];

    const COSTO = 600;
}
