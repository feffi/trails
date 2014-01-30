<?php

use Trails\Models\Session;

class SessionTableSeeder extends Seeder {

	public function run() {
		//Session::truncate();
		DB::table('sessions')->delete();
		Session::create (array (
			'from' => '2014-01-01',
			'to' => '2014-01-01',
			'status' => 'PENDING',
			'description' => 'A day to dwell.'
		));

		Session::create (array (
			'from' => '2014-01-02',
			'to' => '2014-01-02',
			'status' => 'PENDING',
			'description' => 'A day to remember.'
		));
	}
}