<template lang="">
    <section class="content ">
        <div class="container-fluid">
            <div id="accordion" >
                <div class="card card-primary" >
                    <div class="card-header">
                    <h4 class="card-title w-100 d-flex justify-content-between">
                        <a class="d-block w-100" data-toggle="collapse"  href="#collapseOne">
                        ფილტრი
                        </a>
                        <i class="fas fa-angle-down float-right"></i>
                    </h4>
                    </div>
                    <div id="collapseOne" class="collapse" :class="colspan" data-parent="#accordion" >
                        <div class="card-body">
                        <h5 class="ml-2"><i class="fa fa-user" ></i> დამკვეთი:</h5>
                        <hr>
                            <div class="row" v-if="cla">

                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>სახელი გვარი</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.name"  type="text" placeholder="Devid Smith">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>ტელეფონის ნომერი</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.number"  type="text" placeholder="555444333" onkeypress="return event.which != 32">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>მისამართი</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.address"  type="text" placeholder="თბილის სამგორი კახეთის გზატკეცილი">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 border mb-3"></div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>ID</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.code"  type="text" placeholder="უნიკალური კოდი">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12" >
                                    <div class="form-group">
                                        <label>კატეგორია</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.category"  :options="cla.category" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12" >
                                    <div class="form-group">
                                        <label>გრაფიკი</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.work_schedule"  :options="cla.workSchedule" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>ანაზღაურება</label>
                                        <div class="ls-inputicon-box mt-4">
                                            <Slider v-model="m.payment" :min=50  :max=5000 :step=10 class="slider"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>ვალუტა</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.currency" :options="cla.currency" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                                <template slot="singleLabel" slot-scope="{ option }"></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>სტატუსი</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.status" :options="cla.status" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                                <template slot="singleLabel" slot-scope="{ option }"></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12" v-if="roleId == 1">
                                    <div class="form-group">
                                        <label>HR</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.hrs"  :options="cla.hr" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 border mb-3"></div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label class="ml-4"> ასაკი</label>
                                        <div class="ls-inputicon-box mt-4">
                                            <Slider v-model="m.age" :min=18 :step=10 class="slider"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12" >
                                    <div class="form-group">
                                        <label>განათლება</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.education"  :options="cla.educations" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12" >
                                    <div class="form-group">
                                        <label>სპეციალობა</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.specialty"  :options="cla.specialties" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12" >
                                    <div class="form-group">
                                        <label>უცხო ენა</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.language"  :options="cla.languages" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12" >
                                    <div class="form-group">
                                        <label>ცოდნის დონე</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.language_level"  :options="cla.languageLevels" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12" >
                                    <div class="form-group">
                                        <label>მართვის მოწმობა</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.driving_license"  :options="cla.drivingLicense" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name" track-by="name" :preselect-first="false" >
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12" >
                                    <div class="form-group">
                                        <label>ზოგადი მახასიათებლები</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.characteristic"  :options="cla.characteristic" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 border mb-3"></div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>დამატების თარიღი (დან)</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.created_at_from"  type="date" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>დამატების თარიღი (მდე)</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.created_at_to"  type="date" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>გასაუბრების თარიღი (დან)</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.interview_date_from"  type="dateTime-local" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>გასაუბრების თარიღი (მდე)</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.interview_date_two"  type="dateTime-local" >
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-12" >
                                    <div class="form-group">
                                        <label>გასაუბრების ადგილი</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.interview_place"  :options="cla.interviewPlace" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>დაწყების თარიღი (დან)</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.start_date_from"  type="date" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>დაწყების თარიღი (მდე)</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.start_date_to"  type="date" >
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-12" >
                                    <div class="form-group">
                                        <label>ვადა</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.term"  :options="cla.term" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                    <div class=" form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" v-model="m.go_vacation">
                                        <label class="form-check-label" for="exampleCheck1">შეეძლოს არდადეგებზე გაყოლა</label>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                    <div class=" form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck2" value="1" v-model="m.stay_night">
                                        <label class="form-check-label" for="exampleCheck2">შეეძლოს ღამე დარჩენა</label>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                    <div class=" form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck3" value="1" v-model="m.work_additional_hours">
                                        <label class="form-check-label" for="exampleCheck3">შეეძლო დამატებით საათებში მუშაობა</label>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                    <div class=" form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck4" value="1" v-model="m.has_family_work_experience">
                                        <label class="form-check-label" for="exampleCheck4">ოჯახში მუშაობის გამოცდილება</label>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                    <div class=" form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck5" value="1" v-model="m.has_recommendation">
                                        <label class="form-check-label" for="exampleCheck5">რეკომენდაცია</label>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12 mt-3" v-if="roleId == 2">
                                    <div class=" form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck6" value="true" v-model="m.hr">
                                        <label class="form-check-label" for="exampleCheck6">ჩემი ვაკანსიები</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer ">
                            <button type="button" class="btn btn-primary" @click="endFilter()"><i class="fa fa-times"></i> ფილტრის გამორთვა</button>
                            <button type="button" class="btn btn-success float-right" @click="filterMeth( 'filter', m )"><i class="fa fa-search"></i> ძებნა</button>
                        </div>
                    </div>
                </div>




            </div>
        </div>
        <div class="my-2 d-flex justify-content-end">
            <button type="button" class="btn btn-success" @click="addVacancy()"><i class="fa fa-plus"></i> ვაკანსისი დამატება</button>
        </div>
        <vacancy_table v-if="Object.keys(items).length > 0"  :data="items" :hrId="hrId" :classificatory="tableCla" :roleId="roleId"  :key="tableKey"></vacancy_table>


    <div class="mt-2">
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

  </section>
