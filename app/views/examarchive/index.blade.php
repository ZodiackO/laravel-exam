@extends('layouts.exam_endless')

@section('breadC')
	<li class="active">คลังข้อสอบ</li>	 
@stop

@section('main')

<div class="panel panel-default">
	<div class="panel-heading">
		<span class="label label-info pull-right">{{$courses->count()}} Items</span>
		<h2>คลังข้อสอบ</h2>
		<p>
			{{ link_to(route('section',array("exid"=>$exid)), 'Back') }}
		</p>
	</div>


@if ($courses->count())
	<div class="panel panel-default table-responsive">
		<div class="padding-md clearfix">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>รหัสวิชา</th>
							<th>ชื่อวิชา</th>
							<th>จำนวน</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($courses as $course)
							<tr >
								<td  style="vertical-align:middle;">{{ $course->code }}</td>
								<td  style="vertical-align:middle;">{{ $course->name }}</td>
								<td  style="vertical-align:middle;"></td>
								<td  style="vertical-align:middle;">
		                            <a href="{{ URL::route('archiveExam',array('oldexid' => $exid ,'course' => $course->courseid)) }}" class="btn btn-sm btn-success" id="changebc">Enter</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>

			</div>

			
		</div><!-- /.padding-md -->
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

