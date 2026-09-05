<?php

namespace Database\Seeders;

use App\Models\casino;
use App\Models\cliente;
use App\Models\Game;
use App\Models\TipoJuego;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $casino = casino::firstOrCreate(['nombre' => 'Money Games']);

        $juegos = [
            [
                'nombre' => 'Ruletazo de prueba',
                'descripcion' => 'Juego de ruletazo listo para probar con 100 clientes.',
                'tipo_juego' => 'Ruletazo',
                'cantidad_jugadores' => 100,
            ],
            [
                'nombre' => 'Manotazo de prueba',
                'descripcion' => 'Juego de manotazo listo para probar con 100 clientes.',
                'tipo_juego' => 'Manotazo',
                'cantidad_jugadores' => 100,
            ],
        ];

        foreach ($juegos as $config) {
            $tipoJuego = TipoJuego::where('nombre_juego', 'like', '%' . $config['tipo_juego'] . '%')->first();

            if (! $tipoJuego) {
                $this->command->warn("No se encontró el tipo de juego {$config['tipo_juego']}.");
                continue;
            }

            $juego = Game::firstOrCreate(
                ['nombre' => $config['nombre']],
                [
                    'descripcion' => $config['descripcion'],
                    'tipo_juego_id' => $tipoJuego->id,
                    'cantidad_jugadores' => $config['cantidad_jugadores'],
                    'estado' => 'en_curso',
                    'id_casino' => $casino->id,
                ]
            );

            $juego->update(['cantidad_jugadores' => $config['cantidad_jugadores']]);

            for ($i = 1; $i <= $config['cantidad_jugadores']; $i++) {
                $numeroIdentificacion = (string) (($juego->id * 1000) + $i);
                $numeroTelefono = (3146355214);

                cliente::firstOrCreate(
                    ['numero_identificacion' => $numeroIdentificacion],
                    [
                        'nombre' => "{$config['tipo_juego']} Cliente {$i}",
                        'numero_telefono' => $numeroTelefono,
                        'id_juego' => $juego->id,
                        'estado' => 'activo',
                    ]
                );
            }
        }
    }
}
