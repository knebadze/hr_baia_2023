@extends('layouts.appPage')
@section('title-block')
   {{ __('lang.page_title_home') }}
@endsection
@section('content')
<!-- CONTENT START -->
<div class="page-content">

    <!--Banner Start-->
    <div class="twm-home1-banner-section site-bg-gray bg-cover" style="background-image:url(images/main-slider/slider1/bg1.jpg)">

        <div class="row">
            <!--Left Section-->
            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="twm-bnr-left-section">
                    <div class="twm-bnr-title-small">{{ __('lang.welcome_leftside_bar_one') }} <span class="site-text-primary">208,000+</span> {{ __('lang.welcome_leftside_bar_two') }}</div>
                    <div class="twm-bnr-title-large">{{ __('lang.welcome_leftside_bar_firstword_one') }}  <span class="site-text-primary">{{ __('lang.welcome_leftside_bar_firstword_two') }}</span> {{ __('lang.welcome_leftside_bar_firstword_three') }}</div>
                    <div class="twm-bnr-discription">{{ __('lang.welcome_leftside_bar_search_title') }}
                    </div>
                    {{-- <test-vue></test-vue> --}}
                    <div class="twm-bnr-search-bar">
                        <form>
                            <div class="row">
                                <!--Title-->
                                <div class="form-group col-xl-3 col-lg-6 col-md-6">
                                    <label>{{ __('lang.welcome_leftside_bar_search_job_select_job') }}</label>
                                    <select class="wt-search-bar-select selectpicker"  data-live-search="true" title="" id="j-Job_Title" data-bv-field="size">
                                        <option disabled selected value="">Select Category</option>
                                        <option selected>{{ __('lang.welcome_leftside_bar_search_job_select_job_category') }}</option>
                                        <option>Web Designer</option>
                                        <option>Developer</option>
                                        <option>Acountant</option>
                                    </select>
                                </div>

                                <!--All Category-->
                                <div class="form-group col-xl-3 col-lg-6 col-md-6">
                                    <label>{{ __('lang.welcome_leftside_bar_search_job_category_job') }}</label>
                                    <select class="wt-search-bar-select selectpicker"  data-live-search="true" title="" id="j-All_Category" data-bv-field="size">
                                        <option disabled selected value="">Select Category</option>
                                        <option selected>{{ __('lang.welcome_leftside_bar_search_job_category_job_all_category') }}</option>
                                        <option>Web Designer</option>
                                        <option>Developer</option>
                                        <option>Acountant</option>
                                    </select>
                                </div>

                                <!--Location-->
                                <div class="form-group col-xl-3 col-lg-6 col-md-6">
                                    <label>{{ __('lang.welcome_leftside_bar_search_job_location_job') }}</label>
                                    <div class="twm-inputicon-box">
                                        <input name="username" type="text" required class="form-control" placeholder="{{ __('lang.welcome_leftside_bar_search_job_location_job_search') }}">
                                        <i class="twm-input-icon fas fa-map-marker-alt"></i>
                                    </div>
                                </div>

                                <!--Find job btn-->
                                <div class="form-group col-xl-3 col-lg-6 col-md-6">
                                    <button type="button" class="site-button">{{ __('lang.welcome_leftside_bar_search_job_location_job_search') }}</button>
                                </div>

                            </div>
                        </form>
                    </div>

                    <div class="twm-bnr-popular-search">
                        <span class="twm-title">{{ __('lang.welcome_leftside_bar_popular') }}:</span>
                        <a href="#">ძიძა</a>,
                        <a href="#">დამხმარე</a>,
                        <a href="#">მრეცხავი</a>,
                        <a href="#">მზარეული</a>...
                    </div>
                </div>
            </div>

            <!--right Section-->
            <div class="col-xl-6 col-lg-6 col-md-12 twm-bnr-right-section">
                <div class="twm-bnr-right-content">

                    <div class="twm-img-bg-circle-area">
                        <div class="twm-img-bg-circle1 rotate-center"><span></span></div>
                        <div class="twm-img-bg-circle2 rotate-center-reverse"><span></span></div>
                        <div class="twm-img-bg-circle3"><span></span></div>
                    </div>

                    <div class="twm-bnr-right-carousel">
                        <div class="owl-carousel twm-h1-bnr-carousal">
                            <div class="item">
                              <div class="slide-img">
                                <img src="images/main-slider/slider1/r-img1.png" alt="#">
                              </div>
                            </div>
                            <div class="item">
                              <div class="slide-img">
                                <div class="slide-img">
                                    <img src="images/main-slider/slider1/r-img2.png" alt="#">
                                  </div>
                              </div>
                            </div>
                        </div>

                        <div class="twm-bnr-blocks-position-wrap">
                            <!--icon-block-1-->
                            <div class="twm-bnr-blocks twm-bnr-blocks-position-1">
                                <div class="twm-icon">
                                    <img src="images/main-slider/slider1/icon-1.png" alt="">
                                </div>
                                <div class="twm-content">
                                    <div class="tw-count-number text-clr-sky">
                                        <span class="counter">12</span>K+
                                    </div>
                                    <p class="icon-content-info">{{ __('lang.welcome_rightside_bar_companyvacancie') }}</p>
                                </div>
                            </div>

                            <!--icon-block-2-->
                            <div class="twm-bnr-blocks twm-bnr-blocks-position-2">
                                <div class="twm-icon">
                                    <img src="images/main-slider/slider1/icon-2.png" alt="">
                                </div>
                                <div class="twm-content">
                                    <div class="tw-count-number text-clr-pink">
                                        <span class="counter">98</span> +
                                    </div>
                                    <p class="icon-content-info">{{ __('lang.welcome_rightside_bar_individualvacancie') }} </p>
                                </div>
                            </div>

                            <!--icon-block-3-->
                            <div class="twm-bnr-blocks-3 twm-bnr-blocks-position-3">
                                <div class="twm-pics">
                                    <span><img src="images/main-slider/slider1/user/u-1.jpg" alt=""></span>
                                    <span><img src="images/main-slider/slider1/user/u-2.jpg" alt=""></span>
                                    <span><img src="images/main-slider/slider1/user/u-3.jpg" alt=""></span>
                                    <span><img src="images/main-slider/slider1/user/u-4.jpg" alt=""></span>
                                    <span><img src="images/main-slider/slider1/user/u-5.jpg" alt=""></span>
                                    <span><img src="images/main-slider/slider1/user/u-6.jpg" alt=""></span>
                                </div>
                                <div class="twm-content">
                                    <div class="tw-count-number text-clr-green">
                                        <span class="counter">3</span>K+
                                    </div>
                                    <p class="icon-content-info">{{ __('lang.welcome_rightside_bar_employees') }}</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!--Samll Ring Left-->
                    <div class="twm-small-ring-l slide-top-animation"></div>
                    <div class="twm-small-ring-2 slide-top-animation"></div>

                </div>
            </div>

        </div>
        <div class="twm-gradient-text">
            Jobs
        </div>
    </div>
    <!--Banner End-->
    {{-- <how-work></how-work> --}}

