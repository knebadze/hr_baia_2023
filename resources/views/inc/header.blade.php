<nav class="navbar navbar-expand-lg navbar-light bg-light nav_underline">
    <a class="navbar-brand" href="#"><img src="{{url('logo_img/baia_logo.png')}}" width="50" height="50" class="d-inline-block align-top" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">მთავარი</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">ანკეტები</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">სამუშაოები</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">კომპანიის ვაკანსიები</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">ჩვენს შესახებ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">წესები და პირობები</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">ბლოგი</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">დაგვიკავშირდით</a>
        </li>
      </ul>

      <ul class="navbar-nav mr-auto langImg">
          <li class="nav-item">
              <a class="nav-link" href=""> <img src="images\geo.png"> </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href=""> <img src="images\eng.png"></a>
          </li>
      </ul>
      

      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="მოძებნე..." aria-label="Search">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">ძებნა</button>
      </form>
      <ul class="navbar-nav mr-right regBlock">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
            @else
                <button class="btn btn-primary logButton"><a href="{{ route('login') }}">შესვლა</a></button>
                @if (Route::has('register'))
                <button class="btn btn-success regButton"><a href="{{ route('register') }}">რეგისტრაცია</a>
                @endif
            @endauth
        @endif
      </ul>
    </div>
  </nav>