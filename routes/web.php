<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FaqController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PricesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\VacancyController;


use App\Http\Controllers\Admin\PdfController;


use App\Http\Controllers\CandidateController;

use App\Http\Controllers\MyVacancyController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\MapvacancieController;
use App\Http\Controllers\User\ResumeController;

use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\BusyCandidateController;

use App\Http\Controllers\Admin\BlackListController;
use App\Http\Controllers\Admin\SmsPageController;
use App\Http\Controllers\User\PostVacancyController;

use App\Http\Controllers\User\UserProfileController;

use App\Http\Controllers\Auth\ChangePasswordController;
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

        Route::get('/prices', [PricesController::class, 'index'])->name('prices');

        Route::get('/', [MainController::class, 'index'])->name('welcome');

            Route::get('/job', [VacancyController::class, 'index'])->name('job');
            Route::get('/my_vacancy', [MyVacancyController::class, 'index'])->name('my.vacancy');
            Route::get('/job_search/{category_id?}/{work_schedule_id?}/{address?}', [VacancyController::class, 'search'])->name('job.search');

            Route::get('show_vacancy/{id?}', [MyVacancyController::class, 'show'])->name('show.vacancy');

            // Route::get('/company', [CompanyController::class, 'index'])->name('company');
            Route::get('/onmap', [MapvacancieController::class, 'index'])->name('onmap');

        Route::get('/about', [AboutController::class, 'index'])->name('about');
        Route::get('/candidate', [CandidateController::class, 'index'])->name('candidate');
            // Route::get('/candidate-detail/{id}', [CandidateController::class, 'test']);

            Route::get('/candidate-detail/{id?}', [CandidateController::class, 'show'])->name('candidate-detail');
            Route::get('/candidate_search/{category_id?}', [CandidateController::class, 'search'])->name('candidate.search');

        Route::get('/blog', [BlogController::class, 'index'])->name('blog');
        Route::get('/contact', [ContactController::class, 'index'])->name('contact');

        // Account Pages
        Route::get('/user/userProfile/{id?}', [UserProfileController::class, 'index'])->name('userProfile');

        Route::get('/user/work_information', [WorkInformationController::class, 'index'])->name('work_information');
        // Route::get('/user/work_information_detail/{id}', [WorkInformationController::class, 'show'])->name('work.information.detail');

        // My Rezume
        Route::get('/user/myrezume', [ResumeController::class, 'index'])->name('myrezume');

        //Post Job
        Route::get('/post_job', [PostVacancyController::class, 'index'])->name('post.job');

        //Job Detail
        Route::get('/job_detail/{id?}/{slug?}', [VacancyController::class, 'show'])->name('job.detail');

        // Faq Page
        Route::get('/faq', [FaqController::class, 'index'])->name('faq');

        //user vacancy
        // Route::get('/user/vacancy', [VacancyController::class, 'index'])->name('user.vacancy');

        //Job Detail
        // Route::get('/job_detail/{id?}/{slug?}', [VacancyController::class, 'show'])->name('job_detail');

        Route::get('/auth/passwords/change_password', [ChangePasswordController::class, 'index'])->name('auth.password.change_password');


        Route::get('/home', [HomeController::class, 'index'])->name('home');

        //______________________ADMIN PAGE_____________________________
        Route::get('admin', [AdminController::class, 'index'])->name('admin');
        Route::get('admin_verify', [AdminController::class, 'verifyPage'])->name('admin.verify');

        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    });

    //admin Route
    Route::post('/admin_login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/admin/verify', [AdminController::class, 'verifyCode'])->name('admin.verify.code');


    Auth::routes();

    Route::get('auth/{provider}/redirect', [SocialController::class, 'redirect'])->name('auth.social.redirect');
    Route::get('auth/{provider}/callback', [SocialController::class, 'callback'])->name('auth.social.callback');

    //________________________admin page without lang________________
    // Define a route group for admin-related routes

    include('admin/page/page.php');

    Route::get('hr/busy_candidate', [BusyCandidateController::class, 'index'])->name('busy.candidate');
    // Route::get('hr/candidate', [BusyCandidateController::class, 'index'])->name('busy.candidate');

    //_______________________USER REQUEST_____________________________
    include('user/user.php');

    // Route::post('unknown_profile_update', [MyprofileController::class, 'unknownUpdate']);




    Route::post('add_employer', [EmployerInfoController::class, 'store']);

    //_____________________ADMIN REQUEST_______________________________

    include('admin/hr/hr.php');
    include('admin/candidate/candidate.php');
    include('admin/employer/employer.php');


    //enrollment
    include('admin/enrollment/enrollment.php');
    //salary
    include('admin/salary/salary.php');


    // ________________VACANCY REQUEST__________________________________

    include('admin/vacancy/vacancy.php');
    include('user/vacancy.php');


    // blacklist
    Route::post('/get_add_black_list_info', [BlackListController::class, 'getInfo']);
    Route::post('/add_black_list', [BlackListController::class, 'addBlackList']);

    // PDF
    Route::get('/candidate_full_pdf', [PdfController::class, 'candidateFull']);
    Route::get('/candidate_partial_pdf', [PdfController::class, 'candidatePartial']);

    // _________________TESTIMONIAL_______________________
    include('admin/testimonial/testimonial.php');

    Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
    Route::post('/sms_template_update', [SmsPageController::class, 'update']);

    include('admin/global_variable/variable.php');



