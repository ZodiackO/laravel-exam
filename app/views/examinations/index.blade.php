@extends('layouts.scaffold')

@section('main')

<h1>All Examination Index</h1>

<p>{{ link_to_route('examination.create', 'Add new exam', array('courseid'=>$course)) }}</p>
{{$course}}
@if ($examinations->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th></th>
				<th>เรื่อง</th>
				<th>ปีการศึกษา</th>
				<th>ชนิด</th>
				<th>จำนวนข้อ</th>
				<th>คะแนน</th>
				<th>Date</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach ($examinations as $examination)
				<tr>
					<td></td>
					<td>{{ $examination->subject }}</td>
					<td>{{ $examination->acyear }}</td>
					<td>{{ $examination->type }}</td>
					<td>{{ $examination->numofquestion }}</td>
					<td>{{ $examination->score }}</td>
					<td></td>
                    <td>
                    	
                    	{{ Form::open(array('method' => 'DELETE', 'route' => array('examination.destroy', $examination->exid))) }}
                    		{{ link_to_route('examination.edit', 'Edit', array($examination->exid), array('class' => 'btn btn-info')) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                            <a href="{{ URL::route('section',array($examination->exid)) }}" class="btn btn-success">Enter</a>
                            <a href="{{ URL::route('export',array('exam' => $examination->exid)) }}" target="_blank" class="btn btn-warning">Export</a>
                        {{ Form::close() }}
                    </td>

				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no members
@endif

@stop
