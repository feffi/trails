<?php

/*
 * |-------------------------------------------------------------------------- | Application Routes |-------------------------------------------------------------------------- | | Here is where you can register all of the routes for an application. | It's a breeze. Simply tell Laravel the URIs it should respond to | and give it the Closure to execute when that URI is requested. |
 */
Route::group (array (
	'before' => 'fakeAuthentication'
), function () {

	// Route::get ('/', 'HomeController@showSplash');

	// the authenticated home view
	Route::get ('/', array (
		'uses' => 'HomeController@showHome'
	));

	// route to show the login form
	Route::get ('login', array (
		'uses' => 'HomeController@showLogin'
	));

	// route to process the form
	Route::post ('login', array (
		'uses' => 'HomeController@doLogin'
	));

	// route to process the form
	Route::post ('logout', array (
		'uses' => 'HomeController@doLogout'
	));

	// show users profile
	Route::get ('profile', array (
		'uses' => 'UserController@showProfile'
	));
});

Route::filter ("csrf", function () {
	if (Session::token () != Input::get ("_token")) {
		throw new Illuminate\Session\TokenMismatchException ();
	}
});

// FAKE - remove later
Route::filter ("fakeAuthentication", function () {
	$userdata = array (
		'email' => 'feffi@feffi.org',
		'password' => 'test'
	);
	Auth::attempt ($userdata);
});