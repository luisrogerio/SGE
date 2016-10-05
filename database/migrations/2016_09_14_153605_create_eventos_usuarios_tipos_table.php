<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventosUsuariosTiposTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('eventos_usuarios_tipos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idEventos')->index('fk_usuarios_tipos_has_eventos_eventos1_idx');
			$table->integer('idUsuariosTipos')->index('fk_usuarios_tipos_has_eventos_usuarios_tipos1_idx');
			$table->timestamps();
			$table->integer('salvoPor')->nullable()->index('fk_eventos_usuarios_tipos_usuarios1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('eventos_usuarios_tipos');
	}

}
