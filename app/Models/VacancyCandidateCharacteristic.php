<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\Pivot;

class VacancyCandidateCharacteristic extends Model
{
    use HasFactory;
    protected $fillable = [
        'vacancy_id',
        'characteristic_id',
    ];

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }

    public function characteristic()
    {
        return $this->belongsTo(GeneralCharacteristic::class);
    }
}
