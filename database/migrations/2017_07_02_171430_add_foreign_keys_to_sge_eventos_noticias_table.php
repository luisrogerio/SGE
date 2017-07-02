<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSgeEventosNoticiasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('eventos_noticias', function(Blueprint $table)
		{
			$table->foreign('idEventos', 'fk_enventos_noticias_eventos1')->references('id')->on('sge_eventos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('salvoPor', 'fk_enventos_noticias_usuarios1')->references('id')->on('sge_usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('eventos_noticias', function(Blueprint $table)
		{
			$table->dropForeign('fk_enventos_noticias_eventos1');
			$table->dropForeign('fk_enventos_noticias_usuarios1');
		});
	}

}
