<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KoreanUserData extends Model
{
    use HasFactory;
    protected $table = 'ko_user_datas';
    public $timestamps = false;
}
