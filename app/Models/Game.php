<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'tipo_juego_id',
        'cantidad_jugadores',
        'estado',
        'id_casino'
    ];

    public function tipoJuego()
    {
        return $this->belongsTo(TipoJuego::class, 'tipo_juego_id');
    }

    public function casino()
    {
        return $this->belongsTo(Casino::class, 'id_casino');
    }
}
