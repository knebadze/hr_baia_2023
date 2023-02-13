@extends('layouts.appPage')
@section('title-block')
@section('title-block')
   {{ __('lang.page_title_individual') }}
@endsection
@endsection
@section('content')
<!-- CONTENT START -->
    <div class="page-content">

        <!-- INNER PAGE BANNER -->
        <div class="wt-bnr-inr overlay-wraper bg-center" style="background-image:url(//images/banner/1.jpg);">
            <div class="overlay-main site-bg-white opacity-01"></div>
            <div class="container">
                <div class="wt-bnr-inr-entry">
                    <div class="banner-title-outer">
                        <div class="banner-title-name">
                            <h2 class="wt-title">{{ __('lang.individual_vacancies_page_big_title') }}</h2>
                        </div>
                    </div>
                    <!-- BREADCRUMB ROW -->                            
                    
                        <div>
                            <ul class="wt-breadcrumb breadcrumb-style-2">
                                <li><a href="{{ url ('/') }}">{{ __('lang.individual_vacancies_page_small_title_first') }}/ </a> </li>
                                <li> {{ __('lang.individual_vacancies_page_small_title_second') }}</li>
                            </ul>
                        </div>
                    
                    <!-- BREADCRUMB ROW END -->                        
                </div>
            </div>
        </div>
        <!-- INNER PAGE BANNER END -->


        <!-- OUR BLOG START -->
        <div class="section-full p-t120  p-b90 site-bg-white">
            

            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-4 col-md-12 rightSidebar">

                        <div class="side-bar">

                            <div class="sidebar-elements search-bx">
                                                                        
                                <form>

                                    <div class="form-group mb-4 categorySideBar">
                                        <h4 class="section-head-small mb-4">{{ __('lang.individual_vacancies_page_leftside_category') }}</h4>
                                        <select class="wt-select-bar-large selectpicker"  data-live-search="true" data-bv-field="size">
                                            <option selected>{{ __('lang.individual_vacancies_page_leftside_category_allcategory') }}</option>
                                            <option>ძიძა</option>
                                            <option>დამხმარე</option>
                                            <option>მზარეული</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-4 keywordSideBar">
                                        <h4 class="section-head-small mb-4">{{ __('lang.individual_vacancies_page_leftside_keyword') }}</h4>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="{{ __('lang.individual_vacancies_page_leftside_name_or_keyword') }}">
                                            <button class="btn" type="button"><i class="feather-search"></i></button>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4 locationSideBar">
                                        <h4 class="section-head-small mb-4">{{ __('lang.individual_vacancies_page_leftside_location') }}</h4>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="{{ __('lang.individual_vacancies_page_leftside_search_location') }}">
                                            <button class="btn" type="button"><i class="feather-map-pin"></i></button>
                                        </div>
                                    </div>

                                    <div class="twm-sidebar-ele-filter jobTypeSideBar">
                                        <h4 class="section-head-small mb-4">{{ __('lang.individual_vacancies_page_leftside_type_of_work') }}</h4>
                                        <ul>
                                            <li>
                                                <div class=" form-check">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                    <label class="form-check-label" for="exampleCheck1">თავისუფალი</label>
                                                </div>
                                                <span class="twm-job-type-count">09</span>
                                            </li>

                                            <li>
                                                <div class=" form-check">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                                    <label class="form-check-label" for="exampleCheck2">სრული განაკვეთი</label>
                                                </div>
                                                <span class="twm-job-type-count">07</span>
                                            </li>

                                            <li>
                                                <div class=" form-check">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck3">
                                                    <label class="form-check-label" for="exampleCheck3">სტაჟირება</label>
                                                </div>
                                                <span class="twm-job-type-count">15</span>
                                            </li>

                                            <li>
                                                <div class=" form-check">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck4">
                                                    <label class="form-check-label" for="exampleCheck4">ნახევარი განაკვეთი</label>
                                                </div>
                                                <span class="twm-job-type-count">20</span>
                                            </li>

                                            <li>
                                                <div class=" form-check">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck5">
                                                    <label class="form-check-label" for="exampleCheck5">დროებითი</label>
                                                </div>
                                                <span class="twm-job-type-count">22</span>
                                            </li>

                                            <li>
                                                <div class=" form-check">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck6">
                                                    <label class="form-check-label" for="exampleCheck6">მოხალისე</label>
                                                </div>
                                                <span class="twm-job-type-count">25</span>
                                            </li>

                                        </ul>
                                    </div>

                                    <div class="twm-sidebar-ele-filter publicationSideBar">
                                        <h4 class="section-head-small mb-4">{{ __('lang.individual_vacancies_page_leftside_date_of_publication') }}</h4>
                                        <ul>

                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="exampleradio6">
                                                    <label class="form-check-label" for="exampleradio6">{{ __('lang.individual_vacancies_page_leftside_any') }}</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="exampleradio1">
                                                    <label class="form-check-label" for="exampleradio1">{{ __('lang.individual_vacancies_page_leftside_last_24') }}</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="exampleradio2">
                                                    <label class="form-check-label" for="exampleradio2">{{ __('lang.individual_vacancies_page_leftside_last_3') }}</label>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="exampleradio3">
                                                    <label class="form-check-label" for="exampleradio3">{{ __('lang.individual_vacancies_page_leftside_last_7') }}</label>
                                                </div>
                                            </li>
                         
                                        </ul>
                                    </div>

                                    <div class="twm-sidebar-ele-filter sallarySideBar">
                                        <h4 class="section-head-small mb-4">{{ __('lang.individual_vacancies_page_leftside_sallary') }}</h4>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="Any1">
                                                    <label class="form-check-label" for="Any1">{{ __('lang.individual_vacancies_page_leftside_sallary_any') }}</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="Compensation1">
                                                    <label class="form-check-label" for="Compensation1">{{ __('lang.individual_vacancies_page_leftside_sallary_from_500') }}</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="Compensation2">
                                                    <label class="form-check-label" for="Compensation2">{{ __('lang.individual_vacancies_page_leftside_sallary_from_700') }}</label>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="Compensation3">
                                                    <label class="form-check-label" for="Compensation3">{{ __('lang.individual_vacancies_page_leftside_sallary_from_900') }}</label>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="Other1">
                                                    <label class="form-check-label" for="Other1">{{ __('lang.individual_vacancies_page_leftside_sallary_other') }}</label>
                                                </div>
                                            </li>

                                            <div class="twm-sidebar-ele-filter sheduldeSideBar">
                                                <h4 class="section-head-small mb-4">{{ __('lang.individual_vacancies_page_leftside_shedulde') }}</h4>
                                                <ul>
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="AnySchedule1">
                                                            <label class="form-check-label" for="AnySchedule1">{{ __('lang.individual_vacancies_page_leftside_shedulde_any') }}</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="DaySchedule1">
                                                            <label class="form-check-label" for="DaySchedule1">{{ __('lang.individual_vacancies_page_leftside_shedulde_day') }}</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="Compensation2">
                                                            <label class="form-check-label" for="Compensation2">{{ __('lang.individual_vacancies_page_leftside_shedulde_night') }}</label>
                                                        </div>
                                                    </li>
        
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="Compensation3">
                                                            <label class="form-check-label" for="Compensation3">{{ __('lang.individual_vacancies_page_leftside_shedulde_daily') }}</label>
                                                        </div>
                                                    </li>
        
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="Other1">
                                                            <label class="form-check-label" for="Other1">{{ __('lang.individual_vacancies_page_leftside_shedulde_other') }}</label>
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>

                                            <div class="twm-sidebar-ele-filter">
                                                <h4 class="section-head-small mb-4">{{ __('lang.individual_vacancies_page_leftside_second_location') }}</h4>
                                                <ul>
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="AnyLocation1">
                                                            <label class="form-check-label" for="AnyLocation1">{{ __('lang.individual_vacancies_page_leftside_second_location_any') }}</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="FromLocation1">
                                                            <label class="form-check-label" for="FromLocation1">{{ __('lang.individual_vacancies_page_leftside_second_location_3km') }}</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="FromLocation2">
                                                            <label class="form-check-label" for="FromLocation2">{{ __('lang.individual_vacancies_page_leftside_second_location_5km') }}</label>
                                                        </div>
                                                    </li>
        
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="FromLocation3">
                                                            <label class="form-check-label" for="FromLocation3">{{ __('lang.individual_vacancies_page_leftside_second_location_7km') }}</label>
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>
                         
                                        </ul>
                                    </div>
                                    
                                </form>
                                
                            </div>

                            <div class="widget tw-sidebar-tags-wrap">
                                <h4 class="section-head-small mb-4">{{ __('lang.individual_vacancies_page_leftside_tags') }}</h4>
                                
                                <div class="tagcloud">
                                    <a href="job-list.html">ვაკანსია </a>
                                    <a href="job-list.html">გადახდა</a>                                            
                                    <a href="job-list.html">განაცხადი </a>
                                    <a href="job-list.html">სამუშაო</a>
                                    <a href="job-list.html">დაქირავება</a>
                                    <a href="job-list.html">დამსაქმებელი</a>
                                    <a href="job-list.html">შემოსავალი</a>
                                    <a href="job-list.html">რჩევები</a>
                                </div>
                            </div>

                            
                        </div>

                        <div class="twm-advertisment" style="background-image:url(/images/add-bg.jpg);">
                           <div class="overlay"></div>
                           <p>{{ __('lang.individual_vacancies_page_leftside_box_title') }} </p>
                            <a href="about-1.html" class="site-button white">{{ __('lang.individual_vacancies_page_leftside_box_read_more') }}</a> 
                        </div>

                    </div>

                    <div class="col-lg-8 col-md-12">
                        <!--Filter Short By-->
                        <div class="product-filter-wrap d-flex justify-content-between align-items-center m-b30">
                            <span class="woocommerce-result-count-left">{{ __('lang.individual_vacancies_page_middle_first_title') }}</span>
                           
                            <form class="woocommerce-ordering twm-filter-select" method="get">
                                <span class="woocommerce-result-count">{{ __('lang.individual_vacancies_page_middle_title_sort') }}</span>
                                <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="size">
                                    <option>{{ __('lang.individual_vacancies_page_middle_latest') }}</option>
                                    <option>{{ __('lang.individual_vacancies_page_middle_free_schedule') }}</option>
                                    <option>{{ __('lang.individual_vacancies_page_middle_full_time') }}</option>
                                    <option>{{ __('lang.individual_vacancies_page_middle_intership') }}</option>
                                    <option>{{ __('lang.individual_vacancies_page_middle_half_time') }}</option>
                                    <option>{{ __('lang.individual_vacancies_page_middle_temporary') }}</option>
                                </select>
                                <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="size">
                                    <option>{{ __('lang.individual_vacancies_page_middle_show_me_10') }}</option>
                                    <option>{{ __('lang.individual_vacancies_page_middle_show_me_20') }}</option>
                                    <option>{{ __('lang.individual_vacancies_page_middle_show_me_30') }}</option>
                                    <option>{{ __('lang.individual_vacancies_page_middle_show_me_40') }}</option>
                                    <option>{{ __('lang.individual_vacancies_page_middle_show_me_50') }}</option>
                                    <option>{{ __('lang.individual_vacancies_page_middle_show_me_60') }}</option>
                                </select>
                            </form>

                        </div>

                        <div class="row">
                            <!--Block one-->
                            <div class="col-lg-6 col-md-12 m-b30">

                                <div class="twm-jobs-grid-style1">
                                    <div class="twm-media">
                                        <img src="/images/jobs-company/pic1.jpg" alt="#">
                                    </div>
                                    <span class="twm-job-post-duration">1 დღის წინ</span>
                                    <div class="twm-jobs-category green"><span class="twm-bg-green">ახალი</span></div>
                                    <div class="twm-mid-content">
                                        <a href="job-detail.html" class="twm-job-title">
                                            <h4>Senior Web Designer , Developer</h4>
                                        </a>
                                        <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                        <a href="#" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                    </div>
                                    <div class="twm-right-content">
                                        
                                        <div class="twm-jobs-amount">₾2500 <span>/ თვეში</span></div>
                                        <a href="job-detail.html" class="twm-jobs-browse site-text-primary">{{ __('lang.individual_vacancies_page_middle_leftside_read_more') }}<</a>
                                    </div>
                                </div>

                            </div>
                            
                            <!--Block two-->
                            <div class="col-lg-6 col-md-12 m-b30">

                                <div class="twm-jobs-grid-style1">
                                    <div class="twm-media">
                                        <img src="/images/jobs-company/pic2.jpg" alt="#">
                                    </div>
                                    <span class="twm-job-post-duration">15 დღის წინ</span>
                                    <div class="twm-jobs-category green"><span class="twm-bg-brown">სტაჟირება</span></div>
                                    <div class="twm-mid-content">
                                        <a href="job-detail.html" class="twm-job-title">
                                            <h4>Senior Rolling Stock Technician</h4>
                                        </a>
                                        <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                        <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                    </div>
                                    <div class="twm-right-content">
                                        <div class="twm-jobs-amount">₾7 <span>/ საათში</span></div>
                                        <a href="job-detail.html" class="twm-jobs-browse site-text-primary">სრულად</a>
                                    </div>
                                </div>

                            </div>
                            
                            <!--Block three-->
                            <div class="col-lg-6 col-md-12 m-b30">
                                
                                <div class="twm-jobs-grid-style1">
                                    <div class="twm-media">
                                        <img src="/images/jobs-company/pic3.jpg" alt="#">
                                    </div>
                                    <span class="twm-job-post-duration">6 თვის წინ</span>
                                    <div class="twm-jobs-category green"><span class="twm-bg-purple">სრული</span></div>
                                    <div class="twm-mid-content">
                                        <a href="job-detail.html" class="twm-job-title">
                                            <h4 class="twm-job-title">IT Department Manager</h4>
                                        </a>
                                        <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                        <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                    </div>
                                    <div class="twm-right-content">
                                        
                                        <div class="twm-jobs-amount">₾2500 <span>/ თვეში</span></div>
                                        <a href="job-detail.html" class="twm-jobs-browse site-text-primary">სრულად</a>
                                    </div>
                                </div> 
                                 
                            </div>
                            
                             <!--Block Four-->
                            <div class="col-lg-6 col-md-12 m-b30">

                                <div class="twm-jobs-grid-style1">
                                    <div class="twm-media">
                                        <img src="/images/jobs-company/pic4.jpg" alt="#">
                                    </div>
                                    <span class="twm-job-post-duration">2 დღის წინ</span>
                                    <div class="twm-jobs-category green"><span class="twm-bg-sky">თავისუფალი</span></div>
                                    <div class="twm-mid-content">
                                        <a href="job-detail.html" class="twm-job-title">
                                            <h4 class="twm-job-title">Art Production Specialist</h4>
                                        </a>
                                        <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                        <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                    </div>
                                    <div class="twm-right-content">
                                        
                                        <div class="twm-jobs-amount">₾1800 <span>/ თვეში</span></div>
                                        <a href="job-detail.html" class="twm-jobs-browse site-text-primary">სრულად</a>
                                    </div>
                                </div>

                            </div>
                            
                            <!--Block Five-->
                            <div class="masonry-item col-lg-6 col-md-12 m-b30">
                                
                                <div class="twm-jobs-grid-style1">
                                    <div class="twm-media">
                                        <img src="/images/jobs-company/pic5.jpg" alt="#">
                                    </div>
                                    <span class="twm-job-post-duration">1 დღის წინ</span>
                                    <div class="twm-jobs-category green"><span class="twm-bg-golden">დროებითი</span></div>
                                    <div class="twm-mid-content">
                                        <a href="job-detail.html" class="twm-job-title">
                                            <h4 class="twm-job-title">Recreation &amp; Fitness Worker</h4>
                                        </a>
                                        <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                        <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                    </div>
                                    <div class="twm-right-content">
                                        <div class="twm-jobs-amount">₾1000 <span>/ თვეში</span></div>
                                        <a href="job-detail.html" class="twm-jobs-browse site-text-primary">სრულად</a>
                                    </div>
                                </div>

                            </div>
                            
                            <!--Block Six-->
                            <div class="masonry-item col-lg-6 col-md-12 m-b30">
                                <div class="twm-jobs-grid-style1">
                                    <div class="twm-media">
                                        <img src="/images/jobs-company/pic1.jpg" alt="#">
                                    </div>
                                    <span class="twm-job-post-duration">1 დძღის წინ</span>
                                    <div class="twm-jobs-category green"><span class="twm-bg-green">ახალი</span></div>
                                    <div class="twm-mid-content">
                                        <a href="job-detail.html" class="twm-job-title">
                                            <h4>Senior Web Designer , Developer</h4>
                                        </a>
                                        <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                        <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                    </div>
                                    <div class="twm-right-content">
                                        
                                        <div class="twm-jobs-amount">₾19 <span>/ საათში</span></div>
                                        <a href="job-detail.html" class="twm-jobs-browse site-text-primary">სრულად</a>
                                    </div>
                                </div>
                            </div>

                            <!--Block Seven-->
                            <div class="col-lg-6 col-md-12 m-b30">

                                <div class="twm-jobs-grid-style1">
                                    <div class="twm-media">
                                        <img src="/images/jobs-company/pic1.jpg" alt="#">
                                    </div>
                                    <span class="twm-job-post-duration">1 დღის წინ</span>
                                    <div class="twm-jobs-category green"><span class="twm-bg-green">ახალი</span></div>
                                    <div class="twm-mid-content">
                                        <a href="job-detail.html" class="twm-job-title">
                                            <h4>Senior Web Designer , Developer</h4>
                                        </a>
                                        <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                        <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                    </div>
                                    <div class="twm-right-content">
                                        
                                        <div class="twm-jobs-amount">₾2500 <span>/ თვეში</span></div>
                                        <a href="job-detail.html" class="twm-jobs-browse site-text-primary">სრულად</a>
                                    </div>
                                </div>

                            </div>
                            
                            <!--Block Eight-->
                            <div class="col-lg-6 col-md-12 m-b30">

                                <div class="twm-jobs-grid-style1">
                                    <div class="twm-media">
                                        <img src="/images/jobs-company/pic2.jpg" alt="#">
                                    </div>
                                    <span class="twm-job-post-duration">15 დღის წინ</span>
                                    <div class="twm-jobs-category green"><span class="twm-bg-brown">სტაჟირება</span></div>
                                    <div class="twm-mid-content">
                                        <a href="job-detail.html" class="twm-job-title">
                                            <h4>Senior Rolling Stock Technician</h4>
                                        </a>
                                        <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                        <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                    </div>
                                    <div class="twm-right-content">
                                        <div class="twm-jobs-amount">₾7 <span>/ საათში</span></div>
                                        <a href="job-detail.html" class="twm-jobs-browse site-text-primary">სრულად</a>
                                    </div>
                                </div>

                            </div>
                            
                            <!--Block Nine-->
                            <div class="col-lg-6 col-md-12 m-b30">
                                
                                <div class="twm-jobs-grid-style1">
                                    <div class="twm-media">
                                        <img src="/images/jobs-company/pic3.jpg" alt="#">
                                    </div>
                                    <span class="twm-job-post-duration">6 თვის წინ</span>
                                    <div class="twm-jobs-category green"><span class="twm-bg-purple">სრული</span></div>
                                    <div class="twm-mid-content">
                                        <a href="job-detail.html" class="twm-job-title">
                                            <h4 class="twm-job-title">IT Department Manager</h4>
                                        </a>
                                        <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                        <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                    </div>
                                    <div class="twm-right-content">
                                        
                                        <div class="twm-jobs-amount">₾2500 <span>/ თვეში</span></div>
                                        <a href="job-detail.html" class="twm-jobs-browse site-text-primary">სრულად</a>
                                    </div>
                                </div> 
                                 
                            </div>
                            
                             <!--Block ten-->
                            <div class="col-lg-6 col-md-12 m-b30">

                                <div class="twm-jobs-grid-style1">
                                    <div class="twm-media">
                                        <img src="/images/jobs-company/pic4.jpg" alt="#">
                                    </div>
                                    <span class="twm-job-post-duration">2 დღის წინ</span>
                                    <div class="twm-jobs-category green"><span class="twm-bg-sky">თავისუფალი</span></div>
                                    <div class="twm-mid-content">
                                        <a href="job-detail.html" class="twm-job-title">
                                            <h4 class="twm-job-title">Art Production Specialist</h4>
                                        </a>
                                        <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                        <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                    </div>
                                    <div class="twm-right-content">
                                        
                                        <div class="twm-jobs-amount">₾1800 <span>/ თვეში</span></div>
                                        <a href="job-detail.html" class="twm-jobs-browse site-text-primary">სრულად</a>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="pagination-outer">
                            <div class="pagination-style1">
                                <ul class="clearfix">
                                    <li class="prev"><a href="javascript:;"><span> <i class="fa fa-angle-left"></i> </span></a></li>
                                    <li><a href="javascript:;">1</a></li>
                                    <li class="active"><a href="javascript:;">2</a></li>
                                    <li><a href="javascript:;">3</a></li>
                                    <li><a class="javascript:;" href="javascript:;"><i class="fa fa-ellipsis-h"></i></a></li>
                                    <li><a href="javascript:;">5</a></li>
                                    <li class="next"><a href="javascript:;"><span> <i class="fa fa-angle-right"></i> </span></a></li>
                                </ul>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>   
        <!-- OUR BLOG END -->
    </div>

 </div>

@endsection