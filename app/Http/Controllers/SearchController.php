<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class SearchController extends Controller
{
    public function show(Request $request) {
    	$search = $request->input('search');
    	$products = Product::where('name', 'like', "%$search%")->paginate(5);

    	if ($products->count() == 1) {
    		$id = $products->first()->id;
    		return redirect("products/$id");
    	}

    	return view('search.show')->with(compact('products', 'search'));
    }

    public function data() {
    	$products = Product::pluck('name');
    	return $products;
    }
}
