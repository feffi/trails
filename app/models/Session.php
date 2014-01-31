<?php

namespace Trails\Models;

class Session extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sessions';

	public function users() {
		return $this->belongsToMany ('Trails\Models\User', 'bookings', 'user_id', 'id');
	}

	public function tracks() {
		return $this->belongsToMany ('Trails\Models\Track', 'slots', 'session_id', 'track_id');
	}

	public function slots() {
		return $this->hasMany ('Trails\Models\Slot', 'session_id');
	}
}
