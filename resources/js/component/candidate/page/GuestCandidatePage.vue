<script setup>
import candidate_list from "../candidate_list.vue";
import Paginate from "vuejs-paginate-next";
import { ref, onMounted, watch, computed } from "vue";
import { useGuestCandidateStore } from "../../../store/guest/guestCandidateStore";
import { storeToRefs } from "pinia";
import { I18n } from "laravel-vue-i18n";
import Loading from 'vue3-loading-overlay'
const props = defineProps({
    data: {
        type: Object,
        default: null,
    },
});
const guestCandidateStore = useGuestCandidateStore();
const { candidates, pagination, cla, count, loadingActive } = storeToRefs(guestCandidateStore);
const { fetchCandidates, filterCandidates, setCla } = guestCandidateStore;
const filterItem = ref({
    category: null,
    work_schedule: null,
    user_filter_payment: null,
    name: null,
    address: null,
});
const paymentItems = ref([
    { id: 0, name: "lang.individual_vacancies_page_leftside_sallary_any" },
    { id: 1, name: "lang.individual_vacancies_page_leftside_sallary_from_500" },
    { id: 2, name: "lang.individual_vacancies_page_leftside_sallary_from_700" },
    { id: 3, name: "lang.individual_vacancies_page_leftside_sallary_from_900" },
    { id: 4, name: "lang.individual_vacancies_page_leftside_sallary_other" },
]);
const getDataType = ref("first_data");
const getData = async (page = 1) => {
    if (getDataType.value == "first_data") {
        await fetchCandidates(page);
    } else if (getDataType.value == "filter") {
        filterCandidates(page, filterItem.value);
    }
};
const getLang = computed(() => {
    return I18n.getSharedInstance().options.lang;
});

watch(
    filterItem,
    (newValue, oldValue) => {
        getDataType.value = "filter";
        filterCandidates(1, newValue);
    },
    { deep: true }
);

onMounted(async () => {
    let url = new URL(location.href);
    const pathname = url.pathname;
    const parts = _.split(pathname, "/");
    const searchString = _.nth(parts, 2);
    if (searchString == "candidate_search") {
        const number = _.last(_.split(_.last(parts), "["), "]");
        // Remove the ']' character from the end of the number
        const cleanedNumber = _.trimEnd(number, "]");
        const { classificatory } = props.data;
        filterItem.value.category = [_.find(classificatory.category, (o) => o.id == Number(cleanedNumber))]
        setCla(classificatory);

    } else {
        await getData();
    }
});
</script>
<template>
    <div class="section-full p-t120 p-b90 site-bg-white">
        <loading
            :active="loadingActive"
            :can-cancel="true"
            loader="dots"
            color="#01ecd5"
            :is-full-page="true"
        />
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 rightSidebar">
                    <div class="side-bar">
                        <div class="sidebar-elements search-bx">
                            <form>
                                <div class="form-group mb-4 categorySideBar">
                                    <h4 class="section-head-small mb-4">
                                        {{
                                            $t(
                                                "lang.candidate_page_leftside_category"
                                            )
                                        }}
                                    </h4>
                                    <multiselect
                                        v-if="cla.category"
                                        v-model="filterItem.category"
                                        :options="cla.category"
                                        :multiple="true"
                                        :close-on-select="false"
                                        :clear-on-select="false"
                                        :preserve-search="true"
                                        placeholder="Pick some"
                                        :label="`name_${getLang}`"
                                        :track-by="`name_${getLang}`"
                                        :preselect-first="false"
                                    >
                                    </multiselect>
                                </div>
                                <div class="form-group mb-4 sheduldeSideBar">
                                    <h4 class="section-head-small mb-4">
                                        {{
                                            $t(
                                                "lang.candidate_page_leftside_shedulde"
                                            )
                                        }}
                                    </h4>
                                    <multiselect
                                        v-if="cla.workSchedule"
                                        v-model="filterItem.work_schedule"
                                        :options="cla.workSchedule"
                                        :multiple="true"
                                        :close-on-select="false"
                                        :clear-on-select="false"
                                        :preserve-search="true"
                                        placeholder="Pick some"
                                        :label="`name_${getLang}`"
                                        :track-by="`name_${getLang}`"
                                        :preselect-first="false"
                                    >
                                    </multiselect>
                                </div>

                                <!-- <div class="form-group mb-4 keywordSideBar">
                                    <h4 class="section-head-small mb-4">
                                        {{ $t("სახელი გვარი") }}
                                    </h4>
                                    <div class="input-group">
                                        <input
                                            type="text"
                                            v-model="filterItem.name"
                                            class="form-control"
                                            :placeholder="$t('სახელი გვარი')"
                                        />
                                        <button class="btn" type="button">
                                            <i class="feather-search"></i>
                                        </button>
                                    </div>
                                </div> -->

                                <div class="form-group mb-4 locationSideBar">
                                    <h4 class="section-head-small mb-4">
                                        {{
                                            $t(
                                                "lang.candidate_page_leftside_location"
                                            )
                                        }}
                                    </h4>
                                    <div class="input-group">
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="filterItem.address"
                                            :placeholder="
                                                $t(
                                                    'lang.candidate_page_leftside_search_location'
                                                )
                                            "
                                        />
                                        <button class="btn" type="button">
                                            <i class="feather-map-pin"></i>
                                        </button>
                                    </div>
                                </div>

                                <div
                                    class="twm-sidebar-ele-filter sallarySideBar"
                                >
                                    <h4 class="section-head-small mb-4">
                                        {{
                                            $t(
                                                "lang.candidate_page_leftside_sallary"
                                            )
                                        }}
                                    </h4>
                                    <ul>
                                        <li
                                            v-for="(
                                                item, index
                                            ) in paymentItems"
                                            :key="index"
                                        >
                                            <div class="form-check">
                                                <input
                                                    type="radio"
                                                    :value="item.id"
                                                    v-model="
                                                        filterItem.user_filter_payment
                                                    "
                                                    class="form-check-input"
                                                    :id="`payment_radio_${item.id}`"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    :for="`payment_radio_${item.id}`"
                                                    >{{ $t(item.name) }}</label
                                                >
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- <div
                        class="twm-advertisment"
                        style="background-image: url(/images/add-bg.jpg)"
                    >
                        <div class="overlay"></div>
                        <p>
                            {{ $t("lang.candidate_page_leftside_box_title") }}
                        </p>
                        <a href="about-1.html" class="site-button white">{{
                            $t("lang.candidate_page_leftside_box_read_more")
                        }}</a>
                    </div> -->
                </div>

                <div class="col-lg-8 col-md-12">
                    <!--Filter Short By-->
                    <div
                        class="product-filter-wrap d-flex justify-content-between align-items-center m-b30"
                    >
                        <span class="woocommerce-result-count-left">{{
                            "ნაჩვენებია " + count + " კანდიდატი"
                        }}</span>

                        <form
                            class="woocommerce-ordering twm-filter-select"
                            method="get"
                        >
                            <!-- <span class="woocommerce-result-count">{{ $t('lang.candidate_page_middle_title_sort') }}</span>
                        <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="size">
                            <option>{{ $t('lang.candidate_page_middle_latest') }}</option>
                            <option>{{ $t('lang.candidate_page_middle_free_schedule') }}</option>
                            <option>{{ $t('lang.candidate_page_middle_full_time') }}</option>
                            <option>{{ $t('lang.candidate_page_middle_intership') }}</option>
                            <option>{{ $t('lang.candidate_page_middle_half_time') }}</option>
                            <option>{{ $t('lang.candidate_page_middle_temporary') }}</option>
                        </select> -->

                            <!-- აქ ენები წააშალე სელეცტი კომენტარში დატოვე -->

                            <!-- <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="size">
                            <option>{{ $t('lang.candidate_page_middle_show_me_10') }}</option>
                            <option>{{ $t('lang.candidate_page_middle_show_me_20') }}</option>
                            <option>{{ $t('lang.candidate_page_middle_show_me_30') }}</option>
                            <option>{{ $t('lang.candidate_page_middle_show_me_40') }}</option>
                            <option>{{ $t('lang.candidate_page_middle_show_me_50') }}</option>
                            <option>{{ $t('lang.candidate_page_middle_show_me_60') }}</option>
                        </select> -->
                        </form>
                        <!-- <p style="color: red;"> ამის lang რო წაშლი ჩამიკოპირე</p> -->
                    </div>

                    <div class="twm-candidates-grid-wrap">
                        <div class="row">
                            <candidate-list
                                v-for="(item, index) in candidates"
                                :key="index"
                                :item="item"
                            ></candidate-list>
                        </div>
                    </div>

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
