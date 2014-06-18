@extends('layouts.exam_endless')

@section('main')

{{ HTML::script('packages/ckeditor/ckeditor.js') }}
<h1>Create Question Choice</h1>
{{$exam = Input::get('exid')}}
{{$secid = Input::get('secid')}}
{{ Form::open(array('route' => array('choice.store','exid'=>$exam , 'secid'=>$secid), 'class'=>'form-horizontal no-margin form-border')) }}

        
        <div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">โจทย์</div>
				<div class="panel-body">
		            
					<div class="form-group">
	             	<label class="col-lg-1 control-label">คำถาม</label>
		             	<div class="col-lg-8">
		             		{{Form::textarea('question',null, array('class' => 'form-control input-sm','id'=>'editor1'))}}

		             	</div>
	             	</div><!--From group-->

	             	<div class="form-group">
	             	<label class="col-lg-1 control-label">จำนวนตัวเลือก</label>
		             	<div class="col-lg-8">
		             		{{Form::select('sel',array('2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6'),null,array('class'=>'form-control', 'id'=>'level'))}}

		             	</div>
	             	</div><!--From group-->

	             	<div class="form-group">
		             	<div class="panel-body" id="reply">
		             		<div class="form-group">
			    				<label class="col-lg-1 control-label">ตัวเลือกที่1</label>
			    				<div class="col-lg-8">
			    					<input name="text[]" type="text" class="form-control input-sm"/>
			    					<input type="hidden" name="number[]" value="1" >
			    				</div>
			    			</div>
			    			<div class="form-group">
			    				<label class="col-lg-1 control-label">ตัวเลือกที่2</label>
			    				<div class="col-lg-8">
			    					<input name="text[]" type="text" class="form-control input-sm"/>
			    					<input type="hidden" name="number[]" value="2" >
			    				</div>
			    			</div>
			    		</div>
	             	</div>

	             	<div class="form-group">
	             	<label class="col-lg-1 control-label">ข้อที่ถูกต้อง</label>
		             	<div class="col-lg-8">
		             		{{Form::select('answer',array('1'=>'1','2'=>'2'),null,array('class'=>'form-control', 'id'=>'answer'))}}

		             	</div>
	             	</div><!--From group-->

	             	<div class="form-group">
	             	<label class="col-lg-1 control-label">คะแนน</label>
		             	<div class="col-lg-8">
							{{Form::text('score',null, array('class' => 'form-control input-sm'))}}
		             		
		             	</div>
	             	</div><!--From group-->
	             	<div class="form-group">
	             		<label class="col-lg-1 control-label">เหตุผล</label>
		             	<div class="col-lg-8">
		             		{{Form::textarea('reason', null, array('class' => 'form-control input-sm','size'=>'x2'))}}
		             	</div>
	             	</div><!--From group-->
	             	<div class="form-group">
	             	<label class="col-lg-1 control-label">ความยาก</label>
		             	<div class="col-lg-8">
		             		{{Form::select('level',array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5'),null,array('class'=>'form-control'))}}

		             	</div>
	             	</div><!--From group-->
	             	

					<div class="form-group">
						<label class="col-lg-1 control-label">
							{{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
						</label>
					</div>
				</div>
        	</div>
        </div>
	
{{ Form::close() }}
	<script>
		CKEDITOR.replace('editor1',{
			toolbar: 'Basic'
		});
	</script>

	<script type="text/javascript">
	$(document).ready(function(){

		function numoption(){
			var num = 0;
			$("select#answer option").each(function(){
		    	num++;

		    });
		    return num;
		}

		$( "select#level" ).change(function() {
		    var str = "";
		    var currsel = $(this).val();
		    var numsel = numoption();
			
		    if(currsel > numsel){
		    	var diff = currsel - numsel;

		    	console.log("low: "+diff);
		    	for (var i = numsel; i < currsel; i++) {
		    		var ntpoint = i+1;
		    		$("select#answer")
		    			.append($("<option></option>")
		    			.attr("value", ntpoint)
		    			.text(ntpoint));

		    		$("div#reply").append(
		    			'<div class="form-group" id="ans'+(ntpoint)+'">'+
		    				'<label class="col-lg-1 control-label">ตัวเลือกที่'+(ntpoint)+'</label>'+
		    				'<div class="col-lg-8">'+
		    					'<input name="text[]" type="text" class="form-control input-sm"/>'+
		    					'<input type="hidden" name="number[]" value="'+(ntpoint)+'" >'+
		    				'</div>'+
		    			'</div>'
		    		);

		    	};


		    }
		    else if(currsel < numsel){
		    	var diff = numsel - currsel;
		    	var point = currsel;

		    	console.log("high");

		    	for (var i = 0; i < diff; i++) {
		    		point++;
		    		$("select#answer option[value='"+point+"']").remove();

		    		$("div#ans"+point+"").remove();		
		    	};
		    }
		    /*
		    $( "select option:selected" ).each(function() {
		      str += $( this ).text() + " ";
		    });*/

		    //$( "div" ).text( str );

		}).change();
	});
	</script>



@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop


