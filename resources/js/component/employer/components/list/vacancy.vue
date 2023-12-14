<template lang="">
   <div >
        <!--Filter Short By-->
        <div class="product-filter-wrap d-flex justify-content-between align-items-center m-b30">
            <span class="woocommerce-result-count-left">{{ $t('lang.individual_vacancies_page_middle_first_title') }} {{ count }} </span>
            <!-- <button class="btn btn-primary">ჩემი დაინტერესებული</button> -->
            <!-- <form class="woocommerce-ordering twm-filter-select" method="get">
                <span class="woocommerce-result-count">{{ $t('lang.individual_vacancies_page_middle_title_sort') }}</span>
                <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="size">
                    <option>{{ $t('lang.individual_vacancies_page_middle_latest') }}</option>
                    <option>{{ $t('lang.individual_vacancies_page_middle_free_schedule') }}</option>
                    <option>{{ $t('lang.individual_vacancies_page_middle_full_time') }}</option>
                    <option>{{ $t('lang.individual_vacancies_page_middle_intership') }}</option>
                    <option>{{ $t('lang.individual_vacancies_page_middle_half_time') }}</option>
                    <option>{{ $t('lang.individual_vacancies_page_middle_temporary') }}</option>
                </select>
                <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="size">
                    <option>{{ $t('lang.individual_vacancies_page_middle_show_me_10') }}</option>
                    <option>{{ $t('lang.individual_vacancies_page_middle_show_me_20') }}</option>
                    <option>{{ $t('lang.individual_vacancies_page_middle_show_me_30') }}</option>
                    <option>{{ $t('lang.individual_vacancies_page_middle_show_me_40') }}</option>
                    <option>{{ $t('lang.individual_vacancies_page_middle_show_me_50') }}</option>
                    <option>{{ $t('lang.individual_vacancies_page_middle_show_me_60') }}</option>
                </select>
            </form> -->

        </div>

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
                                <h4> {{ item[`title_${getLang}`] }}<span class="twm-job-post-duration" style="color: green;"> /{{ item.timeAgo }}</span></h4>
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
                            <button v-else type="button" class="btn btn-primary" @click="interest(item)">{{ $t('lang.individual_vacancies_page_middle_interest_button') }}</button><br>
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
import Swal from 'sweetalert2';
export default {
    props:{
        items: Object,
        auth: Object
    },
    setup(props) {
        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });

        const count = computed(() => {
            return props.items.length;
        });

        let url = new URL( location.href);
        const detailUrl = ref(url.origin+'/'+getLang.value+'/job_detail');
        const checkInterest = ref(false);

        const interest = (item) =>{
            if (props.auth != null ) {
                if (props.auth.role_id != 3) {
                    toast.error("თქვენ არ გაქვთ დაინტერესების უფლება", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    return
                }else if(props.auth.role_id == 3  ){
                    if (props.auth.candidate.status_id == 8) {
                        toast.error("თქვენ ჯერ არ გაქვთ დაინტერესების უფლება, გთხოვთ შეავსოთ ინფორმაცია", {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        return
                    } else if(props.auth.candidate.status_id == 10) {
                        toast.error("არ გაქვთ დაინტერესების უფლება, თქვენ უკვე დასაქმებული ხართ", {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        return
                    }

                }else if(props.auth.role_id == 3){

                }
                sendInterestAxios(item)

            }else{
                Swal.fire(
                    {
                        title: '<p>დაინტერესებამდე სავალდებულოა გაიაროთ ავტორიზაცია!!!</p>',
                        icon: 'info',
                        html:
                            'თუ ჯერ არ ხართ რეგისტრირებული გთხოვთ დარეგისტრირდეთ',
                        showCloseButton: true,
                        showCancelButton: false,
                        showDenyButton: true,
                        focusConfirm: false,
                        confirmButtonText: 'რეგისტრაცია',
                        denyButtonText: 'შესვლა',
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.location.replace(`/register?${getLang.value}`)
                    }else if (result.isDenied) {
                        window.location.replace(`/login?${getLang.value}`)
                    }
                })
            }
        };

        const sendInterestAxios = (item) =>{
            console.log(item);
            axios({
                method: "post",
                url: '/interest_vacancy',
                data: {'id': item.id, 'check': checkInterest.value},

            })
            .then(function (response) {
                if (response.data.status == 200) {
                    let text;
                    if(response.data.data.type == 'w'){
                        Swal.fire({
                            title: '<p>თქვენი სამუშაო კატეგორია არ შეესაბამება ვაკანსიის კატეგორიას!!!</p>',
                            icon: 'info',
                            html:
                                'აუცილებელია დაამატოთ შესაფერისი სამუშაო კატეგორია',
                            showCloseButton: true,
                            showCancelButton: true,
                            showDenyButton: false,
                            focusConfirm: false,
                            confirmButtonText: 'კატეგორიის დამატება',
                            cancelButtonText:'გაუქმება'
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                // !!!!!!!!!!!!!!!!!!!!!!!!!!!აქ შეიძლება ჩაშენდეს ავტომატური დამატების სერვისი!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                                window.location.replace(`/${getLang.value}/user/userProfile?stage=6`)
                            }
                        })
                    }else if(response.data.data.type == 's'){
                        Swal.fire({
                            title: '<strong>თქვენი დაინტერესება მიღებულია</strong>',
                            icon: 'success',
                            html:'შემკვეთს გადაეგზავნება თქვენი ფოტოანკეტა, მოხდება მასთან თქვენი კანდიდატურის განხილვა და მისი მხრიდანაც დაინტერესების შემთხვევაში გაგასაუბრებთ შემკვეთს',

                            showCloseButton: true,
                            // confirmButtonText: 'მთავარზე დაბრუნება',
                            showCancelButton: false,
                            focusConfirm: false,
                        }).then((result) => {
                            // if (result.isConfirmed) {
                            //     let url = new URL( location.href)
                            //     if (props.data.model.role_id == 3) {
                            //         window.location.replace(`${url.origin}/ka`);
                            //     }else{
                            //         window.location.replace( `${url.origin}/admin/vacancy?ka`);
                            //     }

                            // }

                        })
                        var find = props.items.find(element => element.id == item.id);
                        find.vacancy_interest.push(response.data.data.qualifying)
                    }
                }

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        };
        return {
            getLang,
            count,
            detailUrl,
            interest
        }
    }
}
</script>
<style lang="">

</style>
