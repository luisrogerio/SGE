<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSgeEventosParticipantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos_participantes', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->integer('idEventos')->index('fk_sge_eventos_participantes_sge_eventos1');
            $table->integer('idUsuarios')->index('fk_sge_eventos_participantes_sge_usuarios1');
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
        Schema::drop('eventos_participantes');
    }
}
