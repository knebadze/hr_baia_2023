<script setup>
import { ref, computed, defineComponent, watch } from "vue";
import { useGuestVacancyStore } from "../../../../store/guest/guestVacancyStore";
import { storeToRefs } from "pinia";
import { I18n } from "laravel-vue-i18n";

const guestVacancyStore = useGuestVacancyStore();
const { cla, filterItem } = storeToRefs(guestVacancyStore);
const createdAtItems = ref([
    { id: 0, name: "lang.individual_vacancies_page_leftside_any" },
    { id: 1, name: "lang.individual_vacancies_page_leftside_last_3" },
    { id: 2, name: "lang.individual_vacancies_page_leftside_last_7" },
    { id: 3, name: "lang.individual_vacancies_page_leftside_last_24" },
]);
const paymentItems = ref([
    { id: 0, name: "lang.individual_vacancies_page_leftside_sallary_any" },
    { id: 1, name: "lang.individual_vacancies_page_leftside_sallary_from_500" },
    { id: 2, name: "lang.individual_vacancies_page_leftside_sallary_from_700" },
    { id: 3, name: "lang.individual_vacancies_page_leftside_sallary_from_900" },
    { id: 4, name: "lang.individual_vacancies_page_leftside_sallary_other" },
]);
const locationItems = ref([
    { id: 0, name: "lang.individual_vacancies_page_leftside_second_location_any" },
    { id: 1, name: "lang.individual_vacancies_page_leftside_second_location_3km" },
    { id: 2, name: "lang.individual_vacancies_page_leftside_second_location_5km" },
    { id: 3, name: "lang.individual_vacancies_page_leftside_second_location_7km" },
]);
const getLang = computed(() => {
    return I18n.getSharedInstance().options.lang;
});
</script>
<template lang="">
    <div class="col-lg-4 col-md-12 rightSidebar">
        <div class="side-bar">
            <div class="sidebar-elements search-bx">
                <form>
                    <div class="form-group mb-4 categorySideBar">
                        <h4 class="section-head-small mb-4">
                            {{
                                $t(
                                    "lang.individual_vacancies_page_leftside_category"
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
                            <template
                                slot="selection"
                                slot-scope="{ values, search, isOpen }"
                                ><span
                                    class="multiselect__single"
                                    v-if="values.length"
                                    v-show="!isOpen"
                                    >{{ values.length }} options selected</span
                                ></template
                            >
                        </multiselect>
                    </div>
                    <div class="form-group mb-4 categorySideBar">
                        <h4 class="section-head-small mb-4">
                            {{
                                $t(
                                    "lang.individual_vacancies_page_leftside_shedulde"
                                )
                            }}
                        </h4>
                        <multiselect
                            v-if="cla.workSchedule"
                            v-model="filterItem.schedule"
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
                            <template
                                slot="selection"
                                slot-scope="{ values, search, isOpen }"
                                ><span
                                    class="multiselect__single"
                                    v-if="values.length"
                                    v-show="!isOpen"
                                    >{{ values.length }} options selected</span
                                ></template
                            >
                        </multiselect>
                    </div>

                    <!-- <div class="form-group mb-4 keywordSideBar">
                        <h4 class="section-head-small mb-4">{{ $t('lang.individual_vacancies_page_leftside_keyword') }}</h4>
                        <div class="input-group">
                            <input type="text" class="form-control" v-model="filterItem.word" :placeholder="$t('lang.individual_vacancies_page_leftside_name_or_keyword')">
                            <button class="btn" type="button"><i class="feather-search"></i></button>
                        </div>
                    </div> -->

                    <div class="form-group mb-4 locationSideBar">
                        <h4 class="section-head-small mb-4">
                            {{
                                $t(
                                    "lang.individual_vacancies_page_leftside_location"
                                )
                            }}
                        </h4>
                        <div class="input-group">
                            <input
                                type="text"
                                class="form-control"
                                v-model="filterItem.location"
                                :placeholder="
                                    $t(
                                        'lang.individual_vacancies_page_leftside_search_location'
                                    )
                                "
                            />
                            <button class="btn" type="button">
                                <i class="feather-map-pin"></i>
                            </button>
                        </div>
                    </div>

                    <div class="twm-sidebar-ele-filter publicationSideBar">
                        <h4 class="section-head-small mb-4">
                            {{
                                $t(
                                    "lang.individual_vacancies_page_leftside_date_of_publication"
                                )
                            }}
                        </h4>
                        <ul>
                            <li
                                v-for="(item, index) in createdAtItems"
                                :key="index"
                            >
                                <div class="form-check">
                                    <input
                                        type="radio"
                                        v-model="filterItem.time"
                                        :value="item.id"
                                        class="form-check-input"
                                        :id="`createdAt_radio_${ item.id }`"
                                    />
                                    <label
                                        class="form-check-label"
                                        :for="`createdAt_radio_${ item.id }`"
                                        >{{ $t(item.name) }}</label
                                    >
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="twm-sidebar-ele-filter sallarySideBar">
                        <h4 class="section-head-small mb-4">
                            {{
                                $t(
                                    "lang.individual_vacancies_page_leftside_sallary"
                                )
                            }}
                        </h4>
                        <ul>
                            <li
                                v-for="(item, index) in paymentItems"
                                :key="index"
                            >
                                <div class="form-check">
                                    <input
                                        type="radio"
                                        :value="item.id"
                                        v-model="filterItem.payment"
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

                    <!-- გამოჩნდება რუკის ინტეგრაციის მერე -->
                    <!-- <div class="twm-sidebar-ele-filter sallarySideBar">
                        <h4 class="section-head-small mb-4">
                            {{
                                $t(
                                    "lang.individual_vacancies_page_leftside_second_location"
                                )
                            }}
                        </h4>
                        <ul>
                            <li v-for="(item, index) in locationItems" :key="index">
                                <div class="form-check">
                                    <input
                                        type="checkbox"
                                        class="form-check-input"
                                        :id="`location_${item.id}`"
                                        :value="item.id"
                                    />
                                    <label
                                        class="form-check-label"
                                        :for="`location_${item.id}`"
                                        >{{
                                            $t(
                                               item.name
                                            )
                                        }}</label
                                    >
                                </div>
                            </li>

                        </ul>
                    </div> -->
                </form>

                <div
                    class="twm-advertisment"
                    style="background-image: url(/images/add-bg.jpg)"
                >
                    <div class="overlay"></div>
                    <p>{{ $t("lang.candidate_page_leftside_box_title") }}</p>
                    <a href="about-1.html" class="site-button white">{{
                        $t("lang.candidate_page_leftside_box_read_more")
                    }}</a>
                </div>
            </div>

            <!-- <div class="widget tw-sidebar-tags-wrap">
                <h4 class="section-head-small mb-4">{{ $t('lang.individual_vacancies_page_leftside_tags') }}</h4>

                <div class="tagcloud">
                    <a href="job-list.html">ვაკანსია </a>
                    <a href="job-list.html">გადახდა</a>
                    <a href="job-list.html">განაცხადი </a>
                    <a href="job-list.html">სამუშაო</a>
                    <a href="job-list.html">დაქირავება</a>
                    <a href="job-list.html">დამსაქმებელი</a>
                    <a href="job-list.html">შემოსავალი</a>
                    <a href="job-list.html">რჩევები</a>
            =======
            </div> -->
        </div>
    </div>
</template>

<style lang=""></style>
