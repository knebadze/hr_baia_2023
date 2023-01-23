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

<section class="anketaUsers">
  <div class="container">
    <div class="row">
        
        <div class="col-md-6 searchListAnketa forMobile">

            <div class="card">
              <img class="card-img-top" src="images/no_image.png" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title"><a href="">სალომე</a></h5>
                <p class="card-text"><i class="fa fa-clock-o"></i> 5დღის წინ</p>
                <p class="card-text">ასაკი: 31</p>
                <p class="card-text">ქვეყანა: საქართველო</p>
                <h6><a href="#" class="btn btn-outline-primary">პროფილის ნახვა</a></h6>
              </div>
            </div>
    
          </div>

      <div class="col-md-3 col-sm-6">

          <h6 class="filterAnketaUser">  <i class="fa fa-bell"></i> ფილტრაციით ანკეტების გამოწერა </h6>

        <div class="card anketaAddVacancyFirst">
        <a href="http://hrbaia.ge/register?employer" class="btn anketaAddVacancy">
          <i class="fa fa-file-text" aria-hidden="true"></i> განათავსეთ ვაკანსია</a>
        </div>
        <h4 class="filterAnketaUserTwo">გაფილტრეთ ანკეტები</h4>

        <div class="card">
          <div class="sidebar">
        

            <div class="widget">
                <h6 class="widget-title">გამოქვეყნების თარიღი</h6>
    
                <ul class="optionlist">
                    <li>
                        <input type="radio" name="created_at" id="created_at_0" value="0" checked="">
                        <label for="created_at_0"></label>
                        ნებისმიერი
                    </li>
                    <li>
                        <input type="radio" name="created_at" id="created_at_24" value="24">
                        <label for="created_at_24"></label>
                        ბოლო 24 საათში
                    </li>
                    <li>
                        <input type="radio" name="created_at" id="created_at_3" value="3">
                        <label for="created_at_3"></label>
                        ბოლო 3 დღეში
                    </li>
                    <li>
                        <input type="radio" name="created_at" id="created_at_7" value="7">
                        <label for="created_at_7"></label>
                        ბოლო 7 დღეში
                    </li>
                </ul>
            </div>
    
            <div class="widget">
                <h6 class="widget-title">ანაზღაურება</h6>
    
                <ul class="optionlist">
                    <li>
                        <input type="radio" name="salaries" id="salary_any" checked="">
                        <label for="salary_any"></label>
                        ნებისმიერი
                    </li>
                    <li>
                        <input type="radio" name="salaries" id="salary_from_500">
                        <label for="salary_from_500"></label>
                        500₾-დან
                    </li>
                    <li>
                        <input type="radio" name="salaries" id="salary_from_700">
                        <label for="salary_from_700"></label>
                        700₾-დან
                    </li>
                    <li>
                        <input type="radio" name="salaries" id="salary_from_900">
                        <label for="salary_from_900"></label>
                        900₾-დან
                    </li>
                    <li>
                        <input type="radio" name="salaries" id="salary_other">
                        <label for="salary_other"></label>
                        სხვა
                        <div id="salary_inputs" style="display:none">
                            <div class="form-group">
                                <input class="form-control" id="salary_from" placeholder="დან" name="salary_from" type="number">
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="salary_to" placeholder="მდე" name="salary_to" type="number">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
    
            <div class="widget">
                <h6 class="widget-title">გრაფიკი</h6>
    
                <ul class="optionlist">
                    <li>
                        <input type="radio" name="job_shift_id" id="job_shift_id" value="" checked="">
                        <label for="job_shift_id"></label>
                        ნებისმიერი
                    </li>
    
                    <li>
                        <input type="radio" name="job_shift_id" id="job_shift_id_2" value="2">
                        <label for="job_shift_id_2"></label>
                        დღის გრაფიკი
                    </li>
    
                    <li>
                        <input type="radio" name="job_shift_id" id="job_shift_id_14" value="14">
                        <label for="job_shift_id_14"></label>
                        ღამის გრაფიკი
                    </li>
    
                    <li>
                        <input type="radio" name="job_shift_id" id="job_shift_id_3" value="3">
                        <label for="job_shift_id_3"></label>
                        სადღეღამისო
                    </li>
                </ul>
            </div>
    
            <div class="widget">
                <h6 class="widget-title">ლოკაცია</h6>
    
                <ul class="optionlist">
                    <li>
                        <input type="radio" name="locationMeters" id="location_any" value="" checked="">
                        <label for="location_any"></label>
                        ნებისმიერი
                    </li>
    
                    <li>
                        <input type="radio" name="locationMeters" id="location_3" value="3">
                        <label for="location_3"></label>
                        თქვენგან 3 კმ-ში
                    </li>
    
                    <li>
                        <input type="radio" name="locationMeters" id="location_5" value="5">
                        <label for="location_5"></label>
                        თქვენგან 5 კმ-ში
                    </li>
    
                    <li>
                        <input type="radio" name="locationMeters" id="location_7" value="7">
                        <label for="location_7"></label>
                        თქვენგან 7 კმ-ში
                    </li>
                </ul>
            </div>

          </div>
        </div>

      </div>

      <div class="col-md-6 searchListAnketa forDesktop">

        <div class="card">
          <img class="card-img-top" src="images/no_image.png" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title"><a href="">სალომე</a></h5>
            <p class="card-text"><i class="fa fa-clock-o"></i> 5დღის წინ</p>
            <p class="card-text">ასაკი: 31</p>
            <p class="card-text">ქვეყანა: საქართველო</p>
            <h6><a href="#" class="btn btn-outline-primary">პროფილის ნახვა</a></h6>
          </div>
        </div>

      </div>
    

      <div class="col-md-3">
        <p>მარჯვენა</p>
      </div>

    </div>
  </div>
</section>
@endsection