<script setup> 
import vacancy_list from "../components/list/VacancyList.vue";
import { I18n } from "laravel-vue-i18n";
import { computed, onMounted, ref } from "vue";

const props = defineProps({
    data: Object
});

const getLang = computed(() => {
    return I18n.getSharedInstance().options.lang;
});
const vacancies = ref([]);
const auth = ref(null)
console.log(props.data)

onMounted(() =>{
    vacancies.value = props.data.vacancies
    auth.value = props.data.auth
})
</script>

<template>
<div class="section-full p-t120 p-b90 site-bg-white">
        <div class="container">
            <div class="row">
                <!-- <vacancy_user_filter></vacancy_user_filter> -->
                <div class="col-lg-12 col-md-12">
                    <!--Filter Short By-->
                    <div
                        class="product-filter-wrap d-flex justify-content-between align-items-center m-b30"
                    >
                        <!-- <span class="woocommerce-result-count-left"
                            >{{
                                $t(
                                    "lang.individual_vacancies_page_middle_first_title"
                                )
                            }}
                            {{ count }}
                        </span> -->
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
<!-- 
                    <div class="pagination-outer" >
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
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</template>