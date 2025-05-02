<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id_anterior
 */
class Contrato extends Model
{
    //
    protected $table = 'contrato';
    protected $primaryKey = 'id_contrato';
    public $timestamps = false;
    protected $fillable = [
        'id_contrato',
        'id_anteriro',
        'id_boleta',
        'id_encargado',
        'id_ocupante',
        'id_nicho',
        'estado',
        'fecha_inicio',
        'fecha_finalizacion',
        'fecha_limite'
    ];
}
