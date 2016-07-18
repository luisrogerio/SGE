<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEventosImagensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('eventos_imagens', function(Blueprint $table)
		{
			$table->foreign('idEventos', 'fk_eventos_galerias_eventos1')->references('id')->on('eventos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('eventos_imagens', function(Blueprint $table)
		{
			$table->dropForeign('fk_eventos_galerias_eventos1');
		});
	}

}