</template>
<script>
import Slider from '@vueform/slider'
import Paginate from 'vuejs-paginate-next';
import axios from 'axios'
import Switch from '../../../inc/Switch.vue';
import vacancy_table from '../component/table/vacancy_table.vue';
// import Loading from 'vue-loading-overlay';
export default {
    components:{
        Slider,
        Paginate,
        Switch,
        vacancy_table
        // Loading
    },
    props:{
        data: Object
    },
    data() {
        return {
            items:{},
            colspan: 'hide',
            cla:null,
            m: {'payment': [50, 4000], 'age':[18, 65]},
            pagination:{
                current_page: 1,
                last_page: 2,
            },
            getDataType:'first_data',
            roleId: null,
            hrId:null,
            // randomNumber: 0
            tableKey: 0,
            tableCla: null
        }
    },
    computed:{
        randomNumber(){
            function getRandomInt(min, max) {
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }
            return getRandomInt(1, 2);
        }
    },
    created() {
        this.cla = this.data.classificatory
        this.roleId = this.data.roleId
        this.hrId = (this.data.hasOwnProperty('hrId'))?this.data.hrId:null
        this.tableCla = this.data.classificatory.workSchedule
        this.getData()
    },
    methods: {
        getData(){
            if (this.getDataType == 'first_data') {
                this.firstData()
            } else if (this.getDataType == 'filter') {
                this.filter(this.m)
            }

        },
        firstData(){

            this.pagination = {
                    'current_page':this.data.vacancy.current_page,
                    'last_page': this.data.vacancy.last_page
                }
                // console.log('this.data.classificatory',this.data.classificatory.workSchedule);
            this.items = this.data.vacancy.data

        },
        filterMeth(type,m){
            this.getDataType = type
            if (this.getDataType == 'filter') {
                this.filter(m)
            }
        },
        filter(m){
            (m.created_at_from || m.created_at_to)?m['created_at'] = [m.created_at_from, m.created_at_to]:'';
            (m.start_date_from || m.start_date_to)?m['start_date'] = [m.start_date_from, m.start_date_to]:'';
            (m.interview_date_from || m.interview_date_to)?m['interview_date'] = [m.interview_date_from, m.interview_date_to]:'';
            // (m.hr)?m.hr = this.hrId:'';


            let currentObj = this

            axios({
                method: "post",
                url: '/admin_vacancy_filter?page=' + this.pagination.current_page,
                data: m,
            })
            .then(function (response) {
                currentObj.pagination = {
                    'current_page':response.data.current_page,
                    'last_page': response.data.last_page
                }
                currentObj.items = response.data.data
                currentObj.tableKey++



            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        addVacancy(){
            let url = new URL( location.href)
            window.location.replace(`${url.origin}/ka/post_job`);
        },
        endFilter(){
            this.m = {'payment': [50, 4000], 'age':[18, 65]}
            this.items = this.data.vacancy.data

        }

    },
}
</script>
<style lang="">

</style>
