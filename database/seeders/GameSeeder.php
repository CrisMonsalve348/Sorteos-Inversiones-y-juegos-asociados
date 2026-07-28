<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $juego=[
            ['nombre'=>'ruletazo de X mes', 'descripcion'=>'Ruletazo de X evento', 'tipo_juego_id'=>1, 'cantidad_jugadores'=>100, 'estado'=>'en_curso', 'id_casino'=>1],
            ['nombre'=>'manotazo de X mes', 'descripcion'=>'Manotazo de X evento', 'tipo_juego_id'=>2, 'cantidad_jugadores'=>100, 'estado'=>'en_curso', 'id_casino'=>1],
            ['nombre'=>'manotazo de prueba', 'descripcion'=>'Manotazo de X evento', 'tipo_juego_id'=>2, 'cantidad_jugadores'=>3, 'estado'=>'en_curso', 'id_casino'=>1]






        ];
        foreach($juego as $j){
            \App\Models\Game::firstOrCreate(
                ['nombre' => $j['nombre']],
                [
                    'descripcion' => $j['descripcion'],
                    'tipo_juego_id' => $j['tipo_juego_id'],
                    'cantidad_jugadores' => $j['cantidad_jugadores'],
                    'estado' => $j['estado'],
                    'id_casino' => $j['id_casino']
                ]
            );
        }
    }
}
