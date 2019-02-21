<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    public function images() {
        return $this->belongsTo(Product::class);
    }
}
