<template lang="">
<!-- OUR BLOG START -->
<div class="section-full p-t120  p-b90 site-bg-white">


    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-12 rightSidebar">

                <div class="side-bar">

                    <div class="sidebar-elements search-bx">

                        <form>

                            <div class="form-group mb-4 categorySideBar">
                                <h4 class="section-head-small mb-4">{{ $t('lang.individual_vacancies_page_leftside_category') }}</h4>
                                <!-- <select class="wt-select-bar-large selectpicker"  data-live-search="true" data-bv-field="size" @change="categoryFilter(category)" v-model="category">
                                    <option selected value="0">{{ $t('lang.individual_vacancies_page_leftside_category_allcategory') }}</option>
                                    <option v-for="(item, index) in data.classificatory.category" :key="index" :value="item.id">{{ item[`name_${getLang}`] }}</option>
                                </select> -->
                                <multiselect v-model="filterItem.category" :options="data.classificatory.category" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" :label="`name_${getLang}`" :track-by="`name_${getLang}`" :preselect-first="false">
                                    <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                </multiselect>
                            </div>

                            <div class="form-group mb-4 keywordSideBar">
                                <h4 class="section-head-small mb-4">{{ $t('lang.individual_vacancies_page_leftside_keyword') }}</h4>
                                <div class="input-group">
                                    <input type="text" class="form-control" v-model="filterItem.word" :placeholder="$t('lang.individual_vacancies_page_leftside_name_or_keyword')">
                                    <button class="btn" type="button"><i class="feather-search"></i></button>
                                </div>
                            </div>

                            <div class="form-group mb-4 locationSideBar">
                                <h4 class="section-head-small mb-4">{{ $t('lang.individual_vacancies_page_leftside_location') }}</h4>
                                <div class="input-group">
                                    <input type="text" class="form-control" :placeholder="$t('lang.individual_vacancies_page_leftside_search_location')">
                                    <button class="btn" type="button"><i class="feather-map-pin"></i></button>
                                </div>
                            </div>
