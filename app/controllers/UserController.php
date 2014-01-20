<?php

/**
 * Controller for user data and profile management
 *
 * @author feffi
 *
 */
class UserController extends BaseController {

	/**
	 * Shows a users profile
	 *
	 * @return \Illuminate\View\View
	 */
	public function showProfile() {
		return View::make ('user/profile');
	}
}