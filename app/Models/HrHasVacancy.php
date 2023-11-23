<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrHasVacancy extends Model
{
    use HasFactory;
    protected $fillable = [
        'hr_id',
        'has_vacancy',
        're_write',
        'is_active',
    ];
    public function hr()
    {
        return $this->belongsTo(Hr::class, 'hr_id', 'id');
    }

    public function getActiveAttribute()
    {
        return $this->hr();
    }


}
