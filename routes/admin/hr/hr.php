<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HrController;

    Route::post('add_hr', [HrController::class, 'store']);
    Route::post('hr_is_active_update', [HrController::class, 'isActiveUpdate']);
    Route::post('update_hr', [HrController::class, 'update']);
    Route::post('get_hr_cla', [HrController::class, 'getHr']);
