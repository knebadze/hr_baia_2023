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
                    <div class="twm-bnr-title-small">{{ __('lang.welcome_leftside_bar_one') }} <span class="site-text-primary">{{ $data['slider']['vacancies'] }}+</span> {{ __('lang.welcome_leftside_bar_two') }}</div>
                    <div class="twm-bnr-title-large">{{ __('lang.welcome_leftside_bar_firstword_one') }}  <span class="site-text-primary">{{ __('lang.welcome_leftside_bar_firstword_two') }}</span> {{ __('lang.welcome_leftside_bar_firstword_three') }}</div>
                    <div class="twm-bnr-discription">{{ __('lang.welcome_leftside_bar_search_title') }}
                    </div>
                    {{-- <test-vue></test-vue> --}}
                    <div class="twm-bnr-search-bar">
                        <form action="{{ route('job.search', ['category_id' => '', 'work_schedule_id' => '', 'address' => '', 'locale' => app()->getLocale()]) }}" method="GET">
                            <div class="row">
                                <!-- Title -->
                                <div class="form-group col-xl-3 col-lg-6 col-md-6">
                                    <label>{{ __('lang.welcome_leftside_bar_search_job_category_job') }}</label>
                                    <select class="wt-search-bar-select" title="" id="j-Job_Title" name="category_id" required>
                                        <option value="">{{ __('lang.welcome_leftside_bar_search_job_select_job_category') }}</option>
                                        @foreach ($data['classificatory']['category'] as $item)
                                            <option value="{{ $item->id }}">{{ $item->{'name_'.app()->getLocale()} }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- All Category -->
                                <div class="form-group col-xl-3 col-lg-6 col-md-6">
                                    <label>{{ __('lang.welcome_leftside_bar_search_job_select_job') }}</label>
                                    <select class="wt-search-bar-select" data-live-search="true" title="" id="j-All_Category" name="work_schedule_id">
                                        <option value="">{{ __('lang.welcome_leftside_bar_search_job_category_job_all_category') }}</option>
                                        @foreach ($data['classificatory']['work_schedule'] as $item)
                                            <option value="{{ $item->id }}">{{ $item->{'name_'.app()->getLocale()} }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Location -->
                                <div class="form-group col-xl-3 col-lg-6 col-md-6">
                                    <label>{{ __('lang.welcome_leftside_bar_search_job_location_job') }}</label>
                                    <div class="twm-inputicon-box">
                                        <input type="text" class="form-control" placeholder="{{ __('lang.welcome_leftside_bar_search_job_location_job_search') }}" name="address">
                                        <i class="twm-input-icon fas fa-map-marker-alt"></i>
                                    </div>
                                </div>

                                <!-- Find job btn -->
                                <div class="form-group col-xl-3 col-lg-6 col-md-6">
                                    <button type="submit" class="site-button">{{ __('lang.welcome_leftside_bar_search_job_location_job_search_button') }}</button>
                                </div>
                            </div>
                        </form>

                    </div>

                    <div class="twm-bnr-popular-search">
                        <span class="twm-title">{{ __('lang.welcome_leftside_bar_popular') }}:</span>
                        @foreach ($data['popularCategories'] as $item)
                        <a href="{{ route('job.search' , ['category_id' => $item->id, 'locale' => app()->getLocale()])  }}">{{ $item->{'name_'.app()->getLocale()} }}</a>,
                        @endforeach...
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
                                {{-- <div class="slide-img"> --}}
                                    <img src="images/main-slider/slider1/r-img2.png" alt="#">
                                {{-- </div> --}}
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
                                        <span>{{($data['slider']['vacancies'] -  $data['slider']['familyVacancy'] <= 0)?10:$data['slider']['vacancies'] -  $data['slider']['familyVacancy'] }}</span>
                                        {{-- <span class="counter">12</span>K+ --}}
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
                                        <span>{{ $data['slider']['familyVacancy'] }}</span>
                                        {{-- <span class="counter">{{ $data['slider']['familyVacancy'] }}</span> + --}}
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
                                        <span>{{ $data['slider']['candidateCount'] }}</span>
                                        {{-- <span class="counter">31</span>K+ --}}
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


                        <category-carousel :data='@json($data['categoriesWithVacancies'])'></category-carousel>
                </div>

                <div class="text-right job-categories-btn">
                    <a href="{{ route('job' , App()->getLocale()) }}" class=" site-button">{{ __('lang.welcome_middle_submit') }}</a>
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

                    <category-carousel :data='@json($data['categoriesWithCandidates'])'></category-carousel>

                </div>

                <div class="text-right job-categories-btn">
                    <a href="{{ route('candidate' , App()->getLocale())  }}" class=" site-button">{{ __('lang.welcome_middle_submit_candidate') }}</a>
                </div>

            </div>

        </div>

    </div>
      <!-- JOB POST START -->
    <div class="section-full p-t120 p-b90 site-bg-light-purple twm-bg-ring-wrap">
        <div class="twm-bg-ring-right"></div>
        <div class="twm-bg-ring-left"></div>
        <div class="container">

            <!-- TITLE START-->
            <div class="section-head center wt-small-separator-outer">
                <div class="wt-small-separator site-text-primary">
                   <div>{{ __('lang.welcome_current_vacancies_title') }}</div>
                </div>
                <h2 class="wt-title">{{ __('lang.welcome_popular_vacancies_title') }}</h2>
            </div>
            <!-- TITLE END-->


            <div class="section-content">
               <div class="twm-jobs-list-wrap">
                   <ul>
                    <popular-vacancy :items='@json($data['popularVacancy'])' :auth='@json($auth)'></popular-vacancy>
                        {{-- <li>
                            <div class="twm-jobs-list-style1 mb-5">
                                <div class="twm-media">
                                    <img src="images/jobs-company/pic1.jpg" alt="#">
                                </div>
                                <div class="twm-mid-content">
                                    <a href="job-detail.html" class="twm-job-title">
                                        <h4>Senior Web Designer , Developer  <span class="twm-job-post-duration">/ 1 days ago</span></h4>
                                    </a>
                                    <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                    <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                </div>
                                <div class="twm-right-content">
                                    <div class="twm-jobs-category green"><span class="twm-bg-green">New</span></div>
                                    <div class="twm-jobs-amount">$2500 <span>/ Month</span></div>
                                    <a href="job-detail.html" class="twm-jobs-browse site-text-primary">Browse Job</a>
                                </div>
                            </div>
                        </li> --}}

                   </ul>
                   <div class="text-center m-b30">
                        <a href="job-list.html" class=" site-button">{{ __('lang.welcome_current_vacancies_button') }}</a>
                   </div>
               </div>
            </div>

        </div>
    </div>
    <!-- JOB POST END -->

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

                        {{-- <div class="owl-carousel twm-testimonial-1-carousel owl-btn-bottom-center "> --}}
                            <testimonial-carousel :data='@json($data['testimonial'])'></testimonial-carousel>
                            <!-- COLUMNS 1 -->
                            {{-- <div class="item ">
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
                            </div> --}}

                            <!-- COLUMNS 2 -->
                            {{-- <div class="item ">
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
                            </div> --}}

                            <!-- COLUMNS 3 -->
                            {{-- <div class="item ">
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
                            </div> --}}


                        {{-- </div> --}}

                    </div>
                </div>

            </div>
            <!-- TESTIMONIAL SECTION END -->

    <!-- OUR BLOG START -->
    {{-- <div class="section-full p-t120 p-b90 site-bg-gray">
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
    </div> --}}
    <!-- OUR BLOG END -->

</div>
<!-- CONTENT END -->

@endsection
