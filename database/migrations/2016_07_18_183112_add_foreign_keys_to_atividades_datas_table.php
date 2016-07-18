<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAtividadesDatasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('atividades_datas', function(Blueprint $table)
		{
			$table->foreign('idAtividades', 'fk_atividadeHorario_atividades1')->references('id')->on('atividades')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('atividades_datas', function(Blueprint $table)
		{
			$table->dropForeign('fk_atividadeHorario_atividades1');
		});
	}

}
