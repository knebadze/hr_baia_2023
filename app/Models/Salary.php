<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    protected $fillable = [
        'hr_id',
        'fixed_salary',
        'hr_bonus_from_vacancy',
        'hr_bonus_from_registration',
        'hr_bonus_from_free_registration',
        'full_salary',
        'disbursement_date',
        'hr_agree'
    ];
    protected $casts = [
        'disbursement_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function hr()
    {
        return $this->hasOne(Hr::class, 'id', 'hr_id');
    }

    public function staff()
    {
        return $this->hasOne(Hr::class, 'id', 'hr_id');
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
