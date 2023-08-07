<template lang="">
    <div class="col-xl-9 col-lg-8 col-md-12 m-b30 employerPageBorder">
        <!--Filter Short By-->
        <div class="twm-right-section-panel site-bg-gray">
            <!-- <form> -->


            <main_info :data="data.basic.user" :genderCLA="data.classificatory.gender"></main_info>


            <!--personal information-->
            <candidate_information :data="candidateInformationData"></candidate_information>

            <!--უცხო ენები-->
            <candidate_language :data="candidateLanguageData"></candidate_language>

            <!--ზოგადი სამუშაო გამოცდილება-->
            <general_work_Information :data="generalWorkInformationData"></general_work_Information>

            <!--დამატებითი ნომრები-->

            <additional_number :data="additionalNumberData"></additional_number>

            <!--ცნობები-->
            <candidate_notice :data="candidateNoticeData"></candidate_notice>
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
import { I18n } from 'laravel-vue-i18n'
import _ from 'lodash'
// import addressMap from '../map/address_map.vue'
// import addressGoogleMap from '../map/address_google_map.vue'
// import address_maplibre from '../map/address_maplibre.vue'
import { uuid } from 'vue-uuid'

export default {
    components:{
        main_info,
        candidate_information,
        candidate_language,
        general_work_Information,
        additional_number,
        candidate_notice
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

            candidateInformationData:{},
            candidateLanguageData:{},
            generalWorkInformationData:{},
            additionalNumberData:{},
            candidateNoticeData:{}

        }
    },
    created(){
        console.log('data', this.data);

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

    },
    methods:{

        showFile(name){
            var pdf = `../../../public/user-documentation/${name}`;
            window.open(pdf);
        },

    },
    watch:{
    },

    mounted(){

    }
}
</script>
<style lang="">
</style>
