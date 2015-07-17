@extends('master')
@section('title','Job')

@section('content')

	<div class="jumbotron text-center">
		<h1>{{$job->title}}</h1>
		@if(Auth::user()->hasRole('Developer'))
			<a class="btn btn-primary pull-right" href="/bids/{{$job->id}}/create">Bid On This</a>
		@endif
	</div> <!-- class="jumbotron text-center" -->
	<div class="col-md-8">
		<p><strong>Description:</strong> {{$job->description}}<br></p>
		<p><strong>Created at:</strong> {{$job->created_at}}</p>
	</div> <!-- class="col-md-4" -->
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading text-center">
			Listing information:
			</div> <!-- class="panel-heading text-center" -->
			<div class="panel-body">
				<p>Listed by:</p>
				@foreach($job->users()->get() as $user)
					<li><a href="/users/{{$user->id}}">{{$user->name}}</a></li>
				@endforeach
				@if(count($job->users()->get()) > 1)
					<p>Other listings from these managers:</p>
				@else
					<p>Other listings from this manager:</p>
				@endif
				@foreach($job->users()->get() as $user)
					@foreach($user->jobs()->get() as $joblist)
						@if($joblist->id==$job->id)
						@else
							<li><a href="/jobs/{{$joblist->id}}">{{$joblist->title}}</a></li>
						@endif
					@endforeach
				@endforeach
			</div> <!-- class="panel-body" -->
		</div> <!-- class="panel panel-default" -->
	</div> <!-- class="col-md-4" -->
	
@endsection
