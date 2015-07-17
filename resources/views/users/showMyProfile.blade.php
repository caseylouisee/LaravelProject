@extends('master')
@section('title', 'My Profile')

@section('content')

	@foreach(Auth::user()->bids as $bid)
		@if($bid->pivot->status == 'Accepted')
			@if(App\Job::find($bid->pivot->job_id)->status!='Completed')
			<div class="alert alert-danger" role="alert">
				<div class="container">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					You have been accepted to complete {!!App\Job::find($bid->pivot->job_id)->title!!}. Please complete it according to your proposal({{$bid->pivot->proposal}}).
				</div> <!-- class="alert alert-danger" -->
			</div> <!-- class="container" -->
			@endif
		@endif
	@endforeach

	<div class="row">		 
		<div class="col-md-9">
			<h1> Welcome {{Auth::user()->name}} </h1>
			</br>
				@if(Auth::user()->hasRole('Manager'))
					<p><span class="label label-primary">Manager</span></p>
				@else
					<p><span class="label label-primary">Developer</span></p>
				@endif
				</br>	
				<p><strong>Email: </strong> {{Auth::user()->email}} </p>
				<p><strong>About: </strong> {{Auth::user()->description}} </p>
				<p><strong>Skills: </strong> 
					@unless(Auth::user()->tags->isEmpty())
						@foreach(Auth::user()->tags as $tag)
							<span class="label label-info">{{$tag->name}}</span>
						@endforeach
					@endunless
				</p>
				</br>
				<a href="/users/{{Auth::user()->id}}/edit">
					<span class="fa fa-pencil" aria-hidden="true"></span> 
					Edit Profile Information
				</a>
		</div> <!-- class="col-md-9" -->             
		<div class="col-md-3 text-center">
			<figure>
			@if(File::exists('./images/profiles/' . Auth::user()->id . '.jpg')) 
				<img src="/images/profiles/{{Auth::user()->id}}.jpg" alt="" class="img-circle img-center">
			@else 
				<img src="{{Auth::user()->image}}" alt="" class="img-circle img-center">
			@endif
				@if(Auth::user()->hasRole('Developer'))
					<figcaption class="ratings">
					</br>
					<p>Rating:
					@for ($i = 0; $i != Auth::user()->ratings()->avg('rating'); $i++)
						<span class="fa fa-star"></span>
					@endfor
					</p>
					</figcaption>
				@endif
			</figure>
		</div> <!-- class="col-md-3 text-center" --> 
	</div> <!-- class="row" -->	
	<hr />
	@if(Auth::user()->hasRole('Developer'))
		<p><strong>Your bids:</strong></p>
		<table class="table table-hover table-bordered">
		<tr>
			<td><strong>Your Proposal</strong></td>
			<td><strong>Job</strong></td>
			<td><strong>Bid Status</strong></td>
			<td><strong>Job Status</strong></td>
		</tr>
		@foreach(Auth::user()->bids as $bid)
			@if($bid->pivot->status == 'Declined')
				<tr class="danger">
			@elseif($bid->pivot->status == 'Accepted')
				<tr class="success">
			@else
				<tr>
			@endif
			<td>{{$bid->pivot->proposal}}</td>
			<td>
				<a href="/jobs/{{$bid->pivot->job_id}}">
				{{App\Job::find($bid->pivot->job_id)->title}}
				</a>
			</td>		
			<td>{{$bid->pivot->status}}</td>
			<td>{{App\Job::find($bid->pivot->job_id)->status}}</td>
		</tr>
		@endforeach
		</table>
	@endif
	
	
	@if(Auth::user()->hasRole('Manager'))
		@if($user->hasRole('Developer'))
			<a class="btn btn-default pull-right" href="/ratings/{{$user->id}}/create">Rate User</a>
		@endif
	@endif

	@if(Auth::user()->hasRole('Developer'))
		<p><strong>Ratings:</strong></p>
		@unless(Auth::user()->ratings->isEmpty())
			@foreach(Auth::user()->ratings as $rating)
				<div class="panel panel-default">
					<div class="panel-heading">
						Rated by: 
						<a href="/users/{{$rating->pivot->rated_by}}">
							{{App\User::find($rating->pivot->rated_by)->name}}
						</a>
						<div class="pull-right">
						@for ($i = 0; $i != $rating->rating; $i++)
							<span class="fa fa-star"></span>
						@endfor
						</div> <!-- class="pull-right" -->
					</div> <!-- class="panel-heading" -->
					<div class="panel-body">
						<p>{{$rating->comment}}</p>
					</div> <!-- class="panel-body" -->
				</div> <!-- class="panel panel-default" -->
			@endforeach
		@endunless
	@else
		@unless(Auth::user()->jobs->isEmpty())
			<p><strong>Job Listings:</strong></p>
			@foreach(Auth::user()->jobs()->get() as $job)
				<p><a href="/jobs/{{$job->id}}/">{{$job->title}}</a></p>
			@endforeach
		@endunless
	@endif
	
	</p>	
	<hr />
	<a href="/users/">Back to Profiles</a></p>

@endsection

<!--@if(Auth::user()->html5 == 1)
	  <span class="label label-primary">HTML5</span>
@endif
@if(Auth::user()->css == 1)
	  <span class="label label-info">CSS</span>
@endif
@if(Auth::user()->php == 1)
	  <span class="label label-success">PHP</span>
@endif-->