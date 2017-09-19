<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSgeAtividadesAtividadesStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('atividades_atividades_status', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idAtividades')->index('fk_atividades_has_atividades_status_atividades1_idx');
			$table->integer('idAtividadesStatus')->index('fk_atividades_has_atividades_status_atividades_status1_idx');
			$table->string('observacao')->nullable();
			$table->timestamps();
			$table->integer('salvoPor')->nullable()->index('fk_atividades_atividades_status_usuarios1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sge_atividades_atividades_status');
	}

}
