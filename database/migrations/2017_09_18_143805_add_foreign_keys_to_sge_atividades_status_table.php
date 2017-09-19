<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSgeAtividadesStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('atividades_status', function(Blueprint $table)
		{
			$table->foreign('salvoPor', 'fk_atividades_status_usuarios1')->references('id')->on('sge_usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('atividades_status', function(Blueprint $table)
		{
			$table->dropForeign('fk_atividades_status_usuarios1');
		});
	}

}
