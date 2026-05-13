<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->foreignId('tipo_juego_id')
            ->constrained('tipo_juegos')
            ->onDelete('cascade');
            $table->integer('cantidad_jugadores');
            $table->timestamps();
            $table->enum('estado', ['en_curso', 'finalizado'])->default('en_curso');
            $table->foreignId('id_casino')
            ->constrained('casinos')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
