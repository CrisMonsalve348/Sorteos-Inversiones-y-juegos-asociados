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
            'numero_identificacion' => 'required|unique:clients|max:10',
            'telefono' => 'required|unique:clients|max:10',
            'id_juego' => 'required|exists:tipo_juegos,id'
        ]);

        cliente::create($request->all());

        return redirect()->route('clientes')->with('success', 'Cliente creado exitosamente.');



    }
}
