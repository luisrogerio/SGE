<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSgeUnidadesEventosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('unidades_eventos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idUnidades')->index('fk_sge_unidades_eventos_sge_unidades1_idx');
			$table->integer('idEventos')->index('fk_sge_unidades_eventos_sge_eventos1_idx');
			$table->timestamps();
			$table->integer('salvoPor')->nullable()->index('fk_sge_unidades_eventos_sge_usuarios1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sge_unidades_eventos');
	}

}
