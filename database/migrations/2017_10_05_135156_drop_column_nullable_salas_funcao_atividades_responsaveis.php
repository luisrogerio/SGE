<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnNullableSalasFuncaoAtividadesResponsaveis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('atividades', function (Blueprint $table) {
            $table->dropColumn('funcaoResponsavel');
            $table->integer('idUnidades')->nullable()->change();
            $table->integer('idLocais')->nullable()->change();
            $table->integer('idSalas')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('atividades', function (Blueprint $table) {
            $table->string('funcaoResponsavel', 45)->nullable();
        });
    }
}
