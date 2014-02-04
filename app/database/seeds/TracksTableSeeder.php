<?php

use Trails\Models\Track;

class TracksTableSeeder extends Seeder {

	public function run() {
		Eloquent::unguard ();
		DB::table ('tracks')->truncate();
		Track::create (array (
			'name' => 'git at it\'s best',
			'status' => 'PENDING',
			'description' => 'A little course for all n3wbs on how to use git.'
		));

		Track::create (array (
			'name' => 'Another very important session',
			'status' => 'PLANNED',
			'description' => 'Very very important!'
		));

		Track::create (array (
			'name' => 'A planned session',
			'status' => 'PLANNED',
			'description' => 'Very very planned!'
		));
	}
}