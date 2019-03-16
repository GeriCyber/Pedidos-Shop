<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductController extends Controller
{
    public function index() {
        $products = Product::paginate(10);
        return view('admin.products.index')->with(compact('products'));
    }

    public function create() {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create')->with(compact('categories'));
    }

    public function store(Request $request) {
        // $request->all();
        // dd($request);

        // Validar
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0',
        ];
        $messages = [
            'name.required' => 'Es necesario ingresar un nombre para el producto',
            'name.min' => 'El nombre del producto debe tener al menos 3 caracteres',
            'description.required' => 'Es necesario ingresar una descripcion para el producto',
            'description.max' => 'La descripcion del producto debe tener maximo 200 caracteres',
            'price.required' => 'Es necesario ingresar el precio del producto',
            'price.numeric' => 'Ingresa un precio valido',
            'price.min' => 'No se admiten valores negativos'
        ];
        $this->validate($request, $rules, $messages);

        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->category_id = $request->category_id;
        $product->save(); //INSERT INTO DB

        return redirect('/admin/products');
    }

    public function edit($id) {
        $product = Product::find($id);
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit')->with(compact('product', 'categories'));
    }

    public function update(Request $request, $id) {

        // Validar
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0',
        ];
        $messages = [
            'name.required' => 'Es necesario ingresar un nombre para el producto',
            'name.min' => 'El nombre del producto debe tener al menos 3 caracteres',
            'description.required' => 'Es necesario ingresar una descripcion para el producto',
            'description.max' => 'El nombre del producto debe tener maximo 200 caracteres',
            'price.required' => 'Es necesario ingresar el precio del producto',
            'price.numeric' => 'Ingresa un precio valido',
            'price.min' => 'No se admiten valores negativos'
        ];
        $this->validate($request, $rules, $messages);
        
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->category_id = $request->category_id;
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
