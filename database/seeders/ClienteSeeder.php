<?php

namespace Database\Seeders;

use App\Models\cliente;
use App\Models\Game;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $juego = Game::where('cantidad_jugadores', 100)->first();

        if (! $juego) {
            $this->command->warn('No se encontró un juego con 100 jugadores para asignar a los clientes.');
            return;
        }

        for ($i = 1; $i <= 100; $i++) {
            $numeroIdentificacion = 1000000 + $i;
            $numeroTelefono = 300000000 + $i;

            cliente::firstOrCreate(
                ['numero_identificacion' => (string) $numeroIdentificacion],
                [
                    'nombre' => "Cliente {$i}",
                    'numero_telefono' => (string) $numeroTelefono,
                    'id_juego' => $juego->id,
                    'estado' => 'activo',
                ]
            );
        }
    }
}
