@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm">
            <div class="list-group">
                <div class="list-group-item list-group-item-primary"><h4>{{$title}}</h4></div>

                <div class="list-group-item">
                    @foreach ( $events as $event )
                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ url('event', $event['id']) }}">{{ $event->name }}, {{ $event->category->name }}</a>
                        </h5>
                        <p class="card-text">
                            <span class="badge badge-primary">{{$event->formatTime()}}</span>
                            <span class="badge badge-primary">{{$event->location}}</span>
                        </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 