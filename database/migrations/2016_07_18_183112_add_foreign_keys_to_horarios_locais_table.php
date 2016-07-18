<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHorariosLocaisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('horarios_locais', function(Blueprint $table)
		{
			$table->foreign('idHorarios', 'fk_locais_has_horarios_horarios1')->references('id')->on('horarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idLocais', 'fk_locais_has_horarios_locais1')->references('id')->on('locais')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('horarios_locais', function(Blueprint $table)
		{
			$table->dropForeign('fk_locais_has_horarios_horarios1');
			$table->dropForeign('fk_locais_has_horarios_locais1');
		});
	}

}
