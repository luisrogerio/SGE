<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSgeEventosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('eventos', function(Blueprint $table)
		{
			$table->foreign('idPai', 'fk_eventos_eventos1')->references('id')->on('sge_eventos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idEdicaoAnterior', 'fk_eventos_eventos2')->references('id')->on('sge_eventos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('salvoPor', 'fk_eventos_usuarios1')->references('id')->on('sge_usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
			$table->dropForeign('fk_eventos_usuarios1');
		});
	}

}
