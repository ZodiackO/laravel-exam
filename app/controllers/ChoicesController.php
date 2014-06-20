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

	public static function select($qid)
	{
		$choice = Choice::where('qid', '=', $qid)->first();
		$selections = Selection::where('cid', '=', $choice->cid)->get();

		return $selections;
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
		$tex = Input::get('text');
		$number = Input::get('number');

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

		$validator = Validator::make($data = Input::all(), Choice::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		//Choice::create($data);
		$numquest = DB::table('section')
			->join('sectionhasquestion', 'section.secid', '=', 'sectionhasquestion.secid')
			->join('question', 'sectionhasquestion.qid', '=', 'question.qid')
			->where('section.exid', '=', $exid)
			->orderBy('question.number','desc')
			->first();

		$numquest = $numquest ? $numquest->number + 1 : 1;
		//return $numquest;

		$quest = Question::create(array('question' => Input::get('question'), 'score' => Input::get('score'),'level' => Input::get('level') , 'number' => $numquest));
		$choic = Choice::create(array('answer' => Input::get('answer'),'reason' => Input::get('reason') ,'qid' => $quest->qid));
		for($i=0; $i < sizeof($number); $i++){
			Selection::create(array('text' => $tex[$i], 'number' => $number[$i], 'cid' => $choic->cid));
		}
		

		$sechasquest = Sectionhasquestion::create(array('secid' => $secid, 'qid' => $quest->qid));

		return Redirect::to('section/'.$exid.'/');
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