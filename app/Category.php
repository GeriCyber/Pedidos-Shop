<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = ['name', 'description'];

	/// Validar
        public static $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:250',
        ];

        public static $messages = [
            'name.required' => 'Es necesario ingresar un nombre para la categoria',
            'name.min' => 'El nombre de la categoria debe tener al menos 3 caracteres',
            'description.max' => 'la descripcion debe tener maximo 250 caracteres',
        ];
	
    public function products() {
        return $this->hasMany(Product::class);
    }

    public function getFeaturedImageUrlAttribute() {

        if ($this->image) {
            
            if (substr($this->image, 0, 4) === "http") {
                return $this->image;
            }
            return '/images/categories/'.$this->image;
        }

        $firstProduct = $this->products()->first();
        if ($firstProduct) {
            return $firstProduct->featured_image_url;
        }
        return '/images/no-image.png';
    }
}
