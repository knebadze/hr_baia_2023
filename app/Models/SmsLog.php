<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'sms_template_id',
        'phone_number',
        'message',
    ];

    public function smsTemplate()
    {
        return $this->belongsTo(SmsTemplate::class);
    }
}
