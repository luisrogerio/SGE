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
			$table->integer('id', true);
			$table->integer('idEdicaoAnterior')->nullable()->index('fk_eventos_eventos2_idx');
			$table->integer('idPai')->nullable()->index('fk_eventos_eventos1_idx');
			$table->string('nome', 45);
			$table->dateTime('dataInicioInscricao');
			$table->dateTime('dataFimInscricao');
			$table->dateTime('dataInicio');
			$table->dateTime('dataTermino');
			$table->text('descricao')->nullable();
			$table->dateTime('criadoEm')->nullable();
			$table->dateTime('modificadoEm')->nullable();
			$table->integer('salvoPor')->nullable()->index('fk_eventos_usuarios1_idx');
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
