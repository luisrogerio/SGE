<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSgeAtividadesStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('atividades_status', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nome', 45);
			$table->timestamps();
			$table->integer('salvoPor')->nullable()->index('fk_atividades_status_usuarios1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('atividades_status');
	}

}
