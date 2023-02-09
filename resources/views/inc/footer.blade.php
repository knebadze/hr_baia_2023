
<!-- FOOTER START -->
<footer class="footer-dark" style="background-image: url(/images/f-bg.jpg);">
    <div class="container">

        <!-- NEWS LETTER SECTION START -->
        <div class="ftr-nw-content">
            <div class="row">
                <div class="col-md-5">
                    <div class="ftr-nw-title">
                        {{ __('lang.footer_subscribe_first_text') }}
                    </div>
                </div>
                <div class="col-md-7">
                    <form>
                        <div class="ftr-nw-form">
                            <input name="news-letter" class="form-control" placeholder="{{ __('lang.footer_subscribe_form_placeholder') }}" type="text">
                            <button class="ftr-nw-subcribe-btn">{{ __('lang.footer_subscribe_button') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- NEWS LETTER SECTION END -->
        <!-- FOOTER BLOCKES START -->
        <div class="footer-top">
            <div class="row">

                <div class="col-lg-3 col-md-12">

                    <div class="widget widget_about">
                        <div class="logo-footer clearfix">
                            <a href="index.html"><img src="/images/logo-baia.png" style="max-height: 150px;" alt=""></a>
                        </div>
                        <ul class="ftr-list">
                            <li><p><span>{{ __('lang.footer_address_one') }}</span>{{ __('lang.footer_address_two') }}</p></li>
                            <li><p><span>Email :</span>support@hrbaia.com</p></li>
                            <li class="adressColor"><p><span>{{ __('lang.footer_call') }}</span><a href="tel:+995 598857657">+995 598857657</a></p></li>
                        </ul>
                    </div>

                </div>

                <div class="col-lg-9 col-md-12">
                    <div class="row">

                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="widget widget_services ftr-list-center">
                                <h3 class="widget-title">{{ __('lang.footer_fast_link') }}</h3>
                                <ul>
                                    <li><a href="{{ route('welcome' , App()->getLocale())  }}">{{ __('lang.menu_home') }}</a></li>
                                    <li><a href="{{ route('individual' , App()->getLocale())  }}">{{ __('lang.menu_individual_vacancies') }}</a></li>
                                    <li><a href="{{ route('company' , App()->getLocale())  }}">{{ __('lang.menu_company_vacancies') }}</a></li>
                                    <li><a href="{{ route('onmap' , App()->getLocale())  }}">{{ __('lang.menu_vacancies_onmap') }}</a></li>
                                    <li><a href="{{ route('about' , App()->getLocale())  }}">{{ __('lang.menu_about_us') }}</a></li>
                                    <li><a href="{{ route('candidate' , App()->getLocale())  }}">{{ __('lang.menu_candidate') }}</a></li>
                                    <li><a href="{{ route('blog' , App()->getLocale())  }}">{{ __('lang.menu_blog') }}</a></li>
                                    <li><a href="#">ხ.დ.კ</a></li>
                                    <li><a href="#">წესები და პირობები</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="widget widget_services ftr-list-center">
                                <h3 class="widget-title">{{ __('lang.footer_by_category') }}</h3>
                                <ul>
                                    <li><a href="#">დასაქმება საზღვარგარეთ</a></li>
                                    <li><a href="#">ადმინისტრატორები</a></li>
                                    <li><a href="#">მზარეულის დამხმარე</a></li>
                                    <li><a href="#">იურისტები / ადვოკატები</a></li>
                                    <li><a href="#">ძიძა</a></li>
                                    <li><a href="#">სომელიე</a></li>
                                    <li><a href="#">ჭურჭლის მრეცხავი</a></li>
                                    <li><a href="#">მენეჯერი</a></li>
                                    <li><a href="#">მძღოლი</a></li>
                                    <li><a href="#">რეპეტიტორი</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="widget widget_services ftr-list-center">
                                <h3 class="widget-title">{{ __('lang.footer_by_profession') }}</h3>
                                <ul>
                                    <li><a href="#">ძიძა</a></li>
                                    <li><a href="#">ადმინისტრატორები</a></li>
                                    <li><a href="#">მენეჯერი</a></li>
                                    <li><a href="#">იურისტები / ადვოკატები</a></li>
                                    <li><a href="#">მომვლელი</a></li>
                                    <li><a href="#">სომელიე</a></li>
                                    <li><a href="#">რეპეტიტორი</a></li>
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

