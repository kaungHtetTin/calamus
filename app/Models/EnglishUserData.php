<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnglishUserData extends Model
{
    use HasFactory;
    protected $table = 'ee_user_datas';
    public $timestamps = false;
}

