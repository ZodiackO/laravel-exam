@extends('layouts.exam_endless')

@section('breadC')
	<li class="active">Exams</li>	 
@stop

@section('main')

<div class="panel panel-default">
	<div class="panel-heading">
		<span class="label label-info pull-right">{{sizeof($examinations)}} Items</span>
		<h1>Exams</h1>
	</div>


@if (sizeof($examinations) != 0)
	<div class="panel panel-default table-responsive">
		<div class="padding-md clearfix">
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>ข้อสอบ</th>
						<th></th>
						<th>จำนวนข้อ</th>
						<th>จำนวนผู้เข้าทำ</th>
						<th>ระดับความยาก</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($examinations as $examination)
						<tr>
							<td>{{ $examination->subject }}</td>
							<td><a href="{{ URL::route('exams-detail',array('exid' => $examination->exid, 'avg_level' => round($examination->avgrage_level))) }}" class="btn btn-sm btn-success">Take</a></td>
							<td>{{ $examination->numofquestion }}</td>
							<td></td>
							<td>{{ round($examination->avgrage_level) }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div><!-- /.padding-md -->
	</div>
</div>
@else
	There are no members
@endif


@stop

