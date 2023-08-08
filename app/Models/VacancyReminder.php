<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacancyReminder extends Model
{
    use HasFactory;
    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }
    
    public function hr()
    {
        return $this->belongsTo(Hr::class);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}