<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_usuarios', function(Blueprint $table)
		{
			$table->increments('id_usuario');
			$table->string('correo_usuario')->unique();
			$table->string('clave_usuario', 60);
			$table->integer('status_usuario');
			$table->boolean('habilitado');
			$table->integer('online_usuario');
			$table->boolean('habilitado_usuario');
			$table->rememberToken();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('t_usuarios');
	}

}
