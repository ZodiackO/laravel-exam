<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//sdfjofjsjfjsjjs

Route::get('/', function()
{
	return View::make('hello');
});
	Route::get('choice/create/',array(
		'as' => 'choice-create',
		'uses' => 'ChoicesController@create'
	));
	Route::resource('choice','ChoicesController');

	Route::get('writting/create/',array(
		'as' => 'writting',
		'uses' => 'WrittingsController@create'
	));
	Route::resource('writting','WrittingsController');

	Route::get('section/create/',array(
		'as' => 'section-create',
		'uses' => 'SectionsController@create'
	));
	Route::get('section/{exam}/', array(
		'as' => 'section',
		'uses' => 'SectionsController@index'
	));
	Route::resource('section','SectionsController');

	Route::get('export', array(
		'as' => 'export',
		'uses' => 'ExportController@export'
	));
	
	Route::get('examination/create/',array(
		'as' => 'exam-create',
		'uses' => 'ExaminationsController@create'
	));

	Route::get('examination/{course}/',array(
		'as' => 'exam',
		'uses' => 'ExaminationsController@index'
	));
	Route::resource('examination','ExaminationsController');

	Route::get('question/create/',array(
		'as' => 'question-create',
		'uses' => 'QuestionsController@create'
	));
	Route::get('question', array(
		'as' => 'question',
		'uses' => 'QuestionsController@index'
	));
	Route::resource('question','QuestionsController');
//Route::post('members/login','MembersController@postlogin');
//Route::resource('members','MembersController');
Route::group(array('before' => 'auth'), function() {
	Route::get('/account/logout', array(
		'as' => 'account-logout',
		'uses' => 'AccountController@getLogout'
	));

	Route::resource('courses','CoursesController');

});

Route::group(array('before' => 'guest'), function() {

	Route::group(array('before' => 'csrf'), function (){

		Route::post('/account/login', array(
			'as' => 'account-login-post',
			'uses' => 'AccountController@postLogin'
		));
	});

	Route::get('/account/login', array(
		'as' => 'account-login',
		'uses' => 'AccountController@getLogin'
	));
	
});