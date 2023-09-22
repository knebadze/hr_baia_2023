<template lang="">
    <div id="accordion" >
        <div class="card card-primary" >
            <div class="card-header">
            <h4 class="card-title w-100 d-flex justify-content-between">
                <a class="d-block w-100" data-toggle="collapse"  href="#collapseOne">
                    სარეგისტრაციო ინფორმაცია
                </a>
                <i class="fas fa-angle-down float-right"></i>
            </h4>
            </div>
            <div id="collapseOne" class="collapse" :class="addUserColspan" data-parent="#accordion" >
                <div class="card-body">
                    <Add_user :data="addUserData" ></Add_user>
                </div>
            </div>
        </div>
    </div>
    <div id="accordion" >
        <div class="card card-primary" >
            <div class="card-header">
                <h4 class="card-title w-100 d-flex justify-content-between">
                    <a class="d-block w-100" data-toggle="collapse"  href="#collapseCandidate">
                        ძირითადი ინფორმაცია
                    </a>
                    <i class="fas fa-angle-down float-right"></i>
                </h4>
            </div>
            <div id="collapseCandidate" class="collapse" :class="addCandidateColspan" data-parent="#accordion" >
                <div class="card-body">
                    <add_candidate_information :data="candidateInformationData" :onMessageFromChildren="handleMessageFromChildren"></add_candidate_information>
                </div>
            </div>
        </div>
    </div>
    <div id="accordion" >
        <div class="card card-primary" >
            <div class="card-header">
                <h4 class="card-title w-100 d-flex justify-content-between">
                    <a class="d-block w-100" data-toggle="collapse"  href="#collapseLanguage">
                        უცხო ენა
                    </a>
                    <i class="fas fa-angle-down float-right"></i>
                </h4>
            </div>
            <div id="collapseLanguage" class="collapse hide"  data-parent="#accordion" >
                <div class="card-body">
                    <add_candidate_language :data="candidateLanguageData"></add_candidate_language>
                </div>
            </div>
        </div>
    </div>
    <div id="accordion" >
        <div class="card card-primary" >
            <div class="card-header">
                <h4 class="card-title w-100 d-flex justify-content-between">
                    <a class="d-block w-100" data-toggle="collapse"  href="#collapseGeneralWork">
                        ზოგადი სამუშაო გამოცდილება
                    </a>
                    <i class="fas fa-angle-down float-right"></i>
                </h4>
            </div>
            <div id="collapseGeneralWork" class="collapse hide" data-parent="#accordion" >
                <div class="card-body">
                    <add_general_work_experience :data="generalWorkInformationData"></add_general_work_experience>
                </div>
            </div>
        </div>
    </div>
    <div id="accordion" v-if="candidate_id">
        <div class="card card-primary" >
            <div class="card-header">
                <h4 class="card-title w-100 d-flex justify-content-between">
                    <a class="d-block w-100" data-toggle="collapse"  href="#collapseFamilyWork">
                        ოჯახში მუშაობის გამოცდილება
                    </a>
                    <i class="fas fa-angle-down float-right"></i>
                </h4>
            </div>
            <div id="collapseFamilyWork" class="collapse hide" data-parent="#accordion" >
                <div class="card-body">
                    <add_family_work_experience :data="familyWorkExperienceData"></add_family_work_experience>
                </div>
            </div>
        </div>
    </div>
    <div id="accordion" v-if="candidate_id">
        <div class="card card-primary" >
            <div class="card-header">
                <h4 class="card-title w-100 d-flex justify-content-between">
                    <a class="d-block w-100" data-toggle="collapse"  href="#collapseWork">
                        სამუშაო ინფორმაცია
                    </a>
                    <i class="fas fa-angle-down float-right"></i>
                </h4>
            </div>
            <div id="collapseWork" class="collapse hide" data-parent="#accordion" >
                <div class="card-body">
                    <add_work_information :data="workInformationData"></add_work_information>
                </div>
            </div>
        </div>
    </div>
    <div id="accordion" v-if="candidate_id">
        <div class="card card-primary" >
            <div class="card-header">
                <h4 class="card-title w-100 d-flex justify-content-between">
                    <a class="d-block w-100" data-toggle="collapse"  href="#collapseRecommendation">
                        რეკომენდაცია
                    </a>
                    <i class="fas fa-angle-down float-right"></i>
                </h4>
            </div>
            <div id="collapseRecommendation" class="collapse hide" data-parent="#accordion" >
                <div class="card-body">
                    <add_recommendation :data="recommendationData"></add_recommendation>
                </div>
            </div>
        </div>
    </div>
    <div id="accordion" >
        <div class="card card-primary" >
            <div class="card-header">
                <h4 class="card-title w-100 d-flex justify-content-between">
                    <a class="d-block w-100" data-toggle="collapse"  href="#collapseNumber">
                        დამატებითი ნომრები
                    </a>
                    <i class="fas fa-angle-down float-right"></i>
                </h4>
            </div>
            <div id="collapseNumber" class="collapse hide" data-parent="#accordion" >
                <div class="card-body">
                    <add_additional_number :data="additionalNumberData"></add_additional_number>
                </div>
            </div>
        </div>
    </div>
    <div id="accordion" >
        <div class="card card-primary" >
            <div class="card-header">
                <h4 class="card-title w-100 d-flex justify-content-between">
                    <a class="d-block w-100" data-toggle="collapse"  href="#collapseNoticeqa">
                        დოკუმენტები
                    </a>
                    <i class="fas fa-angle-down float-right"></i>
                </h4>
            </div>
            <div id="collapseNoticeqa" class="collapse hide" data-parent="#accordion" >
                <div class="card-body">
                    <add_notice :data="candidateNoticeData"></add_notice>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Add_user from '../component/add_user.vue';
