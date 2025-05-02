<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotosNicho extends Model
{
    //
    protected $table = 'foto_nicho';
    protected $primaryKey = 'id_foto';
    public $timestamps = false;
    protected $fillable = [
        'id_foto',
        'id_nicho',
        'archivo_foto',
    ];
}
