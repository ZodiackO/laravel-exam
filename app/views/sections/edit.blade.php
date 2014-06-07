@extends('layouts.scaffold')

@section('main')

<h1>Create Section</h1>
{{ Form::model($section, array('method' => 'PATCH', 'route' => array('section.update', $section->secid),'class'=>'form-horizontal no-margin')) }}
	<ul>
        <li>
            {{ Form::label('name', 'ตอน:') }}
            {{ Form::text('name') }}
        </li>
        
		<li>
			{{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop

