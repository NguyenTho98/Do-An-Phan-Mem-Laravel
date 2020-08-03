<?php

namespace App\Http\Controllers\user;

use App\Category;
use App\Comment;
use App\Coupon;
use App\Http\Controllers\Controller;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public $perpage = 8;
    public function home(Request $request)
    {
        $product1 = Product::where('is_delete', false)->where('price', '>', '0')->get();
        $product2 = Product::where('is_delete', false)->where('price', '>', '0')->where('sale', '>', '0')->get();
        $data = array(
            'product1' => $product1,
            'product2' => $product2
        );
        return view('user.home')->with($data);
    }

    public function show(Request $request, $slug, $id)
    {
        $product = Product::where('is_delete', false)->where('id', $id)->firstorFail();
        $comments = Comment::where('is_delete', false)->where('product_id', $id)->orderBy('created_at', 'DESC')->paginate(5);
        $data = array(
            'product' => $product,
            'comments' => $comments
        );
        return view('user.detail')->with($data);
    }

    public function search(Request $request)
    {
        $search = $request->input('search', "");
        $min_price = $request->input('min_price', 1);
        $max_price = $request->input('max_price', 10000000);
        $sort = $request->input('sort', "name-asc");
        if ($sort == "") {
            $sort = "name-asc";
        }
        $sorttype = explode("-", $sort);
        $category = $request->input('category', "");
        if ($category == "") {
            $products = Product::where('name', 'LIKE', '%'.$search.'%')
                                ->where('is_delete', false)
                                ->whereBetween('price', [$min_price, $max_price])
                                ->orderBy($sorttype[0], $sorttype[1])
                                ->paginate($this->perpage);
        } else {
            $products = Product::where('name', 'LIKE', '%'.$search.'%')
                                ->where('is_delete', false)
                                ->whereBetween('price', [$min_price, $max_price])
                                ->where('category_id', $category)
                                ->orderBy($sorttype[0], $sorttype[1])
                                ->paginate($this->perpage);
        }
        return view('user.search')->with('products', $products);
    }

    public function bestsellers(Request $request)
    {
        $now = date("Y-m-d H:i:s");
        $leftoneday = date('Y-m-d H:i:s',strtotime('-1 day -5 hour', strtotime($now)));
        $products = DB::table('products AS a')
                    ->select('a.id', 'a.qty', 'a.name', 'a.slug', 'a.price', 'a.sale', 'a.picture', DB::raw('count(*) as total'))
                    ->join('importproducts AS b', 'a.id', '=', 'b.product_id')
                    ->join('productkeys AS c', 'b.id', '=', 'c.importproduct_id')
                    ->join('orderdetails AS d', 'c.id', '=', 'd.productkey_id')
                    ->where('a.is_delete', false)
                    ->where('a.price', '>', 0)
                    ->where('d.created_at', '>', $leftoneday)
                    ->where('a.created_at', '<', $now)
                    ->groupBy('a.id', 'a.qty', 'a.name', 'a.slug', 'a.price', 'a.sale', 'a.picture')
                    ->orderBy('total', 'desc')
                    ->paginate($this->perpage);
        return view('user.search')->with('products', $products);
    }

    public function sale(Request $request)
    {
        $products = Product::where('is_delete', false)->where('price', '>', 0)->where('sale', '>', 0)->paginate($this->perpage);;
        return view('user.search')->with('products', $products);
    }

}
