<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function product(){
        return $this->hasMany(Product::class,'category_id','id');
    }
    public function getFormattedDateAttribute()
    {
        //$check = $this-> created_at->format('m-d-y ,   g:i A');
        $product = $this->product->count();
        return $product;
    }

    protected $appends = ['formattedDate'];
}
