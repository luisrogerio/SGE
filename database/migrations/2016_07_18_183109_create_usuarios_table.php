<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuarios', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idCursos')->index('fk_usuarios_curso1_idx');
			$table->integer('idUsuariosGrupos')->index('fk_usuarios_usuarios_grupos1_idx');
			$table->integer('idUsuariosTipos')->index('fk_usuarios_usuarios_tipos1_idx');
			$table->string('nome', 45)->nullable();
			$table->string('email', 45)->nullable();
			$table->date('dataNascimento');
			$table->string('login', 45);
			$table->string('senha', 60);
			$table->string('remember_token', 100)->nullable();
			$table->primary(['id','idUsuariosGrupos','idUsuariosTipos']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuarios');
	}

}
