<script setup>
import { I18n } from "laravel-vue-i18n";
import { defineProps, computed } from "vue";
import { split, trimEnd, get } from "lodash";
const props = defineProps({
    item: Object,
});
const getLang = computed(() => {
    return I18n.getSharedInstance().options.lang;
});
const detailUrl = computed(() => {
    let url = new URL(location.href);
    return url.origin + "/" + getLang.value + "/candidate-detail";
});
const AddJobUrl = computed(() => {
    let url = new URL(location.href);
    return url.origin + "/" + getLang.value + "/post_job";
});
</script>
<template lang="">
    <div class="col-lg-6 col-md-6">
        <div
            class="twm-candidates-grid-style1 mb-5"
            style="background-color: #fdfff5"
        >
            <div class="twm-media">
                <div class="twm-media-pic">
                    <img :src="'/storage/' + item.user.avatar" alt="#" />
                </div>
                <!-- <div class="twm-candidates-tag"><span>გამორჩეული</span></div> -->
            </div>
            <div class="twm-mid-content">
                <a href="#" class="twm-job-title">
                    <h4>{{ split(item.user[`name_${getLang}`], " ")[0] }}</h4>
                </a>
                <p>
                    <span>{{
                        item.work_information.map((i) => i.name_ka).join(", ")
                    }}</span>
                </p>
                <a
                    :href="detailUrl + '/' + item.id"
                    class="twm-view-prifile site-text-primary"
                    >{{
                        $t(
                            "lang.company_vacancies_page_middle_leftside_read_more"
                        )
                    }}</a
                >
                <p>
                    <a
                        :href="AddJobUrl"
                        class="twm-view-prifile site-text-primary"
                        >დავინტერესდი</a
                    >
                </p>

                <div class="twm-fot-content">
                    <div class="twm-left-info">
                        <p class="twm-candidate-address">
                            <i class="feather-map-pin"></i
                            >{{ trimEnd(get(item, `address_${getLang}`), " ") }}
                        </p>
                        <!-- <span><i class="fa fa-clock pe-1"> </i>{{ item.created_at }}</span> -->

                        <!-- <div class="twm-jobs-vacancies">$</div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- OUR BLOG END -->
</template>

<style lang=""></style>
