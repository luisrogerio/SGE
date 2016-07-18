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
			$table->dropForeign('fk_eventos_configuracoes_aparencias1');
		});
	}

}
