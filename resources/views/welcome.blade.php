@extends('layouts.appPage')

@section('content')

<section class="employedVacancies bg-image-vacancy" style="background-image: url(images/bg.png);">
    <div class="container">
        <div class="row">
            <div class="col-md-12 jobSearch">
                <h1>სამსახური აქ მოიძებნება ყველასთვის...</h1>
            </div>
        </div>
        <div class="row">
    
            <div class="col-md-6 employedNumber">
                <p>დასაქმებულები</p>
                <p>1200</p>
            </div>
    
            <div class="col-md-6 vacanciesNumbers float-right">
                <p>ვაკანსიები</p>
                <p>2765</p>
            </div>
    
            <div class="col-md-12 searchWelcomePage">
                <form class="mr-2 my-auto w-100 d-inline-block order-1">
                    <div class="input-group">
                        <input type="text" class="form-control" 
                        placeholder="შეიყვანეთ მოვალეობები ან სასურეველი სამუშაოს სათაური">
                        <button class="btn btn-success" type="button">
                            მოძებნე სამუშაო
                        </button>
                    </div>
                </form>
            </div>
    
        </div>
    </div>
</section>

<section class="newUserInfo">
    <div class="container">
        <div class="row">

            <div class="col-md-2">
                <div class="card">
                    <a href> <img src="images/babysitter.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-title">ძიძა</p>
                        <p class="card-text">სახელი: ნანა</p>
                    </div>
                    </a>
                </div>
            </div>

            <div class="col-md-2">
                <div class="card">
                    <a href> <img src="images/babysitter.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-title">მომვლელი</p>
                        <p class="card-text">სახელი: მიმოზა</p>
                    </div>
                    </a>
                </div>
            </div>
            
            <div class="col-md-2">
                <div class="card">
                    <a href> <img src="images/babysitter.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-title">გუვერნანტი</p>
                        <p class="card-text">სახელი: ლამარა</p>
                    </div>
                    </a>
                </div>
            </div>

            <div class="col-md-2">
                <div class="card">
                    <a href> <img src="images/babysitter.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-title">ოჯახში დამხმარე</p>
                        <p class="card-text">სახელი: ნინო</p>
                    </div>
                    </a>
                </div>
            </div>

            <div class="col-md-2">
                <div class="card">
                    <a href> <img src="images/babysitter.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-title">დამლაგებელი</p>
                        <p class="card-text">სახელი: ქეთევანი</p>
                    </div>
                    </a>
                </div>
            </div>

            <div class="col-md-2">
                <div class="card">
                    <a href> <img src="images/babysitter.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-title">მზარეული</p>
                        <p class="card-text">სახელი: ეკა</p>
                    </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="activeVacancy">
    <div class="container">
        <div class="row">

            <div class="col-md-12 activeVacancyTitle">
                <h3 id="blink">აქტიური ვაკანსიები</h3>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <a href><h5 class="card-title">გვესაჭიროება ოჯახში დამხმარე</h5></a>
                        <h6 class="card-subtitle mb-2 text-muted">id: 5364</h6>
                        <p class="card-text">ქალაქი: თბილისი</p>
                        <p class="card-text">უბანი: საბურთალო</p>
                        <p class="card-text">ანაზღაურება: 600₾</p>
                        <a href="#" class="card-link">სულან</a>
                        <a href="#" class="card-link"><p class="activeInterest"><span>დავინტერესდი</span></p></a>  
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <a href><h5 class="card-title">მესაჭიროება ძიძა</h5></a>
                        <h6 class="card-subtitle mb-2 text-muted">id: 1625</h6>
                        <p class="card-text">ქალაქი: თბილისი</p>
                        <p class="card-text">ცვლა: დღის გრაფიკი</p>
                        <p class="card-text">ანაზღაურება: 500₾</p>
                        <a href="#" class="card-link">ვალერი</a>
                        <a href="#" class="card-link"><p class="activeInterest"><span>დავინტერესდი</span></p></a>   
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <a href><h5 class="card-title">მძღოლი</h5></a>
                        <h6 class="card-subtitle mb-2 text-muted">id: 1643</h6>
                        <p class="card-text">ქალაქი: თბილისი</p>
                        <p class="card-text">უბანი: ლისი</p>
                        <p class="card-text">ანაზღაურება: 800₾</p>
                        <a href="#" class="card-link">ნატალია</a>
                        <a href="#" class="card-link"><p class="activeInterest"><span>დავინტერესდი</span></p></a>   
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <a href><h5 class="card-title">კონდიტერი</h5></a>
                        <h6 class="card-subtitle mb-2 text-muted">id: 4392</h6>
                        <p class="card-text">ქალაქი: თბილისი</p>
                        <p class="card-text">უბანი: ლისი</p>
                        <p class="card-text">ანაზღაურება: 150₾</p>
                        <a href="#" class="card-link">ხათუნა</a>
                        <a href="#" class="card-link"><p class="activeInterest"><span>დავინტერესდი</span></p></a> 
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <a href><h5 class="card-title">ძიძა</h5></a>
                        <h6 class="card-subtitle mb-2 text-muted">id: 2648</h6>
                        <p class="card-text">ქალაქი: თბილისი</p>
                        <p class="card-text">უბანი: ვარკეთილი</p>
                        <p class="card-text">ანაზღაურება: 540₾</p>
                        <a href="#" class="card-link">გიორგი</a>
                        <a href="#" class="card-link"><p class="activeInterest"><span>დავინტერესდი</span></p></a>  
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <a href><h5 class="card-title">ოჯახში დამხმარე</h5></a>
                        <h6 class="card-subtitle mb-2 text-muted">id: 7632</h6>
                        <p class="card-text">ქალაქი: თბილისი</p>
                        <p class="card-text">უბანი: ლისი</p>
                        <p class="card-text">ანაზღაურება: 350₾</p>
                        <a href="#" class="card-link">სალომე</a>
                        <a href="#" class="card-link"><p class="activeInterest"><span>დავინტერესდი</span></p></a>   
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="viewActiveVacancy">
                    <h4><span><a href="">დაათვალიერეთ ყველა აქტიური ვაკანსია</a></span></h4>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="jobSearchTop bg-image-job-search" style="background-image: url(images/login-bg.png)">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>სამუშაოს ეძებ?</h3>
                <p>არ გადადო, რატომ ხვალ - დაიწყე სამუშაო დღესვე</p>
                <a href="#"><button class="btn btn-success">დაიწყე დღესვე</button></a>
            </div>
        </div>
    </div>
