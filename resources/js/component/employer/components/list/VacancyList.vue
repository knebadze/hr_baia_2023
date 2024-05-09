<template lang="">
    <li>
        <div class="twm-jobs-list-style1 mb-4">
            <div class="row w-100">
                <div class="col-12 mb-1">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>
                                {{ item[`title_${getLang}`]
                                }}<span
                                    class="twm-job-post-duration"
                                    style="color: green"
                                >
                                    /{{ getTimeAgo(item.created_at) }}</span
                                >
                            </h4>
                        </div>
                        <div class="col-md-4 right_section">
                            <div class="twm-jobs-category green">
                                <span class="twm-bg-green"
                                    >{{ item.category[`name_${getLang}`] }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-1">
                    <div class="row">
                        <div class="col-md-8">
                            <p class="twm-job-address">
                                {{ item.author[`address_${getLang}`] }}.
                                <span
                                    v-for="(
                                        need, index
                                    ) in item.vacancy_for_who_need"
                                    :key="index"
                                >
                                    {{ need[`name_${getLang}`] }} </span
                                >.
                            </p>
                        </div>
                        <div class="col-md-4 right_section">
                            <div class="twm-jobs-amount">
                                {{ item.payment }} {{ item.currency.icon }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-md-8">
                            <p class="twm-job-address">
                                გრაფიკი:
                                {{
                                    `${item.work_schedule[`name_${getLang}`]}${
                                        item[`additional_schedule_${getLang}`]
                                            ? `, ${
                                                  item[
                                                      `additional_schedule_${getLang}`
                                                  ]
                                              }`
                                            : ""
                                    }.`
                                }}
                            </p>
                        </div>
                        <div class="col-md-4 right_section">
                            <div class="twm-jobs-amount text-align">
                                {{
                                    `${item.hr.user.number} /${
                                        item.hr.user[`name_${getLang}`]
                                    }`
                                }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-1">
                    <p
                        class="twm-job-address text-danger"
                        v-if="item.vacancy_benefit.length"
                    >
                        დამატებით:
                        <span v-for="i in item.vacancy_benefit">{{
                            i[`name_${getLang}`] + ", "
                        }}</span
                        >.
                    </p>
                    <!-- <div class="row">
                        <div class="col-md-8">
                            <p
                                class="twm-job-address text-danger"
                                v-if="item.vacancy_benefit.length"
                            >
                                დამატებით:
                                <span v-for="i in item.vacancy_benefit">{{
                                    i[`name_${getLang}`] + ", "
                                }}</span
                                >.
                            </p>
                        </div>
                        <div class="col-md-4 right_section"></div>
                    </div> -->
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-md-8">
                            <span
                                v-if="isCandidateInterested"
                                style="font-size: 20px"
                            >
                                <i :class="iconClass"></i>
                            </span>
                            <interest_button
                                v-else
                                :item="item"
                                @emitReceiveChild="handlerUpdateData"
                            />
                        </div>
                        <div class="col-md-4 right_section">
                            <button
                                role="button"
                                class="job_detail_read_more btn btn-info"
                                @click="viewDetails(item.id, item.slug)"
                            >
                                სრულად ნახვა
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
</template>
<script setup>
import { ref, computed } from "vue";
import interest_button from "../interest_button.vue";
import moment from "moment";

const props = defineProps({
    item: Object,
    auth: Object,
});
const getLang = computed(() => {
    return I18n.getSharedInstance().options.lang;
});

let url = new URL(location.href);
const detailUrl = ref(url.origin + "/" + getLang.value + "/job_detail");
// const checkInterest = ref(false);

const getTimeAgo = (created_at) => {
    const time = moment(created_at);
    const now = moment();
    const diff = now.diff(time);

    if (diff < 60000) {
        // less than 1 minute
        return "now";
    } else if (diff < 3600000) {
        // less than 1 hour
        const minutes = moment.duration(diff).asMinutes();
        return `${Math.round(minutes)} წუთის წინ`;
    } else if (diff < 86400000) {
        // less than 24 hours
        const hours = moment.duration(diff).asHours();
        return `${Math.round(hours)} საათის წინ`;
    } else if (diff < 172800000) {
        // less than 48 hours
        return "გუშინ";
    } else if (diff < 604800000) {
        // less than 7 days (1 week)
        const days = moment.duration(diff).asDays();
        return `${Math.round(days)} დღiს წინ`;
    } else {
        return time.format("D MMMM");
    }
};
const isCandidateInterested = computed(() => {
    return (
        props.auth &&
        props.item.vacancy_interest.some(
            (o) => o.candidate_id == props.auth.candidate.id
        )
    );
});

const iconClass = computed(() => {
    if (
        props.item.vacancy_interest.some(
            (o) =>
                o.candidate_id == props.auth.candidate.id &&
                o.employer_answer == null
        )
    ) {
        return "fa fa-plus-circle text-warning";
    } else if (
        props.item.vacancy_interest.some(
            (o) => o.user_id == props.auth.id && o.employer_answer == 0
        )
    ) {
        return "fa fa-times-circle text-danger";
    } else if (
        props.item.vacancy_interest.some(
            (o) => o.user_id == props.auth.id && o.employer_answer == 1
        )
    ) {
        return "fa fa-check-circle text-success";
    } else {
        return "";
    }
});

const viewDetails = (id, slug) => {
    const url = `${detailUrl.value}/${id}/${slug}`;
    // Navigate to the url
    window.location.href = url;
};
const handlerUpdateData = (id, response) => {
    // let find = props.items.find((element) => element.id == id);
    props.item.find.vacancy_interest.push(response.data.qualifying);
};
</script>
<style scope>
.right_section {
    display: flex;
    justify-content: flex-end;
}
.job_detail_read_more {
    margin-top: 5%;
    color: #fff;
}
.text-align {
    text-align: right;
}

@media (max-width: 767px) {
    .right_section {
        justify-content: center;
    }
    .text-align {
        text-align: center;
    }
}
</style>
