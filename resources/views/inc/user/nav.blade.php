<div class="twm-nav-list-1">
    <ul>
        <li @if(Route::currentRouteName() === 'home') class="active" @else class="" @endif><a href="{{ route('home' , App()->getLocale())  }}"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
        <li @if(Route::currentRouteName() === 'candidateProfile') class="active" @else class="" @endif><a href="{{ route('candidateProfile' , App()->getLocale())  }}"><i class="fa fa-user"></i> My Pfofile</a></li>
        <li><a href="candidate-jobs-applied.html"><i class="fa fa-suitcase"></i> Applied Jobs</a></li>
        <li><a href="candidate-my-resume.html"><i class="fa fa-receipt"></i> My Resume</a></li>
        <li><a href="candidate-saved-jobs.html"><i class="fa fa-file-download"></i> Saved Jobs</a></li>
        <li><a href="candidate-cv-manager.html"><i class="fa fa-paperclip"></i> CV Manager</a></li>
        <li><a href="candidate-job-alert.html"><i class="fa fa-bell"></i> Job Alerts</a></li>
        <li><a href="candidate-change-password.html"><i class="fa fa-fingerprint"></i> Change Passeord</a></li>
        <li><a href="candidate-chat.html"><i class="fa fa-comments"></i>Chat</a></li>
    </ul>
</div>
