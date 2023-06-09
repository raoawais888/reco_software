<?php

namespace App\Models;
use App\models\branch;
use App\models\brand;
use App\models\category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchaseReturn extends Model
{
    use HasFactory;
    public function branch(){
        return $this->belongsTo('App\Models\branch');
    }
    public function category(){
        return $this->belongsTo('App\Models\category');
    }
    public function brand(){
        return $this->belongsTo('App\Models\brand');
    }
    public function product(){
        return $this->belongsTo('App\Models\product');
    }
}
