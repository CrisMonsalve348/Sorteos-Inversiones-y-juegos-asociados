<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    protected $table = 'clients';
    protected $fillable = [
        'nombre',
        'numero_identificacion',
        'numero_telefono',
        'id_juego'

    ];
}
