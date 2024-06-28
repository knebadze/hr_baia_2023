<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Enrollment extends Model
{
    use LogsActivity, HasFactory;

    protected $fillable = [
        'enrollment_type', #1_კანდიდატი, 2_ვაკანსია
        'author_id',
        'vacancy_id',
        'candidate_id',
        'who_is_counting', #1_კანდიდატი, 2_დამსაქმებელი
        'type', #1_სრული, 0_არასრული
        'name',
        'money',
        'hr_percent',
        'hr_bonus',
        'file_path',
        'agree',
    ];
    protected $casts = [
        'created_at' => 'datetime:m-d-Y H:i',
        'updated_at' => 'datetime:m-d-Y H:i'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        $logOptions = LogOptions::defaults([])->logFillable()->logOnlyDirty();
        return $logOptions;
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
