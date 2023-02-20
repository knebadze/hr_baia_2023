@extends('layouts.appPage')
@section('title-block')
Terms & Conditions
@endsection
@section('content')
<div class="page-content">

<div class="wt-bnr-inr overlay-wraper bg-center" style="padding-top: 10%">
    <div class="overlay-main site-bg-white opacity-01"></div>
    <div class="container">
        <div class="wt-bnr-inr-entry aboutUsText">
            <div class="banner-title-outer">
                <div class="banner-title-name">
                    <h2 class="wt-title">Terms & Conditions</h2>
                </div>
            </div>
            <!-- BREADCRUMB ROW -->

                <div>
                    <ul class="wt-breadcrumb breadcrumb-style-2">
                        <li><a href="{{ url ('/') }}">{{ __('lang.about_us_page_title_link') }}</a>/ </li>
                        <li>Terms & Conditions</li>
                    </ul>
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