<?php

namespace App\Http\Controllers;

use App\Bus;
use App\Seat;
use Illuminate\Http\Request;

class AdminBusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buses = Bus::all();
        return view('admin.bus.index', compact('buses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bus = Bus::create($request->all());
        for($i=0; $i<54; $i++) {
            $seat = new Seat;
            $seat->number = $i+1;
            $seat->occupied = 0;
            $seat->bus_id = $bus->id;
            $seat->save();
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bus = Bus::findOrFail($id);
            $seats = Seat::where('bus_id', $bus->id)->get();
            foreach($seats as $seat){
                $seat->delete();
            }
            $bus->delete();
            return redirect()->back();
    }

    public function editBus(Request $request){
        $bus = Bus::findOrFail($request['id']);
        $bus->name = $request['name'];
        $bus->departure = $request['departure'];
        $bus->save();
        return redirect()->back();
    }
}
