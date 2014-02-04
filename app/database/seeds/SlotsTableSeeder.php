<?php
use Trails\Models\Slot;
use Trails\Models\Session;
use Trails\Models\Track;

class SlotsTableSeeder extends Seeder {

	public function run() {
		Eloquent::unguard ();
		DB::table ('slots')->truncate();
		Slot::create (array (
			'session_id' => 1,
			'track_id' => 1,
			'from' => '2014-01-01 00:00:00',
			'to' => '2014-01-01 01:00:00'
		));

		Slot::create (array (
			'session_id' => 2,
			'track_id' => 3,
			'from' => '2014-01-01 00:00:00',
			'to' => '2014-01-01 01:00:00'
		));

		Slot::create (array (
			'session_id' => 2,
			'track_id' => 3,
			'from' => '2014-01-01 01:00:00',
			'to' => '2014-01-01 02:00:00'
		));

		Slot::create (array (
			'session_id' => 2,
			'track_id' => 1,
			'from' => '2014-01-01 02:00:00',
			'to' => '2014-01-01 03:00:00'
		));

		Slot::create (array (
			'session_id' => 1,
			'track_id' => 2,
			'from' => '2014-01-01 00:00:00',
			'to' => '2014-01-01 01:00:00'
		));

		Slot::create (array (
			'session_id' => 1,
			'track_id' => 2,
			'from' => '2014-01-01 01:00:00',
			'to' => '2014-01-01 02:00:00'
		));
	}
}