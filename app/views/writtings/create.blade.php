@extends('layouts.exam_endless')

@section('main')

{{ HTML::script('packages/ckeditor/ckeditor.js') }}
<h1>Create Question Writing</h1>
{{$exam = Input::get('exid')}}
{{$secid = Input::get('secid')}}
{{ Form::open(array('route' => array('writting.store','exid'=>$exam , 'secid'=>$secid), 'class'=>'form-horizontal no-margin form-border')) }}

        
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
	             	<label class="col-lg-1 control-label">คะแนน</label>
		             	<div class="col-lg-8">
							{{Form::text('score',null, array('class' => 'form-control input-sm'))}}
		             		
		             	</div>
	             	</div><!--From group-->
	             	<div class="form-group">
	             		<label class="col-lg-1 control-label">เฉลย</label>
		             	<div class="col-lg-8">
		             		{{Form::textarea('answer', null, array('class' => 'form-control input-sm','size'=>'x2'))}}
		             	</div>
	             	</div><!--From group-->

	             	<div class="form-group">
	             	<label class="col-lg-1 control-label">ช่องคำตอบ</label>
		             	<div class="col-lg-1">
							{{Form::text('numline','1', array('class' => 'form-control input-sm'))}}
		             	</div>
		             	<label class="col-lg-1 control-label" style="text-align:left;">
		             		บรรทัด
		             	</label>
	             	</div><!--From group-->

	             	<!--div class="form-group">
	             	<label class="col-lg-1 control-label">ช่องคำตอบ</label>
		             	<div class="col-lg-10">
		             		<label class="label-radio">
								<input type="radio" name="num" class="more" value="1" checked="">
								<span class="custom-radio"></span>
								กลางภาค {{Form::text('numline',null, array('class' => 'form-control input-sm'))}}
							</label>
							<label class="label-radio">
								<input type="radio" name="num" value="2">
								<span class="custom-radio"></span>
								กลางภาค {{Form::text('num',null, array('class' => 'form-control input-sm'))}}
							</label>
		             	</div>
		             	<label class="col-lg-1 control-label" style="text-align:left;">
		             		บรรทัด
		             	</label>
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
	/*
		$(document).ready(function() {
		  $("input[name='numline']").hide();

		  $("label input[type='radio']").change(function() {
		    if ($(this).hasClass('more')) $(this).next().show();
		    else $(this).parent().children("input[type='text']").hide();
		  });

		});*/
	</script>  

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop


