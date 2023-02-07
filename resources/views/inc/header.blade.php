<!-- HEADER START -->
<header  class="site-header header-style-3 mobile-sider-drawer-menu">

    <div class="sticky-header main-bar-wraper  navbar-expand-lg">
        <div class="main-bar">

            <div class="container-fluid clearfix">

                <div class="logo-header">
                    <div class="logo-header-inner logo-header-one">
                        <a href="{{ url ('/') }}">
                        <img src="/images/head-logo.png" alt="">
                        </a>
                    </div>
                </div>

                <!-- NAV Toggle Button -->
                <button id="mobile-side-drawer" data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggler collapsed">
                    <span class="sr-only"></span>
                    <span class="icon-bar icon-bar-first"></span>
                    <span class="icon-bar icon-bar-two"></span>
                    <span class="icon-bar icon-bar-three"></span>
                </button>

                <!-- MAIN Vav -->
                <div class="nav-animation header-nav navbar-collapse collapse d-flex justify-content-center">

                    <ul class="nav navbar-nav">
                        <li class="activeClass"><a href="{{ route('welcome' , App()->getLocale())  }}">{{ __('lang.menu_home') }}</a></li>
                        {{-- <li class="has-child"><a href="javascript:;">მთავარი</a>
                            <ul class="sub-menu">
                                <li><a href="index.html">Home-1</a></li>
                                <li><a href="index-2.html">Home-2</a></li>
                                <li><a href="index-3.html">Home-3</a></li>
                                <li><a href="index-4.html">Home-4</a></li>
                            </ul>
                        </li> --}}
                        <li class="has-child"><a href="javascript:;">{{ __('lang.menu_vacancies') }}</a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('individual' , App()->getLocale())  }}">{{ __('lang.menu_individual_vacancies') }}</a></li>
                                <li><a href="{{ route('company' , App()->getLocale())  }}">{{ __('lang.menu_company_vacancies') }}</a></li>
                                <li><a href="{{ route('onmap' , App()->getLocale())  }}">{{ __('lang.menu_vacancies_onmap') }}</a></li>
                                {{-- <li><a href="job-grid.html">Jobs Grid</a></li>
                                <li><a href="job-grid-with-map.html">Jobs Grid with Map</a></li>
                                <li><a href="job-list.html">Jobs List</a></li>
                                <li class="has-child"><a href="javascript:;">Job Detail</a>
                                    <ul class="sub-menu">
                                        <li><a href="job-detail.html">Detail 1</a>
                                        <li><a href="job-detail-v2.html">Detail 2 </a>
                                    </ul>
                                </li>
                                <li><a href="apply-job.html">Apply Jobs</a></li> --}}
                            </ul>
                        </li>
                        {{-- <li class="has-child"><a href="javascript:;">დამსაქმებლები</a>
                            <ul class="sub-menu">
                                <li><a href="employer-grid.html">Employers Grid</a></li>
                                <li><a href="employer-list.html">Employers List</a></li>
                                <li class="has-child"><a href="javascript:;">Employers Detail</a>
                                    <ul class="sub-menu">
                                        <li><a href="employer-detail.html">Detail 1</a>
                                        <li><a href="employer-detail-v2.html">Detail 2</a>
                                    </ul>
                                </li>
                                <li><a href="employer-profile.html">Profile</a></li>
                                <li><a href="employer-resume.html">Resume</a></li>
                                <li><a href="employer-manage-jobs.html">Manage Jobs</a></li>
                                <li><a href="employer-post-job.html">Post A Jobs</a></li>
                                <li><a href="employer-transaction.html">Transaction</a></li>
                                <li><a href="candidate-grid.html">Browse Candidates</a></li>
                                <li><a href="employer-change-password.html">Change Password</a></li>
                                <li><a href="employer-account-fresher.html">Register Fresher</a></li>
                                <li><a href="employer-account-professional.html">Register Professionals</a></li>
                            </ul>
                        </li> --}}
                        <li><a href="{{ route('about' , App()->getLocale())  }}">{{ __('lang.menu_about_us') }}</a></li>
                        {{-- <li class="has-child"><a href="javascript:;">page</a>
                            <ul class="sub-menu">
                                <li><a href="about-1.html">About Us</a></li>
                                <li><a href="pricing.html">Pricing</a></li>
                                <li><a href="error-404.html">Error-404</a></li>
                                <li><a href="faq.html">FAQ's</a></li>
                                <li><a href="contact.html">Contact Us</a></li>
                                <li><a href="under-maintenance.html">Under Maintenance</a></li>
                                <li><a href="coming-soon.html">Coming soon</a></li>
                                <li><a href="login.html">Login</a></li>
                                <li><a href="after-login.html">After Login</a></li>
                                <li><a href="icons.html">Icons</a></li>
                            </ul>
                        </li> --}}
                        <li><a href="{{ route('candidate' , App()->getLocale())  }}">{{ __('lang.menu_candidate') }}</a></li>
                        {{-- <li class="has-child"><a href="javascript:;">კანდიდატები</a>
                            <ul class="sub-menu">
                                <li><a href="candidate-grid.html">Candidates Grid</a></li>
                                <li><a href="candidate-list.html">Candidates List</a></li>
                                <li class="has-child"><a href="javascript:;">Candidate Detail</a>
                                    <ul class="sub-menu">
                                        <li><a href="candidate-detail.html">Detail 1</a>
                                        <li><a href="candidate-detail-v2.html">Detail 2</a>
                                    </ul>
                                </li>
                                <li><a href="candidate-dashboard.html">Dashboard</a></li>
                                <li><a href="candidate-profile.html">My Pfofile</a></li>
                                <li><a href="candidate-jobs-applied.html">Applied Jobs</a></li>
                                <li><a href="candidate-my-resume.html">My Resume</a></li>
                                <li><a href="candidate-saved-jobs.html">Saved Jobs</a></li>
                                <li><a href="candidate-cv-manager.html">CV Manager</a></li>
                                <li><a href="candidate-job-alert.html">Job Alerts</a></li>
                                <li><a href="candidate-change-password.html">Change Passeord</a></li>
                                <li><a href="candidate-chat.html">Chat</a></li>
                            </ul>
                        </li> --}}
                        <li><a href="{{ route('blog' , App()->getLocale())  }}">{{ __('lang.menu_blog') }}</a></li>
                        {{-- <li class="has-child"><a href="javascript:;">ბლოგი</a>
                            <ul class="sub-menu">
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="blog-grid.html">Blog Grid</a></li>
                                <li><a href="blog-grid-2.html">Blog Grid-2</a></li>
                                <li><a href="blog-list.html">Blog List</a></li>
                                <li><a href="blog-single.html">Blog Detail</a></li>
                            </ul>
                        </li> --}}

                        {{-- <li class="has-child"><a href="javascript:;"><img src="/images/language.png"> </a>
                            <ul class="sub-menu">
                                @foreach(Config::get('app.ka') as $locale)
                                <li><a href="{{url(str_replace(app()->getlocale(), $locale, Request::url() ))}}"><img src="/images/geo.png"> ქართული</a></li>
                                @endforeach

                                @foreach(Config::get('app.en') as $locale)
                                <li><a href="{{url(str_replace(app()->getlocale(), $locale, Request::url() ))}}"><img src="/images/eng.png"> English</a></li>
                                @endforeach

                                @foreach(Config::get('app.ru') as $locale)
                                <li><a href="{{url(str_replace(app()->getlocale(), $locale, Request::url() ))}}"><img src="/images/rus.png"> Русский</a></li>
                                @endforeach
                            </ul>
                        </li> --}}
                        {{-- <li class="has-child"><a href="javascript:;"><img src="/images/language.png"> </a>
                            <ul class="sub-menu">
                                <li><a href="{{ route(Route::currentRouteName(), 'ka') }}"><img src="/images/geo.png"> ქართული</a></li>
                                <li><a href="{{ route(Route::currentRouteName(), 'en') }}"><img src="/images/eng.png"> English</a></li>
                                <li><a href="{{ route(Route::currentRouteName(), 'ru') }}"><img src="/images/rus.png"> Русский</a></li>
                            </ul>
                        </li> --}}
                        <language-switcher
                            locale= "{{ app()->getLocale() }}"
                            link-ka="{{ route(Route::currentRouteName(), 'ka') }}"
                            link-en="{{ route(Route::currentRouteName(), 'en') }}"
                            link-ru="{{ route(Route::currentRouteName(), 'ru') }}"
                        ></language-switcher>

                    </ul>
                </div>

                <!-- Header Right Section-->
                <div class="extra-nav header-2-nav">
                    {{-- <div class="extra-cell">
                        <div class="header-search">
                            <a href="#search" class="header-search-icon"><i class="feather-search"></i></a>
                        </div>
                    </div> --}}
                    <div class="extra-cell">
                        <div class="header-nav-btn-section">
                        @guest
                            <div class="twm-nav-btn-left">
                                <a class="twm-nav-sign-up" data-bs-toggle="modal" href="#sign_up_popup" role="button">
                                    <i class="feather-user-plus"></i>
                                    {{ __('lang.menu_registration') }}
                                </a>
                            </div>

                            <div class="twm-nav-btn-right">
                                <a href="#sign_up_popup2" class="twm-nav-post-a-job" data-bs-toggle="modal">
                                    <i class="feather-log-in"></i>
                                    {{ __('lang.menu_log_in') }}
                                </a>
                            </div>
                        @else
                        <div class="twm-nav-btn-right">
                            <a href="{{ route('home') }}" class="twm-nav-post-a-job">
                                <i class="feather-user"></i> კაბინეტი
                            </a>
                        </div>
                        <div class="twm-nav-btn-left">
                            <a class="twm-nav-sign-up" data-bs-toggle="modal" href="{{ route('logout') }}" role="button"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="feather-log-out"></i>
                                გასვლა
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>

                        @endguest
                        </div>
                    </div>

                </div>



            </div>


        </div>

        <!-- SITE Search -->
        <div id="search">
            <span class="close"></span>
            <form role="search" id="searchform" action="https://thewebmax.org/search" method="get" class="radius-xl">
                <input class="form-control" value="" name="q" type="search" placeholder="Type to search"/>
                <span class="input-group-append">
                    <button type="button" class="search-btn">
                        <i class="fa fa-paper-plane"></i>
                    </button>
                </span>
            </form>
        </div>
    </div>

</header>
<!-- HEADER END -->
