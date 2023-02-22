<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateNotice extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_id ',
        'notice_id',
        'file',
    ];

    public function notice()
    {
        return $this->belongsTo(Notice::class);
    }
}
