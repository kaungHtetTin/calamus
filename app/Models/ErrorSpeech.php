<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorSpeech extends Model
{
    use HasFactory;
    protected $table = 'ee_error_speech';
    public $timestamps = false;
}

