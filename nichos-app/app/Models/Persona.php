<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{

    protected $table = 'persona';
    protected $primaryKey = 'id_persona';
    public $timestamps = false;

    protected $fillable = [
        'id_persona',
        'nombre1',
        'nombre2',
        'apellido1',
        'apellido2',
        'genero',
        'dpi'
    ];
}
