<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSgeLinksExternosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('links_externos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idEventos')->index('fk_links_externos_eventos1_idx');
			$table->string('descricao', 45)->nullable();
			$table->string('url', 60)->nullable();
			$table->timestamps();
			$table->integer('salvoPor')->nullable()->index('fk_sge_links_externos_sge_usuarios1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sge_links_externos');
	}

}
