<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function create(Request $request)
    {
        if (Auth::guard('admin')->user()->cannot('create-category')) {
            abort(403);
        }
        $category = new Category;
        $category->name = $request->name;
        $category->save();
        return redirect('admin/categories')->with('success', 'Thêm mới thể loại thành công! ID: '.$category->id);
    }
    public function show($id)
    {
        $category = Category::where('is_delete', false)->where('id', $id)->firstorFail();
        if (Auth::guard('admin')->user()->cannot('view-category', $category)) {
            abort(403);
        }

        return view('admin.admin.categories.detail', ['category' => $category]);
    }

    public function update(Request $request)
    {
        $category = Category::where('id', $request->id)->where('is_delete', false)->firstorFail();
        if (Auth::guard('admin')->user()->cannot('update-category', $category)) {
            abort(403);
        }
        $category->name = $request->name;
        $category->save();
        return redirect('admin/categories/detail/'.$request->id)->with('success', 'Cập nhật thể loại thành công');
    }

    public function destroy(Request $request)
    {
        $category = Category::where('id', $request->id)->where('is_delete', false)->firstorFail();
        if (Auth::guard('admin')->user()->cannot('delete-category', $category)) {
            abort(403);
        }
        $category->is_delete = true;
        $category->deleted_at = Carbon::now();
        $category->save();
        return redirect('admin/categories')->with('success', 'Thể loại đã bị xóa! ID: '.$category->id);
    }
}
