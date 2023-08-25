
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
                                <h2 class="wt-title">{{ $data['vacancy']->category->{'name_'.App()->getLocale()} }}</h2>
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

            <vacancy-detail :data='@json($data)'></vacancy-detail>




        </div>
        <!-- CONTENT END -->
@endsection
