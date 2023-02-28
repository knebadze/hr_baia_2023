{{-- Photo Upload --}}
@php
    $auth = Auth::user();
@endphp
<upload-avatar :auth='@json($auth)'></upload-avatar>

{{-- Menu --}}
<div class="twm-nav-list-1">
    <ul>
        <li @if(Route::currentRouteName() === 'home') class="active" @else class="" @endif><a href="{{ route('home' , App()->getLocale())  }}"><i class="fa fa-tachometer-alt"></i> {{ __('lang.user_page_candidate_left_side_bar_dashboard') }}</a></li>
        <li @if(Route::currentRouteName() === 'userProfile') class="active" @else class="" @endif><a href="{{ route('userProfile' , App()->getLocale())  }}"><i class="fa fa-user"></i> {{ __('lang.user_page_candidate_left_side_bar_profile') }}</a></li>
        @if (Auth::user()->user_type_id != 4)<li><a href="{{ route('work_information' , App()->getLocale())  }}"><i class="fa fa-suitcase"></i> {{ __('lang.user_page_candidate_left_side_bar_applied_jobs') }}</a></li>@endif
        <li><a href="{{ route('myrezume' , App()->getLocale())  }}"><i class="fa fa-receipt"></i> {{ __('lang.user_page_candidate_left_side_bar_my_resume') }}</a></li>
        <!-- <li><a href="candidate-saved-jobs.html"><i class="fa fa-file-download"></i> Saved Jobs</a></li> -->
        <!-- <li><a href="candidate-cv-manager.html"><i class="fa fa-paperclip"></i> CV Manager</a></li> -->
        <li><a href="#"><i class="fa fa-bell"></i> {{ __('lang.user_page_candidate_left_side_bar_job_alerts') }}</a></li>
        <li><a href="#"><i class="fa fa-fingerprint"></i> {{ __('lang.user_page_candidate_left_side_bar_change_psswd') }}</a></li>
        <!-- <li><a href="candidate-chat.html"><i class="fa fa-comments"></i>Chat</a></li> -->
    </ul>
</div>

<!-- Button trigger modal -->




