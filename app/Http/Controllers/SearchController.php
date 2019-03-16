<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class SearchController extends Controller
{
    public function show(Request $request) {
    	$search = $request->input('search');
    	$products = Product::where('name', 'like', "%$search%")->paginate(5);

    	return view('search.show')->with(compact('products', 'search'));
    }
}
