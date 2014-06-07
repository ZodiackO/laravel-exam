<?php
use Sunra\PhpSimple\HtmlDomParser;
require_once 'app/libraries/Htmltodocx/htmltodocx_converter/h2d_htmlconverter.php';

class ExportController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /export
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	public function export(){

		$exid = Input::get('exam');
		$exam = Examination::where('exid','=',$exid)->first();
		$course = Course::where('courseid','=',$exam->courseid)->first();

		$arr_command = explode(',', $exam->command);
		$commands = Command::whereIn('cmid',$arr_command)->get();

		$date = ExportController::date($exam->date);
		$secs = Section::where('exid', '=', $exid)->get();
		$quests = DB::table('section')
			->join('sectionhasquestion', 'section.secid', '=', 'sectionhasquestion.secid')
			->join('question', 'sectionhasquestion.qid', '=', 'question.qid')
			->join('writting', 'question.qid', '=', 'writting.qid')
			->where('section.exid', '=', $exid)
			->orderBy('question.number','asc')
			->get();

		//return $quests;

		$phpWord = new \PhpOffice\PhpWord\PhpWord();
		
		$template = $phpWord->loadTemplate('finTerm53-1.docx');
		$template->setValue('course', $course->name);
		$template->setValue('code', $course->code);
		$template->setValue('credit', $exam->credit);
		$template->setValue('faculty', $exam->faculty);
		$template->setValue('major', $exam->major);
		$template->setValue('day', $date['day']);
		$template->setValue('month', $date['month']);
		$template->setValue('year', $date['year']);
		$template->setValue('tstart', $exam->examtime_start);
		$template->setValue('tend', $exam->examtime_end);
		$template->setValue('term', $exam->term);
		$template->setValue('acyear', $exam->acyear);
		$template->setValue('teacher', $exam->examwriter);


		$template->cloneRow('command', $commands->count());
		
		$count = 0;
		foreach ($commands as $command) {
			$count++;
			$hcm = $count == 1 ? 'คำสั่ง':'';
			$template->setValue('hcommand#'.$count, $hcm);
			$template->setValue('cnum#'.$count, $count.'.');
			$template->setValue('command#'.$count, $command->info);
		}


		$code = $course->code;
		$term = $exam->term;
		$acyear = $exam->acyear;
		$arr_type = array('1'=>'Final', '2'=>'Mid');
		$type = $arr_type[$exam->type];
		$filename = $code.'_'.$type.'_'.$term.'_'.$acyear.'.docx';

		$template->saveAs('public/packages/results/doc1.docx');
		//rename($filename, 'public/packages/results/doc1.docx');

/*---------------------------------HTMLtoDocx--------------------------------------*/
		$html_dom = new Htmltodocx\simple_html_dom();
		//$html_dom->load('<html><body><p>xxxxx</p></body></html>');
		//$html_dom_array = $html_dom->find('html',0)->children();

		//$phpword_object = new \PhpOffice\PhpWord\PhpWord();
		//$section1 = $phpword_object->createSection();

		$initial_state = array(
		  // Required parameters:
		  'phpword' => &$phpword, // Must be passed by reference.
		  // Optional parameters - showing the defaults if you don't set anything:
		  'current_style' => array('size' => '11'), // The PHPWord style on the top element - may be inherited by descendent elements.
		  'parents' => array(0 => 'body'), // Our parent is body.
		  'list_depth' => 0, // This is the current depth of any current list.
		  'context' => 'section', // Possible values - section, footer or header.
		  'pseudo_list' => TRUE, // NOTE: Word lists not yet supported (TRUE is the only option at present).
		  'pseudo_list_indicator_font_name' => 'Wingdings', // Bullet indicator font.
		  'pseudo_list_indicator_font_size' => '7', // Bullet indicator size.
		  'pseudo_list_indicator_character' => 'l ', // Gives a circle bullet point with wingdings.
		  'table_allowed' => TRUE, // Note, if you are adding this html into a PHPWord table you should set this to FALSE: tables cannot be nested in PHPWord.
		  'treat_div_as_paragraph' => TRUE, // If set to TRUE, each new div will trigger a new line in the Word document.
		      
		  // Optional - no default:    
		  'style_sheet' => $this->htmltodocx_styles_example(), // This is an array (the "style sheet") - returned by htmltodocx_styles_example() here (in styles.inc) - see this function for an example of how to construct this array.
		  );   
		/*
		htmltodocx_insert_html($section1, $html_dom_array[0]->nodes, $initial_state);

		$html_dom->clear(); 
		unset($html_dom);

		$objWriter1 = \PhpOffice\PhpWord\IOFactory::createWriter($phpword_object, 'Word2007');
		$objWriter1->save('public/packages/results/htmltodoc.docx');
		*/
/*___________________________________________________________________________________________*/
		
		

/*---------------------------------------Question--------------------------------------------*/
		$phpWord->setDefaultFontName('Browallia New');
		$phpWord->setDefaultFontSize(16);
		$phpWord->addFontStyle('fTitle', array('bold'=>true, 'size'=>20));
		$phpWord->addParagraphStyle('pTitle', array('align'=>'center', 'spaceBefore'=>240, 'spaceAfter'=>120));
		$phpWord->addParagraphStyle('pStyle', array());
		$sectionSettings = array(
			'marginTop' => 1080,
			'marginLeft' => 1250,
			'marginBottom' => 900,
			'marginRight' => 1250
		);
		$line = '________________________________________________________________________________';
		$section = $phpWord->createSection($sectionSettings);
		$textrun = $section->createTextRun('pStyle');

		//$section->addImage('public/packages/img/dpu_logo.png',
		//	array('wrappingStyle' => 'behind'));
		//$section->addTextBreak(1);
		foreach ($secs as $sec) {
			$textrun->addText('ตอนที่ '.$sec->number, array('bold'=>true, 'underline'=>'single'));
			$textrun->addText('  '.$sec->name);
			$textrun->addTextBreak(2);
			foreach ($quests as $quest) {
				if($quest->secid == $sec->secid){
					$textrun->addText($quest->number.'.');
					$textrun->addText('('.$quest->score.' คะแนน)');
					
					$textrun->addText('  '.strip_tags($quest->wquestion));
					//$html_dom->load('<html><body>'.$quest->wquestion.'</body></html>');
					//$html_dom_array = $html_dom->find('html',0)->children();
					//htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $initial_state);
					for ($i=0; $i < $quest->numline; $i++) { 
						$textrun->addTextBreak(1);
						$textrun->addText($line);
					}
					$textrun->addTextBreak(2);
				}
				
			}
			$textrun->addTextBreak(2);

		}
		

		$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
		$objWriter->save('public/packages/results/doc2.docx');
		
		//$zip = new Tbszip\clsTbsZip();

		/* Merge Docx 2 file */
		$merge = new Phpdocx\DocxUtilities();
		$myOptions = array('mergeType' => 0);
		$merge->mergeDocx('public/packages/results/doc1.docx', 'public/packages/results/doc2.docx', 'public/packages/results/'.$filename, $myOptions);
		

		$file = public_path().'/packages/results/'.$filename;
		$headers = array(
			'Content-Type'=>'application/docx'
		);

		return Response::download($file, $filename, $headers);
	}


	public function date($str){
		$month = array(
			'01' => 'มกราคม',
			'02' => 'กุมภาพันธ์',
			'03' => 'มีนาคม',
			'04' => 'เมษายน',
			'05' => 'พฤษภาคม',
			'06' => 'มิถุนายน',
			'07' => 'กรกฎาคม',
			'08' => 'สิงหาคม',
			'09' => 'กันยายน',
			'10' => 'ตุลาคม',
			'11' => 'พฤศจิกายน',
			'12' => 'ธันวาคม',
		);

		$date = explode('-', $str);
		$date[0] = $date[0]+543;

		$arr_date = array(
			'day' => $date[2],
			'month' => $month[$date[1]],
			'year' => $date[0]
		);

		return $arr_date;
	}



	public function htmltodocx_styles_example() {
  
	  // Set of default styles - 
	  // to set initially whatever the element is:
	  // NB - any defaults not set here will be provided by PHPWord.
	  $styles['default'] = 
	    array (
	      'size' => 11,
	    );
	  
	  // Element styles:
	  // The keys of the elements array are valid HTML tags;
	  // The arrays associated with each of these tags is a set
	  // of PHPWord style definitions.
	  $styles['elements'] = 
	    array (
	      'h1' => array (
	        'bold' => TRUE,
	        'size' => 20,
	        ),
	      'h2' => array (
	        'bold' => TRUE,
	        'size' => 15,
	        'spaceAfter' => 150,
	        ),
	      'h3' => array (
	        'size' => 12,
	        'bold' => TRUE,
	        'spaceAfter' => 100,
	        ),
	      'li' => array (
	        ),
	      'ol' => array (
	        'spaceBefore' => 200,
	        ),
	      'ul' => array (
	        'spaceAfter' => 150,
	        ),
	      'b' => array (
	        'bold' => TRUE,
	        ),
	      'em' => array (
	        'italic' => TRUE,
	        ),
	      'i' => array (
	        'italic' => TRUE,
	        ),
	      'strong' => array (
	        'bold' => TRUE,
	        ),
	      'b' => array (
	        'bold' => TRUE,
	        ),
	      'sup' => array (
	        'superScript' => TRUE,
	        'size' => 6,
	        ), // Superscript not working in PHPWord 
	      'u' => array (
	        'underline' => PHPWord_Style_Font::UNDERLINE_SINGLE,
	        ),
	      'a' => array (
	        'color' => '0000FF',
	        'underline' => PHPWord_Style_Font::UNDERLINE_SINGLE,
	        ),
	      'table' => array (
	        // Note that applying a table style in PHPWord applies the relevant style to
	        // ALL the cells in the table. So, for example, the borderSize applied here
	        // applies to all the cells, and not just to the outer edges of the table:
	        'borderColor' => '000000',  
	        'borderSize' => 10,
	        ),
	      'th' => array (
	        'borderColor' => '000000',
	        'borderSize' => 10,
	        ),
	      'td' => array (
	        'borderColor' => '000000',
	        'borderSize' => 10,
	        ),
	      );
	      
	  // Classes:
	  // The keys of the classes array are valid CSS classes;
	  // The array associated with each of these classes is a set
	  // of PHPWord style definitions.
	  // Classes will be applied in the order that they appear here if
	  // more than one class appears on an element.
	  $styles['classes'] = 
	    array (
	      'underline' => array (
	        'underline' => PHPWord_Style_Font::UNDERLINE_SINGLE,
	        ),
	       'purple' => array (
	        'color' => '901391',
	       ),
	       'green' => array (
	        'color' => '00A500',
	       ),
	      );
	  
	  // Inline style definitions, of the form:
	  // array(css attribute-value - separated by a colon and a single space => array of
	  // PHPWord attribute value pairs.    
	  $styles['inline'] = 
	    array(
	      'text-decoration: underline' => array (
	        'underline' => PHPWord_Style_Font::UNDERLINE_SINGLE,
	      ),
	      'vertical-align: left' => array (
	        'align' => 'left',
	      ),
	      'vertical-align: middle' => array (
	        'align' => 'center',
	      ),
	      'vertical-align: right' => array (
	        'align' => 'right',
	      ),
	    );
	    
	  return $styles;
	}

}