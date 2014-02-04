<?php
use Trails\Models\Booking;

class BookingsTableSeeder extends Seeder {

	public function run() {
		Eloquent::unguard ();
		DB::table ('bookings')->truncate();
		Booking::create (array (
			'user_id' => 1,
			'track_id' => 3
		));

		Booking::create (array (
			'user_id' => 1,
			'track_id' => 2
		));

		Booking::create (array (
			'user_id' => 1,
			'track_id' => 1
		));

		Booking::create (array (
			'user_id' => 2,
			'track_id' => 1
		));

		Booking::create (array (
			'user_id' => 2,
			'track_id' => 2
		));
	}
}