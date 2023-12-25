<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Kirschbaum\PowerJoins\PowerJoins;
use OwenIt\Auditing\Contracts\Auditable;

class Employer extends Model implements Auditable
{

    // use PowerJoins;

    use HasFactory;
    use \OwenIt\Auditing\Auditable;

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
    ];

    public function vacancy()
    {
        return $this->hasMany(vacancy::class, 'author_id', 'id');
    }

    public function numberCode()
    {
        return $this->belongsTo(numberCode::class, 'number_code_id', 'id');
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
