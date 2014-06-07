<?php

class WrittingsController extends \BaseController {

	/**
	 * Display a listing of writtings
	 *
	 * @return Response
	 */
	public function index()
	{
		$writtings = Writting::all();

		return View::make('writtings.index', compact('writtings'));
	}

	/**
	 * Show the form for creating a new writting
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('writtings.create');
	}

	/**
	 * Store a newly created writting in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$exid = Input::get('exid');
		$secid = Input::get('secid');

		$exam = Examination::where('exid', '=', $exid)->first();
		$totalscore = $exam->score;

		$currscore = WrittingsController::checkscore($exid);
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
		Writting::create(array('wquestion' => Input::get('wquestion'),'answer' => Input::get('answer'),'numline' => Input::get('numline') ,'qid' => $quest->qid));

		$sechasquest = Sectionhasquestion::create(array('secid' => $secid, 'qid' => $quest->qid));

		return Redirect::to('section/'.$exid.'/');
	}

	/**
	 * Display the specified writting.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$writting = Writting::findOrFail($id);

		return View::make('writtings.show', compact('writting'));
	}

	/**
	 * Show the form for editing the specified writting.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$writting = Writting::find($id);

		return View::make('writtings.edit', compact('writting'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$writting = Writting::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Writting::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$writting->update($data);

		return Redirect::route('writtings.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Writting::destroy($id);

		return Redirect::route('writtings.index');
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

}