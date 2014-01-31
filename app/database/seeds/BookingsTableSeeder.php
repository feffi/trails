<?php
use Trails\Models\Booking;
use Trails\Models\User;
use Trails\Models\Track;

class BookingsTableSeeder extends Seeder {

	public function run() {
		DB::table ('bookings')->delete ();
		Booking::create (array (
			'user_id' => User::where ('email', '=', 'feffi@feffi.org')->pluck ('id'),
			'track_id' => Track::where ('name', '=', 'A planned session')->pluck ('id')
		));

		Booking::create (array (
			'user_id' => User::where ('email', '=', 'feffi@feffi.org')->pluck ('id'),
			'track_id' => Track::where ('name', '=', 'Another very important session')->pluck ('id')
		));

		Booking::create (array (
			'user_id' => User::where ('email', '=', 'feffi@feffi.org')->pluck ('id'),
			'track_id' => Track::where ('name', '=', 'git at it\'s best')->pluck ('id')
		));

		Booking::create (array (
			'user_id' => User::where ('email', '=', 'john@feffi.org')->pluck ('id'),
			'track_id' => Track::where ('name', '=', 'git at it\'s best')->pluck ('id')
		));

		Booking::create (array (
			'user_id' => User::where ('email', '=', 'john@feffi.org')->pluck ('id'),
			'track_id' => Track::where ('name', '=', 'Another very important session')->pluck ('id')
		));
	}
}