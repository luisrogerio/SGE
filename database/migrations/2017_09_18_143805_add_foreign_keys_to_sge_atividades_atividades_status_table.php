<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSgeAtividadesAtividadesStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('atividades_atividades_status', function(Blueprint $table)
		{
			$table->foreign('salvoPor', 'fk_atividades_atividades_status_usuarios1')->references('id')->on('sge_usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idAtividades', 'fk_atividades_has_atividades_status_atividades1')->references('id')->on('sge_atividades')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idAtividadesStatus', 'fk_atividades_has_atividades_status_atividades_status1')->references('id')->on('sge_atividades_status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('atividades_atividades_status', function(Blueprint $table)
		{
			$table->dropForeign('fk_atividades_atividades_status_usuarios1');
			$table->dropForeign('fk_atividades_has_atividades_status_atividades1');
			$table->dropForeign('fk_atividades_has_atividades_status_atividades_status1');
		});
	}

}
