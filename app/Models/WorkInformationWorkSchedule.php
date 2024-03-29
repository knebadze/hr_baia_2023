<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkInformationWorkSchedule extends Model
{
    use HasFactory;

    public function workSchedule()
    {
        return $this->belongsTo(WorkSchedule::class);
    }
}
