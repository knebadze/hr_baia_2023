@extends('layouts.appPage')
@section('title-block')
{{ __('lang.footer_nav_terms') }}
@endsection
@section('content')
<div class="page-content">

<div class="wt-bnr-inr overlay-wraper bg-center">
    <div class="wt-bnr-inr overlay-wraper bg-center" style="background-image:url(/images/banner/1.jpg);">
        <div class="overlay-main site-bg-white opacity-01"></div>
        <div class="container">
            <div class="wt-bnr-inr-entry">
                <!-- BREADCRUMB ROW -->

                <div>
                    <ul class="wt-breadcrumb breadcrumb-style-2">
                        <li><a href="{{ url ('/') }}">{{ __('lang.about_us_page_title_link') }}</a>/ </li>
                        <li>{{ __('lang.footer_nav_terms') }}</li>
                    </ul>
                </div>


                <!-- BREADCRUMB ROW END -->
            </div>
        </div>
    </div>

    
    <div class="container">
        <div class="wt-bnr-inr-entry aboutUsText">

                <div class="termsDescr">
                    <p style="color: red;">აღწერის ტექსტი ძველი საიტიდან</p>
                </div>

                <div class="conditionTitleDescr">
                    <h4><span>ძიძა (კვალიფიკაციის აღწერა, კანდიდატთა ფოტოები)</span></h4>
                </div>

                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">მოსმახურება</th>
                        <th scope="col">კვალიფიკაცია</th>
                        <th scope="col">ფუნქცია მოვალეობები</th>
                        <th scope="col">ანაზრაურება</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>ძიძა 0-1 წლამდე ჩვილი ბავშვისთვის
                            
                        </td>
                        <td>სამდეიცინო განათლებით,<br>
                            ჩვილ ბავშვთან მუშაობის გამოცდილებით,<br>
                            რეკომენდაცია წინა სამუშაო ადგილიდან
                        </td>
                        <td>ბავშვის მოვლა, ასევე, მისი ოთახის დალკაგება, <br>
                            ბავშვის ტანსაცმლის გარეცხვა, დაუთოება, <br>
                            საკვების მომზადება და კვება(მასაჟი)</td>
                        <td>თვეში 700-100 ლარი</td>
                      </tr>

                      <tr>
                        <td>ძიძის გამოძახებით</td>
                        <td>ბავშვთან მუშაობის გამოცდილებით, <br>
                            რეკომენდაცია წინა სამუშაო ადგილიდან
                        </td>
                        <td>მშობლების სახლში არყოფნისას ბავშვის მოვლა და კვება</td>
                        <td>1 საათში 10 ლარიდან</td>
                      </tr>

                      <tr>
                        <td>ღამის ძიძა</td>
                        <td>ბავშვთან მუშაობის გამოცდილებით, <br>
                            რეკომენდაცია წინა სამუშაო ადგილიდან
                        </td>
                        <td>მშობლების სახლში არყოფნისას ბავშვის მოვლა და კვება</td>
                        <td>ღამეში 30-35 ლარიდან</td>
                      </tr>
                    </tbody>
                  </table>

                <div class="conditionTitleDescr">
                    <h4><span>გუვერნანტი (კვალიფიკაციის აღწერა, კანდიდატთა ფოტოები)</span></h4>
                </div>

                <h4>For Candidates</h4>
                <h4 class="terms" style="padding-top: 5%;">
                    GEO<br>
                    ჩვენგან დასაქმების შემთხვევაში პირველი თვის ანაზღაურებიდან ნახევარი ჩამოგეჭრებათ, მას შემდეგ რაც აიღებთ ამ ანაზღაურებას. <br>
                    ENG<br>
                    In case of employment from us, half of the first month's salary will be withheld from you after you receive this salary. <br>
                    RUS<br>
                    В случае трудоустройства от нас, с вас будет удержана половина зарплаты за первый месяц после получения этой зарплаты. <br>
                    
                </h4>

                <h4>For Employers</h4>
                <h4 class="terms" style="padding-top: 5%;">
                    GEO<br>
                    ჩვენგან კადრის შერჩევისა და მისი მხრიდან 1 კვირიანი გამოსაცდელი ვადის წარმატებით გავლის შემთხვევაში ჩვენთან იხდით კადრის მოძიების საფასურს დასახელებული თვიური ხელფასის მხოლოდ 10%-ს რაშიაც შედის 1 წლის განმავლობაში ჩვენგან კადრის 3 ჯერ უფასოდ ჩანაცვლება.<br>
                    ENG<br>
                    If you select a staff member from us and successfully pass the 1-week probationary period, you pay us the staff search fee of only 10% of the named monthly salary, which includes 3 free staff replacements within 1 year.<br>
                    RU<br>
                    Если вы выберете от нас сотрудника и оно успешно пройдет 1-недельный испытательный срок у вас, вы заплатите нам сбор за подбор персонала в размере всего 10% от названной месячной зарплаты кандидата, которая включает в себя 3 абсолутно бесплатных замены персонала в течение 1 года.<br>
                </h4>                    
                    

            <!-- BREADCRUMB ROW END -->
        </div>
    </div>
</div>

</div>
@endsection