<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyWorkCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'family_work_experience_id',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
