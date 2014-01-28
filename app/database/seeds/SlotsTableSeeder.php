<?php

class SlotsTableSeeder extends Seeder {

	public function run() {
		DB::table ('slots')->delete ();
		SlotModel::create (array (
			'session_id' => SessionModel::where ('description', '=', 'A day to remember.')->pluck ('id'),
			'tracks_id' => TrackModel::where ('name', '=', 'A planned session')->pluck ('id'),
			'from' => '2014-01-01 00:00:00',
			'to' => '2014-01-01 01:00:00'
		));

		SlotModel::create (array (
			'session_id' => SessionModel::where ('description', '=', 'A day to remember.')->pluck ('id'),
			'tracks_id' => TrackModel::where ('name', '=', 'A planned session')->pluck ('id'),
			'from' => '2014-01-01 01:00:00',
			'to' => '2014-01-01 02:00:00'
		));

		SlotModel::create (array (
			'session_id' => SessionModel::where ('description', '=', 'A day to remember.')->pluck ('id'),
			'tracks_id' => TrackModel::where ('name', '=', 'git at it\'s best')->pluck ('id'),
			'from' => '2014-01-01 02:00:00',
			'to' => '2014-01-01 03:00:00'
		));

		SlotModel::create (array (
			'session_id' => SessionModel::where ('description', '=', 'A day to dwell.')->pluck ('id'),
			'tracks_id' => TrackModel::where ('name', '=', 'Another very important session')->pluck ('id'),
			'from' => '2014-01-01 00:00:00',
			'to' => '2014-01-01 01:00:00'
		));

		SlotModel::create (array (
			'session_id' => SessionModel::where ('description', '=', 'A day to dwell.')->pluck ('id'),
			'tracks_id' => TrackModel::where ('name', '=', 'Another very important session')->pluck ('id'),
			'from' => '2014-01-01 01:00:00',
			'to' => '2014-01-01 02:00:00'
		));
	}
}