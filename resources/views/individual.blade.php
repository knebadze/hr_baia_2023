@extends('layouts.appPage')
@section('title-block')
{{('Individual Vacancies')}}
@endsection
@section('content')
<!-- CONTENT START -->
    <div class="page-content">

        <!-- INNER PAGE BANNER -->
        <div class="wt-bnr-inr overlay-wraper bg-center" style="background-image:url(images/banner/1.jpg);">
            <div class="overlay-main site-bg-white opacity-01"></div>
            <div class="container">
                <div class="wt-bnr-inr-entry">
                    <div class="banner-title-outer">
                        <div class="banner-title-name">
                            <h2 class="wt-title">ყველაზე პოპულარული ვაკანსიები</h2>
                        </div>
                    </div>
                    <!-- BREADCRUMB ROW -->                            
                    
                        <div>
                            <ul class="wt-breadcrumb breadcrumb-style-2">
                                <li><a href="{{ url ('/') }}">მთავარი / </a></li>
                                <li>ინდივიდუალური ვაკანსიები</li>
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
                                        <h4 class="section-head-small mb-4">კატეგორია</h4>
                                        <select class="wt-select-bar-large selectpicker"  data-live-search="true" data-bv-field="size">
                                            <option selected>ყველა კატეგორია</option>
                                            <option>ძიძა</option>
                                            <option>დამხმარე</option>
                                            <option>მზარეული</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-4 keywordSideBar">
                                        <h4 class="section-head-small mb-4">საკვანძო სიტყვა</h4>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="დასახელება ან საკვანძო სიტყვა">
                                            <button class="btn" type="button"><i class="feather-search"></i></button>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4 locationSideBar">
                                        <h4 class="section-head-small mb-4">ლოკაცია</h4>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="ლოკაციის ძებნა">
                                            <button class="btn" type="button"><i class="feather-map-pin"></i></button>
                                        </div>
                                    </div>

                                    <div class="twm-sidebar-ele-filter jobTypeSideBar">
                                        <h4 class="section-head-small mb-4">სამუშაოს ტიპი</h4>
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
                                        <h4 class="section-head-small mb-4">გამოქვეყნების თარიღი</h4>
                                        <ul>

                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="exampleradio6">
                                                    <label class="form-check-label" for="exampleradio6">ნებისმიერი</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="exampleradio1">
                                                    <label class="form-check-label" for="exampleradio1">ბოლო 24 საათში</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="exampleradio2">
                                                    <label class="form-check-label" for="exampleradio2">ბოლო 3 დღეში</label>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="exampleradio3">
                                                    <label class="form-check-label" for="exampleradio3">ბოლო 7 დღეში</label>
                                                </div>
                                            </li>
                         
                                        </ul>
                                    </div>

                                    <div class="twm-sidebar-ele-filter sallarySideBar">
                                        <h4 class="section-head-small mb-4">ანაზღაურება</h4>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="Any1">
                                                    <label class="form-check-label" for="Any1">ნებისმიერი</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="Compensation1">
                                                    <label class="form-check-label" for="Compensation1">500₾-დან</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="Compensation2">
                                                    <label class="form-check-label" for="Compensation2">700₾-დან</label>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="Compensation3">
                                                    <label class="form-check-label" for="Compensation3">900₾-დან</label>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="Other1">
                                                    <label class="form-check-label" for="Other1">სხვა</label>
                                                </div>
                                            </li>

                                            <div class="twm-sidebar-ele-filter sheduldeSideBar">
                                                <h4 class="section-head-small mb-4">გრაფიკი</h4>
                                                <ul>
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="AnySchedule1">
                                                            <label class="form-check-label" for="AnySchedule1">ნებისმიერი</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="DaySchedule1">
                                                            <label class="form-check-label" for="DaySchedule1">დღის გრაფიკი</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="Compensation2">
                                                            <label class="form-check-label" for="Compensation2">ღამის გრაფიკი</label>
                                                        </div>
                                                    </li>
        
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="Compensation3">
                                                            <label class="form-check-label" for="Compensation3">სადღეღამისო</label>
                                                        </div>
                                                    </li>
        
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="Other1">
                                                            <label class="form-check-label" for="Other1">სხვა</label>
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>

                                            <div class="twm-sidebar-ele-filter">
                                                <h4 class="section-head-small mb-4">ლოკაცია</h4>
                                                <ul>
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="AnyLocation1">
                                                            <label class="form-check-label" for="AnyLocation1">ნებისმიერი</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="FromLocation1">
                                                            <label class="form-check-label" for="FromLocation1">თქვენგან 3 კმ-ში</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="FromLocation2">
                                                            <label class="form-check-label" for="FromLocation2">თქვენგან 5 კმ-ში</label>
                                                        </div>
                                                    </li>
        
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="FromLocation3">
                                                            <label class="form-check-label" for="FromLocation3">თქვენგან 7 კმ-ში</label>
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>
                         
                                        </ul>
                                    </div>
                                    
                                </form>
                                
                            </div>

                            <div class="widget tw-sidebar-tags-wrap">
                                <h4 class="section-head-small mb-4">Tags</h4>
                                
                                <div class="tagcloud">
                                    <a href="job-list.html">General</a>
                                    <a href="job-list.html">Jobs </a>
                                    <a href="job-list.html">Payment</a>                                            
                                    <a href="job-list.html">Application </a>
                                    <a href="job-list.html">Work</a>
                                    <a href="job-list.html">Recruiting</a>
                                    <a href="job-list.html">Employer</a>
                                    <a href="job-list.html">Income</a>
                                    <a href="job-list.html">Tips</a>
                                </div>
                            </div>

                            
                        </div>

                        <div class="twm-advertisment" style="background-image:url(images/add-bg.jpg);">
                           <div class="overlay"></div>
                           <h4 class="twm-title">Recruiting?</h4>
                           <p>Get Best Matched Jobs On your <br>
                            Email. Add Resume NOW!</p>
                            <a href="about-1.html" class="site-button white">Read More</a> 
                        </div>

                    </div>

                    <div class="col-lg-8 col-md-12">
                        <!--Filter Short By-->
                        <div class="product-filter-wrap d-flex justify-content-between align-items-center m-b30">
                            <span class="woocommerce-result-count-left">Showing 2,150 jobs</span>
                           
                            <form class="woocommerce-ordering twm-filter-select" method="get">
                                <span class="woocommerce-result-count">Short By</span>
                                <select class="wt-select-bar-2 selectpicker"  data-live-search="true" data-bv-field="size">
                                    <option>Most Recent</option>
                                    <option>Freelance</option>
                                    <option>Full Time</option>
                                    <option>Internship</option>
                                    <option>Part Time</option>
                                    <option>Temporary</option>
                                </select>
                                <select class="wt-select-bar-2 selectpicker"  data-live-search="true" data-bv-field="size">
                                    <option>Show 10</option>
                                    <option>Show 20</option>
                                    <option>Show 30</option>
                                    <option>Show 40</option>
                                    <option>Show 50</option>
                                    <option>Show 60</option>
                                </select>
                            </form>

                        </div>

                        <div class="row">
                            <!--Block one-->
                            <div class="col-lg-6 col-md-12 m-b30">

                                <div class="twm-jobs-grid-style1">
                                    <div class="twm-media">
                                        <img src="images/jobs-company/pic1.jpg" alt="#">
                                    </div>
                                    <span class="twm-job-post-duration">1 days ago</span>
                                    <div class="twm-jobs-category green"><span class="twm-bg-green">New</span></div>
                                    <div class="twm-mid-content">
                                        <a href="job-detail.html" class="twm-job-title">
                                            <h4>Senior Web Designer , Developer</h4>
                                        </a>
                                        <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                        <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                    </div>
                                    <div class="twm-right-content">
                                        
                                        <div class="twm-jobs-amount">$2500 <span>/ Month</span></div>
                                        <a href="job-detail.html" class="twm-jobs-browse site-text-primary">Browse Job</a>
                                    </div>
                                </div>

                            </div>
                            
                            <!--Block two-->
                            <div class="col-lg-6 col-md-12 m-b30">

                                <div class="twm-jobs-grid-style1">
                                    <div class="twm-media">
                                        <img src="images/jobs-company/pic2.jpg" alt="#">
                                    </div>
                                    <span class="twm-job-post-duration">15 days ago</span>
                                    <div class="twm-jobs-category green"><span class="twm-bg-brown">Intership</span></div>
                                    <div class="twm-mid-content">
                                        <a href="job-detail.html" class="twm-job-title">
                                            <h4>Senior Rolling Stock Technician</h4>
                                        </a>
                                        <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                        <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                    </div>
                                    <div class="twm-right-content">
                                        <div class="twm-jobs-amount">$7 <span>/ Hour</span></div>
                                        <a href="job-detail.html" class="twm-jobs-browse site-text-primary">Browse Job</a>
                                    </div>
                                </div>

                            </div>
                            
                            <!--Block three-->
                            <div class="col-lg-6 col-md-12 m-b30">
                                
                                <div class="twm-jobs-grid-style1">
                                    <div class="twm-media">
                                        <img src="images/jobs-company/pic3.jpg" alt="#">
                                    </div>
                                    <span class="twm-job-post-duration">6 Month ago</span>
                                    <div class="twm-jobs-category green"><span class="twm-bg-purple">Fulltime</span></div>
                                    <div class="twm-mid-content">
                                        <a href="job-detail.html" class="twm-job-title">
                                            <h4 class="twm-job-title">IT Department Manager</h4>
                                        </a>
                                        <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                        <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                    </div>
                                    <div class="twm-right-content">
                                        
                                        <div class="twm-jobs-amount">$2500 <span>/ Month</span></div>
                                        <a href="job-detail.html" class="twm-jobs-browse site-text-primary">Browse Job</a>
                                    </div>
                                </div> 
                                 
                            </div>
                            
                             <!--Block Four-->
                            <div class="col-lg-6 col-md-12 m-b30">

                                <div class="twm-jobs-grid-style1">
                                    <div class="twm-media">
                                        <img src="images/jobs-company/pic4.jpg" alt="#">
                                    </div>
                                    <span class="twm-job-post-duration">2 days ago</span>
                                    <div class="twm-jobs-category green"><span class="twm-bg-sky">Freelancer</span></div>
                                    <div class="twm-mid-content">
                                        <a href="job-detail.html" class="twm-job-title">
                                            <h4 class="twm-job-title">Art Production Specialist</h4>
                                        </a>
                                        <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                        <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                    </div>
                                    <div class="twm-right-content">
                                        
                                        <div class="twm-jobs-amount">$1800 <span>/ Month</span></div>
                                        <a href="job-detail.html" class="twm-jobs-browse site-text-primary">Browse Job</a>
                                    </div>
                                </div>

                            </div>
                            
                            <!--Block Five-->
                            <div class="masonry-item col-lg-6 col-md-12 m-b30">
                                
                                <div class="twm-jobs-grid-style1">
                                    <div class="twm-media">
                                        <img src="images/jobs-company/pic5.jpg" alt="#">
                                    </div>
                                    <span class="twm-job-post-duration">1 days ago</span>
                                    <div class="twm-jobs-category green"><span class="twm-bg-golden">Temporary</span></div>
                                    <div class="twm-mid-content">
                                        <a href="job-detail.html" class="twm-job-title">
                                            <h4 class="twm-job-title">Recreation &amp; Fitness Worker</h4>
                                        </a>
                                        <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                        <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                    </div>
                                    <div class="twm-right-content">
                                        <div class="twm-jobs-amount">$1000 <span>/ Month</span></div>
                                        <a href="job-detail.html" class="twm-jobs-browse site-text-primary">Browse Job</a>
                                    </div>
                                </div>

                            </div>
                            
                            <!--Block Six-->
                            <div class="masonry-item col-lg-6 col-md-12 m-b30">
                                <div class="twm-jobs-grid-style1">
                                    <div class="twm-media">
                                        <img src="images/jobs-company/pic1.jpg" alt="#">
                                    </div>
                                    <span class="twm-job-post-duration">1 days ago</span>
                                    <div class="twm-jobs-category green"><span class="twm-bg-green">New</span></div>
                                    <div class="twm-mid-content">
                                        <a href="job-detail.html" class="twm-job-title">
                                            <h4>Senior Web Designer , Developer</h4>
                                        </a>
                                        <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                        <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                    </div>
                                    <div class="twm-right-content">
                                        
                                        <div class="twm-jobs-amount">$19 <span>/ Hour</span></div>
                                        <a href="job-detail.html" class="twm-jobs-browse site-text-primary">Browse Job</a>
                                    </div>
                                </div>
                            </div>

                            <!--Block Seven-->
                            <div class="col-lg-6 col-md-12 m-b30">

                                <div class="twm-jobs-grid-style1">
                                    <div class="twm-media">
                                        <img src="images/jobs-company/pic1.jpg" alt="#">
                                    </div>
                                    <span class="twm-job-post-duration">1 days ago</span>
                                    <div class="twm-jobs-category green"><span class="twm-bg-green">New</span></div>
                                    <div class="twm-mid-content">
                                        <a href="job-detail.html" class="twm-job-title">
                                            <h4>Senior Web Designer , Developer</h4>
                                        </a>
                                        <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                        <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                    </div>
                                    <div class="twm-right-content">
                                        
                                        <div class="twm-jobs-amount">$2500 <span>/ Month</span></div>
                                        <a href="job-detail.html" class="twm-jobs-browse site-text-primary">Browse Job</a>
                                    </div>
                                </div>

                            </div>
                            
                            <!--Block Eight-->
                            <div class="col-lg-6 col-md-12 m-b30">

                                <div class="twm-jobs-grid-style1">
                                    <div class="twm-media">
                                        <img src="images/jobs-company/pic2.jpg" alt="#">
                                    </div>
                                    <span class="twm-job-post-duration">15 days ago</span>
                                    <div class="twm-jobs-category green"><span class="twm-bg-brown">Intership</span></div>
                                    <div class="twm-mid-content">
                                        <a href="job-detail.html" class="twm-job-title">
                                            <h4>Senior Rolling Stock Technician</h4>
                                        </a>
                                        <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                        <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                    </div>
                                    <div class="twm-right-content">
                                        <div class="twm-jobs-amount">$7 <span>/ Hour</span></div>
                                        <a href="job-detail.html" class="twm-jobs-browse site-text-primary">Browse Job</a>
                                    </div>
                                </div>

                            </div>
                            
                            <!--Block Nine-->
                            <div class="col-lg-6 col-md-12 m-b30">
                                
                                <div class="twm-jobs-grid-style1">
                                    <div class="twm-media">
                                        <img src="images/jobs-company/pic3.jpg" alt="#">
                                    </div>
                                    <span class="twm-job-post-duration">6 Month ago</span>
                                    <div class="twm-jobs-category green"><span class="twm-bg-purple">Fulltime</span></div>
                                    <div class="twm-mid-content">
                                        <a href="job-detail.html" class="twm-job-title">
                                            <h4 class="twm-job-title">IT Department Manager</h4>
                                        </a>
                                        <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                        <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                    </div>
                                    <div class="twm-right-content">
                                        
                                        <div class="twm-jobs-amount">$2500 <span>/ Month</span></div>
                                        <a href="job-detail.html" class="twm-jobs-browse site-text-primary">Browse Job</a>
                                    </div>
                                </div> 
                                 
                            </div>
                            
                             <!--Block ten-->
                            <div class="col-lg-6 col-md-12 m-b30">

                                <div class="twm-jobs-grid-style1">
                                    <div class="twm-media">
                                        <img src="images/jobs-company/pic4.jpg" alt="#">
                                    </div>
                                    <span class="twm-job-post-duration">2 days ago</span>
                                    <div class="twm-jobs-category green"><span class="twm-bg-sky">Freelancer</span></div>
                                    <div class="twm-mid-content">
                                        <a href="job-detail.html" class="twm-job-title">
                                            <h4 class="twm-job-title">Art Production Specialist</h4>
                                        </a>
                                        <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                        <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                    </div>
                                    <div class="twm-right-content">
                                        
                                        <div class="twm-jobs-amount">$1800 <span>/ Month</span></div>
                                        <a href="job-detail.html" class="twm-jobs-browse site-text-primary">Browse Job</a>
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

    <!-- FOOTER START -->
    <footer class="footer-dark" style="background-image: url(images/f-bg.jpg);">
        <div class="container">

            <!-- NEWS LETTER SECTION START -->
            <div class="ftr-nw-content">
                <div class="row">
                    <div class="col-md-5">
                        <div class="ftr-nw-title">
                            Join our email subscription now to get updates 
                            on new jobs and notifications.
                        </div>
                    </div>
                    <div class="col-md-7">
                        <form>
                            <div class="ftr-nw-form">
                                <input name="news-letter" class="form-control" placeholder="Enter Your Email" type="text">
                                <button class="ftr-nw-subcribe-btn">Subscribe Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- NEWS LETTER SECTION END -->
            <!-- FOOTER BLOCKES START -->  
            <div class="footer-top">
                <div class="row">

                    <div class="col-lg-3 col-md-12">
                        
                        <div class="widget widget_about">
                            <div class="logo-footer clearfix">
                                <a href="index.html"><img src="images/logo-light.png" alt=""></a>
                            </div>
                            <p>Many desktop publishing packages and web page editors now.</p>
                            <ul class="ftr-list">
                                <li><p><span>Address :</span>65 Sunset CA 90026, USA </p></li>
                                <li><p><span>Email :</span>example@max.com</p></li>
                                <li><p><span>Call :</span>555-555-1234</p></li>
                            </ul>
                        </div>                            
                        
                    </div> 

                    <div class="col-lg-9 col-md-12">
                        <div class="row">
                           
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="widget widget_services ftr-list-center">
                                    <h3 class="widget-title">For Candidate</h3>
                                    <ul>
                                        <li><a href="dashboard.html">User Dashboard</a></li>
                                        <li><a href="dash-resume-alert.html">Alert resume</a></li>
                                        <li><a href="candidate-grid.html">Candidates</a></li>
                                        <li><a href="blog-list.html">Blog List</a></li>
                                        <li><a href="blog-single.html">Blog single</a></li>
                                    </ul>
                                </div>
                            </div>
                        
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="widget widget_services ftr-list-center">
                                    <h3 class="widget-title">For Employers</h3>
                                    <ul>
                                        <li><a href="dash-post-job.html">Post Jobs</a></li>
                                        <li><a href="blog-grid.html">Blog Grid</a></li>
                                        <li><a href="contact.html">Contact</a></li>
                                        <li><a href="job-list.html">Jobs Listing</a></li>
                                        <li><a href="job-detail.html">Jobs details</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="widget widget_services ftr-list-center">
                                    <h3 class="widget-title">Helpful Resources</h3>
                                    <ul>
                                        <li><a href="faq.html">FAQs</a></li>
                                        <li><a href="employer-detail.html">Employer detail</a></li>
                                        <li><a href="dash-my-profile.html">Profile</a></li>
                                        <li><a href="error-404.html">404 Page</a></li>
                                        <li><a href="pricing.html">Pricing</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6">  
                                <div class="widget widget_services ftr-list-center">
                                    <h3 class="widget-title">Quick Links</h3>
                                    <ul>
                                        <li><a href="index.html">Home</a></li>
                                        <li><a href="about-1.html">About us</a></li>
                                        <li><a href="dash-bookmark.html">Bookmark</a></li>
                                        <li><a href="job-grid.html">Jobs</a></li>
                                        <li><a href="employer-list.html">Employer</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div> 

                    </div> 

                </div>
            </div>
            <!-- FOOTER COPYRIGHT -->
            <div class="footer-bottom">
            
                <div class="footer-bottom-info">
                
                    <div class="footer-copy-right">
                        <span class="copyrights-text">Copyright © 2022 by thewebmax All Rights Reserved.</span>
                    </div>
                    <ul class="social-icons">
                        <li><a href="javascript:void(0);" class="fab fa-facebook-f"></a></li>
                        <li><a href="javascript:void(0);" class="fab fa-twitter"></a></li>
                        <li><a href="javascript:void(0);" class="fab fa-instagram"></a></li>
                        <li><a href="javascript:void(0);" class="fab fa-youtube"></a></li>
                    </ul>
                    
                </div>
                
            </div>

        </div>

    </footer>
    <!-- FOOTER END -->

    <!-- BUTTON TOP START -->
    <button class="scroltop"><span class="fa fa-angle-up  relative" id="btn-vibrate"></span></button>

    <!--Model Popup Section Start-->
        <!--Signup popup -->
        <div class="modal fade twm-sign-up" id="sign_up_popup" aria-hidden="true" aria-labelledby="sign_up_popupLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form>

                        <div class="modal-header">
                            <h2 class="modal-title" id="sign_up_popupLabel">Sign Up</h2>
                            <p>Sign Up and get access to all the features of Jobzilla</p>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="twm-tabs-style-2">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">

                                <!--Signup Candidate-->  
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#sign-candidate" type="button"><i class="fas fa-user-tie"></i>Candidate</button>
                                </li>
                                <!--Signup Employer-->
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#sign-Employer" type="button"><i class="fas fa-building"></i>Employer</button>
                                </li>
                                
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                <!--Signup Candidate Content-->  
                                <div class="tab-pane fade show active" id="sign-candidate">
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <input name="username" type="text" required="" class="form-control" placeholder="Usearname*">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <input name="email" type="text" class="form-control" required="" placeholder="Password*">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <input name="phone" type="text" class="form-control" required="" placeholder="Email*">
                                            </div>
                                        </div>
        
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <input name="phone" type="text" class="form-control" required="" placeholder="Phone*">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <div class=" form-check">
                                                    <input type="checkbox" class="form-check-input" id="agree1">
                                                    <label class="form-check-label" for="agree1">I agree to the <a href="javascript:;">Terms and conditions</a></label>
                                                    <p>Already registered?
                                                        <button class="twm-backto-login" data-bs-target="#sign_up_popup2" data-bs-toggle="modal" data-bs-dismiss="modal">Log in here</button>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="site-button">Sign Up</button>
                                        </div>
                                        
                                    </div>
                                </div>
                                <!--Signup Employer Content--> 
                                <div class="tab-pane fade" id="sign-Employer">
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <input name="username" type="text" required="" class="form-control" placeholder="Usearname*">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <input name="email" type="text" class="form-control" required="" placeholder="Password*">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <input name="phone" type="text" class="form-control" required="" placeholder="Email*">
                                            </div>
                                        </div>
        
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <input name="phone" type="text" class="form-control" required="" placeholder="Phone*">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <div class=" form-check">
                                                    <input type="checkbox" class="form-check-input" id="agree2">
                                                    <label class="form-check-label" for="agree2">I agree to the <a href="javascript:;">Terms and conditions</a></label>
                                                    <p>Already registered?
                                                        <button class="twm-backto-login" data-bs-target="#sign_up_popup2" data-bs-toggle="modal" data-bs-dismiss="modal">Log in here</button>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="site-button">Sign Up</button>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                                </div>
                            </div> 
                        </div>

                        <div class="modal-footer">
                            <span class="modal-f-title">Login or Sign up with</span>
                            <ul class="twm-modal-social">
                                <li><a href="javascript.html" class="facebook-clr"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="javascript.html" class="twitter-clr"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="javascript.html" class="linkedin-clr"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="javascript.html" class="google-clr"><i class="fab fa-google"></i></a></li>
                            </ul>
                        </div>

                    </form>
                </div>
            </div>
            
        </div>
        <!--Login popup -->
        <div class="modal fade twm-sign-up" id="sign_up_popup2" aria-hidden="true" aria-labelledby="sign_up_popupLabel2" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                
                    <form>
                        <div class="modal-header">
                            <h2 class="modal-title" id="sign_up_popupLabel2">Login</h2>
                            <p>Login and get access to all the features of Jobzilla</p>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="twm-tabs-style-2">
                                <ul class="nav nav-tabs" id="myTab2" role="tablist">

                                    <!--Login Candidate-->  
                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#login-candidate" type="button"><i class="fas fa-user-tie"></i>Candidate</button>
                                    </li>
                                    <!--Login Employer-->
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#login-Employer" type="button"><i class="fas fa-building"></i>Employer</button>
                                    </li>
                                
                                </ul>
                                
                                <div class="tab-content" id="myTab2Content">
                                    <!--Login Candidate Content-->  
                                    <div class="tab-pane fade show active" id="login-candidate">
                                        <div class="row">

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <input name="username" type="text" required="" class="form-control" placeholder="Usearname*">
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <input name="email" type="text" class="form-control" required="" placeholder="Password*">
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <div class=" form-check">
                                                        <input type="checkbox" class="form-check-input" id="Password3">
                                                        <label class="form-check-label rem-forgot" for="Password3">Remember me <a href="javascript:;">Forgot Password</a></label>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="site-button">Log in</button>
                                                <div class="mt-3 mb-3">Don't have an account ? 
                                                    <button class="twm-backto-login" data-bs-target="#sign_up_popup" data-bs-toggle="modal" data-bs-dismiss="modal">Sign Up</button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <!--Login Employer Content--> 
                                    <div class="tab-pane fade" id="login-Employer">
                                        <div class="row">

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <input name="username" type="text" required="" class="form-control" placeholder="Usearname*">
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <input name="email" type="text" class="form-control" required="" placeholder="Password*">
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <div class=" form-check">
                                                        <input type="checkbox" class="form-check-input" id="Password4">
                                                        <label class="form-check-label rem-forgot" for="Password4">Remember me <a href="javascript:;">Forgot Password</a></label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <button type="submit" class="site-button">Log in</button>
                                                <div class="mt-3 mb-3">Don't have an account ? 
                                                    <button class="twm-backto-login" data-bs-target="#sign_up_popup" data-bs-toggle="modal" data-bs-dismiss="modal">Sign Up</button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                
                                </div>
                            </div> 
                        </div>
                        <div class="modal-footer">
                            <span class="modal-f-title">Login or Sign up with</span>
                            <ul class="twm-modal-social">
                                <li><a href="javascript.html" class="facebook-clr"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="javascript.html" class="twitter-clr"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="javascript.html" class="linkedin-clr"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="javascript.html" class="google-clr"><i class="fab fa-google"></i></a></li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!--Model Popup Section End-->

 </div>

@endsection