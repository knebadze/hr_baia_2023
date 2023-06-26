<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Kirschbaum\PowerJoins\PowerJoins;

class Employer extends Model
{

    // use PowerJoins;
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
    use HasFactory;

    public function vacancy()
    {
        return $this->hasMany(vacancy::class, 'author_id', 'id');
    }
}
