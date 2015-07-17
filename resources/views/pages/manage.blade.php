@extends('master')

@section('title', 'Manage')

@section('content')

	<p><a href="/jobs/create" class="btn btn-default">Create Job</a>
	<a href="/tags/create" class="btn btn-default">Create Tag</a></p>

	
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingOne">
				<h4 class="panel-title">
					<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					Manage Jobs:
				</a>
				</h4>
			</div> <!-- class"panel-heading" -->
			<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
				<div class="panel-body">
					@foreach(Auth::user()->jobs as $job)
						<p>
						{!! Form::open(array('url' => 'jobs/' . $job->id)) !!}
							{!! Form::hidden('_method', 'DELETE') !!}
							{!! Form::submit('Delete this job', array('class' => 'btn btn-danger pull-right')) !!}
						{!! Form::close() !!}
						</p>
						<p>
							<a href="/jobs/{{$job->id}}/edit" class="btn btn-info pull-right">Edit Job</a>
						</p>
						<p>
							<a href="/jobs/{{$job->id}}">{{$job->title}}</a>
						</p>
						<p>{{$job->description}}</p>
						@unless($job->bids->isEmpty())
							<table class="table table-hover table-bordered">
								<tr>
									<th>Proposal</th>
									<th>User</th>		
									<th>Bid Status</th>
									<th>Accept Proposal?</th>
									<th>Job Status</th>
								</tr>
								@foreach($job->bids as $bid)
									@if($bid->pivot->status == 'Declined')
										<tr class='danger'>
									@elseif($bid->pivot->status == 'Accepted')
										<tr class='success'>
									@else
										<tr>
									@endif
									<!--{{$bid}}-->
										<td>{{$bid->pivot->proposal}}</td>
										<td>
											<a href="/users/{{$bid->pivot->user_id}}">
											{{App\User::find($bid->pivot->user_id)->name}}
											</a>
										</td>		
										<td>{{$bid->pivot->status}}</td>
										<td>
											@if($bid->pivot->status == 'Pending')
												<a href="bids/{{$bid->pivot->id}}-{{$bid->pivot->user_id}}-{{$bid->pivot->job_id}}/edit">
												Accept offer {{$bid->pivot->id}}</a>
											@else
												<strike><a>Accept offer</a></strike>
											@endif
										</td>
										<td>	
											@if($bid->pivot->status == 'Accepted')
												{{$job->status}}
											@endif
										</td>
									</tr>
								@endforeach
							</table>
						@endunless
						<hr/>
					@endforeach
				</div> <!-- class="panel-body" --> 
			</div> <!-- class="panel-collapse collapse in" -->
		</div> <!-- class="panel panel-default" -->
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingTwo">
				<h4 class="panel-title">
					<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
					Manage Skills:
					</a>
				</h4>
			</div> <!-- class="panel-heading" -->
			<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
				<div class="panel-body">
					@foreach($tags as $tag)
						<p>
						{!! Form::open(array('url' => 'tags/' . $tag->name)) !!}
							{!! Form::hidden('_method', 'DELETE') !!}
							{!! Form::submit('Delete this tag', array('class' => 'btn btn-danger pull-right')) !!}
						{!! Form::close() !!}
						</p>
						<p>{{$tag->name}}</p>
						<hr />
					@endforeach
				</div> <!-- class="panel-body" -->
			</div> <!-- class="panel-collapse collapse" -->
		</div> <!-- class="panel panel-default" -->
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingThree">
				<h4 class="panel-title">
					<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
					Charts:
					</a>
				</h4>
			</div> <!-- class="panel-heading" -->
			<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
				<div class="panel-body">
					<div id="jobs" style="height: 250px;"></div>		
				</div> <!-- class="panel-body" -->
			</div> <!-- class="panel-collapse collapse" -->
		</div> <!-- class="panel panel-default" -->
	</div> <!-- class="panel-group" -->
	

@endsection

@section('footer')
<script>
new Morris.Donut({
	element: 'jobs',
	colors: ['#60BFD5','#778899'],
	data: [
		{
			label: "Total Jobs",
			value: <?php echo count(App\Job::all()); ?>
		}, {
			label: "Your Jobs",
			value: <?php echo count(Auth::user()->jobs); ?>
		}],
	resize: true
});
</script>
@endsection