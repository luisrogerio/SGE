<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEventosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('eventos', function(Blueprint $table)
		{
			$table->foreign('idPai', 'fk_eventos_eventos1')->references('id')->on('eventos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idEdicaoAnterior', 'fk_eventos_eventos2')->references('id')->on('eventos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idEventosCaracteristicas', 'fk_eventos_eventos_caracteristicas1')->references('id')->on('eventos_caracteristicas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('eventos', function(Blueprint $table)
		{
			$table->dropForeign('fk_eventos_eventos1');
			$table->dropForeign('fk_eventos_eventos2');
			$table->dropForeign('fk_eventos_eventos_caracteristicas1');
		});
	}

}
