<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ganador extends Model
{
    protected $table = 'winners';

    public $timestamps = false;

    protected $fillable = [
        'fk_juego',
        'fk_cliente',
        'fecha_resultado',
        
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