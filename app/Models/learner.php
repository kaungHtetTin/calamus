<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class learner extends Model
{
    use HasFactory;
    
    
    
    protected $fillable = [
        'learner_name',
        'learner_phone',
        'learner_email',
        'password',
        'learner_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $guarded = [];

    public $timestamps = false;
}
