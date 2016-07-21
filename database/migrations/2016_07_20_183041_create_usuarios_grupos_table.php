<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuariosGruposTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuarios_grupos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nome', 45)->unique('nome_UNIQUE');
			$table->dateTime('criadoEm')->nullable();
			$table->dateTime('modificadoEm')->nullable();
			$table->integer('salvoPor')->nullable()->index('fk_usuarios_grupos_usuarios1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuarios_grupos');
	}

}
