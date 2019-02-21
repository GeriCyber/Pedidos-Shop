<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index() {
        $products = Product::paginate(10);
        return view('admin.products.index')->with(compact('products'));
    }

    public function create() {
        return view('admin.products.create');
    }

    public function store(Request $request) {
        // $request->all();
        // dd($request);
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->category_id = 3;
        $product->save(); //INSERT INTO DB

        return redirect('/admin/products');
    }

    public function edit($id) {
        $product = Product::find($id);
        return view('admin.products.edit')->with(compact('product'));
    }

    public function update(Request $request, $id) {
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->category_id = 3;
        $product->save(); //UPDATE INTO DB

        return redirect('/admin/products');
    }

    public function destroy($id) {
        $product = Product::find($id);
        $product->delete(); //DELETE FROM DB

        // return redirect('/admin/products');
        return back();
    }
}
