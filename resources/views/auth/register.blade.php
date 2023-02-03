@extends('layouts.appPage')

@section('content')
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
                            <a href="index.html">
                                <img src="images/logo-dark.png" alt="" class="logo">
                            </a>
                        </div>

                        <div class="twm-log-reg-inner">
                            <div class="twm-log-reg-head">
                                <div class="twm-log-reg-logo">
                                    <span class="log-reg-form-title">Log In</span>
                                </div>
                            </div>
                            <div class="twm-tabs-style-2">

                                <ul class="nav nav-tabs" id="myTab2" role="tablist">

                                    <!--Login Candidate-->
                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#twm-login-candidate" type="button"><i class="fas fa-user-tie"></i>Candidate</button>
                                    </li>
                                    <!--Login Employer-->
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#twm-login-Employer" type="button"><i class="fas fa-building"></i>Employer</button>
                                    </li>

                                </ul>

                                <div class="tab-content" id="myTab2Content">
                                    <!--Login Candidate Content-->
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                    <div class="twm-tabs-style-2">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                                            <!--Signup Candidate-->
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link"  id="candidateEvent"  type="button"><i class="fas fa-user-tie"></i>კანდიდატი</button>
                                            </li>
                                            <!--Signup Employer-->
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="employerEvent"   type="button"><i class="fas fa-building"></i>დამსაქმებელი</button>
                                            </li>

                                        </ul>
                                        <ul class="nav nav-tabs visually-hidden" id="employerTypeChoice" role="tablist">

                                            <!--Signup Candidate-->
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link"  id="personalEmployer"  type="button"><i class="fas fa-user-tie"></i>ფიზიკური პირი</button>
                                            </li>
                                            <!--Signup Employer-->
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="companyEmployer"   type="button"><i class="fas fa-building"></i>კომპანია</button>
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
                                                        <div class="form-group mb-3">
                                                            <input id="name_ka" type="text" class="form-control @error('name_ka') is-invalid @enderror" name="name_ka" value="{{ old('name_ka') }}"  autocomplete="name_ka" autofocus placeholder="სახელი გვარი*">

                                                            @error('name_ka')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="form-group mb-3">
                                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="მაილი*">

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
                                                            <input name="number" id="number" type="text" class="form-control @error('number') is-invalid @enderror" value="{{ old('number') }}"  placeholder="ნომერი*" onkeypress="return event.charCode != 32">
                                                            @error('number')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="form-group mb-3">
                                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="პაროლი*">

                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-lg-6">
                                                        <div class="form-group mb-3">
                                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="გაიმეორე პაროლი*">
                                                        </div>
                                                    </div> --}}

                                                    <div class="d-flex justify-content-between" id="date_gender">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>დაბადების თარიღი</label>
                                                                <div class="ls-inputicon-box">
                                                                    <input class="form-control " id="date_of_birth"  name="date_of_birth" type="date" placeholder="mm/dd/yyyy">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <div class="col-lg-5" >
                                                        <p>სქესი</p>
                                                            <div class="form-check form-check-inline">
                                                                <input type="radio" name="gender_id" value="1" class="form-check-input" id="exampleradio1">
                                                                <label class="form-check-label" for="exampleradio1">კაცი</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="radio" name="gender_id" value="2" class="form-check-input" id="exampleradio2">
                                                                <label class="form-check-label" for="exampleradio2">ქალი</label>
                                                            </div>

                                                    </div>

                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group mb-3">
                                                            <div class=" form-check">
                                                                <input type="checkbox" class="form-check-input  @error('agree') is-invalid @enderror" id="agree" name="agree">

                                                                <label class="form-check-label" for="agree1">I agree to the <a href="javascript:;">Terms and conditions</a></label>
                                                                @error('agree')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                                <p>Already registered?
                                                                    <button class="twm-backto-login" data-bs-target="#sign_up_popup2" data-bs-toggle="modal" data-bs-dismiss="modal">Log in here</button>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit" class="site-button">რეგისტრაცია</button>
                                                    </div>

                                            </div>
                                        </div>


                                        </div>
                                    </div>
                                </form>
                                    {{-- <div class="tab-pane fade show active" id="twm-login-candidate">
                                        <div class="row">

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <input name="username" type="text" required="" class="form-control" placeholder="Usearname*">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <input name="email" type="text" class="form-control" required="" placeholder="Password*">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="twm-forgot-wrap">
                                                    <div class="form-group mb-3">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="Password4">
                                                            <label class="form-check-label rem-forgot" for="Password4">Remember me <a href="javascript:;" class="site-text-primary">Forgot Password</a></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button type="submit" class="site-button">Log in</button>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <span class="center-text-or">Or</span>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button type="submit" class="log_with_facebook">
                                                        <i class="fab fa-facebook"></i>
                                                        Continue with Facebook
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button type="submit" class="log_with_google">
                                                        <img src="images/google-icon.png" alt="">
                                                        Continue with Google
                                                    </button>
                                                </div>
                                            </div>


                                        </div>
                                    </div> --}}

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
