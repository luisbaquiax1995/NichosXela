<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CausaMuerte extends Model
{
    //
    protected $table = 'causa_muerte';
    protected $primaryKey = 'id_causa_muerte';
    public $timestamps = false;
    protected $fillable = [
        'id_causa_muerte',
        'id_ocupante',
        'id_tipo_muerte'
    ];
}
