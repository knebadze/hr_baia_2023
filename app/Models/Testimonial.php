<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullName_ka',
        'fullName_en',
        'fullName_ru',
        'profession_ka',
        'profession_en',
        'profession_ru',
        'text_ka',
        'text_en',
        'text_ru',
        'image_path',
        'is_active',
    ];

}
