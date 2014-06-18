<?php

class ExamarchiveController extends \BaseController {

	public function index($exid)
	{
		//$exid = Input::get('exid');

		$courses = Course::all();

		return View::make('examarchive.index', compact('courses', 'exid'));
	}

	public function exam()
	{
		$courseid = Input::get('course');
		$oldexid = Input::get('oldexid');

		$exams = Examination::where('courseid', '=', $courseid)->get();
		$acyears = Examination::where('courseid', '=', $courseid)->distinct()->select('acyear')->orderBy('acyear','asc')->get();
		$sections = Section::where('exid', '=', $oldexid)->orderBy('number', 'asc')->get();

		$questions = DB::table('course')
			->join('examination', 'examination.courseid', '=', 'course.courseid')
			->join('section', 'section.exid', '=', 'examination.exid')
			->join('sectionhasquestion', 'sectionhasquestion.secid', '=', 'section.secid')
			->join('question', 'question.qid', '=', 'sectionhasquestion.qid')
			->where('course.courseid', '=', $courseid)
			->get();
			//return $questions;
		return View::make('examarchive.exam', compact('questions', 'oldexid', 'exams', 'acyears', 'sections'));
	}



}