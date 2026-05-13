<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoJuegoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipo_juego=[
            ['nombre_juego'=>'Ruletazo', 'descripcion'=>'De una cantidad superior a 38 personas se van a sacar a los ya mencionados 38 finalistas que van a participar en el juego de ruleta final'],
            ['nombre_juego'=>'Manotazo', 'descripcion'=>'De un determinado número de personas se saca al azar a un ganador']


        ];
        foreach($tipo_juego as $juego){
            \App\Models\TipoJuego::firstOrCreate(
                ['nombre_juego' => $juego['nombre_juego']],
                ['descripcion' => $juego['descripcion']]
            );
        }
    }
}
