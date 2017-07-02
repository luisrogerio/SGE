<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSgeAtividadesDatasHorasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('atividades_datas_horas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idAtividades')->index('fk_atividadeHorario_atividades1_idx');
			$table->integer('idUnidades')->index('fk_sge_atividades_datas_horarios_locais_sge_unidades1_idx');
			$table->integer('idLocais')->index('fk_sge_atividades_datas_horarios_locais_sge_locais1_idx');
			$table->integer('idSalas')->index('fk_sge_atividades_datas_horarios_locais_sge_salas1_idx');
			$table->date('data');
			$table->time('horarioInicio');
			$table->time('horarioTermino');
			$table->timestamps();
			$table->integer('salvoPor')->nullable()->index('fk_atividades_datas_usuarios1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sge_atividades_datas_horas');
	}

}
