<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\ImportProduct;
use App\Product;
use App\ProductKey;
use App\Publisher;
use Illuminate\Http\Request;

class ImportProductController extends Controller
{
    public function store(Request $request)
    {
        $data = array(
            'products' => Product::where('is_delete', false)->get(),
            'publishers' => Publisher::where('is_delete', false)->get(),
            'importproducts' => ImportProduct::where('is_delete', false)->get()
        );
        return view('admin.admin.importproducts.importproducts')->with($data);
    }

    public function add(Request $request)
    {
        $data = array(
            'products' => Product::where('is_delete', false)->get(),
            'publishers' => Publisher::where('is_delete', false)->get(),
            'importproducts' => ImportProduct::where('is_delete', false)->get()
        );
        return view('admin.admin.importproducts.add')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $importproduct = new ImportProduct();
        $importproduct->publisher_id = $request->publisher_id;
        $importproduct->product_id = $request->product_id;
        $importproduct->import_price = $request->import_price;
        $importproduct->save();

        foreach ($request->keys as $value) {
            $productKey = new ProductKey();
            $productKey->importproduct_id = $importproduct->id;
            $productKey->key = $value;
            $productKey->save();
        }
        return response()->json($importproduct);
    }

    public function show($id)
    {
        $importproduct = ImportProduct::find($id);
        return view('admin.admin.importproducts.detail')->with('importproduct', $importproduct);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // $product = Product::find($request->id);
        // if ($request->picture) {
        //     $file = $request->picture;
        //     $fileupload = $file->move('upload', $file->getClientOriginalName());
        //     $product->picture = $fileupload;
        // }
        // $product->name = $request->name;
        // $product->category_id = $request->category_id;
        // $product->publisher_id = $request->publisher_id;
        // $product->import_price = $request->import_price;
        // $product->info = $request->info;
        // $product->updated_at = Carbon::now();
        // $product->save();
        // return redirect('admin/products')->with('success', 'Cập nhật sản phẩm thành công. ID: ' . $request->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // $product = Product::find($request->iddelete);
        // $product->is_delete = true;
        // $product->save();
        // $product->deleted_at = Carbon::now();
        // return redirect('admin/products')->with('success', 'Xóa sản phẩm thành công. ID: ' . $product->id);
    }
}
