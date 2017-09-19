<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSgeSalasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('salas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idLocais')->index('fk_salas_locais1_idx');
			$table->string('nome', 45)->nullable();
			$table->timestamps();
			$table->integer('salvoPor')->nullable()->index('fk_sge_salas_sge_usuarios1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sge_salas');
	}

}
