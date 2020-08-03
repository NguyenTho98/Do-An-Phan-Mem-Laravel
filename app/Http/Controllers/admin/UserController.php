<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\ImportProduct;
use App\Order;
use App\OrderDetail;
use App\Product;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $users = User::where('is_delete', false)->get();
        if (Auth::guard('admin')->user()->cannot('view-user', $users)) {
            abort(403);
        }
        // $this->authorizeForUser(Auth::guard('admin')->user(), 'view', $users);
        // $this->authorize('viewAny', $users);

        return view('admin.admin.users.users', compact('users'));
    }

    public function remove(Request $request)
    {
        $users = User::where('is_delete', true)->get();
        if (Auth::guard('admin')->user()->cannot('view-user', $users)) {
            abort(403);
        }
        // $this->authorizeForUser(Auth::guard('admin')->user(), 'view', $users);
        // $this->authorize('view', $users);

        return view('admin.admin.users.remove', compact('users'));
    }

    public function viewadd(Request $request)
    {
        if (Auth::guard('admin')->user()->cannot('create-user')) {
            abort(403);
        }
        return view('admin.admin.users.add');
    }


    public function undo(Request $request)
    {
        $user = User::find($request->id);
        if (Auth::guard('admin')->user()->cannot('delete-user', $user)) {
            abort(403);
        }
        $user->is_delete = false;
        $user->save();
        return redirect('admin/users/remove')->with('success', 'Hoàn tác xóa nhân viên thành công. ID: ' . $user->id);
    }

    public function create(UserRequest $request)
    {
        if (User::where('email', $request->email)->where('is_delete', false)->count() > 0) {
            return redirect('admin/users')->with('error', 'Email đã tồn tại! ');
        }
        if (Auth::guard('admin')->user()->cannot('create-user')) {
            abort(403);
        }
        $user = new User;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->email_verified_at = Carbon::now();
        $user->save();
        return redirect('admin/users')->with('success', 'Tạo mới nhân viên thành công. ID: ' . $user->id);
    }

    public function register(UserRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->save();
        return redirect('admin/login')->with('success','Đăng kí tài khoản thành công. Vui lòng vào mail để kích hoạt tài khoản!!');
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        if (Auth::guard('admin')->user()->cannot('update-user', $user)) {
            abort(403);
        }
        if (User::where('email', $request->email)->where('is_delete', false)->count() > 0) {
            $checkemail = User::where('email', $request->email)->where('is_delete', false)->get();
            if ($checkemail[0]->id != $request->id) {
                return redirect('admin/users')->with('error', 'Email đã tồn tại! ');
            }
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->updated_at = Carbon::now();
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect('admin/users')->with('success', 'Cập nhật thông tin nhân viên thành công. ID: ' . $user->id);
    }

    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        if (Auth::guard('admin')->user()->cannot('delete-user', $user)) {
            abort(403);
        }
        $user->is_delete = true;
        $user->deleted_at = Carbon::now();
        $user->save();
        return redirect('admin/users')->with('success', 'Xóa nhân viên thành công. ID: ' . $user->id);
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::guard('admin')->attempt(['email'=>$email, 'password'=>$password])) {
            return redirect('/admin')->with('success', 'Đăng nhập thành công');
        } else {
            return Redirect::back()->with('error', 'Email or password is wrong');
        }
    }

    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            return redirect('admin/login')->with('success', 'Đăng xuất thành công!');
        }
    }

    public function recoverPassword(Request $request)
    {
        return Redirect::back()->with('success', "We've emailed you instructions to reset your password");;
    }

    public function checkEmailRegister(Request $request)
    {
        if (User::where('email', $request->email)->where('is_delete', false)->count() > 0) {
            return "false";
        }
        return "true";
    }
    public function checkEmailRecover(Request $request)
    {
        if (User::where('email', $request->email)->where('is_delete', false)->count() > 0) {
            return "true";
        }
        return "false";
    }

    public function home(Request $request)
    {
        $from = date("Y-m-01");
        $date = Carbon::now();
        // số sản phẩm trong tháng
        $totalQtyOrder = OrderDetail::whereBetween('created_at', [$from, $date])->count();
        // số tiền bán sản phẩm trong tháng
        $totalOrder = Order::whereBetween('created_at', [$from, $date])->sum('total');
        // số tiền nhập sản phẩm trong tháng
        $import = ImportProduct::whereBetween('created_at', [$from, $date])->get();
        $totalImport = 0;
        foreach ($import as $key => $value) {
            $totalImport += $value->qty * $value->import_price;
        }
        // Số sản phẩm đang bán trên cửa hàng
        $dangban = Product::where('is_delete', false)->where('price', '>', 0)->count();
        // Tổng số sản phẩm hiện có
        $totalProduct = Product::where('is_delete', false)->count();
        $totalKey = Product::where('is_delete', false)->sum('qty');
        $data = array(
            'totalQtyOrder' => $totalQtyOrder,
            'totalOrder' => $totalOrder,
            'totalImport' => $totalImport,
            'dangban' => $dangban,
            'totalProduct' => $totalProduct,
            'totalKey' => $totalKey,
        );
        return view('admin.admin.home')->with($data);
    }
}
