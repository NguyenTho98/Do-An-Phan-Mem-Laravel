<?php

namespace App\Http\Controllers\user;

use App\Coupon;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\ProductKey;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\Bill;
class CartController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::guard('user')->user();
        return view('user.admin.cart')->with(['cart' => Cart::instance($user)->content()]);
    }

    public function checkout(Request $request)
    {
        $user = Auth::guard('user')->user();
        return view('user.admin.checkout')->with(['cart' => Cart::instance($user)->content()]);
    }

    public function add(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product->is_delete == true || $product->price == false) {
            abort(403);
        }
        if ($product->qty < $request->qty) {
            return response()->json(['error'=> "Số lượng sản phẩm tối đa có thể mua: ".$product->qty]);
        }
        if (Auth::guard('user')->check()) {
            $user = Auth::guard('user')->user();
            Cart::instance($user)->add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $request->qty,
                'price' => $product->price,
                'weight' => 0,
                'options' => ['picture' => $product->picture, 'sale' => $product->sale, 'slug' => $product->slug]]);
            return response()->json(['success'=> "Thêm ".$product->name." vào giỏ hàng thành công!"]);
        }
        return response()->json(['error'=> "Bạn phải đăng nhập trước!"]);

    }

    public function update(Request $request, $id)
    {
        $user = Auth::guard('user')->user();
        $cart = Cart::instance($user)->content();
        $product = Product::find($id);
        if ($request->qty > $product->qty) {
            return response()->json(['error'=> "Số lượng sản phẩm tối đa có thể mua: ".$product->qty]);
        }
        $rowID = "";
        foreach ($cart as $key => $value) {
            if ($value->id == $id) {
                $rowID = $value->rowId;
            }
        }
        Cart::instance($user)->update($rowID, $request->qty);
        return response()->json(['success'=> "Cập nhật số lượng thành công!"]);
    }

    public function checkCoupon(Request $request)
    {
        $user = Auth::guard('user')->user();
        $coupon = Coupon::where('name', $request->coupon)->first();

        if ($coupon == null) {
            return redirect()->back()->with('error', "Mã giảm giá không chính xác!");
        }

        if ($coupon->qty == 0) {
            return redirect()->back()->with('error', "Mã giảm giá đã hết!");
        }

        $now = Carbon::now();
        if (strtotime($now) < strtotime($coupon->start) || strtotime($now) > strtotime($coupon->end)) {
            return redirect()->back()->with('error', "Mã giảm giá đã hết hạn!");
        }

        if (Cart::instance('coupon'.$user->id)->count() > 0) {
            Cart::instance('coupon'.$user->id)->destroy();
        }
        Cart::instance('coupon'.$user->id)->add([
            'id' => $coupon->id,
            'name' => $coupon->name,
            'qty' => 1,
            'price' => 0,
            'weight' => 0,
            'options' => ['value' => $coupon->value, 'coupon_price' => $coupon->coupon_price]]);
        return redirect()->back()->with('success', "Sử dụng mã giảm giá thành công!");
    }

    public function delete(Request $request, $id)
    {
        $user = Auth::guard('user')->user();
        $cart = Cart::instance($user)->content();
        $rowID = "";
        foreach ($cart as $key => $value) {
            if ($value->id == $id) {
                $rowID = $value->rowId;
            }
        }
        Cart::instance($user)->remove($rowID);
        return redirect()->back()->with('success', "Xóa sản phẩm khỏi giỏ hàng thành công!");
    }

    public function pay(Request $request)
    {
        $user = Auth::guard('user')->user();

        if (Cart::instance('coupon'.$user->id)->count() > 0) {
            foreach (Cart::instance('coupon'.$user->id)->content() as $item) {
                $id = $item->id;
                $value = $item->options->value;
                $coupon_price = $item->options->coupon_price;
            }
        }
        // kiểm tra số lượng mã giảm giá
        if (isset($id)) {
            $check = Coupon::find($id);
            if ($check->qty == 0) {
                Cart::instance('coupon'.$user->id)->destroy();
                return redirect('gio-hang')->with('error', "Mã giảm giá đã sử dụng hết!Vui lòng chọn mã giảm giá khác!");
            }
        }
        $cart = Cart::instance($user)->content();
        // thông tin đơn hàng
        $total = total_cart($cart);
        if (isset($id) && isset($value) && isset($coupon_price)) {
            if ($total >= $coupon_price) {
                if ($value >= 1000) {
                    $total = total_cart($cart)-$value;
                }
                if ($value <= 100) {
                    $total = total_cart($cart)-$value*total_cart($cart)/100;
                }
            }
        }
        //check cart
        foreach ($cart as  $value) {
            $product = Product::find($value->id);
            if ($product->is_delete == true || $product->price == false) {
                Cart::instance($user)->destroy();
                Cart::instance('coupon'.$user->id)->destroy();
                return redirect('gio-hang')->with('error', 'Sản phẩm'.$product->name.' không tồn tại nữa!. Mời bạn chọn lại sản phẩm');
            }
        }
        // lưu thông tin order
        $order = new Order;
        $order->customer_id = $user->id;
        if (isset($id)) {
            $order->coupon_id = $id;
        }
        $order->total = 0;
        $order->save();
        // lưu thông tin orderdetail
        foreach ($cart as $item) {
            $keys = DB::table('productkeys AS a')
                    ->select('a.id', 'a.key')
                    ->join('importproducts AS b', 'a.importproduct_id', '=', 'b.id')
                    ->join('products AS c', 'b.product_id', '=', 'c.id')
                    ->where('c.id', $item->id)
                    ->where('active', false)
                    ->where('b.is_delete', false)
                    ->where('c.is_delete', false)
                    ->take($item->qty)
                    ->get();
            $price1 = $item->price * ( 100 - $item->options->sale) / 100;
            foreach ($keys as $key => $value) {
                OrderDetail::insert([
                    'order_id' => $order->id,
                    'productkey_id' => $value->id,
                    'price' => $price1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }

        }
        // update lại tổng tiền sau khi thêm coupon
        $updateOrder = Order::find($order->id);
        $updateOrder->total = $total;
        $updateOrder->save();

        // xóa session
        Cart::instance($user)->destroy();
        Cart::instance('coupon'.$user->id)->destroy();

        // update lại số tiền sau khi mua hàng!
        $customer = Customer::find($user->id);
        $customer->money = $customer->money - $total;
        $customer->save();

        // // gửi mail
        // $data = Order::find($order->id);
        // $data1=$data->orderdetails;

        // Mail::to($user->email)->send(new Bill($data1));

        return redirect('lich-su-don-hang')->with('success', 'Mua hàng thành công! Mời bạn lấy key trong phần lịch sử giao dịch!');
    }
}
