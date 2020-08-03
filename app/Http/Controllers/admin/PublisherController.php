<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\PublisherRequest;
use App\Publisher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublisherController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $publishers = Publisher::where('is_delete', false)->get();
        if (Auth::guard('admin')->user()->cannot('view-publisher', $publishers)) {
            abort(403);
        }
        $data = array(
            'publishers' => $publishers,
        );
        return view('admin.admin.publishers.publishers')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function create(PublisherRequest $request)
    {
        if (Auth::guard('admin')->user()->cannot('create-publisher')) {
            abort(403);
        }
        $publisher = new Publisher;
        $publisher->name = $request->name;
        $publisher->address = $request->address;
        $publisher->email = $request->email;
        $publisher->phone = $request->phone;
        $publisher->save();
        return redirect('admin/publishers')->with('success', 'Thêm mới nhà phân phối thành công. ID: ' . $publisher->id);
    }

    public function show($id)
    {
        $publisher = Publisher::where('id', $id)->where('is_delete', false)->firstorFail();
        if (Auth::guard('admin')->user()->cannot('view-publisher', $publisher)) {
            abort(403);
        }
        return view('admin.admin.publishers.detail')->with('publisher', $publisher);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PublisherRequest $request)
    {
        $publisher = Publisher::findOrFail($request->id);
        if (Auth::guard('admin')->user()->cannot('update-publisher', $publisher)) {
            abort(403);
        }
        if (Publisher::where('email', $request->email)->where('is_delete', false)->get()->count() > 0) {
            $checkEmailUpdate = Publisher::where('email', $request->email)->where('is_delete', false)->first();
            if ($checkEmailUpdate->id != $request->id) {
                return redirect('admin/publishers')->with('error', 'Email này đã tồn tại vói thông tin của nhà phân phối khác!');
            }
        }
        $publisher->name = $request->name;
        $publisher->email = $request->email;
        $publisher->address = $request->address;
        $publisher->phone = $request->phone;
        $publisher->updated_at = Carbon::now();
        $publisher->save();
        return redirect('admin/publishers')->with('success', 'Cập nhật nhà phân phối thành công. ID: ' . $request->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $publisher = Publisher::find($request->id);
        if (Auth::guard('admin')->user()->cannot('delete-publisher', $publisher)) {
            abort(403);
        }
        $publisher->is_delete = true;
        $publisher->deleted_at = Carbon::now();
        $publisher->save();
        return redirect('admin/publishers')->with('success', 'Xóa nhà phân phối thành công. ID: ' . $publisher->id);
    }

    public function undo(Request $request)
    {
        $publisher = Publisher::find($request->id);
        if (Auth::guard('admin')->user()->cannot('delete-publisher', $publisher)) {
            abort(403);
        }
        $publisher->is_delete = false;
        $publisher->save();
        return redirect('admin/publishers/remove')->with('success', 'Hoàn tác xóa nhà phân phối thành công. ID: ' . $publisher->id);
    }

    public function remove(Request $request)
    {
        $data = array(
            'publishers' => Publisher::where('is_delete', true)->get(),
        );
        return view('admin.admin.publishers.remove')->with($data);
    }

    public function checkEmailCreate(Request $request)
    {
        if (Publisher::where('email', $request->email)->where('is_delete', false)->count() > 0) {
            return "false";
        }
        return "true";
    }
}
