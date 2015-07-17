<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title')</title>	<meta charset="utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<style>
	
	.menu {
		font-size:25px;
		font-family:'Lato';
	}
	
	.content {
		font-size:20px;
		font-family:'Lato';
	}
	
	.btn-custom {
		color: #FFFFFF;
		background-color: #60BFD5;
		border-color: #60BFD5;
		/* 778899 - grey */
	}
	
	img {
		display: inline-block;
		vertical-align: middle;
		max-height: 100%;
		max-width: 100%;
	}
	
	.panel > .panel-footer-small {
		padding: 5px 10px;
		background-color: #f5f5f5;
		border-top: 1px solid #ddd;
		border-bottom-right-radius: 3px;
		border-bottom-left-radius: 3px;
		font-size:15px;
		color: grey;
	}
	
	.jumbotron {
		position: relative;
		background: #000 url("") center center;
		width: 100%;
		height: 100%;
		background-size: cover;
		overflow: hidden;
	}
	
		.datepicker{z-index:+1, !important}
		
	</style>
	
</head>
<body>
	<div class="container">
		<div class="content">
			<div class="menu">
			<nav class="navbar navbar-inverse">
				<div class="container-fluid">
				<ul class="nav navbar-nav">
					<li><a href="/home"><span class="fa fa-home" aria-hidden="true"></span>
						Home
					</a></li>
					<li><a href="/users"><span class="fa fa-users" aria-hidden="true"></span>
						Profiles
					</a></li>
					<li><a href="/jobs"><span class="fa fa-briefcase" aria-hidden="true"></span>
						Jobs
					</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					@if(Auth::Check())
						@if(Auth::user()->hasRole('Manager'))
						<li><a href="/manage"><span class="fa fa-wrench" aria-hidden="true"></span>
							Manage
						</a></li>
						@endif
						<li><a href="{{URL::to('messages')}}">
						<span class="fa fa-envelope" aria-hidden="true"></span>	
							Messages @include('messenger.unread-count')
						</a></li>
						<li><a href="/auth/logout"><span class="fa fa-user" aria-hidden="true"></span>
							<!--Logged in as {{Auth::user()->name}}, click here to -->Log out 
						</a></li>
					@else
					<li><a href="/auth/login"><span class="fa fa-user" aria-hidden="true"></span>
						Login
					</a></li>
					<li><a href="/auth/register"><span class="fa fa-pencil" aria-hidden="true"></span>
						Register
					</a></li>
					@endif
				</ul> <!-- nav-bar right -->
			</div> <!-- container fluid -->
		</nav>
		</div> <!-- menu -->

		@if(Session::has('message'))
			<div class="alert alert-success" role="alert">
				<div class="container">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					{{ Session::get('message') }}
				</div> <!-- class="container" -->
			</div> <!-- class="alert alert-success" -->
		@elseif(Session::has('alert'))
			<div class="alert alert-danger" role="alert">
				<div class="container">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					{{ Session::get('alert') }}
				</div> <!-- class="container" -->
			</div> <!-- class="alert alert-danger" -->
		@elseif ($errors->first('email') || $errors->first('password'))
			<div class="alert alert-danger" role="alert">
				<div class="container">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					{{ $errors->first('email') .' '. $errors->first('password') }}
				</div> <!-- class="container" -->
			</div> <!-- class="alert alert-danger" -->
		@endif
		
		@yield('content')
		<!-- select 2 -->
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
		<!-- morris graphs -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
		@yield('footer')
		</div> <!--content -->
	</div> <!--container-->
</body>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<!-- select 2 -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
<!-- morris.js -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

<!-- fonts -->
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato:100">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

