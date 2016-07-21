<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAparenciasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aparencias', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('tema', 45);
			$table->dateTime('criadoEm')->nullable();
			$table->dateTime('modificadoEm')->nullable();
			$table->integer('salvoPor')->nullable()->index('fk_aparencias_usuarios1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('aparencias');
	}

}
