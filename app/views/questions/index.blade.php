@extends('layouts.exam_endless')

@section('main')

<h1>All Question Index</h1>


<a href="choice/create?secid={{$secid}}&exid={{$exid}}" class="btn btn-default quick-btn"><i class="fa fa-circle-o"></i><span>Choice</span></a>
<a href="writting/create?secid={{$secid}}&exid={{$exid}}" class="btn btn-default quick-btn"><i class="fa fa-pencil"></i><span>Writing</span></a>

@stop
