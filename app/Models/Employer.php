<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{

    protected $fillable = [
        'name_ka',
        'name_en',
        'name_ru',
        'email',
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
}
