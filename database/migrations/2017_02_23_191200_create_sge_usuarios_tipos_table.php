<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSgeUsuariosTiposTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuarios_tipos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nome', 45)->unique('nome_UNIQUE');
			$table->timestamps();
			$table->integer('salvoPor')->nullable()->index('fk_usuarios_tipos_usuarios1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuarios_tipos');
	}

}
