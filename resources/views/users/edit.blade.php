@extends('master')
@section('title','Edit User')

@section('content')
	<h1>Edit User</h1>
	<hr/>
	<div class="col-md-12">
		<div class="form">
			{!! Form::model($user, array('method' => 'PATCH', 'files' => true, 'route' => array('users.update', $user->id))) !!}
		
			<div class="form-group">
    			{!! Form::label('name', 'Name:') !!}</br>
    			{!! Form::text('name', Input::old('name'), ['class'=>'form-control', 'style'=>'font-size: 20px']) !!}
			</div> <!-- class="form-group" -->
		
			<div class="form-group">
				{!! Form::label('description', 'Description:') !!}</br>
				{!! Form::textarea('description', Input::old('description'),  ['class'=>'form-control', 'style'=>'font-size: 20px']) !!}
			</div> <!-- class="form-group" -->
		
			<div class="form-group">
				{!! Form::label('tag_list', 'Skills:') !!}</br>
				{!! Form::select('tag_list[]', $tags, null, ['id' =>'tag_list', 'class'=>'form-control', 'multiple', 'style'=>'font-size:20px', 'style'=>'width: 100%']) !!}
			</div> <!-- class="form-group" -->
		
			<div class="form-group">
				{!! Form::label('Profile Image') !!}
				{!! Form::file('image', null) !!}
			</div> <!-- class="form-group" -->
		
			{!! Form::submit('Save!', array('class' => 'btn btn-primary btn-block')) !!}
			{!! Form::close() !!}
		</div> <!-- class="form" -->
	</div> <!-- class="col-md-12" -->
@endsection


@section('footer')
	<script>
		$(tag_list).select2();
	</script>
@endsection