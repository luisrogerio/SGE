<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSgeAtividadesCursosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('atividades_cursos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idCursos')->index('fk_atividades_has_cursos_cursos1_idx');
			$table->integer('idAtividades')->index('fk_atividades_has_cursos_atividades1_idx');
			$table->date('dataInicio')->nullable();
			$table->date('dataFim')->nullable();
			$table->timestamps();
			$table->integer('salvoPor')->nullable()->index('fk_atividades_cursos_usuarios1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sge_atividades_cursos');
	}

}
