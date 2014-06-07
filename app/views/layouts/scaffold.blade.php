<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<style>
			table form { margin-bottom: 0; }
			form ul { margin-left: 0; list-style: none; }
			.error { color: red; font-style: italic; }
			body { padding-top: 20px; }
		</style>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="">
	    <meta name="author" content="">

		{{ HTML::style('packages/bootstrap/css/bootstrap.css') }}
		{{ HTML::style('packages/css/datepicker.css')}}
		{{ HTML::style('packages/css/bootstrap-timepicker.css')}}
    	{{ HTML::style('packages/css/endless.css')}}
    	{{ HTML::style('packages/css/endless-skin.css')}}
    	{{ HTML::style('packages/css/font-awesome.min.css')}}
    	{{ HTML::style('packages/css/pace.css')}}
    	{{ HTML::style('packages/css/gritter/jquery.gritter.css')}}
    	{{ HTML::style('packages/css/prettify.css')}}
    	{{ HTML::style('packages/css/jquery.tagsinput.css')}}
    	<script src="../packages/js/jquery-1.10.2.min.js"></script>

	</head>

	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<ul class="nav">     
						@if(!Auth::check())     
							<li>{{ HTML::link('account/login', 'Login') }}</li>   
						@else
							<li>{{ Auth::user()->name; }} {{ HTML::link('account/logout', 'Logout') }}</li>

						@endif
					</ul>  
				</div>
			</div>
		</div> 
		<div class="container">
			@if (Session::has('message'))
				<div class="flash alert">
					<p>{{ Session::get('message') }}</p>
				</div>
			@endif

			@yield('main')
		</div>



		<!-- Jquery -->
		<script src="../packages/js/jquery-1.10.2.min.js"></script>
		<script src='../packages/bootstrap/js/bootstrap.min.js'></script>
		<!-- Chosen -->
		<script src='../packages/js/chosen.jquery.min.js'></script>

		<script src='../packages/js/jquery.maskedinput.min.js'></script>
		<!-- Slider -->
		<script src='../packages/js/bootstrap-slider.min.js'></script>
		<!-- Tag input -->
		<script src='../packages/js/jquery.tagsinput.min.js'></script>	

		<script src="../packages/js/jquery.gritter.min.js"></script>

		<script src='../packages/js/pace.min.js'></script>
		<!-- Datepicker -->
		<script src='../packages/js/bootstrap-datepicker.min.js'></script>
		<!-- Timepicker -->
		<script src='../packages/js/bootstrap-timepicker.min.js'></script>
		<!-- Timepicker -->
		<script src='../packages/js/endless/endless_form.js'></script>

		<script src='../packages/js/endless/endless.js'></script>

	</body>

</html>