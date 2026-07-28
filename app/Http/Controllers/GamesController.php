<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\TipoJuego;
use App\Models\casino;
use App\Models\Ganador;
use App\Models\RuletazoFinalista;

class GamesController extends Controller
{
   public function mostrarJuegos(){
    $games = Game::where('estado', 'en_curso')->with('clientes')->get();
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

public function ejecutarJuego($id){
    $juego = Game::with(['clientes', 'tipoJuego'])->findOrFail($id);
       

        // Paso 1 - verificar estado
    if ($juego->estado !== 'en_curso') {
        return redirect()->route('games')
            ->with('error', 'Este juego no está activo.');
    }
    // Paso 2 - verificar cupo
    if ($juego->clientes->count() < $juego->cantidad_jugadores) {
        return redirect()->route('games')
            ->with('error', 'El juego no tiene el cupo completo.');
    }

    // Paso 3 - bifurcar según tipo
    if ($juego->tipoJuego->nombre_juego === 'Ruletazo') {
        return $this->ejecutarRuletazo($juego);
    } else {
        return $this->ejecutarManotazo($juego);
    }

}
private function ejecutarRuletazo($juego) {
    $finalistas = $juego->clientes->random(38);

    foreach ($finalistas as $cliente) {
        RuletazoFinalista::create([
            'fk_juego' => $juego->id,
            'fk_cliente' => $cliente->id,
            'fecha_seleccion' => now(),
        ]);
    }

    $juego->update(['estado' => 'finalizado']);

    return redirect()->route('games.resultado', $juego->id);
}
private function ejecutarManotazo($juego) {
    $ganador = $juego->clientes->random();

    Ganador::create([
        'fk_juego' => $juego->id,
        'fk_cliente' => $ganador->id,
        'fecha_resultado' => now(),
        'notificado' => false,
    ]);

    $juego->update(['estado' => 'finalizado']);

    // Aquí va la lógica de WhatsApp que veremos después

    return redirect()->route('games');
}
}
