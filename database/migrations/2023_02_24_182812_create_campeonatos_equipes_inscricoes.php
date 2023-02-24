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
        Schema::create('campeonatos_equipes_inscricoes', function (Blueprint $table) {
            $table->id();
            $table->string('id_campeonato');
            $table->string('id_equipe');
            $table->integer('qtd_reservas');
            $table->string('status_pagamento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campeonatos_equipes_inscricoes');
    }
};
