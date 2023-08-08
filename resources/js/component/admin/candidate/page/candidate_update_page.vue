<template lang="">
    <div class="card">
        <div class="card-body">


            <div class=" p-a20 my-3">
                <h6 class=" m-a0"><i class="fa fa-info"></i> ძირითადი ინფორმაცია</h6>
            </div>
            <hr>
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <label for="exampleInputEmail1">სახელი გვარი</label>
                    <input class="form-control" v-model="m.user.name_ka" type="text" :placeholder="$t('lang.employer_add_job_vacancy_name_placeholder')">
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <label>მაილი</label>
                    <input class="form-control" v-model="m.user.email" type="email" placeholder="employer@gmail.com">
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <label>ტელეფონის ნომერი</label>
                    <input class="form-control" v-model="m.user.number" type="text" >
                </div>
                <!-- <div class="col-6">
                        <label>{{ ('ტელეფონის ნომერი') }}</label>
                    <div class="input-group input-group mb-3">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                                <span :class="`fi fi-${numberCode.iso.toLowerCase()}`"></span>+{{ numberCode.phonecode }}
                            </button>
                            <ul class="dropdown-menu" style=" overflow: hidden; overflow-y: auto; max-height: calc(100vh - 550px);">
                                <li v-for="item in cla.numberCode" @click="chooseNumberCode(item)"><a class="dropdown-item"><span :class="`fi fi-${item.iso.toLowerCase()}`"></span>+{{ item.phonecode }}</a></li>
                            </ul>
                        </div>
                    <input type="text" class="form-control" aria-label="Text input with dropdown button" v-model="m.number" placeholder="555666777" onkeypress="return /[0-9]/i.test(event.key)" >
                    </div>
                </div> -->
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <label for="exampleInputEmail1">მისამართი</label>
                    <input class="form-control" v-model="m.address_ka" type="text" >
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <label >სქესი</label>
                    <div class="ls-inputicon-box">
                        <multiselect  v-model="m.user.gender" :options="cla.gender" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                            <template slot="singleLabel" slot-scope="{ option }"></template>
                        </multiselect>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <label>დაბადების თარიღი</label>
                    <input class="form-control" v-model="m.user.date_of_birth" type="date" >
                </div>

            </div>
            <div class=" p-a20 my-3">
                <h6 class=" m-a0"><i class="fa fa-user"></i> პირადი ინფორმაცია</h6>
            </div>
            <hr>
                <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>პირადი ნომერი</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control" v-model="m.personal_number" type="text"  >
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>ეროვნება</label>
                        <div class="ls-inputicon-box">
                            <multiselect  v-model="m.nationality" :options="cla.nationality" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>მოქალაქეობა</label>
                        <div class="ls-inputicon-box">
                            <multiselect v-model="m.citizenship"  :options="cla.citizenship" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false">
                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                            </multiselect>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>რელიგია</label>
                        <div class="ls-inputicon-box">
                            <multiselect  v-model="m.religion" :options="cla.religions" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>განათლება</label>
                        <div class="ls-inputicon-box">
                            <multiselect  v-model="m.education" :options="cla.educations" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                        </div>
                    </div>
                </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>პროფესია</label>
                        <div class="ls-inputicon-box">
                            <multiselect v-model="m.professions"  :options="cla.professions" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false">
                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                            </multiselect>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>სპეციალობა</label>
                        <div class="ls-inputicon-box">
                            <multiselect v-model="m.specialty"  :options="cla.specialties" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false">
                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                            </multiselect>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>ოჯახური მდგომარეობა</label>
                        <div class="ls-inputicon-box">
                            <multiselect  v-model="m.marital_status" :options="cla.maritalStatus" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12" v-if="m.marital_status.id != 1">
                    <div class="form-group">
                        <label>შვილების რაოდენობა</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control" v-model="m.children" type="number"  >
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12" v-if="m.marital_status.id != 1">
                    <div class="form-group">
                        <label>შვილების ასაკი</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control" v-model="m.children_age" type="text"  >
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12" v-if="m.marital_status.id == 2">
                    <div class="form-group">
                        <label>მეუღლე</label>
                        <div class="ls-inputicon-box">
                            <textarea class="form-control" v-model="m.spouse" type="text" placeholder="" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>ალერგია</label>
                        <div class="ls-inputicon-box">
                            <multiselect v-model="m.allergy"  :options="cla.allergies" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false">
                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                            </multiselect>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>მახასიათებლები</label>
                        <div class="ls-inputicon-box">
                            <multiselect v-model="m.characteristic"  :options="cla.characteristic" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false">
                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                            </multiselect>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>მართვის მოწმობა</label>
                        <div class="ls-inputicon-box">
                            <multiselect v-model="m.driving_license"  :options="cla.drivingLicense" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name" track-by="name" :preselect-first="false">
                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                            </multiselect>
                        </div>
                    </div>
                </div>


            </div>
            <div class=" p-a20 my-3">
                <h6 class=" m-a0"><i class="fa fa-info"></i> დამატებით</h6>
            </div>
            <hr>
            <div class="row">
                <div class=" col-md-12">
                    <div class="form-group">
                        <label>სამედიცინო ინფორმაცია</label>
                        <div class="ls-inputicon-box">
                            <textarea class="form-control" v-model="m.medical_info_ka" type="text" placeholder="" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-6 col-md-12">
                    <label>სიმაღლე (სმ)</label>
                    <input class="form-control" v-model="m.height" type="number" >
                </div>
                <div class="col-xl-2 col-lg-6 col-md-12">
                    <label>წონა (კგ)</label>
                    <input class="form-control" v-model="m.weight" type="number" >
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <label>Facebook ლინკი</label>
                    <input class="form-control" v-model="m.fb_link" type="text" >
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <label>იუთუბის ლინკი</label>
                    <input class="form-control" v-model="m.youtube_link" type="text" >
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class=" form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" v-model="m.smoke">
                        <label class="form-check-label" for="exampleCheck1">მოწევა</label>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class=" form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck2" value="1" v-model="m.convection">
                        <label class="form-check-label" for="exampleCheck2">ნასამართლეობა</label>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class=" form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck3" value="1" v-model="m.work_abroad">
                        <label class="form-check-label" for="exampleCheck1">იმუშავებდით საზღვარგარეთ</label>
                    </div>
                </div>

            </div>
            <hr>
            <div class=" col-md-12">
                <button type="button" class="btn btn-success float-right" @click.prevent="save()" ><i class=""></i>შენახვა</button>
            </div>

        </div>
        <div class="card-footer">
            <div class=" p-a20 my-3">
                <h6 class=" m-a0"><i class="fa fa-wrench"></i> განახლება</h6>
            </div>
            <hr>
            <div class="col-md-12 d-flex justify-content-between">
                <button type="button" class="btn btn-primary " @click="openUpdateLanguageModal( m.get_language)" ><i class=""></i>უცხო ენა</button>
                <button type="button" class="btn btn-primary " @click="openUpdateGeneralWorkModal( m.get_general_work_experience )" ><i class=""></i>ზოგადი სამუშაო გამოცდილება</button>
                <button type="button" class="btn btn-primary " @click="openUpdateFamilyWorkModal(m.family_work_experience)" ><i class=""></i>ოჯახში მუშაობა</button>
                <button type="button" class="btn btn-primary " @click="openUpdateWorkInformationModal(m.get_work_information)" ><i class=""></i>სამუშაო ინფორმაცია</button>
                <button type="button" class="btn btn-primary " @click="openUpdateRecommendationModal(m.get_recommendation)" ><i class=""></i>რეკომენდაცია</button>
                <button type="button" class="btn btn-primary " @click="openUpdateNumberModal(m.number)" ><i class=""></i>ნომრები</button>
                <button type="button" class="btn btn-primary " @click="openUpdateNoticeModal(m.get_notice)" ><i class=""></i>საბუთები</button>
            </div>
        </div>
    </div>
    <update_language_modal :visible="updateLanguageModal" :items="item"></update_language_modal>
    <update_general_work_modal :visible="updateGeneralWorkModal" :items="item"></update_general_work_modal>
    <update_work_information_modal :visible="updateWorkInformationModal" :items="item"></update_work_information_modal>
    <update_family_work_modal :visible="updateFamilyWorkModal" :items="item"></update_family_work_modal>
    <update_number_modal :visible="updateNumberModal" :items="item"></update_number_modal>
    <update_recommendation_modal :visible="updateRecommendationModal" :items="item"></update_recommendation_modal>
    <update_notice_modal :visible="updateNoticeModal" :items="item"></update_notice_modal>
