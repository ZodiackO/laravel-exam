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
	Route::get('service/historyexam/',array(
		'as' => 'service-historyexam',
		'uses' => 'ServiceController@aum'
	));
	Route::post('service/historyexam/',array(
		'as' => 'service-historyexam',
		'uses' => 'ServiceController@aum'
	));
	Route::get('service/highscore/', array(
		'as' => 'service-highscore',
		'uses' => 'ServiceController@highscore'
	));
	Route::get('service/test/', array(
		'as' => 'service-test',
		'uses' => 'ServiceController@test'
	));
	Route::post('service/test/', array(
		'as' => 'service-test',
		'uses' => 'ServiceController@test'
	));

	Route::post('exams/checkanswer/', array(
		'as' => 'exams-checkans',
		'uses' => 'ExamController@checkanswer'
	));
	Route::get('exams/doexam/',array(
		'as' => 'exams-do',
		'uses' => 'ExamController@doexam'
	));
	Route::get('exams/detail/',array(
		'as' => 'exams-detail',
		'uses' => 'ExamController@showdetail'
	));
	Route::get('exams/',array(
		'as' => 'exams',
		'uses' => 'ExamController@index'
	));
	Route::resource('exams', 'ExamController');

	Route::post('duplicate/store',array(
		'as' => 'duplicate',
		'uses' => 'DuplicateController@store'
	));

	Route::get('archive/exam',array(
		'as' => 'archiveExam',
		'uses' => 'ExamarchiveController@exam'
	));
	Route::get('archive/{exid}',array(
		'as' => 'archive',
		'uses' => 'ExamarchiveController@index'
	));
	Route::resource('archive', 'ExamarchiveController');

	Route::resource('command','CommandsController');

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

	Route::post('section/storem/', array(
		'as' => 'section-storem',
		'uses' => 'SectionsController@storem'
	));
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
	
	Route::get('examination/create_online/',array(
		'as' => 'exam-create-online',
		'uses' => 'ExaminationsController@create_online'
	));

	Route::get('examination/create/',array(
		'as' => 'exam-create',
		'uses' => 'ExaminationsController@create'
	));

	Route::get('examination/before_create/',array(
		'as' => 'exam-before_create',
		'uses' => 'ExaminationsController@before_create'
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
/*
		Route::post('/account/login', array(
			'as' => 'account-login-post',
			'uses' => 'AccountController@postLogin'
		));*/
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
Route::get('login',array(
		'as' => 'login',
		'uses' => 'LoginController@index'
	));
Route::post('login',array(
	'as' => 'login-post',
	'uses' => 'LoginController@login'
));
Route::get('test',array(
		'as' => 'test',
		'uses' => 'TestController@index'
));