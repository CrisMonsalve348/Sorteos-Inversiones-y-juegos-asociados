<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\TipoJuego;
use App\Models\casino;

class GamesController extends Controller
{
   public function mostrarJuegos(){
    $games = Game::where('estado', 'en_curso')->get();
    $tipo_juego = TipoJuego::all();
    $casinos = casino::all();
    return view('games', compact('games', 'tipo_juego', 'casinos'));
}
    public function crearJuego(Request $request){
        $request->validate([
            'nombre'=> 'required|string|max:255',
            'descripcion'=> 'required|string|max:1000',
            'tipo_juego'=> 'required|exists:tipo_juegos,id',
            'cantidad_jugadores'=> 'required|integer',
            'casino'=> 'required|exists:casinos,id',


        ]);

        Game::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'tipo_juego_id' => $request->tipo_juego,
            'cantidad_jugadores' => $request->cantidad_jugadores,
            'id_casino' => $request->casino,
        ]);
         return redirect()->route('games')->with('success', 'Juego creado exitosamente.');


        
    }

    public function actualizarJuego(Request $request, $id){
        $request->validate([
        'nombre'=>'required|string|max:255',
        'descripcion'=>'required|string|max:1000',
        'tipo_juego'=>'required|exists:tipo_juegos,id',
        'cantidad_jugadores'=>'required|integer',
        'casino'=>'required|exists:casinos,id',






        ]);

        $game = Game::findOrFail($id);
        $game->update([
            'nombre' => $request->nombre,
            'descripcion'=> $request->descripcion,
            'tipo_juego_id' => $request->tipo_juego,
            'cantidad_jugadores' => $request->cantidad_jugadores,
            'id_casino' => $request->casino,
    ]); 

    return redirect()->route('games')->with('success', 'Juego actualizado exitosamente.');


    }

    public function bloquearJuego($id) {
    $game = Game::findOrFail($id);
    $game->update(['estado' => 'bloqueado']);
    return redirect()->route('games')->with('success', 'Juego bloqueado correctamente.');
}
}
