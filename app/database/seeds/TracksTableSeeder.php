<?php

class TracksTableSeeder extends Seeder {

	public function run() {

		DB::table ('tracks')->delete ();
		Track::create (array (
			'name' => 'git at it\'s best',
			'status' => 'PENDING',
			'id_conference' => ConferenceDay::where('description', '=', 'A day to dwell.'),
			'description' => 'A little course for all n3wbs on how to use git.'
		));
/*
		Track::create (array (
			'name' => 'another very important session',
			'status' => 'PLANNED',
			'id_conference' => ConferenceDay::where('description', '=', 'A day to dwell.'),
			'description' => 'Very very important!'
		));

		Track::create (array (
			'name' => 'A planned session',
			'status' => 'PLANNED',
			'id_conference' => ConferenceDay::where('description', '=', 'A day to remember.'),
			'description' => 'Very very planned!'
		));

		*/
	}
}