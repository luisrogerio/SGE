<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToConexoesExternasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('conexoes_externas', function(Blueprint $table)
		{
			$table->foreign('idUsuariosTipos', 'fk_conexoesExternas_usuarios_tipos1')->references('id')->on('usuarios_tipos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('salvoPor', 'fk_conexoes_externas_usuarios1')->references('id')->on('usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('conexoes_externas', function(Blueprint $table)
		{
			$table->dropForeign('fk_conexoesExternas_usuarios_tipos1');
			$table->dropForeign('fk_conexoes_externas_usuarios1');
		});
	}

}
