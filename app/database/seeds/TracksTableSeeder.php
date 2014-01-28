<?php

class TracksTableSeeder extends Seeder {

	public function run() {
		DB::table('tracks')->delete();
		TrackModel::create (array (
			'name' => 'git at it\'s best',
			'status' => 'PENDING',
			'description' => 'A little course for all n3wbs on how to use git.'
		));

		TrackModel::create (array (
			'name' => 'Another very important session',
			'status' => 'PLANNED',
			'description' => 'Very very important!'
		));

		TrackModel::create (array (
			'name' => 'A planned session',
			'status' => 'PLANNED',
			'description' => 'Very very planned!'
		));
	}
}