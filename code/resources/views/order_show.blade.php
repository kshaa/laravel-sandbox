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
                    @if(count($order->ticketOrders) > 0)
                        <div class="card-text">
                            <table class="table table-hover">
                                <thead><tr class="table-primary">
                                    <th scope="col">Event</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Row</th>
                                    <th scope="col">Seat</th>
                                    <th scope="col">Price</th>
                                    <th scope="col"></th>
                                </tr></thead>
                                <tbody>
                                @foreach ( $order->ticketOrders as $ticketOrder )
                                @php
                                    $ticket = $ticketOrder->ticket;
                                @endphp
                                <tr>
                                    <td>{{ $ticket->event->name }}</td>
                                    <td>{{ $ticket->event->formatTime() }}</td>
                                    <td>{{ $ticket->event->location }}</td>
                                    <td>{{ $ticket->row }}</td>
                                    <td>{{ $ticket->seat }}</td>
                                    <td>{{ $ticket->price }}</td>
                                </tr>
                                @endforeach 
                                <tr class="table-primary">
                                    <td colspan="6"></td>
                                    <td>{{ $total }}</td>
                                </tr>                        
                                </tbody>
                            </table>
                            <table class="table table-hover">
                                <thead><tr class="table-primary">
                                    <th scope="col">Shipping Address</th>
                                    <th scope="col">Phone number</th>
                                </tr></thead>
                                <tbody>
                                <tr>
                                    <td>{{ $order->shipping_address}}</td>
                                    <td>{{ $order->phone_number}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="card-text">This order has no tickets.</p>
                        <p class="card-text">This shouldn't happen, contact a site administrator.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 