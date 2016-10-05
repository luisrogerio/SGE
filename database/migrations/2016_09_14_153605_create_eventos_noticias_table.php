<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventosNoticiasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('eventos_noticias', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idEventos')->index('fk_enventos_noticias_eventos1_idx');
			$table->string('preview');
			$table->string('titulo', 45);
			$table->text('noticia');
			$table->dateTime('dataHoraPublicacao');
			$table->dateTime('dataHoraInicio')->nullable();
			$table->dateTime('dataHoraFim')->nullable();
			$table->timestamps();
			$table->integer('salvoPor')->nullable()->index('fk_enventos_noticias_usuarios1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('eventos_noticias');
	}

}
