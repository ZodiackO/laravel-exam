<?php

class CommandsController extends \BaseController {

	/**
	 * Display a listing of commands
	 *
	 * @return Response
	 */
	public function index()
	{
		$commands = Command::all();

		//return View::make('commands.index', compact('commands'));
		return $commands;
	}

	/**
	 * Show the form for creating a new command
	 *
	 * @return Response
	 */
	public function create()
	{
		
		return View::make('commands.create');
	}

	/**
	 * Store a newly created command in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Command::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		//return $data;
		$commandcre = Command::create($data);
		$commands = Command::where('tid', '=', null)->where('examtype', '=', $commandcre->examtype)->get();
		//return $commands->toJson();
		return $commands;
		//return Redirect::route('commands.index');
	}

	/**
	 * Display the specified command.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$command = Command::findOrFail($id);

		return View::make('commands.show', compact('command'));
	}

	/**
	 * Show the form for editing the specified command.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$command = Command::find($id);
		return $command;
		//return View::make('commands.edit', compact('command'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$command = Command::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Command::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$command->update($data);
		$commands = Command::all();

		return $commands;
		//return Redirect::route('commands.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Command::destroy($id);
		$commands = Command::all();
		//return $commands->toJson();
		return $commands;
		//return Redirect::route('commands.index');
	}

}