<div class="card_body">

<<<<<<< HEAD
    <!-- WELCOME CARDS -->
    <div class="section-full p-t120 p-b90 twm-how-it-work-area" style="background-image: url(images/background/bg-1.jpg);">
=======
    <!-- HOW IT WORK SECTION START -->
    <div class="section-full p-t120 p-b90 site-bg-white twm-how-it-work-area">
>>>>>>> a84c9c5b20e54a93761a99c7d3a82c12e6f408f7

        <div class="container aboutUsText">

            <div class="twm-how-it-work-section">
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="twm-w-process-steps">
                            <span class="twm-large-number" style="color: #3898e2;">*</span>
                            <div class="twm-w-pro-top bg-clr-sky">
                                <div class="twm-media">
                                    <span><img src="/images/work-process/icon1.png" alt="icon1"></span>
                                </div>
<<<<<<< HEAD
                                <h4 class="twm-title"><a href="{{ route('post.job', App()->getLocale() ) }}"> {{ __('lang.welcome_middle_cards_left_1') }} <br>{{ __('lang.welcome_middle_cards_left_2') }} </a></h4>
                            </div>
                            <p>{{ __('lang.welcome_middle_cards_left_descr') }}</p>
=======
                                <h4 class="twm-title"><a href=""> პერსონალს <br>ვეძებ </a></h4>
                            </div>
                            <p>რა სახის პერსონალს ეძებთ?</p>
>>>>>>> a84c9c5b20e54a93761a99c7d3a82c12e6f408f7
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-6 middle_card">

                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="twm-w-process-steps">
                            <span class="twm-large-number" style="color: #56d8b1;">*</span>
                            <div class="twm-w-pro-top bg-clr-green">
                                <div class="twm-media">
                                    <span><img src="/images/work-process/icon3.png" alt="icon1"></span>
                                </div>
<<<<<<< HEAD
                                <h4 class="twm-title"><a href="#sign_up_popup" data-bs-toggle="modal"> {{ __('lang.welcome_middle_cards_right_1') }} <br>{{ __('lang.welcome_middle_cards_right_2') }} </a></h4>
                            </div>
                            <p>{{ __('lang.welcome_middle_cards_right_descr') }}</p>
=======
                                <h4 class="twm-title"><a href=""> სამსახურს <br>ვეძებ </a></h4>
                            </div>
                            <p>იპოვეთ სამსახური სახლთან ახლოს</p>
