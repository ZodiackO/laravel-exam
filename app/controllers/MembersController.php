<?php

class MembersController extends \BaseController {

	/**
	 * Display a listing of members
	 *
	 * @return Response
	 */
	public function __construct(){
		$this->beforeFilter('csrf',array('on'=>'post'));
	}

	public function index()
	{
		//$members = Member::all();

		return View::make('members.index');
	}

	public function postlogin()
	{

		if (Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')))) {
    		return Redirect::to('courses/')->with('message', 'You are now logged in!');
		} else {
    	return Redirect::to('members/')
        ->with('message', 'Your username/password combination was incorrect')
        ->withInput();
        	//$user = User::find(2);
        	//echo '<pre>',print_r($user),'</pre>';
		}
	}
	/**
	 * Show the form for creating a new member
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('members.create');
	}

	/**
	 * Store a newly created member in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Member::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Member::create($data);

		return Redirect::route('members.index');
	}

	/**
	 * Display the specified member.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$member = Member::findOrFail($id);

		return View::make('members.show', compact('member'));
	}

	/**
	 * Show the form for editing the specified member.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$member = Member::find($id);

		return View::make('members.edit', compact('member'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$member = Member::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Member::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$member->update($data);

		return Redirect::route('members.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Member::destroy($id);

		return Redirect::route('members.index');
	}

}