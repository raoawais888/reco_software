<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stockActivity extends Model
{
    use HasFactory;

    public function branch(){
        return $this->belongsTo('App\Models\branch');
    }
    public function product(){
        return $this->belongsTo('App\Models\product');
    }

}