>>>>>>> a84c9c5b20e54a93761a99c7d3a82c12e6f408f7
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
<<<<<<< HEAD
    <!-- WELCOME CARDS END -->
=======
    <!-- HOW IT WORK SECTION END -->
>>>>>>> a84c9c5b20e54a93761a99c7d3a82c12e6f408f7

</div>


<<<<<<< HEAD


    </div>
    <!-- JOBS CATEGORIES SECTION END -->

    <!-- EXPLORE NEW LIFE START -->
    <!-- <div class="section-full p-t120 p-b120 twm-explore-area bg-cover " style="background-image: url(images/background/bg-1.jpg);">
        <div class="container">

            <div class="section-content">
                <div class="row">

                    <div class="col-lg-4 col-md-12">
                        <div class="twm-explore-media-wrap">
                            <div class="twm-media">
                                <img src="images/gir-large.png" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-12">
                        <div class="twm-explore-content-outer">
                            <div class="twm-explore-content">

                                <div class="twm-l-line-1"></div>
                                <div class="twm-l-line-2"></div>

                                <div class="twm-r-circle-1"></div>
                                <div class="twm-r-circle-2"></div>

                                <div class="twm-title-large">
                                    <h2>{{ __('lang.welcome_middle_uploadresume_block') }} </h2>
                                    {{-- <p>Lorem Ipsum არის უბრალოდ ბეჭდვისა და ბეჭდვის ინდუსტრიის მოჩვენებითი ტექსტი, 
                                        სტანდარტული მოჩვენებითი ტექსტი მას შემდეგ, რაც პრინტერი აიღო.</p> --}}
                                </div>
                                <div class="twm-upload-file">
                                    <button type="button" class="site-button">{{ __('lang.welcome_middle_uploadresume_button') }} <i class="feather-upload"></i></button>
                                </div>


                            </div>
                            <div class="twm-bold-circle-right"></div>
                            <div class="twm-bold-circle-left"></div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div> -->
    <!-- EXPLORE NEW LIFE END -->

    <!-- TOP COMPANIES START -->
    {{-- <div class="section-full p-t120 site-bg-white twm-companies-wrap">

            <div class="twm-company-approch-outer">
                <div class="twm-company-approch">
                    <div class="row">

                        <!--block 1-->
                        <div class="col-lg-4 col-md-12">
                            <div class="counter-outer-two">
                                <div class="icon-content">
                                    <div class="tw-count-number text-clr-sky">
                                        <span class="counter">5</span>M+</div>
                                    <p class="icon-content-info">{{ __('lang.welcome_middle_count_user') }}</p>
                                </div>
                            </div>
                        </div>

                        <!--block 2-->
                        <div class="col-lg-4 col-md-12">
                            <div class="counter-outer-two">
                                <div class="icon-content">
                                    <div class="tw-count-number text-clr-pink">
                                        <span class="counter">9</span>K+</div>
                                    <p class="icon-content-info">{{ __('lang.welcome_middle_count_position') }}</p>
                                </div>
                            </div>
                        </div>

                        <!--block 3-->
                        <div class="col-lg-4 col-md-12">
                            <div class="counter-outer-two">
                                <div class="icon-content">
                                    <div class="tw-count-number text-clr-green">
                                        <span class="counter">2</span>M+</div>
                                    <p class="icon-content-info">{{ __('lang.welcome_middle_count_history') }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


    </div> --}}
    <!-- TOP COMPANIES END -->

    <!-- JOB POST START -->
    <div class="section-full p-t120 p-b90 site-bg-light-purple twm-bg-ring-wrap">
        <div class="twm-bg-ring-right"></div>
        <div class="twm-bg-ring-left"></div>
        <div class="container">

            <!-- TITLE START-->
            <div class="section-head center wt-small-separator-outer">
                <div class="wt-small-separator site-text-primary">
                   {{-- <div>{{ __('lang.welcome_middle_career_allpost') }}</div> --}}
                </div>
                <h2 class="wt-title">{{ __('lang.welcome_middle_career_search') }}</h2>
            </div>
            <!-- TITLE END-->


            <div class="section-content">
               <div class="twm-jobs-list-wrap">
                   <ul>
                        <li>
                            <div class="twm-jobs-list-style1 mb-5">
                                <div class="twm-media">
                                    <img src="images/jobs-company/pic1.jpg" alt="#">
                                </div>
                                <div class="twm-mid-content">
                                    <a href="job-detail.html" class="twm-job-title">
                                        <h4>ძიძა  <span class="twm-job-post-duration">/ 1 დღის წინ</span></h4>
                                    </a>
                                    <p class="twm-job-address">აღმაშენებლის ქუჩა N7, თბილისი, საქართველო</p>
                                    <a href="#" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                </div>
                                <div class="twm-right-content">
                                    <div class="twm-jobs-category green"><span class="twm-bg-green">ახალი</span></div>
                                    <div class="twm-jobs-amount">₾500 <span>/ თვეში</span></div>
                                    <a href="job-detail.html" class="twm-jobs-browse site-text-primary">{{ __('lang.welcome_middle_career_search_block_buttonreadmore') }}</a>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="twm-jobs-list-style1 mb-5">
                                <div class="twm-media">
                                    <img src="images/jobs-company/pic2.jpg" alt="#">
                                </div>
                                <div class="twm-mid-content">
                                    <a href="job-detail.html" class="twm-job-title">
                                        <h4>მცხობელი<span class="twm-job-post-duration">/ 15 დღის წინ</span></h4>
                                    </a>
                                    <p class="twm-job-address">საბუდარის ქუჩა N56, ქუთაისი, საქართველო</p>
                                    <a href="#" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                </div>
                                <div class="twm-right-content">
                                    <div class="twm-jobs-category green"><span class="twm-bg-brown">სტაჟირება</span></div>
                                    <div class="twm-jobs-amount">₾2000<span>/ თვეში</span></div>
                                    <a href="job-detail.html" class="twm-jobs-browse site-text-primary">სრულად</a>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="twm-jobs-list-style1 mb-5">
                                <div class="twm-media">
                                    <img src="images/jobs-company/pic3.jpg" alt="#">
                                </div>
                                <div class="twm-mid-content">
                                    <a href="job-detail.html" class="twm-job-title">
                                        <h4 class="twm-job-title">იურისტები/ადვოკატები <span class="twm-job-post-duration">/ 6 თვის წინ</span></h4>
                                    </a>
                                    <p class="twm-job-address">ბარათაშვილის ქუჩა N23, ბათუმი, საქართველო</p>
                                    <a href="#" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                </div>
                                <div class="twm-right-content">
                                    <div class="twm-jobs-category green"><span class="twm-bg-purple">სრული განაკვეთი</span></div>
                                    <div class="twm-jobs-amount">₾4500 <span>/ თვეში</span></div>
                                    <a href="job-detail.html" class="twm-jobs-browse site-text-primary">სრულად</a>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="twm-jobs-list-style1 mb-5">
                                <div class="twm-media">
                                    <img src="images/jobs-company/pic4.jpg" alt="#">
                                </div>
                                <div class="twm-mid-content">
                                    <a href="job-detail.html" class="twm-job-title">
                                        <h4 class="twm-job-title">მენეჯერი <span class="twm-job-post-duration">/ 2 დღის წინ</span></h4>
                                    </a>
                                    <p class="twm-job-address">რუსთაველის ქუჩა N54, ფოთი, საქართველო</p>
                                    <a href="#" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                </div>
                                <div class="twm-right-content">
                                    <div class="twm-jobs-category green"><span class="twm-bg-sky">თავისუფალი</span></div>
                                    <div class="twm-jobs-amount">₾1200<span>/ თვეში</span></div>
                                    <a href="job-detail.html" class="twm-jobs-browse site-text-primary">სრულად</a>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="twm-jobs-list-style1 mb-5">
                                <div class="twm-media">
                                    <img src="images/jobs-company/pic5.jpg" alt="#">
                                </div>
                                <div class="twm-mid-content">
                                    <a href="job-detail.html" class="twm-job-title">
                                        <h4 class="twm-job-title">სასტუმროს მენეჯერი <span class="twm-job-post-duration">/ 1 დღის წინ</span></h4>
                                    </a>
                                    <p class="twm-job-address">ზანდუკელის ქუჩ 1, თბილისი, საქართველო</p>
                                    <a href="#" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                </div>
                                <div class="twm-right-content">
                                    <div class="twm-jobs-category green"><span class="twm-bg-golden">დროებითი</span></div>
                                    <div class="twm-jobs-amount">$1700 <span>/ Month</span></div>
                                    <a href="job-detail.html" class="twm-jobs-browse site-text-primary">სრულად</a>
                                </div>
                            </div>
                        </li>
                   </ul>
                   <div class="text-center m-b30">
                        <a href="job-list.html" class=" site-button">{{ __('lang.welcome_middle_career_search_block_buttonallwork') }}</a>
                   </div>
               </div>
            </div>

        </div>
    </div>
    <!-- JOB POST END -->

=======
>>>>>>> a84c9c5b20e54a93761a99c7d3a82c12e6f408f7
    <!-- JOBS CATEGORIES SECTION START -->
    <div class="section-full p-t120 p-b90 site-bg-gray twm-job-categories-area">

        <div class="container">

            <div class="wt-separator-two-part">
                <div class="row wt-separator-two-part-row">
                    <div class="col-xl-5 col-lg-5 col-md-12 wt-separator-two-part-left">
                        <!-- TITLE START-->
                        <div class="section-head left wt-small-separator-outer">
                            <div class="wt-small-separator site-text-primary">
                            <div>{{ __('lang.welcome_middle_leftblock_small_text') }}</div>
                            </div>
                            <h2 class="wt-title">{{ __('lang.welcome_middle_leftblock_big_text') }}</h2>
                        </div>
                        <!-- TITLE END-->
                    </div>

                    {{-- <div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-right">
                        <p>Lorem Ipsum არის უბრალოდ ბეჭდვისა და ბეჭდვის ინდუსტრიის მოჩვენებითი ტექსტი, სტანდარტული მოჩვენებითი ტექსტი მას შემდეგ, რაც პრინტერი აიღო.</p>
                    </div> --}}

                </div>
            </div>

            <div class="twm-job-categories-section">

                <div class="job-categories-style1 m-b30">
                    <div class="owl-carousel job-categories-carousel owl-btn-left-bottom ">

                        <!-- COLUMNS 1 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-dashboard"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">9,185 სამუშაო</div>
                                    <a href="job-detail.html">ძიძა</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 2 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-project-management"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">3,205 სამუშაო</div>
                                    <a href="job-detail.html">მზარეული</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 3 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-note"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">2,100 სამუშაო</div>
                                    <a href="job-detail.html">მომვლელი</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 4 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-customer-support"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">1,500 სამუშაო</div>
                                    <a href="job-detail.html">ჭურჭლის მრეცხავი</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 5 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-bars"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">9,185 სამუშაო</div>
                                    <a href="job-detail.html">ადმინისტრატორი</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 6 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-user"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">3,205 სამუშაო</div>
                                    <a href="job-detail.html">მარკეტინგი</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 7 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-computer"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">2,100 სამუშაო</div>
                                    <a href="job-detail.html">მოლარე-ოპერატორი</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 8 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-coding"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">1,500 სამუშაო</div>
                                    <a href="job-detail.html">ბარმენი</a>
                                </div>
                            </div>
                        </div>


                        <!-- COLUMNS 9 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-hr"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">9,185 სამუშაო</div>
                                    <a href="job-detail.html">ოჯახში დამხმარე</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 10 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-healthcare"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">3,205 სამუშაო</div>
                                    <a href="job-detail.html">ოჯახური წყვილები </a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 11 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-repair"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">2,100 სამუშაო</div>
                                    <a href="job-detail.html">პრომო-გოგონა</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 12 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-teacher"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">1,500 სამუშაო</div>
                                    <a href="job-detail.html">იურისტები / ადვოკატები</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 13 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-bank"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">9,185 სამუშაო</div>
                                    <a href="job-detail.html">მცხობელი</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 14 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-deal"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">3,205 სამუშაო</div>
                                    <a href="job-detail.html">ავადმყოფის მომვლელი</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 15 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-tray"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">2,100 სამუშაო</div>
                                    <a href="job-detail.html">საბავშვო ბაღის აღმზრდელი</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 16 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-tower"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">1,500 სამუშაო</div>
                                    <a href="job-detail.html">რესტორანი</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 17 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-lotus"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">9,185 სამუშაო</div>
                                    <a href="job-detail.html">დამლაგებელი</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="text-right job-categories-btn">
                    <a href="job-grid.html" class=" site-button">{{ __('lang.welcome_middle_submit') }}</a>
                </div>

            </div>

        </div>

    <div class="section-full p-t120 p-b90 site-bg-gray twm-job-categories-area">

        <div class="container">

            <div class="wt-separator-two-part">
                <div class="row wt-separator-two-part-row">
                    <div class="col-xl-5 col-lg-5 col-md-12 wt-separator-two-part-left">
                        <!-- TITLE START-->
                        <div class="section-head left wt-small-separator-outer">
                            <div class="wt-small-separator site-text-primary">
                            <div>{{ __('lang.welcome_middle_leftblock_small_text_candidate') }}</div>
                            </div>
                            <h2 class="wt-title">{{ __('lang.welcome_middle_leftblock_big_text_candidate') }}</h2>
                        </div>
                        <!-- TITLE END-->
                    </div>

                    {{-- <div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-right">
                        <p>Lorem Ipsum არის უბრალოდ ბეჭდვისა და ბეჭდვის ინდუსტრიის მოჩვენებითი ტექსტი, სტანდარტული მოჩვენებითი ტექსტი მას შემდეგ, რაც პრინტერი აიღო.</p>
                    </div> --}}

                </div>
            </div>

            <div class="twm-job-categories-section">

                <div class="job-categories-style1 m-b30">
                    <div class="owl-carousel job-categories-carousel owl-btn-left-bottom ">

                        <!-- COLUMNS 1 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-dashboard"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">9,185 სამუშაო</div>
                                    <a href="job-detail.html">ძიძა</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 2 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-project-management"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">3,205 სამუშაო</div>
                                    <a href="job-detail.html">მზარეული</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 3 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-note"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">2,100 სამუშაო</div>
                                    <a href="job-detail.html">მომვლელი</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 4 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-customer-support"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">1,500 სამუშაო</div>
                                    <a href="job-detail.html">ჭურჭლის მრეცხავი</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 5 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-bars"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">9,185 სამუშაო</div>
                                    <a href="job-detail.html">ადმინისტრატორი</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 6 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-user"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">3,205 სამუშაო</div>
                                    <a href="job-detail.html">მარკეტინგი</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 7 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-computer"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">2,100 სამუშაო</div>
                                    <a href="job-detail.html">მოლარე-ოპერატორი</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 8 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-coding"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">1,500 სამუშაო</div>
                                    <a href="job-detail.html">ბარმენი</a>
                                </div>
                            </div>
                        </div>


                        <!-- COLUMNS 9 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-hr"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">9,185 სამუშაო</div>
                                    <a href="job-detail.html">ოჯახში დამხმარე</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 10 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-healthcare"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">3,205 სამუშაო</div>
                                    <a href="job-detail.html">ოჯახური წყვილები </a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 11 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-repair"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">2,100 სამუშაო</div>
                                    <a href="job-detail.html">პრომო-გოგონა</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 12 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-teacher"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">1,500 სამუშაო</div>
                                    <a href="job-detail.html">იურისტები / ადვოკატები</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 13 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-bank"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">9,185 სამუშაო</div>
                                    <a href="job-detail.html">მცხობელი</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 14 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-deal"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">3,205 სამუშაო</div>
                                    <a href="job-detail.html">ავადმყოფის მომვლელი</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 15 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-tray"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">2,100 სამუშაო</div>
                                    <a href="job-detail.html">საბავშვო ბაღის აღმზრდელი</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 16 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-tower"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">1,500 სამუშაო</div>
                                    <a href="job-detail.html">რესტორანი</a>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 17 -->
                        <div class="item ">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    <div class="flaticon-lotus"></div>
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">9,185 სამუშაო</div>
                                    <a href="job-detail.html">დამლაგებელი</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="text-right job-categories-btn">
                    <a href="job-grid.html" class=" site-button">{{ __('lang.welcome_middle_submit_candidate') }}</a>
                </div>

            </div>

        </div>

    </div>    

            <!-- TESTIMONIAL SECTION START -->
            <div class="section-full p-t120 p-b90 site-bg-white twm-testimonial-1-area">
                
                <div class="container">

                    <div class="wt-separator-two-part">
                        <div class="row wt-separator-two-part-row">
                            <div class="col-xl-5 col-lg-6 col-md-12 wt-separator-two-part-left">
                                <!-- TITLE START-->
                                <div class="section-head left wt-small-separator-outer">
                                    <div class="wt-small-separator site-text-primary">                              
                                    </div>
                                    <h2 class="wt-title">{{ __('lang.welcome_middle_testimonial_block_head_text') }}</h2>
                                </div>                  
                                <!-- TITLE END-->
                            </div>
                            
                        </div>
                    </div>

                    <div class="section-content"> 
                        
                        <div class="owl-carousel twm-testimonial-1-carousel owl-btn-bottom-center ">
                        
                            <!-- COLUMNS 1 --> 
                            <div class="item ">
                                <div class="twm-testimonial-1">
                                    <div class="twm-testimonial-1-content">
                                        <div class="twm-testi-media">
                                            <img src="images/testimonials/pic-1.png" alt="#">
                                        </div>
                                        <div class="twm-testi-content">
                                            <div class="twm-quote">
                                                <img src="images/quote-dark.png" alt="">
                                            </div>
                                            <div class="twm-testi-info">I just got a job that I applied for via careerfy! I used the site all the time during my job hunt.</div>
                                            <div class="twm-testi-detail">
                                                <div class="twm-testi-name">Nikola Tesla</div>
                                                <div class="twm-testi-position">Accountant</div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                            <!-- COLUMNS 2 --> 
                            <div class="item ">
                                <div class="twm-testimonial-1">
                                    <div class="twm-testimonial-1-content">
                                        <div class="twm-testi-media">
                                            <img src="images/testimonials/pic-2.png" alt="#">
                                        </div>
                                        <div class="twm-testi-content">
                                            <div class="twm-quote">
                                                <img src="images/quote-dark.png" alt="">
                                            </div>
                                            <div class="twm-testi-info">I just got a job that I applied for via careerfy! I used the site all the time during my job hunt.</div>
                                            <div class="twm-testi-detail">
                                                <div class="twm-testi-name">Nikola Tesla</div>
                                                <div class="twm-testi-position">Accountant</div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <!-- COLUMNS 3 --> 
                            <div class="item ">
                                <div class="twm-testimonial-1">
                                    <div class="twm-testimonial-1-content">
                                        <div class="twm-testi-media">
                                            <img src="images/testimonials/pic-3.png" alt="#">
                                        </div>
                                        <div class="twm-testi-content">
                                            <div class="twm-quote">
                                                <img src="images/quote-dark.png" alt="">
                                            </div>
                                            <div class="twm-testi-info">I just got a job that I applied for via careerfy! I used the site all the time during my job hunt.</div>
                                            <div class="twm-testi-detail">
                                                <div class="twm-testi-name">Nikola Tesla</div>
                                                <div class="twm-testi-position">Accountant</div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <!-- COLUMNS 4 --> 
                            <div class="item ">
                                <div class="twm-testimonial-1">
                                    <div class="twm-testimonial-1-content">
                                        <div class="twm-testi-media">
                                            <img src="images/testimonials/pic-2.png" alt="#">
                                        </div>
                                        <div class="twm-testi-content">
                                            <div class="twm-quote">
                                                <img src="images/quote-dark.png" alt="">
                                            </div>
                                            <div class="twm-testi-info">I just got a job that I applied for via careerfy! I used the site all the time during my job hunt.</div>
                                            <div class="twm-testi-detail">
                                                <div class="twm-testi-name">Nikola Tesla</div>
                                                <div class="twm-testi-position">Accountant</div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <!-- COLUMNS 5 --> 
                            <div class="item ">
                                <div class="twm-testimonial-1">
                                    <div class="twm-testimonial-1-content">
                                        <div class="twm-testi-media">
                                            <img src="images/testimonials/pic-1.png" alt="#">
                                        </div>
                                        <div class="twm-testi-content">
                                            <div class="twm-quote">
                                                <img src="images/quote-dark.png" alt="">
                                            </div>
                                            <div class="twm-testi-info">I just got a job that I applied for via careerfy! I used the site all the time during my job hunt.</div>
                                            <div class="twm-testi-detail">
                                                <div class="twm-testi-name">Nikola Tesla</div>
                                                <div class="twm-testi-position">Accountant</div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
         
                    
                        </div>
                        
                    </div>                              
                </div>
                
            </div>
            <!-- TESTIMONIAL SECTION END -->

    <!-- OUR BLOG START -->
    <div class="section-full p-t120 p-b90 site-bg-gray">
        <div class="container">

            <!-- TITLE START-->
            <div class="section-head center wt-small-separator-outer">
                <div class="wt-small-separator site-text-primary">
                   <div>{{ __('lang.welcome_middle_blog_smalltext') }}</div>
                </div>
                <h2 class="wt-title">{{ __('lang.welcome_middle_blog_articletext') }}</h2>

            </div>
            <!-- TITLE END-->


            <div class="section-content">
                <div class="twm-blog-post-1-outer-wrap">
                    <div class="owl-carousel twm-la-home-blog owl-btn-bottom-center">
                        <div class="item">
                            <!--Block one-->
                            <div class="blog-post twm-blog-post-1-outer">
                                <div class="wt-post-media">
                                    <a href="blog-single.html"><img src="images/blog/latest/bg1.jpg" alt=""></a>
                                </div>
                                <div class="wt-post-info">
                                    <div class="wt-post-meta ">
                                        <ul>
                                            <li class="post-date">მარტი 05, 2022</li>
                                            <li class="post-author"> <a href="candidate-detail.html">Mark Petter</a></li>
                                        </ul>
                                    </div>
                                    <div class="wt-post-title ">
                                        <h4 class="post-title">
                                            <a href="blog-single.html">შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს და ტიპოგრაფიული ნაწარმის შემქმნელებს.</a>
                                        </h4>
                                    </div>
                                    <div class="wt-post-text ">
                                        <p>
                                            შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს და ტიპოგრაფიული ნაწარმის შემქმნელებს.
                                        </p>
                                    </div>
                                    <div class="wt-post-readmore ">
                                        <a href="blog-single.html" class="site-button-link site-text-primary">{{ __('lang.welcome_middle_blog_article_button_read') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <!--Block two-->
                            <div class="blog-post twm-blog-post-1-outer">
                                <div class="wt-post-media">
                                    <a href="blog-single.html"><img src="images/blog/latest/bg2.jpg" alt=""></a>
                                </div>
                                <div class="wt-post-info">
                                    <div class="wt-post-meta ">
                                        <ul>
                                            <li class="post-date">მარტი 05, 2022</li>
                                            <li class="post-author"> <a href="candidate-detail.html">David Wish</a></li>
                                        </ul>
                                    </div>
                                    <div class="wt-post-title ">
                                        <h4 class="post-title">
                                            <a href="blog-single.html">შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს და ტიპოგრაფიული ნაწარმის შემქმნელებს.</a>
                                        </h4>
                                    </div>
                                    <div class="wt-post-text ">
                                        <p>
                                            შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს და ტიპოგრაფიული ნაწარმის შემქმნელებს.
                                        </p>
                                    </div>
                                    <div class="wt-post-readmore ">
                                        <a href="blog-single.html" class="site-button-link site-text-primary">სრულად</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <!--Block three-->
                            <div class="blog-post twm-blog-post-1-outer">
                                <div class="wt-post-media">
                                    <a href="blog-single.html"><img src="images/blog/latest/bg3.jpg" alt=""></a>
                                </div>
                                <div class="wt-post-info">
                                    <div class="wt-post-meta ">
                                        <ul>
                                            <li class="post-date">მარტი 05, 2022</li>
                                            <li class="post-author"> <a href="candidate-detail.html">Mike Doe</a></li>
                                        </ul>
                                    </div>
                                    <div class="wt-post-title ">
                                        <h4 class="post-title">
                                            <a href="blog-single.html">შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს და ტიპოგრაფიული ნაწარმის შემქმნელებს.</a>
                                        </h4>
                                    </div>
                                    <div class="wt-post-text ">
                                        <p>
                                            შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს და ტიპოგრაფიული ნაწარმის შემქმნელებს.
                                        </p>
                                    </div>
                                    <div class="wt-post-readmore ">
                                        <a href="blog-single.html" class="site-button-link site-text-primary">სრულად</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <!--Block one-->
                            <div class="blog-post twm-blog-post-1-outer">
                                <div class="wt-post-media">
                                    <a href="blog-single.html"><img src="images/blog/latest/bg1.jpg" alt=""></a>
                                </div>
                                <div class="wt-post-info">
                                    <div class="wt-post-meta ">
                                        <ul>
                                            <li class="post-date">მარტი 05, 2022</li>
                                            <li class="post-author"> <a href="candidate-detail.html">Mark Petter</a></li>
                                        </ul>
                                    </div>
                                    <div class="wt-post-title ">
                                        <h4 class="post-title">
                                            <a href="blog-single.html">შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს და ტიპოგრაფიული ნაწარმის შემქმნელებს.</a>
                                        </h4>
                                    </div>
                                    <div class="wt-post-text ">
                                        <p>
                                            შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს და ტიპოგრაფიული ნაწარმის შემქმნელებს.
                                        </p>
                                    </div>
                                    <div class="wt-post-readmore ">
                                        <a href="blog-single.html" class="site-button-link site-text-primary">სრულად</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <!--Block two-->
                            <div class="blog-post twm-blog-post-1-outer">
                                <div class="wt-post-media">
                                    <a href="blog-single.html"><img src="images/blog/latest/bg2.jpg" alt=""></a>
                                </div>
                                <div class="wt-post-info">
                                    <div class="wt-post-meta ">
                                        <ul>
                                            <li class="post-date">მარტი 05, 2022</li>
                                            <li class="post-author"> <a href="candidate-detail.html">David Wish</a></li>
                                        </ul>
                                    </div>
                                    <div class="wt-post-title ">
                                        <h4 class="post-title">
                                            <a href="blog-single.html">შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს და ტიპოგრაფიული ნაწარმის შემქმნელებს.</a>
                                        </h4>
                                    </div>
                                    <div class="wt-post-text ">
                                        <p>
                                            შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს და ტიპოგრაფიული ნაწარმის შემქმნელებს.
                                        </p>
                                    </div>
                                    <div class="wt-post-readmore ">
                                        <a href="blog-single.html" class="site-button-link site-text-primary">სრულად</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <!--Block three-->
                            <div class="blog-post twm-blog-post-1-outer">
                                <div class="wt-post-media">
                                    <a href="blog-single.html"><img src="images/blog/latest/bg3.jpg" alt=""></a>
                                </div>
                                <div class="wt-post-info">
                                    <div class="wt-post-meta ">
                                        <ul>
                                            <li class="post-date">მარტი 05, 2022</li>
                                            <li class="post-author"> <a href="candidate-detail.html">Mike Doe</a></li>
                                        </ul>
                                    </div>
                                    <div class="wt-post-title ">
                                        <h4 class="post-title">
                                            <a href="blog-single.html">შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს და ტიპოგრაფიული ნაწარმის შემქმნელებს.</a>
                                        </h4>
                                    </div>
                                    <div class="wt-post-text ">
                                        <p>
                                            შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს და ტიპოგრაფიული ნაწარმის შემქმნელებს.
                                        </p>
                                    </div>
                                    <div class="wt-post-readmore ">
                                        <a href="blog-single.html" class="site-button-link site-text-primary">სრულად</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- OUR BLOG END -->

</div>
<!-- CONTENT END -->

@endsection
