<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSgeUnidadesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('unidades', function(Blueprint $table)
		{
            $table->foreign('salvoPor', 'fk_sge_unidades_sge_usuarios1')->references('id')->on('usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('unidades', function(Blueprint $table)
		{
			$table->dropForeign('fk_sge_unidades_sge_usuarios1');
		});
	}

}
