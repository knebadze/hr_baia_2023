<template lang="">
    <div class="twm-error-wrap">
        <div class="row">
            <div class="col-lg-12 col-md-12 mb-4">
                <div class="twm-error-content">
                    <h4 class="twm-error-title2 site-text-primary">მიიღეთ ინფორმაციაა თქვენს ვაკანსიაზე</h4>
                    <p>გამოიყენეთ ესემესის სახით გამოგზავნილი უნიკალური კოდი.</p>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="twm-error-image">
                    <div class="twm-bnr-search-bar">
                        <form>
                            <div class="row">

                                <!--Location-->
                                <div class="form-group  col-md-9">
                                    <label>{{ ('უნიკალური კოდი') }}</label>
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
                                        <tr>
                                            <td>
                                                <div class="twm-bookmark-list">

                                                    <div class="twm-mid-content">
                                                        <a href="#" class="twm-job-title">
                                                            <h4>{{ vacancy[`title_${getLang}`] }}</h4>
                                                            <!-- <p class="twm-bookmark-address">
                                                                <i class="feather-map-pin"></i>Sacramento, California
                                                            </p> -->
                                                        </a>

                                                    </div>

                                                </div>
                                            </td>
                                            <td>{{ vacancy.category[`name_${getLang}`] }}</td>
                                            <td>
                                                <span class="text-clr-green2">{{ vacancy.work_schedule[`name_${getLang}`] }}</span>
                                            </td>
                                            <td><a href="javascript:;" class="site-text-primary">{{  vacancy.vacancy_interest.length }}</a></td>

                                            <td><div class="twm-jobs-category"><span class="twm-bg-green">{{ vacancy.status[`name_${getLang}`] }}</span></div></td>

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

                        <div class="twm-candidates-grid-wrap" >
                            <div class="panel-heading wt-panel-heading p-a20">
                                <h4 class="panel-tittle m-a0"><i class="fa fa-user"></i>დაინტერესებული კანდიდატები</h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-6 " style="margin-top:50px;" v-for="(item, index) in interest" :key="index">
                                    <div class="twm-candidates-grid-style1 mb-5" style="background-color: #fdfff5;">
                                        <div class="twm-media" >
                                            <div class="twm-media-pic">
                                            <img :src="'/images/user-avatar/'+item.user.avatar" alt="#">
                                            </div>
                                        </div>
                                        <div class="twm-mid-content" >
                                            <a href="#" class="twm-job-title">
                                                <h4>{{ item.user[`name_${getLang}`] }} </h4>
                                            </a>
                                            <p><span v-for="(i, index) in item.work_information" :key="index">{{ i[`name_${getLang}`]+', ' }}</span></p>
                                            <a href="javascript:;"  @click="gotoDetail(item.id)" class="twm-view-prifile site-text-primary">{{ $t('lang.company_vacancies_page_middle_leftside_read_more') }}</a>

                                            <div class="twm-fot-content">
                                                <div class="twm-left-info">
                                                <p class="twm-candidate-address"><i class="feather-map-pin"></i>{{ item[`address_${getLang}`].substring(0, item[`address_${getLang}`].lastIndexOf(" ")) }}</p>
                                                <i class="fa fa-clock"> 11:23</i>
                                                </div>

                                                <div class="twm-left-info mt-3">
                                                    <button type="button" class="btn btn-danger"> <i class="fa fa-thumbs-down"></i> არ მომწონს</button>
                                                    <button type="button" class="btn btn-success"> <i class="fa fa-thumbs-up"></i> მომწონს</button>
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
        </div>
    </div>
</template>
<script>
export default {
    props:{
        // data: Object
    },
    data() {
        return {
            search:null,
            vacancy:null,
            interest:null
        }
    },
    created() {

    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
        detailUrl(){
            var url = new URL( location.href)
            return url.origin+'/'+this.getLang+'/candidate-detail'
        }
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
                    currentObj.vacancy = response.data.data
                    currentObj.interest = response.data.interest

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
        },
        gotoDetail(id){
            window.open(this.detailUrl+'/'+id);
        }

    },
    mounted(){
        // console.log('data', this.data);
    }

}
</script>
<style lang="">

</style>
