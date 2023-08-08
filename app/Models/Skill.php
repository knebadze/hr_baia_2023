<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $appends = ['categoryName'];

    public function candidateSkill()
    {
        return $this->hasOne(FamilyWorkDutyclass, 'skill_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getCategoryNameAttribute()
    {
        return Category::where('id', $this->category_id)->first();
    }
}
