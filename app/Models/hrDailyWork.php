<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hrDailyWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'hr_id',
        'has_vacancy',
        'employed',
        'approved_by_employer',
        'has_probationary_period',
        'has_enrollment_vacancy',
        'candidate_has_registered',
        'has_enrollment_register',
    ];

    public function hr()
    {
        return $this->belongsTo(Hr::class);
    }
}
