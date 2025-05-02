<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamento';
    protected $primaryKey = 'id_depto';
    public $timestamps = false;

    protected $fillable = [
        'id_depto',
        'nombre_departamento',
    ];
}
