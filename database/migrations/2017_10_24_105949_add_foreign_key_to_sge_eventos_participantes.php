<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToSgeEventosParticipantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eventos_participantes', function(Blueprint $table)
        {
            $table->foreign('idEventos', 'fk_sge_eventos_participantes_sge_eventos1')->references('id')->on('eventos')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('idUsuarios', 'fk_sge_eventos_participantes_sge_usuarios1')->references('id')->on('usuarios')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eventos_participantes', function(Blueprint $table)
        {
            $table->dropForeign('fk_sge_eventos_participantes_sge_eventos1');
            $table->dropForeign('fk_sge_eventos_participantes_sge_usuarios1');
        });
    }
}
