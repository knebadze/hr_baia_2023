@extends('layouts.logInApp')

@section('content')

{{-- @php
    $language = request()->query()['locale'];
    dd($language);
@endphp --}}
       <!-- CONTENT START -->
       <div class="page-content">




        <!-- Login Section Start -->
        <div class="section-full site-bg-white">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-8 col-lg-6 col-md-5 twm-log-reg-media-wrap">
                        <div class="twm-log-reg-media">
                            <div class="twm-l-media">
                                <img src="images/login-bg.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-7">
                        <div class="twm-log-reg-form-wrap">
                            <div class="twm-log-reg-logo-head">
                                <a href="{{ url ('/') }}">
                                    <img src="/images/logo-baia.png" alt="" class="logo">
                                </a>
                            </div>

                            <div class="twm-log-reg-inner">
                                <div class="twm-log-reg-head">
                                    <div class="twm-log-reg-logo">
                                        <span class="log-reg-form-title">{{ __('lang.modal_login_title') }}</span>
                                    </div>
                                </div>
                                <div class="twm-tabs-style-2">

                                    <div class="row">
                                        <form method="POST" action="{{ route('login', app()->getLocale()) }}">
                                            @csrf

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <input id="emailOrPhone" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('599555000') }}">

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <div class="input-group">
                                                    <input id="logInPassword" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('lang.modal_login_password') }}">

                                                            <span class="input-group-text hiddenPsswd" id="togglePassword">
                                                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                            </span>

                                                    </div>
                                                    <script>
                                                        document.getElementById("togglePassword").addEventListener("click", function() {
                                                            var passwordInput = document.getElementById("logInPassword");
                                                            var type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
                                                            passwordInput.setAttribute("type", type);
                                                            this.querySelector("i").classList.toggle("fa-eye");
                                                            this.querySelector("i").classList.toggle("fa-eye-slash");
                                                        });
                                                    </script>

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="twm-forgot-wrap">
                                                    <div class="form-group mb-3">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="Password3">
                                                            <label class="form-check-label rem-forgot" for="Password3">
                                                                {{ __('lang.modal_login_password_remember') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3 ">
                                                    <a class="text-primary" href="#">{{ __('lang.modal_login_password_forgot') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button type="submit" class="site-button">{{ __('lang.modal_login_sign_in') }}</button>
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
                                            <div class="mt-3 mb-3">{{ __('lang.modal_login_dont_have_account') }}
                                                <a href="{{ route('register', App()->getLocale()) }}"><u class="text-primary">{{ __('lang.modal_login_sign_up') }}</u></a>
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
