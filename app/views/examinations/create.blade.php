@extends('layouts.scaffold')

@section('main')

<h1>Create Exam</h1>
{{$course = Input::get('courseid')}}
{{ Form::open(array('route' => array('examination.store','courseid'=>$course), 'class'=>'form-horizontal no-margin form-border')) }}

        
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
							<div id="commandd"></div>
							<label class="col-lg-8 control-label">
							<!--input name="add" type="button" class="btn btn-success btn-xs col-lg-5" value="เพิ่มคำสั่ง" onclick=""/-->
							<a href="#commandModal" role="button" data-toggle="modal" class="btn btn-success btn-xs col-lg-5">เพิ่มคำสั่ง</a>
							</label>
						</div><!-- /.col -->


					</div><!--From group-->

					<div class="form-group">
						<label class="col-lg-1 control-label">
							{{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
						</label>
					</div>
				</div>
        	</div>
        </div>

<!-- Modal Command -->
        <div class="modal fade" id="commandModal">
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4>Add Command</h4>
      				</div>
				    <div class="modal-body">
						<form>
							<div class="form-group">
								<label>คำสั่ง</label>
								<input type="text" class="form-control input-sm" placeholder="">
							</div><!-- /form-group -->
							
							
						</form>
				    </div>
				    <div class="modal-footer">
				        <button class="btn btn-success btn-sm" data-dismiss="modal" aria-hidden="true">Close</button>
						<a href="#" id="abc" class="btn btn-danger btn-sm">Submit</a>
				    </div>
			  	</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	
{{ Form::close() }}
	<script type="text/javascript">
		$(document).ready(function(){
			var abc = "";
			@foreach($commands as $command)
			abc = abc+'<label class="label-checkbox">{{Form::checkbox("command[]",$command->cmid)}}<span class="custom-checkbox"></span>{{ $command->info }}</label>';
			@endforeach
			alert(abc);
			$("div#commandd").html(abc);
		  $("a#abc").click(function(){
		      
		      for(var i = 0; i < 10; i++){
		          abc = abc+"<table><tr><td>ggggg</td><td>555</td></tr></table>";
		      }
		      $("div#commandd").html(abc);

		  });
		});
	</script>

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop


