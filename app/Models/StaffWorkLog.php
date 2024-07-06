<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffWorkLog extends Model
{
    protected $fillable = [
        'staff_id',
        'start_date',
        'end_date',
        'has_vacancy',
        'employed',
        'approved_by_employer',
        'has_probationary_period',
        'has_enrollment_vacancy',
        'candidate_has_registered',
        'has_enrollment_register',
        'add_vacancy',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'has_vacancy' => 'integer',
        'employed' => 'integer',
        'approved_by_employer' => 'integer',
        'has_probationary_period' => 'integer',
        'has_enrollment_vacancy' => 'integer',
        'candidate_has_registered' => 'integer',
        'has_enrollment_register' => 'integer',
        'add_vacancy' => 'integer',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
