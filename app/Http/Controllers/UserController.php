<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    
    public function MostrarUsuarios(){
        $users = User::all();
        return view('user', compact('users'));
    }

}
