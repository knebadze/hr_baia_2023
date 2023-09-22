<template lang="">
    <div class="col-xl-9 col-lg-8 col-md-12 m-b30 employerPageBorder">
        <!--Filter Short By-->
        <div class="twm-right-section-panel site-bg-gray">
            <!-- <form> -->
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
                    <tab-content v-for="(item, index) in stepComponents" :key="index">
                        <component :is="item.component" :data="item.data" />
                    </tab-content>
                    <!-- <tab-content icon="">
                        <component  :is="currentStepComponent" :data="currentStepData" />
                    </tab-content> -->

                    <template v-slot:footer="props">
                        <div class="wizard-footer-left">
                            <button
                                v-if="props.activeTabIndex > 0 && !props.isLastStep"
                                @click="props.prevTab()"
                                class="site-button"
                                >
                                უკან დაბრუნება
                            </button>
                        </div>
                        <div class="wizard-footer-right">
                            <button
                                v-if="!props.isLastStep"
                                @click="props.nextTab()"
                                class="site-button"
                                >
                                შემდეგი
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

            <!-- <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_input_basic_info') }}</h4>
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30 ">
                    <main_info :data="data.basic.user" :genderCLA="data.classificatory.gender"></main_info>
                </div>
            </div> -->


            <!--personal information-->
            <!-- <candidate_information :data="candidateInformationData"></candidate_information> -->

            <!--უცხო ენები-->
            <!-- <candidate_language :data="candidateLanguageData"></candidate_language> -->

            <!--ზოგადი სამუშაო გამოცდილება-->
            <!-- <general_work_Information :data="generalWorkInformationData"></general_work_Information> -->

            <!--დამატებითი ნომრები-->

            <!-- <additional_number :data="additionalNumberData"></additional_number> -->

            <!--ცნობები-->
            <!-- <candidate_notice :data="candidateNoticeData"></candidate_notice> -->
        </div>
    </div>
</template>

<script>
import main_info from '../component/main_info.vue';
import candidate_information from '../component/candidate_information.vue';
import candidate_language from '../component/candidate_language.vue';
import general_work_Information from '../component/general_work_Information.vue';
import additional_number from '../component/additional_number.vue';
import candidate_notice from '../component/candidate_notice.vue';

