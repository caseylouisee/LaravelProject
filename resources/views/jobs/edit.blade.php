@extends('master')
@section('title','Edit Job')

@section('content')

	<!-- if there are creation errors, they will show here -->
	{{ HTML::ul($errors->all()) }}
	<div class = "form">
		{!! Form::model($job, array('method' => 'PATCH', 'route' => array('jobs.update', $job->id))) !!}
		
		<div class="form-group">
			{!! Form::label('title', 'Title') !!}
			{!! Form::text('title', null, ['class'=>'form-control', 'style'=>'font-size: 20px']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('description', 'Description') !!}
			{!! Form::textarea('description', null, ['class'=>'form-control', 'style'=>'font-size: 20px']) !!}
		</div> <!-- class="form-group" -->
		
		<div class="form-group">
			{!! Form::label('bidding', 'Bidding - Open?') !!}
			@if($job->bidding=='Open')
				{!! Form::checkbox('bidding_checkbox', null, true, ['class'=>'form-control', 'style'=>'font-size: 20px']) !!}
			@else
				{!! Form::checkbox('bidding_checkbox', null,false, ['class'=>'form-control', 'style'=>'font-size: 20px']) !!}
			@endif
		</div> <!-- class="form-group" -->
		
		<div class="form-group">
			{!! Form::label('status', 'Completed') !!}
			@if($job->status=='Complete')
				{!! Form::checkbox('status_checkbox', null, true, ['class'=>'form-control', 'style'=>'font-size: 20px']) !!}
			@else
				{!! Form::checkbox('status_checkbox', null, false, ['class'=>'form-control', 'style'=>'font-size: 20px']) !!}
			@endif
		</div> <!-- class="form-group" -->
		
		{!! Form::submit('Edit the Job!', array('class' => 'btn btn-primary form-control')) !!}
		{!! Form::close() !!}
	</div><!-- class="form" -->
	
@endsection