@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div class="card mt-5">
                            <div class="card-header">
                                <h3 class="card-title">Available Buses Right Now</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div style="overflow-x: auto;">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th scope="col">Bus Name</th>
                                            <th scope="col">Departure</th>
                                            <th scope="col">Destination</th>
                                            <th scope="col">Departure Time</th>
                                            <th scope="col">Departure Date</th>
                                            <th scope="col">Ticket Price</th>
                                            <th scope="col">Seats</th>
                                            <th scope="col">Available Seats</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($buses as $bus)
                                            <tr>
                                                <td>{{$bus->name}}</td>
                                                <td>{{$bus->departure}}</td>
                                                <td>{{$bus->destination}}</td>
                                                <td>{{$bus->departureTime}}</td>
                                                <td>{{$bus->departureDate}}</td>
                                                <td>{{$bus->ticketPrice}}</td>
                                                <td>{{$bus->seats}}</td>
                                                <td>{{count(\App\Seat::where('bus_id', $bus->id)->where('occupied', 0)->get())}}</td>
                                                <td><a href="{{route('seats', $bus->id)}}" class="btn btn-primary" {{count(\App\Seat::where('bus_id', $bus->id)->where('occupied', 0)->get()) < 1 ? 'disabled' : ''}}>Reserve Now</a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
        </div>
    </div>
</div>
@endsection
