<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name_ka }}</a>
        </div>
      </div>



      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a @if(Route::currentRouteName() === 'admin.dashboard') class="nav-link active" @else class="nav-link" @endif href="{{ route('admin.dashboard', App()->getLocale()) }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        მთავარი
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a @if(Route::currentRouteName() === 'admin.vacancy' ||
                        Route::currentRouteName() === 'vacancy.personal' ||
                            Route::currentRouteName() === 'admin.vacancy.deposit' ||
                                Route::currentRouteName() === 'selection.personal' ) class="nav-link active" @else class="nav-link" @endif href="{{ route('admin.vacancy', App()->getLocale()) }}">
                    <i class="nav-icon fa fa-list"></i>
                    <p>
                        ვაკანსიები
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a @if(Route::currentRouteName() === 'admin.reminder') class="nav-link active" @else class="nav-link" @endif href="{{ route('admin.reminder', App()->getLocale()) }}">
                    <i class="nav-icon fa fa-hourglass-start"></i>
                    <p>
                        შეხსენებები
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a @if(Route::currentRouteName() === 'admin.candidate' ||
                            Route::currentRouteName() === 'admin.vacancy.attached'||
                                Route::currentRouteName() === 'admin.relevant.vacancy') class="nav-link active" @else class="nav-link" @endif href="{{ route('admin.candidate', App()->getLocale()) }}">
                    <i class="nav-icon fa fa-users"></i>
                    <p>
                        კანდიდატები
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a @if(Route::currentRouteName() === 'admin.enrollment') class="nav-link active" @else class="nav-link" @endif href="{{ route('admin.enrollment', App()->getLocale()) }}">
                    <i class="nav-icon fa fa-coins"></i>
                    <p>
                        ჩარიცხვები
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a @if(Route::currentRouteName() === 'admin.salary') class="nav-link active" @else class="nav-link" @endif href="{{ route('admin.salary', App()->getLocale()) }}">
                    <i class="nav-icon fa fa-credit-card"></i>
                    <p>
                        ხელფასები
                    </p>
                </a>
            </li>
            <li class="nav-item mt-3">
                <a
                    href="{{ route('logout') }}"
                    class="nav-link btn btn-danger text-white"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                >
                    <i class="nav-icon fa fa-arrow-left"></i>
                    <p>გასვლა</p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>

          {{-- <li class="nav-item">
            <a href="#" @if(Route::currentRouteName() === 'admin.hr') class="nav-link active" @else class="nav-link" @endif>
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a @if(Route::currentRouteName() === 'admin.hr') class="nav-link active" @else class="nav-link" @endif href="{{ route('admin.hr', App()->getLocale()) }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            HR
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a @if(Route::currentRouteName() === 'admin.candidate') class="nav-link active" @else class="nav-link" @endif href="{{ route('admin.candidate', App()->getLocale()) }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            კანდიდატები
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a @if(Route::currentRouteName() === 'admin.hr') class="nav-link active" @else class="nav-link" @endif href="{{ route('admin.hr', App()->getLocale()) }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            დამსაქმებლები
                        </p>
                    </a>
                </li>
            </ul>
          </li> --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
