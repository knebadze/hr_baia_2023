<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HrController;

    Route::post('get_hr', [HrController::class, 'fetchData']);
    // Route::post('hr_is_active_update', [HrController::class, 'isActiveUpdate']);
    // Route::post('update_hr', [HrController::class, 'update']);
    Route::post('get_hr_cla', [HrController::class, 'getHr']);