</template>
<script>
import update_language_modal from '../modal/update_language_modal.vue';
import update_general_work_modal from '../modal/update_general_work_modal.vue';
import update_work_information_modal from '../modal/update_work_information_modal.vue';
import update_family_work_modal from '../modal/update_family_work_modal.vue';
import update_number_modal from '../modal/update_number_modal.vue';
import update_recommendation_modal from '../modal/update_recommendation_modal.vue';
import update_notice_modal from '../modal/update_notice_modal.vue';
export default {
    components:{
        update_language_modal,
        update_general_work_modal,
        update_work_information_modal,
        update_family_work_modal,
        update_number_modal,
        update_recommendation_modal,
        update_notice_modal
    },
    props:{
        data: Object
    },
    data() {
        return {
            m:null,
            cla: null,
            updateLanguageModal: false,
            updateGeneralWorkModal: false,
            updateWorkInformationModal: false,
            updateFamilyWorkModal:false,
            updateNumberModal:false,
            updateRecommendationModal: false,
            updateNoticeModal:false,
            item: null
        }
    },
    created(){
        console.log('data', this.data);
        this.cla = this.data.classificatory
        this.data.candidate.smoke = (this.data.candidate.smoke == 1)?true:0;
        this.data.candidate.convection = (this.data.candidate.convection == 1)?true:0;
        this.data.candidate.work_abroad = (this.data.candidate.work_abroad == 1)?true:0;
        this.m = {...this.data.candidate}
    },
    methods:{
        save(){
            let currentObj = this
            this.$swal({
                title: 'ნამდვილად გსურთ რედაქტირება?',
                //   showDenyButton: true,
                cancelButtonText:'არა',
                confirmButtonText: 'კი',
                showCancelButton: true,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios.post('/update_candidate' ,{
                        data: {'model':this.m, 'type': 'main'},
                    })
                    .then(function (response) {
                        if (response.status == 200) {
                            toast.success("წარმატებით დარედაქტირდა", {
                                theme: 'colored',
                                autoClose: 1000,
                            });
                            setTimeout(() => {
                                document.location.reload();
                            }, 2000);
                        }

                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    // this.hide()

                } else if (result.isDenied) {
                    return
                }
            });

        },
        openUpdateLanguageModal(item){
            this.updateLanguageModal = !this.updateLanguageModal
            this.item = {'candidate_id': this.data.candidate.id,'item':item, 'cla':{'languages':this.cla.languages, 'languageLevels': this.cla.languageLevels}}
        },
        openUpdateGeneralWorkModal(item){
            this.updateGeneralWorkModal = !this.updateGeneralWorkModal
            this.item = {'candidate_id': this.data.candidate.id,'item':item, 'cla':{'workExperiences':this.cla.workExperiences, 'yesNo': this.cla.yesNo, 'noExperienceReason': this.cla.noExperienceReason}}
        },
        openUpdateFamilyWorkModal(item){
            this.updateFamilyWorkModal = !this.updateFamilyWorkModal
            this.item = {
                'candidate_id': this.data.candidate.id,
                'item':item,
                'cla':
                {
                    'category': this.cla.category,
                    'workExperiences':this.cla.workExperiences,
                    'yesNo': this.cla.yesNo,
                    'noExperienceReason': this.cla.noExperienceReason,
                    'duty': this.cla.duty
                }
        }
        },
        openUpdateWorkInformationModal(item){
            this.updateWorkInformationModal = !this.updateWorkInformationModal
            this.item = {
                'candidate_id': this.data.candidate.id,
                'item':item,
                'cla':{
                    'workExperiences':this.cla.workExperiences,
                    'yesNo': this.cla.yesNo,
                    'noExperienceReason': this.cla.noExperienceReason,
                    'category': this.cla.category,
                    'currency': this.cla.currency,
                    'workSchedule': this.cla.workSchedule
                }
            }
        },
        openUpdateRecommendationModal(item){
            this.updateRecommendationModal = !this.updateRecommendationModal
            this.item = {
                'candidate_id': this.data.candidate.id,
                'item':item,
                'cla':{
                    'recommendationFromWhom':this.cla.recommendationFromWhom,
                    'yesNo': this.cla.yesNo,
                    'noRecommendationReason': this.cla.noRecommendationReason,
                    'numberCode': this.cla.numberCode
                }
            }
        },
        openUpdateNumberModal(item){
            this.updateNumberModal = !this.updateNumberModal
            this.item = {'candidate_id': this.data.candidate.id,'item':item, 'cla':{'numberOwner':this.cla.numberOwner, 'numberCode': this.cla.numberCode}}
        },
        openUpdateNoticeModal(item){
            this.updateNoticeModal = !this.updateNoticeModal
            this.item = {'candidate_id': this.data.candidate.id,'item':item, 'cla':{'notice':this.cla.notice}}
        },
    }
}
</script>
<style lang="">

</style>
