@extends('layouts.scaffold')

@section('main')

<h1>Create Section</h1>
{{$exam = Input::get('exid')}}
{{ Form::open(array('route' => array('section.store','exid'=>$exam))) }}
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


