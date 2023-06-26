@extends('layouts.appPage')
@section('title-block')
{{ __('lang.page_title_about') }}
@endsection
@section('content')
<!-- CONTENT START -->
<div class="page-content">

    <!-- INNER PAGE BANNER -->
    <div class="wt-bnr-inr overlay-wraper bg-center" style="background-image:url(/images/banner/1.jpg);">
        <div class="overlay-main site-bg-white opacity-01"></div>
        <div class="container">
            <div class="wt-bnr-inr-entry">
                <div class="banner-title-outer">
                    <div class="banner-title-name">
                        <h2 class="wt-title">{{ __('lang.about_us_page_title_one') }}</h2>
                    </div>
                </div>
                <!-- BREADCRUMB ROW -->

                    <div>
                        <ul class="wt-breadcrumb breadcrumb-style-2">
                            <li><a href="{{ url ('/') }}">{{ __('lang.about_us_page_title_link') }}</a>/ </li>
                            <li>{{ __('lang.about_us_page_title_one') }}</li>
                        </ul>
                    </div>


                <!-- BREADCRUMB ROW END -->
            </div>
        </div>
    </div>
    <!-- INNER PAGE BANNER END -->
    <!-- HOW IT WORK SECTION START -->
    <div class="section-full p-t120 p-b90 site-bg-white twm-how-it-work-area">

        <div class="container aboutUsText">
            <h4>
                {{ __('lang.about_us_page_description') }}
            </h4>
            <!-- TITLE START-->
            <div class="section-head center wt-small-separator-outer">
                <div class="wt-small-separator site-text-primary">
                   <div>{{ __('lang.about_us_page_working_proccess') }}</div>
                </div>
                <h2 class="wt-title">{{ __('lang.about_us_page_working_how_does_it_work') }}</h2>

            </div>
            <!-- TITLE END-->

            <div class="twm-how-it-work-section">
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="twm-w-process-steps">
                            <span class="twm-large-number">01</span>
                            <div class="twm-w-pro-top bg-clr-sky">
                                <div class="twm-media">
                                    <span><img src="/images/work-process/icon1.png" alt="icon1"></span>
                                </div>
                                <h4 class="twm-title">{{ __('lang.about_us_page_card_register_user') }}</h4>
                            </div>
                            <p>{{ __('lang.about_us_page_card_register_user_description') }}</p>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="twm-w-process-steps">
                            <span class="twm-large-number">02</span>
                            <div class="twm-w-pro-top bg-clr-pink">
                                <div class="twm-media">
                                    <span><img src="/images/work-process/icon2.png" alt="icon1"></span>
                                </div>
                                <h4 class="twm-title">{{ __('lang.about_us_page_card_editing_user') }}</h4>
                            </div>
                            <p>{{ __('lang.about_us_page_card_editing_user_description') }}</p>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="twm-w-process-steps">
                            <span class="twm-large-number">03</span>
                            <div class="twm-w-pro-top bg-clr-green">
                                <div class="twm-media">
                                    <span><img src="/images/work-process/icon3.png" alt="icon1"></span>
                                </div>
                                <h4 class="twm-title">{{ __('lang.about_us_page_card_upload_user') }}</h4>
                            </div>
                            <p>{{ __('lang.about_us_page_card_upload_user_description') }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- HOW IT WORK SECTION END -->
    <!-- JOBS CATEGORIES SECTION START -->
    <div class="section-full p-t120 p-b90 site-bg-gray twm-job-categories-area2">
        
        <!-- TITLE START-->
        <div class="section-head center wt-small-separator-outer">
            <div class="wt-small-separator site-text-primary">
               <div>{{ __('lang.about_us_page_jobs_by_category') }}</div>
            </div>
            <h2 class="wt-title">{{ __('lang.about_us_page_select_desire_category') }}</h2>
        </div>
        <!-- TITLE END-->

        <div class="container">

            <div class="twm-job-categories-section-2 m-b30">

                <div class="job-categories-style1 m-b30">
                    <div class="row">

                        <!-- COLUMNS 1 -->
                        <div class="col-lg-3 col-md-6">
                            <div class="job-categories-block-2 m-b30">
                                <div class="twm-media">
                                    <div class="flaticon-dashboard"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">9,185 ვაკანსია</div>
                                    <a href="job-detail.html">ძიძა</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 2 -->
                        <div class="col-lg-3 col-md-6">
                            <div class="job-categories-block-2 m-b30">
                                <div class="twm-media">
                                    <div class="flaticon-project-management"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">3,205 ვაკანსია</div>
                                    <a href="job-detail.html">ჭურჭლის მრეცხავი</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 3 -->
                        <div class="col-lg-3 col-md-6">
                            <div class="job-categories-block-2 m-b30">
                                <div class="twm-media">
                                    <div class="flaticon-note"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">2,100 ვაკანსია</div>
                                    <a href="job-detail.html">მომვლელი</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 4 -->
                        <div class="col-lg-3 col-md-6">
                            <div class="job-categories-block-2 m-b30">
                                <div class="twm-media">
                                    <div class="flaticon-customer-support"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">1,500 ვაკანსია</div>
                                    <a href="job-detail.html">მზარეული</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 5 -->
                        <div class="col-lg-3 col-md-6">
                            <div class="job-categories-block-2 m-b30">
                                <div class="twm-media">
                                    <div class="flaticon-bars"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">9,185 ვაკანსია</div>
                                    <a href="job-detail.html">მენეჯერი</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 6 -->
                        <div class="col-lg-3 col-md-6">
                            <div class="job-categories-block-2 m-b30">
                                <div class="twm-media">
                                    <div class="flaticon-user"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">3,205 ვაკანსია</div>
                                    <a href="job-detail.html">მარკეტინგი</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 7 -->
                        <div class="col-lg-3 col-md-6">
                            <div class="job-categories-block-2 m-b30">
                                <div class="twm-media">
                                    <div class="flaticon-computer"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">2,100 ვაკანსია</div>
                                    <a href="job-detail.html">მძღოლი</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 8 -->
                        <div class="col-lg-3 col-md-6">
                            <div class="job-categories-block-2 m-b30">
                                <div class="twm-media">
                                    <div class="flaticon-coding"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">1,500 ვაკანსია</div>
                                    <a href="job-detail.html">ადმინისტრატორი</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="text-center job-categories-btn">
                    <a href="job-grid.html" class=" site-button">{{ __('lang.about_us_page_all_category') }}</a>
                </div>

            </div>

        </div>

    </div>
    <!-- JOBS CATEGORIES SECTION END -->

    <!-- HOW IT WORK SECTION START -->
    <div class="section-full p-t120 p-b90 site-bg-white twm-how-it-work-area2">

        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <!-- TITLE START-->
                        <div class="section-head left wt-small-separator-outer">
                            <div class="wt-small-separator site-text-primary">
                            <div>{{ __('lang.about_us_page_working_how_does_it_work') }} </div>
                            </div>
                            <h2 class="wt-title">{{ __('lang.about_us_page_follow_our_steps') }}</h2>

                        </div>
                        <ul class="description-list">
                            <li>
                                <i class="feather-check"></i>
                                {{ __('lang.about_us_page_follow_our_steps_list_1') }}
                            </li>
                            <li>
                                <i class="feather-check"></i>
                                {{ __('lang.about_us_page_follow_our_steps_list_2') }}
                            </li>
                            <li>
                                <i class="feather-check"></i>
                                {{ __('lang.about_us_page_follow_our_steps_list_3') }}
                            </li>
                            <li>
                                <i class="feather-check"></i>
                                {{ __('lang.about_us_page_follow_our_steps_list_4') }}
                            </li>
                        </ul>
                    <!-- TITLE END-->
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="twm-w-process-steps-2-wrap">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="twm-w-process-steps-2">
                                    <div class="twm-w-pro-top bg-clr-sky-light bg-sky-light-shadow">
                                        <span class="twm-large-number text-clr-sky">01</span>
                                        <div class="twm-media">
                                            <span><img src="/images/work-process/icon1.png" alt="icon1"></span>
                                        </div>
                                        <h4 class="twm-title">{{ __('lang.about_us_page_card_register_account') }}</h4>
                                    </div>

                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="twm-w-process-steps-2">
                                    <div class="twm-w-pro-top bg-clr-yellow-light bg-yellow-light-shadow">
                                        <span class="twm-large-number text-clr-yellow">02</span>
                                        <div class="twm-media">
                                            <span><img src="/images/work-process/icon4.png" alt="icon1"></span>
                                        </div>
                                        <h4 class="twm-title">{{ __('lang.about_us_page_card_search_vacancie') }}ა</h4>
                                    </div>

                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="twm-w-process-steps-2">
                                    <div class="twm-w-pro-top bg-clr-pink-light bg-pink-light-shadow">
                                        <span class="twm-large-number text-clr-pink">03</span>
                                        <div class="twm-media">
                                            <span><img src="/images/work-process/icon3.png" alt="icon1"></span>
                                        </div>
                                        <h4 class="twm-title">{{ __('lang.about_us_page_card_confirm_vacancie') }}</h4>
                                        {{-- <p>You need to create an account to find the best and preferred job.</p> --}}
                                    </div>

                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="twm-w-process-steps-2">
                                    <div class="twm-w-pro-top bg-clr-green-light bg-clr-light-shadow">
                                        <span class="twm-large-number text-clr-green">04</span>
                                        <div class="twm-media">
                                            <span><img src="/images/work-process/icon3.png" alt="icon1"></span>
                                        </div>
                                        <h4 class="twm-title">{{ __('lang.about_us_page_card_upload_resume') }}</h4>
                                        {{-- <p>You need to create an account to find the best and preferred job.</p> --}}
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>



            <div class="twm-how-it-work-section">

            </div>
        </div>

    </div>
    <!-- HOW IT WORK SECTION END -->



</div>
<!-- CONTENT END -->

</div>
@endsection