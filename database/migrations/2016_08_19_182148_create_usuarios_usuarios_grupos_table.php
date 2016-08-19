<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuariosUsuariosGruposTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuarios_usuarios_grupos', function(Blueprint $table)
		{
			$table->integer('id')->primary();
			$table->integer('idUsuariosGrupos')->index('fk_usuarios_grupos_has_usuarios_usuarios_grupos1_idx');
			$table->integer('idUsuarios')->index('fk_usuarios_grupos_has_usuarios_usuarios1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuarios_usuarios_grupos');
	}

}
