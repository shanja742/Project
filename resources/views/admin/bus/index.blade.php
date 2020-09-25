@extends('layouts.admin')

@section('extraCss')

    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">

@endsection


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Buses</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="container">
        <div class="clearfix">
            <a href="#" class="btn btn-success float-right" data-toggle="modal" data-target="#modal-bus"><i class="fa fa-plus"></i> Add Bus</a>
        </div>


        <div class="card mt-5">
            <div class="card-header">
                <h3 class="card-title">All Buses</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
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
                        <th scope="col">Actions</th>
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
                            <td class="row">
                                <span data-toggle="modal" data-target="#modal-edit-bus">
                                <a class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit" onclick="populateEditModal( {{$bus}})">
                                    <i class="fas fa-edit" style="color: white;"></i>
                                </a>
                                    </span>

                                <form action="{{url('/admin/bus', [$bus->id])}}" method="post">
                                    <input type="hidden" name="_method" value="DELETE" />
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-success btn-sm ml-1" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Do you really want to delete this Bus?');">
                                        <i class="fas fa-trash" style="color: white;"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-bus">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Bus</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('bus.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="text" name="name" class="form-control mb-2" placeholder="Bus Name">
                        <input type="text" name="departure" class="form-control mb-2" placeholder="Departure">
                        <input type="text" name="destination" class="form-control mb-2" placeholder="Destination">
                        <input type="time" name="departureTime" class="form-control mb-2" placeholder="Departure Time">
                        <input type="date" name="departureDate" class="form-control mb-2" placeholder="Departure Date">
                        <input type="number" name="ticketPrice" class="form-control mb-2" placeholder="Ticket Price">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <input type="submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-edit-bus">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('editBus')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" value="" id="idValue2" name="id">
                        <input type="text" class="form-control mb-2" name="name" id="nameValue">
                        <input type="text" class="form-control mb-2" name="departure" id="departureValue">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <input type="submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    @endsection

@section('extraJs')

    <!-- DataTables -->
    <script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script>
        $(function () {
            $('#example1').dataTable({
            });
        });
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        function populateEditModal(e){
            document.getElementById("idValue2").value = e['id'];
            document.getElementById("nameValue").value = e['name'];
            document.getElementById("departureValue").value = e['departure'];
        }
    </script>


@endsection