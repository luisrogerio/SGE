<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSgeLinksExternosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('links_externos', function(Blueprint $table)
		{
			$table->foreign('idEventos', 'fk_links_externos_eventos1')->references('id')->on('sge_eventos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('salvoPor', 'fk_sge_links_externos_sge_usuarios1')->references('id')->on('sge_usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('links_externos', function(Blueprint $table)
		{
			$table->dropForeign('fk_links_externos_eventos1');
			$table->dropForeign('fk_sge_links_externos_sge_usuarios1');
		});
	}

}
