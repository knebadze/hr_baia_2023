<?php

use App\Http\Controllers\Api\PathController;
use Illuminate\Support\Facades\Route;

Route::post('/store_path', [PathController::class, 'store']);
