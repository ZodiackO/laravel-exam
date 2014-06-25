@extends('layouts.login')

@section('main')

<div class="login-wrapper">
		<div class="text-center">
			<h2 class="fadeInUp animation-delay8" style="font-weight:bold">
				<span class="text-success">Exam</span> <span style="color:#ccc; text-shadow:0 1px #fff">Intalligent</span>
			</h2>
		</div>
		<div class="login-widget animation-delay1">	
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<div class="pull-left">
						<i class="fa fa-lock fa-lg"></i> Login
					</div>

					<div class="pull-right">
						<span style="font-size:11px;">Don't have any account?</span>
						<a class="btn btn-default btn-xs login-link" href="register.html" style="margin-top:-2px;"><i class="fa fa-plus-circle"></i> Sign up</a>
					</div>
				</div>
				<div class="panel-body">


					<form method="post" action="" class="form-login" id="fmtlogin">
						<div class="form-group">
							<label>Username</label>
							{{ Form::text('username', null, array('class'=>'form-control input-sm bounceIn animation-delay2', 'placeholder'=>'Username')) }}
							<!--input type="text" placeholder="Username" class="form-control input-sm bounceIn animation-delay2" -->
						</div>
						<div class="form-group">
							<label>Password</label>
							{{ Form::password('password', array('class'=>'form-control input-sm bounceIn animation-delay4', 'placeholder'=>'Password')) }}
							<!--input type="password" placeholder="Password" class="form-control input-sm bounceIn animation-delay4"-->
						</div>
						<div class="form-group">
							<label class="label-checkbox inline">
								<input type="checkbox" class="regular-checkbox chk-delete" />
								<span class="custom-checkbox info bounceIn animation-delay4"></span>
							</label>
							Remember me		
						</div>
		
						<div class="seperator"></div>
						<div class="form-group">
							Forgot your password?<br/>
							Click <a href="#">here</a> to reset your password
						</div>

						<hr/>
							{{ Form::submit('Login', array('class'=>'btn btn-success btn-sm'))}}
						<!--a class="btn btn-success btn-sm bounceIn animation-delay5 login-link pull-right" href="index.html"><i class="fa fa-sign-in"></i> Sign in</a-->
					</form>


				</div>
			</div><!-- /panel -->
		</div><!-- /login-widget -->
	</div><!-- /login-wrapper -->

	<script type="text/javascript">
		$(document).ready(function(){

			$("#fmtlogin").submit(function(e){
				alert('ggg');
				e.preventDefault();
				var $form = $(this),
				   user = $form.find("input[name='username']").val(),
				   pass = $form.find("input[name='password']").val();
				   //url = $form.attr("action");

				   var posting = $.post('http://www.dedpu.com/Profile/check_login.php',{
				   		Username: user,
				   		Password: pass
				   	});

				   	posting.done(function(data){
				   		console.log('time1: '+data);
				   		var obj = JSON.parse(data);
				   		console.log(obj);
				   		var postaf = $.post('{{URL::route("login-post")}}',{
				   			data: obj
				   		});
				   		postaf.done(function(data){
				   			console.log(data);
				   			window.location.href = data;
				   		});
					});
					posting.fail(function(){
						alert('fail');
					});
			});
		});
	</script>
@stop
