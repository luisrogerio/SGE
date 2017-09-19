<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSgeEventosImagensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('eventos_imagens', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idEventos')->index('fk_eventos_galerias_eventos1_idx');
			$table->string('imagem', 128);
			$table->string('thumbnail', 128)->nullable();
			$table->date('dataDaImagem')->nullable();
			$table->text('descricao', 65535)->nullable();
			$table->timestamps();
			$table->integer('salvoPor')->nullable()->index('fk_eventos_imagens_usuarios1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sge_eventos_imagens');
	}

}
