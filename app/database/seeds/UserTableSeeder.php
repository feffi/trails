<?php

class UserTableSeeder extends Seeder {

	public function run() {
		DB::table ('users')->delete ();
		UserModel::create (array (
				'firstname' => 'Kevin',
				'lastname' => 'Wennemuth',
				'username' => 'feffi',
				'email' => 'feffi@feffi.org',
				'password' => Hash::make ('test')
		));
	}
}