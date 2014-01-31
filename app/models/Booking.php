<?php

namespace Trails\Models;

class Booking extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'bookings';

	/**
	 * Returns the associated user of the booking.
	 *
	 * @return The associated User(Model).
	 */
	public function user() {
		return $this->hasOne ('Trails\Models\User', 'id', 'user_id');
	}

	/**
	 * Returns the associated track of the booking.
	 *
	 * @return The associated Track(Model).
	 */
	public function track() {
		return $this->hasOne ('Trails\Models\Track', 'id', 'track_id');
	}
}