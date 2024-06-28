<script setup>
import Paginate from "vuejs-paginate-next";
import vacancy_user_filter from "../components/list/vacancy_user_filter.vue";
import vacancy_list from "../components/list/VacancyList.vue";
import { I18n } from "laravel-vue-i18n";
import { computed, onMounted } from "vue";
import { useGuestVacancyStore } from "../../../store/guest/guestVacancyStore";
import { storeToRefs } from "pinia";

const props = defineProps({
    data: {
        type: Object,
        default: null,
    },
});
const guestVacancyStore = useGuestVacancyStore();
const { vacancies, pagination, count, auth } = storeToRefs(guestVacancyStore);
const { getData, setData } = guestVacancyStore;

const getLang = computed(() => {
    return I18n.getSharedInstance().options.lang;
});
onMounted(async () => {
    let url = new URL(location.href);
    const pathname = url.pathname;
    const parts = _.split(pathname, "/");
    const searchString = _.nth(parts, 2);

    if (searchString == "job_search") {
        // const number = _.last(_.split(_.last(parts), "["), "]");
        // // Remove the ']' character from the end of the number
        // const cleanedNumber = _.trimEnd(number, "]");

        setData(props.data);
    } else {
        await getData();
    }
});
</script>
<template>
    <div class="section-full p-t120 p-b90 site-bg-white">
        <div class="container">
            <div class="row">
                <vacancy_user_filter></vacancy_user_filter>
                <div class="col-lg-8 col-md-12">
                    <!--Filter Short By-->
                    <div
                        class="product-filter-wrap d-flex justify-content-between align-items-center m-b30"
                    >
                        <span class="woocommerce-result-count-left"
                            >{{
                                $t(
                                    "lang.individual_vacancies_page_middle_first_title"
                                )
                            }}
                            {{ count }}
                        </span>
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
                    <div class="twm-jobs-list-wrap">
                        <ul v-if="vacancies.length">
                            <vacancy_list
                                v-for="(item, index) in vacancies"
                                :key="index"
                                :item="item"
                                :auth="auth"
                            ></vacancy_list>
                        </ul>
                        <div v-else class="d-flex justify-content-center">
                            <p class="text-secondary">
                                აქტიური ვაკანსია ვერ მოიძებნა
                            </p>
                        </div>
                    </div>

                    <div class="pagination-outer" v-if="vacancies.length > 25">
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

<style lang=""></style>
