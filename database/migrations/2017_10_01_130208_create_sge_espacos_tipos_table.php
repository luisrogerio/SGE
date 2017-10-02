<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSgeEspacosTiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('espacos_tipos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nome', 45);
            $table->timestamps();
            $table->integer('salvoPor')->nullable()->index('fk_sge_espacos_tipos_sge_usuarios1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('espacos_tipos');
    }
}
