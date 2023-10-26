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
                                        <multiselect v-model="filterItem.category" :options="data.classificatory.category" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" :label="`name_${getLang}`" :track-by="`name_${getLang}`" :preselect-first="false">
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                    </div>
                                    <div class="form-group mb-4 sheduldeSideBar">
                                        <h4 class="section-head-small mb-4">{{ $t('lang.candidate_page_leftside_shedulde') }}</h4>
                                        <multiselect v-model="filterItem.work_schedule" :options="data.classificatory.workSchedule" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" :label="`name_${getLang}`" :track-by="`name_${getLang}`" :preselect-first="false">
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                    </div>

                                    <div class="form-group mb-4 keywordSideBar">
                                        <!-- სათარგმნი -->
                                        <h4 class="section-head-small mb-4">{{ $t('სახელი გვარი') }}</h4>
                                        <div class="input-group">
                                            <input type="text" v-model="filterItem.name" class="form-control" :placeholder="$t('სახელი გვარი') ">
                                            <button class="btn" type="button"><i class="feather-search"></i></button>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4 locationSideBar">
                                        <h4 class="section-head-small mb-4">{{ $t('lang.candidate_page_leftside_location') }}</h4>
                                        <div class="input-group">
                                            <input type="text" class="form-control" v-model="filterItem.address" :placeholder="$t('lang.candidate_page_leftside_search_location') ">
                                            <button class="btn" type="button"><i class="feather-map-pin"></i></button>
                                        </div>
                                    </div>

                                    <!-- <div class="twm-sidebar-ele-filter jobTypeSideBar">
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
                                    </div> -->

                                    <!-- <div class="twm-sidebar-ele-filter publicationSideBar">
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
                                    </div> -->

                                    <div class="twm-sidebar-ele-filter sallarySideBar">
                                        <h4 class="section-head-small mb-4">{{ $t('lang.candidate_page_leftside_sallary') }}</h4>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" value="0" v-model="filterItem.user_filter_payment" class="form-check-input" id="Any1">
                                                    <label class="form-check-label" for="Any1">{{ $t('lang.individual_vacancies_page_leftside_sallary_any') }}</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" value="1" v-model="filterItem.user_filter_payment" class="form-check-input" id="Compensation1">
                                                    <label class="form-check-label" for="Compensation1">{{ $t('lang.individual_vacancies_page_leftside_sallary_from_500') }}</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" value="2" v-model="filterItem.user_filter_payment" class="form-check-input" id="Compensation2">
                                                    <label class="form-check-label" for="Compensation2">{{ $t('lang.individual_vacancies_page_leftside_sallary_from_700') }}</label>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" value="3" v-model="filterItem.user_filter_payment" class="form-check-input" id="Compensation3">
                                                    <label class="form-check-label" for="Compensation3">{{ $t('lang.individual_vacancies_page_leftside_sallary_from_900') }}</label>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" value="4" class="form-check-input" id="Other1">
                                                    <label class="form-check-label" for="Other1">{{ $t('lang.individual_vacancies_page_leftside_sallary_other') }}</label>
                                                </div>
                                            </li>
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
                        <!--  წაშალე ენები-->
                        <div class="product-filter-wrap d-flex justify-content-between align-items-center m-b30">
                            <span class="woocommerce-result-count-left">{{ 'ნაჩვენებია ' + count + ' კანდიდატი' }}</span>

                            <form class="woocommerce-ordering twm-filter-select" method="get">
                                <!-- <span class="woocommerce-result-count">{{ $t('lang.candidate_page_middle_title_sort') }}</span>
                                <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="size">
                                    <option>{{ $t('lang.candidate_page_middle_latest') }}</option>
                                    <option>{{ $t('lang.candidate_page_middle_free_schedule') }}</option>
                                    <option>{{ $t('lang.candidate_page_middle_full_time') }}</option>
                                    <option>{{ $t('lang.candidate_page_middle_intership') }}</option>
                                    <option>{{ $t('lang.candidate_page_middle_half_time') }}</option>
                                    <option>{{ $t('lang.candidate_page_middle_temporary') }}</option>
                                </select> -->

                                <!-- აქ ენები წააშალე სელეცტი კომენტარში დატოვე -->

                                <!-- <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="size">
                                    <option>{{ $t('lang.candidate_page_middle_show_me_10') }}</option>
                                    <option>{{ $t('lang.candidate_page_middle_show_me_20') }}</option>
                                    <option>{{ $t('lang.candidate_page_middle_show_me_30') }}</option>
                                    <option>{{ $t('lang.candidate_page_middle_show_me_40') }}</option>
                                    <option>{{ $t('lang.candidate_page_middle_show_me_50') }}</option>
                                    <option>{{ $t('lang.candidate_page_middle_show_me_60') }}</option>
                                </select> -->
                            </form>
                            <!-- <p style="color: red;"> ამის lang რო წაშლი ჩამიკოპირე</p> -->

                        </div>

                    <div class="twm-candidates-grid-wrap" >
                        <div class="row">

                            <div class="col-lg-6 col-md-6" v-for="(item, index) in candidate" :key="index">
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
                                         <p><span>{{ item.work_information.map(i => i.name_ka).join(', ')}}</span></p>
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
import moment from 'moment'
export default {
    components:{
        paginate: Paginate,
    },
    props:{
        data: Object,
    },
    data() {
        return {
            candidate: [],
            staticItems: [],
            filterItem:{},
            getDataType: 'first_data',
            pagination:{
                current_page: 1,
                last_page: 2,
            },
        }
    },
    created(){
        this.getData()
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
        getData(){
            if (this.getDataType == 'first_data') {
                this.firstData()
            } else if (this.getDataType == 'filter') {
                this.filter(this.filterItem)
            }
        },
        firstData(){

            this.pagination = {
                'current_page': this.data.candidate.current_page,
                'last_page': this.data.candidate.last_page
            };
            this.candidate = this.data.candidate.data;
            // for (let i = 0; i < this.candidate.length; i++) {
            //     // Access the element to update in each object
            //     this.candidate[i].created_at = moment(this.candidate[i].created_at).format("YYYY-MM-DD");
            // }

            this.staticItems = this.data.candidate.data;
            this.auth = this.data.auth;
        },
        filter(newVal){
            let currentObj = this;
            axios({
                    method: "post",
                    url: '/user_candidate_filter?page=' + this.pagination.current_page,
                    data: newVal,

                })
                .then(function (response) {
                    currentObj.pagination = {
                            'current_page':response.data.data.current_page,
                            'last_page': response.data.data.last_page
                        }
                        currentObj.candidate = response.data.data

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
        },

    },
    mounted() {
    },
    watch:{
        filterItem: {
            handler(newValue, oldValue) {
                // this.menageFilterItem()
                var newVal = this.filterItem
                this.getDataType = 'filter'

                this.filter(newVal)
                // this.filterCount ++
            },
            deep: true
        }
    },

}
</script>
<style lang="">

</style>
