@extends('layouts.exam_endless')

@section('breadC')
	<li><a href="http://localhost:8000/courses">Course</a></li>
	<li class="active">Examination</li>	 
@stop

@section('main')

<div class="panel panel-default">
	<div class="panel-heading">
		<span class="label label-info pull-right">{{$examgenerals->count()}} Items</span>
		<h1>All Examination Index</h1>
		<p>{{ link_to_route('exam-before_create', 'Add new exam', array('courseid'=>$course)) }}</p>
	</div>



	<div class="panel-tab clearfix">
		<ul class="tab-bar">
			<li class="active"><a href="#general" data-toggle="tab"><i class="fa fa-home"></i> General</a></li>
			<li class=""><a href="#online" data-toggle="tab"><i class="fa fa-pencil"></i> Online</a></li>
		</ul>
	</div>
	<div class="panel-body">
		<div class="tab-content">
			<div class="tab-pane fade active in" id="general">
				<!-- container -->
				@if ($examgenerals->count())
				<div class="panel panel-default table-responsive">
					<div class="padding-md clearfix">
						<div id="dataTable_wrapper" class="dataTables_wrapper" role="grid">
							<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix"></div>

							<table class="table table-striped dataTable" id="dataTable" aria-describedby="dataTable_info">
								<thead>
									<tr role="row">
										<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" style="width: 10px;">

										</th>
										
										<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 200px;">
											ชื่อข้อสอบ
										</th>
										<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 90px;">
											ปีการศึกษา
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
									@foreach ($examgenerals as $examgeneral)
										<tr class="odd">
											<td class=" "></td>
											<td class=" ">{{ $examgeneral->subject }}</td>
											<td class=" ">{{ $examgeneral->acyear }}</td>
											<td class=" ">{{ $examgeneral->type }}</td>
											<td class=" ">{{ $examgeneral->numofquestion }}</td>
											<td class=" ">{{ $examgeneral->score }}</td>
											<td class=" ">{{ $examgeneral->updated_at }}</td>
											<td class=" ">
			                    			{{ Form::open(array('method' => 'DELETE', 'route' => array('examination.destroy', $examgeneral->exid))) }}
					                    		{{ link_to_route('examination.edit', 'Edit', array($examgeneral->exid), array('class' => 'btn btn-sm btn-info')) }}
					                            {{ Form::submit('Delete', array('class' => 'btn btn-sm btn-danger')) }}
					                            <a href="{{ URL::route('section',array($examgeneral->exid)) }}" class="btn btn-sm btn-success">Enter</a>
			                            		<a href="{{ URL::route('export',array('exam' => $examgeneral->exid)) }}" target="_blank" class="btn btn-sm btn-warning">Export</a>
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
				There are no exam general
			@endif			
			</div>
			<div class="tab-pane fade" id="online">
				<!-- container -->
				@if ($examonlines->count())
				<div class="panel panel-default table-responsive">
					<div class="padding-md clearfix">
						<div id="dataTable_wrapper" class="dataTables_wrapper" role="grid">
							<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix"></div>

							<table class="table table-striped dataTable" id="dataTable" aria-describedby="dataTable_info">
								<thead>
									<tr role="row">
										<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" style="width: 10px;">

										</th>
										
										<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 200px;">
											ชื่อข้อสอบ
										</th>
										<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 80px;">
											จำนวนข้อสอบ
										</th>
										<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 50px;">
											คะแนน
										</th>
										<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 70px;">
											ผ่าน
										</th>
										<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 70px;">
											เวลา
										</th>
										<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 101px;">
											Date
										</th>
										<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 200px;"></th>
									</tr>
								</thead>
									
								<tbody role="alert" aria-live="polite" aria-relevant="all">
									@foreach ($examonlines as $examonline)
										<tr class="odd">
											<td class=" "></td>
											<td class=" ">{{ $examonline->subject }}</td>
											<td class=" ">{{ $examonline->numofquestion }}</td>
											<td class=" ">{{ $examonline->score }}</td>
											<td class=" ">{{ $examonline->scorepass }}</td>
											<td class=" ">{{ $examonline->timemake }} นาที</td>
											<td class=" ">{{ $examonline->updated_at }}</td>
											<td class=" ">
			                    			{{ Form::open(array('method' => 'DELETE', 'route' => array('examination.destroy', $examonline->exid))) }}
					                    		{{ link_to_route('examination.edit', 'Edit', array($examonline->exid), array('class' => 'btn btn-sm btn-info')) }}
					                            {{ Form::submit('Delete', array('class' => 'btn btn-sm btn-danger')) }}
					                            <a href="{{ URL::route('section',array($examonline->exid)) }}" class="btn btn-sm btn-success">Enter</a>
			                            		<a href="{{ URL::route('export',array('exam' => $examonline->exid)) }}" target="_blank" class="btn btn-sm btn-warning">Export</a>
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
				There are no exam online
			@endif			
			</div>
		</div>
	</div>







@stop
