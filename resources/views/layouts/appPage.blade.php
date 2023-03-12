<!DOCTYPE html>
<html lang="en">

<head>

	<!-- META -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="description" content="" />

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" href="{{url('images/logo-baia.png')}}">

    <!-- PAGE TITLE HERE -->
    <title>@yield('title-block')</title>

    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}"><!-- BOOTSTRAP STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}"><!-- FONTAWESOME STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/feather.css') }}"><!-- FEATHER ICON SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.min.css') }}"><!-- OWL CAROUSEL STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/magnific-popup.min.css') }}"><!-- MAGNIFIC POPUP STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/lc_lightbox.css') }}"><!-- Lc light box popup -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-select.min.css') }}"><!-- BOOTSTRAP SLECT BOX STYLE SHEET  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap5.min.css') }}"><!-- DATA table STYLE SHEET  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/select.bootstrap5.min.css') }}"><!-- DASHBOARD select bootstrap  STYLE SHEET  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dropzone.css') }}"><!-- DROPZONE STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/scrollbar.css') }}"><!-- CUSTOM SCROLL BAR STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datepicker.css') }}"><!-- DATEPICKER STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/flaticon.css') }}"> <!-- Flaticon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}"><!-- MAIN STYLE SHEET -->
    <script  src="{{ asset('js/jquery-3.6.0.min.js') }}"></script><!-- JQUERY.MIN JS -->

    {{-- <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly"
      defer
    ></script>
    <script>
        window.initMap = initMap;
    </script> --}}

    {{-- //mapBox --}}
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.css' rel='stylesheet' />
    <!-- Load the `mapbox-gl-geocoder` plugin. -->
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">
    <script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>


    {{-- <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css"> --}}

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>
<body>
    <script>

        window.default_locale = "{{ App::getLocale() }}";
        var localLang = window.default_locale
        localStorage.setItem('localLang', localLang);
    </script>
     <!-- LOADING AREA START ===== -->
     <div class="loading-area">
        <div class="loading-box"></div>
        <div class="loading-pic">
            <div class="wrapper">
                <div class="cssload-loader"></div>
            </div>
        </div>
    </div>
    <!-- LOADING AREA  END ====== -->

    <div class="page-wraper" id="app">
        @include('inc.header')

        @yield('content')

        @include('inc.footer')

        <!-- BUTTON TOP START -->
		<button class="scroltop"><span class="fa fa-angle-up  relative" id="btn-vibrate"></span></button>
        @if (count($errors) > 0)
        <script>
            $( document ).ready(function() {
                $('#sign_up_popup').modal('show');
            });
        </script>
        @endif
        @php
            $auth = Auth::user();
        @endphp
        <modal-manager :auth='@json($auth)'></modal-manager>

        <!--Model Popup Section Start-->
            <!--Signup popup -->
            <div class="modal fade twm-sign-up" id="sign_up_popup" aria-hidden="true" aria-labelledby="sign_up_popupLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        {{-- <form> --}}

                            <div class="modal-header">
                                <h2 class="modal-title" id="sign_up_popupLabel">{{ __('lang.modal_registration_title') }}</h2>
                                <p>{{ __('lang.modal_registration_sign_up') }}</p>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form method="POST" action="{{ route('register' ,app()->getLocale()) }}">
                                    @csrf
                                <div class="twm-tabs-style-2">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                                        <!--Signup Candidate-->
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link"  id="candidateEvent"  type="button"><i class="fas fa-user-tie"></i>{{ __('lang.modal_registration_candidate') }}</button>
                                        </li>
                                        <!--Signup Employer-->
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="employerEvent"   type="button"><i class="fas fa-building"></i>{{ __('lang.modal_registration_employer') }}</button>
                                        </li>

                                    </ul>
                                    <ul class="nav nav-tabs visually-hidden" id="employerTypeChoice" role="tablist">

                                        <!--Signup Candidate-->
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link"  id="personalEmployer"  type="button"><i class="fas fa-user-tie"></i>{{ __('lang.modal_registration_physical_person') }}</button>
                                        </li>
                                        <!--Signup Employer-->
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="companyEmployer"   type="button"><i class="fas fa-building"></i>{{ __('lang.modal_registration_company') }}</button>
                                        </li>
                                    </ul>
                                    <input type="text" name="user_type_id" value="{{ old('user_type_id') }}" class="form-control @error('user_type_id') is-invalid @enderror" id="user_type_id" hidden>
                                    @error('user_type_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div class="tab-content" id="myTabContent">
                                    <!--Signup Candidate Content-->
                                    <div class="tab-pane fade show active" id="sign-up">
                                        <div class="row">


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
                                                {{-- <div class="col-lg-6">
                                                    <div class="form-group mb-3">
                                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('lang.modal_registration_repeat') }}">
                                                    </div>
                                                </div> --}}

                                                <div class="d-flex justify-content-between" id="date_gender">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>{{ __('lang.modal_registration_birth_date') }}</label>
                                                            <div class="ls-inputicon-box">
                                                                <input class="form-control " id="date_of_birth"  name="date_of_birth" type="date" placeholder="mm/dd/yyyy">
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
                                                            <p>{{ __('lang.modal_registration_already_registered?') }}
                                                                <button class="twm-backto-login" data-bs-target="#sign_up_popup2" data-bs-toggle="modal" data-bs-dismiss="modal">{{ __('lang.modal_registration_log_in_here') }}</button>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="submit" class="site-button">{{ __('lang.modal_registration_button') }}</button>
                                                </div>

                                        </div>
                                    </div>


                                    </div>
                                </div>
                            </form>
                            </div>

                            <div class="modal-footer">
                                <span class="modal-f-title">{{ __('lang.modal_registration_with') }}</span>
                                <ul class="twm-modal-social">
                                    <li><a href="{{ route('auth.social.redirect', 'facebook') }}" class="facebook-clr"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="{{ route('auth.social.redirect', 'google') }}" class="google-clr"><i class="fab fa-google"></i></a></li>
                                </ul>
                            </div>

                        {{-- </form> --}}
                    </div>
                </div>

            </div>
            <!--Login popup -->
            <div class="modal fade twm-sign-up" id="sign_up_popup2" aria-hidden="true" aria-labelledby="sign_up_popupLabel2" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        {{-- <form> --}}
                            <div class="modal-header">
                                <h2 class="modal-title" id="sign_up_popupLabel2">{{ __('lang.modal_login_title') }}</h2>
                                <p>{{ __('lang.modal_login_access') }}</p>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="twm-tabs-style-2">

                                    <div class="tab-content" id="myTab2Content">
                                        <form method="POST" action="{{ route('login', app()->getLocale()) }}">
                                            @csrf
                                        <!--Login Candidate Content-->
                                        <div class="tab-pane fade show active" id="login-candidate">
                                            <div class="row">

                                                <div class="col-lg-12">
                                                    <div class="form-group mb-3">
                                                        <input id="emailOrPhone" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('lang.modal_login_email_or_number') }}">

                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group mb-3">
                                                        <input id="logInPassword" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('lang.modal_login_password') }}">

                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="col-lg-12">
                                                    <div class="form-group mb-3">
                                                        <div class=" form-check">
                                                            <input type="checkbox" class="form-check-input" id="Password3">
                                                            <label class="form-check-label rem-forgot" for="Password3">
                                                                {{ __('lang.modal_login_password_remember') }}
                                                                <a href="#">{{ __('lang.modal_login_password_forgot') }}</a></label>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="submit" class="site-button">{{ __('lang.modal_login_sign_in') }}</button>
                                                    <div class="mt-3 mb-3">{{ __('lang.modal_login_dont_have_account') }}
                                                        <button class="twm-backto-login" data-bs-target="#sign_up_popup" data-bs-toggle="modal" data-bs-dismiss="modal">{{ __('lang.modal_login_sign_up') }}</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <span class="modal-f-title">{{ __('lang.modal_login_with') }}</span>
                                <ul class="twm-modal-social">
                                    <li><a href="{{ route('auth.social.redirect', 'facebook') }}" class="facebook-clr"><i class="fab fa-facebook-f"></i></a></li>
                                    {{-- <li><a href="javascript.html" class="twitter-clr"><i class="fab fa-twitter"></i></a></li> --}}
                                    {{-- <li><a href="javascript.html" class="linkedin-clr"><i class="fab fa-linkedin-in"></i></a></li> --}}
                                    <li><a href="{{ route('auth.social.redirect', 'google') }}" class="google-clr"><i class="fab fa-google"></i></a></li>
                                </ul>
                            </div>
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        <!--Model Popup Section End-->


  </div>
    </div>

    <!-- JAVASCRIPT  FILES ========================================= -->

    <script  src="{{ asset('js/popper.min.js') }}"></script><!-- POPPER.MIN JS -->
    <script  src="{{ asset('js/bootstrap.min.js') }}"></script><!-- BOOTSTRAP.MIN JS -->
    <script  src="{{ asset('js/magnific-popup.min.js') }}"></script><!-- MAGNIFIC-POPUP JS -->
    <script  src="{{ asset('js/waypoints.min.js') }}"></script><!-- WAYPOINTS JS -->
    <script  src="{{ asset('js/counterup.min.js') }}"></script><!-- COUNTERUP JS -->
    <script  src="{{ asset('js/waypoints-sticky.min.js') }}"></script><!-- STICKY HEADER -->
    <script  src="{{ asset('js/isotope.pkgd.min.js') }}"></script><!-- MASONRY  -->
    <script  src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script><!-- MASONRY  -->
    <script  src="{{ asset('js/owl.carousel.min.js') }}"></script><!-- OWL  SLIDER  -->
    <script  src="{{ asset('js/theia-sticky-sidebar.js') }}"></script><!-- STICKY SIDEBAR  -->
    <script  src="{{ asset('js/lc_lightbox.lite.js') }}" ></script><!-- IMAGE POPUP -->
    <script  src="{{ asset('js/bootstrap-select.min.js') }}"></script><!-- Form js -->
    <script  src="{{ asset('js/dropzone.js') }}"></script><!-- IMAGE UPLOAD  -->
    <script  src="{{ asset('js/jquery.scrollbar.js') }}"></script><!-- scroller -->
    <script  src="{{ asset('js/bootstrap-datepicker.js') }}"></script><!-- scroller -->
    <script  src="{{ asset('js/jquery.dataTables.min.js') }}"></script><!-- Datatable -->
    <script  src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script><!-- Datatable -->
    <script  src="{{ asset('js/chart.js') }}"></script><!-- Chart -->
    <script  src="{{ asset('js/custom.js') }}"></script><!-- CUSTOM FUCTIONS  -->
    <script  src="{{ asset('js/register_form.js') }}"></script><!-- MY ADD JS  -->

</body>
</html>
