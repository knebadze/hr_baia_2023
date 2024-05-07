<template lang="">
    <div class="col-lg-4 col-md-12 rightSidebar">

        <div class="side-bar">

            <div class="sidebar-elements search-bx">

                <form>

                    <div class="form-group mb-4 categorySideBar">
                        <h4 class="section-head-small mb-4">{{ $t('lang.individual_vacancies_page_leftside_category') }}</h4>
                        <multiselect v-model="filterItem.category" :options="cla.category" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" :label="`name_${getLang}`" :track-by="`name_${getLang}`" :preselect-first="false">
                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                        </multiselect>
                    </div>
                    <div class="form-group mb-4 categorySideBar">
                        <h4 class="section-head-small mb-4">{{ $t('lang.individual_vacancies_page_leftside_shedulde') }}</h4>
                        <multiselect v-model="filterItem.schedule" :options="cla.workSchedule" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" :label="`name_${getLang}`" :track-by="`name_${getLang}`" :preselect-first="false">
                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
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
                        <h4 class="section-head-small mb-4">{{ $t('lang.individual_vacancies_page_leftside_location') }}</h4>
                        <div class="input-group">
                            <input type="text" class="form-control" v-model="filterItem.location" :placeholder="$t('lang.individual_vacancies_page_leftside_search_location')">
                            <button class="btn" type="button"><i class="feather-map-pin"></i></button>
                        </div>
                    </div>


                    <div class="twm-sidebar-ele-filter publicationSideBar">
                        <h4 class="section-head-small mb-4">{{ $t('lang.individual_vacancies_page_leftside_date_of_publication') }}</h4>
                        <ul>

                            <li>
                                <div class="form-check">
                                    <input type="radio" v-model="filterItem.time" value="0" class="form-check-input" id="examplecheckbox6">
                                    <label class="form-check-label" for="examplecheckbox6">{{ $t('lang.individual_vacancies_page_leftside_any') }}</label>
                                </div>
                            </li>

                            <li>
                                <div class="form-check">
                                    <input type="radio" v-model="filterItem.time" value="1" class="form-check-input" id="examplecheckbox2">
                                    <label class="form-check-label" for="examplecheckbox2">{{ $t('lang.individual_vacancies_page_leftside_last_3') }}</label>
                                </div>
                            </li>

                            <li>
                                <div class="form-check">
                                    <input type="radio" v-model="filterItem.time" value="2" class="form-check-input" id="examplecheckbox3">
                                    <label class="form-check-label" for="examplecheckbox3">{{ $t('lang.individual_vacancies_page_leftside_last_7') }}</label>
                                </div>
                            </li>

                            <li>
                                <div class="form-check">
                                    <input type="radio" v-model="filterItem.time" value="3" class="form-check-input" id="examplecheckbox1">
                                    <label class="form-check-label" for="examplecheckbox1">{{ $t('lang.individual_vacancies_page_leftside_last_24') }}</label>
                                </div>
                            </li>

                        </ul>
                    </div>

                    <div class="twm-sidebar-ele-filter sallarySideBar">
                        <h4 class="section-head-small mb-4">{{ $t('lang.individual_vacancies_page_leftside_sallary') }}</h4>
                        <ul>
                            <li>
                                <div class="form-check">
                                    <input type="radio" value="0" v-model="filterItem.payment" class="form-check-input" id="Any1">
                                    <label class="form-check-label" for="Any1">{{ $t('lang.individual_vacancies_page_leftside_sallary_any') }}</label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input type="radio" value="1" v-model="filterItem.payment" class="form-check-input" id="Compensation1">
                                    <label class="form-check-label" for="Compensation1">{{ $t('lang.individual_vacancies_page_leftside_sallary_from_500') }}</label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input type="radio" value="2" v-model="filterItem.payment" class="form-check-input" id="Compensation2">
                                    <label class="form-check-label" for="Compensation2">{{ $t('lang.individual_vacancies_page_leftside_sallary_from_700') }}</label>
                                </div>
                            </li>

                            <li>
                                <div class="form-check">
                                    <input type="radio" value="3" v-model="filterItem.payment" class="form-check-input" id="Compensation3">
                                    <label class="form-check-label" for="Compensation3">{{ $t('lang.individual_vacancies_page_leftside_sallary_from_900') }}</label>
                                </div>
                            </li>

                            <li>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="Other1">
                                    <label class="form-check-label" for="Other1">{{ $t('lang.individual_vacancies_page_leftside_sallary_other') }}</label>
                                </div>
                            </li>
                        </ul>
                    </div>







                    <div class="twm-sidebar-ele-filter sallarySideBar">
                        <h4 class="section-head-small mb-4">{{ $t('lang.individual_vacancies_page_leftside_second_location') }}</h4>
                        <ul>
                            <li>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="AnyLocation1">
                                    <label class="form-check-label" for="AnyLocation1">{{ $t('lang.individual_vacancies_page_leftside_second_location_any') }}</label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="FromLocation1">
                                    <label class="form-check-label" for="FromLocation1">{{ $t('lang.individual_vacancies_page_leftside_second_location_3km') }}</label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="FromLocation2">
                                    <label class="form-check-label" for="FromLocation2">{{ $t('lang.individual_vacancies_page_leftside_second_location_5km') }}</label>
                                </div>
                            </li>

                            <li>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="FromLocation3">
                                    <label class="form-check-label" for="FromLocation3">{{ $t('lang.individual_vacancies_page_leftside_second_location_7km') }}</label>
                                </div>
                            </li>

                        </ul>
                    </div>

                </form>

                <div class="twm-advertisment" style="background-image:url(/images/add-bg.jpg);">
                    <div class="overlay"></div>
                    <p>{{ $t('lang.candidate_page_leftside_box_title') }} </p>
                    <a href="about-1.html" class="site-button white">{{ $t('lang.candidate_page_leftside_box_read_more') }}</a>
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
<script>
import { ref, computed, defineComponent, watch } from 'vue';
export default defineComponent({
    props:{
        cla: Object
    },
    emit:['emitFilterData'],
    setup(props, { emit }) {
        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });
        const filterItem = ref({})
        const menageFilterItem = (value) =>{
            let item = value
            if (item.category && item.category.length == 0 ) {
                delete item['category']
            }
            if (item.schedule && item.schedule.length == 0 ) {
                delete item['schedule']
            }
            if (item.word == '') {
                delete item['word']
            }
            if (item.location == '') {
                delete item['location']
            }
            if (item.time == '' || item.time === '0') {
                delete item['time']
            }
            if (item.payment == '' || item.payment === '0') {
                delete item['payment']
            }
            return item
        }
        watch(filterItem.value, (newValue, oldValue) => {
            // Do something when filterItem changes
            emit('emitFilterData', menageFilterItem(newValue))
        });
        return{
            getLang,
            filterItem
        }
    }
})
</script>
<style lang="">

</style>
