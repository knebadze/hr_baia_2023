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
                                <h4 class="section-head-small mb-4">თაგები</h4>
                                
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

                        <div class="twm-advertisment" style="background-image:url(images/add-bg.jpg);">
                           <div class="overlay"></div>
                           <h4 class="twm-title">დაქირავება?</h4>
                           <p>მიიღეთ თქვენთვის შესაფერისი ვაკანსიები <br>
                            Email-ზე. გაგზავნეთ თქვენი რეზიუმე ახლავე!</p>
                            <a href="about-1.html" class="site-button white">სრულად</a> 
                        </div>

                    </div>

                    <div class="col-lg-8 col-md-12">
                        <!--Filter Short By-->
                        <div class="product-filter-wrap d-flex justify-content-between align-items-center m-b30">
                            <span class="woocommerce-result-count-left">ნაჩვენებია 2150 სამუშაო ადგილი</span>
                           
                            <form class="woocommerce-ordering twm-filter-select" method="get">
                                <span class="woocommerce-result-count">დალაგება</span>
                                <select class="wt-select-bar-2 selectpicker"  data-live-search="true" data-bv-field="size">
                                    <option>უახლესი</option>
                                    <option>თავისუფალი გრაფიკი</option>
                                    <option>სრული განაკვეთი</option>
                                    <option>სტაჟირება</option>
                                    <option>ნახევარი განაკვეთი</option>
                                    <option>დროებითი</option>
                                </select>
                                <select class="wt-select-bar-2 selectpicker"  data-live-search="true" data-bv-field="size">
                                    <option>მაჩვენე 10</option>
                                    <option>მაჩვენე 20</option>
                                    <option>მაჩვენე 30</option>
                                    <option>მაჩვენე 40</option>
                                    <option>მაჩვენე 50</option>
                                    <option>მაჩვენე 60</option>
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
                            
                            <!--Block two-->
                            <div class="col-lg-6 col-md-12 m-b30">

                                <div class="twm-jobs-grid-style1">
                                    <div class="twm-media">
                                        <img src="images/jobs-company/pic2.jpg" alt="#">
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
                                        <img src="images/jobs-company/pic3.jpg" alt="#">
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
                                        <img src="images/jobs-company/pic4.jpg" alt="#">
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
                                        <img src="images/jobs-company/pic5.jpg" alt="#">
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
                                        <img src="images/jobs-company/pic1.jpg" alt="#">
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
                                        <img src="images/jobs-company/pic1.jpg" alt="#">
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
                                        <img src="images/jobs-company/pic2.jpg" alt="#">
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
                                        <img src="images/jobs-company/pic3.jpg" alt="#">
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
                                        <img src="images/jobs-company/pic4.jpg" alt="#">
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