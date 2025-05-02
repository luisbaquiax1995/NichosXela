<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    /**
     * CREATE TABLE municipio(
  id_municipio INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre_municipio VARCHAR(200),
  id_depto INT NOT NULL,
  FOREIGN KEY (id_depto) REFERENCES departamento(id_depto)
);

     */
    protected $table = 'municipio';
    protected $primaryKey = 'id_municipio';
    public $timestamps = false;
    protected $fillable = ['id_municipio', 'nombre_municipio', 'id_depto'];    
}
