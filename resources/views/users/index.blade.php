@extends('master')
@section('title', 'Profiles')

@section('content')

	<div id="sort" class="pull-right">
		Sort by:
		<a href="/users" title=""><button type="button" class="btn btn-default btn-xs">
		  	<span class="glyphicon glyphicon-sort" aria-hidden="true"></span> 
			Default
		</button></a>

		<a href="/users/index/sort" title=""><button type="button" class="btn btn-default btn-xs">
		  	<span class="glyphicon glyphicon-sort" aria-hidden="true"></span> 
			Name
		</button></a>

	</div> <!-- class="pull-right" -->
	
	<h1>Profiles</h1>
	<hr />
	@foreach($user->get() as $users)
	
		<!-- style 1 -->
		<div class="row">
			<div class="well col-md-12">
				<div class="col-md-2">
					@if(File::exists('./images/profiles/' . $users->id . '.jpg')) 
						<img src="/images/profiles/{{$users->id}}.jpg" alt="" class="img-circle img-center">
					@else 
						<img src="{{$users->image}}" alt="" class="img-circle img-center">
					@endif
				</div> <!-- class="col-md-2" -->
				<div class="col-md-10">
					<p><strong><a href="/users/{{$users->id}}">{{$users->name}}</a></strong>
					@for ($i = 0; $i != $users->ratings()->avg('rating'); $i++)
						<span class="pull-right fa fa-star"></span>
					@endfor
					</p>
					@if(strlen($users->description)>150)
						<p> 
							{{substr($users->description,0,150)}} ...
						</p>
					@else
						<p> {{$users->description}} </p>
					@endif
					
					@unless($users->tags->isEmpty())
						<p> 
							Skills:
							@foreach($users->tags as $tag)
								<span class="label label-info">{{$tag->name}}</span>
							@endforeach
						</p>
					@endunless
				</div> <!-- class="col-md-10" -->
			</div> <!-- class="well col-md-12" -->
		</div> <!-- class="row" -->
		
		<!-- style 2 -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<a href="/users/{{$users->id}}">{{$users->name}}</a>
				@for ($i = 0; $i != $users->ratings()->avg('rating'); $i++)
					<span class="pull-right fa fa-star"></span>
				@endfor
			</div> <!-- class="panel-heading" -->
			<div class="panel-body">
				<p>{{$users->description}}</p>
				@unless($users->tags->isEmpty())
					<p> 
					Skills:
					@foreach($users->tags as $tag)
						<span class="label label-info">{{$tag->name}}</span>
					@endforeach
					</p>
				@endunless
			</div> <!-- class="panel-body" -->
		</div> <!-- class="panel panel-default" -->
		
	@endforeach

@endsection

<!-- {!! Form::select('age', ['Under 18', '19 to 30', 'Over 30']) !!} -->

<!--
@if (count($user->get()) === 1)
	I have one record!
@elseif (count($user->get()) > 1)
	I have multiple records!
@endif
-->

<!--
{{$user->get()}}

@if($users->html5 == 1)
	  <span class="label label-primary">HTML5</span>
@endif
@if($users->css == 1)
	  <span class="label label-info">CSS</span>
@endif
@if($users->php == 1)
	  <span class="label label-success">PHP</span>
@endif

-->


