<?php

class SectionsController extends \BaseController {

	/**
	 * Display a listing of sections
	 *
	 * @return Response
	 */
	public function index($exam)
	{

		//$sections = Section::all();
		$sections = Section::where('exid', '=', $exam)->get();

/*		
		$m_questions = DB::table('question')
			->join('writting', 'question.qid', '=', 'writting.qid')
			->where('exid', '=', $exam)
			->get();*/
		$m_questions = DB::table('section')
			->join('sectionhasquestion', 'section.secid', '=', 'sectionhasquestion.secid')
			->join('question', 'sectionhasquestion.qid', '=', 'question.qid')
			//->join('writting', 'question.qid', '=', 'writting.qid')
			//->join('choice', 'question.qid', '=', 'choice.qid')
			->where('section.exid', '=', $exam)
			->get();

		//return $m_questions;
		$question = new QuestionsController();

		$score = $question->checkscore($exam);
		$totalscore = Examination::find($exam)->score;

		return View::make('sections.index', compact(array('sections','exam', 'score','totalscore', 'm_questions')));
	}

	/**
	 * Show the form for creating a new section
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('sections.create');
	}

	/**
	 * Store a newly created section in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$exid = Input::get('exid');
		//return Input::all();
		$validator = Validator::make($data = Input::all(), Section::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}


		Section::create($data);

		return Redirect::to('section/'.$exid.'/');
	}

	/**
	 * Display the specified section.
	 * 
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$section = Section::findOrFail($id);

		return View::make('sections.show', compact('section'));
	}

	/**
	 * Show the form for editing the specified section.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$section = Section::find($id);

		return View::make('sections.edit', compact('section'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$section = Section::findOrFail($id);
		$validator = Validator::make($data = Input::all(), Section::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$section->update($data);

		return Redirect::to('section/'.$section->exid);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$section = Section::find($id);

		$shq = Sectionhasquestion::where('secid', '=', $id)->get();
		foreach ($shq as $ashq) {
			$wid = Writting::where('qid', '=', $ashq->qid)->first();
			Writting::destroy($wid->wid);
			Sectionhasquestion::destroy($ashq->shqid);
			
			Question::destroy($ashq->qid);
		}

		//$qid = Question::where()->first();
		//$wid = Writting::where('qid', '=', $id)->first();
		
		//Question::destroy($id);
		//Sectionhasquestion::destroy($shq->shqid);
		Section::destroy($id);

		return Redirect::to('section/'.$section->exid);
	}


}