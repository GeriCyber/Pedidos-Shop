<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

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

        Category::create($request->all()); // mass assignment

        return redirect('/admin/categories');
    }

    public function edit(Category $category) {
        /*$category = Category::find($id);*/
        return view('admin.categories.edit')->with(compact('category'));
    }

    public function update(Request $request, Category $category) {

        $this->validate($request, Category::$rules, Category::$messages);

        $category->update($request->all()); // mass assignment

        return redirect('/admin/categories');
    }

    public function destroy(Category $category) {
        /*$product = Product::find($id);*/
        $category->delete(); //DELETE FROM DB

        // return redirect('/admin/products');
        return back();
    }
}
