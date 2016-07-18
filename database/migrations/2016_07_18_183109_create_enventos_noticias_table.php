<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEnventosNoticiasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('enventos_noticias', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idEventos')->index('fk_enventos_noticias_eventos1_idx');
			$table->string('preview');
			$table->string('titulo', 45);
			$table->text('noticia');
			$table->dateTime('dataHoraPublicacao');
			$table->dateTime('dataHoraInicio')->nullable();
			$table->dateTime('dataHoraFim')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('enventos_noticias');
	}

}
