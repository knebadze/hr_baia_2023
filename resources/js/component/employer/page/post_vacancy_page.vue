<template lang="">
    <div>
        <verify_number v-if="showVerifySection" :cla="cla.numberCode" @verifyEmit="handlerVerify"/>
        <post_vacancy v-if="showPostSection" :data="post_vacancy_data"/>

    </div>
</template>
<script>
import { ref, computed } from 'vue';
import _ from 'lodash';
import verify_number from '../components/verify_number.vue';
import post_vacancy from '../components/post_vacancy/post_vacancy.vue';
export default {
    components:{
        verify_number,
        post_vacancy
    },
    props:{
        data: Object,
    },
    setup(props) {
        console.log(props.data);
        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });
        const cla = ref(_.cloneDeep(props.data.classificatory));
        const showVerifySection = ref(true);
        const showPostSection = ref(false);
        const post_vacancy_data = ref({...props.data})

        // გამეორების დროს იგზავნება ობიექტი
        const url = new URL( location.href)
        const queryString = url.search;
        const urlParams = new URLSearchParams(queryString);
        const searchData = JSON.parse(decodeURIComponent(urlParams.get('data')));

        const makeData = () => {
            let obj ={};
            if (searchData) {
                showVerifySection.value = false
                showPostSection.value = true
                obj = {
                    employer: {...searchData.employer},
                    vacancy: {...searchData},
                    demand: {...searchData.demand},
                    characteristic: searchData.characteristic,
                    duty: searchData.vacancy_duty,
                    for_who_need: searchData.vacancy_for_who_need,
                    benefit: searchData.vacancy_benefit,
                    driving_license: searchData.vacancy_driving_license,

                    interviewDate:'',
                    interviewTime:'',
                }
                obj.vacancy.start_date = null
                obj.vacancy.go_vacation = obj.vacancy.go_vacation == 1?true:false
                obj.vacancy.stay_night = obj.vacancy.stay_night == 1?true:false
                obj.vacancy.work_additional_hours = obj.vacancy.work_additional_hours == 1?true:false
                obj.demand.has_experience = obj.demand.has_experience == 1?true:false
                obj.demand.has_recommendation = obj.demand.has_recommendation == 1?true:false
                obj.repeat_reason = null

            }else{
                obj = {
                    employer: {...props.data.model.employer},
                    vacancy: {...props.data.model.vacancy},
                    demand: {...props.data.model.demand, education: null, specialty: null, language: null, language_level:null},
                    characteristic:[],
                    duty: [],
                    for_who_need: [],
                    benefit: [],
                    interviewDate:'',
                    interviewTime:'',
                };
                obj.employer.number_code = cla.value.numberCode.find(element => element.phonecode == 995);
                obj.vacancy.payment = 0;
                obj.vacancy['go_vacation'] = 0;
                obj.vacancy['stay_night'] = 0;
                obj.vacancy['work_additional_hours'] = 0;
                obj.getLang = getLang;
                obj.number_code = cla.value.numberCode.find(element => element.phonecode == 995);
                obj.vacancy.category = null
                obj.repeat_reason = null
                obj.vacancy.interview_place = null
            }

            obj.lang = getLang
            obj.employer.name = obj.employer[`name_${getLang.value}`];
            obj.employer.address = obj.employer[`address_${getLang.value}`];
            obj.employer.street = obj.employer[`street_${getLang.value}`];
            obj.vacancy.additional_schedule = obj.vacancy[`additional_schedule_${getLang.value}`];
            obj.vacancy.title = obj.vacancy[`title_${getLang.value}`];
            obj.vacancy.currency = cla.value.currency.find(e => e.id == 1)
            return {...obj}
        };

        post_vacancy_data.value.model = makeData();

        const handlerVerify = (item) =>{
            console.log('child', item);
            showVerifySection.value = false
            showPostSection.value = item.active
            post_vacancy_data.value.model.employer = item.employer
            post_vacancy_data.value.classificatory.category = item.used_category? props.data.classificatory.category.filter(i => !item.used_category.includes(i.id)):props.data.classificatory.category
        }

        return {
            cla,
            handlerVerify,
            showVerifySection,
            showPostSection,
            post_vacancy_data
        }

    }
}
</script>
<style scoped>



</style>
