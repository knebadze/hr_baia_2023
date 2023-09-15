<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Additional_number extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_id',
        'number_code_id',
        'number_owner_id',
        'number',
    ];
    public function numberCode()
    {
        return $this->belongsTo(numberCode::class);
    }
    public function numberOwner()
    {
        return $this->belongsTo(NumberOwner::class);
    }
}
