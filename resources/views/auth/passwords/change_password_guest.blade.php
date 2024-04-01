@extends('layouts.logInApp')

@section('content')
       <!-- CONTENT START -->
       <div class="page-content">




        <!-- Login Section Start -->
        <div class="section-full site-bg-white">

            <div class="container-fluid">
                <div class="d-flex justify-content-center py-3">
                    <div class="col-xl-6 col-lg-6 col-md-12  " style="border-style: solid;
                    border-color: #1877f2; border-width: 1px; border-radius:10px; box-shadow: rgba(95, 121, 189, 0.35) 0px 5px 15px;">
                        <div class="twm-log-reg-form-wrap">
                            <div class="twm-log-reg-logo-head">
                                <a href="{{ url ('/') }}">
                                    <img src="{{ asset('/images/logo-baia.png') }}" alt="" class="logo">
                                </a>
                            </div>

                            <div class="twm-log-reg-inner">
                                <div class="twm-log-reg-head">
                                    <div class="twm-log-reg-logo">
                                        <span class="log-reg-form-title">{{ __('lang.forgot-password') }}</span>
                                    </div>
                                </div>
                                <div class="twm-tabs-style-2">


                                        <form method="POST" action="{{ route('guest.update_password', app()->getLocale()) }}">
                                            @csrf
                                            <input id="id" type="number" name="id" class="d-none" value="{{ $id }}">
                                            <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-12">

                                                <div class="form-group mb-3">
                                                    <div class="input-group">
                                                        <input id="password" type="password" class="form-control psswdInputBlock @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('lang.modal_registration_password') }}">

                                                            <span class="input-group-text hiddenPsswd" id="togglePassword">
                                                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                            </span>

                                                    </div>
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-12">
                                                <div class="form-group mb-3 ">
                                                    <div class="input-group ">
                                                        <input id="password-confirm" type="password" class="form-control psswdInputBlock @error('password_confirmation') is-invalid @enderror"  name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('გაიმეორეთ პაროლი') }}">

                                                            <span class="input-group-text hiddenPsswd" id="confirmPassword">
                                                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                            </span>

                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button type="submit" class="site-button">{{ __('lang.change_password_btn') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                        </form>



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
        <!-- Login Section End -->



    </div>
    <!-- CONTENT END -->

@endsection
