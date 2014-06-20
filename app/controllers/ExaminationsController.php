<?php

class ExaminationsController extends \BaseController {

	/**
	 * Display a listing of examinations
	 *
	 * @return Response
	 */


	public function index($course)
	{

		$examgenerals = Examination::where('courseid','=',$course)->where('extype', '=', 'general')->get();
		$examonlines = Examination::where('courseid','=',$course)->where('extype', '=', 'online')->get();

		return View::make('examinations.index', compact(array('examgenerals', 'examonlines','course')));
		//$examinations = Examination::all();
		//return View::make('examinations.index', compact('examinations'));
	}

	/**
	 * Show the form for creating a new examination
	 *
	 * @return Response
	 */
	public function before_create()
	{
		$courseid = Input::get('courseid');

		return View::make('examinations.beforecre', compact('courseid'));
	}

	public function create()
	{
		//$coursecurr = $course;
		$commands = Command::where('tid', '=', null)->where('examtype', '=', 'g')->get();
		return View::make('examinations.create', compact('commands'));
	}

	public function create_online()
	{
		$courseid = Input::get('courseid');
		$commands = Command::where('tid', '=', null)->where('examtype', '=', 'o')->get();
		return View::make('examinations.create_online', compact('commands', 'courseid'));
	}
	/**
	 * Store a newly created examination in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//return Input::all();
		$command = Input::get('command');
		
		
		$course = Input::get('courseid');
		$validator = Validator::make($data = Input::all(), Examination::$rules);
		if(sizeof($command) != 0){
			$command_str = implode(',', $command); //array to string
			$data['command'] = $command_str;
		}
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		//Examination::create(array($data, 'courseid'=>$course));
		//return $data;
		Examination::create($data);
		//return Redirect::route('examination.index',array($course));
		return Redirect::to('examination/'.$course.'/')
			->with('message', Input::get('subject'))
			->withInput();
	}

	/**
	 * Display the specified examination.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//$examination = Examination::findOrFail($id);
		$examinations = Examination::where('courseid','=',$id)->get();
		return View::make('examinations.show', compact('examinations'));
	}

	/**
	 * Show the form for editing the specified examination.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$examination = Examination::find($id);

		$commands = Command::where('tid', '=', null)->get();

		return View::make('examinations.edit', compact(array('examination', 'commands')));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$examination = Examination::findOrFail($id);
		$command_str = implode(',', Input::get('command')); //array to string
		

		$validator = Validator::make($data = Input::all(), Examination::$rules);
		$data['command'] = $command_str;
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$examination->update($data);

		return Redirect::to('examination/'.$examination->courseid.'/')
			->with('message', Input::get('subject'))
			->withInput();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$exam = Examination::find($id);

		//$qid = Question::where('exid', '=', $id)->first();
		//$wid = Writting::where('qid', '=', $qid->qid)->first();

		//Writting::destroy($wid->wid);
		//Question::destroy($qid->qid);
		$sections = Section::where('exid', '=', $id)->get();

		foreach ($sections as $section) {
			$shq = Sectionhasquestion::where('secid', '=', $section->secid)->first();
			if($shq){
				foreach ($shq as $ashq) {
					$wid = Writting::where('qid', '=', $ashq->qid)->first();
					Writting::destroy($wid->wid);
					Sectionhasquestion::destroy($ashq->shqid);
					
					Question::destroy($ashq->qid);
				}
			}
			Section::destroy($section->secid);

		}
		

		Examination::destroy($id);

		return Redirect::to('examination/'.$exam->courseid.'/')
			->with('message', 'Delete Successed')
			->withInput();
	}

}