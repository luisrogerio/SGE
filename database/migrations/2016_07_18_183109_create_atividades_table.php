<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAtividadesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('atividades', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idEventos')->index('fk_atividades_eventos_idx');
			$table->integer('idAtividadesTipos')->index('fk_atividades_atividades_tipos1_idx');
			$table->string('nome', 45);
			$table->integer('quantidadeVagas')->nullable();
			$table->text('descricao')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('atividades');
	}

}
