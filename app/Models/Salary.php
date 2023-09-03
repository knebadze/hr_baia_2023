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

    public function hr()
    {
        return $this->hasOne(Hr::class, 'id', 'hr_id');
    }
}
