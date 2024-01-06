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
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/carousel.css') }}"><!-- OWL CAROUSEL STYLE SHEET --> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/magnific-popup.min.css') }}"><!-- MAGNIFIC POPUP STYLE SHEET --> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/lc_lightbox.css') }}"><!-- Lc light box popup -->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-select.min.css') }}"><!-- BOOTSTRAP SLECT BOX STYLE SHEET  --> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap5.min.css') }}"><!-- DATA table STYLE SHEET  --> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/select.bootstrap5.min.css') }}"><!-- DASHBOARD select bootstrap  STYLE SHEET  --> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/dropzone.css') }}"><!-- DROPZONE STYLE SHEET --> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/scrollbar.css') }}"><!-- CUSTOM SCROLL BAR STYLE SHEET -->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/datepicker.css') }}"><!-- DATEPICKER STYLE SHEET --> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/flaticon.css') }}"> <!-- Flaticon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}"><!-- MAIN STYLE SHEET -->
    <script  src="{{ asset('js/jquery-3.6.0.min.js') }}"></script><!-- JQUERY.MIN JS -->



    {{-- //mapBox --}}
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.css' rel='stylesheet' />
    <!-- Load the `mapbox-gl-geocoder` plugin. -->
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">
    <script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>


    <link rel="stylesheet" href="{{asset('build/assets/app-17decf63.css') }}">
    <link rel="stylesheet" href="{{asset('build/assets/app-74b23952.css') }}">
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}


</head>
<body>

    <!-- LOADING AREA START ===== -->
    {{-- <div class="loading-area">
        <div class="loading-box"></div>
        <div class="loading-pic">
            <div class="wrapper">
                <div class="cssload-loader"></div>
            </div>
        </div>
    </div> --}}
    <!-- LOADING AREA  END ====== -->

    <script>

        window.default_locale = "{{ App::getLocale() }}";
        var localLang = window.default_locale
        localStorage.setItem('localLang', localLang);
    </script>
     <!-- LOADING AREA START ===== -->
     {{-- <div class="loading-area">
        <div class="loading-box"></div>
        <div class="loading-pic">
            <div class="wrapper">
                <div class="cssload-loader"></div>
            </div>
        </div>
    </div> --}}
    <!-- LOADING AREA  END ====== -->

    <div class="page-wraper" >
        @include('inc.header')
        <div id="app">
            @yield('content')
        </div>

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
        {{-- <modal-manager :auth='@json($auth)'></modal-manager> --}}



  </div>
    </div>

    <!-- JAVASCRIPT  FILES ========================================= -->
  {{-- <script  src="{{ asset('js/popper.min.js') }}"></script><!-- POPPER.MIN JS --> --}}
  <script  src="{{ asset('js/bootstrap.min.js') }}"></script><!-- BOOTSTRAP.MIN JS -->
  <script  src="{{ asset('js/magnific-popup.min.js') }}"></script><!-- MAGNIFIC-POPUP JS -->
  <script  src="{{ asset('js/waypoints.min.js') }}"></script><!-- WAYPOINTS JS -->
  {{-- <script  src="{{ asset('js/counterup.min.js') }}"></script><!-- COUNTERUP JS --> --}}
  <script  src="{{ asset('js/waypoints-sticky.min.js') }}"></script><!-- STICKY HEADER -->
  {{-- <script  src="{{ asset('js/isotope.pkgd.min.js') }}"></script><!-- MASONRY  --> --}}
  {{-- <script  src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script><!-- MASONRY  --> --}}

  {{-- <script  src="{{ asset('js/carusel.js') }}"></script><!-- OWL  SLIDER  --> --}}
  <script  src="{{ asset('js/owl.carousel.min.js') }}"></script><!-- OWL  SLIDER  -->
  <script  src="{{ asset('js/theia-sticky-sidebar.js') }}"></script><!-- STICKY SIDEBAR  -->
  <script  src="{{ asset('js/lc_lightbox.lite.js') }}" ></script><!-- IMAGE POPUP -->
  <script  src="{{ asset('js/bootstrap-select.min.js') }}"></script><!-- Form js -->
  {{-- <script  src="{{ asset('js/dropzone.js') }}"></script><!-- IMAGE UPLOAD  --> --}}
  <script  src="{{ asset('js/jquery.scrollbar.js') }}"></script><!-- scroller -->
  {{-- <script  src="{{ asset('js/bootstrap-datepicker.js') }}"></script><!-- scroller --> --}}
  {{-- <script  src="{{ asset('js/jquery.dataTables.min.js') }}"></script><!-- Datatable --> --}}
  {{-- <script  src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script><!-- Datatable --> --}}
  {{-- <script  src="{{ asset('js/chart.js') }}"></script><!-- Chart --> --}}
  <script  src="{{ asset('js/custom.js') }}"></script><!-- CUSTOM FUCTIONS  -->
  {{-- <script  src="{{ asset('js/register_form.js') }}"></script><!-- MY ADD JS  --> --}}
    {{-- <script  src="{{ asset('js/register_form.js') }}"></script><!-- MY ADD JS  --> --}}

    <script type="module" src="{{ asset('build/assets/app-4ed993c7.js') }}"></script>
    <script type="module" src="{{ asset('build/assets/app-6205d15e.js') }}"></script>
</body>
</html>
