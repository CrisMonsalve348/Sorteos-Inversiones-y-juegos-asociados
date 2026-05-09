<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@inversar.com',
            'role' => 'admin',
            'phone_number' => 1234567890,
            'password' => bcrypt('inversar123'),
           

        ]);

        $this->call([
            CasinosSeeder::class,
        ]);
    }
}
