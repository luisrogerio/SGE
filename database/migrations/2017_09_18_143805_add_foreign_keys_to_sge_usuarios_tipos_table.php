<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSgeUsuariosTiposTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('usuarios_tipos', function(Blueprint $table)
		{
			$table->foreign('salvoPor', 'fk_usuarios_tipos_usuarios1')->references('id')->on('sge_usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('usuarios_tipos', function(Blueprint $table)
		{
			$table->dropForeign('fk_usuarios_tipos_usuarios1');
		});
	}

}