</section>

<section class="outstanding">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h4>გამორჩეული ვაკანსიები</h4>
            </div>

            <div class="col-md-6 d-flex justify-content-center">
                <div class="card" style="width: 30rem;">
                    <div class="card-body">
                        <h5 class="card-title"><a href="">მესაჭიროება ოჯახში დამხმარე</a></h5>
                        <img src="images/user.png" class="card-img-top" alt="...">
                        <p class="card-text"><a href="">სულან მამოიანი</a> - თბილისი</p>
                        <p class="card-text"><span>დავინტერესდი</span></p>
                        <a href="#" class="btn btn-primary">დეტალების ნახვა</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 d-flex justify-content-center">
                <div class="card" style="width: 30rem;">
                    <div class="card-body">
                        <h5 class="card-title"><a href="">ძიძა</a></h5>
                        <img src="images/user.png" class="card-img-top" alt="...">
                        <p class="card-text"><a href>ეკა ლიპარტელიანი</a> - თბილისი</p>
                        <p class="card-text"><span>დავინტერესდი</span></p>
                        <a href="#" class="btn btn-primary">დეტალების ნახვა</a>
                    </div> 
                </div>
            </div>

            <div class="col-md-12">
                <div class="outstandingJobs">
                    <h4><span><a href="">ყველა გამორჩეული ვაკანსია</a></span></h4>
                </div>
            </div>
            
        </div>
    </div>
</section>

<section class="fillAnketa bg-image-anketa" style="background-image: url(images/login-bg2.png)">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <p class="candidate">კანდიდატებს ეძებთ?!</p>
                <h4>შეავსეთ მოკლე ანკეტა</h4>
                <p>და 30 წუთში ავტომატურად ჩანიშნეთ სასურველ კადრებთან ონლაინ გასაუბრება...</p>
                <button class="btn btn-success"><h5>განათავსეთ ვაკანსია</h5></button>
            </div>

        </div>
    </div>
</section>

{{-- Blink Script --}}
<script type="text/javascript">
  var blink = document.getElementById('blink');
  setInterval(function() {
    blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
  }, 1000);
</script>

@endsection
