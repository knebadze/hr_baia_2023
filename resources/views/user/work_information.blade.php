@extends('layouts.appPage')
@section('title-block')
{{ __('lang.user_page_title_profile') }}
@endsection
@section('content')

<!-- CONTENT START -->
<div class="page-content">
    <!-- INNER PAGE BANNER -->
    <div class="wt-bnr-inr overlay-wraper bg-center">
        <div class="overlay-main site-bg-white opacity-01"></div>
        <div class="container">
            <div class="wt-bnr-inr-entry">
                <div class="banner-title-outer">
                    <div class="banner-title-name">
                        @if (Auth::user()->user_type_id == 1)
                        <h2 class="wt-title">{{ __('lang.user_page_candidate_first_title') }}</h2>
                        @elseif (Auth::user()->user_type_id == 2)
                        <h2 class="wt-title">{{ __('lang.user_page_candidate_second_title') }}</h2>
                        @elseif (Auth::user()->user_type_id == 3)
                        <h2 class="wt-title">{{ __('დამსაქმებელი კომპანია') }}</h2>
                        @elseif (Auth::user()->user_type_id == 4)
                        <h2 class="wt-title">{{ __('უცნობი') }}</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- INNER PAGE BANNER END -->
    <!-- OUR BLOG START -->
    <div class="section-full p-b90 site-bg-white">

        <div class="container">
            <div class="row">

                <div class="col-xl-3 col-lg-4 col-md-12 rightSidebar m-b30">

                    <div class="side-bar-st-1">



                        @include('inc.user.nav')

                    </div>
                </div>
                {{-- <candidate-profile :data='@json($data)'></candidate-profile> --}}
                {{-- <candidate-work-information :data='@json($data)'></candidate-work-information> --}}
                <div class="col-xl-9 col-lg-8 col-md-12 m-b30">
                    <!--Filter Short By-->
                    <div class="twm-right-section-panel site-bg-gray">
                        <!--personal information-->
                        <div class="panel panel-default">
                            <div class="panel-heading wt-panel-heading p-a20">
                                <!-- <div class="d-flex justify-content-between"> -->
                                    <h4 class="panel-tittle m-a0">{{ 'კატეგორია და გრაფიკი' }}</h4>
                                    @php
                                        print_r($data['classificator']['category'])
                                    @endphp
                                    {{-- <!-- <button type="button" class="btn btn-success" @click="addWorkInfoModal()"><i class="fa fa-plus"></i> დამატება</button> --> --}}

                                <!-- </div> -->
                            </div>
                            <div class="panel-body wt-panel-body p-a20 m-b30 ">
                                <p class="text-danger">შეგიძლიათ შეავსოთ რამოდენიმე კატეგორიაზე და ჩვენ შემოგთავაზებთ თქვენ მიერ არჩეული კატეგორიების შესაბამის ვაკანისებს.</p>
                                <small>ინფორმაციის შევსების შემდეგ გამოიყენეთ ღილაკი შენახვა რის შემდეგაც საშვალება მოგეცემათ დაიწყოთ ინფორმაციის შევსება სხვა კატეგორიაზე.</small>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ 'კატეგორია' }}</label>
                                            <div class="ls-inputicon-box">
                                                <select class="wt-select-box selectpicker"  data-live-search="true" title=""  data-bv-field="size">
                                                    @foreach ($data['classificator']['category'] as $item)
                                                        <option value="">აირჩიე</option>
                                                        <option  value="{{ $item['id'] }}">{{ $item['name_'.app()->getLocale()] }}</option>
                                                    @endforeach

                                                </select>
                                                <!-- <i class="fs-input-icon fa fa-smoking"></i> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>{{ 'სამუშაო გრაფიკი' }}</label>
                                            <div class="ls-inputicon-box">
                                                <select class="wt-select-box selectpicker"   data-live-search="false" title=""  data-bv-field="size">
                                                    @foreach ($data['classificator']['workSchedule'] as $item)
                                                        <option value="">აირჩიე</option>
                                                        <option  value="{{ $item['id'] }}">{{ $item['name_'.app()->getLocale()] }}</option>
                                                    @endforeach
                                                </select>
                                                <!-- <i class="fs-input-icon fa fa-smoking"></i> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>{{ 'რომელი სათიდან?' }}</label>
                                            <div class="ls-inputicon-box">
                                                <input class="form-control" type="time" step="1" >

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>{{ 'რომელი სათამდე?' }}</label>
                                            <div class="ls-inputicon-box">
                                                <input class="form-control" type="time" step="1" >

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>{{ 'ანაზღაურება' }}</label>
                                            <div class="ls-inputicon-box">
                                                <input class="form-control" type="number" step="50" value="800">
                                                <i class="fs-input-icon fa fa-money"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>{{ 'ვალუტა' }}</label>
                                            <div class="ls-inputicon-box">
                                                <select class="wt-select-box selectpicker"  data-live-search="false" title=""  data-bv-field="size">
                                                    @foreach ($data['classificator']['currency'] as $item)
                                                        <option value="">აირჩიე</option>
                                                        <option  value="{{ $item['id'] }}">{{ $item['name_'.app()->getLocale()] }}</option>
                                                    @endforeach
                                                </select>
                                                <i class="fs-input-icon fa fa-usd"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                         <!--რეკომენდაცია-->
                 <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">{{ __('lang.user_profile_page_recomendation_title') }}</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ __('lang.user_profile_page_recomendation_from') }}</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker"    data-live-search="false" title=""  data-bv-field="size">
                                            <option value="">აირჩიე</option>
                                            <option :value="1">წარმოვადგენ</option>
                                            <option :value="2">ვერ წარმოვადგენ</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-thumbs-up"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 " >
                                <div class="form-group">
                                    <label>{{ __('lang.user_profile_page_recomendation_where_from') }}</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker"    data-live-search="false" title=""  data-bv-field="size">
                                            @foreach ($data['classificator']['recommendationFromWhom'] as $item)
                                                <option value="">აირჩიე</option>
                                                <option  value="{{ $item['id'] }}">{{ $item['name_'.app()->getLocale()] }}</option>
                                            @endforeach
                                        <select>
                                        <i class="fs-input-icon fa fa-industry"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div  class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ __('lang.user_profile_page_recomendation_name') }}</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control"  type="text" placeholder="">
                                            <i class="fs-input-icon fa fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div  class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>თანამდებობა</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control"  type="text" placeholder="">
                                            <i class="fs-input-icon fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div  class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ __('lang.user_profile_page_recomendation_number') }}</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control"  type="text" placeholder="">
                                            <i class="fs-input-icon fa fa-phone"></i>
                                        </div>
                                    </div>
                                </div>
                                <div  class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>ფაილი</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" ref="upload" type="file"  placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12" >
                                    <div class="form-group">
                                        <label>რეცომდაციის არ ქონის მიზეზი</label>
                                        <div class="ls-inputicon-box">
                                            <select class="wt-select-box selectpicker"    data-live-search="true" title=""  data-bv-field="size">
                                                @foreach ($data['classificator']['noRecommendationReason'] as $item)
                                                    <option value="">აირჩიე</option>
                                                    <option  value="{{ $item['id'] }}">{{ $item['name_'.app()->getLocale()] }}</option>
                                                @endforeach
                                            </select>
                                            <i class="fs-input-icon fa fa-history"></i>
                                        </div>
                                    </div>
                                </div>
                                <div  class="col-md-12">
                                    <div class="form-group">
                                        <label>დამატაბითი ინფორმაცია</label>
                                        <textarea class="form-control" rows="3"  placeholder="ჩაწერეთ იმ შემთხვევაში თუ ასარჩევ ველში ვერ ნახეთ შესაფერისი მიზეზი ან გსურთ დამატებითი ინფორმაციის მოწოდება"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div  class="col-lg-12 col-md-12">
                                <div class="text-right ">
                                    <button class="btn btn-success"
                                    {{-- @click="addCandidateRecommendation(candidateRecommendationModel)" --}}
                                    title="დამატება" data-bs-toggle="tooltip" data-bs-placement="top">დამატება
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="panel-body wt-panel-body">
                                    <div class="p-a20 table-responsive">
                                        <table class="table twm-table table-striped table-borderless">
                                            <thead>
                                                <tr>
                                                <th>N</th>
                                                <th>საიდან?</th>
                                                <th>სახელი გვარი</th>
                                                <th>ნომერი</th>
                                                <th>თანამდებობა</th>
                                                <th>ფაილი</th>
                                                <th>action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                {{-- <td>{{ index + 1 }}</td>
                                                <td><span :class="(item.recommendation_from_whom_id == 1)?'badge bg-success p-2':'badge bg-info text-dark p-2'">{{ item.recommendation_whom[`name_${getLang}`] }}</span></td>
                                                <td>{{ item.name }}</td>
                                                <td>{{ item.number }}</td>
                                                <td>{{ item.position }}</td>
                                                <td>{{ item.file }}</td> --}}
                                                <td>
                                                    {{-- <button @click="removeRow('recommendation',index)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </button> --}}
                                                </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 mt-4">
                                <div class="text-left">
                                    <button type="submit"  class="site-button">{{ 'შენახვა' }}</button>
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
    <!-- OUR BLOG END -->

</div>
<!-- CONTENT END -->
@endsection
