<?php

class DuplicateController extends \BaseController {



	public function store()
	{
		$exid = Input::get('exid');
		$datas = Input::get('data');

		foreach ($datas as $data) {

			$numquest = DB::table('section')
			->join('sectionhasquestion', 'section.secid', '=', 'sectionhasquestion.secid')
			->join('question', 'sectionhasquestion.qid', '=', 'question.qid')
			->where('section.exid', '=', $exid)
			->orderBy('question.number','desc')
			->first();
			
			$numquest = $numquest ? $numquest->number + 1 : 1;

			$question = Question::find($data['qid']);
			//$questdup = $question->replicate();
			//$questdup->save();

			$qarr = array(
				'question' => $question->question,
				'score' => $question->score,
				'number' => $numquest,
				'level' => $question->level,
				'qtype' => $question->qtype
			);

			$crequest = Question::create($qarr);

			if($question->qtype == 'w'){

				$write = Writting::where('qid', '=', $question->qid)->first();
				$warr = array(
					'answer' => $write->answer,
					'numline' => $write->numline,
					'qid' => $crequest->qid
				);
				$crewrite = Writting::create($warr);
			}
			else if($question->qtype == 'c'){
				$choice = Choice::where('qid', '=', $question->qid)->first();
				$carr = array(
					'answer' => $choice->answer,
					'reason' => $choice->reason,
					'qid' => $crequest->qid
				);
				$crechoice = Choice::create($carr);

				$selection = Selection::where('cid', '=', $choice->cid)->get();

				foreach ($selection as $select) {
					$selearr = array(
						'text' => $select->text,
						'img' => $select->img,
						'number' => $select->number,
						'cid' => $crechoice->cid
					);
					$creselect = Selection::create($selearr);
				}
			}

			Sectionhasquestion::create(array('secid' => $data['secid'], 'qid' => $crequest->qid));
		}
		return Redirect::to('section/'.$exid.'/');
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