<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuletazoFinalista extends Model
{
    protected $table = 'ruletazo_finalistas';

    protected $fillable = [
        'fk_juego',
        'fk_cliente',
        'fecha_seleccion',
    ];

    public function juego()
    {
        return $this->belongsTo(Game::class, 'fk_juego');
    }

    public function cliente()
    {
        return $this->belongsTo(cliente::class, 'fk_cliente');
    }
}