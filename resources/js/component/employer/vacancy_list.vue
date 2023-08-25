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
                                    <multiselect v-model="filterItem.category" :options="data.classificatory.category" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" :label="`name_${getLang}`" :track-by="`name_${getLang}`" :preselect-first="false">
                                        <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                    </multiselect>
                                </div>
                                <div class="form-group mb-4 categorySideBar">
                                    <h4 class="section-head-small mb-4">{{ $t('lang.individual_vacancies_page_leftside_shedulde') }}</h4>
                                    <multiselect v-model="filterItem.schedule" :options="data.classificatory.workSchedule" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" :label="`name_${getLang}`" :track-by="`name_${getLang}`" :preselect-first="false">
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
                                        <input type="text" class="form-control" v-model="filterItem.location" :placeholder="$t('lang.individual_vacancies_page_leftside_search_location')">
                                        <button class="btn" type="button"><i class="feather-map-pin"></i></button>
                                    </div>
                                </div>


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
                                                <input type="radio" value="0" v-model="filterItem.payment" class="form-check-input" id="Any1">
                                                <label class="form-check-label" for="Any1">{{ $t('lang.individual_vacancies_page_leftside_sallary_any') }}</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input type="radio" value="1" v-model="filterItem.payment" class="form-check-input" id="Compensation1">
                                                <label class="form-check-label" for="Compensation1">{{ $t('lang.individual_vacancies_page_leftside_sallary_from_500') }}</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input type="radio" value="2" v-model="filterItem.payment" class="form-check-input" id="Compensation2">
                                                <label class="form-check-label" for="Compensation2">{{ $t('lang.individual_vacancies_page_leftside_sallary_from_700') }}</label>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="form-check">
                                                <input type="radio" value="3" v-model="filterItem.payment" class="form-check-input" id="Compensation3">
                                                <label class="form-check-label" for="Compensation3">{{ $t('lang.individual_vacancies_page_leftside_sallary_from_900') }}</label>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="Other1">
                                                <label class="form-check-label" for="Other1">{{ $t('lang.individual_vacancies_page_leftside_sallary_other') }}</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>







                                <div class="twm-sidebar-ele-filter sallarySideBar">
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
=======
                    </div> -->


                </div>

            </div>

            <div class="col-lg-8 col-md-12">
                <!--Filter Short By-->
                <div class="product-filter-wrap d-flex justify-content-between align-items-center m-b30">
                    <span class="woocommerce-result-count-left">{{ $t('lang.individual_vacancies_page_middle_first_title') }} {{ count }} </span>
                    <!-- <button class="btn btn-primary">ჩემი დაინტერესებული</button> -->
                    <!-- <form class="woocommerce-ordering twm-filter-select" method="get">
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
                    </form> -->

                </div>

                <div  class="twm-jobs-list-wrap">
                    <ul>
                        <li v-for="(item, index) in vacancy" :key="index">
                            <div class="twm-jobs-list-style1 mb-5">
                                <!-- <div class="twm-media">
                                    <img src="/images/jobs-company/pic1.jpg" alt="#">
                                </div> -->
                                <div class="twm-left-content col-md-8">
                                    <!-- class="twm-mid-content" -->
                                    <!-- <a href="job-detail.html" class="twm-job-title"> -->
                                        <h4> {{ item[`title_${getLang}`] }}<span class="twm-job-post-duration" style="color: green;"> /{{ item.timeAgo }}</span></h4>
                                    <!-- </a> -->
                                    <p class="twm-job-address">{{ item.author[`address_${getLang}`].split(/\s+/).slice(0, 2).join(" ") }}. <span v-for="(i, ind) in item.vacancy_for_who_need" :key="ind">{{  i[`name_${getLang}`]}}</span>.</p>

                                    <p class="twm-job-address">გრაფიკი: {{ item.work_schedule[`name_${getLang}`]+', '+ item[`additional_schedule_${getLang}`] }}.</p>
                                    <p class="twm-job-address text-danger" v-if="item.vacancy_benefit">დამატებით: <span v-for="i in item.vacancy_benefit">{{ i[`name_${getLang}`]+', ' }}</span>.</p>
                                    <!-- <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a> -->
                                </div>
                                <div class="twm-right-content">
                                    <div class="twm-jobs-category green"><span class="twm-bg-green">{{ item.category[`name_${getLang}`] }}</span></div>
                                    <div class="twm-jobs-amount">{{ item.currency.icon }} {{ item.payment }}</div>
                                    <div class="twm-jobs-amount">{{ item.hr.user.number }} <span>/ {{ item.hr.user[`name_${getLang}`] }}</span></div>
                                    <span v-if="auth && item.vacancy_interest.some( (o) => o.candidate_id == auth.candidate.id ) " style="font-size:20px;">
                                        <i :class="(item.vacancy_interest.some( (o) => o.candidate_id == auth.candidate.id && o.employer_answer == null))?'fa fa-plus-circle text-warning':(item.vacancy_interest.some( (o) => o.user_id == auth.id && o.employer_answer == 0))?'fa fa-times-circle text-danger':(item.vacancy_interest.some( (o) => o.user_id == auth.id && o.employer_answer == 1))?'fa fa-check-circle text-success':''"></i></span>
                                    <button v-else type="button" class="btn btn-primary" @click="interest(item)">{{ $t('lang.individual_vacancies_page_middle_interest_button') }}</button><br>
                                    <span> <a class="job_detail_read_more btn btn-info fa fa-arrow-right" :href="detailUrl+'/'+item.id+'/'+item.slug" style="  margin-top: 5%; color: #fff;"></a> </span>
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
                            :prev-text="'<<'"
                            :next-text="'>>'"
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
import _ from 'lodash'
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
            count:0,
            auth:null,
            category:[],
            categoryFilterOn: false,
            pagination:{
                current_page: 1,
                last_page: 2,
            },
            filterItem:{

            },
            filterCount:0,
            getDataType:'first_data',
            checkInterest:false


        }
    },
    created() {
        this.getData()
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
        detailUrl(){
            var url = new URL( location.href)
            return url.origin+'/'+this.getLang+'/job_detail'
        }
    },
    methods: {
        getData(){
            if (this.getDataType == 'first_data') {
                this.firstData()
            } else if (this.getDataType == 'filter') {
                this.filter(this.filterItem)
            }
        },
        async firstData(){
            try {
                const response = await axios.get('/vacancy_data?page=' + this.pagination.current_page);

                console.log('response.data', response.data);

                this.pagination = {
                    'current_page': response.data.vacancy.current_page,
                    'last_page': response.data.vacancy.last_page
                };

                this.vacancy = response.data.vacancy.data;
                this.staticVacancy = response.data.vacancy.data;
                this.count = response.data.count;
                this.auth = response.data.auth;

                // this.isLoading = false;
            } catch (error) {
                console.error(error);
            }
        },
        menageFilterItem(){

            if (this.filterItem.category && this.filterItem.category.length == 0 ) {
                    delete this.filterItem['category']
                }
                if (this.filterItem.schedule && this.filterItem.schedule.length == 0 ) {
                    delete this.filterItem['schedule']
                }
                if (this.filterItem.word == '') {
                    delete this.filterItem['word']
                }
                if (this.filterItem.location == '') {
                    delete this.filterItem['location']
                }
                if (this.filterItem.time == '' || this.filterItem.time === '0') {
                    delete this.filterItem['time']
                }
                if (this.filterItem.payment == '' || this.filterItem.payment === '0') {
                    delete this.filterItem['payment']
                }
                if (this.filterCount != 0 ) {
                    this.vacancy = this.staticVacancy
                }
        },
        filter(newVal){
            let currentObj = this;
            axios({
                    method: "post",
                    url: '/vacancy_filter?page=' + this.pagination.current_page,
                    data: newVal,

                })
                .then(function (response) {
                    console.log('response.data',response.data);
                    currentObj.pagination = {
                            'current_page':response.data.vacancy.current_page,
                            'last_page': response.data.vacancy.last_page
                        }
                        currentObj.vacancy = response.data.vacancy.data
                        currentObj.count = response.data.count

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
        },
        interest(item){
            if (this.auth != null ) {
                if (this.auth.role_id != 3) {
                    toast.error("თქვენ არ გაქვთ დაინტერესების უფლება", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    return
                }else if(this.auth.role_id == 3  ){
                    if (this.auth.candidate.status_id == 8) {
                        toast.error("თქვენ ჯერ არ გაქვთ დაინტერესების უფლება, გთხოვთ შეავსოთ ინფორმაცია", {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        return
                    } else if(this.auth.candidate.status_id == 10) {
                        toast.error("არ გაქვთ დაინტერესების უფლება, თქვენ უკვე დასაქმებული ხართ", {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        return
                    }

                }else if(this.auth.role_id == 3){

                }
                this.sendInterestAxios(item)

            }else{
                this.$swal(
                    {
                        title: '<p>დაინტერესებამდე სავალდებულოა გაიაროთ ავტორიზაცია!!!</p>',
                        icon: 'info',
                        html:
                            'თუ ჯერ არ ხართ რეგისტრირებული გთხოვთ დარეგისტრირდეთ',
                        showCloseButton: true,
                        showCancelButton: false,
                        showDenyButton: true,
                        focusConfirm: false,
                        confirmButtonText: 'რეგისტრაცია',
                        denyButtonText: 'შესვლა',
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.location.replace(`/${this.getLang}/user/work_information`)
                    }else if (result.isDenied) {
                        alert()
                    }
                })
            }
        },
        sendInterestAxios(item){
            let currentObj = this

            axios({
                method: "post",
                url: '/interest_vacancy',
                data: {'id': item.id, 'check': this.checkInterest},

            })
            .then(function (response) {
                console.log('response.data',response.data);
                if (response.data.status == 200) {
                    let text;
                    if(response.data.data.type == 'w'){
                        currentObj.$swal({
                            title: '<p>თქვენი სამუშაო კატეგორია არ შეესაბამება ვაკანსიის კატეგორიას!!!</p>',
                            icon: 'info',
                            html:
                                'დარწმუნებული ხართ რომ გსურთ ამ ვაკანსიით დაინტერესება?',
                            showCloseButton: true,
                            showCancelButton: true,
                            showDenyButton: true,
                            focusConfirm: false,
                            confirmButtonText: 'კი',
                            denyButtonText: 'კატეგორიის დამატება',
                            cancelButtonText:'გაუქმება'
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                currentObj.checkInterest = true
                                currentObj.sendInterestAxios(item)
                            }else if (result.isDenied) {
                                window.location.replace(`/${currentObj.getLang}/user/work_information`)
                            }
                        })
                    }else if(response.data.data.type == 's'){
                        toast.success('თქვენ გააგზავნეთ დაინტერესება ვაკანისაზე', {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        var find = currentObj.vacancy.find(element => element.id == item.id);
                        find.vacancy_interest.push(response.data.data.qualifying)
                    }
                }

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        }
    },
    watch:{
        filterItem: {
            handler(newValue, oldValue) {
                this.menageFilterItem()
                var newVal = this.filterItem
                this.getDataType = 'filter'

                this.filter(newVal)
                this.filterCount ++
            },
            deep: true
        }
    },
    mounted() {
        // console.log('this.data',this.data);

    },
}
</script>
<style lang="">

</style>
