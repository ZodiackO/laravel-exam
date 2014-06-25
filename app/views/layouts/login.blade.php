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
    	{{ HTML::style('packages/css/endless.css')}}
    	{{ HTML::style('packages/css/endless-skin.css')}}
    	{{ HTML::style('packages/css/font-awesome.in.css')}}
    	<script src="packages/js/jquery-1.10.2.min.js"></script>
	</head>

	<body>
		<!--div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<ul class="nav">
						@if(!Auth::check())     
							<li>{{ HTML::link('account/login', 'Login') }}</li>   
						@else
							<li>{{ HTML::link('account/logout', 'Logout') }}</li>
						@endif
					</ul>  
				</div>
			</div>
		</div--> 
		<div class="container">
			@if (Session::has('message'))
				<div class="flash alert">
					<p>{{ Session::get('message') }}</p>
				</div>
			@endif
			
		</div>
		@yield('main')
	</body>

</html>