import work_information from '../component/work_information.vue'
import family_work_experience from '../component/family_work_experience.vue'
import candidate_recommendation from '../component/candidate_recommendation.vue'
import { I18n } from 'laravel-vue-i18n'
import _ from 'lodash'
// import addressMap from '../map/address_map.vue'
// import addressGoogleMap from '../map/address_google_map.vue'
// import address_maplibre from '../map/address_maplibre.vue'
import { uuid } from 'vue-uuid'
import { markRaw } from 'vue';
export default {
    components:{
        main_info,
        candidate_information,
        candidate_language,
        general_work_Information,
        additional_number,
        candidate_notice,
        work_information,
        family_work_experience,
        candidate_recommendation
        // FormWizard,
        // TabContent
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
            userData:{},
            candidateInformationData:{},
            candidateLanguageData:{},
            generalWorkInformationData:{},
            additionalNumberData:{},
            candidateNoticeData:{},

            workInformationData:{},
            familyWorkExperienceData:{},
            recommendationData:{},
            currentStep: 0,
            currentStepComponent:null

        }
    },
    created(){

        console.log('data', this.data);
        this.userData = {
            'model': this.data.basic.user,
            'cla': {
                'gender': this.data.classificatory.gender
            }
        }
        this.candidateInformationData = {
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
        this.candidateLanguageData = {
            'user_id': this.data.basic.auth.id,
            'model': this.data.model.candidate.get_language,
            'cla': {
                'languageLevels': this.data.classificatory.languageLevels,
                'languages': this.data.classificatory.languages
            }
        },
        this.generalWorkInformationData = {
            'user_id': this.data.basic.auth.id,
            'model': this.data.model.candidateWorkExperience,
            'cla':{
                'yesNo': this.data.classificatory.yesNo,
                'workExperiences': this.data.classificatory.workExperiences,
                'noExperienceReason':this.data.classificatory.noExperienceReason
            }
        },
        this.additionalNumberData = {
            'user_id': this.data.basic.auth.id,
            'model': this.data.model.candidateNumber,
            'cla':{
                'numberCode': this.data.classificatory.numberCode,
                'numberOwner': this.data.classificatory.numberOwner,
            }
        },
        this.candidateNoticeData = {
            'user_id': this.data.basic.auth.id,
            'model': this.data.model.candidateNotices,
            'cla':{
                'notices': this.data.classificatory.notices,
            }
        }

        this.data.model.workInformation['payment'] = 800;
        this.m = { ...this.data.model };
        this.workInformationData = {
            'candidate_id': this.data.model.candidate.id,
            'model': {'workInformation':this.data.model.workInformation, 'getWorkInformation': this.data.model.getWorkInformation},
            'cla': {
                'category': this.data.classificatory.category,
                'currency': this.data.classificatory.currency,
                'workSchedule': this.data.classificatory.workSchedule,
            }
        },
        this.familyWorkExperienceData = {
            'candidate_id': this.data.model.candidate.id,
            'model': this.data.model.familyWorkExperience,
            'cla': {
                'category': this.data.classificatory.category,
                'workExperiences': this.data.classificatory.workExperiences,
                'noExperienceReason': this.data.classificatory.noExperienceReason,
                'duty': this.data.classificatory.duty,
                'yesNo': this.data.classificatory.yesNo,
            }
        },
        this.recommendationData = {
            'candidate_id': this.data.model.candidate.id,
            'model': {'candidateRecommendation':this.data.model.candidateRecommendation, 'recommendation': this.data.model.recommendation,},
            'cla': {
                'recommendationFromWhom': this.data.classificatory.recommendationFromWhom,
                'noRecommendationReason': this.data.classificatory.noRecommendationReason,
                'numberCode': this.data.classificatory.numberCode,
                'yesNo': this.data.classificatory.yesNo,
            }
        }

        // if (!this.currentStepComponent) {
        //     this.stepComponent()
        // }

    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
        // languageTableClass(){
        //     return (this.m.candidateLanguages.length > 0 )?'col-lg-12 col-md-12':'col-lg-12 col-md-12 visually-hidden'
        // },
        candidateID(){
            if (this.m.candidate != '') {
                return this.m.candidate.id
            }else if(this.candidate_id != null){
                return this.candidate_id
            }
        },
        stepComponents() {
            return [
                {'component':'main_info', 'data':this.userData},
                {'component':'candidate_information', 'data':this.candidateInformationData},
                {'component':'candidate_language', 'data':this.candidateLanguageData},
                {'component':'general_work_Information', 'data':this.generalWorkInformationData},
                {'component':'additional_number', 'data':this.additionalNumberData},
                {'component':'candidate_notice', 'data':this.candidateNoticeData},
                {'component':'work_information', 'data':this.workInformationData},
                {'component':'family_work_experience', 'data':this.familyWorkExperienceData},
                {'component':'candidate_recommendation', 'data':this.recommendationData}
            ]
        },

        // async currentStepComponent() {
        //     let module = await import(`../component/${this.stepComponents[this.currentStep].component}.vue`);
        //     console.log('model', module);
        //     let component = markRaw(module.default);
        //     return component;
        // },
        // currentStepData() {
        //     return this.stepComponents[this.currentStep].data;
        // },

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
        // nextStep(props) {
        //     props.nextTab();
        //     if (this.currentStep < this.stepComponents.length - 1) {
        //         this.currentStep++;
        //     }
        //     this.stepComponent()
        // },
        // prevStep(props) {
        //     props.prevTab()
        //     if (this.currentStep > 0) {
        //         this.currentStep--;
        //     }
        //     this.stepComponent()
        // },
        // async stepComponent() {
        //     let module = await import(`../component/${this.stepComponents[this.currentStep].component}.vue`);
        //     console.log('model', module);
        //     let component = markRaw(module.default);
        //     this.currentStepComponent = component;
        // },

        // calculateScrollSize() {
        // // Vertical scroll size
        //     this.verticalScrollSize = document.documentElement.scrollHeight;
        //     console.log('this.verticalScrollSize', this.verticalScrollSize);
        //     // Horizontal scroll size
        //     this.horizontalScrollSize = document.documentElement.scrollWidth;
        // }
        // updateScrollPosition() {
        //     // Update the scroll positions
        //     this.verticalScrollPosition = window.scrollY;
        //     console.log('this.verticalScrollPosition',this.verticalScrollPosition);
        //     this.horizontalScrollPosition = window.scrollX;
        // },

    },
    watch:{
    },

    // mounted() {
    //     this.calculateScrollSize();
    //     // Listen to window resize events to update scroll size when the window is resized
    //     window.addEventListener('resize', this.calculateScrollSize);
    // },
    // beforeDestroy() {
    //     // Remove the event listener when the component is destroyed to prevent memory leaks
    //     window.removeEventListener('resize', this.calculateScrollSize);
    // },
    // mounted() {
    //     // Listen to the 'scroll' event on the window
    //     window.addEventListener('scroll', this.updateScrollPosition);

    //     // Initial scroll position
    //     this.updateScrollPosition();
    // },
    // beforeDestroy() {
    //     // Remove the event listener when the component is destroyed
    //     window.removeEventListener('scroll', this.updateScrollPosition);
    // },
}
</script>
<style scoped>

</style>
