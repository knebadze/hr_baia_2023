@extends('layouts.appPage')
@section('title-block')
{{ __('lang.prices') }}
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
                        <li>{{ __('lang.prices') }}</li>
                    </ul>
                </div>


                <!-- BREADCRUMB ROW END -->
            </div>
        </div>
    </div>

    {{-- MODAL SECTION --}}
    <div class="container mt-3">
      
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" style="float: left;">
        {{ __('lang.conditions_for_the_candidate') }}
      </button>
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal2" style="float: right;">
        {{ __('lang.conditions_for_the_employer') }}
      </button>
    </div>
    
    <!-- The Modal Candidates -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
    
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">{{ __('lang.conditions_for_the_candidate') }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
    
          <!-- Modal body -->
          <div class="modal-body">
            {{ __('lang.conditions_for_the_candidate_modal') }}
          </div>
    
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>
    
        </div>
      </div>
      
    </div>   
    
    <!-- The Modal Employer -->
    <div class="modal fade" id="myModal2">
      <div class="modal-dialog">
        <div class="modal-content">
    
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">{{ __('lang.conditions_for_the_employer') }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
    
          <!-- Modal body -->
          <div class="modal-body">
            {{ __('lang.conditions_for_the_employer_modal') }}
          </div>
    
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>
    
        </div>
      </div>
      
    </div>   

    
    {{-- MODAL SECTION CLOSE --}}
    
    <div class="container">
        <div class="row">
        <div class="wt-bnr-inr-entry termsPrices">
          
            <p class="textPriceTermsDescription">🌹{{ __('lang.prices_text_descr') }}</p>

                <div class="pricesTitleDescr">
                    <h4><span>ძიძა (კვალიფიკაციის აღწერა, კანდიდატთა ფოტოები)</span></h4>
                </div>

                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col-md-3">მომსახურება</th>
                        <th scope="col-md-3">კვალიფიკაცია</th>
                        <th scope="col-md-3">ფუნქცია / მოვალეობები</th>
                        <th scope="col-md-3">ანაზრაურება</th>
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
                        <td>ბავშვის მოვლა, ასევე, მისი ოთახის დალაგება, <br>
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

                <div class="pricesTitleDescr">
                    <h4><span>გუვერნანტი (კვალიფიკაციის აღწერა, კანდიდატთა ფოტოები)</span></h4>
                </div>

                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">მომსახურების სახეობა</th>
                        <th scope="col">კვალიფიკაცია</th>
                        <th scope="col">ფუნქცია / მოვალეობები</th>
                        <th scope="col">ანაზრაურება</th>
                      </tr>
                    </thead>

                    <tbody>
                        <tr>
                          <td>
                                გუვერნანტი ბავშვისთვის 3-დან 7 წლამდე
                          </td>
                          <td>
                                უმაღლესი პედაგოგიური განათლება სამუშაო გამოცდილებით
                          </td>
                          <td>
                                აღზრდა, განვითარება,<br> 
                                სასკოლოდ მომზადება, <br>
                                საშინაო დავალებების შესრულებაში დახმარება, <br>
                                წრეებზე გაყოლა
                          </td>
                          <td> 
                                თვეში 700 ლარიდან
                          </td>
                        </tr>
  
                        <tr>
                          <td>
                                უცხო ენების მცოდნე გუვერნანტი 3-დან 7 წლამდე
                          </td>
                          <td>
                                უმაღლესი პედაგოგიური განათლება, <br>
                                უცხოენების ცოდნა, სამუშაო გამოცდილებით
                          </td>
                          <td>
                                აღზრდა, განვითარება, <br>
                                სასკოლოდ მომზადება, <br>
                                საშინაო დავალებების შესრულებაში დახმარება, <br>
                                წრეებზე გაყოლა, უცხო ენების შესწავლა
                          </td>
                          <td>
                                თვეში 800 ლარიდან
                          </td>
                        </tr>
                    </tbody>

                </table>

                <div class="pricesTitleDescr">
                    <h4><span>რეპეტიტორი (კვალიფიკაციის აღწერა, კანდიდატთა ფოტოები)</span></h4>
                </div>

                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">მომსახურების სახეობა</th>
                        <th scope="col">კვალიფიკაცია</th>
                        <th scope="col">ფუნქცია / მოვალეობები</th>
                        <th scope="col">ანაზრაურება</th>
                      </tr>
                    </thead>

                    <tbody>
                        <tr>
                          <td>
                                რეპეტიტორი სკოლამდელი და
                                დაწყებითი კლასების
                                მოსწავლეთათვის

                          </td>
                          <td>
                                უმაღლესი პედაგოგიური
                                განათლება, სამუშაო
                                გამოცდილება

                          </td>
                          <td>
                                სასკოლოდ მომზადება
                          </td>
                          <td> 
                                თვეში 300 ლარიდან
                          </td>
                        </tr>
  
                        <tr>
                          <td>
                                რეპეტიტორი დაწყებითი და
                                დამამთავრებელ კლასელთათვის,
                                ასევე უცხო ენების მცოდნე                               
                          </td>
                          <td>
                                უმაღლესი პედაგოგიური განათლება, <br>
                                უცხოენების ცოდნა, სამუშაო გამოცდილებით
                          </td>
                          <td>
                                უმაღლესი პედაგოგიური
                                განათლება, სამუშაო
                                გამოცდილება, უცხო ენების
                                ცოდნა                            
                          </td>
                          <td>
                                თვეში 350 ლარიდან
                          </td>
                        </tr>
                    </tbody>

                </table>   
                
                <div class="pricesTitleDescr">
                    <h4><span>ოჯახში დამხმარე(კვალიფიკაციის აღწერა, კანდიდატთა ფოტოები)</span></h4>
                </div>

                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">ფართის მოცულობა</th>
                        <th scope="col">პერსონალის რაოდენობა</th>
                        <th scope="col">დალაგება</th>
                        <th scope="col">დალაგება, გარეცხვა, დაუთოება</th>
                        <th scope="col">დალაგება, გარეცხვა, დაუთავება, საკვების მომზადება</th>
                      </tr>
                    </thead>

                    <tbody>

                        <tr>
                          <td>
                            ოჯახში დამხმარე<br> 
                            50კვ.მ მოცულობის ფართისათვის                            
                          </td>
                          <td>
                            1 ადამიანი<br>
                            2-3 ადამიანი<br>
                            3 ადამიანზე მეტი<br>                            
                          </td>
                          <td>
                            20 ლ-დან<br>
                            30 ლ-დან<br>
                            40 ლ-დან<br>                            
                          </td>
                          <td> 
                            25 ლ-დან<br>
                            35 ლ-დან<br>
                            45 ლ-დან<br>                            
                          </td>
                          <td> 
                            30 ლ-დან<br>
                            40 ლ-დან თვეში 700 ლ-დან<br>
                            50 ლ-დან<br>                          
                          </td>
                        </tr>
  
                        <tr>
                          <td>
                            ოჯახში დამხმარე 100კვ.მ
                            მოცულობის ფართისათვის                            
                          </td>
                          <td>
                            1 ადამიანი<br>
                            2-3 ადამიანი<br>
                            3 ადამიანზე მეტი<br>                            
                          </td>
                          <td>
                            50 ლ-დან<br>
                            60 ლ-დან<br>
                            70 ლ-დან<br>                           
                          </td>
                          <td> 
                            55 ლ-დან<br>
                            65 ლ-დან<br>
                            75 ლ-დან<br>                          
                          </td>
                          <td> 
                            60 ლ-დან<br>
                            70 ლ-დან თვეში 800 ლ-დან<br>
                            80 ლ-დან<br>                            
                          </td>
                        </tr>

                        <tr>
                          <td>
                            ოჯახში დამხმარე 200კვ.მ
                            მოცულობის ფართისათვის                            
                          </td>
                          <td>
                            1 ადამიანი<br>
                            2-3 ადამიანი<br>
                            3 ადამიანზე მეტი<br>                            
                          </td>
                          <td>
                            60 ლ-დან<br>
                            70 ლ-დან<br>
                            80 ლ-დან<br>                            
                          </td>
                          <td> 
                            65 ლ-დან<br>
                            75 ლ-დან<br>
                            90 ლ-დან<br>                           
                          </td>
                          <td> 
                            70 ლ-დან<br>
                            80-ლარიდან თვეში 900 ლ-დან<br>
                            100 ლ-დან<br>                            
                          </td>
                        </tr>

                        <tr>
                          <td>
                            ოჯახში დამხმარე 500კვ.მ
                            მოცულობის ფართისათვის                            
                          </td>
                          <td>
                            1 ადამიანი<br>
                            2-3 ადამიანი<br>
                            3-ადამიანზე მეტი<br>                            
                          </td>
                          <td>
                            80 ლ-დან<br>
                            90 ლ-დან<br>
                            10 ლ-დან<br>                            
                          </td>
                          <td> 
                            90 ლ-დან<br>
                            100 ლ-დან<br>
                            120 ლ-დან<br>                            
                          </td>
                          <td> 
                            100 ლ-დან<br>
                            120 ლ-დან თვეში 1000 ლ-დან<br>
                            150 ლ-დან<br>                            
                          </td>
                        </tr>

                    </tbody>

                </table>  

                <div class="pricesTitleDescr">
                    <h4><span>ავადმყოფის მომვლელი(კვალიფიკაციის აღწერა, კანდიდატთა ფოტოები)</span></h4>
                </div>

                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">მომსახურების სახეობა</th>
                        <th scope="col">კვალიფიკაცია</th>
                        <th scope="col">ფუნქცია / მოვალეობები</th>
                        <th scope="col">ანაზრაურება</th>
                      </tr>
                    </thead>

                    <tbody>
                        <tr>
                          <td>
                            მომვლელი დღის
                            გრაფიკით                            
                          </td>
                          <td>
                            ავადმყოფის/მოხუცის
                            მოვლაში გამოცდილება,
                            რეკომენდაციები
                            
                          </td>
                          <td>
                            ავადმყოფის/მოხუცის სრულყოფილი
                            მოვლა, სანიტარულ-ჰიგიენური
                            მოვლა, ფართის დალაგება,
                            პრეპარატებისა და საკვების შეძენა, 
                            კვება ავადმყოფის...
                            
                          </td>
                          <td> 
                            1-საათში 10 ლარიდან
                            (თვეში 700 ლარიდან)
                            
                          </td>
                        </tr>
  
                        <tr>
                          <td>
                            სადღეღამისო
                            მომვლელი
                                                         
                          </td>
                          <td>
                            ავადმყოფის/მოხუცის
                            მოვლაში გამოცდილება,
                            რეკომენდაციები
                            
                          </td>
                          <td>
                            ავადმყოფის/მოხუცის სრულყოფილი
                            მოვლა, სანიტარულ-ჰიგიენური
                            მოვლა, ფართის დალაგება,
                            პრეპარატებისა და საკვების შეძენა, 
                                 
                          </td>
                          <td>
                            თვეში 1000-ლარიდან
                          </td>
                        </tr>

                        <tr>
                          <td>
                            მომვლელი სამედიცინო 
                          </td>
                          <td>
                            ავადმყოფის/მოხუცის
                          </td>
                          <td>
                            ავადმყოფის/მოხუცის სრულყოფილი
                          </td>
                          <td>
                            თვეში 1200-ლარიდან
                          </td>
                        </tr>

                        <tr>
                          <td>
                            განათლებით 
                          </td>
                          <td>
                            მოვლაში გამოცდილება,
                            რეკომენდაციები, სამედიცინო
                            უმაღლესი ან ტექნიკური
                            განათლება
                            
                          </td>
                          <td>
                            მოვლა, სანიტარულ-ჰიგიენური
                            მოვლა, სამედიცინო მანიპულაციების
                            ცოდნა, ფართის დალაგება,
                            პრეპარატებისა და საკვების შეძენა, 
                            კვება ავადმყოფის...
                            
                          </td>
                          <td>

                          </td>
                        </tr>
                    </tbody>

                </table>  

                <div class="pricesTitleDescr">
                    <h4><span>დამლაგებელი (კვალიფიკაციის აღწერა, კანდიდატთა ფოტოები)</span></h4>
                </div>

                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">ფართის მოცულობა</th>
                        <th scope="col">პერსონალის რაოდენობა</th>
                        <th scope="col">დალაგება</th>
                        <th scope="col">დალაგება, გარეცხვა, დაუთოვება</th>
                        <th scope="col">დალაგება, გარეცხვა, დაუთავება, საკვების მომზადება</th>
                      </tr>
                    </thead>

                    <tr>
                        <td>
                            დამლაგებელი 50კვ.მ
                            მოცულობის ფართისათვის
                            
                        </td>
                        <td>
                            1 ადამიანი<br>
                            2-3 ადამიანი<br>
                            3-ადამიანზე მეტი<br>
                            
                        </td>
                        <td>
                            20 ლ-დან<br>
                            30 ლ-დან<br>
                            40 ლ-დან<br>
                            
                        </td>
                        <td>
                            25 ლ-დან<br>
                            35 ლ-დან<br>
                            45 ლ-დან<br>
                            
                        </td>
                        <td>
                            30 ლ-დან<br>
                            40 ლ-დან<br>
                            50 ლ-დან<br>
                            
                        </td>
                    </tr>

                    <tr>
                        <td>
                            დამლაგებელი 100კვ.მ
                            მოცულობის ფართისათვის
                            
                        </td>
                        <td>
                            1 ადამიანი<br>
                            2-3 ადამიანი<br>
                            3-ადამიანზე მეტი<br>
                              
                        </td>
                        <td>
                            35 ლ-დან<br>
                            45 ლ-დან<br>
                            60 ლ-დან<br>
                                                       
                        </td>
                        <td>
                            40 ლ-დან<br>
                            50 ლ-დან<br>
                            65 ლ-დან<br>
                                                       
                        </td>
                        <td>
                            45 ლ-დან<br>
                            55 ლ-დან<br>
                            70 ლ-დან<br>
                                                       
                        </td>
                    </tr>

                    <tr>
                        <td>
                            დამლაგებელი 200კვ.მ
                            მოცულობის ფართისათვის
                            
                        </td>
                        <td>
                            1 ადამიანი<br>
                            2-3 ადამიანი<br>
                            3-ადამიანზე მეტი<br>
                                                   
                        </td>
                        <td>
                            60 ლ-დან<br>
                            75 ლ-დან<br>
                            90 ლ-დან<br>
                                        
                        </td>
                        <td>
                            65 ლ-დან<br>
                            80 ლ-დან<br>
                            90 ლ-დან<br>
                                             
                        </td>
                        <td>
                            70 ლ-დან<br>
                            85 ლ-დან<br>
                            90 ლ-დან<br>
                                                     
                        </td>
                    </tr>

                    <tr>
                        <td>
                            დამლაგებელი 500კვ.მ
                            მოცულობის ფართისათვის
                            
                        </td>
                        <td>
                            1 ადამიანი<br>
                            2-3 ადამიანი<br>
                            3-ადამიანზე მეტი<br>
                                 
                        </td>
                        <td>
                            90 ლ-დან<br>
                            100 ლ-დან<br>
                            150 ლ-დან<br>
                                 
                        </td>
                        <td>
                            100 ლ-დან<br>
                            120 ლ-დან<br>
                            180 ლ-დან<br>
                             
                        </td>
                        <td>
                            120 ლ-დან<br>
                            150 ლ-დან<br>
                            200 ლ-დან<br>
                                     
                        </td>
                    </tr>

                </table>

                <div class="pricesTitleDescr">
                    <h4><span>მზარეული (კვალიფიკაციის აღწერა, კანდიდატთა ფოტოები)</span></h4>
                </div>

                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">მომსახურების სახეობა</th>
                        <th scope="col">კვალიფიკაცია</th>
                        <th scope="col">ფუნქცია / მოვალეობები</th>
                        <th scope="col">ანაზრაურება</th>
                      </tr>
                    </thead>

                    <tr>
                        <td>
                            მზარეული გამოძახებით
                        </td>
                        <td>
                            სპეციალური განათლება,
                            სამუშაო გამოცდილება,
                            4-6 თანრიგი
                             
                        </td>
                        <td>
                            კერძის მოსამზადებელი
                            პროდუქტების შერჩევა-შეძენა,
                                                     
                        </td>
                        <td>
                            50-დან 100 ლარამდე 
                            თითოეულ მოსვლაზე
                                         
                        </td>
                    </tr>

                    <tr>
                        <td>

                        </td>
                        <td>
                            
                        </td>
                        <td>
                            კერძის მომაზდების შესაძლებლობა
                            ეროვნული და ინდივიდუალური
                            მოთხოვნილებების გათვალისწინებით,
                            საოჯახო წვეულებების ორგანიზება,
                            სამზარეულოს ჰიგიენაზე ზრუნვა.
                                                     
                        </td>
                        <td>
                            
                        </td>
                    </tr>

                    <tr>
                        <td>
                            მზარეული კვირაში
                            5 დღიანი დატვირთვით
                            
                        </td>
                        <td>
                            სპეციალური განათლება,
                            სამუშაო გამოცდილება,
                            4-6 თანრიგი
                                                     
                        </td>
                        <td>
                            კერძის მოსამზადებელი
                            პროდუქტების შერჩევა-შეძენა,
                            კერძის მომაზდების შესაძლებლობა
                            ეროვნული და ინდივიდუალური
                            მოთხოვნილებების გათვალისწინებით,
                            საოჯახო წვეულებების ორგანიზება,
                            სამზარეულოს ჰიგიენაზე ზრუნვა.
                                                     
                        </td>
                        <td>
                            კვირაში 250-ლარიდან                        
                        </td>
                    </tr>

                </table>

                <div class="pricesTitleDescr">
                    <h4><span>ოჯახური წყვილი (კვალიფიკაციის აღწერა, კანდიდატთა ფოტოები)</span></h4>
                </div>

                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">მომსახურების სახეობა</th>
                        <th scope="col">კვალიფიკაცია</th>
                        <th scope="col">ფუნქცია / მოვალეობები</th>
                        <th scope="col">ანაზრაურება</th>
                      </tr>
                    </thead>

                    <tr>
                        <td>

                        </td>
                        <td>
                            მსგავს სფეროში მუშაობის გამოცდილება
                        </td>
                        <td>
                            საკარმიდამო მიწის ნაკვეთისა და სახლის მოვლა პატრონობა, შინაური ცხოველების ჩათვლით
                        </td>
                        <td>
                            2000-ლარიდან
                        </td>
                    </tr>

                    <tr>
                        <td>

                        </td>
                        <td>
                            მსგავს სფეროში მუშაობის გამოცდილების გარეშე
                        </td>
                        <td>
                            საკარმიდამო მიწის ნაკვეთისა და სახლის მოვლა პატრონობა, შინაური ცხოველების ჩათვლით
                        </td>
                        <td>
                            150-ლარიდან     
                        </td>
                    </tr>

                </table>

                <div class="pricesTitleDescr">
                    <h4><span>მძღოლი (კვალიფიკაციის აღწერა, კანდიდატთა ფოტოები)</span></h4>
                </div>

                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">მომსახურების სახეობა</th>
                        <th scope="col">კვალიფიკაცია</th>
                        <th scope="col">ფუნქცია / მოვალეობები</th>
                        <th scope="col">ანაზრაურება</th>
                      </tr>
                    </thead>

                    <tr>
                        <td>
                            პერსონალური მძღოლი
                        </td>
                        <td>
                            თბილისის ქუჩების კარგად ცოდნა,
                            წარმომადგენლობითი კლასის მანქანებზე
                            მუშაობის გამოცდილება(არა სავალდებულო)
                            
                        </td>
                        <td>
                            უფროსის მიერ დათქმულ ადგილას
                            ავტომანქანის დროული მიყვანა,
                            მგზავრთა უსაფრთხოებასა და მათ
                            
                        </td>
                        <td>
                            თვეში 900 ლარიდან
                        </td>
                    </tr>

                    <tr>
                        <td>

                        </td>
                        <td>
                            B C კატეგორიის მართვის მოწმობა, 
                            სტრესულ სიტუაციებში მდგრადობა,
                            მძღოლის ეტიკეტის ცოდნა, 
                            რეკომენდაცია.
                            
                        </td>
                        <td>
                            კომფორტულობაზე ზრუნვა,
                            ავტომობილისსუფთად და მუდამ
                            გამართულ მდგომარეობაში 
                            შენახვა, საჭიროების შემთხვევაში
                            ელემენტარული რემონტის
                            ჩატარება (თვლების, აკუმულატორის, 
                            ნათურის გამოცვლა დ.ა.შ...)
                            
                        </td>
                        <td>
                            
                        </td>
                    </tr>

                </table>

                <div class="pricesTitleDescr">
                    <h4><span>საბავშვო ბაღის აღმზრდელი (კვალიფიკაციის აღწერა, კანდიდატთა ფოტოები)</span></h4>
                </div>

                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">მომსახურების სახეობა</th>
                        <th scope="col">კვალიფიკაცია</th>
                        <th scope="col">ფუნქცია / მოვალეობები</th>
                        <th scope="col">ანაზრაურება</th>
                      </tr>
                    </thead>

                    <tr>
                        <td>
                            ბაღის პერსონალი<br>
                            ბაღის პერსონალი<br>
                            ბაღის პერსონალი<br>
                            
                        </td>
                        <td>
                            ძიძა<br>
                            ძიძა<br>
                            ძიძა<br>
                            
                        </td>
                        <td>
                            2-3 წლის ასაკის I - ჯგუფის ბავშვებთან<br>
                            4-5 წლის ასაკის II - ჯგუფის ბავშვებთან<br>
                            5-6 წლის ასაკის III - ჯგუფის ბავშვებთან<br>
                            
                        </td>
                        <td>
                            თვეში 800 ლარიდან<br>
                            თვეში 850 ლარიდან<br>
                            თვეში 900 ლარიდან<br>
   
                        </td>
                    </tr>

                    <tr>
                        <td>
                            ბაღის პერსონალი<br>
                            ბაღის პერსონალი<br>
                            ბაღის პერსონალი<br>
                            
                        </td>
                        <td>
                            აღმზრდელი<br>
                            აღმზრდელი<br>
                            აღმზრდელი<br>
                            
                        </td>
                        <td>
                            2-3 წლის ასაკის I - ჯგუფის ბავშვებთან<br>
                            2-3 წლის ასაკის I - ჯგუფის ბავშვებთან<br>
                            2-3 წლის ასაკის I - ჯგუფის ბავშვებთან<br>
                            
                        </td>
                        <td>
                            თვეში 950 ლარიდან<br>
                            თვეში 1000 ლარიდან<br>
                            თვეში 1050 ლარიდან<br>
                            
                        </td>
                    </tr>

                </table>

                {{-- <h4>For Candidates</h4>
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
                </h4>                     --}}
                    

            <!-- BREADCRUMB ROW END -->
        </div>
        </div>
    </div>
</div>

</div>
@endsection