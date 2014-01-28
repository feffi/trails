<?php
use App\Models\Booking;
use App\Models\User;
use App\Models\Track;

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
	}
}