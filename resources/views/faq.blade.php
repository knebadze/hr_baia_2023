@extends('layouts.appPage')
@section('title-block')
{{ __('lang.footer_nav_large') }}
@endsection
@section('content')
<body>
    

<!-- CONTENT START -->
<div class="page-content">

    <!-- INNER PAGE BANNER -->
    <div class="wt-bnr-inr overlay-wraper bg-center" style="background-image:url(/images/banner/1.jpg);">
        <div class="overlay-main site-bg-white opacity-01"></div>
        <div class="container">
            <div class="wt-bnr-inr-entry">
                <!-- BREADCRUMB ROW -->

                    <div>
                        <ul class="wt-breadcrumb breadcrumb-style-2">
                            <li><a href="{{ url ('/') }}">{{ __('lang.about_us_page_title_link') }}</a>/ </li>
                            <li>{{ __('lang.footer_nav_large') }}</li>
                        </ul>
                    </div>


                <!-- BREADCRUMB ROW END -->
            </div>
        </div>
    </div>
    <!-- INNER PAGE BANNER END -->
    <!-- HOW IT WORK SECTION START -->
    <div class="section-full p-t120 p-b90 site-bg-white twm-how-it-work-area faqFullPage">

        <div class="container-fluid faqDescr">

                <div class="row">
                    <div class="col-md-12">

                            <h4><span>1. კითხვა</span></h4>
                            <p>პასუხი</p>

                            <h4><span>2. კითხვა</span></h4>
                            <p>პასუხი</p>

                            <h4><span>3. კითხვა</span></h4>
                            <p>პასუხი</p>

                            <h4><span>4. კითხვა</span></h4>
                            <p>პასუხი</p>

                    </div>

                </div>
        </div>

    </div>

</div>
</body>
@endsection