<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
