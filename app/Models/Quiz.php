<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quiz extends Model
{
    //
    protected $table='quize';
    function category(){
        return $this->BelongsTo(Category::class);
    }
    function Mcq(){
        return $this->hasMany(MCQ::class);
    }
    function Record(){
        return $this->hasMany(Record::class);
    }
}
