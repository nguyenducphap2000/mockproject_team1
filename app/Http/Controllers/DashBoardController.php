<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    /*
     * Show dashboard page with data
     *
     *
     * @return resources/views/admin/overview.blade.php
     */
    public function index()
    {
        $orders = Order::all();
        return view('admin.overview', [
            'orders' => Order::orderBy('purchased_date','desc')->limit(5)->get(),
            'numberOfOrder' => count($orders),
            'total' => $orders->sum('total'),
            'average' => $orders->sum('total') / Transaction::all()->sum('amount')
        ]);
    }
}
