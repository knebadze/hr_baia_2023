@extends('layouts.appPage')

@section('title-block')
{{('Users')}}
@endsection

@section('content')
<section class="firstTitle bg-image-firstTitle" style="background-image: url(images/anketa-bg-image.png)">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <h5>ანკეტები</h5>
            </div>
            <div class="col-md-7">

            </div>
            <div class="col-md-3">
                <a href="{{ route('welcome')}}"><h6>მთავარი</a> / <span>ანკეტები</span></h6>
            </div>
        </div>
    </div>
</section>

<section class="anketaPageLiveSearch">
    <div class="container">
    
        <form>
            <div class="form-row">
              <div class="col-md-5 anketaPageLiveSearchOne">
                <input type="text" class="form-control" placeholder="Enter Category, Title, Skills">
              </div>
              <div class="col-md-3 anketaPageLiveSearchTwo">
                <input type="text" class="form-control" placeholder="Enter Location">
              </div>
            </div>
          </form>

    </div>
</section>
@endsection