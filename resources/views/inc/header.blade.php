<!-- HEADER START -->
<header  class="site-header header-style-3 mobile-sider-drawer-menu">

    <div class="sticky-header main-bar-wraper  navbar-expand-lg">
        <div class="main-bar">

            <div class="container-fluid clearfix">

                <div class="logo-header" style="max-width: 100px">
                    <div class="logo-header-inner logo-header-one">
                        <a href="{{ url ('/') }}">
                        <img src="/images/logo-baia.png" alt="" style="width: 80px">
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
                        <li @if(Route::currentRouteName() === 'welcome') class="activeClass" @else class="" @endif><a href="{{ route('welcome' , App()->getLocale())  }}">{{ __('lang.menu_home') }}</a></li>
                        <li @if(Route::currentRouteName() === 'job' || Route::currentRouteName() === 'my.vacancy' || Route::currentRouteName() === 'onmap') class="activeClass" @else class="" @endif class="has-child"><a href="javascript:;">{{ __('lang.menu_vacancies') }}</a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('job' , App()->getLocale())  }}">{{ __('lang.menu_individual_vacancies') }}</a></li>
                                <li><a href="{{ route('onmap' , App()->getLocale())  }}">{{ __('lang.menu_vacancies_onmap') }}</a></li>
                                <li><a href="{{ route('my.vacancy' , App()->getLocale())  }}">{{ __('lang.menu_your_vacancies') }}</a></li>
                            </ul>
                        </li>

                        <li @if(Route::currentRouteName() === 'about' || Route::currentRouteName() === 'about' || Route::currentRouteName() === 'prices') class="activeClass" @else class="" @endif class="has-child"><a href="javascript:;">{{ __('lang.menu_about_us') }}</a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('about' , App()->getLocale())  }}">{{ __('lang.menu_about_us') }}</a></li>
                                <li><a href="{{ route('prices' , App()->getLocale())  }}">{{ __('lang.prices') }}</a></li>
                            </ul>
                        </li>

                        {{-- <li @if(Route::currentRouteName() === 'about') class="activeClass" @else class="" @endif><a href="{{ route('about' , App()->getLocale())  }}">{{ __('lang.menu_about_us') }}</a></li> --}}
                        <li @if(Route::currentRouteName() === 'candidate') class="activeClass" @else class="" @endif><a href="{{ route('candidate' , App()->getLocale())  }}">{{ __('lang.menu_candidate') }}</a></li>
                        {{-- <li @if(Route::currentRouteName() === 'blog') class="activeClass" @else class="" @endif><a href="{{ route('blog' , App()->getLocale())  }}">{{ __('lang.menu_blog') }}</a></li> --}}
                        <li @if(Route::currentRouteName() === 'contact') class="activeClass" @else class="" @endif><a href="{{ route('contact' , App()->getLocale())  }}">{{ __('lang.menu_contact') }}</a></li>
                        <li class="has-child"><a href="javascript:;"><img src="/images/language.png"> </a>
                            <ul class="sub-menu">
                                <li><a href="{{ route(Route::currentRouteName(), 'ka') }}"><img src="/images/geo.png"> ქართული</a></li>
                                <li><a href="{{ route(Route::currentRouteName(), 'en') }}"><img src="/images/eng.png"> English</a></li>
                                <li><a href="{{ route(Route::currentRouteName(), 'ru') }}"><img src="/images/rus.png"> Русский</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>

                <!-- Header Right Section-->
                <div class="extra-nav header-2-nav">
                    <div class="extra-cell">
                        <div class="header-nav-btn-section">
                        @guest
                            <div class="twm-nav-btn-left">
                                <a class="twm-nav-sign-up"  href="{{ route('register', App()->getLocale()) }}" role="button">
                                    <i class="feather-user-plus"></i>
                                    {{ __('lang.menu_registration') }}
                                </a>
                            </div>

                            <div class="twm-nav-btn-right">
                                <a href="{{ route('login', App()->getLocale()) }}" class="twm-nav-post-a-job" >
                                    <i class="feather-log-in"></i>
                                    {{ __('lang.menu_log_in') }}
                                </a>
                            </div>
                            <div class="twm-nav-btn-right">
                                <a href="{{ route('post.job', App()->getLocale() ) }}" class="twm-nav-post-a-job">
                                    <i class="feather-briefcase"></i> {{ __('lang.menu_add_vacancy') }}
                                </a>
                            </div>
                        @else

                        {{-- @if (Auth::user()->user_type_id == 2 || Auth::user()->user_type_id == 3)
                            <div class="twm-nav-btn-right">
                                <a href="{{ route('post.job', App()->getLocale() ) }}" class="twm-nav-post-a-job">
                                    <i class="feather-plus"></i> {{ __('lang.menu_add_vacancy') }}
                                </a>
                            </div>
                        @endif --}}

                        <div class="twm-nav-btn-right">
                            @if (Auth::user()->role_id == 3)
                                <a href="{{ route('home', App()->getLocale() ) }}" class="twm-nav-post-a-job">
                                    <i class="feather-user"></i> {{ __('lang.user_page_my_cabinet') }}
                                </a>
                            @else
                                <a href="{{ route('admin.dashboard', App()->getLocale() ) }}" class="twm-nav-post-a-job">
                                    <i class="feather-user"></i> {{ __('lang.user_page_my_cabinet') }}
                                </a>
                            @endif

                        </div>
                        <div class="twm-nav-btn-left">
                            <a class="twm-nav-sign-up" data-bs-toggle="modal" href="{{ route('logout') }}" role="button"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="feather-log-out"></i>
                                {{ __('lang.user_page_log_out') }}
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
{{-- <script>
    const mobileSideDrawer = document.getElementById('mobile-side-drawer');
    const mobileSiderDrawerMenu = document.querySelector('.mobile-sider-drawer-menu');

    // Add a click event listener to the mobile-side-drawer element
    mobileSideDrawer.addEventListener('click', function () {
        // Toggle the 'active' class on the mobile-sider-drawer-menu element
        mobileSiderDrawerMenu.classList.toggle('active');
    });
</script> --}}
<!-- HEADER END -->
