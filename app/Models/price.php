<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class price extends Model
{
    use HasFactory;

    public function brand(){
        return $this->belongsTo('App\Models\brand');
    }

    public function category(){
        return $this->belongsTo('App\Models\category');
    }
    public function product(){
        return $this->belongsTo('App\Models\product');
    }


}
