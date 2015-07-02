@extends('master')
@section('title', 'My Profile')

@section('content')

	<h1> Welcome {{Auth::user()->name}} </h1>
		
	<a href="/users/index">Profiles</a></p>
	
@endsection