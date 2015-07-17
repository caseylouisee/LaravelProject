@extends('master')
@section('title','Create a Tag')

@section('content')

	<h1>Create a tag</h1>
	<hr />
	
	<!-- if there are creation errors, they will show here -->
	{!! HTML::ul($errors->all()) !!}
	<div class="form">
		{!! Form::open(array('url' => 'tags')) !!}

			{!! Form::label('name', 'Name') !!}
			{!! Form::text('name', Input::old('name'), ['class'=>'form-control', 'style'=>'font-size: 20px']) !!}
			</br>

			{!! Form::submit('Create tag!', array('class' => 'btn btn-primary form-control')) !!}
			
		{!! Form::close() !!}
	</div> <!-- class="form" -->
	
@endsection
