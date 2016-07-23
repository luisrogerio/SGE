<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAtividadesParticipantesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('atividades_participantes', function(Blueprint $table)
		{
			$table->foreign('idAtividades', 'fk_atividades_has_participantes_atividades1')->references('id')->on('atividades')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idUsuarios', 'fk_atividades_participantes_usuarios1')->references('id')->on('usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('salvoPor', 'fk_atividades_participantes_usuarios2')->references('id')->on('usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('atividades_participantes', function(Blueprint $table)
		{
			$table->dropForeign('fk_atividades_has_participantes_atividades1');
			$table->dropForeign('fk_atividades_participantes_usuarios1');
			$table->dropForeign('fk_atividades_participantes_usuarios2');
		});
	}

}
