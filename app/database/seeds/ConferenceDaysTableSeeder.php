<?php

class ConferenceDaysTableSeeder extends Seeder {

	public function run() {
		DB::table ('conferenceDays')->delete ();

		ConferenceDay::create (array (
			'from' => '2014-01-01 08:00:00',
			'to' => '2014-01-01 16:00:00',
			'status' => 'PENDING',
			'description' => 'A day to dwell.'
		));

		ConferenceDay::create (array (
			'from' => '2014-01-02 08:00:00',
			'to' => '2014-01-02 16:00:00',
			'status' => 'PENDING',
			'description' => 'A day to remember.'
		));
	}
}