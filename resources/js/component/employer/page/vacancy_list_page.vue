<template lang="">
    <div class="section-full p-t120  p-b90 site-bg-white">


        <div class="container">
            <div class="row">
                <vacancy_user_filter :cla="data.classificatory" @emitFilterData="handleFilterData"></vacancy_user_filter>
                <div class="col-lg-8 col-md-12">
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

                    <vacancy_list :items="vacancy" :auth="auth"></vacancy_list>

                    <div class="pagination-outer">
                        <div class="pagination-style1">
                            <paginate
                                v-model="pagination.current_page"
                                :page-count="pagination.last_page"
                                :page-range="3"
                                :margin-pages="2"
                                :click-handler="getData"
                                :prev-text="'<<'"
                                :next-text="'>>'"
                                :container-class="'pagination'"
                                :page-class="'page-item'"
                                >
                            </paginate>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
<script>

import Paginate from 'vuejs-paginate-next';
import axios from 'axios';
import _ from 'lodash'
import { ref, computed } from 'vue';

import vacancy_user_filter from '../components/list/vacancy_user_filter.vue';
import vacancy_list from '../components/list/vacancy_list.vue';
export default {
    components:{
        vacancy_user_filter,
        Paginate,
        vacancy_list
    },
    props:{
        data:Object
    },
    setup(props) {
        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });
        let getDataType = 'first_data'
        const pagination = ref({});
        const vacancy = ref(null)
        const staticVacancy = ref(null)
        const auth = ref(null)

        const count = computed(() => {
            return vacancy.value.length;
        });


        const firstData = () =>{

            pagination.value = {
                'current_page': props.data.vacancy.current_page,
                'last_page': props.data.vacancy.last_page
            };
            vacancy.value = props.data.vacancy.data;
            staticVacancy.value = props.data.vacancy.data;
            auth.value = props.data.auth;
        };

        const handleFilterData = (item) =>{
            getDataType = item ? 'filter':'first_data'
            getData(item)
        };

        const filter = (newVal) =>{
            axios({
                    method: "post",
                    url: '/vacancy_filter?page=' + pagination.value.current_page,
                    data: newVal,

                })
                .then(function (response) {
                    pagination.value = {
                            current_page: response.data.vacancy.current_page,
                            last_page: response.data.vacancy.last_page
                        }
                        vacancy.value = response.data.vacancy.data

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
        };

        const getData = (item = null) =>{
            if (getDataType == 'first_data') {
                firstData()
            } else if (getDataType == 'filter') {
                filter(item)
            }
        };

        getData()

        return{
            getLang,
            pagination,
            vacancy,
            staticVacancy,
            auth,
            count,
            handleFilterData,
            getData
        }
    }
}
</script>
<style lang="">

</style>
