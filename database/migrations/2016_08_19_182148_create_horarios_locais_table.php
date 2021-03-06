<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHorariosLocaisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('horarios_locais', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idHorarios')->index('fk_locais_has_horarios_horarios1_idx');
			$table->timestamps();
			$table->integer('salvoPor')->nullable()->index('fk_horarios_locais_usuarios1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('horarios_locais');
	}

}
