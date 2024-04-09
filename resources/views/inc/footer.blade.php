
<!-- FOOTER START -->
<footer class="footer-dark" style="background-image: url(/images/f-bg.jpg);">
    <div class="container">

        <!-- NEWS LETTER SECTION START -->
        <subscribe-input></subscribe-input>
        <!-- NEWS LETTER SECTION END -->
        <!-- FOOTER BLOCKES START -->
        <div class="footer-top">
            <div class="row">

                <div class="col-lg-3 col-md-12">
                    @php
                        $companyInformation = Cache::get('company_information');
                    @endphp
                    <div class="widget widget_about">
                        <div class="logo-footer clearfix">
                            <a href="index.html"><img src="/images/logo-baia.png" style="max-height: 150px;" alt=""></a>
                        </div>
                        <ul class="ftr-list">
                            <li><p>I: {{ $companyInformation->address_1 }}</p></li>
                            <li><p> II: {{ $companyInformation->address_2 }}</p></li>
                            <li><p><span>Email :</span>{{ $companyInformation->gmail }}</p></li>
                            <li class="adressColor"><p><span>{{ __('lang.footer_call') }}</span><a href="tel:{{ preg_replace('/[^0-9]/', '', $companyInformation->number) }}">{{ $companyInformation->number }}</a></p></li>
                        </ul>
                    </div>

                </div>

                <div class="col-lg-9 col-md-12">
                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="widget widget_services ftr-list-center">
                                <h3 class="widget-title">{{ __('lang.footer_fast_link') }}</h3>
                                <ul>
                                    <li><a href="{{ route('welcome' , App()->getLocale())  }}">{{ __('lang.menu_home') }}</a></li>
                                    <li><a href="{{ route('job' , App()->getLocale())  }}">{{ __('lang.menu_individual_vacancies') }}</a></li>
                                    <li><a href="{{ route('onmap' , App()->getLocale())  }}">{{ __('lang.menu_vacancies_onmap') }}</a></li>
                                    <li><a href="{{ route('about' , App()->getLocale())  }}">{{ __('lang.menu_about_us') }}</a></li>
                                    <li><a href="{{ route('candidate' , App()->getLocale())  }}">{{ __('lang.menu_candidate') }}</a></li>
                                    {{-- <li><a href="{{ route('blog' , App()->getLocale())  }}">{{ __('lang.menu_blog') }}</a></li> --}}
                                    <li><a href="{{ route('contact' , App()->getLocale())  }}">{{ __('lang.menu_contact') }}</a></li>
                                    <li><a href="{{ route('faq' , App()->getLocale())  }}">{{ __('lang.footer_nav_faq') }}</a></li>
                                    <li><a href="{{ route('prices' , App()->getLocale())  }}">{{ __('lang.prices') }}</a></li>
                                </ul>
                            </div>
                        </div>


                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="widget widget_services ftr-list-center">
                                <h3 class="widget-title">{{ __('lang.footer_by_category') }}</h3>
                                <ul>
                                    {{-- Loop through each category item --}}
                                    @foreach ($category as $item)
                                        <li><a href="{{ route('job.search', ['category_id' => $item['id'], 'locale' => App()->getLocale()]) }}">{{ $item['name_'. app()->getLocale()] }}</a></li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
        <!-- FOOTER COPYRIGHT -->
        <div class="footer-bottom">

            <div class="footer-bottom-info">

                <div class="footer-copy-right">
                    <span class="copyrights-text">Copyright © 2023 by MK Group</span>
                </div>
                <ul class="social-icons">
                    <li><a href="https://ok.ru/profile/335739306146" target="_blank" class="fab fa-odnoklassniki"></a></li>
                    <li><a href="https://www.facebook.com/saagentobaia1" target="_blank" class="fab fa-facebook-f"></a></li>
                    <li><a href="https://twitter.com/hrbaia1" target="_blank" class="fab fa-twitter"></a></li>
                    <li><a href="https://vk.com/id196084093" target="_blank" class="fab fa-vk"></a></li>
                </ul>

            </div>

        </div>

    </div>

</footer>
<!-- FOOTER END -->

