<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewriteHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'author_id',
        'vacancy_id',
        'old_hr_id',
        'new_hr_id',
    ];

    public function author()
    {
        // Assuming Author model exists and author_id is the foreign key
        return $this->belongsTo(Staff::class, 'author_id');
    }

    public function vacancy()
    {
        // Assuming Vacancy model exists and vacancy_id is the foreign key
        return $this->belongsTo(Vacancy::class, 'vacancy_id');
    }

    public function oldHr()
    {
        // Assuming HR model exists and old_hr_id is the foreign key
        // Adjust HR::class if your HR model has a different name
        return $this->belongsTo(Staff::class, 'old_hr_id');
    }

    public function newHr()
    {
        // Assuming HR model exists and new_hr_id is the foreign key
        // Adjust HR::class if your HR model has a different name
        return $this->belongsTo(Staff::class, 'new_hr_id');
    }
}
