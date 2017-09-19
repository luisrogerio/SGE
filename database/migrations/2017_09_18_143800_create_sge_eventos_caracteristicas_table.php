<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSgeEventosCaracteristicasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('eventos_caracteristicas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idAparencias')->index('fk_eventos_configuracoes_aparencias1_idx');
			$table->integer('idEventos')->index('fk_eventos_caracteristicas_eventos1_idx');
			$table->boolean('eImagemDeFundo')->nullable();
			$table->string('background', 45)->nullable();
			$table->string('backgroundColor', 45)->nullable();
			$table->boolean('eEmiteCertificado');
			$table->date('dataLiberacaoCertificado')->nullable();
			$table->boolean('eExistemImagens')->nullable();
			$table->string('eExistemNoticias', 45)->nullable();
			$table->string('favicon', 45)->nullable();
			$table->string('logo', 45)->nullable();
			$table->boolean('eAcademico')->nullable();
			$table->boolean('ePropostaAtividade')->nullable();
			$table->boolean('eSubmissaoArtigo')->nullable();
			$table->timestamps();
			$table->integer('salvoPor')->nullable()->index('fk_eventos_caracteristicas_usuarios1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sge_eventos_caracteristicas');
	}

}
