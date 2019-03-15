<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use File;

class ImagesController extends Controller
{
    public function index($id) {
        $product = Product::find($id);
        $images = $product->images()->orderBy('featured', 'desc')->get();
        return view('admin.products.images.index')->with(compact('product', 'images'));
    }

    public function store(Request $request, $id) {
        // Guardar la img
        $file = $request->file('photo');
        $path = public_path().'/images/products';
        $fileName = uniqid().$file->getClientOriginalName();
        $moved = $file->move($path, $fileName);
        if ($moved) {
            // Crear registroen la tabla product_images
            $productImage = new ProductImage();
            $productImage->image = $fileName;
            $productImage->product_id = $id;
            $productImage->save(); //INSERT
        }
        
        return back();
    }

    public function destroy(Request $request, $id) {
        $productImage = ProductImage::find($request->image_id);
        // error_log('hola ->>>> '.$productImage);
        //Borrando archivo
        if (substr($productImage->image, 0, 4) === "http") {
            $deleted = true;
        } else {
            $fullPath = public_path().'/images/products/'.$productImage->image;
            $deleted = File::delete($fullPath);
        }
        //Borrando registro de la DB
        if ($deleted) {
            $productImage->delete();
        }
        return back();
    }

    public function select($id, $img) {

        //Desmarcando la img destacada anterior
        ProductImage::where('product_id', $id)->update([
            'featured' => false
        ]);
        $productImage = ProductImage::find($img);
        $productImage->featured = true;
        $productImage->save();

        return back();
    }
}
