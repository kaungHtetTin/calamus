<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    public function learner(){
        return $this->belongsTo(learner::class,'learner_id','learner_phone');
       
    }
    
    public $timestamps = false;
}
