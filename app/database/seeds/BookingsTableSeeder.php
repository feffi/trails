<?php

class BookingsTableSeeder extends Seeder {

	public function run() {
		DB::table ('bookings')->delete ();
		BookingModel::create (array (
			'user_id' => UserModel::where ('email', '=', 'feffi@feffi.org')->pluck ('id'),
			'track_id' => TrackModel::where ('name', '=', 'A planned session')->pluck ('id')
		));

		BookingModel::create (array (
			'user_id' => UserModel::where ('email', '=', 'feffi@feffi.org')->pluck ('id'),
			'track_id' => TrackModel::where ('name', '=', 'Another very important session')->pluck ('id')
		));

		BookingModel::create (array (
			'user_id' => UserModel::where ('email', '=', 'feffi@feffi.org')->pluck ('id'),
			'track_id' => TrackModel::where ('name', '=', 'git at it\'s best')->pluck ('id')
		));
	}
}