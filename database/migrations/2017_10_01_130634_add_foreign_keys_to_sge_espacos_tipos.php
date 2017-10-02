<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToSgeEspacosTipos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('espacos_tipos', function (Blueprint $table) {
            $table->foreign('salvoPor', 'fk_sge_espacos_tipos_sge_usuarios1')->references('id')->on('usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('espacos_tipos', function (Blueprint $table) {
            $table->dropForeign('fk_sge_espacos_tipos_sge_usuarios1');
        });
    }
}
