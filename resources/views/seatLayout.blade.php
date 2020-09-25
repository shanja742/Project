@extends('layouts.app')

@section('extraCss')

    <style>
        body {
            background: #555;
            font-size: 12px;
        }

        h1 {
            color: #eee;
            font: 30px Arial, sans-serif;
            text-shadow: 0px 1px black;
            text-align: center;
        }

        input[type=checkbox] {
            visibility: hidden;
        }

        .containerbus {
            display: flex;
            justify-content: center;
        }

        .autobus {
            background: lightgray;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 240px;
            height: 400px;
        }

        .fila {
            display: flex;
            justify-content: space-between;
        }

        .seccion {
            display: flex;
            width: 34%;
            justify-content: space-between;
        }
        .seccion1 {
            display: flex;
            width: 50%;
            justify-content: space-between;
        }
        .seccion2 {
            display: flex;
            width: 100%;
            justify-content: space-between;
        }

        .asiento {
            width: 21px;
            height: 21px;
            color: white;
            font-size: 10;
            text-align: center;
            background: #fcfff4;
            background: linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
            margin: 5px auto;
            box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0, 0, 0, 0.5);
            position: relative;
        }

        .asiento label {
            cursor: pointer;
            position: absolute;
            width: 15px;
            height: 15px;
            left: 3px;
            top: 3px;
            box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.5), 0px 1px 0px rgba(255, 255, 255, 1);
            background: linear-gradient(top, #222 0%, #45484d 100%);
        }

        .asiento label:after {
            filter: alpha(opacity=0);
            opacity: 0;
            content: '';
            position: absolute;
            width: 15px;
            height: 15px;
            background: #00bf00;
            background: linear-gradient(top, #0895d3 0%, #0966a8 100%);
            top: 0px;
            left: 0px;
            box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0, 0, 0, 0.5);
        }

        .asiento label:hover::after {
            filter: alpha(opacity=30);
            opacity: 0.3;
        }

        .asiento input[type=checkbox]:checked + label:after {
            filter: alpha(opacity=100);
            opacity: 1;
        }
    </style>

    @endsection

