@extends('master')
@section('title','Create a Job')

@section('content')

	<h1>Create a job</h1>

	<!-- if there are creation errors, they will show here -->
	{!! HTML::ul($errors->all()) !!}

	<div class = "form">
		{!! Form::open(array('url' => 'jobs')) !!}

		<div class="form-group">
			{!! Form::label('title', 'Title') !!}
			{!! Form::text('title', Input::old('title'), ['class'=>'form-control', 'style'=>'font-size: 20px']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('description', 'Description') !!}
			{!! Form::textArea('description', Input::old('description'), ['class'=>'form-control', 'style'=>'font-size: 20px']) !!}
		</div>

		{!! Form::submit('Create job!', array('class' => 'btn btn-primary form-control')) !!}
		{!! Form::close() !!}
	</div> <!-- class="form" -->
@endsection
