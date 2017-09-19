<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSgeUnidadesEventosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('unidades_eventos', function(Blueprint $table)
		{
			$table->foreign('idEventos', 'fk_sge_unidades_eventos_sge_eventos1')->references('id')->on('sge_eventos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idUnidades', 'fk_sge_unidades_eventos_sge_unidades1')->references('id')->on('sge_unidades')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('salvoPor', 'fk_sge_unidades_eventos_sge_usuarios1')->references('id')->on('sge_usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('unidades_eventos', function(Blueprint $table)
		{
			$table->dropForeign('fk_sge_unidades_eventos_sge_eventos1');
			$table->dropForeign('fk_sge_unidades_eventos_sge_unidades1');
			$table->dropForeign('fk_sge_unidades_eventos_sge_usuarios1');
		});
	}

}
