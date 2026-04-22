<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    //
    protected $table='record';
    function scopeWithQuiz($query){
        return $query->join('quize','record.quiz_id','=','quize.id')->select('quize.*','record.*');
    }

        function quiz(){
        return $this->BelongsTo(Quiz::class);
    }

    
}
