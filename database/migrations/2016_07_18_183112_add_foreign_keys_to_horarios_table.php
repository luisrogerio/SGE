<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHorariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('horarios', function(Blueprint $table)
		{
			$table->foreign('idAtividadesDatas', 'fk_horarios_atividades_datas1')->references('id')->on('atividades_datas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('horarios', function(Blueprint $table)
		{
			$table->dropForeign('fk_horarios_atividades_datas1');
		});
	}

}
