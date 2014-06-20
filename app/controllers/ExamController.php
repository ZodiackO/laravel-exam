<?php

class ExamController extends \BaseController {

	public function index()
	{
		//$examinations = Examination::where('extype', '=', 'online')->get();

		$examinations = DB::table('examination')
			->join('section', 'section.exid', '=', 'examination.exid')
			->join('sectionhasquestion', 'sectionhasquestion.secid', '=', 'section.secid')
			->join('question', 'question.qid', '=', 'sectionhasquestion.qid')
			->select('examination.exid','examination.subject','examination.numofquestion', 'examination.extype',DB::raw('avg(question.level) as avgrage_level'))
			->where('examination.extype', '=', 'online')
			->groupBy('examination.exid')
			->get();

		return View::make('exams.index', compact('examinations'));
	}

	public function showdetail()
	{
		$exid = Input::get('exid');
		$avg_level = Input::get('avg_level');
		//$examinations = Examination::where('exid', '=', $exid)->get();
		$examination = Examination::find($exid);
		return View::make('exams.examdetail', compact('examination', 'avg_level'));
	}

	public function doexam()
	{
		$exid = Input::get('exid');
		$exsubject = Input::get('exsubject');
		$examinations = DB::table('examination')
			->join('section', 'section.exid', '=', 'examination.exid')
			->join('sectionhasquestion', 'sectionhasquestion.secid', '=', 'section.secid')
			->join('question', 'question.qid', '=', 'sectionhasquestion.qid')
			->where('examination.exid', '=', $exid)
			->get();

		//return $examinations;
		return View::make('exams.examdo', compact('examinations', 'exsubject'));
	}

	public function create()
	{
		return View::make('courses.create');
	}

	/**
	 * Store a newly created course in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Course::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Course::create($data);

		return Redirect::route('courses.index');
	}

	/**
	 * Display the specified course.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$course = Course::findOrFail($id);

		return View::make('courses.show', compact('course'));
	}

	/**
	 * Show the form for editing the specified course.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$course = Course::find($id);

		return View::make('courses.edit', compact('course'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if(!Auth::check()){
			return 'loggedin';
		}
		$course = Course::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Course::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$course->update($data);

		return Redirect::route('courses.index')
		->with('message', "Updated Successed")
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

			$exid = Examination::where('courseid', '=', $id )->first();

			if($exid){
				$sections = Section::where('exid', '=', $exid->exid)->get();

				foreach ($sections as $section) {
					$shq = Sectionhasquestion::where('secid', '=', $section->secid)->get();
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
				Examination::destroy($exid->exid);
			}
			

		Course::destroy($id);

		return Redirect::route('courses.index');
	}

}