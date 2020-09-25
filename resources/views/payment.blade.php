@extends('layouts.app')

@section('content')

    <div class="container mx-auto">

    <div class="mx-auto" align="center" justify="center">
        <div class="col-md-6 col-sm-12 col-lg-8">
            </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Departure</h6>
                            <small class="text-muted">{{$bus->departure}}</small>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Destination</h6>
                            <small class="text-muted">{{$bus->destination}}</small>
                        </div>


                        <small class="text-muted">{{$bus->departureTime}}</small>
                        </div>
                    </li>
                    @foreach($seats as $seat)
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Seat # {{$seat->number}}</h6>
                        </div>
                        <span class="text-muted">{{$bus->ticketPrice}}</span>
                    </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total</span>
                        <strong>{{$bus->ticketPrice * count($seats)}}</strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
            <hr>
                <h4 class="mb-3">Billing address</h4>
                <form action="{{route('checkOut')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="address">Mobile Number</label>
                        <input type="text" class="form-control" id="address" name="mobileNumber" placeholder="Mobile Number" required>
                        <input type="hidden" value="{{$bus->departureDate}}" name="departureDate">
                        <input type="hidden" value="{{$bus->departure}}" name="departure">
                        <input type="hidden" value="{{$bus->destination}}" name="destination">
                        <input type="hidden" value="{{count($seats)}}" name="numberOfTickets">
                        @foreach($seats as $seat)
                            <input type="hidden" value="{{$seat->id}}" name="seat[]">
                        @endforeach
                        <input type="hidden" value="{{$bus->ticketPrice * count($seats)}}" name="total">

                    </div>

                    <hr class="mb-4">

                    <h4 class="mb-3">Payment</h4>

                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="credit" name="paymentMethod" type="radio" value="1" onchange="hello(this)" class="custom-control-input" checked="" required="">
                            <label class="custom-control-label" for="credit">Credit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="debit" name="paymentMethod" type="radio" value="2" onchange="hello(this)" class="custom-control-input" required="">
                            <label class="custom-control-label" for="debit">Cash</label>
                        </div>
                    </div>
                    <div id="hello">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cc-name">Name on card</label>
                                <input type="text" class="form-control" id="cc-name" placeholder="">
                                <small class="text-muted">Full name as displayed on card</small>
                                <div class="invalid-feedback">
                                    Name on card is required
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cc-number">Credit card number</label>
                                <input type="text" class="form-control" id="cc-number" placeholder="">
                                <div class="invalid-feedback">
                                    Credit card number is required
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="cc-expiration">Expiration</label>
                                <input type="text" class="form-control" id="cc-expiration" placeholder="">
                                <div class="invalid-feedback">
                                    Expiration date required
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="cc-expiration">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" placeholder="">
                                <div class="invalid-feedback">
                                    Security code required
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Continue to Checkout">
{{--                    <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>--}}
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>

    @endsection

@section('extraJs')

    <script>
        function hello(myRadio){
            // alert(myRadio.value);
            if(myRadio.value == 1)
            document.getElementById('hello').style.display = 'block';
            else
                document.getElementById('hello').style.display = 'none';
        }
    </script>

    @endsection