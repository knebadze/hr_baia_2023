<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from thewebmax.org/jobzilla/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 24 Jan 2023 11:20:12 GMT -->
<head>
    <!-- META -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="description" content="" />

    <!-- FAVICONS ICON -->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />

    <!-- PAGE TITLE HERE -->
    {{-- <title>Jobzilla Template | Login</title> --}}

    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}"><!-- BOOTSTRAP STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}"><!-- FONTAWESOME STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/feather.css') }}"><!-- FEATHER ICON SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.min.css') }}"><!-- OWL CAROUSEL STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/lc_lightbox.css') }}"><!-- Lc light box popup -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}"><!-- MAIN STYLE SHEET -->
    <script  src="{{ asset('js/jquery-3.6.0.min.js') }}"></script><!-- JQUERY.MIN JS -->

</head>

<body>



	<div class="page-wraper">



        @yield('content')
        @include('inc.footer')

        <!--Model Popup Section End-->

 	</div>


<!-- JAVASCRIPT  FILES ========================================= -->
  <script  src="{{ asset('js/bootstrap.min.js') }}"></script><!-- BOOTSTRAP.MIN JS -->
  <script  src="{{ asset('js/magnific-popup.min.js') }}"></script><!-- MAGNIFIC-POPUP JS -->
  <script  src="{{ asset('js/waypoints.min.js') }}"></script><!-- WAYPOINTS JS -->
  <script  src="{{ asset('js/waypoints-sticky.min.js') }}"></script><!-- STICKY HEADER -->
  <script  src="{{ asset('js/owl.carousel.min.js') }}"></script><!-- OWL  SLIDER  -->
  <script  src="{{ asset('js/theia-sticky-sidebar.js') }}"></script><!-- STICKY SIDEBAR  -->
  <script  src="{{ asset('js/lc_lightbox.lite.js') }}" ></script><!-- IMAGE POPUP -->
  <script  src="{{ asset('js/bootstrap-select.min.js') }}"></script><!-- Form js -->
  <script  src="{{ asset('js/custom.js') }}"></script><!-- CUSTOM FUCTIONS  -->
  <script>
    document.getElementById("togglePassword").addEventListener("click", function() {
        var passwordInput = document.getElementById("password");
        var type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
        passwordInput.setAttribute("type", type);
        this.querySelector("i").classList.toggle("fa-eye");
        this.querySelector("i").classList.toggle("fa-eye-slash");
    });
    </script>
    {{-- hgdf --}}

<script>
    document.getElementById("confirmPassword").addEventListener("click", function() {
        var passwordInput = document.getElementById("password-confirm");
        var type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
        passwordInput.setAttribute("type", type);
        this.querySelector("i").classList.toggle("fa-eye");
        this.querySelector("i").classList.toggle("fa-eye-slash");
    });
    </script>


</body>


<!-- Mirrored from thewebmax.org/jobzilla/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 24 Jan 2023 11:20:12 GMT -->
</html>
