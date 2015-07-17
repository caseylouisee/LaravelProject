@extends('master')

@section('content')
    <h1>Create a new message</h1>
    <hr />
    
    {!! Form::open(['route' => 'messages.store']) !!}
    <div class="col-md-12">
        <!-- Subject Form Input -->
        <div class="form-group">
            {!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}
            {!! Form::text('subject', null, ['class' => 'form-control', 'style'=>'font-size: 20px']) !!}
        </div> <!-- class="form-group" -->

        <!-- Message Form Input -->
        <div class="form-group">
            {!! Form::label('message', 'Message', ['class' => 'control-label']) !!}
            {!! Form::textarea('message', null, ['class' => 'form-control', 'style'=>'font-size: 20px']) !!}
        </div> <!-- class="form-group" -->

        @if($users->count() > 0)
            <div class="checkbox">
                @foreach($users as $user)
                    <label title="{!!$user->name!!}">
                        <input type="checkbox" name="recipients[]" value="{!!$user->id!!}">
                        {!!$user->name!!}
                    </label>
                @endforeach
            </div> <!-- class="checkbox" -->
        @endif
    
        <!-- Submit Form Input -->
        <div class="form-group">
            {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
        </div> <!-- class="form-group" -->
        {!! Form::close() !!}
    </div> <!-- class="col-md-6" -->
@endsection
