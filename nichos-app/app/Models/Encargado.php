<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encargado extends Model
{
    protected $table = 'encargado';
    protected $primaryKey = 'id_encargado';
    public $timestamps = false;
    protected $fillable = ['id_encargado','id_persona', 'id_usuario', 'correo', 'telefono', 'direccion'];
}
