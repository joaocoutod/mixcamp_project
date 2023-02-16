<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams_membros', function (Blueprint $table) {
            $table->id();
            $table->integer('id_equipe');
            $table->string('nome');
            $table->string('funcao');
            $table->text('link_faceit');
            $table->text('link_steam');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams_membros');
    }
};
