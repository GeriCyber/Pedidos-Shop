<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use File;

class CategoryController extends Controller
{
	public function index() {
        $categories = Category::orderBy('id')->paginate(10);
        return view('admin.categories.index')->with(compact('categories'));
    }

    public function create() {
        return view('admin.categories.create');
    }

    public function store(Request $request) {

        $this->validate($request, Category::$rules, Category::$messages);

        $category = Category::create($request->only('name', 'description')); // mass assignment
        if ($request->hasFile('image')) {
           // Guardar la img
            $file = $request->file('image');
            $path = public_path().'/images/categories';
            $fileName = uniqid().$file->getClientOriginalName();
            $moved = $file->move($path, $fileName);
            if ($moved) {
                // Crear registro en la tabla ctegories
                $category->image = $fileName;
                $category->save(); //INSERT
            }
        }
        return redirect('/admin/categories');
    }

    public function edit(Category $category) {
        /*$category = Category::find($id);*/
        return view('admin.categories.edit')->with(compact('category'));
    }

    public function update(Request $request, Category $category) {

        $this->validate($request, Category::$rules, Category::$messages);

        $category->update($request->only('name', 'description')); // mass assignment
        if ($request->hasFile('image')) {
           // Guardar la img
            $file = $request->file('image');
            $path = public_path().'/images/categories';
            $fileName = uniqid().$file->getClientOriginalName();
            $moved = $file->move($path, $fileName);
            
            if ($moved) {
                $previousPath = $path.'/'.$category->image;
                // Actualizar registro en la tabla ctegories
                $category->image = $fileName;
                $saved = $category->save(); //Update

                if ($saved) {
                    File::delete($previousPath);
                }
            }
        }

        return redirect('/admin/categories');
    }

    public function destroy(Category $category) {
        /*$product = Product::find($id);*/
        $category->delete(); //DELETE FROM DB

        // return redirect('/admin/products');
        return back();
    }
}
