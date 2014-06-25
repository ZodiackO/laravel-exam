@extends('layouts.exam_endless')

@section('breadC')
	<li class="active">Exams</li>	 
@stop

@section('main')

<div class="panel panel-default">
	<div class="panel-heading">
		<h2>ข้อสอบ {{ $exsubject }}</h2>
	</div>


	<div class="panel panel-default table-responsive">
		<div class="padding-md">
			<div class="row">
				<div class="col-md-8">
					<div class="panel-tab clearfix">
						<ul class="tab-bar" id="tabb" hidden></ul>
					</div>
					{{ Form::open(array('route' => array('exams-checkans'))) }}
					<div class="tab-content" id="conten"></div>
				</div>
			</div>
				<input type="hidden" name="question" value="">
				<input type="hidden" name="exid" value="{{ $exid }}">
				<input type="hidden" name="timetake" value="">
				<input type="hidden" name="avg_level" value="{{ $avg_level }}">
			<div class="row">
				<div class="panel-body">
					<div class="col-md-8">
						<button type="button" id="prev" class="btn btn-default">Back</button>
						<button type="button" id="next" class="btn btn-success" >Next</button>
						<button type="submit" id="finish" class="btn btn-danger" style="display:none;">Finish</button>
					</div>
				</div>
					{{ Form::close() }}
			</div>
		</div><!-- /.padding-md -->
	</div>
</div>

<script>

	$(document).ready(function() {
		var tab = "";
		var con = "";
		var count = 1;
		var quest =[];

		@foreach( $examinations as $examination )
			var empty = {{ $selections = ChoicesController::select($examination->qid) }} ;
			tab += '<li id="'+count+'"><a href="#q'+count+'" data-toggle="tab"><i class="fa fa-home"></i> Home</a></li>';
			con += '<div class="tab-pane fade" id="q'+count+'" value="{{ $examination->qid }}">'
						+'<h4>Question '+count+'/{{ $examination->numofquestion }}</h4>'
						+'<h5>คำถาม: {{ trim(strip_tags($examination->question)) }}</h5>'
						+'@foreach($selections as $selection)'
							+'<label class="label-radio">'
								+'<input type="radio" name="q{{$examination->qid}}" value="{{ $selection->number }}">'
								+'<span class="custom-radio"></span>'
								+'{{ $selection->text }}'
							+'</label>'
						+'@endforeach'
					+'</div>';
			quest.push('{{ $examination->qid }}');
			count++;
		@endforeach
		console.log('question: '+quest.toString());
		$('input[name="question"]').val(quest.toString());

		$('ul#tabb').html(tab);
		$('div#conten').html(con);
		
		$('li#1').addClass("active");
		$('div#q1').addClass("active in");

		var currentq = 1;
		checkbtn();

		$('button#next').on('click',function(){
			console.log(count+'='+currentq);
			if(currentq > (count-2)){
				return false;
			}
			else{
				$('li#'+currentq).removeClass("active");
				$('div#q'+currentq).removeClass("active in");

				currentq++;
				$('li#'+currentq).addClass("active");
				$('div#q'+currentq).addClass("active in");
			}
			checkbtn();

		});
		$('button#prev').on('click',function(){
			console.log(count+'='+currentq);
			if(currentq > 1){
				$('li#'+currentq).removeClass("active");
				$('div#q'+currentq).removeClass("active in");

				currentq--;
				$('li#'+currentq).addClass("active");
				$('div#q'+currentq).addClass("active in");
			}
			else{
				return false;
			}
			
			checkbtn();
		});

		function checkbtn(){
			console.log(currentq);
			if(currentq == 1){
				$('button#prev').prop('disabled', true);
			}
			else{
				$('button#prev').prop('disabled', false);
			}

			if(currentq > (count-2)){
				document.getElementById('finish').style.display = 'block';
				document.getElementById('next').style.display = 'none';
			}
		}



	});
</script>

@stop

