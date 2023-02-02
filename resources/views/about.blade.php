@extends('layouts.appPage')
@section('title-block')
{{('About Us')}}
@endsection
@section('content')
<!-- CONTENT START -->
<div class="page-content">

    <!-- INNER PAGE BANNER -->
    <div class="wt-bnr-inr overlay-wraper bg-center" style="background-image:url(images/banner/1.jpg);">
        <div class="overlay-main site-bg-white opacity-01"></div>
        <div class="container">
            <div class="wt-bnr-inr-entry aboutUsText">
                <div class="banner-title-outer">
                    <div class="banner-title-name">
                        <h2 class="wt-title">ჩვენს შესახებ</h2>
                    </div>
                </div>
                <!-- BREADCRUMB ROW -->

                    <div>
                        <ul class="wt-breadcrumb breadcrumb-style-2">
                            <li><a href="{{ url ('/') }}">მთავარი</a> / </li>
                            <li>ჩვენს შესახებ</li>
                        </ul>
                    </div>
                    <h4>
                        თბილისის საოჯახო პერსონალის საკადრო ცენტრი ,,ბაია“   გთავაზობთ  
                        პერსონალის ოპერატიულ და პროფესიონალურ დონეზე შერჩევას,  
                        როგორც საოჯახო პერსონალის (ძიძების, გუვერნანტების, ოჯახში დამხმარეების, 
                        მოხუცისა თუ ავადმყოფის მომვლელების, პერსონალური მძღოლების, საკარმიდამო ნაკვეთში 
                        ოჯახური წყვილების)სახით,  ასევე სასტუმრო/რესტორნებისა და მაღაზიების ქსელისათვის მენეჯერების, 
                        ადმინისტრატორების, ჭურჭლის მრეცხავებისა თუ დამლაგებლების, მოლარე-ოპერატორების, 
                        მზარეულებისა და მრავალი სხვა პროფილით  როგორც საქართველოში ასევე საზღვარგარეთ.
                    </h4>

                <!-- BREADCRUMB ROW END -->
            </div>
        </div>
    </div>
    <!-- INNER PAGE BANNER END -->

    <!-- JOBS CATEGORIES SECTION START -->
    <div class="section-full p-t120 p-b90 site-bg-gray twm-job-categories-area2">
        
        <!-- TITLE START-->
        <div class="section-head center wt-small-separator-outer">
            <div class="wt-small-separator site-text-primary">
               <div>სამსახურები კატეგორიების მიხედვით</div>
            </div>
            <h2 class="wt-title">აირჩიეთ სასურველი კატეგორია</h2>
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
                    <a href="job-grid.html" class=" site-button">ყველა კატეგორია</a>
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
                            <div>როგორ მუშაობს </div>
                            </div>
                            <h2 class="wt-title">მიჰყევით ჩვენს ნაბიჯებს, ჩვენ დაგეხმარებით.</h2>

                        </div>
                        <ul class="description-list">
                            <li>
                                <i class="feather-check"></i>
                                სანდო და ხარისხიანი სამუშაო
                            </li>
                            <li>
                                <i class="feather-check"></i>
                                საერთაშორისო სამუშაო
                            </li>
                            <li>
                                <i class="feather-check"></i>
                                დამატებითი გადასახადის გარეშე
                            </li>
                            <li>
                                <i class="feather-check"></i>
                                ტოპ კომპანიები
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
                                            <span><img src="images/work-process/icon1.png" alt="icon1"></span>
                                        </div>
                                        <h4 class="twm-title">დაარეგისტრირეთ<br>ექაუნთი</h4>
                                        {{-- <p>თქვენ უნდა შექმნათ ანგარიში, რომ იპოვოთ საუკეთესო და სასურველი სამუშაო.</p> --}}
                                    </div>

                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="twm-w-process-steps-2">
                                    <div class="twm-w-pro-top bg-clr-yellow-light bg-yellow-light-shadow">
                                        <span class="twm-large-number text-clr-yellow">02</span>
                                        <div class="twm-media">
                                            <span><img src="images/work-process/icon4.png" alt="icon1"></span>
                                        </div>
                                        <h4 class="twm-title">მოძებნე <br>
                                            სასურველი ვაკანსია</h4>
                                        {{-- <p>მოძებნეთ სასურველი ვაკანსია და დაგვეკონტაქტეთ</p> --}}
                                    </div>

                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="twm-w-process-steps-2">
                                    <div class="twm-w-pro-top bg-clr-pink-light bg-pink-light-shadow">
                                        <span class="twm-large-number text-clr-pink">03</span>
                                        <div class="twm-media">
                                            <span><img src="images/work-process/icon3.png" alt="icon1"></span>
                                        </div>
                                        <h4 class="twm-title">დაადასტურეთ <br>თქვენი ვაკანსია</h4>
                                        {{-- <p>You need to create an account to find the best and preferred job.</p> --}}
                                    </div>

                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="twm-w-process-steps-2">
                                    <div class="twm-w-pro-top bg-clr-green-light bg-clr-light-shadow">
                                        <span class="twm-large-number text-clr-green">04</span>
                                        <div class="twm-media">
                                            <span><img src="images/work-process/icon3.png" alt="icon1"></span>
                                        </div>
                                        <h4 class="twm-title">ატვირთეთ <br>თქვენი რეზიუმე</h4>
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

    <!-- EXPLORE NEW LIFE START -->
    <div class="section-full p-t120 p-b120 twm-explore-area bg-cover " style="background-image: url(images/background/bg-1.jpg);">
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
                                    <h2>ჯერ კიდევ ვერ მოძებნეთ შესაბამისი სამსახური? ატვირთეთ თქვენი რეზიუმე </h2>
                                    <p>Lorem Ipsum არის უბრალოდ ბეჭდვისა და ბეჭდვის ინდუსტრიის მოჩვენებითი ტექსტი, სტანდარტული მოჩვენებითი ტექსტი მას შემდეგ, რაც პრინტერი აიღო.</p>
                                </div>
                                <div class="twm-upload-file">
                                    <button type="button" class="site-button">რეზიუმეს ატვირთვა <i class="feather-upload"></i></button>
                                </div>


                            </div>
                            <div class="twm-bold-circle-right"></div>
                            <div class="twm-bold-circle-left"></div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- EXPLORE NEW LIFE END -->

    <!-- TOP COMPANIES START -->
    <div class="section-full p-t120  site-bg-white twm-companies-wrap">

        <!-- TITLE START-->
        <div class="section-head center wt-small-separator-outer">
            <div class="wt-small-separator site-text-primary">
               <div>ტოპ კომპანიები</div>
            </div>
            <h2 class="wt-title">იიღეთ შემოთავაზებები ტოპ კომპანიებში</h2>
        </div>
        <!-- TITLE END-->

        <div class="container">
            <div class="section-content">
                <div class="owl-carousel home-client-carousel2 owl-btn-vertical-center">

                    <div class="item">
                        <div class="ow-client-logo">
                            <div class="client-logo client-logo-media">
                            <a href="employer-list.html"><img src="images/client-logo/w1.png" alt=""></a></div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="ow-client-logo">
                            <div class="client-logo client-logo-media">
                            <a href="employer-list.html"><img src="images/client-logo/w2.png" alt=""></a></div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="ow-client-logo">
                            <div class="client-logo client-logo-media">
                            <a href="employer-list.html"><img src="images/client-logo/w3.png" alt=""></a></div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="ow-client-logo">
                            <div class="client-logo client-logo-media">
                            <a href="employer-list.html"><img src="images/client-logo/w4.png" alt=""></a></div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="ow-client-logo">
                            <div class="client-logo client-logo-media">
                            <a href="employer-list.html"><img src="images/client-logo/w5.png" alt=""></a></div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="ow-client-logo">
                            <div class="client-logo client-logo-media">
                            <a href="employer-list.html"><img src="images/client-logo/w6.png" alt=""></a></div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="ow-client-logo">
                            <div class="client-logo client-logo-media">
                            <a href="employer-list.html"><img src="images/client-logo/w1.png" alt=""></a></div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="ow-client-logo">
                            <div class="client-logo client-logo-media">
                            <a href="employer-list.html"><img src="images/client-logo/w2.png" alt=""></a></div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="ow-client-logo">
                            <div class="client-logo client-logo-media">
                            <a href="employer-list.html"><img src="images/client-logo/w3.png" alt=""></a></div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="ow-client-logo">
                            <div class="client-logo client-logo-media">
                            <a href="employer-list.html"><img src="images/client-logo/w5.png" alt=""></a></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- TOP COMPANIES END -->


</div>
<!-- CONTENT END -->

</div>
@endsection