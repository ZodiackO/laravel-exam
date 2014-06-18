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
    	{{ HTML::style('packages/css/jquery.dataTables_themeroller.css') }}
    	{{ HTML::style('packages/css/pace.css')}}
    	{{ HTML::style('packages/css/gritter/jquery.gritter.css')}}
    	{{ HTML::style('packages/css/prettify.css')}}
    	{{ HTML::style('packages/css/jquery.tagsinput.css')}}
    	

    	<script src="../packages/js/jquery-1.10.2.min.js"></script>


	</head>

	<body>
		<div id="wrapper" class>
			<div id="top-nav" class="skin-6 fixed">
				<div class="brand">
					<span>Exam</span>
					<span class="text-toggle" >Intalligent</span>
				</div>
				<button type="button" class="navbar-toggle pull-left" id="sidebarToggle">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<button type="button" class="navbar-toggle pull-left hide-menu" id="menuToggle">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<ul class="nav-notification clearfix">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="fa fa-envelope fa-lg"></i>
							<span class="notification-label bounceIn animation-delay4">7</span>
						</a>
						<ul class="dropdown-menu message dropdown-1">
							<li><a>You have 4 new unread messages</a></li>					  
							<li>
								<a class="clearfix" href="#">
									<img src="img/user.jpg" alt="User Avatar">
									<div class="detail">
										<strong>John Doe</strong>
										<p class="no-margin">
											Lorem ipsum dolor sit amet...
										</p>
										<small class="text-muted"><i class="fa fa-check text-success"></i> 27m ago</small>
									</div>
								</a>	
							</li>
							<li><a href="#">View all messages</a></li>					  
						</ul>
					</li>
					
					<li class="profile dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<strong>John Doe</strong>
							<span><i class="fa fa-chevron-down"></i></span>
						</a>
						<ul class="dropdown-menu">
							<li>
								<a class="clearfix" href="#">
									<img src="img/user.jpg" alt="User Avatar">
									<div class="detail">
										<strong>John Doe</strong>
										<p class="grey">John_Doe@email.com</p> 
									</div>
								</a>
							</li>
							<li><a tabindex="-1" href="profile.html" class="main-link"><i class="fa fa-edit fa-lg"></i> Edit profile</a></li>
							<li><a tabindex="-1" href="gallery.html" class="main-link"><i class="fa fa-picture-o fa-lg"></i> Photo Gallery</a></li>
							<li><a tabindex="-1" href="#" class="theme-setting"><i class="fa fa-cog fa-lg"></i> Setting</a></li>
							<li class="divider"></li>
							<li><a tabindex="-1" class="main-link logoutConfirm_open" href="#logoutConfirm" data-popup-ordinal="0" id="open_47545686"><i class="fa fa-lock fa-lg"></i> Log out</a></li>
						</ul>
					</li>
				</ul>
			</div> <!-- End top-nav -->

			<aside class="fixed skin-6">	
				<div class="sidebar-inner scrollable-sidebars">
					<div class="size-toggle">
						<a class="btn btn-sm" id="sizeToggle">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						<a class="btn btn-sm pull-right logoutConfirm_open" href="#logoutConfirm" data-popup-ordinal="1" id="open_5218642">
							<i class="fa fa-power-off"></i>
						</a>
					</div><!-- /size-toggle -->	
					<div class="user-block clearfix">
						<img src="img/user.jpg" alt="User Avatar">
						<div class="detail">
							<strong>John Doe</strong><span class="badge badge-danger bounceIn animation-delay4 m-left-xs">4</span>
							<ul class="list-inline">
								<li><a href="profile.html">Profile</a></li>
								<li><a href="inbox.html" class="no-margin">Inbox</a></li>
							</ul>
						</div>
					</div><!-- /user-block -->
					<div class="search-block">
						<div class="input-group">
							<input type="text" class="form-control input-sm" placeholder="search here...">
							<span class="input-group-btn">
								<button class="btn btn-default btn-sm" type="button"><i class="fa fa-search"></i></button>
							</span>
						</div><!-- /input-group -->
					</div><!-- /search-block -->
					<div class="main-menu">
						<ul>
							<li class="">
								<a href="index.html">
									<span class="menu-icon">
										<i class="fa fa-desktop fa-lg"></i> 
									</span>
									<span class="text">
										Dashboard
									</span>
									<span class="menu-hover"></span>
								</a>
							</li>
							<li class="openable">
								<a href="#">
									<span class="menu-icon">
										<i class="fa fa-file-text fa-lg"></i> 
									</span>
									<span class="text">
										Page
									</span>
									<span class="menu-hover"></span>
								</a>
								<ul class="submenu">
									<li class=""><a href="login.html"><span class="submenu-label">Sign in</span></a></li>
									<li><a href="single_post.html"><span class="submenu-label">Single Post</span></a></li>
									<li class="active"><a href="blank.html"><span class="submenu-label">Blank</span></a></li>
								</ul>
							</li>
							
							
						</ul>
						
						<div class="alert alert-info">
							Welcome to Endless Admin. Do not forget to check all my pages. 
						</div>
					</div><!-- /main-menu -->
				</div><!-- /sidebar-inner -->
			</aside>
			<div id="main-container">
				<div id="breadcrumb">
					<ul id="bclist" class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="{{url('courses')}}"> Home</a></li>
						@yield('breadC')
					</ul>
				</div><!-- breadcrumb -->
				<div class="padding-md">
					@if (Session::has('message'))
					<div class="flash alert">
						<p>{{ Session::get('message') }}</p>
					</div>
					@endif

					@yield('main')
				</div>
			</div>
		</div>
		<!--div class="container">
			@if (Session::has('message'))
				<div class="flash alert">
					<p>{{ Session::get('message') }}</p>
				</div>
			@endif

			@//yield('main')
		</div-->
		<script type="text/javascript">
		/*
			$(document).on('click','#changebc',function(e){
				var name = $(this).attr('name');
				$("ul#bclist").append("<li class='active'>"+name+"</li>");
			});
			*/
		</script>


		<!-- Jquery -->
		<script src="../packages/js/jquery-1.10.2.min.js"></script>
		<script src='../packages/bootstrap/js/bootstrap.min.js'></script>
		<script src='../packages/js/jquery.dataTables.js'></script>
		<!--script src="https://cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>
		<!-- Datatable -->
		<!--script src='../packages/js/jquery.dataTables.min.js'></script>
		<!-- WYSIHTML5 -->
		<script src='../packages/js/wysihtml5-0.3.0.min.js'></script>	
		<script src='../packages/js/uncompressed/bootstrap-wysihtml5.js'></script>
		<!-- Modernizr  -->
		<script src='../packages/js/modernizr.min.js'></script>
		<!-- Chosen -->
		<script src='../packages/js/chosen.jquery.min.js'></script>

		<script src='../packages/js/jquery.maskedinput.min.js'></script>
		<!-- Slider -->
		<script src='../packages/js/bootstrap-slider.min.js'></script>
		<!-- Tag input -->
		<script src='../packages/js/jquery.tagsinput.min.js'></script>	

		<script src="../packages/js/jquery.gritter.min.js"></script>
		<!-- Pace -->
		<script src='../packages/js/pace.min.js'></script>
		<!-- Popup Overlay -->
		<script src='../packages/js/jquery.popupoverlay.min.js'></script>
		<!-- Slimscroll -->
		<script src='../packages/js/jquery.slimscroll.min.js'></script>
		<!-- Datepicker -->
		<script src='../packages/js/bootstrap-datepicker.min.js'></script>
		<!-- Timepicker -->
		<script src='../packages/js/bootstrap-timepicker.min.js'></script>
		<!-- Cookie -->
		<script src='../packages/js/jquery.cookie.min.js'></script>
		<script src='../packages/js/endless/endless_form.js'></script>

		<script src='../packages/js/endless/endless.js'></script>

	</body>

</html>