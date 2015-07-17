@extends('master')
@section('title','Create Rating')

@section('content')

	<h1>Create Rating</h1>

	<!-- if there are creation errors, they will show here -->
	{!! HTML::ul($errors->all()) !!}
	
	<div class = "form">
		{!! Form::open(array('url' => array('ratings/store'))) !!}
	
			{!! Form::label('rating', 'Rating /5') !!}
			{!! Form::text('rating', null, ['placeholder'=>'Rating out of 5 here', 'class'=>'form-control', 'style'=>'font-size: 20px']) !!}

			{!! Form::label('comment', 'Comment') !!}
			{!! Form::textArea('comment', null, ['placeholder'=>'Review here','class'=>'form-control', 'style'=>'font-size: 20px']) !!}
			</br>
	
			{!! Form::hidden('userid', $id) !!}

			{!! Form::submit('Create rating!', ['class'=>'btn btn-primary form-control']) !!}

		{!! Form::close() !!}
	</div>

@endsection