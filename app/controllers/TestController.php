<?php

class TestController extends \BaseController {

	public function index()
	{
		//$courses = Course::all();
		//return View::make('account.test_login');
		return View::make('test.index');
	}

}