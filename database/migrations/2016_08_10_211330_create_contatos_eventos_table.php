<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContatosEventosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contatos_eventos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idEventosContatos')->index('fk_eventos_contatos_has_eventos_eventos_contatos1_idx');
			$table->integer('idEventos')->index('fk_eventos_contatos_has_eventos_eventos1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contatos_eventos');
	}

}
