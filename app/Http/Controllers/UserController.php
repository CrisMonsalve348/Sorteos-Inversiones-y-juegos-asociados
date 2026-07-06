<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    
    public function MostrarUsuarios(){
        $users= User::where('status', 'active')->get();
        return view('user', compact('users'));
    }
    public function actualizarUsuario(Request $request, $id) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'phone_number' => 'required|digits:10|unique:users,phone_number,' . $id,
        'role' => 'required|in:admin,worker',
    ]);

    $user = User::findOrFail($id);
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone_number' => $request->phone_number,
        'role' => $request->role,
    ]);

    return redirect()->route('user')->with('success', 'Usuario actualizado correctamente.');
}
public function bloquearUsuario($id) {
    $user = User::findOrFail($id);
    $user->update(['status' => 'inactive']);
    return redirect()->route('user')->with('success', 'Usuario bloqueado correctamente.');
}
}
