<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;
use App\Http\Controllers\IndividualController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MapvacancieController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\MyprofileController;


use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\CandidateInfoController;

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

Route::get('', function() {
	return redirect('/ka');
});

Route::group(['middleware' => 'lang', 'prefix' => '{locale}', 'where' => ['locale' => '[a-zA-Z]{2}'], ],
       function()
    {
        Route::get('/', [MainController::class, 'index'])->name('welcome');

            Route::get('/individual', [IndividualController::class, 'index'])->name('individual');
            Route::get('/company', [CompanyController::class, 'index'])->name('company');
            Route::get('/onmap', [MapvacancieController::class, 'index'])->name('onmap');

        Route::get('/about', [AboutController::class, 'index'])->name('about');
        Route::get('/candidate', [CandidateController::class, 'index'])->name('candidate');
        Route::get('/blog', [BlogController::class, 'index'])->name('blog');

        // Account Pages
        Route::get('/user/candidateProfile', [MyprofileController::class, 'index'])->name('candidateProfile');

        Route::get('/home', [HomeController::class, 'index'])->name('home');
    });

    Auth::routes();

    Route::get('auth/{provider}/redirect', [SocialController::class, 'redirect'])->name('auth.social.redirect');
    Route::get('auth/{provider}/callback', [SocialController::class, 'callback'])->name('auth.social.callback');

    //AXIOS
    Route::post('profile_update', [MyprofileController::class, 'update']);
    Route::post('candidate_personal_info', [CandidateInfoController::class, 'personalInfo']);
    Route::post('candidate_medical_info', [CandidateInfoController::class, 'medicalInfo']);
    Route::post('candidate_language_info', [CandidateInfoController::class, 'languageInfo']);
    Route::post('add_candidate', [CandidateInfoController::class, 'addCandidate']);


