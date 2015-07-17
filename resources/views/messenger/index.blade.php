@extends('master')

@section('content')
    @if (Session::has('error_message'))
        <div class="alert alert-danger" role="alert">
            {!! Session::get('error_message') !!}
        </div> <!-- class="alert alert-danger" -->
    @endif
    <p><a class="btn btn-default pull-right" href="{{URL::to('messages/create')}}">New Message</a></p>
    </br> </br>
    @if($threads->count() > 0)  
        @foreach($threads as $thread)
        <?php $class = $thread->isUnread($currentUserId) ? '-primary' : '-default'; ?>
        <div class="panel panel{!!$class!!}">
            <div class="panel-heading">
                @if($class=='-primary')
                    <a href="messages/{{$thread->id}}"><FONT COLOR="#fffff">{!!$thread->subject!!}
                    <span class="label label-success">New Message</span></FONT></a>
                @else
                    <a href="messages/{{$thread->id}}">{!!$thread->subject!!}</a>
                @endif
            </div> <!-- class="panel-heading" -->
            <div class="panel-body">
                <p>{!! $thread->latestMessage->body !!}</p>
                <small>
                    <strong>Creator:</strong> {!! $thread->creator()->name !!}
                    <strong>Participants:</strong> {!! $thread->participantsString() !!}
                </small>
            </div> <!-- class="panel-body" -->
        </div> <!-- class="panel panel{!!$class!!}" -->
        @endforeach
    @else
        <p>Sorry, no threads.</p>
    @endif
@stop
