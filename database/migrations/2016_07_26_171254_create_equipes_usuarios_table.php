<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEquipesUsuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('equipes_usuarios', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idEquipes')->index('fk_equipes_has_usuarios_equipes1_idx');
			$table->integer('idUsuarios')->index('fk_equipes_has_usuarios_usuarios1_idx');
			$table->dateTime('criadoEm')->nullable();
			$table->dateTime('modificadoEm')->nullable();
			$table->integer('salvoPor')->nullable()->index('fk_equipes_usuarios_usuarios1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('equipes_usuarios');
	}

}
