<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSgeLocaisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('locais', function(Blueprint $table)
		{
			$table->foreign('salvoPor', 'fk_locais_usuarios1')->references('id')->on('sge_usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idUnidades', 'fk_sge_locais_sge_unidades1')->references('id')->on('sge_unidades')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('locais', function(Blueprint $table)
		{
			$table->dropForeign('fk_locais_usuarios1');
			$table->dropForeign('fk_sge_locais_sge_unidades1');
		});
	}

}
