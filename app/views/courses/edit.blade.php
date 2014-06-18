@extends('layouts.exam_endless')
 
@section('main')

<h1>Edit Member</h1>
{{ Form::model($course, array('method' => 'PATCH', 'route' => array('courses.update', $course->courseid),'class'=>'form-horizontal no-margin')) }}
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
					<div class="col-lg-12">
						{{ Form::label('name', 'ชื่อวิชา:',array('class' => 'col-lg-2 control-label')) }}
						<div class="col-lg-8">
							{{Form::text('name',null, array('class' => 'form-control input-sm'))}}
						</div>
					</div><!-- /.col -->

				</div><!--From group-->
				<div class="form-group">
					<div class="col-lg-12">
						{{ Form::label('code', 'รหัสวิชา:',array('class' => 'col-lg-2 control-label')) }}
						<div class="col-lg-3">
							{{Form::text('code',null, array('class' => 'form-control input-sm code', 'placeholder' => 'XX999'))}}
						</div>
					</div><!-- /.col -->
				</div>
				{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
				{{ link_to_route('courses.index', 'Cancel', null, array('class' => 'btn')) }}
			</div>
		</div>
	</div>

{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
