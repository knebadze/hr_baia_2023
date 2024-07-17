<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Employer extends Model
{

    // use PowerJoins;

    use HasFactory, LogsActivity;

    protected $fillable = [
        'id',
        'name_ka',
        'name_en',
        'name_ru',
        'email',
        'number_code_id',
        'number',
        'address_ka',
        'address_en',
        'address_ru',
        'street_ka',
        'street_eu',
        'street_ru',
        'latitude',
        'longitude',
        'map_link',
        'fb_link',
        'verify_code'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        $logOptions = LogOptions::defaults([])->logFillable()->logOnlyDirty();

        return $logOptions;
    }

    public function vacancy()
    {
        return $this->hasMany(Vacancy::class, 'author_id', 'id' );
    }

    public function numberCode()
    {
        return $this->belongsTo(numberCode::class, 'number_code_id', 'id');
    }
    public function additionalNumbers()
    {
        return $this->hasMany(EmployerAdditionalNumber::class);
    }
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
