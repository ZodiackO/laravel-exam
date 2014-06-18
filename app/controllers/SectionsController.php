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
		$course = DB::table('examination')
			->join('course', 'examination.courseid', '=', 'course.courseid')
			->where('examination.exid', '=', $exam)
			->first();

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

		return View::make('sections.index', compact(array('sections','exam', 'score','totalscore', 'm_questions', 'course')));
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
/*
		$numsec = DB::table('section')
			->join('sectionhasquestion', 'section.secid', '=', 'sectionhasquestion.secid')
			->join('question', 'sectionhasquestion.qid', '=', 'question.qid')
			->where('section.exid', '=', $exid)
			->orderBy('question.number','desc')
			->first();*/
		$numsec = Section::where('exid','=',$exid)
			->orderBy('number', 'desc')
			->first();

		$numsec = $numsec ? $numsec->number + 1 : 1;

		Section::create(array('name' => Input::get('name'), 'exid'=> $exid, 'number' => $numsec));

		return Redirect::to('section/'.$exid.'/');
	}

	public function storem()
	{
		$exid = Input::get('exid');
		//$data = Input::get('data');

		//return $tes;
		$validator = Validator::make($data = Input::all(), Section::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$numsec = Section::where('exid','=',$exid)
			->orderBy('number', 'desc')
			->first();

		$numsec = $numsec ? $numsec->number + 1 : 1;

		Section::create(array('name' => Input::get('name'), 'exid'=> $exid, 'number' => $numsec));
		$sections = Section::where('exid', '=', $exid)->get();

		return $sections;
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
			$choice = Choice::where('qid', '=', $ashq->qid)->first();
			$wid = $wid ? Writting::destroy($wid->wid) : '';
			if($choice){
				$selects = Selection::where('cid', '=', $choice->cid)->get();
				foreach($selects as $select){
					Sectionhasquestion::destroy($select->selectid);
				}
				Choice::destroy($choice->cid);
			}

			Sectionhasquestion::destroy($ashq->shqid);
			
			Question::destroy($ashq->qid);
		}

		/*
		$wid_arr = array();
		$shq_arr = array();
		$quest_arr = array();
		$choice_arr = array();
		$select_arr = array();
		foreach($shq as $ashq){
			$writing = Writting::where('qid', '=', $ashq->qid)->first();
			$choice = Choice::where('qid', '=', $ashq->qid)->first();
			if($choice){
				$selects = Selection::where('cid', '=', $choice->cid)->get();
				foreach($selects as $select){
					array_push($select_arr,$select->selectid);
				}
				array_push($choice_arr, $choice->cid);
			}elseif ($writing) {
				array_push($wid_arr, $ashq->qid);
			}
			
			array_push($shq_arr, $ashq->shqid);
			array_push($quest_arr, $ashq->qid);
		}
		//return $select_arr;
		Selection::whereIn('selectid', $select_arr)->delete();
		Choice::whereIn('cid', $choice_arr)->delete();
		Writting::whereIn('wid', $wid_arr)->delete();
		Sectionhasquestion::whereIn('shqid', $shq_arr)->delete();
		Question::whereIn('qid', $quest_arr)->delete();
*/
		Section::destroy($id);

		return Redirect::to('section/'.$section->exid);
	}

	public static function sumScoresection($idsec)
	{
		//$sections = Sectionhasquestion::where('secid', '=', $idsec)->get();

		$sections = DB::table('section')
			->join('sectionhasquestion', 'section.secid', '=', 'sectionhasquestion.secid')
			->join('question', 'sectionhasquestion.qid', '=', 'question.qid')
			->where('section.secid', '=', $idsec)
			->get();

		$total = 0;
		foreach ($sections as $section){
			$total += $section->score;
		}
		return $total;
	}

}