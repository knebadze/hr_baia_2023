@extends('layouts.appPage')
@section('title-block')
{{('Candidates')}}
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
                        <h2 class="wt-title">{{ __('lang.candidate_page_big_title') }}</h2>
                    </div>
                </div>
                <!-- BREADCRUMB ROW -->                            
                
                <div>
                    <ul class="wt-breadcrumb breadcrumb-style-2">
                        <li><a href="{{ url ('/') }}">{{ __('lang.candidate_page_small_title_first') }}</a>/ </li>
                        <li>{{ __('lang.candidate_page_small_title_second') }}</li>
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
                                        <h4 class="section-head-small mb-4">{{ __('lang.candidate_page_leftside_category') }}</h4>
                                        <select class="wt-select-bar-large selectpicker"  data-live-search="true" data-bv-field="size">
                                            <option selected>{{ __('lang.candidate_page_leftside_category_allcategory') }}</option>
                                            <option>ძიძა</option>
                                            <option>დამხმარე</option>
                                            <option>მზარეული</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-4 keywordSideBar">
                                        <h4 class="section-head-small mb-4">{{ __('lang.candidate_page_leftside_keyword') }}</h4>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="{{ __('lang.candidate_page_leftside_name_or_keyword') }}">
                                            <button class="btn" type="button"><i class="feather-search"></i></button>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4 locationSideBar">
                                        <h4 class="section-head-small mb-4">{{ __('lang.candidate_page_leftside_location') }}</h4>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="{{ __('lang.candidate_page_leftside_search_location') }}">
                                            <button class="btn" type="button"><i class="feather-map-pin"></i></button>
                                        </div>
                                    </div>

                                    <div class="twm-sidebar-ele-filter jobTypeSideBar">
                                        <h4 class="section-head-small mb-4">{{ __('lang.candidate_page_leftside_type_of_work') }}</h4>
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
                                        <h4 class="section-head-small mb-4">{{ __('lang.candidate_page_leftside_date_of_publication') }}</h4>
                                        <ul>

                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="examplecheckbox6">
                                                    <label class="form-check-label" for="examplecheckbox6">{{ __('lang.candidate_page_leftside_any') }}</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="examplecheckbox1">
                                                    <label class="form-check-label" for="examplecheckbox1">{{ __('lang.candidate_page_leftside_last_24') }}</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="examplecheckbox2">
                                                    <label class="form-check-label" for="examplecheckbox2">{{ __('lang.candidate_page_leftside_last_3') }}</label>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="examplecheckbox3">
                                                    <label class="form-check-label" for="examplecheckbox3">{{ __('lang.candidate_page_leftside_last_7') }}</label>
                                                </div>
                                            </li>
                         
                                        </ul>
                                    </div>

                                    <div class="twm-sidebar-ele-filter sallarySideBar">
                                        <h4 class="section-head-small mb-4">{{ __('lang.candidate_page_leftside_sallary') }}</h4>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="Any1">
                                                    <label class="form-check-label" for="Any1">{{ __('lang.candidate_page_leftside_sallary_any') }}</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="Compensation1">
                                                    <label class="form-check-label" for="Compensation1">{{ __('lang.candidate_page_leftside_sallary_from_500') }}</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="Compensation2">
                                                    <label class="form-check-label" for="Compensation2">{{ __('lang.candidate_page_leftside_sallary_from_700') }}</label>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="Compensation3">
                                                    <label class="form-check-label" for="Compensation3">{{ __('lang.candidate_page_leftside_sallary_from_900') }}</label>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="Other1">
                                                    <label class="form-check-label" for="Other1">{{ __('lang.candidate_page_leftside_sallary_other') }}</label>
                                                </div>
                                            </li>

                                            <div class="twm-sidebar-ele-filter sheduldeSideBar">
                                                <h4 class="section-head-small mb-4">{{ __('lang.candidate_page_leftside_shedulde') }}</h4>
                                                <ul>
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="AnySchedule1">
                                                            <label class="form-check-label" for="AnySchedule1">{{ __('lang.candidate_page_leftside_shedulde_any') }}</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="DaySchedule1">
                                                            <label class="form-check-label" for="DaySchedule1">{{ __('lang.candidate_page_leftside_shedulde_day') }}</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="Compensation2">
                                                            <label class="form-check-label" for="Compensation2">{{ __('lang.candidate_page_leftside_shedulde_night') }}</label>
                                                        </div>
                                                    </li>
        
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="Compensation3">
                                                            <label class="form-check-label" for="Compensation3">{{ __('lang.candidate_page_leftside_shedulde_daily') }}</label>
                                                        </div>
                                                    </li>
        
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="Other1">
                                                            <label class="form-check-label" for="Other1">{{ __('lang.candidate_page_leftside_shedulde_other') }}</label>
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>

                                            <div class="twm-sidebar-ele-filter">
                                                <h4 class="section-head-small mb-4">{{ __('lang.candidate_page_leftside_second_location') }}</h4>
                                                <ul>
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="AnyLocation1">
                                                            <label class="form-check-label" for="AnyLocation1">{{ __('lang.candidate_page_leftside_second_location_any') }}</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="FromLocation1">
                                                            <label class="form-check-label" for="FromLocation1">{{ __('lang.candidate_page_leftside_second_location_3km') }}</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="FromLocation2">
                                                            <label class="form-check-label" for="FromLocation2">{{ __('lang.candidate_page_leftside_second_location_5km') }}</label>
                                                        </div>
                                                    </li>
        
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="FromLocation3">
                                                            <label class="form-check-label" for="FromLocation3">{{ __('lang.candidate_page_leftside_second_location_7km') }}</label>
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>
                         
                                        </ul>
                                    </div>
                                    
                                </form>
                                
                            </div>

                            <div class="widget tw-sidebar-tags-wrap">
                                <h4 class="section-head-small mb-4">{{ __('lang.candidate_page_leftside_tags') }}</h4>
                                
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
                           <p>{{ __('lang.candidate_page_leftside_box_title') }} </p>
                            <a href="about-1.html" class="site-button white">{{ __('lang.candidate_page_leftside_box_read_more') }}</a> 
                        </div>

                    </div>

                    <div class="col-lg-8 col-md-12">
                        <!--Filter Short By-->
                        <div class="product-filter-wrap d-flex justify-content-between align-items-center m-b30">
                            <span class="woocommerce-result-count-left">{{ __('lang.candidate_page_middle_first_title') }}</span>
                           
                            <form class="woocommerce-ordering twm-filter-select" method="get">
                                <span class="woocommerce-result-count">{{ __('lang.candidate_page_middle_title_sort') }}</span>
                                <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="size">
                                    <option>{{ __('lang.candidate_page_middle_latest') }}</option>
                                    <option>{{ __('lang.candidate_page_middle_free_schedule') }}</option>
                                    <option>{{ __('lang.candidate_page_middle_full_time') }}</option>
                                    <option>{{ __('lang.candidate_page_middle_intership') }}</option>
                                    <option>{{ __('lang.candidate_page_middle_half_time') }}</option>
                                    <option>{{ __('lang.candidate_page_middle_temporary') }}</option>
                                </select>
                                <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="size">
                                    <option>{{ __('lang.candidate_page_middle_show_me_10') }}</option>
                                    <option>{{ __('lang.candidate_page_middle_show_me_20') }}</option>
                                    <option>{{ __('lang.candidate_page_middle_show_me_30') }}</option>
                                    <option>{{ __('lang.candidate_page_middle_show_me_40') }}</option>
                                    <option>{{ __('lang.candidate_page_middle_show_me_50') }}</option>
                                    <option>{{ __('lang.candidate_page_middle_show_me_60') }}</option>
                                </select>
                            </form>

                        </div>

                    <div class="twm-candidates-grid-wrap">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                 <div class="twm-candidates-grid-style1 mb-5">
                                     <div class="twm-media">
                                         <div class="twm-media-pic">
                                            <img src="/images/candidates/pic1.jpg" alt="#">
                                         </div>
                                         <div class="twm-candidates-tag"><span>გამორჩეული</span></div>
                                     </div>
                                     <div class="twm-mid-content">
                                         <a href="#" class="twm-job-title">
                                             <h4>გიორგი გიორგაძე </h4>
                                         </a>
                                         <p>ბუღალტერი</p>
                                         <a href="#" class="twm-view-prifile site-text-primary">{{ __('lang.company_vacancies_page_middle_leftside_read_more') }}</a>
                                         
                                         <div class="twm-fot-content">
                                             <div class="twm-left-info">
                                                <p class="twm-candidate-address"><i class="feather-map-pin"></i>თბილისი</p>
                                                <div class="twm-jobs-vacancies">₾20<span>/ დღეში</span></div>
                                             </div>
                                            
                                        </div>
                                     </div>
                                     
                                 </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="twm-candidates-grid-style1 mb-5">
                                    <div class="twm-media">
                                        <div class="twm-media-pic">
                                           <img src="/images/candidates/pic2.jpg" alt="#">
                                        </div>
                                        <div class="twm-candidates-tag"><span>გამორჩეული</span></div>
                                    </div>
                                    <div class="twm-mid-content">
                                        <a href="#" class="twm-job-title">
                                            <h4>პაატა პატარიძე</h4>
                                        </a>
                                        <p>სამედიცინო პროფესიით</p>
                                        <a href="#" class="twm-view-prifile site-text-primary">ნახვა</a>
                                        <div class="twm-fot-content">
                                            <div class="twm-left-info">
                                               <p class="twm-candidate-address"><i class="feather-map-pin"></i>ხაშური</p>
                                               <div class="twm-jobs-vacancies">₾7<span>/ დღეში</span></div>
                                            </div>
                                           
                                       </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="twm-candidates-grid-style1 mb-5">
                                    <div class="twm-media">
                                        <div class="twm-media-pic">
                                           <img src="/images/candidates/pic3.jpg" alt="#">
                                        </div>
                                        <div class="twm-candidates-tag"><span>გამორჩეული</span></div>
                                    </div>
                                    <div class="twm-mid-content">
                                        <a href="#" class="twm-job-title">
                                            <h4>რალფ პეტერსონი</h4>
                                        </a>
                                        <p>ბანკის მენეჯერი</p>
                                        <a href="#" class="twm-view-prifile site-text-primary">ნახვა</a>
                                        <div class="twm-fot-content">
                                            <div class="twm-left-info">
                                               <p class="twm-candidate-address"><i class="feather-map-pin"></i>თბილისი</p>
                                               <div class="twm-jobs-vacancies">₾180<span>/ Day</span></div>
                                            </div>
                                           
                                       </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="twm-candidates-grid-style1 mb-5">
                                    <div class="twm-media">
                                        <div class="twm-media-pic">
                                           <img src="/images/candidates/pic4.jpg" alt="#">
                                        </div>
                                        <div class="twm-candidates-tag"><span>გამორჩეული</span></div>
                                    </div>
                                    <div class="twm-mid-content">
                                        <a href="#" class="twm-job-title">
                                            <h4>გაგა გაგნიძე</h4>
                                        </a>
                                        <p>IT კონტრაქტორი</p>
                                        <a href="#" class="twm-view-prifile site-text-primary">ნახვა</a>
                                        <div class="twm-fot-content">
                                            <div class="twm-left-info">
                                               <p class="twm-candidate-address"><i class="feather-map-pin"></i>ბათუმი</p>
                                               <div class="twm-jobs-vacancies">₾90<span>/ კვირაში</span></div>
                                            </div>
                                          
                                       </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="twm-candidates-grid-style1 mb-5">
                                    <div class="twm-media">
                                        <div class="twm-media-pic">
                                           <img src="/images/candidates/pic5.jpg" alt="#">
                                        </div>
                                        <div class="twm-candidates-tag"><span>გამორჩეული</span></div>
                                    </div>
                                    <div class="twm-mid-content">
                                        <a href="#" class="twm-job-title">
                                            <h4>ჯემალ ჯებეშვილი</h4>
                                        </a>
                                        <p>ციფრული მარკეტინგი</p>
                                        <a href="#" class="twm-view-prifile site-text-primary">ნახვა</a>
                                        <div class="twm-fot-content">
                                            <div class="twm-left-info">
                                               <p class="twm-candidate-address"><i class="feather-map-pin"></i>ქუთაისი</p>
                                               <div class="twm-jobs-vacancies">₾95<span>/ დღეში</span></div>
                                            </div>
                                            
                                       </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="twm-candidates-grid-style1 mb-5">
                                    <div class="twm-media">
                                        <div class="twm-media-pic">
                                           <img src="/images/candidates/pic6.jpg" alt="#">
                                        </div>
                                        <div class="twm-candidates-tag"><span>გამორჩეული</span></div>
                                    </div>
                                    <div class="twm-mid-content">
                                        <a href="#" class="twm-job-title">
                                            <h4>Christina Fischer </h4>
                                        </a>
                                        <p>საქველმოქმედო</p>
                                        <a href="#" class="twm-view-prifile site-text-primary">ნახვა</a>
                                        <div class="twm-fot-content">
                                            <div class="twm-left-info">
                                               <p class="twm-candidate-address"><i class="feather-map-pin"></i>თელავი</p>
                                               <div class="twm-jobs-vacancies">₾19<span>/ საათში</span></div>
                                            </div>
                                            
                                       </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="twm-candidates-grid-style1 mb-5">
                                    <div class="twm-media">
                                        <div class="twm-media-pic">
                                           <img src="/images/candidates/pic7.jpg" alt="#">
                                        </div>
                                        <div class="twm-candidates-tag"><span>გამორჩეული</span></div>
                                    </div>
                                    <div class="twm-mid-content">
                                        <a href="#" class="twm-job-title">
                                            <h4>ვანდა მამისონია</h4>
                                        </a>
                                        <p>მარკეტინგი და პიარი</p>
                                        <a href="#" class="twm-view-prifile site-text-primary">ნახვა</a>
                                        <div class="twm-fot-content">
                                            <div class="twm-left-info">
                                               <p class="twm-candidate-address"><i class="feather-map-pin"></i>ზუგდიდი</p>
                                               <div class="twm-jobs-vacancies">₾12<span>/ დღეში</span></div>
                                            </div>
                                           
                                       </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="twm-candidates-grid-style1 mb-5">
                                    <div class="twm-media">
                                        <div class="twm-media-pic">
                                           <img src="/images/candidates/pic8.jpg" alt="#">
                                        </div>
                                        <div class="twm-candidates-tag"><span>გამორჩეული</span></div>
                                    </div>
                                    <div class="twm-mid-content">
                                        <a href="#" class="twm-job-title">
                                            <h4>პიტერ პეტერსონი</h4>
                                        </a>
                                        <p>საჯარო სექტორი</p>
                                        <a href="#" class="twm-view-prifile site-text-primary">ნახვა</a>
                                        <div class="twm-fot-content">
                                            <div class="twm-left-info">
                                               <p class="twm-candidate-address"><i class="feather-map-pin"></i>ფოთი</p>
                                               <div class="twm-jobs-vacancies">₾7<span>/ საათში</span></div>
                                            </div>
                                       </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="twm-candidates-grid-style1 mb-5">
                                    <div class="twm-media">
                                        <div class="twm-media-pic">
                                           <img src="/images/candidates/pic9.jpg" alt="#">
                                        </div>
                                        <div class="twm-candidates-tag"><span>გამორჩეული</span></div>
                                    </div>
                                    <div class="twm-mid-content">
                                        <a href="#" class="twm-job-title">
                                            <h4>ქეთევან ქეთევანიშვილი</h4>
                                        </a>
                                        <p>გაყიდვები და მარკეტინგი</p>
                                        <a href="#" class="twm-view-prifile site-text-primary">ნახვა</a>
                                        <div class="twm-fot-content">
                                            <div class="twm-left-info">
                                               <p class="twm-candidate-address"><i class="feather-map-pin"></i>მესტია</p>
                                               <div class="twm-jobs-vacancies">₾125<span>/ კვირაში</span></div>
                                            </div>
                                       </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="twm-candidates-grid-style1 mb-5">
                                    <div class="twm-media">
                                        <div class="twm-media-pic">
                                           <img src="/images/candidates/pic10.jpg" alt="#">
                                        </div>
                                        <div class="twm-candidates-tag"><span>გამორჩეული</span></div>
                                    </div>
                                    <div class="twm-mid-content">
                                        <a href="#" class="twm-job-title">
                                            <h4>ხატია ხატიძე</h4>
                                        </a>
                                        <p>მარკეტინგი და გაყიდვები</p>
                                        <a href="#" class="twm-view-prifile site-text-primary">ნახვა</a>
                                        <div class="twm-fot-content">
                                            <div class="twm-left-info">
                                               <p class="twm-candidate-address"><i class="feather-map-pin"></i>თბილისი</p>
                                               <div class="twm-jobs-vacancies">₾125<span>/ კვირაში</span></div>
                                            </div>
                                       </div>
                                    </div>
                                    
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
<!-- CONTENT END -->

</div>
@endsection