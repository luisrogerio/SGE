<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateParametrizacoesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('parametrizacoes', function(Blueprint $table)
		{
			$table->integer('id')->primary();
			$table->boolean('eAlunoBancoExterno')->nullable();
			$table->string('stringConexaoAluno', 45)->nullable();
			$table->boolean('eServidorBancoExterno')->nullable();
			$table->string('stringConexaoServidor', 45)->nullable();
			$table->string('loginConexaoExterna', 45)->nullable();
			$table->string('senhaConexaoExterna', 45)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('parametrizacoes');
	}

}
