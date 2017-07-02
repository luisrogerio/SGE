<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSgeAtividadesDatasHorasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('atividades_datas_horas', function(Blueprint $table)
		{
			$table->foreign('idAtividades', 'fk_atividadeHorario_atividades1')->references('id')->on('sge_atividades')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('salvoPor', 'fk_atividades_datas_usuarios1')->references('id')->on('sge_usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idLocais', 'fk_sge_atividades_datas_horarios_locais_sge_locais1')->references('id')->on('sge_locais')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idSalas', 'fk_sge_atividades_datas_horarios_locais_sge_salas1')->references('id')->on('sge_salas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idUnidades', 'fk_sge_atividades_datas_horarios_locais_sge_unidades1')->references('id')->on('sge_unidades')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('atividades_datas_horas', function(Blueprint $table)
		{
			$table->dropForeign('fk_atividadeHorario_atividades1');
			$table->dropForeign('fk_atividades_datas_usuarios1');
			$table->dropForeign('fk_sge_atividades_datas_horarios_locais_sge_locais1');
			$table->dropForeign('fk_sge_atividades_datas_horarios_locais_sge_salas1');
			$table->dropForeign('fk_sge_atividades_datas_horarios_locais_sge_unidades1');
		});
	}

}
