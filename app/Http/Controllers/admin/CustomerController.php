<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Customer;
use App\Http\Requests\CustomerRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    // crud

    public function store(Request $request)
    {
        $customers = Customer::where('is_delete', false)->get();
        if (Auth::guard('admin')->user()->cannot('view-customer', $customers)) {
            abort(403);
        }
        return view('admin.admin.customers.customers', compact('customers'));
    }

    public function show($id)
    {
        $customer = Customer::where('id', $id)->where('is_delete', false)->firstorFail();
        if (Auth::guard('admin')->user()->cannot('view-customer', $customer)) {
            abort(403);
        }
        $orders = $customer->orders;
        $recharges = $customer->recharges;
        $history = array();
        foreach ($orders as $value) {
            array_push($history, [
                'created_at' => $value->created_at,
                'des' => "Số ID đơn hàng: #".$value->id,
                'link' => 'admin/orders/detail/'.$value->id,
                'total' => -$value->total
            ]);
        }
        foreach ($recharges as $key => $value) {
            array_push($history, [
                'created_at' => $value->created_at,
                'des' => "Nạp tiền với số tiền là: ".number_format($value->total)." "."đ",
                'link' => "admin/recharges/detail/".$value->id,
                'total' => $value->total
            ]);
        }
        $data = array(
            'customer' => $customer,
            'history' => $history
        );
        return view('admin.admin.customers.detail')->with($data);
    }

    public function create(CustomerRequest $request)
    {
        if (Auth::guard('admin')->user()->cannot('create-customer')) {
            abort(403);
        }
        if (Customer::where('email', $request->email)->where('is_delete', false)->count() > 0) {
            return redirect('admin/customers')->with('error', 'Email đã tồn tại! ');
        }
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->password = Hash::make($request->password);
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();
        return redirect('admin/customers')->with('success', 'Tạo mới khách hàng thành công. ID: ' . $customer->id);
    }

    public function update(CustomerRequest $request)
    {
        $customer = Customer::where('id', $request->id)->where('is_delete', false)->firstorFail();
        if (Auth::guard('admin')->user()->cannot('update-customer', $customer)) {
            abort(403);
        }
        if (Customer::where('email', $request->email)->where('is_delete', false)->count() > 0) {
            $checkemail = Customer::where('email', $request->email)->where('is_delete', false)->first();
            if ($checkemail->id != $request->id) {
                return redirect('admin/customers/detail/'.$request->id)->with('error', 'Email đã tồn tại! ');
            }
        }
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->updated_at = Carbon::now();
        if ($request->password) {
            $customer->password = Hash::make($request->password);
        }
        $customer->save();
        return redirect('admin/customers/detail/'.$request->id)->with('success', 'Cập nhật khách hàng thành công. ID: ' . $request->id);
    }

    public function destroy(Request $request)
    {
        $customer = Customer::firstorFail($request->id);
        if (Auth::guard('admin')->user()->cannot('delete-customer', $customer)) {
            abort(403);
        }
        $customer->is_delete = true;
        $customer->deleted_at = Carbon::now();
        $customer->save();
        return redirect('admin/customers')->with('success', 'Xóa khách hàng thành công. ID: ' . $customer->id);
    }

    public function remove(Request $request)
    {
        $customers = Customer::where('is_delete', true)->get();
        if (Auth::guard('admin')->user()->cannot('view-customer', $customers)) {
            abort(403);
        }
        return view('admin.admin.customers.remove', compact('customers'));
    }

    public function undo(Request $request)
    {
        $customer = Customer::firstorFail($request->id);
        if (Auth::guard('admin')->user()->cannot('delete-customer', $customer)) {
            abort(403);
        }
        $customer->is_delete = false;
        $customer->save();
        return redirect('admin/customers/remove')->with('success', 'Hoàn tác thông tin khách hàng thành công. ID: ' . $customer->id);
    }


}
