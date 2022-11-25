<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JapaneseUserData extends Model
{
    use HasFactory;
    protected $table = 'jp_user_datas';
    public $timestamps = false;
}

