<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\admin\HrController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\MyprofileController;

use App\Http\Controllers\IndividualController;
use App\Http\Controllers\Admin\AdminController;


use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\MapvacancieController;
use App\Http\Controllers\User\ResumeController;
use App\Http\Controllers\User\PostJobController;
use App\Http\Controllers\CandidateInfoController;
use App\Http\Controllers\Employer\VacancyController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Company\CompanyInfoController;
use App\Http\Controllers\Admin\AdminCandidateController;
use App\Http\Controllers\Employer\EmployerInfoController;
use App\Http\Controllers\Candidate\WorkInformationController;

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

        Route::get('/terms_end_conditions', [TermsController::class, 'index'])->name('terms_end_conditions');

        Route::get('/', [MainController::class, 'index'])->name('welcome');

            Route::get('/individual', [IndividualController::class, 'index'])->name('individual');
            // Route::get('/company', [CompanyController::class, 'index'])->name('company');
            Route::get('/onmap', [MapvacancieController::class, 'index'])->name('onmap');

        Route::get('/about', [AboutController::class, 'index'])->name('about');
        Route::get('/candidate', [CandidateController::class, 'index'])->name('candidate');
            // Route::get('/candidate-detail/{id}', [CandidateController::class, 'test']);

            Route::get('/candidate-detail/{id?}', [CandidateController::class, 'show'])->name('candidate-detail');

        Route::get('/blog', [BlogController::class, 'index'])->name('blog');

        // Account Pages
        Route::get('/user/userProfile', [UserProfileController::class, 'index'])->name('userProfile');

        Route::get('/user/work_information', [WorkInformationController::class, 'index'])->name('work_information');
        // Route::get('/user/work_information_detail/{id}', [WorkInformationController::class, 'show'])->name('work.information.detail');

        // My Rezume
        Route::get('/user/myrezume', [ResumeController::class, 'index'])->name('myrezume');

        //Post Job
        Route::get('/post_job', [PostJobController::class, 'index'])->name('post.job');

        //user vacancy
        Route::get('/user/vacancy', [VacancyController::class, 'index'])->name('user.vacancy');

        Route::get('/auth/passwords/change_password', [ChangePasswordController::class, 'index'])->name('auth.password.change_password');


        Route::get('/home', [HomeController::class, 'index'])->name('home');
        //______________________ADMIN PAGE_____________________________
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/admin/hr', [HrController::class, 'index'])->name('admin.hr');
        Route::get('/admin/candidate', [AdminCandidateController::class, 'index'])->name('admin.candidate');
    });

    //admin Route
    Route::post('/admin_login', [AdminController::class, 'login'])->name('admin.login');


    Auth::routes();

    Route::get('auth/{provider}/redirect', [SocialController::class, 'redirect'])->name('auth.social.redirect');
    Route::get('auth/{provider}/callback', [SocialController::class, 'callback'])->name('auth.social.callback');
    //_______________________USER REQUEST_____________________________
    Route::post('upload_avatar', [MyprofileController::class, 'store']);
    //AXIOS
    Route::post('profile_update', [MyprofileController::class, 'update']);
    Route::post('unknown_profile_update', [MyprofileController::class, 'unknownUpdate']);

    Route::post('add_candidate', [CandidateInfoController::class, 'addCandidate']);
    Route::post('add_candidate_file', [CandidateInfoController::class, 'addCandidateFile']);
    Route::post('remove_old_general_work_experience', [CandidateInfoController::class, 'removeOldWorkExperience']);

    Route::post('add_work_information', [WorkInformationController::class, 'store']);
    Route::post('update_work_information', [WorkInformationController::class, 'updateWorkInformation']);
    Route::post('delete_work_information', [WorkInformationController::class, 'deleteWorkInformation']);
    Route::post('add_family_work_experience', [WorkInformationController::class, 'familyStore']);

    Route::post('add_recommendation', [WorkInformationController::class, 'addRecommendation']);
    Route::post('add_recommendation_file', [WorkInformationController::class, 'addRecommendationFile']);
    Route::post('update_recommendation', [WorkInformationController::class, 'updateRecommendation']);
    Route::post('update_recommendation_file', [WorkInformationController::class, 'updateRecommendationFile']);
    Route::post('remove_recommendation', [WorkInformationController::class, 'removeRecommendation']);
    Route::post('trash_recommendation', [WorkInformationController::class, 'trashRecommendation']);
    Route::post('remove_recommendation_file', [WorkInformationController::class, 'removeRecommendationFile']);

    Route::post('resume_data', [ResumeController::class, 'resumeData']);

    Route::post('add_employer', [EmployerInfoController::class, 'store']);

    Route::post('add_vacancy', [VacancyController::class, 'store']);

    Route::post('change_password', [ChangePasswordController::class, 'change'])->name('change_password');

    //_____________________ADMIN REQUEST_______________________________

    Route::post('add_hr', [HrController::class, 'store']);
    Route::post('hr_is_active_update', [HrController::class, 'isActiveUpdate']);
    Route::post('update_hr', [HrController::class, 'update']);
    Route::post('candidate_work_info_data', [AdminCandidateController::class, 'workInfoData']);
    Route::post('candidate_family_work_info_data', [AdminCandidateController::class, 'familyWorkInfoData']);


    Route::get('vacancy_data', [IndividualController::class, 'data']);