@section('content')

    <div class="container bg-white">
        <div style="overflow-x: auto;">
            <table class="table table-bordered table-striped my-auto mx-auto">
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
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$bus->name}}</td>
                        <td>{{$bus->departure}}</td>
                        <td>{{$bus->destination}}</td>
                        <td>{{$bus->departureTime}}</td>
                        <td>{{$bus->departureDate}}</td>
                        <td>{{$bus->ticketPrice}}</td>
                        <td>{{$bus->seats}}</td>
                        <td>{{count(\App\Seat::where('bus_id', $bus->id)->where('occupied', 0)->get())}}</td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container">
        <h1>Select your seat</h1>
        <form action="{{route('seatBook')}}" method="post">
            @csrf
        <div class="containerbus">
            <!-- Squared ONE -->
            <div class="autobus">

                <div class="fila">
                    <div class="seccion">
                        @foreach($seatSet1 as $seat)
                        <div class="asiento {{$seat->occupied == 1 ? 'bg-danger' : ''}}">
                            <input type="checkbox" value="{{$seat->id}}" id="asiento{{$seat->id}}" name="check[]" {{$seat->occupied == 1 ? 'disabled' : ''}} />
                            <label for="asiento{{$seat->id}}" style="color: black;">{{$seat->number}}</label>
                        </div>
                        @endforeach
                    </div>
                    <div class="seccion1">
                        @foreach($seatSet2 as $seat)
                        <div class="asiento {{$seat->occupied == 1 ? 'bg-danger' : ''}}">
                            <input type="checkbox" value="{{$seat->id}}" id="asiento{{$seat->id}}" name="check[]" {{$seat->occupied == 1 ? 'disabled' : ''}} />
                            <label for="asiento{{$seat->id}}" style="color: black;">{{$seat->number}}</label>
                        </div>
                            @endforeach
                    </div>
                </div>
                <div class="fila">
                    <div class="seccion">
                        @foreach($seatSet3 as $seat)
                            <div class="asiento {{$seat->occupied == 1 ? 'bg-danger' : ''}}">
                                <input type="checkbox" value="{{$seat->id}}" id="asiento{{$seat->id}}" name="check[]" {{$seat->occupied == 1 ? 'disabled' : ''}} />
                                <label for="asiento{{$seat->id}}" style="color: black;">{{$seat->number}}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="seccion1">
                        @foreach($seatSet4 as $seat)
                            <div class="asiento {{$seat->occupied == 1 ? 'bg-danger' : ''}}">
                                <input type="checkbox" value="{{$seat->id}}" id="asiento{{$seat->id}}" name="check[]" {{$seat->occupied == 1 ? 'disabled' : ''}} />
                                <label for="asiento{{$seat->id}}" style="color: black;">{{$seat->number}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="fila">
                    <div class="seccion">
                        @foreach($seatSet5 as $seat)
                            <div class="asiento {{$seat->occupied == 1 ? 'bg-danger' : ''}}">
                                <input type="checkbox" value="{{$seat->id}}" id="asiento{{$seat->id}}" name="check[]" {{$seat->occupied == 1 ? 'disabled' : ''}} />
                                <label for="asiento{{$seat->id}}" style="color: black;">{{$seat->number}}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="seccion1">
                        @foreach($seatSet6 as $seat)
                            <div class="asiento {{$seat->occupied == 1 ? 'bg-danger' : ''}}">
                                <input type="checkbox" value="{{$seat->id}}" id="asiento{{$seat->id}}" name="check[]" {{$seat->occupied == 1 ? 'disabled' : ''}} />
                                <label for="asiento{{$seat->id}}" style="color: black;">{{$seat->number}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="fila">
                    <div class="seccion">
                        @foreach($seatSet7 as $seat)
                            <div class="asiento {{$seat->occupied == 1 ? 'bg-danger' : ''}}">
                                <input type="checkbox" value="{{$seat->id}}" id="asiento{{$seat->id}}" name="check[]" {{$seat->occupied == 1 ? 'disabled' : ''}} />
                                <label for="asiento{{$seat->id}}" style="color: black;">{{$seat->number}}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="seccion1">
                        @foreach($seatSet8 as $seat)
                            <div class="asiento {{$seat->occupied == 1 ? 'bg-danger' : ''}}">
                                <input type="checkbox" value="{{$seat->id}}" id="asiento{{$seat->id}}" name="check[]" {{$seat->occupied == 1 ? 'disabled' : ''}} />
                                <label for="asiento{{$seat->id}}" style="color: black;">{{$seat->number}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="fila">
                    <div class="seccion">
                        @foreach($seatSet9 as $seat)
                            <div class="asiento {{$seat->occupied == 1 ? 'bg-danger' : ''}}">
                                <input type="checkbox" value="{{$seat->id}}" id="asiento{{$seat->id}}" name="check[]" {{$seat->occupied == 1 ? 'disabled' : ''}} />
                                <label for="asiento{{$seat->id}}" style="color: black;">{{$seat->number}}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="seccion1">
                        @foreach($seatSet10 as $seat)
                            <div class="asiento {{$seat->occupied == 1 ? 'bg-danger' : ''}}">
                                <input type="checkbox" value="{{$seat->id}}" id="asiento{{$seat->id}}" name="check[]" {{$seat->occupied == 1 ? 'disabled' : ''}} />
                                <label for="asiento{{$seat->id}}" style="color: black;">{{$seat->number}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="fila">
                    <div class="seccion">
                        @foreach($seatSet11 as $seat)
                            <div class="asiento {{$seat->occupied == 1 ? 'bg-danger' : ''}}">
                                <input type="checkbox" value="{{$seat->id}}" id="asiento{{$seat->id}}" name="check[]" {{$seat->occupied == 1 ? 'disabled' : ''}} />
                                <label for="asiento{{$seat->id}}" style="color: black;">{{$seat->number}}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="seccion1">
                        @foreach($seatSet12 as $seat)
                            <div class="asiento {{$seat->occupied == 1 ? 'bg-danger' : ''}}">
                                <input type="checkbox" value="{{$seat->id}}" id="asiento{{$seat->id}}" name="check[]" {{$seat->occupied == 1 ? 'disabled' : ''}} />
                                <label for="asiento{{$seat->id}}" style="color: black;">{{$seat->number}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="fila">
                    <div class="seccion">
                        @foreach($seatSet13 as $seat)
                            <div class="asiento {{$seat->occupied == 1 ? 'bg-danger' : ''}}">
                                <input type="checkbox" value="{{$seat->id}}" id="asiento{{$seat->id}}" name="check[]" {{$seat->occupied == 1 ? 'disabled' : ''}} />
                                <label for="asiento{{$seat->id}}" style="color: black;">{{$seat->number}}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="seccion1">
                        @foreach($seatSet14 as $seat)
                            <div class="asiento {{$seat->occupied == 1 ? 'bg-danger' : ''}}">
                                <input type="checkbox" value="{{$seat->id}}" id="asiento{{$seat->id}}" name="check[]" {{$seat->occupied == 1 ? 'disabled' : ''}} />
                                <label for="asiento{{$seat->id}}" style="color: black;">{{$seat->number}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="fila">
                    <div class="seccion">
                        @foreach($seatSet15 as $seat)
                            <div class="asiento {{$seat->occupied == 1 ? 'bg-danger' : ''}}">
                                <input type="checkbox" value="{{$seat->id}}" id="asiento{{$seat->id}}" name="check[]" {{$seat->occupied == 1 ? 'disabled' : ''}} />
                                <label for="asiento{{$seat->id}}" style="color: black;">{{$seat->number}}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="seccion1">
                        @foreach($seatSet16 as $seat)
                            <div class="asiento {{$seat->occupied == 1 ? 'bg-danger' : ''}}">
                                <input type="checkbox" value="{{$seat->id}}" id="asiento{{$seat->id}}" name="check[]" {{$seat->occupied == 1 ? 'disabled' : ''}} />
                                <label for="asiento{{$seat->id}}" style="color: black;">{{$seat->number}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="fila">
                    <div class="seccion">
                        @foreach($seatSet17 as $seat)
                            <div class="asiento {{$seat->occupied == 1 ? 'bg-danger' : ''}}">
                                <input type="checkbox" value="{{$seat->id}}" id="asiento{{$seat->id}}" name="check[]" {{$seat->occupied == 1 ? 'disabled' : ''}} />
                                <label for="asiento{{$seat->id}}" style="color: black;">{{$seat->number}}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="seccion1">
                        @foreach($seatSet18 as $seat)
                            <div class="asiento {{$seat->occupied == 1 ? 'bg-danger' : ''}}">
                                <input type="checkbox" value="{{$seat->id}}" id="asiento{{$seat->id}}" name="check[]" {{$seat->occupied == 1 ? 'disabled' : ''}} />
                                <label for="asiento{{$seat->id}}" style="color: black;">{{$seat->number}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="fila">
                    <div class="seccion">
                    </div>
                    <div class="seccion1">
                        @foreach($seatSet19 as $seat)
                            <div class="asiento {{$seat->occupied == 1 ? 'bg-danger' : ''}}">
                                <input type="checkbox" value="{{$seat->id}}" id="asiento{{$seat->id}}" name="check[]" {{$seat->occupied == 1 ? 'disabled' : ''}} />
                                <label for="asiento{{$seat->id}}" style="color: black;">{{$seat->number}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="fila">
                    <div class="seccion2">
                        @foreach($seatSet20 as $seat)
                            <div class="asiento {{$seat->occupied == 1 ? 'bg-danger' : ''}}">
                                <input type="checkbox" value="{{$seat->id}}" id="asiento{{$seat->id}}" name="check[]" {{$seat->occupied == 1 ? 'disabled' : ''}} />
                                <label for="asiento{{$seat->id}}" style="color: black;">{{$seat->number}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
            <input type="hidden" name="bus" value="{{$bus->id}}">
        <div class="text-center mt-2">
            <input type="submit" value="Submit" class="btn btn-primary">
        </div>

        </form>
        <div class="container mt-2">
            <h3 class="text-center text-danger">Red Seats are not Available.</h3>
        </div>
    </div>

    @endsection