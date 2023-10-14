@extends('layouts.logInApp')

@section('content')


       <!-- CONTENT START -->
       <div class="page-content">




        <!-- Login Section Start -->
        <div class="section-full site-bg-white">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-7 col-lg-6 col-md-5 twm-log-reg-media-wrap">
                        <div class="twm-log-reg-media">
                            <div class="twm-l-media">
                                <img src="images/login-bg.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-7">
                        <div class="twm-log-reg-form-wrap">
                            <div class="twm-log-reg-logo-head">
                                <a href="index.html">
                                    <img src="images/logo-dark.png" alt="" class="logo">
                                </a>
                            </div>

                            <div class="twm-log-reg-inner">
                                <div class="twm-log-reg-head">
                                    <div class="twm-log-reg-logo">
                                        <span class="log-reg-form-title">{{ __('lang.modal_registration_title') }}</span>
                                    </div>
                                </div>
                                <div class="twm-tabs-style-2">

                                    <div class="row">
                                        <form method="POST" action="{{ route('register' ,app()->getLocale()) }}">
                                            @csrf
                                            <div class="col-lg-12">
                                                @if (app()->getLocale() == 'ka')
                                                    <div class="form-group mb-3">
                                                        <input id="name_ka" type="text" class="form-control @error('name_ka') is-invalid @enderror" name="name_ka" value="{{ old('name_ka') }}"  autocomplete="name_ka" autofocus placeholder="{{ __('lang.modal_registration_name_surname') }}">

                                                        @error('name_ka')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                @elseif (app()->getLocale() == 'en')
                                                    <div class="form-group mb-3">
                                                        <input id="name_en" type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en" value="{{ old('name_en') }}"  autocomplete="name_en" autofocus placeholder="{{ __('lang.modal_registration_name_surname') }}">

                                                        @error('name_en')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                @else
                                                    <div class="form-group mb-3">
                                                        <input id="name_ru" type="text" class="form-control @error('name_ru') is-invalid @enderror" name="name_ru" value="{{ old('name_ru') }}"  autocomplete="name_ru" autofocus placeholder="{{ __('lang.modal_registration_name_surname') }}">

                                                        @error('name_ru')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                @endif

                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('lang.modal_registration_mail') }}">

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="input-group  mb-3">
                                                    <span class="input-group-text border border-0">+995</span>
                                                    <input name="number" id="number" type="text" class="form-control @error('number') is-invalid @enderror" value="{{ old('number') }}"  placeholder="{{ __('lang.modal_registration_number') }}" onkeypress="return event.charCode != 32">
                                                    @error('number')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('lang.modal_registration_password') }}">

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>{{ __('lang.modal_registration_birth_date') }}</label>
                                                    <div class="ls-inputicon-box">
                                                        <input class="form-control " id="date_of_birth"  name="date_of_birth" type="date" placeholder="mm/dd/yyyy">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <p>{{ __('lang.modal_registration_gender') }}</p>
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" name="gender_id" value="1" class="form-check-input" id="exampleradio1">
                                                            <label class="form-check-label" for="exampleradio1">{{ __('lang.modal_registration_gender_male') }}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" name="gender_id" value="2" class="form-check-input" id="exampleradio2">
                                                            <label class="form-check-label" for="exampleradio2">{{ __('lang.modal_registration_gender_female') }}</label>
                                                        </div>
                                            </div> --}}
                                            <div class="d-flex justify-content-between" id="date_gender">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>{{ __('lang.modal_registration_birth_date') }}</label>
                                                        <div class="ls-inputicon-box">
                                                            <input class="form-control" id="date_of_birth" name="date_of_birth" type="date" placeholder="mm/dd/yyyy">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-5" >
                                                    <p>{{ __('lang.modal_registration_gender') }}</p>
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" name="gender_id" value="1" class="form-check-input" id="exampleradio1">
                                                            <label class="form-check-label" for="exampleradio1">{{ __('lang.modal_registration_gender_male') }}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" name="gender_id" value="2" class="form-check-input" id="exampleradio2">
                                                            <label class="form-check-label" for="exampleradio2">{{ __('lang.modal_registration_gender_female') }}</label>
                                                        </div>

                                                </div>
                                            </div>


                                            {{-- <div class="col-lg-12">
                                                <div class="twm-forgot-wrap">
                                                    <div class="form-group mb-3">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="Password3">
                                                            <label class="form-check-label rem-forgot" for="Password3">
                                                                {{ __('lang.modal_login_password_remember') }}
                                                                <a href="#">{{ __('lang.modal_login_password_forgot') }}</a></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <div class=" form-check">
                                                        <input type="checkbox" class="form-check-input  @error('agree') is-invalid @enderror" id="agree" name="agree">

                                                        <label class="form-check-label" for="agree1">{{ __('lang.modal_registration_agree_1') }} <a href="#">{{ __('lang.modal_registration_agree_2') }}</a></label>
                                                        @error('agree')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        {{-- <p>{{ __('lang.modal_registration_already_registered?') }}
                                                            <button class="twm-backto-login" data-bs-target="#sign_up_popup2" data-bs-toggle="modal" data-bs-dismiss="modal">{{ __('lang.modal_registration_log_in_here') }}</button>
                                                        </p> --}}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button type="submit" class="site-button">{{ __('lang.modal_registration_button') }}</button>
                                                </div>
                                            </div>
                                        </form>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span class="center-text-or">Or</span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <form action="{{ route('auth.social.redirect', 'facebook') }}" method="GET">
                                                    @csrf
                                                    <button type="submit" class="log_with_facebook">
                                                        <i class="fab fa-facebook"></i>
                                                        Continue with Facebook
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <form action="{{ route('auth.social.redirect', 'google') }}" method="GET">
                                                    @csrf
                                                    <button type="submit" class="log_with_google">
                                                        <img src="images/google-icon.png" alt="">
                                                        Continue with Google
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mt-3 mb-3">{{ __('lang.modal_registration_already_registered?') }}
                                                <a href="{{ route('login', App()->getLocale()) }}"><u class="text-primary">{{ __('lang.modal_registration_log_in_here') }}</u></a>
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
        <!-- Login Section End -->



    </div>
    <!-- CONTENT END -->

@endsection
