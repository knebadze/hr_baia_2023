<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;
    protected $fillable = [
        'enrollment_type',
        'author_id ',
        'vacancy_id ',
        'candidate_id ',
        'who_is_counting',
        'type',
        'name',
        'money',
        'hr_percent',
        'hr_bonus',
        'file_path',
        'agree',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
