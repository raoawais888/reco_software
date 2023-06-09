<?php

namespace App\Models;
use App\models\brand;
use App\models\category;
use App\models\branch;
use App\models\entry;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quatation extends Model
{
    use HasFactory;
   public function brand(){
        return $this->belongsTo('App\Models\brand');
    }
    public function category(){
        return $this->belongsTo('App\Models\category');
    }
    public function branch(){
        return $this->belongsTo('App\Models\branch');
    }
    public function product(){
        return $this->belongsTo('App\Models\product');
    }

}






