<div class="twm-mid-content text-center">
    <a href="candidate-detail.html" class="twm-job-title">
        <h4>{{ Auth::user()->name_ka }} </h4>
    </a>
    {{-- <p>IT Contractor</p> --}}
</div>
{{-- Photo Upload --}}
@php
    $auth = Auth::user();
@endphp
{{-- <div class="twm-candidate-profile-pic">
    <img src="{{ asset('images/user-avatar/'.$auth->avatar) }}"> --}}
    <upload-avatar :auth='@json($auth)'></upload-avatar>
{{-- </div> --}}
{{-- Menu --}}
<div class="twm-nav-list-1">
    <ul>
        <li @if(Route::currentRouteName() === 'home') class="active" @else class="" @endif><a href="{{ route('home' , App()->getLocale())  }}"><i class="fa fa-tachometer-alt"></i> {{ __('lang.user_page_candidate_left_side_bar_dashboard') }}</a></li>
        <li @if(Route::currentRouteName() === 'userProfile') class="active" @else class="" @endif><a href="{{ route('userProfile' , App()->getLocale())  }}"><i class="fa fa-user"></i> {{ __('lang.user_page_candidate_left_side_bar_profile') }}</a></li>

            {{-- @if (Auth::user()->status != 0) --}}
                {{-- <li ><a href="{{ route('work_information' , App()->getLocale())  }}"><i class="fa fa-file-download"></i> {{ __('lang.user_page_candidate_left_side_bar_work_info') }}</a></li> --}}
            {{-- @endif --}}
            @if (Auth::user()->candidate && Auth::user()->candidate->status_id != 8)
                <li><a href="{{ route('myrezume' , App()->getLocale())  }}"><i class="fa fa-receipt"></i> {{ __('lang.user_page_candidate_left_side_bar_my_resume') }}</a></li>
            @endif


        {{-- @if (Auth::user()->user_type_id != 4)<li><a href="{{ route('user.vacancy' , App()->getLocale())  }}"><i class="fa fa-suitcase"></i> {{ __('lang.user_page_candidate_left_side_bar_applied_jobs') }}</a></li>@endif --}}


        <!-- <li><a href="candidate-cv-manager.html"><i class="fa fa-paperclip"></i> CV Manager</a></li> -->
        {{-- <li><a href="#" class="d-flex justify-content-between position-relative"><i class="fa fa-bell"></i> {{ __('lang.user_page_candidate_left_side_bar_job_alerts') }}<span class=" position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span></a></li> --}}
        <li><a href="{{ route('auth.password.change_password', App()->getLocale()) }}"><i class="fa fa-fingerprint"></i> {{ __('lang.user_page_candidate_left_side_bar_change_psswd') }}</a></li>
        <!-- <li><a href="candidate-chat.html"><i class="fa fa-comments"></i>Chat</a></li> -->
    </ul>
</div>

<!-- Button trigger modal -->




