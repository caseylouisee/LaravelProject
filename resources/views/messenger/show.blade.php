@extends('master')

@section('content')
	<div class="col-md-12">
		<h1>{!! $thread->subject !!}</h1>
		<hr />
		@foreach($thread->messages as $message)
			@if($message->user->id == Auth::user()->id)
			<!-- Current user's messages -->
			<div class="row">
				<div class="col-md-2 pull-right">
					<figure class="thumbnail">
						<img class="img-responsive" src="/images/profiles/{{Auth::user()->id}}.jpg" />
						<figcaption class="text-center">{!! $message->user->name !!}</figcaption>
					</figure>
				</div> <!-- class="col-md-2 pull-right" -->
				<div class="col-md-7 pull-right">
					<div class="panel panel-info">
						<div class="panel-body">
							<p>{!! $message->body !!}</p>
						</div> <!-- class="panel-body" -->
						<div class="panel-footer-small small text-right">
							<span class="glyphicon glyphicon-time"></span>
							Posted {!! $message->created_at->diffForHumans() !!}
						</div> <!-- class="panel-footer-small small text-right" -->
					</div> <!-- class="panel panel-info" -->
				</div> <!-- class="col-md-7 pull-right" -->
			</div> <!-- class="row" -->
			@else
			<!-- Other user messages -->
			<div class="row">
				<div class="col-md-2">
					<figure class="thumbnail">
						<img class="img-responsive" src="/images/profiles/{{$message->user->id}}.jpg" />
						<figcaption class="text-center">{!! $message->user->name !!}</figcaption>
					</figure>
				</div> <!-- class="col-md-2" -->
				<div class="col-md-7">
					<div class="panel panel-default">
						<div class="panel-body">
							<p>{!! $message->body !!}</p>
						</div> <!-- class="panel-body" -->
						<div class="panel-footer-small small text-right">
							<span class="glyphicon glyphicon-time"></span>
							Posted {!! $message->created_at->diffForHumans() !!}
						</div> <!-- class="panel-footer-small small text-right" -->
					</div> <!-- class="panel panel-default" -->
				</div> <!-- class="col-md-7" -->
			</div> <!-- class="row" -->
			@endif
		@endforeach

		<h2>Add a new message</h2>
		{!! Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']) !!}
		<!-- Message Form Input -->
		<div class="form-group">
			{!! Form::textarea('message', null, ['class' => 'form-control']) !!}
		</div> <!-- class="form-group" -->

		@if($users->count() > 0)
		<div class="checkbox">
			@foreach($users as $user)
				<label title="{!! $user->name !!}"><input type="checkbox" name="recipients[]" value="{!! $user->id !!}">{!! $user->name !!}</label>
			@endforeach
		</div> <!-- class="checkbox" -->
		@endif

		<!-- Submit Form Input -->
		<div class="form-group">
			{!! Form::submit('Send Message', ['class' => 'btn btn-primary form-control']) !!}
		</div> <!-- class="form-group" -->
		{!! Form::close() !!}
	</div> <!-- class="col-md-12" -->
@endsection


<!-- Panel Messages 
@foreach($thread->messages as $message)
@if($message->user->id == Auth::user()->id)
	<div class="row">
	<div class="col-md-6 col-md-offset-6">
		<div class="panel panel-info">
			<div class="panel-heading">
				{!! $message->user->name !!}
			</div> <!-- class="panel-heading" -->
<!--			<div class="panel-body">
				<p>{!! $message->body !!}</p>
				<div class="text-muted">
					<small>Posted {!! $message->created_at->diffForHumans() !!}</small>
				</div> <!-- class="text-muted" -->
<!--			</div> <!-- class="panel-body" -->
<!--		</div> <!-- class="panel panel-info"-->
<!--	</div> <!-- class="col-md-6 col-md-offset-6" -->
<!--	</div> <!-- class="row" -->
<!--	@else
	<div class="row">
	<div class="col-md-7">
		<div class="panel panel-info">
			<div class="panel-heading">
				{!! $message->user->name !!}
			</div> <!-- class="panel-heading" -->
<!--			<div class="panel-body">
				<p>{!! $message->body !!}</p>
				<div class="text-muted">
					<small>Posted {!! $message->created_at->diffForHumans() !!}</small>
				</div> <!-- class="text-muted" -->
<!--			</div> <!-- class="panel-body" -->
<!--		</div> <!-- class="panel panel-info" -->
<!--	</div> <!-- class="col-md-7" -->
<!--	</div> <!-- class="row" -->
<!--	@endif
@endforeach
-->
