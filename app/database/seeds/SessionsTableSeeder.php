<?php

use Trails\Models\Session;

class SessionsTableSeeder extends Seeder {

	public function run() {
		Eloquent::unguard ();
		DB::table('sessions')->truncate();
		Session::create (array (
			'from' => '2014-01-01',
			'to' => '2014-01-01',
			'status' => 'PENDING',
			'description' => 'A day to dwell.'
		));

		Session::create (array (
			'from' => '2014-01-02',
			'to' => '2014-01-02',
			'status' => 'PLANNED',
			'description' => 'A day to remember.'
		));
	}
}