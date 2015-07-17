@extends('master')
@section('title','Make Bid')

@section('content')

	<h1>Make Bid</h1>

	<!-- if there are creation errors, they will show here -->
	{!! HTML::ul($errors->all()) !!}
	
	<div class = "form">
		{!! Form::open(array('url' => array('bids/store'))) !!}

			{!! Form::label('proposal', 'Proposal') !!}
			{!! Form::textArea('proposal', null, ['placeholder'=>'Your proposal here','class'=>'form-control', 'style'=>'font-size: 20px']) !!}
			</br>
			
			{!! Form::hidden('jobid', $id) !!}
			{!! Form::submit('Make bid!!', ['class'=>'btn btn-primary form-control']) !!}

		{!! Form::close() !!}
	</div>

@endsection