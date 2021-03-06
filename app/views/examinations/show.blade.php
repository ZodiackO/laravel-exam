@extends('layouts.scaffold')

@section('main')

<h1>All Examination</h1>

<p>{{ link_to_route('examination.create', 'Add new exam') }}</p>


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
                    	
                    	{{ Form::open(array('method' => 'DELETE', 'route' => array('courses.destroy', $course->courseid))) }}
                    		{{ link_to_route('courses.edit', 'Edit', array($course->courseid), array('class' => 'btn btn-info')) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                            <a href="{{ URL::route('exam',array($course->courseid)) }}" class="btn btn-success">Enter</a>
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
