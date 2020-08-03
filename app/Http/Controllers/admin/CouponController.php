<?php

namespace App\Http\Controllers\admin;

use App\Coupon;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function store(Request $request)
    {
        $now = Carbon::now();
        $coupons = Coupon::orderBy('id', 'desc')->get();
        if (Auth::guard('admin')->user()->cannot('view-coupon', $coupons)) {
            abort(403);
        }
        return view('admin.admin.coupons.index')->with('coupons', $coupons);
    }

    public function show($id)
    {
        $coupon = Coupon::find($id);
        if (Auth::guard('admin')->user()->cannot('view-coupon', $coupon)) {
            abort(403);
        }
        return view('admin.admin.coupons.detail')->with('coupon', $coupon);
    }

    public function create(CouponRequest $request)
    {
        if (Auth::guard('admin')->user()->cannot('create-coupon')) {
            abort(403);
        }
        $check = Coupon::where('name', $request->name)->get();
        if ($check->count() > 0) {
            return redirect('admin/coupons')->with('error', 'Mã giảm giá đã tồn tại! ');
        }
        $coupon = new Coupon;
        $coupon->name = $request->name;
        $coupon->qty = $request->qty;
        $coupon->value = $request->value;
        $coupon->start = $request->start;
        $coupon->end = $request->end;
        if ($request->coupon_price) {
            $coupon->coupon_price = $request->coupon_price;
        }
        $coupon->save();
        return redirect('admin/coupons')->with('success', 'Thêm mới mã giảm giá thành công! ID: '.$coupon->id);
    }
}
