<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSgeAtividadesResponsaveisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('atividades_responsaveis', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idAtividades')->index('fk_atividades_responsaveis_atividades1_idx');
			$table->string('nome', 255);
			$table->string('titulacao', 255)->nullable();
			$table->string('instituicaoOrigem', 255)->nullable();
			$table->text('experienciaProfissional', 65535)->nullable();
			$table->timestamps();
			$table->integer('salvoPor')->nullable()->index('fk_atividades_responsaveis_usuarios1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sge_atividades_responsaveis');
	}

}
