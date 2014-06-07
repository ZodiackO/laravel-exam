@extends('layouts.scaffold')

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
		             		{{Form::textarea('wquestion',null, array('class' => 'form-control input-sm','id'=>'editor1'))}}

		             	</div>
	             	</div><!--From group-->

	             	<label class="col-lg-1 control-label">จำนวนตัวเลือก</label>
		             	<div class="col-lg-8">
		             		{{Form::select('level',array('2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6'),null,array('class'=>'form-control'))}}

		             	</div>
	             	</div><!--From group-->

	             	<label class="col-lg-1 control-label">ข้อที่ถูกต้อง</label>
		             	<div class="col-lg-8">
		             		{{Form::select('answer',array('2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6'),null,array('class'=>'form-control'))}}

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
		             		{{Form::textarea('answer', null, array('class' => 'form-control input-sm','size'=>'x2'))}}
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


@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop


