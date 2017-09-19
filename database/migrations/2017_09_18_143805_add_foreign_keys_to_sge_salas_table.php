<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSgeSalasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('salas', function(Blueprint $table)
		{
			$table->foreign('idLocais', 'fk_salas_locais1')->references('id')->on('sge_locais')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('salvoPor', 'fk_sge_salas_sge_usuarios1')->references('id')->on('sge_usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('salas', function(Blueprint $table)
		{
			$table->dropForeign('fk_salas_locais1');
			$table->dropForeign('fk_sge_salas_sge_usuarios1');
		});
	}

}
