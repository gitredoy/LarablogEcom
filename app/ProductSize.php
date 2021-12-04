<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    public function productsize(){
        return $this->belongsTo(Size::class,'size_id','id');
    }
}
