<?php namespace Trails\Models;

class Slot extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'slots';

	/**
	 * Returns the associated session of the booking.
	 *
	 * @return The associated Session(Model).
	 */
	public function session() {
		return $this->hasOne ('Trails\Models\Session', 'id', 'session_id');
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