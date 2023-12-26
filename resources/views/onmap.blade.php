@extends('layouts.appPage')
@section('title-block')
    {{ __('lang.page_title_onmap') }}
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
                 <div class="on_map"></div>
                 <hr>
                 <div class="panel panel-default">
                     <div class="panel-heading p-a20">
                         <h4 class="panel-tittle m-a0"><i class="fa fa-suitcase"></i>{{ __('lang.onmap_vacancies_page_leftside_vacancie_find_job') }}</h4>
                     </div>
                     <div class="panel-body wt-panel-body p-a20 m-b30 ">
                         
                         <div class="row">
                             <!--Job title-->            
                             <div class="col-xl-4 col-lg-6 col-md-12">
                                 <div class="form-group">
                                     <label>{{ __('lang.onmap_vacancies_page_leftside_vacancie_title') }}</label>
                                     <div class="ls-inputicon-box"> 
                                         <input class="form-control" name="company_name" type="text" placeholder="{{ __('lang.onmap_vacancies_page_leftside_vacancie_types_of_jobs') }}">
                                         <i class="fs-input-icon fa fa-address-card"></i>
                                     </div>
                                 </div>
                             </div>


                             <!--Job Category--> 
                             <div class="col-xl-4 col-lg-6 col-md-12">
                                 <div class="form-group city-outer-bx has-feedback">
                                     <label>{{ __('lang.onmap_vacancies_page_leftside_vacancie_category') }}</label>
                                     <div class="ls-inputicon-box">  
                                         <select class="wt-select-box selectpicker"  data-live-search="true" title="" id="j-category" data-bv-field="size">
                                             <option disabled selected value="">{{ __('lang.onmap_vacancies_page_leftside_vacancie_choose_category') }}</option>
                                             <option>ძიძა</option>
                                             <option>დამხმარე</option>
                                             <option>კონსულტაცია</option>
                                             <option>მრეცხავი</option>
                                             <option>მზარეული</option>
                                             <option>მენეჯერი</option>
                                             <option>ჭურჭლის მრეცხავი</option>
                                             <option>სასტუმროს მენეჯერი</option>
                                             <option>ოფიციანტი</option>
                                             <option>ფრილანსერი</option>
                                             <option>დაოჯახება</option>
                                         </select>
                                         <i class="fs-input-icon fa fa-border-all"></i>
                                     </div>
                                     
                                 </div>
                             </div>

                             
                             <!--Job Type--> 
                             <div class="col-xl-4 col-lg-6 col-md-12">
                                 <div class="form-group">
                                     <label>{{ __('lang.onmap_vacancies_page_leftside_vacancie_work_type') }}</label>
                                     <div class="ls-inputicon-box">  
                                         <select class="wt-select-box selectpicker"  data-live-search="true" title="" id="s-category" data-bv-field="size">
                                             <option class="bs-title-option" value="">{{ __('lang.onmap_vacancies_page_leftside_vacancie__work_type_choose_category') }}</option>
                                             <option>სრული</option>
                                             <option>თავისუფალი</option>
                                             <option>ნახევარი</option>
                                             <option>სტაჟირება</option>
                                             <option>დროებითი</option>
                                         </select>
                                         <i class="fs-input-icon fa fa-file-alt"></i>
                                     </div>
                                 </div>
                             </div>

                             <!--Location--> 
                             <div class="col-xl-12 col-lg-6 col-md-12">
                                 <div class="form-group">
                                     <label>{{ __('lang.onmap_vacancies_page_leftside_vacancie_location') }}</label>
                                     <div class="ls-inputicon-box"> 
                                         <input class="form-control" name="company_Email" type="text" placeholder="{{ __('lang.onmap_vacancies_page_leftside_vacancie_specify_location') }}">
                                         <i class="fs-input-icon fa fa-map-marker-alt"></i>
                                     </div>
                                 </div>
                             </div>


                             <!--Salary--> 
                             <div class="col-xl-6 col-lg-6 col-md-12">
                                 <div class="form-group">
                                     <label>{{ __('lang.onmap_vacancies_page_leftside_vacancie_sallary') }}</label>
                                     <div class="ls-inputicon-box">  
                                         <select class="wt-select-box selectpicker"  data-live-search="true" title="" id="salary" data-bv-field="size">
                                             <option class="bs-title-option" value="">{{ __('lang.onmap_vacancies_page_leftside_vacancie_sallary') }}</option>
                                             <option>₾500</option>
                                             <option>₾1000</option>
                                             <option>₾1500</option>
                                             <option>₾2000</option>
                                             <option>₾2500</option>
                                         </select>
                                         {{-- <i class="fs-input-icon fa fa-dollar-sign"></i> --}}
                                     </div>
                                 </div>
                             </div>

                             <!--Radius--> 
                             <div class="col-xl-6 col-lg-6 col-md-12">
                                 <div class="form-group">
                                     <label>{{ __('lang.onmap_vacancies_page_leftside_vacancie_radius') }}</label>
                                     
                                     {{-- <div class="twm-radius-range">
                                         <b>3 km</b> 
                                         <input id="ex2" type="text" class="span2" value="" data-slider-min="10" data-slider-max="100" data-slider-step="5" data-slider-value="[20,80]"/> 
                                         <b>7 km</b>
                                     </div> --}}

                                     {{-- <div class="twm-radius-range">
                                        <div class="range">
                                            <input type="range" min='0' max='100' step='1' />
                                            <span>50km</span>
                                        </div>
                                     </div> --}}
                                    <div class="slideContainer">
                                      <input type="range" min="1" max="100" value="50" class="sliderRange" id="myMapRange">
                                      <p>Value: <span id="mapRange"></span></p>
                                    </div>

                                 </div>
                             </div>


                             <div class="col-lg-12 col-md-12">                                   
                                 <div class="text-left">
                                     <button type="button" class="site-button">{{ __('lang.onmap_vacancies_page_leftside_vacancie_search') }}</button>
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
                                 <img src="/images/jobs-company/pic1.jpg" alt="#">
                             </div>
                             <div class="twm-jobs-category green"><span class="twm-bg-green">New</span></div>
                             <div class="twm-mid-content">
                                 <a href="#" class="twm-job-title">
                                    <span class="twm-job-post-duration" style="margin-left: 0">1 days ago</span>
                                     <h4>Senior Web Designer , Developer</h4>
                                 </a>
                                 <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                 <a href="#" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                             </div>
                             <div class="twm-right-content">
                                 
                                 <div class="twm-jobs-amount">$2500 <span>/ Month</span></div>
                                 <a href="#" class="twm-jobs-browse site-text-primary">{{ __('lang.onmap_vacancies_page_leftside_vacancie_job_boxes') }}</a>
                             </div>
                         </div>

                     </div>
                     
                     <!--Block two-->
                     <div class="col-lg-6 col-md-12 m-b30">

                         <div class="twm-jobs-grid-style1">
                             <div class="twm-media">
                                 <img src="/images/jobs-company/pic2.jpg" alt="#">
                             </div>
                             <div class="twm-jobs-category green"><span class="twm-bg-brown">Intership</span></div>
                             <div class="twm-mid-content">
                                 <a href="#" class="twm-job-title">
                                    <span class="twm-job-post-duration" style="margin-left: 0">15 days ago</span>
                                     <h4>Senior Rolling Stock Technician</h4>
                                 </a>
                                 <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                 <a href="#" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                             </div>
                             <div class="twm-right-content">
                                 <div class="twm-jobs-amount">$7 <span>/ Hour</span></div>
                                 <a href="#" class="twm-jobs-browse site-text-primary">Browse Job</a>
                             </div>
                         </div>

                     </div>
                     
                     <!--Block three-->
                     {{-- <div class="col-lg-6 col-md-12 m-b30">
                         
                         <div class="twm-jobs-grid-style1">
                             <div class="twm-media">
                                 <img src="/images/jobs-company/pic3.jpg" alt="#">
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
                          
                     </div> --}}
                     
                      <!--Block Four-->
                     {{-- <div class="col-lg-6 col-md-12 m-b30">

                         <div class="twm-jobs-grid-style1">
                             <div class="twm-media">
                                 <img src="/images/jobs-company/pic4.jpg" alt="#">
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

                     </div> --}}
                     
                     <!--Block Five-->
                     {{-- <div class="masonry-item col-lg-6 col-md-12 m-b30">
                         
                         <div class="twm-jobs-grid-style1">
                             <div class="twm-media">
                                 <img src="/images/jobs-company/pic5.jpg" alt="#">
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

                     </div> --}}
                     
                     <!--Block Six-->
                     {{-- <div class="masonry-item col-lg-6 col-md-12 m-b30">
                         <div class="twm-jobs-grid-style1">
                             <div class="twm-media">
                                 <img src="/images/jobs-company/pic1.jpg" alt="#">
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
                     </div> --}}

                     <!--Block Seven-->
                     {{-- <div class="col-lg-6 col-md-12 m-b30">

                         <div class="twm-jobs-grid-style1">
                             <div class="twm-media">
                                 <img src="/images/jobs-company/pic1.jpg" alt="#">
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

                     </div> --}}
                     
                     <!--Block Eight-->
                     {{-- <div class="col-lg-6 col-md-12 m-b30">

                         <div class="twm-jobs-grid-style1">
                             <div class="twm-media">
                                 <img src="/images/jobs-company/pic2.jpg" alt="#">
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

                     </div> --}}
                     
                     <!--Block Nine-->
                     {{-- <div class="col-lg-6 col-md-12 m-b30">
                         
                         <div class="twm-jobs-grid-style1">
                             <div class="twm-media">
                                 <img src="/images/jobs-company/pic3.jpg" alt="#">
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
                          
                     </div> --}}
                     
                      <!--Block ten-->
                     {{-- <div class="col-lg-6 col-md-12 m-b30">

                         <div class="twm-jobs-grid-style1">
                             <div class="twm-media">
                                 <img src="/images/jobs-company/pic4.jpg" alt="#">
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

                     </div> --}}
                     
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
</div>
{{-- <script type="text/javascript">
    $(function()
    {
        $('.range input').on('mousemove', function(){
            var getValRange = $(this).val();
            $('.range span').text(getValRange + 'km');
        });

    });
</script> --}}
<style>
    .slideContainer {
      width: 100%;
    }
    
    .sliderRange {
      -webkit-appearance: none;
      width: 100%;
      height: 15px;
      border-radius: 5px;
      background: #d3d3d3;
      outline: none;
      opacity: 0.7;
      -webkit-transition: .2s;
      transition: opacity .2s;
    }
    
    .sliderRange:hover {
      opacity: 1;
    }
    
    .sliderRange::-webkit-slider-thumb {
      -webkit-appearance: none;
      appearance: none;
      width: 25px;
      height: 25px;
      border-radius: 50%;
      background: #04AA6D;
      cursor: pointer;
    }
    
    .sliderRange::-moz-range-thumb {
      width: 25px;
      height: 25px;
      border-radius: 50%;
      background: #04AA6D;
      cursor: pointer;
    }
    </style>
    <script>
        var slider = document.getElementById("myMapRange");
        var output = document.getElementById("mapRange");
        output.innerHTML = slider.value;
        
        slider.oninput = function() {
          output.innerHTML = this.value;
        }
    </script>
@endsection