<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RussianUserData extends Model
{
    use HasFactory;
    protected $table = 'ru_user_datas';
    public $timestamps = false;
}
