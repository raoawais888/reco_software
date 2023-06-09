<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salary extends Model
{
    use HasFactory;

    public function employee(){
        return $this->belongsTo('App\Models\employee');
    }
    public function branch(){
        return $this->belongsTo('App\Models\branch');
    }
}
