<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoMuerte extends Model
{
    /**
     * CREATE TABLE tipo_muerte(
  id_tipo_muerte INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  descripcion VARCHAR(200)
);
     */
    protected $table = 'tipo_muerte';
    protected $primaryKey = 'id_tipo_muerte';
    public $timestamps = false;
    protected $fillable = ['id_tipo_muerte','descripcion'];
}
