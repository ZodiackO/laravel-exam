@extends('layouts.exam_endless')

@section('breadC')
	<li class="active">Exams</li>	 
@stop

@section('main')

<div class="panel panel-default">
	<div class="panel-heading">
		<h2>สรุปผล</h2>
	</div>


	<div class="panel panel-default table-responsive">
		<div class="padding-md clearfix">
			<h3>ข้อสอบ {{ $arrdata['exsubject'] }}</h3>
			<div class="row">
				<div class="col-md-6">
					<table class="table">
						<tr>
							<td><b>เกณฑ์</b></td>
							<td>{{ $arrdata['result'] }}</td>
						</tr>
						<tr>
							<td><b>ทำคะแนนได้</b></td>
							<td>{{ $arrdata['mark'] }}/{{ $arrdata['totalscore'] }} คะแนน</td>
						</tr>
						<tr>
							<td><b>เวลาที่ใช้</b></td>
							<td>{{ $arrdata['timetake'] }}</td>
						</tr>
						<tr>
							<td><b>เสร็จสิ้น</b></td>
							<td>{{ $arrdata['timefin'] }}</td>
						</tr>
						<tr>
							<td><b>ความยาก</b></td>
							<td>{{ $arrdata['avg_level'] }}</td>
						</tr>

					</table>
				</div>
			</div>
			<p><a href="{{ URL::route('exams')}}" class="btn btn-sm btn-danger">Finish</a></p>
		</div><!-- /.padding-md -->
	</div>
</div>


@stop

