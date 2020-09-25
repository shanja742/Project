@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h3 class="card-title">Journey from {{$bus->departure}} to {{$bus->destination}}.</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{route('checkOut')}}" method="post">
                    @csrf
                <table class="table">
                    <thead>
                      <tr>
                        <th>Subject</th>
                        <th>Details</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Date of Departure</td>
                          <input type="hidden" value="{{$bus->departureDate}}" name="departureDate">
                        <td>{{$bus->departureDate}}</td>
                      </tr>
                      <tr>
                          <td>Departure</td>
                          <input type="hidden" value="{{$bus->departure}}" name="departure">
                          <td>{{$bus->departure}}</td>
                      </tr>
                      <tr>
                          <td>Destination</td>
                          <input type="hidden" value="{{$bus->destination}}" name="destination">
                          <td>{{$bus->destination}}</td>
                      </tr>
                      <tr>
                        <td>Number of Tickets</td>
                          <input type="hidden" value="{{count($seats)}}" name="numberOfTickets">
                        <td>{{count($seats)}}</td>
                      </tr>
                      <tr>
                        <td>Seat Numbers</td>
                        <td>
                            @foreach($seats as $seat)
                                <input type="hidden" value="{{$seat->id}}" name="seat[]">
                                <span>{{$seat->number}}, </span>
                                @endforeach
                        </td>
                      </tr>
                      <tr>
                          <td>Price</td>
                          <td>{{$bus->ticketPrice}} * {{count($seats)}} = {{$bus->ticketPrice * count($seats)}}</td>
                      </tr>
                      <tr>
                          <td>Total Price</td>
                          <input type="hidden" value="{{$bus->ticketPrice * count($seats)}}" name="total">
                          <td>{{$bus->ticketPrice * count($seats)}}</td>
                      </tr>
                    </tbody>
                  </table>
                    <input type="submit" value="Checkout" class="btn btn-success">
{{--                <a href="" class="btn btn-success">Checkout</a>--}}
            </div>
        </div>
    </div>

    @endsection