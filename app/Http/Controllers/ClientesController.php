<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cliente;
use App\Models\Game;
class ClientesController extends Controller
{
    public function mostrarClientes(){
        $clientes = cliente::with('juego')->where('estado', 'activo')->get();
        $juegos = Game::where('estado', 'en_curso')->get();
        return view('clientes', compact('clientes','juegos'));
    }

    public function crearCliente(Request $request){
        $request->validate([
            'nombre' => 'required|string|max:255',
            'numero_identificacion' => 'required|unique:clients|min:7|max:10',
            'numero_telefono' => 'required|unique:clients|max:10',
            'id_juego' => 'required'
        ]);

        $juego = Game::findOrFail($request->id_juego);

        $clientesactuales = cliente::where('id_juego', $request->id_juego)->count();
        if($clientesactuales >= $juego->cantidad_jugadores) {
            return redirect()->back()
            ->with('error', 'No se pueden agregar más clientes a este juego, se ha alcanzado el limite de jugadores.')
            ->withInput();
        }

        cliente::create($request->all());

        return redirect()->route('clientes')->with('success', 'Cliente creado exitosamente.');



    }
    public function actualizarCliente(Request $request, $id) {
    $request->validate([
        'nombre' => 'required|string|max:255',
        'numero_identificacion' => 'required|string|max:20|unique:clients,numero_identificacion,' . $id,
        'numero_telefono' => 'required|digits:10|unique:clients,numero_telefono,' . $id,
        'id_juego' => 'required|exists:games,id',
    ]);

    $cliente = cliente::findOrFail($id);
    $cliente->update([
        'nombre' => $request->nombre,
        'numero_identificacion' => $request->numero_identificacion,
        'numero_telefono' => $request->numero_telefono,
        'id_juego' => $request->id_juego,
    ]);

    return redirect()->route('clientes')->with('success', 'Cliente actualizado correctamente.');
}

// ClientesController
public function bloquearCliente($id) {
    $cliente = cliente::findOrFail($id);
    $cliente->update(['estado' => 'bloqueado']);
    return redirect()->route('clientes')->with('success', 'Cliente bloqueado correctamente.');
}
}
