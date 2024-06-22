<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnfinishedRegistration extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'author_id',
        'was_assigned_id',
        'status_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'was_assigned_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
