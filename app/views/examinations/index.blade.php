@extends('layouts.exam_endless')

@section('breadC')
	<li><a href="http://localhost:8000/courses">Course</a></li>
	<li class="active">Examination</li>	 
@stop

@section('main')

<div class="panel panel-default">
	<div class="panel-heading">
		<span class="label label-info pull-right">{{$examinations->count()}} Items</span>
		<h1>All Examination Index</h1>
		<p>{{ link_to_route('examination.create', 'Add new exam', array('courseid'=>$course)) }}</p>
	</div>


@if ($examinations->count())
	<div class="panel panel-default table-responsive">
		<div class="padding-md clearfix">
			<div id="dataTable_wrapper" class="dataTables_wrapper" role="grid">
				<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix"></div>

				<table class="table table-striped dataTable" id="dataTable" aria-describedby="dataTable_info">
					<thead>
						<tr role="row">
							<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" style="width: 80px;">

							</th>
							
							<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 200px;">
								ชื่อข้อสอบ
							</th>
							<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 90px;">
								ปัการศึกษา
							</th>
							<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 70px;">
								ชนิด
							</th>
							<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 80px;">
								จำนวนข้อสอบ
							</th>
							<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 50px;">
								คะแนน
							</th>
							<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 101px;">
								Date
							</th>
							<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 200px;"></th>
						</tr>
					</thead>
						
					<tbody role="alert" aria-live="polite" aria-relevant="all">
						@foreach ($examinations as $examination)
							<tr class="odd">
								<td class=" "></td>
								<td class=" ">{{ $examination->subject }}</td>
								<td class=" ">{{ $examination->acyear }}</td>
								<td class=" ">{{ $examination->type }}</td>
								<td class=" ">{{ $examination->numofquestion }}</td>
								<td class=" ">{{ $examination->score }}</td>
								<td class=" ">{{ $examination->updated_at }}</td>
								<td class=" ">
                    			{{ Form::open(array('method' => 'DELETE', 'route' => array('examination.destroy', $examination->exid))) }}
		                    		{{ link_to_route('examination.edit', 'Edit', array($examination->exid), array('class' => 'btn btn-sm btn-info')) }}
		                            {{ Form::submit('Delete', array('class' => 'btn btn-sm btn-danger')) }}
		                            <a href="{{ URL::route('section',array($examination->exid)) }}" class="btn btn-sm btn-success">Enter</a>
                            		<a href="{{ URL::route('export',array('exam' => $examination->exid)) }}" target="_blank" class="btn btn-sm btn-warning">Export</a>
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

@stop
