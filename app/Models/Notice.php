<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'notice_id',
        'file',
        'file_path'
    ];
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'id','candidate_id');
    }
}
