<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MCQ extends Model
{
    //
    protected $table ='mcq';
    function quiz(){
        return $this->belongsTo(Quiz::class);
    }
    function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
