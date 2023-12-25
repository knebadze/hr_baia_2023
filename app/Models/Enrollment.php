<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Enrollment extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    
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
