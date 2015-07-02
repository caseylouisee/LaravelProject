<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title')</title>	<meta charset="utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	
	<style>
	
	.menu {
		font-size:25px;
		font-family:'Lato';
	}
	
	.content {
		font-size:20px;
		font-family:'Lato';
	}
	
	</style>
	
</head>
<body>
		
	<div class="container">
		<div class="content">
		<div class="menu">
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<ul class="nav navbar-nav">
					<li><a href="/home"><span class="glyphicon glyphicon-home" aria-hidden="true">
						</span>Home</a></li>
					<li><a href="/users/index"><span class="glyphicon glyphicon-list-alt" aria-hidden="true">
						</span>Profiles</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
					@if(Auth::Check())
					<li><a href="/auth/logout"><span class="glyphicon glyphicon-user" aria-hidden="true">
						</span>Logged in as {{Auth::user()->name}}, click here to log out </a></li>
					@else
					<li><a href="/auth/login"><span class="glyphicon glyphicon-user" aria-hidden="true">
						</span>Login</a></li>
					<li><a href="/auth/register"><span class="glyphicon glyphicon-pencil" aria-hidden="true">
						</span>Register</a></li>
					@endif
					</ul> <!-- nav-bar right -->
			</div> <!-- container fluid -->
		</nav>
		</div> <!-- menu -->
		
		@if(Session::has('message'))
			<div class="alert alert-danger" role="alert">
			<div class="container">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			{{ Session::get('message') }}
			</div>
			</div>
		@elseif ($errors->first('email') || $errors->first('password'))
			<div class="alert alert-danger" role="alert">
			<div class="container">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				{{ $errors->first('email') .' '. $errors->first('password') }}
				</div>
			</div>
		@endif
		
		@yield('content')	
		</div> <!--content -->
	</div> <!--container-->

</body>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- fonts -->
<link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

