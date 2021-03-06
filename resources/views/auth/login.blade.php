<!-- resources/views/auth/login.blade.php -->
@extends('master')
@section('title', 'Login')

@section('content')
	{!! csrf_field() !!}
	<div class="col-md-12 form">
		{!! Form::open(array('url' => 'auth/login')) !!}
		
		<div class="form-group">
			{!! Form::label('email', 'Email Address') !!}<br />
			<div class="input-group">
				<span class="input-group-addon" id="sizing-addon1"><span class="fa fa-user"></span></span>
		   		{!! Form::text('email', Input::old('email'), ['placeholder' => 'Email Here', 'class' => 'form-control', 'style'=>'font-size: 20px']) !!}
			</div> <!-- class="input-group" -->
		</div> <!-- class="form-group" -->
	
		<div class="form-group">
		    {!! Form::label('password', 'Password') !!}<br />
			<div class="input-group">
				<span class="input-group-addon" id="sizing-addon1"><span class="fa fa-lock"></span></span>
	   			{!! Form::password('password', ['placeholder' => 'Password Here', 'class' => 'form-control', 'style'=>'font-size: 20px']) !!}
			</div> <!-- class="input-group" -->
		</div> <!-- class="form-group" -->
		
		{!! Form::submit('Login', ['class' => 'btn btn-primary form-control']) !!}
		<!--	<a href="/password/email" class="submit">Forgottten Password</a>	-->
		
		{!! Form::close() !!}
	</div> <!-- class="col-md-12 form" -->
		
@endsection

