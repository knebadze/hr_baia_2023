<template lang="">
    <div class="col-xl-9 col-lg-8 col-md-12 m-b30 employerPageBorder">
        <!--Filter Short By-->
        <div class="twm-right-section-panel site-bg-gray">

                <form-wizard step-size="xs"  color="#094899">

                    <template v-slot:step="props">
                        <wizard-step
                            :tab="props.tab"
                            :transition="props.transition"
                            :index="props.index"
                            @click="props.navigateToTab(props.index)"
                        >
                        </wizard-step>
                    </template>

                    <tab-content icon="fa fa-user">
                        <main_info :data="userData" ref="mainInfoComponent" @validateAndEmit="handleFormValidation"/>
                    </tab-content>
                    <tab-content icon="fa fa-user">
                        <candidate_information  :data="candidateInformationData" ref="candidateInformationComponent" @validateAndEmit="handleFormValidation"/>
                    </tab-content>
                    <tab-content icon="fa fa-map">
                        <candidate_address  :data="addressData" ref="candidateAddressComponent" @validateAndEmit="handleFormValidation"/>
                    </tab-content>
                    <tab-content icon="fa fa-language">
                        <candidate_language  :data="candidateLanguageData" ref="candidateLanguageComponent" @validateAndEmit="handleFormValidation"/>
                    </tab-content>
                    <tab-content icon="fa fa-phone">
                        <additional_number  :data="additionalNumberData" ref="additionalNumberComponent" @validateAndEmit="handleFormValidation"/>
                    </tab-content>
                    <tab-content icon="fa fa-user">
                        <general_work_Information  :data="generalWorkInformationData" ref="generalWorkInformationComponent" @validateAndEmit="handleFormValidation"/>
                    </tab-content>
                    <tab-content icon="fa fa-dollar-sign">
                        <work_information  :data="workInformationData" ref="workInformationComponent" @validateAndEmit="handleFormValidation"/>
                    </tab-content>
                    <tab-content icon="fa fa-users">
                        <family_work_experience  :data="familyWorkExperienceData" ref="familyWorkExperienceComponent" @validateAndEmit="handleFormValidation"/>
                    </tab-content>
                    <tab-content icon="fa fa-user">
                        <candidate_recommendation  :data="recommendationData" ref="recommendationComponent" @validateAndEmit="handleFormValidation"/>
                    </tab-content>
                    <tab-content icon="fa fa-list-alt">
                        <candidate_notice  :data="candidateNoticeData" ref="candidateNoticeComponent" @validateAndEmit="handleFormValidation"/>
                    </tab-content>


                    <template v-slot:footer="props">
                        <div class="wizard-footer-left">
                            <button
                                v-if="props.activeTabIndex > 0 && !props.isLastStep"
                                @click="prevStep(props)"
                                class="site-button"
                                >
                                უკან დაბრუნება
                            </button>
                        </div>
                        <div class="wizard-footer-right">
                            <button
                                v-if="!props.isLastStep"
                                @click="nextStep(props)"
                                class="site-button"
                                >
                                გაგრძელება
                            </button>

                            <button
                                v-else
                                @click="confirmMethod"
                                class="site-button"
                                >
                                {{ props.isLastStep ? "დავასრულე" : "შემდეგი" }}
                            </button>
                        </div>
                    </template>
                </form-wizard>
            <!-- </form> -->


        </div>
    </div>
</template>

<script>
import main_info from '../component/main_info.vue';
import candidate_information from '../component/candidate_information.vue';
import candidate_address from '../component/candidate_address.vue';
import candidate_language from '../component/candidate_language.vue';
import general_work_Information from '../component/general_work_Information.vue';
import additional_number from '../component/additional_number.vue';
import candidate_notice from '../component/candidate_notice.vue';

