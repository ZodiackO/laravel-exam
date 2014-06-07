@extends('layouts.scaffold')

@section('main')

<h1>All Courses</h1>

<p>{{ link_to_route('courses.create', 'Add new course') }}</p>

@if ($courses->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th></th>
				<th>รหัสวิชา</th>
				<th>ชื่อวิชา</th>
				<th>จำนวนฉบับข้อสอบ</th>
				<th>Date</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach ($courses as $course)
				<tr>
					<td></td>
					<td>{{{ $course->code }}}</td>
					<td>{{{ $course->name }}}</td>
					<td></td>
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
