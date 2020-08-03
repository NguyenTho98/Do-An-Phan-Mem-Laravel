<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Category;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\CreateProductRequest;
use App\Product;
use App\Publisher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
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
        $products = Product::where('is_delete', false)->get();
        if (Auth::guard('admin')->user()->cannot('view-product', $products)) {
            abort(403);
        }
        $data = array(
            'products' => $products,
            'publishers' => Publisher::where('is_delete', false)->get()
        );
        return view('admin.admin.products.products')->with($data);
    }

    public function add(Request $request)
    {
        if (Auth::guard('admin')->user()->cannot('create-product')) {
            abort(403);
        }
        $data = array(
            'publishers' => Publisher::where('is_delete', false)->get()
        );
        return view('admin.admin.products.add')->with($data);
    }

    public function sold(Request $request)
    {
        $data = array(
            'products' => Product::where('is_delete', false)->get(),
            'publishers' => Publisher::where('is_delete', false)->get()
        );
        return view('admin.admin.soldproducts.sold')->with($data);
    }

    public function nosold(Request $request)
    {
        $data = array(
            'products' => Product::where('is_delete', false)->get(),
            'publishers' => Publisher::where('is_delete', false)->get()
        );
        return view('admin.admin.soldproducts.nosold')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function create(CreateProductRequest $request)
    {
        if (Auth::guard('admin')->user()->cannot('create-product')) {
            abort(403);
        }
        $file = $request->picture;
        $fileupload = $file->move('upload', $file->getClientOriginalName());

        //save product
        $product = new Product;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name, '-');
        $product->category_id = $request->category_id;
        $product->picture = $fileupload;
        $product->info = $request->info;
        $product->save();

        return redirect('admin/products')->with('success', 'Tạo mới sản phẩm thành công. ID: ' . $product->id);
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->where('is_delete', false)->firstorFail();
        if (Auth::guard('admin')->user()->cannot('view-product', $product)) {
            abort(403);
        }
        return view('admin.admin.products.detail')->with('product', $product);
    }

    public function detail($id)
    {
        $product = Product::where('id', $id)->where('is_delete', false)->firstorFail();
        $data = array(
            'product' => $product,
            'importproducts' => $product->importproducts
        );
        $a=  $product->category->name;
        $b = $product->importproducts[0]->publisher->name;
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request)
    {
        $product = Product::findOrFail($request->id);
        if (Auth::guard('admin')->user()->cannot('update-product', $product)) {
            abort(403);
        }
        if ($request->picture) {
            $file = $request->picture;
            $fileupload = $file->move('upload', $file->getClientOriginalName());
            $product->picture = $fileupload;
        }
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->info = $request->info;
        $product->updated_at = Carbon::now();
        $product->save();
        return redirect('admin/products')->with('success', 'Cập nhật sản phẩm thành công. ID: ' . $request->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Product::findOrFail($request->iddelete);
        if (Auth::guard('admin')->user()->cannot('delete-product', $product)) {
            abort(403);
        }
        $product->is_delete = true;
        $product->deleted_at = Carbon::now();
        $product->save();
        return redirect('admin/products')->with('success', 'Xóa sản phẩm thành công. ID: ' . $product->id);
    }

    public function updatePrice(Request $request)
    {
        $product = Product::find($request->id);
        if (Auth::guard('admin')->user()->cannot('update-product', $product)) {
            abort(403);
        }
        $product->price = $request->price;
        $product->sale = $request->sale;
        $product->save();
        if (!$request->price) {
            return redirect('admin/san-pham-khong-ban')->with('success', 'Sản phẩm đã đưa về kho và không còn bày bán trên cửa hàng nữa. ID: ' . $product->id);
        } else {
            return redirect('admin/san-pham-dang-ban')->with('success', 'Sản phẩm đã được bày bán trên cửa hàng. ID: ' . $product->id);
        }
    }

    public function remove(Request $request)
    {
        $data = array(
            'products' => Product::where('is_delete', true)->get(),
            'publishers' => Publisher::where('is_delete', false)->get(),
            'categories' => Category::where('is_delete', false)->get()
        );
        return view('admin.admin.products.remove')->with($data);
    }

    public function undo(Request $request)
    {
        $product = Product::find($request->iddelete);
        if (Auth::guard('admin')->user()->cannot('delete-product', $product)) {
            abort(403);
        }
        $product->is_delete = false;
        $product->save();
        return redirect('admin/products/remove')->with('success', 'Hoàn tác sản phẩm thành công. ID: ' . $product->id);
    }
}
