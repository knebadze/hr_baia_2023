<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'user_id',
        'company_object_type_id',
        'company_name_ka',
        'company_name_en',
        'company_name_ru',
        'object_type_ka',
        'object_type_eu',
        'object_type_ru',
        'position',
        'address_ka',
        'address_eu',
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
    public function companyObjectType()
    {
        return $this->belongsTo(Company_object_type::class);
    }
}
