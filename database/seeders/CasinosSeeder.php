<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\casino;

class CasinosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $casinos=[
        [ 'nombre' => 'Money Games'],
        [ 'nombre' => 'Texas'],
        [ 'nombre' => 'Wild Joker'],
        [ 'nombre' => 'Esmerarda'],


        ];

        foreach($casinos as $casino){
            casino::firstOrCreate(
                ['nombre' => $casino['nombre']],



            );
        }
    }
}
