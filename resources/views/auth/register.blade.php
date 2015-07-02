<!-- resources/views/auth/register.blade.php -->
@extends('master')

@section('title', 'Register')

@section('content')	
	<form method="POST" action="/auth/register">
		{!! csrf_field() !!}

		<div>
			Name
			<input type="text" name="name" value="{{ old('name') }}">
		</div>

		<div>
			Email
			<input type="email" name="email" value="{{ old('email') }}">
		</div>
		
		<div class="form-group">
			Description
			</br>
			{!! Form::textarea('description') !!}
		</div>		

		<div>
			Password
			<input type="password" name="password">
		</div>

		<div>
			Confirm Password
			<input type="password" name="password_confirmation">
		</div>

		<div>
			<button type="submit" class="btn btn-primary">Register</button>
		</div>
	</form>	
@endsection

