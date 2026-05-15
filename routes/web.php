<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GamesController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //rutas para el perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //listado de usuarios
    Route::get('/user', [UserController::class, 'MostrarUsuarios'])->name('user');
    //rutas para los juegos
    Route::get('/games', [GamesController::class, 'mostrarJuegos'])->name('games');
    Route::post('/games', [GamesController::class, 'crearJuego'])->name('games.crear');
    Route::put('/games/{id}', [GamesController::class, 'actualizarJuego'])->name('editarJuego');

});



require __DIR__.'/auth.php';
