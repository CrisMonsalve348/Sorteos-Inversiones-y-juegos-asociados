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
          Schema::create('ruletazo_finalistas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_juego')->constrained('games')->onDelete('cascade');
            $table->foreignId('fk_cliente')->constrained('clients')->onDelete('cascade');
            $table->datetime('fecha_seleccion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruletazo_finalistas');
    }
};
