<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSgeAtividadesCompeticoesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('atividades_competicoes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idAtividades')->index('fk_atividadesCompeticoes_atividades1_idx');
			$table->integer('quantidadeChaves')->nullable();
			$table->integer('quantidadeClassificadosPorChave')->nullable();
			$table->timestamps();
			$table->integer('salvoPor')->nullable()->index('fk_atividades_competicoes_usuarios1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('atividades_competicoes');
	}

}
