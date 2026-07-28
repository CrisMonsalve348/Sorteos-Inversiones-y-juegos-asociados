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
           Schema::create('winners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_juego')->constrained('games')->onDelete('cascade');
            $table->foreignId('fk_cliente')->constrained('clients')->onDelete('cascade');
            $table->dateTime('fecha_resultado');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
          Schema::dropIfExists('winners');
    }
};
