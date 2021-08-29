<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationPublic extends Model
{
    use HasFactory;
    protected $table = 'notification_public';
    public $timestamps = false;
}
