<template lang="">
    <li v-for="(item, index) in items" :key="index">
        <div class="twm-jobs-list-style1 mb-5">
            <!-- <div class="twm-media">
                <img src="/images/jobs-company/pic1.jpg" alt="#">
            </div> -->
            <div class="twm-left-content col-md-8">
                <!-- class="twm-mid-content" -->
                <!-- <a href="job-detail.html" class="twm-job-title"> -->
                    <h4> {{ item[`title_${getLang}`] }}<span class="twm-job-post-duration" style="color: green;"> /{{ item.timeAgo }}</span></h4>
                <!-- </a> -->
                <p class="twm-job-address">{{ item.author[`address_${getLang}`].split(/\s+/).slice(0, 2).join(" ") }}. <span v-for="(i, ind) in item.vacancy_for_who_need" :key="ind">{{  i[`name_${getLang}`]}}</span>.</p>

                <p class="twm-job-address">გრაფიკი: {{ item.work_schedule[`name_${getLang}`]+', '+ item[`additional_schedule_${getLang}`] }}.</p>
                <p class="twm-job-address text-danger" v-if="item.vacancy_benefit">დამატებით: <span v-for="i in item.vacancy_benefit">{{ i[`name_${getLang}`]+', ' }}</span>.</p>
                <!-- <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a> -->
            </div>
            <div class="twm-right-content">
                <div class="twm-jobs-category green"><span class="twm-bg-green">{{ item.category[`name_${getLang}`] }}</span></div>
                <div class="twm-jobs-amount">{{ item.currency.icon }} {{ item.payment }}</div>
                <div class="twm-jobs-amount">{{ item.hr.user.number }} <span>/ {{ item.hr.user[`name_${getLang}`] }}</span></div>
                <span v-if="auth && item.vacancy_interest.some( (o) => o.candidate_id == auth.candidate.id ) " style="font-size:20px;">
                    <i :class="(item.vacancy_interest.some( (o) => o.candidate_id == auth.candidate.id && o.employer_answer == null))?'fa fa-plus-circle text-warning':(item.vacancy_interest.some( (o) => o.user_id == auth.id && o.employer_answer == 0))?'fa fa-times-circle text-danger':(item.vacancy_interest.some( (o) => o.user_id == auth.id && o.employer_answer == 1))?'fa fa-check-circle text-success':''"></i></span>
                <button v-else type="button" class="btn btn-primary" @click="interest(item)">{{ $t('lang.individual_vacancies_page_middle_interest_button') }}</button><br>
                <span> <a class="job_detail_read_more btn btn-info fa fa-arrow-right" :href="detailUrl+'/'+item.id+'/'+item.slug" style="  margin-top: 5%; color: #fff;"></a> </span>
            </div>
        </div>
    </li>
</template>
<script>
export default {
    props:{
        items: Object,
        auth: Object
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
        detailUrl(){
            var url = new URL( location.href)
            return url.origin+'/'+this.getLang+'/job_detail'
        },
    },
    created(){
    }
}
</script>
<style lang="">

</style>
