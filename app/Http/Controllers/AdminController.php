<?php

namespace App\Http\Controllers;

use App\Bus;
use App\Order;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin(){
        $userCount = User::get()->count();
        $busCount = Bus::get()->count();
        $orderCount = Order::get()->count();
        return view('admin.dashboard', compact('userCount', 'busCount', 'orderCount'));
    }
}
