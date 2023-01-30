<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;
use App\Http\Controllers\IndividualController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MapvacancieController;
use App\Http\Controllers\AboutController;


use App\Http\Controllers\Auth\SocialController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class, 'index'])->name('welcome');
Route::get('/individual', [IndividualController::class, 'index'])->name('individual');
Route::get('/company', [CompanyController::class, 'index'])->name('company');
Route::get('/onmap', [MapvacancieController::class, 'index'])->name('onmap');
Route::get('/about', [AboutController::class, 'index'])->name('about');

Auth::routes();

Route::get('auth/{provider}/redirect', [SocialController::class, 'redirect'])->name('auth.social.redirect');
Route::get('auth/{provider}/callback', [SocialController::class, 'callback'])->name('auth.social.callback');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
