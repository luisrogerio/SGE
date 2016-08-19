<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConexoesExternasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('conexoes_externas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idUsuariosTipos')->index('fk_conexoesExternas_usuarios_tipos1_idx');
			$table->string('driver', 20);
			$table->string('host', 45);
			$table->string('login', 20);
			$table->string('senha', 20);
			$table->timestamps();
			$table->integer('salvoPor')->nullable()->index('fk_conexoes_externas_usuarios1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('conexoes_externas');
	}

}
