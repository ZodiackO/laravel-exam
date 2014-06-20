@extends('layouts.exam_endless')

@section('breadC')
	<li class="active">Exams</li>	 
@stop

@section('main')

<div class="panel panel-default">
	<div class="panel-heading">
		<h2>รายละเอียดข้อสอบ</h2>
	</div>


	<div class="panel panel-default table-responsive">
		<div class="padding-md clearfix">
			<h3>ข้อสอบ {{ $examination->subject }}</h3>
			<div class="row">
				<div class="col-md-6">
					<table class="table">
						<tr>
							<td><b>จำนวนข้อสอบ</b></td>
							<td>{{ $examination->numofquestion }} ข้อ</td>
						</tr>
						<tr>
							<td><b>เวลาในการทำข้อสอบ</b></td>
							<td>{{ $examination->timemake }} นาที</td>
						</tr>
						<tr>
							<td><b>คะแนนเต็ม</b></td>
							<td>{{ $examination->score }} คะแนน</td>
						</tr>
						<tr>
							<td><b>คะแนนที่ต้องการ</b></td>
							<td>{{ $examination->scorepass }} คะแนน</td>
						</tr>
						<tr>
							<td><b>ความยาก</b></td>
							<td>{{ $avg_level }}</td>
						</tr>

					</table>
				</div>
			</div>
			<p><a href="{{ URL::route('exams-do',array('exid' => $examination->exid, 'exsubject' => $examination->subject)) }}" class="btn btn-sm btn-success">Take</a></p>
		</div><!-- /.padding-md -->
	</div>
</div>


@stop

