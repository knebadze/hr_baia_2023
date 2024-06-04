<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hr extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'person_number',
        'mobile',
        'inside_number',
        'bonus_percent',
        'fixed_salary',
        'branch_id',
        'internship',
        'fb_link',
    ];
    protected $casts = [
        'internship' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function hrHasVacancy()
    {
        return $this->hasOne(User::class);
    }

    public function branch()
    {
        return $this->hasOne(Branch::class, 'id', 'branch_id');
    }

}
