<?php

class AccountController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct() {
	    $this->beforeFilter('csrf', array('on'=>'post'));
	    $this->beforeFilter('auth', array('only'=>array('getCourses')));
	}

	public function getLogin() {
	    //return View::make('account.test_login');
	    return View::make('account.login');
	}

	public function postLogin(){
		//return Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')));
		if (Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')))) {

		    return Redirect::to('courses/')->with('message', 'Hello'.Auth::user()->name);
		} else {
		    return Redirect::route('account-login')
		        ->with('message', 'Your username/password combination was incorrect')
		        ->withInput();
		}
	}

	public function getLogout() {
	    Auth::logout();
	    return Redirect::to('account/login')->with('message', 'Your are now logged out!');
	}

	public function getCourse() {
    	return View::make('courses.index');
	}
}