@extends('layouts.scaffold')

@section('main')

<h1>Show Member</h1>

<p>{{ link_to_route('members.index', 'Return to all members') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Name</th>

				<th>Nickname</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $member->name }}}</td>

					<td>{{{ $member->nickname }}}</td>

                    <td>{{ link_to_route('members.edit', 'Edit', array($member->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('members.destroy', $member->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
