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
        Schema::create('campeonatos_players_incritos', function (Blueprint $table) {
            $table->id();
            $table->string('id_campeonato');
            $table->string('id_equipe');
            $table->string('coach')->nullable();
            $table->string('capitao');
            $table->string('player1');
            $table->string('player2');
            $table->string('player3');
            $table->string('player4');
            $table->string('reserva1')->nullable();
            $table->string('reserva2')->nullable();
            $table->string('reserva3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campeonatos_players_incritos');
    }
};
