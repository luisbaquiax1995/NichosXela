<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calle extends Model
{
    //
    protected $table = 'calle';
    protected $primaryKey = 'id_calle';
    public $timestamps = false;
    protected $fillable = [
        'id_calle',
        'nombre_calle',
        'numero_calle',
        'tipo'
    ];
    const CALLE = 'CALLE';
    const AVENIDA  = 'AVENIDA';

}
