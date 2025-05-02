<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ocupante extends Model
{
    protected $table = 'ocupante';
    protected $primaryKey = 'id_ocupante';
    public $timestamps = false;

    protected $fillable = [
        'id_persona',
        'fecha_nacimiento',
        'fecha_fallecimiento',
        'procedencia',
        'id_municipio',
        'estado',
        'tipo'
    ];

    public function persona(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }

    public function municipio(){
        return $this->belongsTo(Municipio::class, 'id_municipio');
    }
}
