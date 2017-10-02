<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSgeAtividadesCursosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('atividades_cursos', function(Blueprint $table)
		{
            $table->foreign('salvoPor', 'fk_atividades_cursos_usuarios1')->references('id')->on('usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('idAtividades', 'fk_atividades_has_cursos_atividades1')->references('id')->on('atividades')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('idCursos', 'fk_atividades_has_cursos_cursos1')->references('id')->on('cursos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('atividades_cursos', function(Blueprint $table)
		{
			$table->dropForeign('fk_atividades_cursos_usuarios1');
			$table->dropForeign('fk_atividades_has_cursos_atividades1');
			$table->dropForeign('fk_atividades_has_cursos_cursos1');
		});
	}

}
