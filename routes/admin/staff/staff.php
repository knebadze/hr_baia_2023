<?php

use App\Http\Controllers\Admin\StaffController;
use Illuminate\Support\Facades\Route;

Route::post('staff_is_active_update', [StaffController::class, 'isActiveUpdate']);

Route::post('add_staff', [StaffController::class, 'store']);

Route::post('update_staff', [StaffController::class, 'update']);

Route::post('staff_dismissal_from_service', [StaffController::class, 'dismissalFormService']);
