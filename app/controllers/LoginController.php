<?php

class LoginController extends \BaseController {

	public function index()
	{

		return View::make('account.test_login');
	}

	public function login()
	{
		$data = Input::get('data');
		$data = $data['0']; 

		Session::put('user',$data);

		return url('/');
	}

	public function logout()
	{
		Session::forget('user');
		return Redirect::to('/');
	}

}