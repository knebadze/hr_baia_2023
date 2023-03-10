<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrHasVacancy extends Model
{
    use HasFactory;
    public function hr()
    {
        return $this->belongsTo(Hr::class, 'hr_id', 'id');
    }

    public function getActiveAttribute()
    {
        return $this->hr();
    }
}
