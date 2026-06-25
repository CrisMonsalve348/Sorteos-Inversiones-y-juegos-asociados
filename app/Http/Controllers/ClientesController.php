<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cliente;
use App\Models\Game;
class ClientesController extends Controller
{
    public function mostrarClientes(){
        $clientes=cliente::all();
        $juegos=Game::all();
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
}
