@extends('layouts.exam_endless')

@section('main')

{{ HTML::script('packages/ckeditor/ckeditor.js') }}
<h1>Create Question Writing</h1>


{{ Form::model($question, array('method' => 'PATCH', 'route' => array('question.update', $question->qid),'class'=>'form-horizontal no-margin')) }}
        
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
	             	<label class="col-lg-1 control-label">ความยาก</label>
		             	<div class="col-lg-8">
		             		{{Form::select('level',array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5'),null,array('class'=>'form-control'))}}

		             	</div>
	             	</div><!--From group-->
	             	

					<div class="form-group">
						<label class="col-lg-1 control-label">
							{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
							{{ link_to_route('section.show', 'Cancel', array($question->exid), array('class' => 'btn')) }}
						</label>
					</div>
				</div>
        	</div>
        </div>
	
{{ Form::close() }}
	<script>
		window.onload = function(){
			var data = document.getElementById('editor1').value;
			//data = data.toString();

			CKEDITOR.replace('wquestion',{
				toolbar: 'Basic'
			});
			CKEDITOR.instances.editor1.setData(data);
		}

		
	</script>


@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop


