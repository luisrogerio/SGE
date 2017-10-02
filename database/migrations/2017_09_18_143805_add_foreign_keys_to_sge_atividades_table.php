<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSgeAtividadesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('atividades', function(Blueprint $table)
		{
            $table->foreign('idAtividadesTipos', 'fk_atividades_atividades_tipos1')->references('id')->on('atividades_tipos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('idEventos', 'fk_atividades_eventos')->references('id')->on('eventos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('salvoPor', 'fk_atividades_usuarios1')->references('id')->on('usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('idLocais', 'fk_sge_atividades_sge_locais1')->references('id')->on('locais')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('idSalas', 'fk_sge_atividades_sge_salas1')->references('id')->on('salas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('idUnidades', 'fk_sge_atividades_sge_unidades1')->references('id')->on('unidades')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('atividades', function(Blueprint $table)
		{
			$table->dropForeign('fk_atividades_atividades_tipos1');
			$table->dropForeign('fk_atividades_eventos');
			$table->dropForeign('fk_atividades_usuarios1');
            $table->dropForeign('fk_sge_atividades_sge_locais1');
            $table->dropForeign('fk_sge_atividades_sge_salas1');
            $table->dropForeign('fk_sge_atividades_sge_unidades1');
		});
	}

}
