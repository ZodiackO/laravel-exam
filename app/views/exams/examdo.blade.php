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
					<div class="tab-content" id="conten"></div>
				</div>
			</div>
			<div class="row">
				<div class="panel-body">
					<div class="col-md-8">
						<button type="button" id="prev" class="btn btn-default btn-sm">Back</button>
						<button type="button" id="next" class="btn btn-success btn-sm">Next</button>
					</div>
				</div>
				
			</div>
		</div><!-- /.padding-md -->
	</div>
</div>

<script>

	$(document).ready(function() {
		var tab = "";
		var con = "";
		var count = 1;

		@foreach( $examinations as $examination )
			var empty = {{ $selections = ChoicesController::select($examination->qid) }} ;
			tab += '<li id="'+count+'"><a href="#q'+count+'" data-toggle="tab"><i class="fa fa-home"></i> Home</a></li>';
			con += '<div class="tab-pane fade" id="q'+count+'" value="{{ $examination->qid }}">'
						+'<h4>Question '+count+'/{{ $examination->numofquestion }}</h4>'
						+'<h5>คำถาม: {{ trim(strip_tags($examination->question)) }}</h5>'
						+'@foreach($selections as $selection)'
							+'<label class="label-radio">'
								+'<input type="radio" name="type" value="{{ $selection->selectid }}">'
								+'<span class="custom-radio"></span>'
								+'{{ $selection->text }}'
							+'</label>'
						+'@endforeach'
					+'</div>';
			count++;
		@endforeach

		$('ul#tabb').html(tab);
		$('div#conten').html(con);
		
		$('li#1').addClass("active");
		$('div#q1').addClass("active in");

		var currentq = 1;
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
			

		});





	});
</script>

@stop