<!--
                            <div class="twm-sidebar-ele-filter jobTypeSideBar">
                                <h4 class="section-head-small mb-4">{{ $t('lang.individual_vacancies_page_leftside_type_of_work') }}</h4>
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
                            </div> -->

                            <div class="twm-sidebar-ele-filter publicationSideBar">
                                <h4 class="section-head-small mb-4">{{ $t('lang.individual_vacancies_page_leftside_date_of_publication') }}</h4>
                                <ul>

                                    <li>
                                        <div class="form-check">
                                            <input type="radio" v-model="filterItem.time" value="0" class="form-check-input" id="examplecheckbox6">
                                            <label class="form-check-label" for="examplecheckbox6">{{ $t('lang.individual_vacancies_page_leftside_any') }}</label>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="form-check">
                                            <input type="radio" v-model="filterItem.time" value="1" class="form-check-input" id="examplecheckbox2">
                                            <label class="form-check-label" for="examplecheckbox2">{{ $t('lang.individual_vacancies_page_leftside_last_3') }}</label>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="form-check">
                                            <input type="radio" v-model="filterItem.time" value="2" class="form-check-input" id="examplecheckbox3">
                                            <label class="form-check-label" for="examplecheckbox3">{{ $t('lang.individual_vacancies_page_leftside_last_7') }}</label>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="form-check">
                                            <input type="radio" v-model="filterItem.time" value="3" class="form-check-input" id="examplecheckbox1">
                                            <label class="form-check-label" for="examplecheckbox1">{{ $t('lang.individual_vacancies_page_leftside_last_24') }}</label>
                                        </div>
                                    </li>

                                </ul>
                            </div>

                            <div class="twm-sidebar-ele-filter sallarySideBar">
                                <h4 class="section-head-small mb-4">{{ $t('lang.individual_vacancies_page_leftside_sallary') }}</h4>
                                <ul>
                                    <li>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="Any1">
                                            <label class="form-check-label" for="Any1">{{ $t('lang.individual_vacancies_page_leftside_sallary_any') }}</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="Compensation1">
                                            <label class="form-check-label" for="Compensation1">{{ $t('lang.individual_vacancies_page_leftside_sallary_from_500') }}</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="Compensation2">
                                            <label class="form-check-label" for="Compensation2">{{ $t('lang.individual_vacancies_page_leftside_sallary_from_700') }}</label>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="Compensation3">
                                            <label class="form-check-label" for="Compensation3">{{ $t('lang.individual_vacancies_page_leftside_sallary_from_900') }}</label>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="Other1">
                                            <label class="form-check-label" for="Other1">{{ $t('lang.individual_vacancies_page_leftside_sallary_other') }}</label>
                                        </div>
                                    </li>

                                    <div class="twm-sidebar-ele-filter sheduldeSideBar">
                                        <h4 class="section-head-small mb-4">{{ $t('lang.individual_vacancies_page_leftside_shedulde') }}</h4>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="AnySchedule1">
                                                    <label class="form-check-label" for="AnySchedule1">{{ $t('lang.individual_vacancies_page_leftside_shedulde_any') }}</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="DaySchedule1">
                                                    <label class="form-check-label" for="DaySchedule1">{{ $t('lang.individual_vacancies_page_leftside_shedulde_day') }}</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="Compensation22">
                                                    <label class="form-check-label" for="Compensation22">{{ $t('lang.individual_vacancies_page_leftside_shedulde_night') }}</label>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="Compensation33">
                                                    <label class="form-check-label" for="Compensation33">{{ $t('lang.individual_vacancies_page_leftside_shedulde_daily') }}</label>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="Other11">
                                                    <label class="form-check-label" for="Other11">{{ $t('lang.individual_vacancies_page_leftside_shedulde_other') }}</label>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>

                                    <div class="twm-sidebar-ele-filter">
                                        <h4 class="section-head-small mb-4">{{ $t('lang.individual_vacancies_page_leftside_second_location') }}</h4>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="AnyLocation1">
                                                    <label class="form-check-label" for="AnyLocation1">{{ $t('lang.individual_vacancies_page_leftside_second_location_any') }}</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="FromLocation1">
                                                    <label class="form-check-label" for="FromLocation1">{{ $t('lang.individual_vacancies_page_leftside_second_location_3km') }}</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="FromLocation2">
                                                    <label class="form-check-label" for="FromLocation2">{{ $t('lang.individual_vacancies_page_leftside_second_location_5km') }}</label>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="FromLocation3">
                                                    <label class="form-check-label" for="FromLocation3">{{ $t('lang.individual_vacancies_page_leftside_second_location_7km') }}</label>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>

                                </ul>
                            </div>

                        </form>

                    </div>

                    <!-- <div class="widget tw-sidebar-tags-wrap">
                        <h4 class="section-head-small mb-4">{{ $t('lang.individual_vacancies_page_leftside_tags') }}</h4>

                        <div class="tagcloud">
                            <a href="job-list.html">ვაკანსია </a>
                            <a href="job-list.html">გადახდა</a>
                            <a href="job-list.html">განაცხადი </a>
                            <a href="job-list.html">სამუშაო</a>
                            <a href="job-list.html">დაქირავება</a>
                            <a href="job-list.html">დამსაქმებელი</a>
                            <a href="job-list.html">შემოსავალი</a>
                            <a href="job-list.html">რჩევები</a>
                        </div>
                    </div> -->


                </div>

            </div>

            <div class="col-lg-8 col-md-12">
                <!--Filter Short By-->
                <div class="product-filter-wrap d-flex justify-content-between align-items-center m-b30">
                    <span class="woocommerce-result-count-left">{{ $t('lang.individual_vacancies_page_middle_first_title') }} {{ vacancy.length }} </span>

                    <form class="woocommerce-ordering twm-filter-select" method="get">
                        <span class="woocommerce-result-count">{{ $t('lang.individual_vacancies_page_middle_title_sort') }}</span>
                        <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="size">
                            <option>{{ $t('lang.individual_vacancies_page_middle_latest') }}</option>
                            <option>{{ $t('lang.individual_vacancies_page_middle_free_schedule') }}</option>
                            <option>{{ $t('lang.individual_vacancies_page_middle_full_time') }}</option>
                            <option>{{ $t('lang.individual_vacancies_page_middle_intership') }}</option>
                            <option>{{ $t('lang.individual_vacancies_page_middle_half_time') }}</option>
                            <option>{{ $t('lang.individual_vacancies_page_middle_temporary') }}</option>
                        </select>
                        <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="size">
                            <option>{{ $t('lang.individual_vacancies_page_middle_show_me_10') }}</option>
                            <option>{{ $t('lang.individual_vacancies_page_middle_show_me_20') }}</option>
                            <option>{{ $t('lang.individual_vacancies_page_middle_show_me_30') }}</option>
                            <option>{{ $t('lang.individual_vacancies_page_middle_show_me_40') }}</option>
                            <option>{{ $t('lang.individual_vacancies_page_middle_show_me_50') }}</option>
                            <option>{{ $t('lang.individual_vacancies_page_middle_show_me_60') }}</option>
                        </select>
                    </form>

                </div>

                <div  class="twm-jobs-list-wrap">
                    <ul>
                        <li v-for="(item, index) in vacancy" :key="index">
                            <div class="twm-jobs-list-style1 mb-5">
                                <!-- <div class="twm-media">
                                    <img src="/images/jobs-company/pic1.jpg" alt="#">
                                </div> -->
                                <div >
                                    <!-- class="twm-mid-content" -->
                                    <a href="job-detail.html" class="twm-job-title">
                                        <h4>{{ item[`title_${getLang}`] }}<span class="twm-job-post-duration"> /{{ item.timeAgo }}</span></h4>
                                    </a>
                                    <p class="twm-job-address">{{ item.author[`address_${getLang}`].split(/\s+/).slice(0, 2).join(" ") }} {{ (item[`for_who_${getLang}`])?item[`for_who_${getLang}`]:'' }}.</p>

                                    <p class="twm-job-address">გრაფიკი: {{ item.work_schedule[`name_${getLang}`]+', '+ item[`additional_schedule_${getLang}`] }}.</p>
                                    <p class="twm-job-address text-danger" v-if="item[`additional_${getLang}`]">დამატებით: {{ item[`additional_${getLang}`] }}.</p>
                                    <!-- <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a> -->
                                </div>
                                <div class="twm-right-content">
                                    <div class="twm-jobs-category green"><span class="twm-bg-green">{{ item.category[`name_${getLang}`] }}</span></div>
                                    <div class="twm-jobs-amount">{{ item.currency.icon }} {{ item.payment }}</div>
                                    <div class="twm-jobs-amount">{{ item.hrInfo.number }} <span>/ {{ item.hrInfo[`name_${getLang}`] }}</span></div>
                                    <button type="button" class="btn btn-primary">დაინტერესება</button>
                                </div>
                            </div>
                        </li>

                    </ul>

                </div>

                <div class="pagination-outer">
                    <div class="pagination-style1">
                        <!-- <ul class="clearfix">
                            <li class="prev"><a href="javascript:;"><span> <i class="fa fa-angle-left"></i> </span></a></li>
                            <li><a href="javascript:;">1</a></li>
                            <li class="active"><a href="javascript:;">2</a></li>
                            <li><a href="javascript:;">3</a></li>
                            <li><a class="javascript:;" href="javascript:;"><i class="fa fa-ellipsis-h"></i></a></li>
                            <li><a href="javascript:;">5</a></li>
                            <li class="next"><a href="javascript:;"><span> <i class="fa fa-angle-right"></i> </span></a></li>
                        </ul> -->
                        <paginate
                            v-model="pagination.current_page"
                            :page-count="pagination.last_page"
                            :page-range="3"
                            :margin-pages="2"
                            :click-handler="getData"
                            :prev-text="'უკან'"
                            :next-text="'წინ'"
                            :container-class="'pagination'"
                            :page-class="'page-item'"
                            >
                        </paginate>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<!-- OUR BLOG END -->
