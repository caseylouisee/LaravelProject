@extends('master')

@section('title', 'Profiles')

@section('content')
	<h1>Profiles</h1>
	<hr />

	<!--
	@if (count($user->get()) === 1)
		I have one record!
	@elseif (count($user->get()) > 1)
		I have multiple records!
	@endif
	-->
	
	@foreach($user->get() as $users)
	<div class="entry">
		<p><a href="/users/{{$users->slug}}">{{$users->name}}</a></p>
	</div>
	@endforeach
	
	
	<!--{{$user->get()}}-->
		
		



@endsection


