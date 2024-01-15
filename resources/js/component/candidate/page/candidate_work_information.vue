<template lang="">
    <div class="col-xl-9 col-lg-8 col-md-12 m-b30 employerPageBorder">
        <!--Filter Short By-->
        <div class="twm-right-section-panel site-bg-gray">
            <!--work information-->

            <work_information :data="workInformationData"></work_information>

            <!--ოჯახში მუშაობის გამოცდიელბა  -->

            <family_work_experience :data="familyWorkExperienceData"></family_work_experience>

            <!--რეკომენდაცია-->
            <candidate_recommendation v-if="m.familyWorkExperience.has_experience && m.familyWorkExperience.has_experience.id == 1" :data="recommendationData"></candidate_recommendation>

        </div>
    </div>
    <!-- <editWorkInformation :visible="showWorkInformation" :data="editWorkInformationData"></editWorkInformation> -->
    <!-- <editRecommendation :visible="showRecommendationEditModal" :data="editRecommendationData"></editRecommendation> -->
</template>
<script>
// import editWorkInformation from '../modal/editWorkInformation.vue'
// import editRecommendation from '../modal/editRecommendation.vue'
import work_information from '../component/work_information.vue'
import family_work_experience from '../component/family_work_experience.vue'
import candidate_recommendation from '../component/candidate_recommendation.vue'
import { uuid } from 'vue-uuid'
import _ from 'lodash'
import { useVuelidate } from '@vuelidate/core'
import { required, email, helpers, requiredIf, numeric, maxLength } from '@vuelidate/validators'
export default {
    setup () {
        return { v$: useVuelidate() }
    },
    components:{
        // editWorkInformation,
        // editRecommendation
        work_information,
        family_work_experience,
        candidate_recommendation
    },
    props:{
        data: Object
    },
    data() {
        return {
            uuid: uuid.v1(),
            m: null,
            workInformationData:{},
            familyWorkExperienceData:{},
            recommendationData:{},
        }
    },
    created(){
        this.data.model.workInformation['payment'] = 800;

        this.m = { ...this.data.model };
        this.workInformationData = {
            'candidate_id': this.data.candidate.id,
            'model': {'workInformation':this.data.model.workInformation, 'getWorkInformation': this.data.model.getWorkInformation},
            'cla': {
                'category': this.data.classificatory.category,
                'currency': this.data.classificatory.currency,
                'workSchedule': this.data.classificatory.workSchedule,
            }
        },
        this.familyWorkExperienceData = {
            'candidate_id': this.data.candidate.id,
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
            'candidate_id': this.data.candidate.id,
            'model': {'candidateRecommendation':this.data.model.candidateRecommendation, 'recommendation': this.data.model.recommendation,},
            'cla': {
                'recommendationFromWhom': this.data.classificatory.recommendationFromWhom,
                'noRecommendationReason': this.data.classificatory.noRecommendationReason,
                'numberCode': this.data.classificatory.numberCode,
                'yesNo': this.data.classificatory.yesNo,
            }
        }
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
    },
    methods:{
    },
    watch: {
    },

    mounted() {
    },

}
</script>

<style>


</style>
