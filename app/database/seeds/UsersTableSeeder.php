<?php
use Trails\Models\User;

class UsersTableSeeder extends Seeder {

	public function run() {
		Eloquent::unguard ();
		DB::table ('users')->truncate();
		User::create (array (
			'firstname' => 'Kevin',
			'lastname' => 'Wennemuth',
			'username' => 'feffi',
			'email' => 'feffi@feffi.org',
			'password' => Hash::make ('test')
		));
		User::create (array (
			'firstname' => 'John',
			'lastname' => 'Tester',
			'username' => 'john',
			'email' => 'john@feffi.org',
			'password' => Hash::make ('john')
		));
	}
}