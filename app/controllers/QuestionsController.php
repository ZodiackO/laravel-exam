<?php

class QuestionsController extends \BaseController {

	/**
	 * Display a listing of questions
	 *
	 * @return Response
	 */
	public function index()
	{
		$secid = Input::get('secid');
		$exid = Input::get('exid');
		$examtype = Input::get('examtype');
/*		
		$questions = DB::table('question')
			->join('writting', 'question.qid', '=', 'writting.qid')
			->where('exid', '=', $exam)
			->get();
		

		$score = QuestionsController::checkscore($exam);
		$totalscore = Examination::find($exam)->score;
*/
		//$questions = Question::where('exid','=',$exam)->get();
		//return $exam;
		//return $questions;
		//return View::make('questions.index', compact(array('questions','exam', 'score','totalscore')));
		return View::make('questions.index', compact(array('secid', 'exid', 'examtype')));
	}

	/**
	 * Show the form for creating a new question
	 *
	 * @return Response
	 */
	public function checkscore($exid){
		//$scores = Question::where('exid', '=',$exid)->get();
		$scores = DB::table('section')
			->join('sectionhasquestion', 'section.secid', '=', 'sectionhasquestion.secid')
			->join('question', 'sectionhasquestion.qid', '=', 'question.qid')
			->where('section.exid', '=', $exid)
			->get();


		$sum = 0;
		foreach ($scores as $score) {
			$sum += $score->score;
		}
		return $sum;
	}

	public function create()
	{
		return View::make('questions.create');
	}

	/**
	 * Store a newly created question in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$exid = Input::get('exid');
		$secid = Input::get('secid');

		$exam = Examination::where('exid', '=', $exid)->first();
		$totalscore = $exam->score;

		$currscore = QuestionsController::checkscore($exid);
		$sum_score = $currscore + Input::get('score');
		$remain_score = $totalscore - $currscore;
		if($sum_score > $totalscore){
			//$over_score = $sum_score - $totalscore;
			return Redirect::back()
						->with('message', 'คะแนนเต็ม: '.$totalscore.'  ปัจจุบันมีคะแนน: '.$currscore.'  คุณสามารถใส่คะแนนได้ไม่เกิน: '.$remain_score)
						->withInput();
		}

		$validator = Validator::make($data = Input::all(), Question::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		//$numquest = Question::where('exid', '=', $exid)->orderBy('number','desc')->first();
		$numquest = DB::table('section')
			->join('sectionhasquestion', 'section.secid', '=', 'sectionhasquestion.secid')
			->join('question', 'sectionhasquestion.qid', '=', 'question.qid')
			->where('section.exid', '=', $exid)
			->orderBy('question.number','desc')
			->first();

		$numquest = $numquest ? $numquest->number + 1 : 1;
		//return $numquest;

		$quest = Question::create(array('score' => Input::get('score'),'level' => Input::get('level') , 'number' => $numquest));
		Writting::create(array('wquestion' => Input::get('wquestion'),'answer' => Input::get('answer'), 'qid' => $quest->qid));

		$sechasquest = Sectionhasquestion::create(array('secid' => $secid, 'qid' => $quest->qid));

		return Redirect::to('section/'.$exid.'/');
	}

	/**
	 * Display the specified question.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$question = Question::findOrFail($id);

		return View::make('questions.show', compact('question'));
	}

	/**
	 * Show the form for editing the specified question.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//$question = Question::find($id);
/*
		$question = DB::table('question')
			->join('writting', 'writting.qid', '=', 'question.qid')
			->where('question.qid', '=', $id)
			->first();
*/

		$question = DB::table('question')
			->join('sectionhasquestion', 'question.qid', '=', 'sectionhasquestion.qid')
			->join('section', 'section.secid', '=', 'sectionhasquestion.secid')
			->join('writting', 'writting.qid', '=', 'question.qid')
			->where('question.qid', '=', $id)
			->first();


		return View::make('questions.edit', compact('question'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$question = Question::findOrFail($id);
		$writting = Writting::where('qid', '=', $id)->first();
		$exam = DB::table('question')
			->join('sectionhasquestion', 'question.qid', '=', 'sectionhasquestion.qid')
			->join('section', 'section.secid', '=', 'sectionhasquestion.secid')
			->join('writting', 'writting.qid', '=', 'question.qid')
			->where('question.qid', '=', $id)
			->first();


		$validator = Validator::make($data = Input::all(), Question::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$question->update(array('score' => Input::get('score'),'level' => Input::get('level')));
		$writting->update(array('wquestion' => Input::get('wquestion'),'answer' => Input::get('answer')));

		return Redirect::to('section/'.$exam->exid.'/');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$quest = Question::find($id);
		$wid = Writting::where('qid', '=', $id)->first();
		$shq = Sectionhasquestion::where('qid', '=', $id)->first();
		$section = Section::where('secid', '=', $shq->secid)->first();

		Writting::destroy($wid->wid);
		Sectionhasquestion::destroy($shq->shqid);
		Question::destroy($id);

		//QuestionsController::runnum($quest->exid, $quest->number);
		//return $runnum;

		return Redirect::to('section/'.$section->exid.'/');
	}

	public function runnum($exid, $currnum){
		$quests = Question::where('exid', '=', $exid)->where('number', '>', $currnum)->get();
		//$quests = $quests->count() ? $quests : 'false';
		//return $quests;
		$numrow = $quests->count();

		$array = array();
		$count = $currnum;
		foreach ($quests as $quest) {
			$array = array_add($array,$quest->number,$count);
			$quests->update(array('number' => $count));
			$count++;
		}
		/*
		for ($i=$numrow; $i < sizeof($array) ; $i++) { 
			Question::find(); 
		}*/
		//return $array;
	}

}