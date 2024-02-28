@extends('layouts.logInApp')

@section('content')


       <!-- CONTENT START -->
       <div class="page-content">

        <!-- Login Section Start -->
        <div class="section-full site-bg-white">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-7 col-lg-6 col-md-5 twm-log-reg-media-wrap d-none d-md-block">
                        <div class="twm-log-reg-media">
                            <div class="twm-l-media">
                                <img src="{{ asset('images/login-bg.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-7">
                        <div class="twm-log-reg-form-wrap">
                            <div class="twm-log-reg-logo-head">
                                <a href="{{ url ('/') }}">
                                    <img src="{{ asset('/images/logo-baia.png') }}" alt="" class="logo">
                                </a>
                            </div>

                            <div class="twm-log-reg-inner">
                                <div class="twm-log-reg-head">
                                    <div class="twm-log-reg-logo">
                                        <span class="log-reg-form-title">{{ trans('lang.modal_registration_title') }}</span>
                                    </div>
                                </div>
                                <div class="twm-tabs-style-2">

                                    <div class="row">
                                        <form method="POST" action="{{ route('register' ,app()->getLocale()) }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    @if (app()->getLocale() == 'ka')
                                                        <div class="form-group mb-3">
                                                            <input id="name_ka" type="text" class="form-control @error('name_ka') is-invalid @enderror" name="name_ka" value="{{ old('name_ka') }}"  autocomplete="name_ka" autofocus placeholder="{{ __('lang.modal_registration_name_surname') }}">

                                                            @error('name_ka')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    @elseif (app()->getLocale() == 'en')
                                                        <div class="form-group mb-3">
                                                            <input id="name_en" type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en" value="{{ old('name_en') }}"  autocomplete="name_en" autofocus placeholder="{{ __('lang.modal_registration_name_surname') }}">

                                                            @error('name_en')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    @else
                                                        <div class="form-group mb-3">
                                                            <input id="name_ru" type="text" class="form-control @error('name_ru') is-invalid @enderror" name="name_ru" value="{{ old('name_ru') }}"  autocomplete="name_ru" autofocus placeholder="{{ __('lang.modal_registration_name_surname') }}">

                                                            @error('name_ru')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    @endif

                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-3">
                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('lang.modal_registration_mail') }}" onkeypress="return /[a-zA-Z0-9@.-_]/i.test(event.key)">

                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="input-group  mb-3">
                                                        <span class="input-group-text border border-0">+995</span>
                                                        <input name="number" id="number" type="text" class="form-control  @error('number') is-invalid @enderror" value="{{ old('number') }}"  placeholder="{{ __('lang.modal_registration_number') }}" onkeypress="return event.charCode != 32">
                                                        @error('number')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>



                                                <div class="col-xl-6 col-lg-6 col-md-12">

                                                    <div class="form-group mb-3">
                                                        <div class="input-group">
                                                            <input id="password" type="password" class="form-control psswdInputBlock @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('lang.modal_registration_password') }}">

                                                                <span class="input-group-text hiddenPsswd" id="togglePassword">
                                                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                                </span>

                                                        </div>
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-12">
                                                    <div class="form-group mb-3">
                                                        <div class="input-group">
                                                            <input id="password-confirm" type="password" class="form-control psswdInputBlock @error('password_confirmation') is-invalid @enderror"  name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('გაიმეორეთ პაროლი') }}">

                                                                <span class="input-group-text hiddenPsswd" id="confirmPassword">
                                                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                                </span>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label>{{ __('lang.modal_registration_birth_date') }}</label>
                                                        <div class="ls-inputicon-box">
                                                            <input class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" type="date" placeholder="mm/dd/yyyy">

                                                            @error('date_of_birth')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-12" >
                                                    <p>{{ __('lang.modal_registration_gender') }}</p>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="gender_id" value="1" class="form-check-input @error('gender_id') is-invalid @enderror" id="exampleradio1">
                                                        <label class="form-check-label" for="exampleradio1">{{ __('lang.modal_registration_gender_male') }}</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="gender_id" value="2" class="form-check-input @error('gender_id') is-invalid @enderror" id="exampleradio2">
                                                        <label class="form-check-label" for="exampleradio2">{{ __('lang.modal_registration_gender_female') }}</label>
                                                    </div>
                                                    @error('gender_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <hr>

                                                <div class="col-lg-12">
                                                    <div class="form-group mb-3">
                                                        <div class=" form-check">
                                                            <input type="checkbox" class="form-check-input  @error('agree') is-invalid @enderror" id="agree" name="agree">

                                                            <label class="form-check-label" for="agree1">{{ __('lang.modal_registration_agree_1') }} <a href="javascript:;" class="text-primary" id="show-rule">{{ __('lang.modal_registration_agree_2') }}</a></label>
                                                            @error('agree')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <button type="submit" class="site-button">{{ __('lang.modal_registration_button') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span class="center-text-or">Or</span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <form action="{{ route('auth.social.redirect', 'facebook') }}" method="GET">
                                                    @csrf
                                                    <button type="submit" class="log_with_facebook">
                                                        <i class="fab fa-facebook"></i>
                                                        Continue with Facebook
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <form action="{{ route('auth.social.redirect', 'google') }}" method="GET">
                                                    @csrf
                                                    <button type="submit" class="log_with_google">
                                                        <img src="{{ asset('images/google-icon.png') }}" alt="">
                                                        Continue with Google
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mt-3 mb-3">{{ __('lang.modal_registration_already_registered?') }}
                                                <a href="{{ route('login', App()->getLocale()) }}"><u class="text-primary">{{ __('lang.modal_registration_log_in_here') }}</u></a>
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login Section End -->

        <!-- Modal -->
        <div class="modal" tabindex="-1" role="dialog" id="myModal" style="height: 90%;">
            <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">წესები და პირობები</h5>
                        <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       <div class="p-3">
                            <div class="mb-2">
                                <h5 class="text-center fw-bold">1.პერსონალური მონაცემების დამუშავება</h5>
                                <ol>
                                    <li>
                                        თანახმა ვარ ჩემი პერსონალური მონაცემები:
                                        <ul class="p-3">
                                            <li>სახელი, გვარი</li>
                                            <li>დაბადების თარიღი</li>
                                            <li>პირადი ნომერი</li>
                                            <li>საკონტაქტო ტელეფონის ნომრები</li>
                                            <li>ელ-ფოსტა</li>
                                            <li>სოციალური ქსელის მისამართი</li>
                                            <li>საცხოვრებელი ადგილი</li>
                                            <li>ჩემი პირადი ფოტო</li>
                                            <li>სამუშაო გამოცდილება</li>
                                            <li>რეკომენდაცია წინა სამუშაო ადგილიდან</li>
                                            <li>ჯანმრთელობის მდგომარეობის შესახებ სამედიცინო ცნობა</li>
                                            <li>ნასამართლეობის ცნობა</li>
                                            <li>ოჯახური მდგომარეობის (მათ შორის შვილების რაოდენობა და ასაკი)</li>

                                        </ul>
                                        <p>
                                            ჩათვლით დასაქმებაში ხელშეწყობასთან დაკავშირებით გადავცე სააგენტო ,,ბაია2“-ს და აღნიშნულ სააგენტოსთან თანამშრომლობის შეწყვეტის
                                            შესახებ ჩემი წერილობითი ფორმით მომართვიანობამდე, თუნდაც სააგენტო ,,ბაია2“-ის მიერ ჩემი ერთჯერადი თუ მრავალჯერადი დასაქმების
                                            შემთხვევაშიც ინახებოდეს სააგენტო ,,ბაია2"-ის კადრების შერჩევის სპეციალისტებთან, რომლებსაც ვრთავ ნებას წვდომა ჰქონდეთ
                                            ჩემს ზ/აღნიშნულ პერსონალურ მონაცემებთან და ამ მონაცემების გამოყენებას ვანდობ მათ მხოლოდ სააგენტო
                                            ,,ბაია2"-ში მუშაობის განმავლობაში და არავითარ შემთხვევაში სააგენტო ,,ბაია2"-დან წასვლის შემდგომ,
                                            თუნდაც სხვა სააგენტოში მუშაობისას.
                                        </p>

                                    </li>
                                    <li>
                                        თანახმა ვარ ჩემი ფოტოანკეტა:
                                        <ul class="p-3">
                                            <li>სახელის</li>
                                            <li>ასაკის</li>
                                            <li>სამუშაო გამოცდილების</li>
                                            <li>ოთხოვნილი მინიმალური ანაზღაურების</li>
                                            <li>ჩემი ფოტოს </li>
                                        </ul>
                                        <p>ჩათვლით გამოჩნდეს სააგენტო ,,ბაია2"-ს ვებ-გვერდზე: <a href="https://hrbaia.ge" class="text-primary">www.hrbaia.ge</a>,
                                            რომელიც მხოლოდ მოცემული პარამეტრებით ხელმისაწვდომი
                                            იქნება ამ გვერდის ნებისმიერი მომხმარებლისათვის, ხოლო უშუალოდ დაკავშირება კი რომელიმე შემკვეთის მხრიდან ჩემი აღნიშნული
                                            მონაცემებით დაინტერესების შემთხვევაში შემკვეთისათვის ხელმისაწვდომი იქნება მხოლოდ სააგენტოს მეშვეობითა და უშუალოდ ჩემი
                                            თანხმობით.
                                        </p>
                                    </li>
                                    <li>
                                        ასევე ვაცხადებ თანხმობას, სააგენტოში ჩემი ფოტოანკეტის არსებობის პერიოდში,
                                        ანუ რეგისტრაციის მომენტიდან ჩემივე მოთხოვნით ფოტოანკეტის გაუქმების შესახებ წერილობითი ფორმით მომართვიანოიბამდე
                                        სააგენტოდან ჩემს:
                                        <ul class="p-3">
                                            <li>სოციალურ ქსელზე</li>
                                            <li>ელ-ფოსტაზე იქნება ეს თუ</li>
                                            <li>მობილური ტელეფონის ნომერზე</li>
                                        </ul>
                                        <p>
                                            მივიღო sms შეტყობინებები სამსახურებთან და აღნიშნულთან დაკავშირებული ნებისმიერი სიახლეების თაობაზე,
                                            ხოლო გამოსაცდელი ვადის ან დასაქმების შემთხვევაში გამოსაცდელი ვადის მიმდინარეობასა ან/და
                                            ჩასარიცხი თანხების დავალიანების თაობაზე.
                                        </p>
                                    </li>
                                </ol>
                                <div class="col-lg-12 d-flex justify-content-end">
                                    <div class="form-group mb-3">
                                        <div class=" form-check">
                                            <input type="checkbox" class="form-check-input  @error('agree_1') is-invalid @enderror border border-primary" id="agree_1" name="agree_1">

                                            <label class="form-check-label fw-bold" for="agree_1">{{ __('თანახმა ვარ') }} </label>
                                            @error('agree_1')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <h5 class="text-center fw-bold">2.დასაქმებასთან დაკავშირებული ურთიერთობანი</h5>
                                <ol>
                                    <li class="mb-1">
                                        გავეცანი და ვეთანხმები პირობას, რომ სააგენტოში რეგისტრაცია არ ნიშნავს 100%-იან გარანტიას იმისას,
                                        რომ დარეგისტრირებიდან რამოდენიმე დღეში, კვირასა თუ თვეში ან ნებისმიერ დროის რაღაც პერიოდში
                                        აუცილებლად ვიპოვი სამუშაოს, ვინაიდან გვარჩევს შემკვეთი, ანუ ვინც ყოველი თვის ბოლოს თავისი სახსრებით
                                        უნდა გადაგვიხადოს ანაზღაურება ხელფასის სახით სწორედ ის გვარჩევს, ხოლო სააგენტოს ჩემდამი ვალდებულება კი
                                        იმით შემოიფარგლება, რომ სატელეფონო ზარებით იქნება ეს, ელექტრონულ ფოსტა, თუ სოც-ქსელების მეშვეობით მთავაზობს
                                        მათთან შემოსულ დღის აქტიურ ვაკანსიებს და ჩამონათვალში თუკი იქნება ჩემთვის მისაღები ვაკანსია სააგენტოში ვაგზავნი
                                        დაინტერესებას ვებ გვერდის მეშვეობით ან ასეთი ვაკანსიის საიდენტიფიკაციო კოდს ელ-ფოსტის, სოც ქსელზე გაგზავნის ან
                                        ტელეფონის მეშვეობით, რის შემდეგაც სააგენტოს შესაბამისი თანამშრომლის მიერ შემკვეთს ეგზავნება უშუალოდ ჩემი ანკეტა ან
                                        სატელეფონო ზარით თანხმდება სააგენტოს თანამშრომლის მიერ შემკვეთთან ჩემი კანდიდატურა და თუკი შემკვეთი დაინტერესდა
                                        სააგენტოს ვებ-გვერდზე გამოტანილი ჩემი საანკეტო ჩანაწერების მიხედვით ჩემი კანდიდატურით მხოლოდ ასეთ შემთხვევებში უნდა
                                        გამოვცხადდე შემკვეთთან გასაუბრებაზე სადაც ჩემს გარდა ვაცნობიერებ, რომ შესაძლებელია იყვნენ მსგავსი ფორმით დაინტერესებული
                                        კიდევ რამოდენიმე კანდიდატი და უკვე შემკვეთთან ინდივიდუალურად წარმოებული გასაუბრებით ეს მასთან ოჯახში იქნება,
                                        დისტანციური თუ სააგენტოს ოფისში თვითონ შემკვეთი წყვეტს თუ რომელი კანდიდატურა დაიბაროს გამოსაცდელი ვადით.
                                        <p class="ps-3">
                                            ზ/აღნიშნულიდან გამომდინარე ვაცნობიერებ, რომ სააგენტოში მომართვიანობით უბრალოდ ალბათობის გარკვეული
                                            ხარისხით იზრდება ჩემთვის სამუშაოს მოძიების შანსი, მაგრამ 100%-იანი უკვე გაცნობილი პირობებიდან გამომდინარე ვერ ხდება,
                                            რასაც ვეთანხმები და ვაცნობიერებ სრულად.
                                        </p>
                                    </li>
                                    <li class="mb-1">
                                        ასევე განმემარტა, რომ: სააგენტოს მიერ შემოთავაზებულ ისეთ ვაკანსიებზე, რომლებზედაც მე,
                                        როგორც კანდიდატი განვაცხადებ გასაუბრებაზე გამოცხადების თანხმობას, მაგრამ არასაპატიო მიზეზით არ/ვერ
                                        გამოვცხადდები გასაუბრებაზე 3 (სამი) ასეთი გამოუცხადებლობის შემთხვევაში სააგენტოს აქვს უფლება ავტომატურად
                                        გააუქმოის ჩემი ანკეტა.
                                    </li>
                                    <li class="mb-1">
                                        გამოსაცდელი ვადის გასვლის შემდგომ, თუ კი არ/ვერ მოხერხდა ჩემი, როგორც კანდიდატის სამუშაოზე აყვანა ასეთ შემთხვევაში
                                        თანახმა ვარ გადავიხადო გამოსაცდელ ვადაში გამომუშავებულითანხის 25% მხოლოდ დამკვეთის მხრიდან ჩემთვის ამ
                                        თანხის ანაზღაურების შემთხვევაში, რაც უნდა ჩარიცხოს  შპს სააგენტო ,,ბაია2"-ის სპეციალურ საბანკოანგარიშზე,
                                        ხოლო დასაქმების შემთხვევაში კი უკვე როგორც დასაქმებული თანახმა ვარ გადავიხადო პირველი თვის ხელფასის  50%.
                                    </li>
                                    <li class="mb-1">
                                        ასევე განმემარტა და ვეთანხმები პირობას, რომ სააგენტოს მხრიდან დასაქმების შემთხვევაში თუნდაც ხელშეკრულების
                                        მოქმედების პერიოდში ან/და ხელშეკრულების ვადის გასვლის შემდეგაც განმეორებით დასაქმების შემთხვევაშიც ჩვეულებრივ
                                        ვიხდი პირველი თვის ანაზღაურების 50%-ს.
                                    </li>
                                    <li class="mb-1">
                                        ასევე გაფრთხილებული ვარ, რომ დასაქმების შემთხვევაში, ან თუნდაც ფასიანი გამოსაცდელი ვადის შედეგად გამომუშავებული
                                        თანხიდან სააგენტოსათვის შესაბამისი პროცენტის თანხის გადაუხდელობის შემთხვევაში  ასეთი კანდიდატის მიმართ აღიძვრება
                                        სამოქალაქო სარჩელი სასამართლოში და იგი ამავდროულად მოხვდება სააგენტოს ვებ-გვერდის ,,შავ სიაში",
                                        რასაც დაინახავს საიტის ნებისმიერი მომხმარებელი, რაზედაც, მე როგორც სამუშაოს მაძიებელი კანდიდატი - ვაცხადებ თანხმობას.
                                    </li>
                                    <li class="mb-1">
                                        კანდიდატი ასევე გაფრთხილებულია, რომ მას ეკრძალება დამკვეთთან გასაუბრების შემდგომ,
                                        სააგენტოს გვერდის ავლით დამკვეთთან სამუშაო ურთიერთობის დამყარება და მასთან მუშაობის დაწყება,
                                        ან მისი სანაცნობო წრისათვის კონკრეტული ვაკანსიის სააგენტოს გვერდის ავლით  შეთავაზება.
                                        სააგენტოს წარმომადგენლის მიერ ასეთი ფაქტის გამოვლენის  შემთხვევაში კანდიდატი თავად
                                        უზრუნველყოფს დასაქმებულის პირველი თვის ხელფასის 50%-ის სააგენტოს ანგარიშზე  გადახდას, წინააღმდეგ შემთხვევაში გაფრთხილებულია,
                                        რომ  დაჯარიმდება  <strong class="fw-bold">500 ლარით</strong> - რაზედაც კანდიდატი აცხადებს თანხმობას.
                                    </li>
                                    <li class="mb-1">
                                        ასევე გაფრთხილებული ვარ და ვეთანხმები პირობას, რომ რომელიმე შემკვეთთან სააგენტო ,,ბაია2"-ის მეშვეობით ჩემი
                                        გასაუბრების/დაკავშირების შემდგომ კონკრეტული შემკვეთის მხრიდან ჩემი არ აყვანის, მაგრამ შემკვეთის მხრიდან მისი
                                        საახლობლო წრისათვის (ეს ნათესავი იქნება შემკვეთის, მეგობარი, თანამშრომელი თუ სხვა ნებისმიერი ფორმით ნაცნობი)
                                        დროის ნებისმიერ პერიოდში ჩემი კანდიდატურის შეთავაზება და ამ ფორმით სამუშაოს დაწყება ჩაითვლება სააგენტოს მხრიდან დასაქმებად,
                                        რადგან ჩემი ნაცნობობა პოტენციურ დამქირავებელთან სწორედ სააგენტოს მეშვეობით განხორციელდა და თანახმა ვარ ჩვეულებრივ
                                        გადავიხადო სააგენტოს საკომისიო პირველი თვის ანაზღაურების 50%, ხოლო ასეთი ფაქტის სააგენტოსათვის ჩემი მხრიდან დამალვის
                                        შემთხვევა ჩაითვლება სააგენტოსთან პირობების დარღვევად და დავჯარიმდები <strong class="fw-bold">500 ლარით</strong>.
                                    </li>
                                    <li class="mb-1">
                                        ანდიდატი გაფრთხილებულია, რომ ყალბი სარეკომენდაციო წერილების, ან სხვა ნებისმიერი სახის ყალბი დოკუმენტაციის
                                        სააგენტოსათვის წარმოდგენა <strong class="fw-bold">ისჯება სისხლის სამართლის კანონმდებლობით</strong>.
                                    </li>
                                </ol>
                                <div class="col-lg-12 d-flex justify-content-end">
                                    <div class="form-group mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input  @error('agree_2') is-invalid @enderror border border-primary" id="agree_2" name="agree_2">

                                            <label class="form-check-label fw-bold" for="agree_2">{{ __('თანახმა ვარ') }} </label>
                                            @error('agree_2')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <h5 class="text-center fw-bold">3.ანკეტის გაუქმების ვადები/საფუძვლები</h5>
                                <ol>
                                    <li>კანდიდატის წერილობითი მომართვიანობა</li>
                                    <li>სააგენტოს დასაბუთებული გადაწყვეტილება</li>
                                    <li>მონაცემთა გაუქმებიდან დაარქივების 1 წლიანი ვადის გასვლა</li>
                                </ol>
                                <div class="col-lg-12 d-flex justify-content-end">
                                    <div class="form-group mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input  @error('agree_3') is-invalid @enderror border border-primary" id="agree_3" name="agree_3">

                                            <label class="form-check-label fw-bold" for="agree_3">{{ __('თანახმა ვარ') }} </label>
                                            @error('agree_3')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                       </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input  @error('agree_all') is-invalid @enderror border border-primary" id="agree_all" name="agree_all">

                                <label class="form-check-label fw-bold" for="agree_all">{{ __('ვეთანხმები ყველა წესს და პირობას') }} </label>
                                @error('agree_all')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- CONTENT END -->
    <script>
        $(document).ready(function() {
            // Initialize the modal with options
            $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
            });

          // Function to show or hide the modal based on checkbox state
          function toggleModal() {
            if ($('#agree').prop('checked')) {
              $('#myModal').modal('show');
            } else {
                $('#agree_all, #agree_1, #agree_2, #agree_3').prop('checked', false);
              $('#myModal').modal('hide');
            }
          }

          $('#show-rule').click(function() {
            // Assuming your modal has an ID of "myModal", you can adjust it accordingly
            $('#myModal').modal('show');  // This assumes your modal is initially hidden using CSS
          });
          // Trigger toggleModal on checkbox change
          $('#agree').change(toggleModal);

          // Close modal when the button with id "close" is clicked
          $('#close').click(function() {
            $('#myModal').modal('hide');
            // Uncheck the checkbox when the modal is closed
            if (!$('#agree_all').prop('checked')) {
                $('#agree').prop('checked', false);
            }

          });
        });
    </script>

    <script>
        // When any of the top three checkboxes change, update the fourth checkbox

        $('input[name^="agree_"]').change(function() {

            var inputName = $(this).attr('name');
            var isChecked = $(this).prop('checked');

            // Log the input name and value
            if (inputName == 'agree_all') {
                checkedAll(isChecked)
            }
            if ($('#agree_1').prop('checked') && $('#agree_2').prop('checked') && $('#agree_3').prop('checked')) {
                $('#agree_all').prop('checked', true);
                $('#agree').prop('checked', true);
                $('#myModal').modal('hide');
            }else{
                if ($('#agree_all').prop('checked')){
                    $('#agree_all').prop('checked', false);
                    $('#agree').prop('checked', false)
                }
            }
        });
        function checkedAll(isCheckedAll) {
            // Set all checkboxes to the same state as #agree_all
            $('#agree, #agree_1, #agree_2, #agree_3').prop('checked', isCheckedAll);
            $('#myModal').modal('hide');
        }

     </script>

@endsection
