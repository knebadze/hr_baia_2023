<template lang="">
   <div >


        <div  class="twm-jobs-list-wrap">
            <ul>
                <li v-for="(item, index) in items" :key="index">
                    <div class="twm-jobs-list-style1 mb-5">
                        <!-- <div class="twm-media">
                            <img src="/images/jobs-company/pic1.jpg" alt="#">
                        </div> -->
                        <div class="twm-left-content col-md-8">
                            <!-- class="twm-mid-content" -->
                            <!-- <a href="job-detail.html" class="twm-job-title"> -->
                                <h4> {{ item[`title_${getLang}`] }}<span class="twm-job-post-duration" style="color: green;"> /{{ getTimeAgo(item.created_at) }}</span></h4>
                            <!-- </a> -->
                            <p class="twm-job-address">{{ item.author[`address_${getLang}`].split(/\s+/).slice(0, 2).join(" ") }}. <span v-for="(i, ind) in item.vacancy_for_who_need" :key="ind">{{  i[`name_${getLang}`]}}</span>.</p>

                            <p class="twm-job-address">გრაფიკი: {{ item.work_schedule[`name_${getLang}`]+', '+ item[`additional_schedule_${getLang}`] }}.</p>
                            <p class="twm-job-address text-danger" v-if="item.vacancy_benefit">დამატებით: <span v-for="i in item.vacancy_benefit">{{ i[`name_${getLang}`]+', ' }}</span>.</p>
                            <!-- <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a> -->
                        </div>
                        <div class="twm-right-content">
                            <div class="twm-jobs-category green"><span class="twm-bg-green">{{ item.category[`name_${getLang}`] }} </span></div>
                            <div class="twm-jobs-amount">{{ item.currency.icon }} {{ item.payment }}</div>
                            <div class="twm-jobs-amount">{{ item.hr.user.number }} <span>/ {{ item.hr.user[`name_${getLang}`] }}</span></div>
                            <span v-if="auth && item.vacancy_interest.some( (o) => o.candidate_id == auth.candidate.id ) " style="font-size:20px;">
                                <i :class="(item.vacancy_interest.some( (o) => o.candidate_id == auth.candidate.id && o.employer_answer == null))?'fa fa-plus-circle text-warning':(item.vacancy_interest.some( (o) => o.user_id == auth.id && o.employer_answer == 0))?'fa fa-times-circle text-danger':(item.vacancy_interest.some( (o) => o.user_id == auth.id && o.employer_answer == 1))?'fa fa-check-circle text-success':''"></i></span>
                            <!-- <button v-else type="button" class="btn btn-primary" @click="interest(item)">{{ $t('lang.individual_vacancies_page_middle_interest_button') }}</button> -->
                            <interest_button v-else :item="item" :auth="auth" @emitReceiveChild="handlerUpdateData"/> <br>
                            <span> <a class="job_detail_read_more btn btn-info fa fa-arrow-right" :href="detailUrl+'/'+item.id+'/'+item.slug" style="  margin-top: 5%; color: #fff;"></a> </span>
                        </div>
                    </div>
                </li>

            </ul>

        </div>



    </div>
</template>
<script>
import { ref, computed } from 'vue';
import interest_button from '../interest_button.vue';
import moment from 'moment';
import 'moment/locale/ru';
export default {
    components:{
        interest_button
    },
    props:{
        items: Object,
        auth: Object
    },
    setup(props) {
        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });

        moment.locale('ru');
        let url = new URL( location.href);
        const detailUrl = ref(url.origin+'/'+getLang.value+'/job_detail');
        // const checkInterest = ref(false);



        const getTimeAgo = (created_at) => {
            const time = moment(created_at);
            const now = moment();
            const diff = now.diff(time);

            if (diff < 60000) { // less than 1 minute
                return 'now';
            } else if (diff < 3600000) { // less than 1 hour
                const minutes = moment.duration(diff).asMinutes();
                return `${Math.round(minutes)} წუთის წინ`;
            } else if (diff < 86400000) { // less than 24 hours
                const hours = moment.duration(diff).asHours();
                return `${Math.round(hours)} საათის წინ`;
            } else if (diff < 172800000) { // less than 48 hours
                return 'გუშინ';
            } else if (diff < 604800000) { // less than 7 days (1 week)
                const days = moment.duration(diff).asDays();
                return `${Math.round(days)} დღiს წინ`;
            } else {
                return time.format('D MMMM');
            }
        };
        // const created_at = ref('2023-01-01T12:34:56.789Z');
        // const timeAgo = computed(() => getTimeAgo(created_at.value));

        const handlerUpdateData = (id, response) =>{
            let find = props.items.find(element => element.id == id);
            find.vacancy_interest.push(response.data.qualifying)
        }
        return {
            getLang,
            detailUrl,
            handlerUpdateData,
            getTimeAgo
            // interest
        }
    }
}
</script>
<style lang="">

</style>
