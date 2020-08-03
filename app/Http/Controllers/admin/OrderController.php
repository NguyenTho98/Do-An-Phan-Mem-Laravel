<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function store(Request $request)
    {
        $orders = Order::all();
        if (Auth::guard('admin')->user()->cannot('view-order', $orders)) {
            abort(403);
        }
        return view('admin.admin.orders.orders')->with('orders', $orders);
    }


    public function show($id)
    {
        $order = Order::where('id', $id)->where('is_delete', false)->firstorFail();
        if (Auth::guard('admin')->user()->cannot('view-order', $order)) {
            abort(403);
        }
        return view('admin.admin.orders.detail')->with('order', $order);
    }

}
