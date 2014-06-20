@extends('layouts.exam_endless')

@section('breadC')
	<li class="active">Create Exam</li>	 
@stop

@section('main')

<h1>Choose type exam</h1>

<a href="{{ URL::route('exam-create',array('courseid'=>$courseid)) }}" class="btn btn-default quick-btn"><i class="fa fa-book"></i><span>General</span></a>
<a href="{{ URL::route('exam-create-online',array('courseid'=>$courseid)) }}" class="btn btn-default quick-btn"><i class="fa fa-globe"></i><span>Online</span></a>

@stop
