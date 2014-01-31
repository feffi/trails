<?php


namespace Trails\Models;

class Booking extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'bookings';

	public function user() {
		return $this->hasOne ('Trails\Models\User', 'id', 'user_id');
	}

	public function track() {
		return $this->hasOne ('Trails\Models\Track', 'id', 'track_id');
	}
}