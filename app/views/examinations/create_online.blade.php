@extends('layouts.exam_endless')

@section('main')
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading"><h1>Create ExamOnline</h1></div>

{{ Form::open(array('route' => array('examination.store','courseid'=>$courseid), 'class'=>'form-horizontal no-margin form-border')) }}

				<div class="panel-body">
		            
					<div class="form-group">
	             		<label class="col-lg-1 control-label">ชื่อข้อสอบ</label>
		             	<div class="col-lg-8">
		             		{{Form::text('subject',null, array('class' => 'form-control input-sm'))}}
		             	</div>
	             	</div><!--From group-->
	             	<div class="form-group">
	             		<label class="col-lg-1 control-label">จำนวนข้อ</label>
		             	<div class="col-lg-1">
		             		{{Form::text('numofquestion', null, array('class' => 'form-control input-sm'))}}
		             	</div>
		             	<label class="col-lg-1 control-label">คะแนนรวม</label>
		             	<div class="col-lg-1">
		             		{{Form::text('score', null, array('class' => 'form-control input-sm'))}}
		             	</div>
		             	<label class="col-lg-1 control-label">ผ่าน</label>
		             	<div class="col-lg-1">
		             		{{Form::text('scorepass', null, array('class' => 'form-control input-sm'))}}
		             	</div>
		             	<div class="col-lg-1"><label class="col-lg-1 control-label">คะแนน</label></div>
	             	</div><!--From group-->

	             	<div class="form-group">
	             		<label class="col-lg-1 control-label">เวลาทำข้อสอบ</label>
		             	<div class="col-lg-2">
							{{Form::text('timemake', null, array('class' => 'form-control input-sm'))}}
		             		<!--label class="label-radio">
								<input type="radio" name="timemake" value="0" checked>
								<span class="custom-radio"></span>
								ไม่จำกัด
							</label>
							<label class="label-radio">
								<input type="radio" name="timemake" value="2">
								<span class="custom-radio"></span>

							</label-->
		             	</div>
	             	</div><!--From group-->

	             	<div class="form-group">
	             		<label class="col-lg-1 control-label">จำนวนเข้าทำ</label>
		             	<div class="col-lg-4">
		             		{{Form::text('numtime',null, array('class' => 'form-control input-sm'))}}
		             	</div>
	             	</div><!--From group-->

	             	<div class="form-group">
	             		<label class="col-lg-1 control-label">สิทธิ์เข้าทำข้อสอบ</label>
		             	<div class="col-lg-8">
							{{Form::select('permission',array('0'=>'ไม่จำกัด','1'=>'เฉพาะนักศึกษา'),null,array('class'=>'form-control'))}}
		             		
		             	</div>
	             	</div><!--From group-->
	             	

	             	<div class="form-group">
						<label class="col-lg-1 control-label">คำสั่ง</label>

						<div class="col-lg-11">
							<div id="commandd"></div>
							<label class="col-lg-8 control-label">
							<!--input name="add" type="button" class="btn btn-success btn-xs col-lg-5" value="เพิ่มคำสั่ง" onclick=""/-->
							<a href="#commandModal" role="button" data-toggle="modal" class="btn btn-success btn-xs col-lg-5">เพิ่มคำสั่ง</a>
							</label>
						</div><!-- /.col -->


					</div><!--From group-->
					<input type="hidden" name="extype" value="online">
					<div class="form-group">
						<label class="col-lg-1 control-label">
							{{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
						</label>
					</div>
				</div>
        	</div>
        </div>

	
{{ Form::close() }}

<!-- Modal Add Command -->
{{ Form::open(array('route' => array('command.store'), 'id' => 'formcmd')) }}
        <div class="modal fade" id="commandModal">
        
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4>Add Command</h4>
      				</div>
				    <div class="modal-body">

							<div class="form-group">
								<label>คำสั่ง</label>
								<input name="info" type="text" class="form-control input-sm" placeholder="">
								<input name="examtype" type="hidden" value="o">
							</div><!-- /form-group -->
							
				    </div>
				    <div class="modal-footer">
				        <button class="btn btn-success btn-sm" data-dismiss="modal" aria-hidden="true">Close</button>
						{{ Form::submit('Submit', array('class' => 'btn btn-danger btn-sm', 'id' => 'cm')) }}
				    </div>
			  	</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
{{ Form::close() }}
<!-- End Modal Add Command -->

<!-- Modal Edit Command -->
{{ Form::open(array('route' => array('command.update'), 'id' => 'formupcmd')) }}
        <div class="modal fade" id="commandModalEdit">
        
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4>Edit Command</h4>
      				</div>
				    <div class="modal-body">

							<div class="form-group">
								<label>คำสั่ง</label>
								<input name="info2" type="text" class="form-control input-sm" placeholder="">
								<input name="cmid" type="hidden" value"" />
							</div><!-- /form-group -->
							
				    </div>
				    <div class="modal-footer">
				        <button class="btn btn-success btn-sm" data-dismiss="modal" aria-hidden="true">Close</button>
						{{ Form::submit('Update', array('class' => 'btn btn-danger btn-sm')) }}
				    </div>
			  	</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
{{ Form::close() }}
<!-- End Modal Edit Command -->

	<script type="text/javascript">
		$(document).ready(function(){
			//alert('gggg');
			var abc = "";
			console.log('{{$commands}}');
			@foreach($commands as $command)
			abc = abc+'<label class="label-checkbox">{{Form::checkbox("command[]",$command->cmid)}}<span class="custom-checkbox"></span><button class="btn btn-xs btn-primary" type="button" id="editcmd" value="{{$command->cmid}}"><i class="fa fa-lg fa-edit"></i></button><button class="btn btn-xs btn-danger" type="button" id="delcmd" value="{{$command->cmid}}"><i class="fa fa-lg fa-times"></i></button>{{ $command->info }}</label>';
			@endforeach
//<button class="btn btn-xs btn-primary" type="button" id="editcmd" value="'+value['cmid']+'"><i class="fa fa-lg fa-edit"></i></button>
//{{Form::open(array("method" => "DELETE", "route" => array("command.destroy",$command->cmid), "id" => "delcmd"))}}
//<form method="POST" action="http://localhost:8000/command/"++""></form>
//<input type="submit" class="btn btn-xs btn-danger" value="del" />
			$("div#commandd").html(abc);

/*------------------------------Add Command------------------------------*/
			$("#formcmd").submit(function(e){

				e.preventDefault();


				var $form = $(this),
				   term = $form.find("input[name='info']").val(),
				   type = $form.find("input[name='examtype']").val(),
				   url = $form.attr("action");

				var posting = $.post(url,{
					info: term,
					examtype: type
				});

				posting.done(function(data){
					//alert(data);
					/*
					var json = data
	    			data = JSON.parse(json);*/
	    			//console.log(data);

					$("#commandModal").modal('hide');
					//var cmd = '';
					document.getElementById("formcmd").reset();
					selectcmd(data);

				});
				
			});

/*------------------------------Delete Command------------------------------*/
			$(document).on('click',"button#delcmd", function(e){
				alert('delete');
				e.preventDefault();
				var cmid = $(this).attr("value");
				var $form = $(this),
				  //term = $form.find("input[name='command[]']").val(),
				   url = "http://localhost:8000/command/"+cmid+"";

				var posting = $.post(url,{
					_method: "DELETE",
					_token: "7RSnbAYuVV4fy9WwArPRIbTzalZQla6KUcBPyk4f"
				});

				posting.done(function(data){
					selectcmd(data);

				});
			});

			//  After once click is not working.
			/*                        
			$("button#delcmd").click(function(e){
				alert('delete');
				e.preventDefault();
				var cmid = $(this).attr("value");
				var $form = $(this),
				  term = $form.find("input[name='command[]']").val(),
				   url = "http://localhost:8000/command/"+cmid+"";

				var posting = $.post(url,{
					_method: "DELETE",
					_token: "7RSnbAYuVV4fy9WwArPRIbTzalZQla6KUcBPyk4f"
				});

				posting.done(function(data){

					var cmd = '';
					
					$.each(data, function(index, value){
						console.log(value['info']);
						cmd = cmd+'<label class="label-checkbox"><input type="checkbox" name="command[]" value="'+value['cmid']+'"/><span class="custom-checkbox"></span><button class="btn btn-xs btn-danger" type="button" id="delcmd" value="'+value['cmid']+'"><i class="fa fa-lg fa-times"></i></button>'+value['info']+'</label>';
					});
					$("div#commandd").html(cmd);
				});
			});
			*/
/*------------------------------Edit Command------------------------------*/
			$(document).on('click',"button#editcmd", function(e){
				
				//alert('delete');
				e.preventDefault();
				var cmid = $(this).attr("value");
				var $form = $(this),
				   url = "http://localhost:8000/command/"+cmid+"/edit";

				var posting = $.get(url);

				posting.done(function(data){
					console.log(data['info']);
					var cmd = '';

					$('input[name="info2"]').val(data['info']);
					$('input[name="cmid"]').val(data['cmid']);
					$("#commandModalEdit").modal('show');
				});
			});
/*-----------------------------Update Command-----------------------------*/
			$("#formupcmd").submit(function(e){

				e.preventDefault();
				var cmid = $('input[name="cmid"]').val();
				var $form = $(this),
				   term = $form.find("input[name='info2']").val(),
				   url = "http://localhost:8000/command/"+cmid;

				var posting = $.post(url,{
					_method: "PATCH",
					_token: "{{ csrf_token() }}",
					info: term
				});

				posting.done(function(data){
					console.log(data);
					$("#commandModalEdit").modal('hide');
					document.getElementById("formcmd").reset();
					selectcmd(data);
					/*
					$.each(data, function(index, value){
						console.log(value['info']);
						cmd = cmd+'<label class="label-checkbox"><input type="checkbox" name="command[]" value="'+value['cmid']+'"/><span class="custom-checkbox"></span><button class="btn btn-xs btn-primary" type="button" id="editcmd" value="'+value['cmid']+'"><i class="fa fa-lg fa-edit"></i></button><button class="btn btn-xs btn-danger" type="button" id="delcmd" value="'+value['cmid']+'"><i class="fa fa-lg fa-times"></i></button>'+value['info']+'</label>';
					});
					$("div#commandd").html(cmd);*/
				});
			});

			function selectcmd(data){
				var cmd = '';
				$.each(data, function(index, value){
					console.log(value['info']);
					cmd = cmd+'<label class="label-checkbox"><input type="checkbox" name="command[]" value="'+value['cmid']+'"/><span class="custom-checkbox"></span><button class="btn btn-xs btn-primary" type="button" id="editcmd" value="'+value['cmid']+'"><i class="fa fa-lg fa-edit"></i></button><button class="btn btn-xs btn-danger" type="button" id="delcmd" value="'+value['cmid']+'"><i class="fa fa-lg fa-times"></i></button>'+value['info']+'</label>';
				});
				$("div#commandd").html(cmd);
			}

		});





	</script>

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop


