<?php 

use Illuminate\Database\Seeder;

/**
* 
*/
class UserTableSeeder extends Seeder
{
	
	public function run()
	{
		\DB::table('users')->insert( array(

			'name' => 'Eidelman',
			'email' => 'eidel_hs@hotmail.com',
			'password' => \Hash::make('secret'),
			'created_at' =>  date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));
	}
}