<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoFamilyWorkExperience extends Model
{
    use HasFactory;

    public function workInformation()
    {
        $this->hasMany(WorkInformation::class, 'work_information_id', 'id');
    }
}
