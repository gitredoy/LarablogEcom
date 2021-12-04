<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    public function productcolor(){
        return $this->belongsTo(Color::class,'color_id','id');
    }
}
