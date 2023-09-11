<template lang="">
    <div class="section-full p-t120  p-b90 site-bg-white">


        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-12 rightSidebar">

                        <div class="side-bar">

                            <div class="sidebar-elements search-bx">

                                <form>

                                    <div class="form-group mb-4 categorySideBar">
                                        <h4 class="section-head-small mb-4">{{ $t('lang.candidate_page_leftside_category') }}</h4>
                                        <select class="wt-select-bar-large selectpicker"  data-live-search="true" data-bv-field="size">
                                            <option selected>{{ $t('lang.candidate_page_leftside_category_allcategory') }}</option>
                                            <option>ძიძა</option>
                                            <option>დამხმარე</option>
                                            <option>მზარეული</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-4 keywordSideBar">
                                        <h4 class="section-head-small mb-4">{{ $t('lang.candidate_page_leftside_keyword') }}</h4>
                                        <div class="input-group">
                                            <input type="text" class="form-control" :placeholder="$t('lang.candidate_page_leftside_name_or_keyword') ">
                                            <button class="btn" type="button"><i class="feather-search"></i></button>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4 locationSideBar">
                                        <h4 class="section-head-small mb-4">{{ $t('lang.candidate_page_leftside_location') }}</h4>
                                        <div class="input-group">
                                            <input type="text" class="form-control" :placeholder="$t('lang.candidate_page_leftside_search_location') ">
                                            <button class="btn" type="button"><i class="feather-map-pin"></i></button>
                                        </div>
                                    </div>

                                    <div class="twm-sidebar-ele-filter jobTypeSideBar">
                                        <h4 class="section-head-small mb-4">{{ $t('lang.candidate_page_leftside_type_of_work') }}</h4>
                                        <ul>
                                            <li>
                                                <div class=" form-check">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                    <label class="form-check-label" for="exampleCheck1">თავისუფალი</label>
                                                </div>
                                                <span class="twm-job-type-count">09</span>
                                            </li>

                                            <li>
                                                <div class=" form-check">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                                    <label class="form-check-label" for="exampleCheck2">სრული განაკვეთი</label>
                                                </div>
                                                <span class="twm-job-type-count">07</span>
                                            </li>

                                            <li>
                                                <div class=" form-check">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck3">
                                                    <label class="form-check-label" for="exampleCheck3">სტაჟირება</label>
                                                </div>
                                                <span class="twm-job-type-count">15</span>
                                            </li>

                                            <li>
                                                <div class=" form-check">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck4">
                                                    <label class="form-check-label" for="exampleCheck4">ნახევარი განაკვეთი</label>
                                                </div>
                                                <span class="twm-job-type-count">20</span>
                                            </li>

                                            <li>
                                                <div class=" form-check">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck5">
                                                    <label class="form-check-label" for="exampleCheck5">დროებითი</label>
                                                </div>
                                                <span class="twm-job-type-count">22</span>
                                            </li>

                                            <li>
                                                <div class=" form-check">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck6">
                                                    <label class="form-check-label" for="exampleCheck6">მოხალისე</label>
                                                </div>
                                                <span class="twm-job-type-count">25</span>
                                            </li>

                                        </ul>
                                    </div>

                                    <div class="twm-sidebar-ele-filter publicationSideBar">
                                        <h4 class="section-head-small mb-4">{{ $t('lang.candidate_page_leftside_date_of_publication') }}</h4>
                                        <ul>

                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="examplecheckbox6">
                                                    <label class="form-check-label" for="examplecheckbox6">{{ $t('lang.candidate_page_leftside_any') }}</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="examplecheckbox1">
                                                    <label class="form-check-label" for="examplecheckbox1">{{ $t('lang.candidate_page_leftside_last_24') }}</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="examplecheckbox2">
                                                    <label class="form-check-label" for="examplecheckbox2">{{ $t('lang.candidate_page_leftside_last_3') }}</label>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="examplecheckbox3">
                                                    <label class="form-check-label" for="examplecheckbox3">{{ $t('lang.candidate_page_leftside_last_7') }}</label>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>

                                    <div class="twm-sidebar-ele-filter sallarySideBar">
                                        <h4 class="section-head-small mb-4">{{ $t('lang.candidate_page_leftside_sallary') }}</h4>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="Any1">
                                                    <label class="form-check-label" for="Any1">{{ $t('lang.candidate_page_leftside_sallary_any') }}</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="Compensation1">
                                                    <label class="form-check-label" for="Compensation1">{{ $t('lang.candidate_page_leftside_sallary_from_500') }}</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="Compensation21">
                                                    <label class="form-check-label" for="Compensation21">{{ $t('lang.candidate_page_leftside_sallary_from_700') }}</label>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="Compensation31">
                                                    <label class="form-check-label" for="Compensation31">{{ $t('lang.candidate_page_leftside_sallary_from_900') }}</label>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="Other11">
                                                    <label class="form-check-label" for="Other1">{{ $t('lang.candidate_page_leftside_sallary_other') }}</label>
                                                </div>
                                            </li>

                                            <div class="twm-sidebar-ele-filter sheduldeSideBar">
                                                <h4 class="section-head-small mb-4">{{ $t('lang.candidate_page_leftside_shedulde') }}</h4>
                                                <ul>
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="AnySchedule1">
                                                            <label class="form-check-label" for="AnySchedule1">{{ $t('lang.candidate_page_leftside_shedulde_any') }}</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="DaySchedule1">
                                                            <label class="form-check-label" for="DaySchedule1">{{ $t('lang.candidate_page_leftside_shedulde_day') }}</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="Compensation2">
                                                            <label class="form-check-label" for="Compensation2">{{ $t('lang.candidate_page_leftside_shedulde_night') }}</label>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="Compensation3">
                                                            <label class="form-check-label" for="Compensation3">{{ $t('lang.candidate_page_leftside_shedulde_daily') }}</label>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="Other1">
                                                            <label class="form-check-label" for="Other1">{{ $t('lang.candidate_page_leftside_shedulde_other') }}</label>
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>

                                            <div class="twm-sidebar-ele-filter">
                                                <h4 class="section-head-small mb-4">{{ $t('lang.candidate_page_leftside_second_location') }}</h4>
                                                <ul>
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="AnyLocation1">
                                                            <label class="form-check-label" for="AnyLocation1">{{ $t('lang.candidate_page_leftside_second_location_any') }}</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="FromLocation1">
                                                            <label class="form-check-label" for="FromLocation1">{{ $t('lang.candidate_page_leftside_second_location_3km') }}</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="FromLocation2">
                                                            <label class="form-check-label" for="FromLocation2">{{ $t('lang.candidate_page_leftside_second_location_5km') }}</label>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="FromLocation3">
                                                            <label class="form-check-label" for="FromLocation3">{{ $t('lang.candidate_page_leftside_second_location_7km') }}</label>
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>

                                        </ul>
                                    </div>

                                </form>

                            </div>


                        </div>

                        <div class="twm-advertisment" style="background-image:url(/images/add-bg.jpg);">
                           <div class="overlay"></div>
                           <p>{{ $t('lang.candidate_page_leftside_box_title') }} </p>
                            <a href="about-1.html" class="site-button white">{{ $t('lang.candidate_page_leftside_box_read_more') }}</a>
                        </div>

                    </div>

                    <div class="col-lg-8 col-md-12">
                        <!--Filter Short By-->
                        <div class="product-filter-wrap d-flex justify-content-between align-items-center m-b30">
                            <span class="woocommerce-result-count-left">{{ 'ნაჩვენებია ' + count + ' კანდიდატი' }}</span>

                            <form class="woocommerce-ordering twm-filter-select" method="get">
                                <span class="woocommerce-result-count">{{ $t('lang.candidate_page_middle_title_sort') }}</span>
                                <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="size">
                                    <option>{{ $t('lang.candidate_page_middle_latest') }}</option>
                                    <option>{{ $t('lang.candidate_page_middle_free_schedule') }}</option>
                                    <option>{{ $t('lang.candidate_page_middle_full_time') }}</option>
                                    <option>{{ $t('lang.candidate_page_middle_intership') }}</option>
                                    <option>{{ $t('lang.candidate_page_middle_half_time') }}</option>
                                    <option>{{ $t('lang.candidate_page_middle_temporary') }}</option>
                                </select>
                                <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="size">
                                    <option>{{ $t('lang.candidate_page_middle_show_me_10') }}</option>
                                    <option>{{ $t('lang.candidate_page_middle_show_me_20') }}</option>
                                    <option>{{ $t('lang.candidate_page_middle_show_me_30') }}</option>
                                    <option>{{ $t('lang.candidate_page_middle_show_me_40') }}</option>
                                    <option>{{ $t('lang.candidate_page_middle_show_me_50') }}</option>
                                    <option>{{ $t('lang.candidate_page_middle_show_me_60') }}</option>
                                </select>
                            </form>
                            <p style="color: red;"> ამის lang რო წაშლი ჩამიკოპირე</p>

                        </div>

                    <div class="twm-candidates-grid-wrap" >
                        <div class="row">

                            <div class="col-lg-6 col-md-6" v-for="(item, index) in data.candidate" :key="index">
                                 <div class="twm-candidates-grid-style1 mb-5" style="background-color: #fdfff5;">
                                     <div class="twm-media" >
                                         <div class="twm-media-pic">
                                            <img :src="'/images/user-avatar/'+item.user.avatar" alt="#">
                                         </div>
                                         <!-- <div class="twm-candidates-tag"><span>გამორჩეული</span></div> -->
                                     </div>
                                     <div class="twm-mid-content" >
                                         <a href="#" class="twm-job-title">
                                             <h4>{{ item.user[`name_${getLang}`] }} </h4>
                                         </a>
                                         <p><span v-for="(i, index) in item.work_information" :key="index">{{ i[`name_${getLang}`]+', ' }}</span></p>
                                         <a :href="detailUrl+'/'+item.id" class="twm-view-prifile site-text-primary">{{ $t('lang.company_vacancies_page_middle_leftside_read_more') }}</a>

                                         <div class="twm-fot-content">
                                             <div class="twm-left-info">
                                                <p class="twm-candidate-address"><i class="feather-map-pin"></i>{{ item[`address_${getLang}`].substring(0, item[`address_${getLang}`].lastIndexOf(" ")) }}</p>
                                                <i class="fa fa-clock"> {{ item.created_at }}</i>
                                                <!-- <div class="twm-jobs-vacancies">$</div> -->
                                             </div>

                                        </div>
                                     </div>

                                 </div>
                            </div>





                        </div>
                    </div>

                    <div class="pagination-outer">
                        <div class="pagination-style1">
                            <ul class="clearfix">
                                <li class="prev"><a href="javascript:;"><span> <i class="fa fa-angle-left"></i> </span></a></li>
                                <li><a href="javascript:;">1</a></li>
                                <li class="active"><a href="javascript:;">2</a></li>
                                <li><a href="javascript:;">3</a></li>
                                <li><a class="javascript:;" href="javascript:;"><i class="fa fa-ellipsis-h"></i></a></li>
                                <li><a href="javascript:;">5</a></li>
                                <li class="next"><a href="javascript:;"><span> <i class="fa fa-angle-right"></i> </span></a></li>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- OUR BLOG END -->
</template>
<script>
import moment from 'moment'
export default {
    props:{
        data: Object
    },
    data() {
        return {
            candidate: []
        }
    },
    created(){
        this.candidate = this.data.candidate
        for (let i = 0; i < this.candidate.length; i++) {
            // Access the element to update in each object
            this.candidate[i].created_at = moment(this.candidate[i].created_at).format("YYYY-MM-DD");
        }
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
        detailUrl(){
            var url = new URL( location.href)
            return url.origin+'/'+this.getLang+'/candidate-detail'
        },
        count(){
            return this.candidate.length
        }
    },
    methods: {

    },
    mounted() {
        console.log('data', this.data);
    },

}
</script>
<style lang="">

</style>
