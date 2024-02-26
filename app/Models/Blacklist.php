<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Blacklist extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'user_id',
        'employer_id',
        'ground_id',
        'author_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {

        $logOptions = LogOptions::defaults([])->logFillable()->logOnlyDirty();

        return $logOptions;
    }
}
