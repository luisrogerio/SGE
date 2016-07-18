<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEquipesUsuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('equipes_usuarios', function(Blueprint $table)
		{
			$table->foreign('idEquipes', 'fk_equipes_has_usuarios_equipes1')->references('id')->on('equipes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idUsuarios', 'fk_equipes_has_usuarios_usuarios1')->references('id')->on('usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('equipes_usuarios', function(Blueprint $table)
		{
			$table->dropForeign('fk_equipes_has_usuarios_equipes1');
			$table->dropForeign('fk_equipes_has_usuarios_usuarios1');
		});
	}

}
