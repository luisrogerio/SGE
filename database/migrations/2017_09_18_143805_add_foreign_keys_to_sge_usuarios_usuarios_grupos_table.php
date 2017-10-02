<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSgeUsuariosUsuariosGruposTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('usuarios_usuarios_grupos', function(Blueprint $table)
		{
            $table->foreign('idUsuarios', 'fk_usuarios_grupos_has_usuarios_usuarios1')->references('id')->on('usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('idUsuariosGrupos', 'fk_usuarios_grupos_has_usuarios_usuarios_grupos1')->references('id')->on('usuarios_grupos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('usuarios_usuarios_grupos', function(Blueprint $table)
		{
			$table->dropForeign('fk_usuarios_grupos_has_usuarios_usuarios1');
			$table->dropForeign('fk_usuarios_grupos_has_usuarios_usuarios_grupos1');
		});
	}

}
