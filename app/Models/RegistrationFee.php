<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'creator_id',
        'user_id',
        'initial_amount',
        'money',
        'enroll_date',
        'cancel_reason_id',
        'cancel_other_reason',  
    ];

    function user(){
        return $this->belongsTo(User::class);
    }

    function creator(){
        return $this->belongsTo(Staff::class);
    }

    public function cancelReason()
    {
        return $this->belongsTo(EnrollmentCancelReason::class, 'cancel_reason_id');
    }
}

