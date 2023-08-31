<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userRegisterLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'creator_id',
        'user_id',
        'type',
        'money',
        'enroll_date'
    ];
}
