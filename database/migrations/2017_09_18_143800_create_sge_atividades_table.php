<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSgeAtividadesTable extends Migration {

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
            $table->integer('idUnidades')->index('fk_sge_atividades_sge_unidades1_idx');
            $table->integer('idLocais')->index('fk_sge_atividades_sge_locais1_idx');
            $table->integer('idSalas')->index('fk_sge_atividades_sge_salas1_idx');
			$table->string('nome', 45);
			$table->integer('quantidadeVagas')->nullable();
			$table->text('descricao')->nullable();
			$table->string('funcaoResponsavel', 45)->nullable();
			$table->timestamps();
			$table->integer('salvoPor')->nullable()->index('fk_atividades_usuarios1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sge_atividades');
	}

}
