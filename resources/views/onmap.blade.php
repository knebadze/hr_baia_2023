@extends('layouts.appPage')
@section('title-block')
{{('Vacancies With Map')}}
@endsection
@section('content')
<!-- CONTENT START -->
<div class="page-content">

    <!-- SECTION CONTENT START -->
    <div class="section-full">
     <div class="half-map-list p-a20">
         <div class="wt-listing-full-width">
             <form>
                 <!--Search Bar-->
                 <!--Basic Information-->
                 <div class="panel panel-default">
                     <div class="panel-heading wt-panel-heading p-a20">
                         <h4 class="panel-tittle m-a0"><i class="fa fa-suitcase"></i>Find Jobs</h4>
                     </div>
                     <div class="panel-body wt-panel-body p-a20 m-b30 ">
                         
                         <div class="row">
                             <!--Job title-->            
                             <div class="col-xl-4 col-lg-6 col-md-12">
                                 <div class="form-group">
                                     <label>Job Title</label>
                                     <div class="ls-inputicon-box"> 
                                         <input class="form-control" name="company_name" type="text" placeholder="Types of Jobs">
                                         <i class="fs-input-icon fa fa-address-card"></i>
                                     </div>
                                 </div>
                             </div>


                             <!--Job Category--> 
                             <div class="col-xl-4 col-lg-6 col-md-12">
                                 <div class="form-group city-outer-bx has-feedback">
                                     <label>Job Category</label>
                                     <div class="ls-inputicon-box">  
                                         <select class="wt-select-box selectpicker"  data-live-search="true" title="" id="j-category" data-bv-field="size">
                                             <option disabled selected value="">Select Category</option>
                                             <option>Accounting and Finance</option>
                                             <option>Clerical &amp; Data Entry</option>
                                             <option>Counseling</option>
                                             <option>Court Administration</option>
                                             <option>Human Resources</option>
                                             <option>Investigative</option>
                                             <option>IT and Computers</option>
                                             <option>Law Enforcement</option>
                                             <option>Management</option>
                                             <option>Miscellaneous</option>
                                             <option>Public Relations</option>
                                         </select>
                                         <i class="fs-input-icon fa fa-border-all"></i>
                                     </div>
                                     
                                 </div>
                             </div>

                             
                             <!--Job Type--> 
                             <div class="col-xl-4 col-lg-6 col-md-12">
                                 <div class="form-group">
                                     <label>Job Type</label>
                                     <div class="ls-inputicon-box">  
                                         <select class="wt-select-box selectpicker"  data-live-search="true" title="" id="s-category" data-bv-field="size">
                                             <option class="bs-title-option" value="">Select Category</option>
                                             <option>Full Time</option>
                                             <option>Freelance</option>
                                             <option>Part Time</option>
                                             <option>Internship</option>
                                             <option>Temporary</option>
                                         </select>
                                         <i class="fs-input-icon fa fa-file-alt"></i>
                                     </div>
                                 </div>
                             </div>

                             <!--Location--> 
                             <div class="col-xl-12 col-lg-6 col-md-12">
                                 <div class="form-group">
                                     <label>Location</label>
                                     <div class="ls-inputicon-box"> 
                                         <input class="form-control" name="company_Email" type="text" placeholder="Type Address">
                                         <i class="fs-input-icon fa fa-map-marker-alt"></i>
                                     </div>
                                 </div>
                             </div>


                             <!--Salary--> 
                             <div class="col-xl-6 col-lg-6 col-md-12">
                                 <div class="form-group">
                                     <label>Salary</label>
                                     <div class="ls-inputicon-box">  
                                         <select class="wt-select-box selectpicker"  data-live-search="true" title="" id="salary" data-bv-field="size">
                                             <option class="bs-title-option" value="">Salary</option>
                                             <option>$500</option>
                                             <option>$1000</option>
                                             <option>$1500</option>
                                             <option>$2000</option>
                                             <option>$2500</option>
                                         </select>
                                         <i class="fs-input-icon fa fa-dollar-sign"></i>
                                     </div>
                                 </div>
                             </div>

                             <!--Radius--> 
                             <div class="col-xl-6 col-lg-6 col-md-12">
                                 <div class="form-group">
                                     <label>Radius</label>
                                     
                                     <div class="twm-radius-range">
                                         <b>10 Km</b> 
                                         <input id="ex2" type="text" class="span2" value="" data-slider-min="10" data-slider-max="100" data-slider-step="5" data-slider-value="[20,80]"/> 
                                         <b>100 Km</b>
                                     </div>
                                     
                                 </div>
                             </div>


                             <div class="col-lg-12 col-md-12">                                   
                                 <div class="text-left">
                                     <button type="button" class="site-button">Search Job</button>
                                 </div>
                             </div> 

                         </div>
                                  
                     </div>
                 </div> 
                 
             </form>
         </div>

        
         <div class="wt-searchReasult-divider"></div>
 
         <div class="p-a30 side-bar-opposite">
         
             <div class="wt-listing-container">
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
     
     <!-- Right part -->
     <div class="half-map-section">
     
         <div class="user-msg-list-btn-outer">
             <button class="map-show-btn-close">Close</button>
             <button class="map-show-btn-open">View Map</button>
         </div> 
                             
         <div id="map-container">
       
             <div id="map" data-map-zoom="9">
                 <!-- map goes here -->
             </div>
         </div>
     </div>            
     <!-- Right part END -->                 
    </div>
    <!-- SECTION CONTENT END  -->
     

 </div>
 <!-- CONTENT END -->



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