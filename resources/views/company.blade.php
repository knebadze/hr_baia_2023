@extends('layouts.appPage')
@section('title-block')
{{('Company Vacancies')}}
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
                            <h2 class="wt-title">{{ __('lang.company_vacancies_page_big_title') }}</h2>
                        </div>
                    </div>
                    <!-- BREADCRUMB ROW -->

                        <div>
                            <ul class="wt-breadcrumb breadcrumb-style-2">
                                <li><a href="{{ url ('/') }}">{{ __('lang.company_vacancies_page_small_title_first') }}/ </a></li>
                                <li>{{ __('lang.company_vacancies_page_small_title_second') }}</li>
                            </ul>
                        </div>

                    <!-- BREADCRUMB ROW END -->
                </div>
            </div>
        </div>
        <!-- INNER PAGE BANNER END -->


        <!-- OUR BLOG START -->
        <job-list :data='@json($data)'></job-list>

    </div>

 </div>

@endsection
