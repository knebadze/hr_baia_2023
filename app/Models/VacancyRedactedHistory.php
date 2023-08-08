<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacancyRedactedHistory extends Model
{
    use HasFactory;
    public function hr()
    {
        return $this->belongsTo(Hr::class);
    }
}