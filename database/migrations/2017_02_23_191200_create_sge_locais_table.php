<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSgeLocaisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locais', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idUnidades')->index('fk_locais_unidades1_idx');
			$table->string('nome', 45);
			$table->timestamps();
			$table->integer('salvoPor')->nullable()->index('fk_locais_usuarios1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('locais');
	}

}
