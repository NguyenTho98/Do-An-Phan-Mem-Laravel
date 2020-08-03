<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Feedback;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $from = date("Y-m-01");
        $date = Carbon::now();
        $feedbacks = Feedback::where('is_delete', false)->whereBetween('created_at', [$from, $date])->orderBy('created_at', 'desc')->get();
        if (Auth::guard('admin')->user()->cannot('view-feedback', $feedbacks)) {
            abort(403);
        }
        $data = array(
            'feedbacks' => $feedbacks
        );
        return view('admin.admin.feedbacks')->with($data);
    }

    public function show($id)
    {
        $feedback = Feedback::where('id', $id)->where('is_delete', false)->firstorFail();
        if (Auth::guard('admin')->user()->cannot('view-feedback', $feedback)) {
            abort(403);
        }
        $feedback->status = 0;
        $feedback->save();
        return response()->json($feedback);
    }
}
