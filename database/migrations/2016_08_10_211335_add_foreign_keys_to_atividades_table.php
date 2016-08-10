<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAtividadesTable extends Migration {

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
		});
	}

}
