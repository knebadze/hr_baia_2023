<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EmployerController;

// C

// R

// U
Route::post('employer_update', [EmployerController::class, 'update']);

// D

// F
Route::post('employer_filter', [EmployerController::class, 'filter']);
