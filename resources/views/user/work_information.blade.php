@extends('layouts.appPage')
@section('title-block')
{{ __('lang.user_page_title_profile') }}
@endsection
@section('content')

<!-- CONTENT START -->
<div class="page-content">
    <!-- INNER PAGE BANNER -->
    <div class="wt-bnr-inr overlay-wraper bg-center">
        <div class="overlay-main site-bg-white opacity-01"></div>
        <div class="container">
            <div class="wt-bnr-inr-entry">
                <div class="banner-title-outer">
                    <div class="banner-title-name">
                        {{-- @if (Auth::user()->user_type_id == 1) --}}
                        <h2 class="wt-title">{{ __('lang.user_page_candidate_first_title') }}</h2>
                        {{-- @elseif (Auth::user()->user_type_id == 2)
                        <h2 class="wt-title">{{ __('lang.user_page_candidate_second_title') }}</h2>
                        @elseif (Auth::user()->user_type_id == 3)
                        <h2 class="wt-title">{{ __('დამსაქმებელი კომპანია') }}</h2>
                        @elseif (Auth::user()->user_type_id == 4)
                        <h2 class="wt-title">{{ __('უცნობი') }}</h2>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- INNER PAGE BANNER END -->
    <!-- OUR BLOG START -->
    <div class="section-full p-b90 site-bg-white">

        <div class="container">
            <div class="row">

                <div class="col-xl-3 col-lg-4 col-md-12 rightSidebar m-b30">

                    <div class="side-bar-st-1">



                        @include('inc.user.nav')

                    </div>
                </div>
                {{-- <candidate-profile :data='@json($data)'></candidate-profile> --}}
                <candidate-work-information :data='@json($data)'></candidate-work-information>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- OUR BLOG END -->

</div>
<!-- CONTENT END -->
@endsection
