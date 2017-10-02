<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSgeContatosEventosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contatos_eventos', function(Blueprint $table)
		{
            $table->foreign('salvoPor', 'fk_contatos_eventos_usuarios1')->references('id')->on('usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('idEventos', 'fk_eventos_contatos_has_eventos_eventos1')->references('id')->on('eventos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('idEventosContatos', 'fk_eventos_contatos_has_eventos_eventos_contatos1')->references('id')->on('eventos_contatos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contatos_eventos', function(Blueprint $table)
		{
			$table->dropForeign('fk_contatos_eventos_usuarios1');
			$table->dropForeign('fk_eventos_contatos_has_eventos_eventos1');
			$table->dropForeign('fk_eventos_contatos_has_eventos_eventos_contatos1');
		});
	}

}
