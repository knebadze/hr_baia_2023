<template lang="">
    <div class="twm-error-wrap">
        <div class="row">
            <div class="col-lg-12 col-md-12 mb-4">
                <div class="twm-error-content">
                    <h4 class="twm-error-title2 site-text-primary">მიიღეთ ინფორმაციაა თქვენს ვაკანსიაზე</h4>
                    <p>გამოიყენეთ თქვენის მიერ ვაკანშიაში მითითებული ტელეფონის ნომერი.</p>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="twm-error-image">
                    <div class="twm-bnr-search-bar">
                        <form>
                            <div class="row">

                                <!--Location-->
                                <div class="form-group  col-md-9">
                                    <label>{{ ('ტელეფონის ნომერი') }}</label>
                                    <div class="twm-inputicon-box">
                                        <input v-model="search" type="text"  required class="form-control" :placeholder=" $t('lang.welcome_leftside_bar_search_job_location_job_search')">

                                    </div>
                                </div>

                                <!--Find job btn-->
                                <div class="form-group col-xl-3 col-lg-6 col-md-6">
                                    <button type="button" class="site-button" @click="find()">{{ $t('lang.welcome_leftside_bar_search_job_location_job_search') }}</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12 m-b30" v-if="vacancy">
                <!--Filter Short By-->
                <div class="twm-right-section-panel site-bg-gray">
                        <!--Basic Information-->
                    <div class="panel panel-default">
                        <div class="panel-heading wt-panel-heading p-a20">
                            <h4 class="panel-tittle m-a0"><i class="fa fa-suitcase"></i>თქვენი ვაკანსია</h4>
                        </div>
                        <div class="panel-body wt-panel-body m-b30 ">
                            <div class="twm-D_table p-a20 table-responsive">
                                <table id="" class="table table-bordered twm-bookmark-list-wrap">
                                    <thead>
                                        <tr>
                                            <th>სათაური</th>
                                            <th>კატეგორია</th>
                                            <th>გრაფიკი</th>
                                            <th>დაინტერესდნენ</th>
                                            <th>სტატუსი</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--1-->
                                        <tr v-for="(item, index) in vacancy" :key="index">
                                            <td>
                                                <div class="twm-bookmark-list">

                                                    <div class="twm-mid-content">
                                                        <a href="#" class="twm-job-title">
                                                            <h4>{{ item[`title_${getLang}`] }}</h4>
                                                            <!-- <p class="twm-bookmark-address">
                                                                <i class="feather-map-pin"></i>Sacramento, California
                                                            </p> -->
                                                        </a>

                                                    </div>

                                                </div>
                                            </td>
                                            <td>{{ item.category[`name_${getLang}`] }}</td>
                                            <td>
                                                <span class="text-clr-green2">{{ item.work_schedule[`name_${getLang}`] }}</span>
                                            </td>
                                            <td class="d-flex justify-content-between"><a href="javascript:;" class="site-text-primary">{{  item.vacancy_interest.length }}</a><button class="btn btn-info btn-sm" @click="showInterest(item.id)"><i class="fa fa-eye text-white"></i></button> </td>

                                            <td><div class="twm-jobs-category"><span class="twm-bg-green">{{ item.status[`name_${getLang}`] }}</span></div></td>

                                            <td>
                                                <div class="twm-table-controls">
                                                    <ul class="twm-DT-controls-icon list-unstyled">
                                                        <li>
                                                            <button title="View profile" type="button" data-bs-toggle="tooltip" data-bs-placement="top">
                                                                <span class="fa fa-eye"></span>
                                                            </button>
                                                        </li>

                                                        <li>
                                                            <button title="Delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                                <span class="far fa-trash-alt"></span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>

                                </table>
                            </div>
                        </div>

                        <!-- <div class="twm-candidates-grid-wrap" >
                            <div class="panel-heading wt-panel-heading p-a20">
                                <h4 class="panel-tittle m-a0"><i class="fa fa-user"></i>დაინტერესებული კანდიდატები</h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-6 " style="margin-top:50px;" v-for="(item, index) in interest" :key="index">
                                    <div class="twm-candidates-grid-style1 mb-5" style="background-color: #fdfff5;">
                                        <div class="twm-media" >
                                            <div class="twm-media-pic">
                                            <img :src="'/images/user-avatar/'+item.avatar" alt="#">
                                            </div>
                                        </div>
                                        <div class="twm-mid-content" >
                                            <a href="#" class="twm-job-title">
                                                <h4>{{ item[`fullName_${getLang}`] }} </h4>
                                            </a>
                                            <p><span>{{ item[`name_${getLang}`] }}</span></p>
                                            <a href="javascript:;"  @click="gotoDetail(item.candidate_id)" class="twm-view-prifile site-text-primary">{{ $t('lang.company_vacancies_page_middle_leftside_read_more') }}</a>

                                            <div class="twm-fot-content">
                                                <div class="twm-left-info">
                                                <p class="twm-candidate-address"><i class="feather-map-pin"></i>{{ item[`address_${getLang}`] }}</p>
                                                <i class="fa fa-clock"> 11:23</i>
                                                </div>

                                                <div class="twm-left-info mt-3" v-if="item.employer_answer == null">
                                                    <button type="button" class="btn btn-danger" @click="doNotLike(item.id)"> <i class="fa fa-thumbs-down"></i> არ მომწონს</button>
                                                    <button type="button" class="btn btn-success" @click="like(item.id)"> <i class="fa fa-thumbs-up"></i> მომწონს</button>

                                                </div>
                                                <div class="twm-left-info mt-3" v-if="item.employer_answer == 0">
                                                    <span><i class="text-danger fa fa-thumbs-down" style="font-size:25px"></i></span>
                                                </div>
                                                <div class="twm-left-info mt-3" v-if="item.employer_answer == 1">
                                                    <span><i class="text-success fa fa-thumbs-up" style="font-size:25px"></i></span>
                                                    <button type="button" class="btn btn-info" @click="like()"> <i class="fa fa-eye"></i> გასაუბრება</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <interest_modal :visible="showInterestModal" :id="vacancyId"></interest_modal>
</template>
<script>
import interest_modal from './modal/interest_modal.vue'
export default {
    components:{
        interest_modal,
    },
    props:{
        // data: Object
    },
    data() {
        return {
            search:null,
            vacancy:null,
            interest:null,
            showInterestModal: false,
            vacancyId:null
        }
    },
    created() {

    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
    },
    methods: {
        find(){
            console.log(this.search);
            let currentObj = this;
            axios({
                    method: "post",
                    url: '/find_my_vacancy',
                    data: {'code':this.search},

                })
                .then(function (response) {
                    console.log('response.data',response.data);
                    currentObj.vacancy = response.data.data.vacancy
                    // currentObj.interest = response.data.interest

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
        },
        showInterest(id){
            console.log(id);
            this.vacancyId = id
            this.showInterestModal = !this.showInterestModal
        },
    

    },
    mounted(){
        // console.log('data', this.data);
    }

}
</script>
<style lang="">

</style>
