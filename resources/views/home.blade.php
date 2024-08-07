@extends('layouts.appPage')
@section('title-block')
{{ __('lang.user_page_title_user') }}
@endsection
@section('content')
<!-- CONTENT START -->
<div class="page-content">

    <!-- INNER PAGE BANNER -->
    <div class="wt-bnr-inr overlay-wraper bg-center">
        <div class="overlay-main site-bg-white opacity-01"></div>
        <div class="container">
            <div class="wt-bnr-inr-entry">
                <div class="banner-title-outer">
                    <div class="banner-title-name">
                            <h2 class="wt-title">{{ __('lang.user_page_candidate_first_title') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- INNER PAGE BANNER END -->


    <!-- OUR BLOG START -->
    <div class="section-full p-b90 site-bg-white">


        <div class="container">
            <div class="row">

                <div class="col-xl-3 col-lg-4 col-md-12 rightSidebar m-b30">

                    <div class="side-bar-st-1">



                        @include('inc.user.nav')

                    </div>

                </div>

                <div class="col-xl-9 col-lg-8 col-md-12 m-b30">
                    <!--Filter Short By-->
                    <div class="twm-right-section-panel site-bg-gray">
                        <div class="wt-admin-right-page-header">
                            <h2>{{ Auth::guard('web')->user()->{'name_' . app()->getLocale()} }} </h2>
                            {{-- <p>IT Contractor</p> --}}
                        </div>
                        @if (Auth::guard('web')->user()->candidate)

                        <div class="twm-dash-b-blocks mb-5">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                    <div class="panel panel-default">
                                        <div class="panel-body wt-panel-body dashboard-card-2 block-gradient">
                                            <div class="wt-card-wrap-2">
                                                <div class="wt-card-icon-2"><i class="flaticon-job"></i></div>
                                                <div class="wt-card-right wt-total-active-listing counter ">{{ $vacancyCount }}</div>
                                                <div class="wt-card-bottom-2 ">
                                                    <h4 class="m-b0">{{ __('lang.user_page_candidate_active_vacancy') }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                    <div class="panel panel-default">
                                        <div class="panel-body wt-panel-body dashboard-card-2 block-gradient-2">
                                            <div class="wt-card-wrap-2">
                                                <div class="wt-card-icon-2"><i class="flaticon-resume"></i></div>
                                                <div class="wt-card-right  wt-total-listing-view counter ">{{ $view }}</div>
                                                <div class="wt-card-bottom-2">
                                                    <h4 class="m-b0">{{ __('lang.user_page_candidate_resume_views') }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                    <div class="panel panel-default">
                                        <div class="panel-body wt-panel-body dashboard-card-2 block-gradient-3">
                                            <div class="wt-card-wrap-2">
                                                <div class="wt-card-icon-2"><i class="flaticon-envelope"></i></div>
                                                <div class="wt-card-right wt-total-listing-review counter ">28</div>
                                                <div class="wt-card-bottom-2">
                                                    <h4 class="m-b0">Messages</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                    <div class="panel panel-default">
                                        <div class="panel-body wt-panel-body dashboard-card-2 block-gradient-4">
                                            <div class="wt-card-wrap-2">
                                                <div class="wt-card-icon-2"><i class="flaticon-bell"></i></div>
                                                <div class="wt-card-right wt-total-listing-bookmarked counter ">18</div>
                                                <div class="wt-card-bottom-2">
                                                    <h4 class="m-b0">Notifications</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        @else
                        <div class="twm-pro-view-chart-wrap">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 mb-4 text-center">
                                    <p class="">მოგესალმებით ტექტს...... თუ გსურთ დასაქმება სავალდებულოა შეავსოთ პირადი ინფორმაცი!!!</p>
                                    <a href="{{ route('userProfile' , App()->getLocale())  }}" class="site-button">
                                        ...<span class="fa fa-pen">  შევსება</span>
                                    </a>

                                </div>
                            </div>
                        </div>
                        @endif

                        {{-- <div class="twm-pro-view-chart-wrap">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 mb-4">

                                    <div class="panel panel-default site-bg-white">
                                        <div class="panel-heading wt-panel-heading p-a20">
                                            <h4 class="panel-tittle m-a0"><i class="far fa-chart-bar"></i>Your Profile Views</h4>
                                        </div>
                                        <div class="panel-body wt-panel-body twm-pro-view-chart">
                                            <canvas id="profileViewChart"></canvas>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 mb-4">
                                    <div class="panel panel-default">
                                        <div class="panel-heading wt-panel-heading p-a20">
                                            <h4 class="panel-tittle m-a0">Inbox</h4>
                                        </div>
                                        <div class="panel-body wt-panel-body bg-white">
                                            <div class="dashboard-messages-box-scroll scrollbar-macosx">

                                                <div class="dashboard-messages-box">
                                                    <div class="dashboard-message-avtar"><img src="/images/user-avtar/pic1.jpg" alt=""></div>
                                                    <div class="dashboard-message-area">
                                                        <h5>Lucy Smith<span>18 June 2022</span></h5>
                                                        <p>Bring to the table win-win survival strategies to ensure proactive domination. at the end of the day, going forward, a new normal that has evolved from generation.</p>
                                                    </div>
                                                </div>

                                                <div class="dashboard-messages-box">
                                                    <div class="dashboard-message-avtar"><img src="/images/user-avtar/pic3.jpg" alt=""></div>
                                                    <div class="dashboard-message-area">
                                                        <h5>Richred paul<span>19 June 2022</span></h5>
                                                        <p>Bring to the table win-win survival strategies to ensure proactive domination. at the end of the day, going forward, a new normal that has evolved from generation.</p>
                                                    </div>
                                                </div>

                                                <div class="dashboard-messages-box">
                                                    <div class="dashboard-message-avtar"><img src="/images/user-avtar/pic4.jpg" alt=""></div>
                                                    <div class="dashboard-message-area">
                                                        <h5>Jon Doe<span>20 June 2022</span></h5>
                                                        <p>Bring to the table win-win survival strategies to ensure proactive domination. at the end of the day, going forward, a new normal that has evolved from generation.</p>
                                                    </div>
                                                </div>

                                                <div class="dashboard-messages-box">
                                                    <div class="dashboard-message-avtar"><img src="/images/user-avtar/pic1.jpg" alt=""></div>
                                                    <div class="dashboard-message-area">
                                                        <h5>Thomas Smith<span>22 June 2022</span></h5>
                                                        <p>Bring to the table win-win survival strategies to ensure proactive domination. at the end of the day, going forward, a new normal that has evolved from generation. </p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 mb-4">
                                    <div class="panel panel-default site-bg-white m-t30">
                                        <div class="panel-heading wt-panel-heading p-a20">
                                            <h4 class="panel-tittle m-a0"><i class="far fa-list-alt"></i>Recent Activities</h4>
                                        </div>
                                        <div class="panel-body wt-panel-body">

                                            <div class="dashboard-list-box list-box-with-icon">
                                                <ul>
                                                    <li>
                                                        <i class="fa fa-envelope text-success list-box-icon"></i>Nikol Tesla has sent you <a href="#" class="text-success">private message!</a>
                                                        <a href="#" class="close-list-item color-lebel clr-red">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-suitcase text-primary list-box-icon"></i>Your job for
                                                        <a href="#" class="text-primary">Web Designer</a>
                                                        has been approved!
                                                        <a href="#" class="close-list-item color-lebel clr-red">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <i class="fa fa-bookmark text-warning list-box-icon"></i>
                                                        Someone bookmarked your
                                                        <a href="#" class="text-warning">SEO Expert</a>
                                                        Job listing!
                                                        <a href="#" class="close-list-item color-lebel clr-red">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-tasks text-info list-box-icon"></i>
                                                        Your job listing Core
                                                        <a href="#" class="text-info">PHP Developer</a> for Site Maintenance is expiring!
                                                        <a href="#" class="close-list-item color-lebel clr-red">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-paperclip text-success list-box-icon"></i>
                                                        You have new application for
                                                        <a href="#" class="text-success"> UI/UX Developer & Designer! </a>
                                                        <a href="#" class="close-list-item color-lebel clr-red">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-suitcase text-danger list-box-icon"></i>
                                                        Your Magento Developer job expire
                                                        <a href="#" class="text-danger">Renew</a>  now it.
                                                        <a href="#" class="close-list-item color-lebel clr-red">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star site-text-orange list-box-icon"></i>
                                                        David cope left a
                                                        <a href="#" class="site-text-orange"> review 4.5</a> for Real Estate Logo
                                                        <a href="#" class="close-list-item color-lebel clr-red">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </li>
                                                </ul>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 mb-4">
                                    <div class="panel panel-default">
                                        <div class="panel-heading wt-panel-heading p-a20">
                                            <h4 class="panel-tittle m-a0">Recent Applicants</h4>
                                        </div>
                                        <div class="panel-body wt-panel-body bg-white">
                                            <div class="twm-dashboard-candidates-wrap">
                                                <div class="row">

                                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                                         <div class="twm-dash-candidates-list">
                                                             <div class="twm-media">
                                                                 <div class="twm-media-pic">
                                                                    <img src="/images/candidates/pic1.jpg" alt="#">
                                                                 </div>

                                                             </div>
                                                             <div class="twm-mid-content">
                                                                 <a href="#" class="twm-job-title">
                                                                     <h4>Wanda Montgomery </h4>
                                                                 </a>
                                                                 <p>Charted Accountant</p>

                                                                 <div class="twm-fot-content">
                                                                     <div class="twm-left-info">
                                                                        <p class="twm-candidate-address"><i class="feather-map-pin"></i>New York</p>
                                                                        <div class="twm-jobs-vacancies">$20<span>/ Day</span></div>
                                                                     </div>
                                                                     <div class="twm-right-btn">

                                                                        <ul class="twm-controls-icon list-unstyled">
                                                                            <li>
                                                                                <button title="View profile" data-bs-toggle="tooltip" data-bs-placement="top">
                                                                                    <span class="fa fa-eye"></span>
                                                                                </button>
                                                                            </li>
                                                                            <li>
                                                                                <button title="Send message" data-bs-toggle="tooltip" data-bs-placement="top">
                                                                                    <span class="far fa-envelope-open"></span>
                                                                                </button>
                                                                            </li>
                                                                            <li>
                                                                                <button title="Delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                                                    <span class="far fa-trash-alt"></span>
                                                                                </button>
                                                                            </li>
                                                                        </ul>

                                                                     </div>
                                                                </div>
                                                             </div>

                                                         </div>
                                                    </div>

                                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                                        <div class="twm-dash-candidates-list">
                                                            <div class="twm-media">
                                                                <div class="twm-media-pic">
                                                                   <img src="/images/candidates/pic2.jpg" alt="#">
                                                                </div>

                                                            </div>
                                                            <div class="twm-mid-content">
                                                                <a href="#" class="twm-job-title">
                                                                    <h4>Peter Hawkins</h4>
                                                                </a>
                                                                <p>Medical Professed</p>

                                                                <div class="twm-fot-content">
                                                                    <div class="twm-left-info">
                                                                       <p class="twm-candidate-address"><i class="feather-map-pin"></i>New York</p>
                                                                       <div class="twm-jobs-vacancies">$7<span>/ Hour</span></div>
                                                                    </div>
                                                                    <div class="twm-right-btn">

                                                                        <ul class="twm-controls-icon list-unstyled">
                                                                            <li>
                                                                                <button title="View profile" data-bs-toggle="tooltip" data-bs-placement="top">
                                                                                    <span class="fa fa-eye"></span>
                                                                                </button>
                                                                            </li>
                                                                            <li>
                                                                                <button title="Send message" data-bs-toggle="tooltip" data-bs-placement="top">
                                                                                    <span class="far fa-envelope-open"></span>
                                                                                </button>
                                                                            </li>
                                                                            <li>
                                                                                <button title="Delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                                                    <span class="far fa-trash-alt"></span>
                                                                                </button>
                                                                            </li>
                                                                        </ul>

                                                                    </div>
                                                               </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                                        <div class="twm-dash-candidates-list">
                                                            <div class="twm-media">
                                                                <div class="twm-media-pic">
                                                                   <img src="/images/candidates/pic3.jpg" alt="#">
                                                                </div>

                                                            </div>
                                                            <div class="twm-mid-content">
                                                                <a href="#" class="twm-job-title">
                                                                    <h4>Ralph Johnson  </h4>
                                                                </a>
                                                                <p>Bank Manger</p>

                                                                <div class="twm-fot-content">
                                                                    <div class="twm-left-info">
                                                                       <p class="twm-candidate-address"><i class="feather-map-pin"></i>New York</p>
                                                                       <div class="twm-jobs-vacancies">$180<span>/ Day</span></div>
                                                                    </div>
                                                                    <div class="twm-right-btn">
                                                                        <ul class="twm-controls-icon list-unstyled">
                                                                            <li>
                                                                                <button title="View profile" data-bs-toggle="tooltip" data-bs-placement="top">
                                                                                    <span class="fa fa-eye"></span>
                                                                                </button>
                                                                            </li>
                                                                            <li>
                                                                                <button title="Send message" data-bs-toggle="tooltip" data-bs-placement="top">
                                                                                    <span class="far fa-envelope-open"></span>
                                                                                </button>
                                                                            </li>
                                                                            <li>
                                                                                <button title="Delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                                                    <span class="far fa-trash-alt"></span>
                                                                                </button>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                               </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                                        <div class="twm-dash-candidates-list">
                                                            <div class="twm-media">
                                                                <div class="twm-media-pic">
                                                                   <img src="/images/candidates/pic4.jpg" alt="#">
                                                                </div>

                                                            </div>
                                                            <div class="twm-mid-content">
                                                                <a href="#" class="twm-job-title">
                                                                    <h4>Randall Henderson </h4>
                                                                </a>
                                                                <p>IT Contractor</p>

                                                                <div class="twm-fot-content">
                                                                    <div class="twm-left-info">
                                                                       <p class="twm-candidate-address"><i class="feather-map-pin"></i>New York</p>
                                                                       <div class="twm-jobs-vacancies">$90<span>/ Week</span></div>
                                                                    </div>
                                                                    <div class="twm-right-btn">
                                                                        <ul class="twm-controls-icon list-unstyled">
                                                                            <li>
                                                                                <button title="View profile" data-bs-toggle="tooltip" data-bs-placement="top">
                                                                                    <span class="fa fa-eye"></span>
                                                                                </button>
                                                                            </li>
                                                                            <li>
                                                                                <button title="Send message" data-bs-toggle="tooltip" data-bs-placement="top">
                                                                                    <span class="far fa-envelope-open"></span>
                                                                                </button>
                                                                            </li>
                                                                            <li>
                                                                                <button title="Delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                                                    <span class="far fa-trash-alt"></span>
                                                                                </button>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                               </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                                        <div class="twm-dash-candidates-list">
                                                            <div class="twm-media">
                                                                <div class="twm-media-pic">
                                                                   <img src="/images/candidates/pic6.jpg" alt="#">
                                                                </div>

                                                            </div>
                                                            <div class="twm-mid-content">
                                                                <a href="#" class="twm-job-title">
                                                                    <h4>Christina Fischer </h4>
                                                                </a>
                                                                <p>Charity &amp; Voluntary</p>

                                                                <div class="twm-fot-content">
                                                                    <div class="twm-left-info">
                                                                       <p class="twm-candidate-address"><i class="feather-map-pin"></i>New York</p>
                                                                       <div class="twm-jobs-vacancies">$19<span>/ Hour</span></div>
                                                                    </div>
                                                                    <div class="twm-right-btn">
                                                                        <ul class="twm-controls-icon list-unstyled">
                                                                            <li>
                                                                                <button title="View profile" data-bs-toggle="tooltip" data-bs-placement="top">
                                                                                    <span class="fa fa-eye"></span>
                                                                                </button>
                                                                            </li>
                                                                            <li>
                                                                                <button title="Send message" data-bs-toggle="tooltip" data-bs-placement="top">
                                                                                    <span class="far fa-envelope-open"></span>
                                                                                </button>
                                                                            </li>
                                                                            <li>
                                                                                <button title="Delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                                                    <span class="far fa-trash-alt"></span>
                                                                                </button>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                               </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div> --}}

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- OUR BLOG END -->



</div>
<!-- CONTENT END -->
@endsection
