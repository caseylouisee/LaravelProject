<!-- resources/views/auth/register.blade.php -->
@extends('master')
@section('title', 'Register')

@section('content')	
	{!! csrf_field() !!}
		<div class="col-md-12 form">
			{!! Form::open(array('url' => 'auth/register')) !!}
		
			<div class="form-group">
		    	{!! Form::label('name', 'Name:') !!}<br />
			    {!! Form::text('name', Input::old('name'), ['placeholder' => 'Name Here', 'class'=>'form-control', 'style'=>'font-size: 20px']) !!}
			</div> <!-- class="form-group" -->
		
			<div class="form-group">
			    {!! Form::label('email', 'Email Address:') !!}<br />
			    {!! Form::text('email', Input::old('email'),['placeholder' => 'Email Here', 'class'=>'form-control', 'style'=>'font-size: 20px']) !!}
			</div> <!-- class="form-group" -->

			<div class="form-group">
				{!! Form::label('description', 'Description:') !!}<br />
				{!! Form::textarea('description', null, ['class'=>'form-control', 'style'=>'font-size: 20px']) !!}
			</div> <!-- class="form-group" -->
		
			<div class="form-group">
			    {!! Form::label('password', 'Password:') !!}<br />
			    {!! Form::password('password', ['placeholder' => 'Password Here','class'=>'form-control', 'style'=>'font-size: 20px']) !!}
			</div> <!-- class="form-group" -->
		
			<div class="form-group">
			    {!! Form::label('password_confirmation', 'Confirm Password:') !!}<br />
		    	{!! Form::password('password_confirmation', ['placeholder' => 'Confirm Password','class'=>'form-control', 'style'=>'font-size: 20px']) !!}
			</div> <!-- class="form-group" -->
			
			<div class="form-group">
				{!! Form::label('Profile Image') !!}
				{!! Form::file('image', null) !!}
			</div> <!-- class="form-group" -->
			
			{!! Form::submit('Register', ['class' => 'btn btn-primary form-control']) !!}
			{!! Form::close() !!}
		</div> <!-- class="col-md-12" -->
@endsection

