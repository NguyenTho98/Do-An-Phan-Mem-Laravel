<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Comment;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $products = Product::where('is_delete', false)->get();
        if (Auth::guard('admin')->user()->cannot('view-product', $products)) {
            abort(403);
        }
        $data = array(
            'products' => $products
        );
        return view('admin.admin.comments.comments')->with($data);
    }


    public function show($id)
    {
        $update = Comment::where('product_id', $id)->where('is_delete', false)->get();
        if (Auth::guard('admin')->user()->cannot('view-comment', $update)) {
            abort(403);
        }
        foreach ($update as $value) {
            $value->status = 0;
            $value->save();
        }
        $comments = Comment::where('product_id', $id)->where('is_delete', false)->orderBy('created_at', 'DESC')->paginate(5);
        return view('admin.admin.comments.detailcommentproduct', ['comments' => $comments]);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        if (Auth::guard('admin')->user()->cannot('delete-comment', $comment)) {
            abort(403);
        }
        $comment->is_delete = true;
        $comment->save();
        return redirect('admin/comments/'.$comment->product_id)->with('success', 'Bình luận đã bị xóa!');
    }
}
