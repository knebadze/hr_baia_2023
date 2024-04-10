@extends('layouts.appPage')
@section('title-block')
   {{ __('lang.page_title_contact') }}
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
                                <h2 class="wt-title">{{ __('lang.menu_contact') }}</h2>
                            </div>
                        </div>
                        <!-- BREADCRUMB ROW -->

                            <div>
                                <ul class="wt-breadcrumb breadcrumb-style-2">
                                    <li><a href="{{ url ('/') }}">{{ __('lang.menu_home') }}</a> /</li>
                                    <li>{{ __('lang.menu_contact') }}</li>
                                </ul>
                            </div>

                        <!-- BREADCRUMB ROW END -->
                    </div>
                </div>
            </div>
            <!-- INNER PAGE BANNER END -->

            <!-- CONTACT FORM -->
            <div class="section-full twm-contact-one">
                <div class="section-content">
                    <div class="container">

                        <!-- CONTACT FORM-->
                        <div class="contact-one-inner">
                            <div class="row">

                                <div class="col-lg-6 col-md-12">
                                    <div class="contact-form-outer">

                                        <!-- TITLE START-->
                                        <div class="section-head left wt-small-separator-outer">
                                            <h2 class="wt-title">{{ __('lang.contact_read_us') }}</h2>
                                            {{-- <p>Feel free to contact us and we will get back to you as soon as we can.</p> --}}
                                        </div>
                                        <!-- TITLE END-->

                                        <form  class="cons-contact-form" method="post" action="">
                                            <div class="row">

                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <input name="username" type="text" required class="form-control" placeholder="{{ __('lang.contact_read_us_input_name') }}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                    <input name="email" type="text" class="form-control" required placeholder="{{ __('lang.contact_read_us_input_mail') }}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <input name="phone" type="text" class="form-control" required placeholder="{{ __('lang.contact_read_us_input_phone') }}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <input name="subject" type="text" class="form-control" required placeholder="{{ __('lang.contact_read_us_input_title') }}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group mb-3">
                                                    <textarea name="message" class="form-control" rows="3" placeholder="{{ __('lang.contact_read_us_input_text') }}"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <button type="submit" class="site-button">{{ __('lang.contact_read_us_button_send') }}</button>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="contact-info-wrap">

                                        <div class="contact-info">
                                            <div class="contact-info-section">

                                                    <div class="c-info-column">
                                                        <div class="c-info-icon"><i class=" fas fa-map-marker-alt"></i></div>
                                                        <h3 class="twm-title">{{ __('lang.contact_read_us_address') }}</h3>
                                                        <p>I: {{ $companyInformation->address_1 }}</p>
                                                        <p> II: {{ $companyInformation->address_2 }}</p>
                                                    </div>

                                                    <div class="c-info-column">
                                                        <div class="c-info-icon custome-size"><i class="fas fa-mobile-alt"></i></div>
                                                        <h3 class="twm-title">{{ __('lang.contact_read_us_input_phone') }}</h3>
                                                        <p><a href="tel:{{ preg_replace('/[^0-9]/', '', $companyInformation->number) }}">{{ $companyInformation->number }}</a></p>
                                                    </div>

                                                    <div class="c-info-column">
                                                        <div class="c-info-icon"><i class="fas fa-envelope"></i></div>
                                                        <h3 class="twm-title">{{ __('lang.contact_read_us_input_mail') }}</h3>
                                                        <p>{{ $companyInformation->gmail }}</p>
                                                    </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="gmap-outline">
                <div class="google-map">
                    <div style="width: 100%">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d656.9115121022472!2d44.80063583721382!3d41.69788881546854!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40440ce667def78f%3A0xd2b59c205478e63!2s5%2F5a%20Archil%20Jorjadze%20St%2C%20T&#39;bilisi!5e1!3m2!1sen!2sge!4v1712650206577!5m2!1sen!2sge"
                            width="600"
                            height="450"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            style="filter: grayscale(0) hue-rotate(190deg);"
                        ></iframe>
                    </div>
                </div>
            </div>


        </div>
        <!-- CONTENT END -->
@endsection
