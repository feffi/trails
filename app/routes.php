<?php

/*
 * |-------------------------------------------------------------------------- | Application Routes |-------------------------------------------------------------------------- | | Here is where you can register all of the routes for an application. | It's a breeze. Simply tell Laravel the URIs it should respond to | and give it the Closure to execute when that URI is requested. |
 */
Route::group (array ()
// 'before' => 'fakeAuthentication'
, function () {

	Route::resource('booking', '\Trails\Controller\BookingController');

	// the authenticated home view
	Route::get ('/', array (
		'uses' => '\Trails\Controller\HomeController@showHome'
	));
});

// FAKE - remove later
Route::filter ("fakeAuthentication", function () {
	$userdata = array (
		'email' => 'feffi@feffi.org',
		'password' => 'test'
	);
	Auth::attempt ($userdata);
});