<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerAdditionalNumber extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'employer_id',
        'number_code_id',
        'number',
        'number_owner_id',
        'comment',
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class, 'employer_id');
    }

    public function numberCode()
    {
        // Assuming the related model is NumberCode and the foreign key is number_code_id
        return $this->belongsTo(NumberCode::class, 'number_code_id')->withDefault();
    }

    public function numberOwner()
    {
        // Assuming the related model is NumberOwner and the foreign key is number_owner_id
        return $this->belongsTo(NumberOwner::class, 'number_owner_id');
    }
}
