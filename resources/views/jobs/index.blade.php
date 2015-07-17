@extends('master')
@section('title','Jobs')

@section('content')

	@if(Auth::user()->hasRole('Manager'))
		<a href="/jobs/create" class="btn btn-default pull-right">Create Job</a>
	@endif
	<h1>Jobs</h1>
	<hr />
	<div class='col-md-12'>
	@foreach($job as $jobs)
		<div class='col-md-4'>
		<div class="panel panel-default">
			<div class="panel-heading">
				<strong>{{$jobs->title}}</strong>
			</div> <!-- class="panel-heading" -->
			<div class="panel-body">
				@if(strlen($jobs->description)>100)
					<p> 
						<strong>Description:</strong>
						{{substr($jobs->description,0,100)}} ...
						<a href="/jobs/{{$jobs->id}}">Read More</a> 
					</p>
				@else
					<p> Description: {{$jobs->description}} </p>
				@endif
			</div> <!-- class="panel-body" -->
		</div> <!-- class="panel panel-default" -->
		</div>
	@endforeach
	</div>

	{!! $job->render() !!}

@endsection