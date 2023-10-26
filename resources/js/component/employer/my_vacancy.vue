<template lang="">
    <div class="twm-error-wrap">
        <div class="row">
            <div class="col-lg-12 col-md-12 mb-4">
                <div class="twm-error-content">
                    <h4 class="twm-error-title2 site-text-primary">მიიღეთ ინფორმაციაა თქვენს ვაკანსიაზე</h4>
                    <p>გამოიყენეთ თქვენის მიერ ვაკანსიაში მითითებული ტელეფონის ნომერი.</p>
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
                                        <input v-model="search" type="text"  required class="form-control" :placeholder=" $t('მაგ:555321065')" onkeypress="return /[0-9]/i.test(event.key)">

                                    </div>
                                </div>

                                <!--Find job btn-->
                                <div class="form-group col-xl-3 col-lg-6 col-md-6">
                                    <button type="button" class="site-button" @click="find()">{{ $t('lang.welcome_leftside_bar_search_job_location_job_search_button') }}</button>
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
                                            <th>კატეგორია</th>
                                            <th>გრაფიკი</th>
                                            <th>ანაზღაურება</th>
                                            <th>სტატუსი</th>
                                            <th>დაინტერესდნენ</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--1-->
                                        <tr v-for="(item, index) in vacancy" :key="index">
                                            <td>{{ item.category[`name_${getLang}`] }}</td>
                                            <!-- <td>
                                                <div class="twm-bookmark-list">

                                                    <div class="twm-mid-content">
                                                        <a class="twm-job-title">
                                                            <h4>{{ item[`title_${getLang}`] }}</h4>
                                                        </a>

                                                    </div>

                                                </div>
                                            </td> -->

                                            <td>
                                                <span class="text-clr-green2">{{ item.work_schedule[`name_${getLang}`] }}</span>
                                            </td>
                                            <td>{{ `${item.payment} ${item.currency.icon}` }}</td>
                                            <td><div class="twm-jobs-category"><span class="twm-bg-green">{{ item.status[`name_${getLang}`] }}</span></div></td>
                                            <td class="d-flex justify-content-between">
                                                <a href="javascript:;" class="site-text-primary">{{  item.vacancy_interest.length }}</a>
                                                <button v-if="item.vacancy_interest.length > 0" class="btn btn-info btn-sm" @click="showInterest(item.id)">
                                                    <i class="fa fa-eye text-white"></i>
                                                </button>
                                            </td>

                                            <!-- <td><div class="twm-jobs-category"><span class="twm-bg-green">{{ item.status[`name_${getLang}`] }}</span></div></td> -->

                                            <td>
                                                <div class="twm-table-controls">
                                                    <ul class="twm-DT-controls-icon list-unstyled">
                                                        <li>
                                                            <a :href="`/${getLang}/show_vacancy/${item.code}`">
                                                                <span class="fa fa-eye"></span>
                                                            </a>
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
                            <!-- <show_update_vacancy></show_update_vacancy> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <interest_modal :visible="showInterestModal" :id="vacancyId"></interest_modal>
</template>
<script>
import interest_modal from './modal/interest_modal.vue'
import show_update_vacancy from './show_update_vacancy.vue'
export default {
    components:{
        interest_modal,
        show_update_vacancy
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
            this.vacancyId = id
            this.showInterestModal = !this.showInterestModal
        },


    },
    mounted(){
    }

}
</script>
<style lang="">

</style>
