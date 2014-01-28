<?php
use App\Models\Slot;
use App\Models\Track;
use App\Models\Session;

class SlotsTableSeeder extends Seeder {

	public function run() {
		DB::table ('slots')->delete ();
		Slot::create (array (
			'session_id' => App\Models\Session::where ('description', '=', 'A day to remember.')->pluck ('id'),
			'tracks_id' => Track::where ('name', '=', 'A planned session')->pluck ('id'),
			'from' => '2014-01-01 00:00:00',
			'to' => '2014-01-01 01:00:00'
		));

		Slot::create (array (
			'session_id' => App\Models\Session::where ('description', '=', 'A day to remember.')->pluck ('id'),
			'tracks_id' => Track::where ('name', '=', 'A planned session')->pluck ('id'),
			'from' => '2014-01-01 01:00:00',
			'to' => '2014-01-01 02:00:00'
		));

		Slot::create (array (
			'session_id' => App\Models\Session::where ('description', '=', 'A day to remember.')->pluck ('id'),
			'tracks_id' => Track::where ('name', '=', 'git at it\'s best')->pluck ('id'),
			'from' => '2014-01-01 02:00:00',
			'to' => '2014-01-01 03:00:00'
		));

		Slot::create (array (
			'session_id' => App\Models\Session::where ('description', '=', 'A day to dwell.')->pluck ('id'),
			'tracks_id' => Track::where ('name', '=', 'Another very important session')->pluck ('id'),
			'from' => '2014-01-01 00:00:00',
			'to' => '2014-01-01 01:00:00'
		));

		Slot::create (array (
			'session_id' => App\Models\Session::where ('description', '=', 'A day to dwell.')->pluck ('id'),
			'tracks_id' => Track::where ('name', '=', 'Another very important session')->pluck ('id'),
			'from' => '2014-01-01 01:00:00',
			'to' => '2014-01-01 02:00:00'
		));
	}
}