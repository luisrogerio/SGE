<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEquipesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('equipes', function(Blueprint $table)
		{
			$table->foreign('idAtividadesCompeticoes', 'fk_equipes_atividadesCompeticoes1')->references('id')->on('atividades_competicoes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('equipes', function(Blueprint $table)
		{
			$table->dropForeign('fk_equipes_atividadesCompeticoes1');
		});
	}

}
