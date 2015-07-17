@extends('master')
@section('title', 'Profile')

@section('content')

	<div class="row">		 
		<div class="col-md-9">
			<h1> {{$user->name}} </h1>
			</br>
				@if($user->hasRole('Manager'))
					<p><span class="label label-primary">Manager</span></p>
				@else
					<p><span class="label label-primary">Developer</span></p>
				@endif
				</br>	
				<p><strong>Email: </strong> {{$user->email}} </p>
				<p><strong>About: </strong> {{$user->description}} </p>
				<p><strong>Skills: </strong> 
				@unless($user->tags->isEmpty())
					@foreach($user->tags as $tag)
						<span class="label label-info">{{$tag->name}}</span>
					@endforeach
				@endunless
				</p>
		</div> <!-- class="col-md-9" -->             
			<div class="col-md-3 text-center">
				<figure>
					@if (File::exists('./images/profiles/' . $user->id . '.jpg')) 
						<img src="/images/profiles/{{$user->id}}.jpg" alt="" class="img-circle img-center">
					@else 
						<img src="{{$user->image}}" alt="" class="img-circle img-center">
					@endif
					@if($user->hasRole('Developer'))
						<figcaption class="ratings">
						</br>
						@if(Auth::user()->hasRole('Manager'))
							@if($user->hasRole('Developer'))
								<p><a class="btn btn-lg btn-success" href="/ratings/{{$user->id}}/create">Rate User</a></p>
							@endif
						@endif
						<p>Rating:
						@for ($i = 0; $i != $user->ratings()->avg('rating'); $i++)
							<span class="fa fa-star"></span>
						@endfor
						</p>
						</figcaption>
					@endif
				</figure>
			</div> <!-- class="col-md-3 text-center" --> 
	</div> <!-- class="row" -->	
	<hr />

	@if($user->hasRole('Developer'))
		@unless($user->ratings->isEmpty())
			@foreach($user->ratings as $rating)
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
		@unless($user->jobs->isEmpty())
			<p><strong>Job Listings:</strong></p>
			@foreach($user->jobs()->get() as $job)
				<p><a href="/jobs/{{$job->id}}/">{{$job->title}}</a></p>
			@endforeach
		@endunless
	@endif
	<hr/>
	</br>
	<p><a href="/users/">Back to Profiles</a></p>	

@endsection

<!-- Skills:
@if($user->html5 == 1)
	  <span class="label label-primary">HTML5</span>
@endif -->
<!--@if($user->css == 1)
	  <span class="label label-info">CSS</span>
@endif
@if($user->php == 1)
	  <span class="label label-success">PHP</span>
@endif
-->