<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id','id');
    }
    public function productcolor(){
        return $this->hasMany(ProductColor::class,'product_id','id');
    }
    public function productsize(){
        return $this->hasMany(ProductSize::class,'product_id','id');
    }
    public function productimage(){
        return $this->hasMany(ProductSubImage::class,'product_id','id');
    }
}
