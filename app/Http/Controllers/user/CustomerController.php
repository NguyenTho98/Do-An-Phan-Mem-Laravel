<?php

namespace App\Http\Controllers\user;

use App\Comment;
use App\Customer;
use App\Feedback;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequest;
use App\Order;
use App\Recharge;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    public $perpage = 1;
    private $vnp_TmnCode = "XVYEGPXG"; //Mã website tại VNPAY
    private $vnp_HashSecret = "JAFIPLSDMSMJQJMVDBGBGYEJOMAXMROF"; //Chuỗi bí mật
    private $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    private $vnp_Returnurl = "http://doantonghop.com:8080/nap-tien";
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:6|max:255',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        $user = new Customer();

        $user->name = $request->name;
        $user->phone = 0357004230;
        $user->address = 'Bắc Ninh';
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->save();
        return redirect('login')->with('success','Register successful');
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::guard('user')->attempt(['email'=>$email, 'password'=>$password])) {
            return redirect('/')->with('success', 'Login successful');
        } else {
            return Redirect::back()->withErrors(['', 'Email or password is wrong']);
        }
    }

    public function recoverPassword(Request $request)
    {
        return Redirect::back()->with('success', "We've emailed you instructions to reset your password");
        // $account=DB::table('users')->where('email',$request->email)->first();
        // $token=Hash::make($account->email.$account->id);
        // if($account){
        //     DB::table('password_resets')->insert([
        //         'email'=>$account->email,
        //         'token'=> $token ,
        //         'created_at'=>Carbon::now(),
        //     ]);

        //     $link = route('get.new_password',['email'=>$account->email,'_token'=> $token]);
        //     Mail::to($account->email)->send(new ResetPassword($link));

        //     return redirect()->to('/');
        // }else{

        // }
        // return redirect()->back();
    }
    // public function newPassword(Request $request){
    //     $token=$request->_token;
    //     $checkToken=DB::table('password_resets')
    //     ->where('token',$token)
    //     ->first();

    //     $now = Carbon::now();
    //     if($now->diffInMinutes($checkToken->created_at)>3){
    //         DB::table('password_resets')->where('email',$request->email)->delete();
    //         return redirect()->to('/');
    //     }
    //     if(!$checkToken) return redirect()->to('/');
    //     return view('auth.passwords.confirm');
    // }


    public function checkEmailRegister(Request $request)
    {
        if (Customer::where('email', $request->email)->count() > 0) {
            return "false";
        }
        return "true";
    }

    public function checkUsernameRegister(Request $request)
    {
        if (Customer::where('username', $request->username)->where('is_delete', false)->count() > 0) {
            return "false";
        }
        return "true";
    }

    public function checkEmailRecover(Request $request)
    {
        if (Customer::where('email', $request->email)->where('is_delete', false)->count() > 0) {
            return "true";
        }
        return "false";
    }

    public function logout(Request $request)
    {
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
            return redirect('login')->with('success', 'Đăng xuất thành công!');
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::guard('user')->id() != $id) {
            abort(403);
        }
        $user = Customer::find($id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->updated_at = Carbon::now();
        $user->save();
        return response()->json(['success'=> "Cập nhật thông tin thành công!"]);
    }

    public function detailorder(Request $request, $id)
    {
        $order = Order::find($id);
        return view('user.admin.profile.detailorder')->with('detail', $order->orderdetails);
    }

    public function transaction(Request $request)
    {
        $user = Auth::guard('user')->user();
        $orders = $user->orders;
        $recharges = $user->recharges;
        $history = array();
        foreach ($orders as $value) {
            array_push($history, [
                'created_at' => $value->created_at,
                'des' => "Số ID đơn hàng: #".$value->id,
                'total' => -$value->total
            ]);
        }
        foreach ($recharges as $key => $value) {
            array_push($history, [
                'created_at' => $value->created_at,
                'des' => "Nạp tiền với số tiền là: ".number_format($value->total)." "."đ",
                'total' => $value->total
            ]);
        }
        return view('user.admin.profile.transaction')->with('history', $history);
    }

    public function changepassword(Request $request)
    {
        $user = Auth::guard('user')->user();
        if(Hash::check($request->old_password,$user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect('thong-tin-tai-khoan')->with('success', 'Thay đổi mật khẩu thành công!');
        }
        return redirect()->back()->with('error', 'Mật khẩu cũ không chính xác!');
    }


    public function feedback(FeedbackRequest $request)
    {
        $feedback = new Feedback;
        $feedback->email = $request->email;
        $feedback->title = $request->title;
        $feedback->content = $request->content;
        $feedback->save();
        return redirect('/phan-hoi')->with('success', 'Cảm ơn bạn đã đóng góp ý kiến cho trang web. Chúng tôi sẽ tham khảo và cố gắng khắc phục tình trạng của bạn!');
    }

    public function addcomment(Request $request)
    {
        $id = Auth::guard('user')->id();
        $comment = new Comment;
        $comment->product_id = $request->id;
        $comment->content = $request->comment;
        $comment->customer_id = $id;
        $comment->save();
        return redirect()->back();
    }

    public function createPayment(Request $request)
    {
        $vnp_TxnRef = date("YmdHis");
        $vnp_OrderInfo = $request->order_desc;
        $vnp_OrderType = $request->order_type;
        $vnp_Amount = $request->amount * 100;
        $vnp_Locale = $request->language;
        $vnp_BankCode = $request->bank_code;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $this->vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $this->vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $this->vnp_Url . "?" . $query;
        if (isset($this->vnp_HashSecret)) {
        // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', $this->vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
        return redirect()->to($returnData['data']);
    }

    public function savePayment(Request $request)
    {
        if ($request->vnp_ResponseCode == "00") {
            $vnp_Amount = $request->vnp_Amount / 100;
            $userID = Auth::guard('user')->id();

            $recharge = new Recharge;
            $recharge->total = $vnp_Amount;
            $recharge->customer_id = $userID;
            $recharge->save();

            return redirect('lich-su-giao-dich')->with('success','Nạp tiền vào tài khoản thành công! Vui lòng xem chi tiết tại lịch sử giao dịch!');
        }
        return redirect('nap-tien')->with('error','Giao dịch thất bại!');
    }
}
