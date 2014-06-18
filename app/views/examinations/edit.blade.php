@extends('layouts.exam_endless')

@section('main')

<h1>Edit Member</h1>
{{ Form::model($examination, array('method' => 'PATCH', 'route' => array('examination.update', $examination->exid), 'class'=>'form-horizontal no-margin')) }}
	
	<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Simple Form</div>
				<div class="panel-body">
		            <div class="form-group">
						<label class="col-lg-1 control-label">ช้อสอบ</label>
						<div class="col-lg-11">
							<label class="label-radio">
								<input type="radio" name="type" value="1" checked>
								<span class="custom-radio"></span>
								กลางภาค
							</label>
							<label class="label-radio">
								<input type="radio" name="type" value="2">
								<span class="custom-radio"></span>
								ปลายภาค	
							</label>
							<label class="label-radio">
								<input type="radio" name="type" value="3">
								<span class="custom-radio"></span>
								ข้อสอบอื่นๆ
							</label>
						</div><!-- /.col -->
					</div><!--From group-->
					<div class="form-group">
	             	<label class="col-lg-1 control-label">เรื่อง</label>
		             	<div class="col-lg-8">
		             		{{Form::text('subject',null, array('class' => 'form-control input-sm'))}}
		             	</div>
	             	</div><!--From group-->
	             	<div class="form-group">
	             	<label class="col-lg-1 control-label">หน่วยกิต</label>
		             	<div class="col-lg-8">
							{{Form::select('credit',array('1'=>'1','2'=>'2','3'=>'3'),null,array('class'=>'form-control'))}}
		             		
		             	</div>
	             	</div><!--From group-->
	             	<div class="form-group">
	             		<label class="col-lg-1 control-label">ปีการศึกษา</label>
		             	<div class="col-lg-8">
		             		{{Form::text('acyear', null, array('class' => 'form-control input-sm'))}}
		             	</div>
	             	</div><!--From group-->
	             	<div class="form-group">
	             	<label class="col-lg-1 control-label">ภาคเรียน</label>
		             	<div class="col-lg-8">
		             		{{Form::select('term',array('1'=>'1','2'=>'2','3'=>'3'),null,array('class'=>'form-control'))}}

		             	</div>
	             	</div><!--From group-->
	             	<div class="form-group">
	             	<label class="col-lg-1 control-label">คณะ</label>
		             	<div class="col-lg-8">
		             		{{Form::select('faculty',array(
		             			'วิศวกรรมศาสตร์'=>'วิศวกรรมศาสตร์',
		             			'บริหารธุรกิจ'=>'บริหารธุรกิจ',
		             			'การบัญชี'=>'การบัญชี',
		             			'เศรษฐศาสตร์'=>'เศรษฐศาสตร์',
		             			'นิติศาสตร์'=>'นิติศาสตร์',
		             			'ศิลปศาสตร์'=>'ศิลปศาสตร์',
		             			'นิเทศศาสตร์'=>'นิเทศศาสตร์'
		             			),null,array('class'=>'form-control')
		             		)}}
		             		
		             	</div>
	             	</div><!--From group-->
	             	<div class="form-group">
	             	<label class="col-lg-1 control-label">สาขา</label>
		             	<div class="col-lg-8">
		             		{{Form::select('major',array(
		             			'วิศวกรรมดิจิทัลมีเดียและระบบเกม'=>'วิศวกรรมดิจิทัลมีเดียและระบบเกม',
		             			'วิศวกรรมไฟฟ้า'=>'วิศวกรรมไฟฟ้า',
		             			'วิศวกรรมอุตสาหการ'=>'วิศวกรรมอุตสาหการ',
		             			'วิศวกรรมคอมพิวเตอร์'=>'วิศวกรรมคอมพิวเตอร์'
		             			),null,array('class'=>'form-control')
		             		)}}
		             	</div>
	             	</div><!--From group-->
	             	<div class="form-group">
						<label class="col-lg-1 control-label">ระดับ</label>
						<div class="col-lg-11">
							<label class="label-radio">
								<input type="radio" name="degree" value="1" checked>
								<span class="custom-radio"></span>
								ปริญญาตรี
							</label>
							<label class="label-radio">
								<input type="radio" name="degree" value="2">
								<span class="custom-radio"></span>
								บัณฑิตย์ศึกษา	
							</label>
						</div><!-- /.col -->
					</div><!--From group-->
					<div class="form-group">
						<label class="col-lg-1 control-label">รอบเวลาเรียน</label>
						<div class="col-lg-11">
							<label class="label-radio">
								<input type="radio" name="studytime" value="1" checked>
								<span class="custom-radio"></span>
								ภาคปกติ
							</label>
							<label class="label-radio">
								<input type="radio" name="studytime" value="2">
								<span class="custom-radio"></span>
								ภาคค่ำ	
							</label>
						</div><!-- /.col -->
					</div><!--From group-->
					<div class="form-group">
						<label class="col-lg-1 control-label">สอบวันที่</label>
						<div class="col-lg-5">
							<div class="input-group">

								<input type="date" name="date" value="" class="form-control">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div><!-- /.col -->
					</div><!--From group-->
					<div class="form-group">
						<label class="col-lg-1 control-label">เวลา</label>
						<div class="col-lg-2">
							<div class="input-group">
								<input class="form-control" name="examtime_start" type="time">
								<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
							</div>
						</div><!-- /.col -->

							<label class="col-lg-1 control-label" style="text-align: center;">ถึง</label>

						<div class="col-lg-2">
							<div class="input-group">
								<input class="form-control" name="examtime_end" type="time">
								<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
							</div>
						</div><!-- /.col -->
					</div><!--From group-->
					<div class="form-group">
	             		<label class="col-lg-1 control-label">อาจารย์</label>
		             	<div class="col-lg-8">
		             		{{Form::text('examwriter', null, array('class' => 'form-control input-sm'))}}
		             	</div>
	             	</div><!--From group-->
	             	<div class="form-group">
	             		<label class="col-lg-1 control-label">จำนวนข้อ</label>
		             	<div class="col-lg-4">
		             		{{Form::text('numofquestion', null, array('class' => 'form-control input-sm'))}}
		             	</div>
	             	</div><!--From group-->
	             	<div class="form-group">
	             		<label class="col-lg-1 control-label">คะแนนรวม</label>
		             	<div class="col-lg-4">
		             		{{Form::text('score', null, array('class' => 'form-control input-sm'))}}
		             	</div>
	             	</div><!--From group-->
	             	<div class="form-group">
						<label class="col-lg-1 control-label">คำสั่ง</label>
						<div class="col-lg-11">
							@foreach($commands as $command)
								<label class="label-checkbox">
									{{ Form::checkbox('command[]', $command->cmid) }}
									<span class="custom-checkbox"></span>
									{{ $command->info }}
								</label>

							@endforeach
						</div><!-- /.col -->
					</div><!--From group-->

					<div class="form-group">
						<label class="col-lg-1 control-label">
							{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
							{{ link_to_route('examination.show', 'Cancel', $examination->courseid, array('class' => 'btn')) }}
						</label>
					</div>
				</div>
        	</div>
        </div>

{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
