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
		$mid = '10';
		//$arr2 = array('nickname' => 'o');
		//$arr = array(array('name' => 'gg', 'age' => '16'));
		//array_push($arr,$arr2);
		//$mer = array(array_merge($arr['0'],$arr2));
/*
		$memdoexam = DB::table('memberdoexamquestion')
			->join('examination', 'examination.exid', '=', 'memberdoexamquestion.exid')
			->where('memberdoexamquestion.exid', '=', $exid)
			->groupBy('memberdoexamquestion.mid','memberdoexamquestion.exid','memberdoexamquestion.num_times')
			->select(array('memberdoexamquestion.mid','memberdoexamquestion.timetake',DB::raw('sum(memberdoexamquestion.score) as totalscore')))
			->orderBy('totalscore','desc')
			->get();*/
			//return $memdoexam;
		//$examinations = Examination::where('exid', '=', $exid)->get();
		$examination = Examination::find($exid);
		return View::make('exams.examdetail', compact('examination', 'avg_level'));
	}

	public function doexam()
	{
		$avg_level = Input::get('avg_level');
		$exid = Input::get('exid');
		$exsubject = Input::get('exsubject');
		$examinations = DB::table('examination')
			->join('section', 'section.exid', '=', 'examination.exid')
			->join('sectionhasquestion', 'sectionhasquestion.secid', '=', 'section.secid')
			->join('question', 'question.qid', '=', 'sectionhasquestion.qid')
			->where('examination.exid', '=', $exid)
			->get();

		//return $examinations;
		return View::make('exams.examdo', compact('examinations', 'exsubject', 'exid', 'avg_level'));
	}

	public function checkanswer()
	{
		$avg_level = Input::get('avg_level');
		$exid = Input::get('exid');
		$timetake = Input::get('timetake');

		//$memid = Session::get('user')['MID'];
		$memid = '10';
		$memdoex = Memberdoexamquestion::where('mid', '=', $memid)
			->where('exid', '=',$exid)
			->orderBy('num_times','desc')
			->first();
		$currtimes = $memdoex ? $memdoex->num_times + 1 : 1;

		$exam = Examination::find($exid);

		$questid = Input::get('question');
		$questid = explode(',', $questid);
		$answers = Choice::whereIn('qid',$questid)->select('qid','answer')->get();

		$result = '';
		$points = 0;
		$timefin = '';

		foreach ($answers as $answer) {
			$score = '';
			$reply = Input::get('q'.$answer->qid);
			if($reply != ''){
				if($answer->answer == $reply){
					$qt = Question::find($answer->qid);
					$score = $qt->score;
					$points += $qt->score;
					$result = 'correct';
					//return 'correct';
				}else{
					$score = 0;
					$result = 'wrong';
					//return 'wrong';
				}
			}else{
				$result = 'null';
			}

			$mdxq = Memberdoexamquestion::create(array(
				'mid' => $memid, 
				'exid' => $exid, 
				'qid' => $answer->qid,
				'result' => $result,
				'score' => $score,
				'timetake' => $timetake,
				'num_times'=> $currtimes
			));
			$timefin = $mdxq->created_at;
		}
		$res = $points < $exam->scorepass ? 'Fail':'Pass';
		$arrdata = array(
			'exsubject' => $exam->subject,
			'result' => $res,
			'mark' => $points,
			'totalscore' => $exam->score,
			'timetake' => $timetake,
			'timefin' => $timefin,
			'avg_level' => $avg_level
		);


		return View::make('exams.examresult', compact('arrdata'));
	}

	public function runnum()
	{

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