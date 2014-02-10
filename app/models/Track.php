<?php

namespace Trails\Models;

class Track extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tracks';

	/**
	 * Returns all tracks of the given booking
	 *
	 */
	public function bookings() {
		return $this->hasMany ('Trails\Models\Booking', 'track_id');
	}

	public function users() {
		return $this->belongsToMany ('Trails\Models\User', 'bookings', 'user_id', 'id');
	}

	public function slots() {
		return $this->hasMany ('Trails\Models\Slot', 'track_id');
	}

	public function sessions() {
		return $this->belongsToMany ('Trails\Models\Session', 'slots', 'track_id', 'session_id');
	}
}