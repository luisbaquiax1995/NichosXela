<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nicho extends Model
{


    protected $table = 'nicho';
    protected $primaryKey = 'codigo';
    public $timestamps = false;
    protected $fillable = [
        'codigo',
        'id_calle',
        'id_avenida',
        'estado',
        'status',
        'tipo',
    ];
}
