<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('eventos', function(Blueprint $table)
		{
			$table->integer('id')->primary();
			$table->integer('idEdicaoAnterior')->nullable()->index('fk_eventos_eventos2_idx');
			$table->integer('idEventosCaracteristicas')->index('fk_eventos_eventos_configuracoes1_idx');
			$table->integer('idPai')->nullable()->index('fk_eventos_eventos1_idx');
			$table->string('nome', 45);
			$table->dateTime('dataInicioInscricao');
			$table->dateTime('dataFimInscricao');
			$table->dateTime('dataInicio');
			$table->dateTime('dataFim');
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
		Schema::drop('eventos');
	}

}
