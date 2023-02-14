@extends('layouts.appPage')
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
                        <h2 class="wt-title">Candidate Profile</h2>
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

                        <div class="twm-candidate-profile-pic">

                            <img src="/images/user-avtar/pic4.jpg" alt="">
                            <div class="upload-btn-wrapper">

                                <div id="upload-image-grid"></div>
                                <button class="site-button button-sm">Upload Photo</button>
                                <input type="file" name="myfile" id="file-uploader" accept=".jpg, .jpeg, .png">
                            </div>

                        </div>
                        <div class="twm-mid-content text-center">
                            <a href="candidate-detail.html" class="twm-job-title">
                                <h4>Randall Henderson </h4>
                            </a>
                            <p>IT Contractor</p>
                        </div>

                        @include('inc.user.nav')

                    </div>
                </div>
                <candidate-profile :data='@json($data)'></candidate-profile>
            </div>
        </div>
    </div>
    <!-- OUR BLOG END -->

</div>
<!-- CONTENT END -->
@endsection
