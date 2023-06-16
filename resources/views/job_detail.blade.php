
@extends('layouts.appPage')
@section('title-block')
{{('Jobs Detail')}}
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
                                <h2 class="wt-title">ძიძა</h2>
                            </div>
                        </div>
                        <!-- BREADCRUMB ROW -->

                            <div>
                                <ul class="wt-breadcrumb breadcrumb-style-2">
                                    <li><a href="index.html">მთავარი/</a></li><li>აპლიკანტის სახელი / გვარი</li>
                                </ul>
                            </div>

                        <!-- BREADCRUMB ROW END -->
                    </div>
                </div>
            </div>
            <!-- INNER PAGE BANNER END -->



            <!-- OUR BLOG START -->
            <div class="section-full  p-t120 p-b90 bg-white">
                <div class="container">

                    <!-- BLOG SECTION START -->
                    <div class="section-content">
                        <div class="row d-flex justify-content-center">

                            <div class="col-lg-8 col-md-12">
                                <!-- Candidate detail START -->
                                <div class="cabdidate-de-info">
                                    <div class="twm-job-self-wrap">
                                        <div class="twm-job-self-info">
                                            <div class="twm-job-self-top">
                                                <div class="twm-media-bg">
                                                    <img src="/images/job-detail-bg.jpg" alt="#">
                                                    <div class="twm-jobs-category green"><span class="twm-bg-green">New</span></div>
                                                </div>


                                                <div class="twm-mid-content">

                                                    <div class="twm-media">
                                                        <img src="/images/jobs-company/pic1.jpg" alt="#">
                                                    </div>

                                                    <h4 class="twm-job-title">{{ $vacancy->category->{'name_'.App()->getLocale()} }} <span class="twm-job-post-duration">/ 1 დღის წინ</span></h4>
                                                    <p class="twm-job-address"><i class="feather-map-pin"></i>1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                                    <div class="twm-job-self-mid">
                                                        <div class="twm-job-self-mid-left">
                                                            {{-- <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a> --}}
                                                            <div class="twm-jobs-amount">{{ $vacancy->payment.' '.$vacancy->currency->icon }} </div>
                                                        </div>
                                                        <div class="twm-job-apllication-area">განცხადებას ვადა გასდის:
                                                            <span class="twm-job-apllication-date">ოქტომბერი 1, 2025</span>
                                                        </div>
                                                    </div>

                                                    <div class="twm-job-self-bottom">
                                                        @auth()
                                                            @if (count($vacancy->vacancyInterest) && $findQualifying)

                                                            @else
                                                                <form method="post" action="/add_interest_vacancy" enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="id" value="{{ $vacancy->id }}">
                                                                    <button class="site-button" type="submit" >
                                                                        დაინტერესება
                                                                    </button>
                                                                </form>
                                                            @endif

                                                        @endauth

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <h4 class="twm-s-title">ბენეფიტები:</h4>

                                    @foreach ($vacancy->vacancyBenefit as $item)
                                    <span class="badge bg-primary " style="margin-right: 5px; font-size:15px">{{ $item-> {'name_'.App()->getLocale()}.', '}}</span>
                                    @endforeach


                                    <h4 class="twm-s-title">მოთხოვნები:</h4>
                                    <ul class="description-list-2">
                                        @foreach ($vacancy->vacancyDuty as $item)
                                            <li>
                                                <i class="feather-check"></i>
                                                {{ $item-> {'name_'.App()->getLocale()}.', '}}
                                            </li>
                                        @endforeach


                                    </ul>

                                    {{--<h4 class="twm-s-title">პასუხისმგებლობა:</h4>
                                    <ul class="description-list-2">
                                        <li>
                                            <i class="feather-check"></i>
                                            შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს
                                        </li>
                                        <li>
                                            <i class="feather-check"></i>
                                            შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს
                                        </li>
                                        <li>
                                            <i class="feather-check"></i>
                                            შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს
                                        </li>
                                        <li>
                                            <i class="feather-check"></i>
                                            შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს
                                        </li>
                                        <li>
                                            <i class="feather-check"></i>
                                            შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს
                                        </li>
                                        <li>
                                            <i class="feather-check"></i>
                                            შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს
                                        </li>

                                    </ul> --}}

                                    <h4 class="twm-s-title">გაზიარება</h4>
                                    <div class="twm-social-tags">
                                        <a href="#" class="fb-clr">Facebook</a>
                                        <a href="#" class="tw-clr">Twitter</a>
                                        <a href="#" class="odno-clr">Ok</a>
                                        <a href="#" class="insta-clr">Instagram</a>
                                        <a href="#" class="vk-clr">Vk</a>
                                    </div>

                                    <h4 class="twm-s-title">მდებარეობა</h4>
                                    <div class="twm-m-map mb-5">
                                        <div class="twm-m-map-iframe">
                                            <iframe height="310" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3304.8534521658976!2d-118.2533646842856!3d34.073270780600225!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c6fd9829c6f3%3A0x6ecd11bcf4b0c23a!2s1363%20Sunset%20Blvd%2C%20Los%20Angeles%2C%20CA%2090026%2C%20USA!5e0!3m2!1sen!2sin!4v1620815366832!5m2!1sen!2sin"></iframe>
                                        </div>
                                    </div>

                                    <div class="twm-two-part-section">
                                        <div class="row">

                                            <div class="col-lg-6 col-md-12">
                                                <h4 class="twm-s-title">ჩვენი სურათები</h4>
                                                <div class="tw-sidebar-gallery">
                                                    <ul>
                                                        <li>
                                                            <div class="tw-service-gallery-thumb">
                                                                <a class="elem" href="/images/gallery/pic1.jpg" title="Title 1" data-lcl-author="" data-lcl-thumb="images/gallery/thumb/pic1.jpg">
                                                                    <img src="/images/gallery/thumb/pic1.jpg" alt="">
                                                                    <i class="fa fa-file-image"></i>
                                                                </a>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="tw-service-gallery-thumb">
                                                                <a class="elem" href="/images/gallery/pic2.jpg" title="Title 2" data-lcl-author="" data-lcl-thumb="images/gallery/thumb/pic2.jpg">
                                                                    <img src="/images/gallery/thumb/pic2.jpg" alt="">
                                                                    <i class="fa fa-file-image"></i>
                                                                </a>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="tw-service-gallery-thumb ">
                                                                <a class="elem" href="/images/gallery/pic3.jpg" title="Title 3"  data-lcl-author="" data-lcl-thumb="/images/gallery/thumb/pic3.jpg">
                                                                    <img src="/images/gallery/thumb/pic3.jpg" alt="">
                                                                    <i class="fa fa-file-image"></i>
                                                                </a>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="tw-service-gallery-thumb">
                                                                <a class="elem" href="/images/gallery/pic4.jpg" title="Title 4"  data-lcl-author="" data-lcl-thumb="/images/gallery/thumb/pic4.jpg">
                                                                    <img src="/images/gallery/thumb/pic4.jpg" alt="">
                                                                    <i class="fa fa-file-image"></i>
                                                                </a>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="tw-service-gallery-thumb">
                                                                <a class="elem" href="/images/gallery/pic5.jpg" title="Title 5"  data-lcl-author="" data-lcl-thumb="/images/gallery/thumb/pic5.jpg">
                                                                    <img src="/images/gallery/thumb/pic5.jpg" alt="">
                                                                    <i class="fa fa-file-image"></i>
                                                                </a>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="tw-service-gallery-thumb">
                                                                <a class="elem" href="/images/gallery/pic6.jpg" title="Title 6"  data-lcl-author="" data-lcl-thumb="/images/gallery/thumb/pic6.jpg">
                                                                    <img src="/images/gallery/thumb/pic6.jpg" alt="">
                                                                    <i class="fa fa-file-image"></i>
                                                                </a>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="tw-service-gallery-thumb">
                                                                <a class="elem" href="/images/gallery/pic7.jpg" title="Title 7" data-lcl-author="" data-lcl-thumb="/images/gallery/thumb/pic1.jpg">
                                                                    <img src="/images/gallery/thumb/pic7.jpg" alt="">
                                                                    <i class="fa fa-file-image"></i>
                                                                </a>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="tw-service-gallery-thumb">
                                                                <a class="elem" href="/images/gallery/pic8.jpg" title="Title 8" data-lcl-author="" data-lcl-thumb="/images/gallery/thumb/pic2.jpg">
                                                                    <img src="/images/gallery/thumb/pic8.jpg" alt="">
                                                                    <i class="fa fa-file-image"></i>
                                                                </a>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="tw-service-gallery-thumb ">
                                                                <a class="elem" href="images/gallery/pic9.jpg" title="Title 9"  data-lcl-author="" data-lcl-thumb="/images/gallery/thumb/pic3.jpg">
                                                                    <img src="/images/gallery/thumb/pic9.jpg" alt="">
                                                                    <i class="fa fa-file-image"></i>
                                                                </a>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="tw-service-gallery-thumb">
                                                                <a class="elem" href="/images/gallery/pic10.jpg" title="Title 10"  data-lcl-author="" data-lcl-thumb="/images/gallery/thumb/pic4.jpg">
                                                                    <img src="/images/gallery/thumb/pic10.jpg" alt="">
                                                                    <i class="fa fa-file-image"></i>
                                                                </a>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="tw-service-gallery-thumb">
                                                                <a class="elem" href="/images/gallery/pic11.jpg" title="Title 11"  data-lcl-author="" data-lcl-thumb="/images/gallery/thumb/pic5.jpg">
                                                                    <img src="/images/gallery/thumb/pic11.jpg" alt="">
                                                                    <i class="fa fa-file-image"></i>
                                                                </a>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="tw-service-gallery-thumb">
                                                                <a class="elem" href="/images/gallery/pic12.jpg" title="Title 12"  data-lcl-author="" data-lcl-thumb="/images/gallery/thumb/pic6.jpg">
                                                                    <img src="/images/gallery/thumb/pic12.jpg" alt="">
                                                                    <i class="fa fa-file-image"></i>
                                                                </a>
                                                            </div>
                                                        </li>

                                                    </ul>

                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <h4 class="twm-s-title">ვიდეო</h4>
                                                <div class="video-section-first" style="background-image: url(images/video-bg.jpg);">
                                                    <a href="https://www.youtube.com/watch?v=c1XNqw2gSbU" class="mfp-video play-now-video">
                                                        <i class="icon feather-play"></i>
                                                        <span class="ripple"></span>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="col-lg-4 col-md-12 rightSidebar">

                                <div class="side-bar mb-4">
                                    <div class="twm-s-info2-wrap mb-5">
                                        <div class="twm-s-info2">
                                            <h4 class="section-head-small mb-4">სამუშაო ინფორმაცია</h4>
                                            <ul class="twm-job-hilites">
                                                {{-- <li>
                                                    <i class="fas fa-language"></i>
                                                    <span class="twm-title">ენა</span>
                                                </li> --}}
                                                <li>
                                                    <i class="fas fa-eye"></i>
                                                    <span class="twm-title">{{ $vacancy->view }} ნახვა</span>
                                                </li>
                                                <li>
                                                    <i class="fas fa-file-signature"></i>
                                                    <span class="twm-title">{{ count($vacancy->vacancyInterest) }} აპლიკანტი</span>
                                                </li>
                                            </ul>
                                            <ul class="twm-job-hilites2">

                                                <li>
                                                    <div class="twm-s-info-inner">
                                                        <i class="fas fa-calendar-alt"></i>
                                                        <span class="twm-title">გამოქვეყნების დრო</span>
                                                        <div class="twm-s-info-discription">{{ $vacancy->created_at }}</div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="twm-s-info-inner">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                        <span class="twm-title">ლოკაცია</span>
                                                        <div class="twm-s-info-discription">{{ $vacancy->author->{'address_'.App()->getLocale()} }}</div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="twm-s-info-inner">
                                                        <i class="fas fa-user-tie"></i>
                                                        <span class="twm-title">სამუშაო დასახელება</span>
                                                        <div class="twm-s-info-discription">{{ $vacancy->{'title_'.App()->getLocale()} }}</div>
                                                    </div>
                                                </li>
                                                {{-- <li>
                                                    <div class="twm-s-info-inner">
                                                        <i class="fas fa-tasks"></i>
                                                        <span class="twm-title">მოვალეობები</span>
                                                        <div class="twm-s-info-discription">ბაზიდან</div>
                                                    </div>
                                                </li> --}}
                                                <li>
                                                    <div class="twm-s-info-inner">
                                                        <i class="fas fa-suitcase"></i>
                                                        <span class="twm-title">განათლება</span>
                                                        <div class="twm-s-info-discription">{{ ($vacancy->demand->education)?$vacancy->demand->education->{'name_'.App()->getLocale()}:'-' }}</div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="twm-s-info-inner">
                                                        <i class="fas fa-tasks"></i>
                                                        <span class="twm-title">სპეციალობა</span>
                                                        <div class="twm-s-info-discription">{{ ($vacancy->demand->specialty)?$vacancy->demand->specialty->{'name_'.App()->getLocale()}:'-' }}</div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="twm-s-info-inner">
                                                        <i class="fas fa-language"></i>
                                                        <span class="twm-title">უცხო ენა</span>
                                                        <div class="twm-s-info-discription">{{ ($vacancy->demand->language)?$vacancy->demand->language->{'name_'.App()->getLocale()}:'-' }}</div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="twm-s-info-inner">
                                                        <i class="fas fa-venus-mars"></i>
                                                        <span class="twm-title">ასაკი</span>
                                                        <div class="twm-s-info-discription">{{ ($vacancy->demand->min_age)?$vacancy->demand->min_age:'18' }} - {{ ($vacancy->demand->max_age)?$vacancy->demand->max_age:'60' }}</div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="twm-s-info-inner">

                                                        <i class="fas fa-money-bill-wave"></i>
                                                        <span class="twm-title">ანაზღაურება</span>
                                                        <div class="twm-s-info-discription">{{ $vacancy->payment.' '.$vacancy->currency->icon }}</div>
                                                    </div>
                                                </li>

                                            </ul>

                                        </div>
                                    </div>

                                    {{-- <div class="widget tw-sidebar-tags-wrap">
                                        <h4 class="section-head-small mb-4">სამუშაო გამოცდილებები</h4>

                                        <div class="tagcloud">
                                            <button style="margin-right: 1%; margin-bottom: 1%;" class="btn btn-secondary">მოლარე</button>
                                            <button style="margin-right: 1%; margin-bottom: 1%;" class="btn btn-secondary">მენეჯერი</button>
                                        </div>
                                    </div> --}}

                                </div>



                                {{-- <div class="twm-advertisment" style="background-image:url(images/add-bg.jpg);">
                                    <div class="overlay"></div>
                                    <h4 class="twm-title">Recruiting?</h4>
                                    <p>Get Best Matched Jobs On your <br>
                                     Email. Add Resume NOW!</p>
                                     <a href="javascript:;" class="site-button white">Read More</a>
                                </div> --}}


                            </div>

                        </div>

                    </div>

                </div>

            </div>
            <!-- OUR BLOG END -->


        </div>
        <!-- CONTENT END -->
@endsection
