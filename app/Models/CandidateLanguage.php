<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateLanguage extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_id',
        'language_id',
        'language_level_id',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
    public function level()
    {
        return $this->belongsTo(Language_level::class,  'language_level_id','id');
    }
}
