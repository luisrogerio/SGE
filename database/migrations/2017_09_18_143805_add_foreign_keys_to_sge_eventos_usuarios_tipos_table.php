<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSgeEventosUsuariosTiposTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('eventos_usuarios_tipos', function(Blueprint $table)
		{
            $table->foreign('salvoPor', 'fk_eventos_usuarios_tipos_usuarios1')->references('id')->on('usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('idEventos', 'fk_usuarios_tipos_has_eventos_eventos1')->references('id')->on('eventos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('idUsuariosTipos', 'fk_usuarios_tipos_has_eventos_usuarios_tipos1')->references('id')->on('usuarios_tipos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('eventos_usuarios_tipos', function(Blueprint $table)
		{
			$table->dropForeign('fk_eventos_usuarios_tipos_usuarios1');
			$table->dropForeign('fk_usuarios_tipos_has_eventos_eventos1');
			$table->dropForeign('fk_usuarios_tipos_has_eventos_usuarios_tipos1');
		});
	}

}