import work_information from '../component/work_information.vue'
import family_work_experience from '../component/family_work_experience.vue'
import candidate_recommendation from '../component/candidate_recommendation.vue'
import { I18n } from 'laravel-vue-i18n'
import _ from 'lodash'
import { uuid } from 'vue-uuid'
import { markRaw } from 'vue';
export default {
    components:{
        main_info,
        candidate_information,
        candidate_address,
        candidate_language,
        general_work_Information,
        additional_number,
        candidate_notice,
        work_information,
        family_work_experience,
        candidate_recommendation
    },
    props:{
        data:Object
    },
    data() {
        return {
            uuid: uuid.v1(),

            noticeFile: {},
            recommendationFile: {},

            //candidateID:
            candidate_id: null,

            // experienceCheck:null


            imgSrc:'',
            noticeFileInfo:[],

            candidate_id: null,
            currentStep: 0,
            currentStepComponent:null,
            stepValidationStatus: {},
            formData:{},
            isValid: false

        }
    },
    created(){
        this.data.model.workInformation['payment'] = 800;
        this.m = { ...this.data.model };

    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },

        candidateID(){
            if (this.m.candidate != '') {
                return this.m.candidate.id
            }else if(this.candidate_id != null){
                return this.candidate_id
            }
        },
        stepComponents() {
            // return [
            //     {'component':'main_info', 'data':this.userData, 'icon': 'fa fa-user'},
            //     {'component':'candidate_information', 'data':this.candidateInformationData, 'icon': 'fa fa-user'},
            //     {'component':'candidate_address', 'data':this.addressData, 'icon': 'fa fa-map'},
            //     {'component':'candidate_language', 'data':this.candidateLanguageData, 'icon': 'fa fa-language'},
            //     {'component':'general_work_Information', 'data':this.generalWorkInformationData, 'icon': 'fa fa-user'},
            //     {'component':'additional_number', 'data':this.additionalNumberData, 'icon': 'fa fa-phone'},
            //     {'component':'candidate_notice', 'data':this.candidateNoticeData, 'icon': 'fa fa-list-alt'},
            //     {'component':'work_information', 'data':this.workInformationData, 'icon': 'fa fa-dollar-sign'},
            //     {'component':'family_work_experience', 'data':this.familyWorkExperienceData, 'icon': 'fa fa-user'},
            //     {'component':'candidate_recommendation', 'data':this.recommendationData, 'icon': 'fa fa-user'},

            // ]
            return {
                main_info: {'component':'main_info', 'data':this.userData, 'icon': 'fa fa-user'},
                candidate_information:{'component':'candidate_information', 'data':this.candidateInformationData, 'icon': 'fa fa-user'},
                candidate_address: {'component':'candidate_address', 'data':this.addressData, 'icon': 'fa fa-map'},
                candidate_language: {'component':'candidate_language', 'data':this.candidateLanguageData, 'icon': 'fa fa-language'},
                additional_number: {'component':'additional_number', 'data':this.additionalNumberData, 'icon': 'fa fa-phone'},
                general_work_Information: {'component':'general_work_Information', 'data':this.generalWorkInformationData, 'icon': 'fa fa-user'},
                work_information: {'component':'work_information', 'data':this.workInformationData, 'icon': 'fa fa-dollar-sign'},
                family_work_experience: {'component':'family_work_experience', 'data':this.familyWorkExperienceData, 'icon': 'fa fa-user'},
                candidate_notice: {'component':'candidate_notice', 'data':this.candidateNoticeData, 'icon': 'fa fa-list-alt'},

                candidate_recommendation:{'component':'candidate_recommendation', 'data':this.recommendationData, 'icon': 'fa fa-user'},

            }


        },

        userData(){
            return {
                'model': this.data.basic.user,
                'cla': {
                    'gender': this.data.classificatory.gender
                }
            }
        },
        candidateInformationData(){
            return {
                'user_id': this.data.basic.auth.id,
                'model': this.data.model.candidate,
                'cla': {
                    'allergies': this.data.classificatory.allergies,
                    'characteristic': this.data.classificatory.characteristic,
                    'citizenship': this.data.classificatory.citizenship,
                    'drivingLicense': this.data.classificatory.drivingLicense,
                    'educations': this.data.classificatory.educations,
                    'maritalStatus': this.data.classificatory.maritalStatus,
                    'nationality': this.data.classificatory.nationality,
                    'professions': this.data.classificatory.professions,
                    'religions': this.data.classificatory.religions,
                    'specialties': this.data.classificatory.specialties,
                }

            }
        },
        candidateLanguageData(){
            return {
                'user_id': this.data.basic.auth.id,
                'model': this.data.model.candidate.get_language,
                'cla': {
                    'languageLevels': this.data.classificatory.languageLevels,
                    'languages': this.data.classificatory.languages
                }
            }
        },
        generalWorkInformationData(){
            return {
                'user_id': this.data.basic.auth.id,
                'model': this.data.model.candidateWorkExperience,
                'cla':{
                    'yesNo': this.data.classificatory.yesNo,
                    'workExperiences': this.data.classificatory.workExperiences,
                    'noExperienceReason':this.data.classificatory.noExperienceReason
                }
            }
        },
        additionalNumberData(){
            return {
                'user_id': this.data.basic.auth.id,
                'model': this.data.model.candidateNumber,
                'cla':{
                    'numberCode': this.data.classificatory.numberCode,
                    'numberOwner': this.data.classificatory.numberOwner,
                }
            }
        },
        candidateNoticeData(){
            return {
                'user_id': this.data.basic.auth.id,
                'model': this.data.model.candidateNotices,
                'cla':{
                    'notices': this.data.classificatory.notices,
                }
            }
        },
        workInformationData(){
            return {
                'candidate_id': this.data.model.candidate.id,
                'model': {'workInformation':this.data.model.workInformation, 'getWorkInformation': this.data.model.getWorkInformation},
                'cla': {
                    'category': this.data.classificatory.category,
                    'currency': this.data.classificatory.currency,
                    'workSchedule': this.data.classificatory.workSchedule,
                }
            }
        },
        familyWorkExperienceData(){
            return {
                'candidate_id': this.data.model.candidate.id,
                'model': this.data.model.familyWorkExperience,
                'cla': {
                    'category': this.data.classificatory.category,
                    'workExperiences': this.data.classificatory.workExperiences,
                    'noExperienceReason': this.data.classificatory.noExperienceReason,
                    'duty': this.data.classificatory.duty,
                    'yesNo': this.data.classificatory.yesNo,
                }
            }
        },
        recommendationData(){
            return {
                'candidate_id': this.data.model.candidate.id,
                'model': {'candidateRecommendation':this.data.model.candidateRecommendation, 'recommendation': this.data.model.recommendation,},
                'cla': {
                    'recommendationFromWhom': this.data.classificatory.recommendationFromWhom,
                    'noRecommendationReason': this.data.classificatory.noRecommendationReason,
                    'numberCode': this.data.classificatory.numberCode,
                    'yesNo': this.data.classificatory.yesNo,
                }
            }
        },
        addressData(){
            return {
                'user_id': this.data.basic.auth.id,
                'model': {
                    'address_ka': this.data.model.candidate.address_ka,
                    'address_en': this.data.model.candidate.address_en,
                    'address_ru': this.data.model.candidate.address_ru,
                    'street_ka': this.data.model.candidate.street_ka,
                    'street_en': this.data.model.candidate.street_en,
                    'street_ru': this.data.model.candidate.street_ru,
                    'latitude': this.data.model.candidate.latitude,
                    'longitude': this.data.model.candidate.longitude,
                },
            }
        },
    },
    methods:{
        showFile(name){
            var pdf = `../../../public/user-documentation/${name}`;
            window.open(pdf);
        },
        confirmMethod(){

            this.$swal(
                {
                    title: '<p>გილოცავთ თქვენ დაასრულეთ ინფორმაციის შევსება</p>',
                    icon: 'info',
                    html:
                        '',
                    showCloseButton: true,
                    showCancelButton: true,
                    focusConfirm: false,
                    confirmButtonText: 'რეზიუმეს ნახვა',
                    cancelButtonText: 'ვაკანსიების ნახვა',
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.replace(`/${this.getLang}/user/myrezume`)
                }else if (result.dismiss === "cancel") {
                    window.location.replace(`/${this.getLang}/job`)
                }
            })
        },
        nextStep(props) {
            let arr = ['mainInfoComponent', 'candidateInformationComponent', 'candidateAddressComponent', 'candidateLanguageComponent', 'additionalNumberComponent', 'generalWorkInformationComponent', 'workInformationComponent', 'familyWorkExperienceComponent', 'recommendationComponent', 'candidateNoticeComponent']
            this.$refs[arr[props.activeTabIndex]].validateAndEmit();
            // this.$refs.candidateInformationComponent.validateAndEmit();
            if (this.isValid) {
                props.nextTab();
                window.scrollTo({ top: 0, left: 0, behavior: 'smooth' });
            }else{
                toast.warning("აუცილებელია სავალდებულო ველები იყოს შევსებული", {
                    theme: 'colored',
                    autoClose: 2000,
                });
            }
            this.isValid = false
        },
        prevStep(props) {
            props.prevTab()
            window.scrollTo({ top: 0, left: 0, behavior: 'smooth' });
        },
        handleFormValidation(isValid) {
            this.isValid = isValid
        },


    },
    watch:{
    },

}
</script>
<style scoped>

</style>
