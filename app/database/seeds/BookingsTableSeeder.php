<?php

class BookingsTableSeeder extends Seeder {

	public function run() {
		DB::table ('bookings')->delete ();
		Booking::create (array (
				'user' => User::find(1),
				'track' => Track::find(1)
		));
	}
}