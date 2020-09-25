<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Bus;
use App\Order;
use App\Seat;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about_us', function(){
    return view('about');
})->name('about');
Route::group(['middleware' => 'auth'], function(){
    Route::get('/bus/{id}/seats', function($id){
        $bus = Bus::findOrFail($id);
        $seats = Seat::where('bus_id', $bus->id)->get();
        $seatSet1 = $seats->slice(0,2);
        $seatSet2 = $seats->slice(2,3);
        $seatSet3 = $seats->slice(5,2);
        $seatSet4 = $seats->slice(7,3);

        $seatSet5 = $seats->slice(10,2);
        $seatSet6 = $seats->slice(12,3);

        $seatSet7 = $seats->slice(15,2);
        $seatSet8 = $seats->slice(17,3);

        $seatSet9 = $seats->slice(20,2);
        $seatSet10 = $seats->slice(22,3);

        $seatSet11 = $seats->slice(25,2);
        $seatSet12 = $seats->slice(27,3);

        $seatSet13 = $seats->slice(30,2);
        $seatSet14 = $seats->slice(32,3);

        $seatSet15 = $seats->slice(35,2);
        $seatSet16 = $seats->slice(37,3);
        $seatSet17 = $seats->slice(40,2);
        $seatSet18 = $seats->slice(42,3);
        $seatSet19 = $seats->slice(45,3);
        $seatSet20 = $seats->slice(48,6);
        return view('seatLayout', compact('bus', 'seatSet1', 'seatSet2', 'seatSet3', 'seatSet4', 'seatSet5', 'seatSet6', 'seatSet7', 'seatSet8', 'seatSet9', 'seatSet10', 'seatSet11', 'seatSet12', 'seatSet13', 'seatSet14', 'seatSet15', 'seatSet16', 'seatSet17', 'seatSet18', 'seatSet19', 'seatSet20'));
    })->name('seats');

//Route::get('/order/details',)

    Route::post('/seatBook', function(Request $request){
        $bus = $request['bus'];
        $seats = $request['check'];
        return redirect()->route('booking', ['bus'=>json_encode($bus), 'seats'=> json_encode($seats)]);
    })->name('seatBook');

    Route::get('/booking/{bus}/{seats}', function($bus, $seats){
        $bus = Bus::findOrFail(json_decode($bus));
        $seats = DB::table('seats')->whereIn('id',json_decode($seats))->get();
        return view('payment', compact('seats', 'bus'));
//        return view('orderDetails', compact('bus', 'seats'));
    })->name('booking');

    Route::post('/checkOut', function(Request $request){
        $seats = '';
        foreach($request['seat'] as $seat){
            $seat = Seat::findOrFail($seat);
            $seat->occupied = 1;
            $seat->update();
            $seats .= strval($seat->number) . ", ";
        }
        $input = $request->all();
        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->departureDate = $input['departureDate'];
        $order->mobileNumber = $input['mobileNumber'];
        $order->departure = $input['departure'];
        $order->destination = $input['destination'];
        $order->numberOfTickets = $input['numberOfTickets'];
        $order->total = $input['total'];
        $order->seats = $seats;
        $order->save();
        Auth::user()->notify(new \App\Notifications\OrderCreated());
        return redirect()->route('user.orders');
    })->name('checkOut');

    Route::get('/payment/{request}', function($request){
       return view('payment');
    });

    Route::get('/orders', function(){
        $orders = Auth::user()->orders;
        return view('orders', compact('orders'));
    })->name('user.orders');

    Route::get('/print/{id}', function($id){
        $order = Order::findOrFail($id);
        return view('print',compact('order'));
    })->name('print');
});

Route::group(['middleware' =>  ['admin', 'auth']],function() {

    Route::get('/admin', 'AdminController@admin')->name('admin');
    Route::resource('/admin/bus', 'AdminBusController');
    Route::post('/edit/bus', 'AdminBusController@editBus')->name('editBus');
    Route::get('/admin/orders', function(){
        $orders = Order::all();
        return view('admin.order.index', compact('orders'));
    })->name('orders');
    Route::get('/admin/users', function(){
        $users = User::all();
        return view('admin.user.index', compact('users'));
    })->name('users');

});
