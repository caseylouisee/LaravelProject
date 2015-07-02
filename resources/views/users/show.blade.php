@extends('master')
@section('title', 'Home')

@section('content')
	
	{{$user->name}}
	</br>
	{{$user->description}}
	</br>
		
	<a href="/users/index">Profiles</a></p>	

@endsection