</template>
<script>
import Paginate from 'vuejs-paginate-next';
import axios from 'axios';
export default {
    components:{
        paginate: Paginate,
    },
    props:{
        data: Object
    },
    data() {
        return {
            vacancy:{},
            staticVacancy:{},
            category:[],
            categoryFilterOn: false,
            pagination:{
                current_page: 1,
                last_page: 2,
            },
            filterItem:{
                'category':[],
                'word':null,
                'time':null
            },

        }
    },
    created() {
        this.getData()
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
    },
    methods: {
        getData(){
            axios.get('/vacancy_data?page=' + this.pagination.current_page )
                .then((response)=> {
                    console.log('response.data', response.data);
                        this.pagination = {
                            'current_page':response.data.current_page,
                            'last_page': response.data.last_page
                        }
                        this.vacancy = response.data.data
                        this.staticVacancy = response.data.data


                    // this.isLoading = false;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        VacancyFilter(item){
            console.log('item', this.filterItem);
            let currentObj = this;
            axios({
                method: "post",
                url: "/vacancy_filter",
                data: this.m,

            })
            .then(function (response) {
                // handle success
                console.log(response.data);

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        // categoryFilter(item){
        //     if (Object.keys(item).length == 0 || item[0].id == 0) {
        //         this.categoryFilterOn = false
        //         this.vacancy = this.staticVacancy;
        //         return;
        //     }
        //     this.categoryFilterOn = true
        //     var filter = (this.categoryFilterOn)?this.staticVacancy:this.vacancy
        //     var vacancy = [];
        //     _.forEach(item, function(value) {
        //         _.filter(filter, function(o) {
        //             if(o.category_id == value.id) vacancy.push(o)
        //             return vacancy;
        //         })
        //     });
        //     this.vacancy = vacancy;
        // }
    },
    watch:{
        // 'category': function (newVal, oldVal) {
        //     console.log('newVal',newVal);
        //     this.categoryFilter(newVal)
        // },
        filterItem: {
            handler(newValue, oldValue) {
                console.log('this.filterItem',this.filterItem);
                // axios.get('/vacancy_filter?page=' + this.pagination.current_page+'&filters='+newValue )
                // .then((response)=> {
                //     console.log('response', response.data);
                //         this.pagination = {
                //             'current_page':response.data.current_page,
                //             'last_page': response.data.last_page
                //         }
                //         this.vacancy = response.data.data
                //         this.staticVacancy = response.data.data


                //     // this.isLoading = false;
                // })
                // .catch(function (error) {
                //     console.log(error);
                // });
                console.log('newValue', newValue.category);
                // if (newValue.category.length == 0) {
                //     this.vacancy = this.staticVacancy
                //     return
                // }
                var newVal = this.filterItem
                let currentObj = this;
                axios({
                    method: "post",
                    url: "/vacancy_filter",
                    data: newVal,

                })
                .then(function (response) {
                    // handle success
                    // console.log(response.data);
                    currentObj.pagination = {
                            'current_page':response.data.current_page,
                            'last_page': response.data.last_page
                        }
                        currentObj.vacancy = response.data.data
                        // currentObj.staticVacancy = response.data.data

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },
            deep: true
        }
    },
    mounted() {
        console.log('this.data',this.data);
        this.data
        // console.log('axios', axios);
    },
}
</script>
<style lang="">

</style>
