@extends('layouts.appPage')
@section('title-block')
{{('My Rezume')}}
@endsection
@section('content')
    <!-- LOADING AREA  END ====== -->

	<div class="page-wraper">

        <!-- CONTENT START -->
        <div class="page-content">

        <!-- INNER PAGE BANNER -->
        <div class="wt-bnr-inr overlay-wraper bg-center" style="background-image:url(images/banner/1.jpg);">
            <div class="overlay-main site-bg-white opacity-01"></div>
            <div class="container">
                <div class="wt-bnr-inr-entry">
                    <div class="banner-title-outer">
                        <div class="banner-title-name">
                            <h2 class="wt-title">Candidate Resume</h2>
                        </div>
                    </div>
                    <!-- BREADCRUMB ROW -->

                        <div>
                            <ul class="wt-breadcrumb breadcrumb-style-2">
                                <li><a href="index.html">Home</a></li>
                                <li>Candidate Resume</li>
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

                        <div class="col-xl-3 col-lg-4 col-md-12 rightSidebar m-b30">

                            <div class="side-bar-st-1">
                                @include('inc.user.nav')

                            </div>

                        </div>

                        
                        @if (Auth::user()->user_type_id == 2)
                            <my-vacancy :data='@json($data)'></my-vacancy>
                        @endif

                    </div>
                </div>
            </div>
            <!-- OUR BLOG END -->



        </div>
        <!-- CONTENT END -->
@endsection
