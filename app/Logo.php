<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
   public function user(){
       return $this->belongsTo(User::class,'updated_by','id');
   }
}
