<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEventosCaracteristicasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('eventos_caracteristicas', function(Blueprint $table)
		{
			$table->foreign('idEventos', 'fk_eventos_caracteristicas_eventos1')->references('id')->on('eventos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('salvoPor', 'fk_eventos_caracteristicas_usuarios1')->references('id')->on('usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idAparencias', 'fk_eventos_configuracoes_aparencias1')->references('id')->on('aparencias')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('eventos_caracteristicas', function(Blueprint $table)
		{
			$table->dropForeign('fk_eventos_caracteristicas_eventos1');
			$table->dropForeign('fk_eventos_caracteristicas_usuarios1');
			$table->dropForeign('fk_eventos_configuracoes_aparencias1');
		});
	}

}
