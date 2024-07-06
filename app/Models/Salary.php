<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'fixed_salary',
        'staff_bonus_from_vacancy',
        'staff_bonus_from_registration',
        'supplement',
        'full_salary',
        'disbursement_date',
        'staff_agree',
    ];


    protected $casts = [
        'staff_id' => 'integer',
        'fixed_salary' => 'integer',
        'staff_bonus_from_vacancy' => 'float',
        'staff_bonus_from_registration' => 'integer',
        'supplement' => 'float',
        'full_salary' => 'float', 
        'disbursement_date' => 'datetime',
        'staff_agree' => 'integer',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
