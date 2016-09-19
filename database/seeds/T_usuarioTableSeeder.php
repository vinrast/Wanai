<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class T_usuarioTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		 \DB::table('t_usuario')->insert(array( 
		 	'email'=> 'vinrast@gmail.com',
		 	'password'=> \Hash::make('123456')

		 ));
	}

}
