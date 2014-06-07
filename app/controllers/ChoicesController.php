<?php

class ChoicesController extends \BaseController {

	/**
	 * Display a listing of choices
	 *
	 * @return Response
	 */
	public function index()
	{
		$choices = Choice::all();

		return View::make('choices.index', compact('choices'));
	}

	/**
	 * Show the form for creating a new choice
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('choices.create');
	}

	/**
	 * Store a newly created choice in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Choice::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Choice::create($data);

		return Redirect::route('choices.index');
	}

	/**
	 * Display the specified choice.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$choice = Choice::findOrFail($id);

		return View::make('choices.show', compact('choice'));
	}

	/**
	 * Show the form for editing the specified choice.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$choice = Choice::find($id);

		return View::make('choices.edit', compact('choice'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$choice = Choice::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Choice::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$choice->update($data);

		return Redirect::route('choices.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Choice::destroy($id);

		return Redirect::route('choices.index');
	}

}