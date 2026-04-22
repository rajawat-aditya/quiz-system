<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MCQ_Record extends Model
{
    //
    protected $table='mcq_records';
    function scopeWithMCQ($query){
        return $query->join('mcq','mcq_records.mcq_id','=','mcq.id')->select('mcq.question','mcq_records.*');
    }
}
