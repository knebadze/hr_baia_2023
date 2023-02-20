<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language_level extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name_ka',
        'name_eu',
        'name_ru',
    ];

    public function candidates()
    {
        return $this->hasMany(CandidateLanguage::class, 'candidate_level_id', 'id');
    }
}
