<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BusBooking Order Print</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>

<table class="table table-striped">
    <thead>
    <tr>
        <th>Subject</th>
        <th>Details</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Customer Name</td>
        <td>{{$order->user->name}}</td>
    </tr>
    <tr>
        <td>Customer Mobile Number</td>
        <td>{{$order->mobileNumber}}</td>
    </tr>
    <tr>
        <td>Departuer Date</td>
        <td>{{$order->departureDate}}</td>
    </tr>
    <tr>
        <td>Departuer</td>
        <td>{{$order->departure}}</td>
    </tr>
    <tr>
        <td>Destination</td>
        <td>{{$order->destination}}</td>
    </tr>
    <tr>
        <td>Number of Tickets</td>
        <td>{{$order->numberOfTickets}}</td>
    </tr>
    <tr>
        <td>Seat Numbers</td>
        <td>{{$order->seats}}</td>
    </tr>
    <tr>
        <td>Total Price</td>
        <td>{{$order->total}}</td>
    </tr>
    </tbody>
</table>

<script type="text/javascript">
        window.addEventListener("load", window.print());
</script>
</body>
</html>