<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttributePresencaToSgeEventosParticipantesTable extends Migration
{
    public function up()
    {
        Schema::table('eventos_participantes', function (Blueprint $table) {
            $table->boolean('presenca')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eventos_participantes', function (Blueprint $table) {
            $table->dropColumn('presenca');
        });
    }
}
