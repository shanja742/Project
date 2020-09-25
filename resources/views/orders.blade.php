@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h3 class="card-title">All Orders</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Departure</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Departure Date</th>
                        <th scope="col">Number of Tickets</th>
                        <th scope="col">Seat Numbers</th>
                        <th scope="col">Created</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->user->name}}</td>
                            <td>{{$order->departure}}</td>
                            <td>{{$order->destination}}</td>
                            <td>{{$order->departureDate}}</td>
                            <td>{{$order->numberOfTickets}}</td>
                            <td>{{$order->seats}}</td>
                            <td>{{$order->created_at->diffForHumans()}}</td>
                            <td>{{$order->total}}</td>
                            <td><a href="{{route('print', $order->id)}}" class="btn btn-primary">Print</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @endsection