@extends('layouts.exam_endless')

@section('breadC')
	<li class="active">Course</li>	 
@stop

@section('main')

<div class="panel panel-default">
	<div class="panel-heading">
		<span class="label label-info pull-right">{{$courses->count()}} Items</span>
		<h1>All Courses</h1>
		<p>{{ link_to_route('courses.create', 'Add new course') }}</p>
	</div>


@if ($courses->count())
	<div class="panel panel-default table-responsive">
		<div class="padding-md clearfix">
			<div id="dataTable_wrapper" class="dataTables_wrapper" role="grid">
				<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix"></div>

				<table class="table table-striped dataTable" id="dataTable" aria-describedby="dataTable_info">
					<thead>
						<tr role="row">
							<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" style="width: 80px;">
								<div class="DataTables_sort_wrapper">
									
								</div>
							</th>
							
							<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 97px;">
								<div class="DataTables_sort_wrapper">รหัสวิชา
									
								</div>
							</th>
							<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 331px;">
								ชื่อวิชา
							</th>
							<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 135px;">
								จำนวนฉบับข้อสอบ
							</th>
							<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 101px;">
								Date
							</th>
							<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 140px;"></th>
						</tr>
					</thead>
						
					<tbody role="alert" aria-live="polite" aria-relevant="all">
						@foreach ($courses as $course)
							<tr class="odd">
								<td class=" "></td>
								<td class=" ">{{ $course->code }}</td>
								<td class=" ">{{ $course->name }}</td>
								<td class=" "></td>
								<td class=" ">{{ $course->updated_at}}</td>
								<td class=" ">
								{{ Form::open(array('method' => 'DELETE', 'route' => array('courses.destroy', $course->courseid))) }}
		                    		{{ link_to_route('courses.edit', 'Edit', array($course->courseid), array('class' => 'btn btn-sm btn-info')) }}
		                            {{ Form::submit('Delete', array('class' => 'btn btn-sm btn-danger')) }}
		                            <a href="{{ URL::route('exam',array($course->courseid)) }}" class="btn btn-sm btn-success" id="changebc">Enter</a>
		                        {{ Form::close() }}
		                        
								</td>
							</tr>
						@endforeach
						
						</tbody>
					</table>
					<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-bl ui-corner-br ui-helper-clearfix">
						
					</div>
		</div><!-- /.padding-md -->
	</div>
</div>
@else
	There are no members
@endif

<script>
		$(function	()	{
			$('#dataTable').dataTable( {
				"bJQueryUI": true,
				"sPaginationType": "full_numbers"
			});
			
			$('#chk-all').click(function()	{
				if($(this).is(':checked'))	{
					$('#responsiveTable').find('.chk-row').each(function()	{
						$(this).prop('checked', true);
						$(this).parent().parent().parent().addClass('selected');
					});
				}
				else	{
					$('#responsiveTable').find('.chk-row').each(function()	{
						$(this).prop('checked' , false);
						$(this).parent().parent().parent().removeClass('selected');
					});
				}
			});
		});
	</script>
@stop

