<?php

namespace Trails\Models;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Trails\Models\Track;
use Trails\Models\Session;
use Trails\Models\User;
use Trails\Models\Slot;

class User extends \Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array (
		'password'
	);

	/**
	 * Return if the user has booked this track.
	 *
	 *
	 * @return boolean
	 */
	public function hasTrack($id) {
		foreach ($this->tracks () as $track) {
			if ($track->id == $id) {
				return true;
			}
		}
		return false;
	}

	/**
	 * The users associated bookings
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function bookings() {
		return $this->hasMany ('Trails\Models\Booking', 'user_id', 'id');
	}

	/**
	 * The users booked tracks
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function tracks() {
		$tracks = $this->belongsToMany ('Trails\Models\Track', 'bookings', 'user_id', 'track_id');
		return $tracks;
	}

	/**
	 * The users tracks associated slots
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getSlots() {
		$slots = Slot::whereIn ('track_id', $this->tracks->modelKeys ())->distinct ()->get ();
		return $slots;
	}

	/**
	 * The users associated sessions
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getSessions() {
		$sessions = Session::find (array_unique ($this->getSlots ()->lists ('session_id')));
		return $sessions;
	}

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier() {
		return $this->getKey ();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword() {
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail() {
		return $this->email;
	}
}