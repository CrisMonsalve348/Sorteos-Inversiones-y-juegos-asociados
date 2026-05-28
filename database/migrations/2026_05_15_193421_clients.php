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
        Schema::create('clients', function (Blueprint $table){


                $table->id();
                $table->string('nombre');
                $table->string('numero_identificacion')->unique();
                $table->string('numero_telefono')->unique();
                $table->timestamps();
                $table->foreignId('id_juego')
                ->constrained('games')
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
