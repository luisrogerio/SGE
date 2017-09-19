<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSgeAtividadesParticipantesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('atividades_participantes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idAtividades')->index('fk_atividades_has_participantes_atividades1_idx');
			$table->integer('idUsuarios')->index('fk_atividades_participantes_usuarios1_idx');
			$table->boolean('presenca')->nullable();
			$table->timestamps();
			$table->integer('salvoPor')->nullable()->index('fk_atividades_participantes_usuarios2_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sge_atividades_participantes');
	}

}
