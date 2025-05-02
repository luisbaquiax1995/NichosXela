<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{

    protected $table = 'empleado';
    protected $primaryKey = 'id_empleado';
    public $timestamps = false;

    protected $fillable = [
        'id_empleado',
        'id_persona',
        'id_usuario',
    ];
}
