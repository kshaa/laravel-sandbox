@extends('layouts.app')
@section('content')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="my-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @elseif (null !== session('errors') && session('errors')->any())
        <div class="alert alert-danger">
            <ul class="my-0">
                @foreach (session('errors')->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-sm">
            <div class="list-group">
                <div class="list-group-item list-group-item-primary"><h4>{{$title}}</h4></div>

                <div class="list-group-item">
                    @if(count($orders) > 0)
                        @foreach ( $orders as $order )
                        <div class="card">
                            <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ url('orders/info', $order['id']) }}">{{ $order->shipping_address }}</a>
                            </h5>
                            <p class="card-text">
                                <span class="badge badge-primary">{{ $order->created_at }}</span>
                                <span class="badge badge-primary">{{ $order->phone_number }}</span>
                            </p>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="card-text">You currently have no orders</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 