import add_candidate_information from '../component/add_candidate_information.vue'
import add_candidate_language from '../component/add_candidate_language.vue'
import add_general_work_experience from '../component/add_general_work_experience.vue'
import add_family_work_experience from '../component/add_family_work_experience.vue'
import add_work_information from '../component/add_work_information.vue';
import add_recommendation from '../component/add_recommendation.vue'
import add_additional_number from '../component/add_additional_number.vue'
import add_notice from '../component/add_notice.vue'
export default {
    components:{
        Add_user,
        add_candidate_information,
        add_candidate_language,
        add_general_work_experience,
        add_family_work_experience,
        add_work_information,
        add_recommendation,
        add_additional_number,
        add_notice
    },
    props:{
        data: Object
    },
    emits: ['messageFromChild'],
    data() {
        return {
            candidateInfoSave:false,
            candidateLanguageSave:false,
            candidate_id:null

        }
    },

    computed:{
        addUserColspan(){
            return (this.data.model.candidate_information.user.id == '')?'show':'hide'
        },
        addCandidateColspan(){
            return (this.data.model.candidate_information.user.id != '')?'show':'hide'
        },
        // languageColspan(){
        //     return (this.candidateInfoSave)?'show':'hide'
        // },
        addUserData(){
            return {
                // 'user_id': this.data.basic.auth.id,
                'model': this.data.model.candidate_information.user,
                'cla': {
                    'gender': this.data.classificatory.gender,
                }
            }
        },
        candidateInformationData(){
            return {
                'user_id': this.data.model.candidate_information.user.id,
                'model': this.data.model.candidate_information.candidate,
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
                'user_id': this.data.model.candidate_information.user.id,
                'model': this.data.model.candidate_information.candidate.get_language,
                'cla': {
                    'languageLevels': this.data.classificatory.languageLevels,
                    'languages': this.data.classificatory.languages
                }
            }
        },
        generalWorkInformationData() {
            return{
                'user_id': this.data.model.candidate_information.user.id,
                'model': this.data.model.candidate_information.candidateWorkExperience,
                'cla':{
                    'yesNo': this.data.classificatory.yesNo,
                    'workExperiences': this.data.classificatory.workExperiences,
                    'noExperienceReason':this.data.classificatory.noExperienceReason
                }
            }
        },
        additionalNumberData() {
            return {
                'user_id': this.data.model.candidate_information.user.id,
                'model': this.data.model.candidate_information.candidateNumber,
                'cla':{
                    'numberCode': this.data.classificatory.numberCode,
                    'numberOwner': this.data.classificatory.numberOwner,
                }
            }
        },
        candidateNoticeData() {
            return {
                'user_id': this.data.model.candidate_information.user.id,
                'model': this.data.model.candidate_information.candidateNotices,
                'cla':{
                    'notices': this.data.classificatory.notices,
                }
            }
        },
        familyWorkExperienceData()  {
            return {
                'candidate_id': this.candidate_id,
                'model': this.data.model.work_information.familyWorkExperience,
                'cla': {
                    'category': this.data.classificatory.category,
                    'workExperiences': this.data.classificatory.workExperiences,
                    'noExperienceReason': this.data.classificatory.noExperienceReason,
                    'duty': this.data.classificatory.duty,
                    'yesNo': this.data.classificatory.yesNo,
                }
            }
        },
        workInformationData() {
            return {
                'candidate_id': this.candidate_id,
                'model': {'workInformation':this.data.model.work_information.workInformation, 'getWorkInformation': this.data.model.work_information.getWorkInformation},
                'cla': {
                    'category': this.data.classificatory.category,
                    'currency': this.data.classificatory.currency,
                    'workSchedule': this.data.classificatory.workSchedule,
                }
            }
        },
        recommendationData() {
            return {
                'candidate_id': this.candidate_id,
                'model': {'candidateRecommendation':this.data.model.work_information.candidateRecommendation, 'recommendation': this.data.model.work_information.recommendation,},
                'cla': {
                    'recommendationFromWhom': this.data.classificatory.recommendationFromWhom,
                    'noRecommendationReason': this.data.classificatory.noRecommendationReason,
                    'numberCode': this.data.classificatory.numberCode,
                    'yesNo': this.data.classificatory.yesNo,
                }
            }
        },

    },
    created() {
        // this.data.model.candidate_information.candidate.id = 4
    },
    methods: {
        // childMessageReceived(item){
        //     console.log('msg', item);
        //     this.candidate_id = item
        // }
        handleMessageFromChildren(item) {
        // Handle the emitted event
            this.candidate_id = item
        },
    },
}
</script>
<style lang="">

</style>
