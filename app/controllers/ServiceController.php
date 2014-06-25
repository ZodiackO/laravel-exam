<?php

class ServiceController extends \BaseController {

	public function index()
	{
		//$examinations = Examination::where('extype', '=', 'online')->get();

		return View::make('hello');
	}

	public function test()
	{
		return 'You can get data.';
	}

	public function highscore()
	{
		/*
		$memdoexam = Memberdoexamquestion::groupBy('mid','exid','num_times')
			->select(DB::raw('sum(score) as totalscore'))
			->get();
		return $memdoexam;
		*/
		$memdoexam = DB::table('memberdoexamquestion')
			->join('examination', 'examination.exid', '=', 'Memberdoexamquestion.exid')
			->join('course', 'course.courseid', '=', 'examination.courseid')
			->groupBy('Memberdoexamquestion.mid','Memberdoexamquestion.exid','Memberdoexamquestion.num_times')
			->select(array('Memberdoexamquestion.mid','course.name as course','examination.subject',DB::raw('sum(Memberdoexamquestion.score) as totalscore')))
			->orderBy('totalscore','desc')
			->get();

		$memdoexam = json_encode($memdoexam);
		return $memdoexam;

	}

	public function aum()
	{
		$mid = Input::get('mid');
		//$mid = '10';
		$memdoexam = DB::table('memberdoexamquestion')
			->join('examination', 'examination.exid', '=', 'Memberdoexamquestion.exid')
			->groupBy('Memberdoexamquestion.mid','Memberdoexamquestion.exid','Memberdoexamquestion.num_times')
			->select(array('Memberdoexamquestion.mid','examination.subject',DB::raw('sum(Memberdoexamquestion.score) as totalscore')))
			->where('memberdoexamquestion.mid', '=', $mid)
			->orderBy('totalscore','desc')
			->get();
		$memdoexam = json_encode($memdoexam);
		return $memdoexam;
	}
}