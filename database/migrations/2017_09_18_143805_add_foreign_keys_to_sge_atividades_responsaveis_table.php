<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSgeAtividadesResponsaveisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('atividades_responsaveis', function(Blueprint $table)
		{
			$table->foreign('idAtividades', 'fk_atividades_responsaveis_atividades1')->references('id')->on('sge_atividades')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('salvoPor', 'fk_atividades_responsaveis_usuarios1')->references('id')->on('sge_usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('atividades_responsaveis', function(Blueprint $table)
		{
			$table->dropForeign('fk_atividades_responsaveis_atividades1');
			$table->dropForeign('fk_atividades_responsaveis_usuarios1');
		});
	}

}
