<?php

use App\Http\Controllers\Admin\TestimonialController;
use Illuminate\Support\Facades\Route;

// C
Route::post('add_testimonial', [TestimonialController::class, 'create']);

// R
Route::post('translate_testimonial', [TestimonialController::class, 'translate']);

// U
Route::post('testimonial_is_active_update', [TestimonialController::class, 'IsActiveUpdate']);
Route::post('update_testimonial', [TestimonialController::class, 'update']);
// D


// F
