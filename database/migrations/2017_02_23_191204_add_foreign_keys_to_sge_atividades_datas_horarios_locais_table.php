<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSgeAtividadesDatasHorariosLocaisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('atividades_datas_horarios_locais', function(Blueprint $table)
		{
			$table->foreign('idAtividades', 'fk_atividadeHorario_atividades1')->references('id')->on('atividades')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('salvoPor', 'fk_atividades_datas_usuarios1')->references('id')->on('usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idUnidades', 'fk_atividades_datas_horarios_locais_unidades1')->references('id')->on('unidades')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('atividades_datas_horarios_locais', function(Blueprint $table)
		{
			$table->dropForeign('fk_atividadeHorario_atividades1');
			$table->dropForeign('fk_atividades_datas_usuarios1');
			$table->dropForeign('fk_atividades_datas_horarios_locais_unidades1');
		});
	}

}
