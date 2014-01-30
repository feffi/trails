<?php

namespace Trails\Controller;

use Trails\Models\Booking;

class BookingController extends \Trails\Controller\BaseController {

	/**
	 * Display a listing of the resource.
	 * GET|/booking|index|booking.index
	 *
	 * @return Response
	 */
	public function index() {
		$bookings = Booking::all ();
		return \View::make ('booking.index')->with ('bookings', $bookings);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET|/booking/create|create|booking.create
	 *
	 * @return Response
	 */
	public function create() {
		return \View::make ('booking.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST|/booking|store|booking.store
	 *
	 * @return Response
	 */
	public function store() {
		$rules = array (
			'user_id' => 'required|numeric',
			'track_id' => 'required|numeric'
		);
		$validator = \Validator::make (\Input::all (), $rules);

		// process the login
		if ($validator->fails ()) {
			return \Redirect::to ('booking/create')->withErrors ($validator)->withInput ();
		} else {
			$booking = new \Trails\Models\Booking ();
			$booking->user_id = \Input::get ('user_id');
			$booking->track_id = \Input::get ('track_id');
			$booking->save ();
			\Session::flash ('message', 'Successfully created booking!');
			return \Redirect::to ('booking');
		}
	}

	/**
	 * Display the specified resource.
	 * GET|/booking/{id}|show|booking.show
	 *
	 * @param int $id
	 * @return Response
	 */
	public function show($id) {
		$booking = \Trails\Models\Booking::find ($id);
		return \View::make ('booking.show')->with ('booking', $booking);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET|/booking/{id}/edit|edit|booking.edit
	 *
	 * @param int $id
	 * @return Response
	 */
	public function edit($id) {
		$booking = \Trails\Models\Booking::find ($id);
		return \View::make ('booking.edit')->with ('booking', $booking);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT|/booking/{id}|update|booking.update
	 *
	 * @param int $id
	 * @return Response
	 */
	public function update($id) {
		$rules = array (
			'user_id' => 'required|numeric',
			'track_id' => 'required|numeric'
		);
		$validator = \Validator::make (\Input::all (), $rules);

		// process the login
		if ($validator->fails ()) {
			return \Redirect::to ('booking/' . $id . '/edit')->withErrors ($validator)->withInput ();
		} else {
			$booking = \Trails\Models\Booking::find ($id);
			$booking->user_id = \Input::get ('user_id');
			$booking->track_id = \Input::get ('track_id');
			$booking->save ();
			\Session::flash ('message', 'Successfully updated booking!');
			return \Redirect::to ('booking');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE|/booking/{id}|destroy|booking.destroy
	 *
	 * @param int $id
	 * @return Response
	 */
	public function destroy($id) {
		$booking = \Trails\Models\Booking::find ($id);
		$booking->delete ();
		\Session::flash ('message', 'Successfully deleted booking!');
		return \Redirect::to ('booking');
	}
}