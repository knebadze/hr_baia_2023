<template lang="">
    <li>
        <div class="twm-jobs-list-style1 mb-4">
            <div class="row w-100">
                <div class="col-md-12 mb-1">
                    <span>ID: {{ item.code }}</span>
                </div>
                <div class="col-12 mb-1">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>
                                {{
                                    item[`title_${getLang}`]
                                        ? item[`title_${getLang}`]
                                        : ""
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
                                <i class="flaticon-map-1"></i>
                                {{ item.author[`address_${getLang}`] }}.
                            </p>
                        </div>
                        <div class="col-md-4 right_section">
                            <div class="twm-jobs-amount">
                                <i class="fa fa-money-bill"></i>
                                {{ item.payment }} {{ item.currency.icon }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-1">
                    <div class="row">
                        <div class="col-md-8">
                            <p class="twm-job-address">
                                <span v-if="checkCategoryId(item.category_id)">
                                    ვისთვის:
                                </span>
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
                            <div class="twm-jobs-amount text-align">
                                <i class="fa fa-phone"></i>
                                {{
                                    `${item.hr.number} / ${item.hr[
                                        `name_${getLang}`
                                    ]
                                        .split(" ")
                                        .shift()}`
                                }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <!-- <div class="row">
                        <div class="col-md-8"> -->
                    <p class="twm-job-address">
                        <!-- <i class="fa fa-calendar"></i> -->
                        გრაფიკი:
                        {{
                            `${item.work_schedule[`name_${getLang}`]}${
                                item[`additional_schedule_${getLang}`]
                                    ? `, ${
                                          item[`additional_schedule_${getLang}`]
                                      }`
                                    : ""
                            }.`
                        }}
                    </p>
                    <!-- </div>
                    </div> -->
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
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-md-8">
                            <div v-if="(auth && auth.role_id === 3) || !auth">
                                <span
                                    v-if="isCandidateInterested"
                                    style="font-size: 20px"
                                >
                                    <i :class="iconClass"></i>
                                </span>
                                <interest_button
                                    v-else
                                    :item="item"
                                    :auth="auth"
                                />
                            </div>
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
const detailUrl = ref(`${url.origin}/${getLang.value}/job_detail`);
// const checkInterest = ref(false);
const monthName = {
    january: "იანვარი",
    february: "თებერვალი",
    march: "მარტი",
    april: "აპრილი",
    may: "მაისი",
    june: "ივნისი",
    july: "ივლისი",
    august: "აგვისტო",
    september: "სექტემბერი",
    october: "ოქტომბერი",
    november: "ნოემბერი",
    december: "დეკემბერი",
}
const getTimeAgo = (created_at) => {
    const time = moment(created_at, "YYYY-MM-DD HH:mm"); // Explicit format
    const now = moment();
    const diff = now.diff(time);

    if (diff < 0) {
        // Date is in the future
        // Handle future dates appropriately
        // For example, calculate how far in the future it is
        const futureMinutes = moment.duration(-diff).asMinutes();
        if (futureMinutes < 60) {
            return `${Math.round(futureMinutes)} წუითის წინ`; // minutes in the future
        }
        const futureHours = moment.duration(-diff).asHours();
        if (futureHours < 24) {
            return `${Math.round(futureHours)} საათის წინ`; // hours in the future
        }
        // Add more conditions as needed for days, etc.
        return "in the future";
    } else if (diff < 60000) {
        // less than 1 minute
        return "ახლა";
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
        return `${Math.round(days)} დღის წინ`;
    } else {
        const dayAndMonth = time.format("D MMMM");
        if (getLang.value !== "ka") {
            return dayAndMonth;

        }
        const [day, month] = dayAndMonth.split(" ");
        const monthInGeorgian = monthName[month.toLowerCase()];
        return `${day} ${monthInGeorgian}`;
    }
};
const isCandidateInterested = computed(() => {
    return (
        props.auth &&
        props.auth.role_id == 3 &&
        props.item.qualifying_candidate.some(
            (o) => o.candidate_id == props.auth.candidate.id
        )
    );
});

const iconClass = computed(() => {
    const qualifyingCandidate = props.item.qualifying_candidate.find(
        (o) => o.candidate_id == props.auth.candidate.id
    );

    if (qualifyingCandidate) {
        if (qualifyingCandidate.employer_answer === null) {
            return "fa fa-plus-circle text-warning";
        } else if (qualifyingCandidate.employer_answer === 0) {
            return "fa fa-times-circle text-danger";
        } else if (
            qualifyingCandidate.employer_answer === 1 ||
            qualifyingCandidate.qualifying_type_id > 3
        ) {
            return "fa fa-check-circle text-success";
        }
    }

    return "";
});

const checkCategoryId = (id) => {
    return _.includes([1, 2, 3, 5], id);
};

const viewDetails = (id, slug) => {
    const url = `${detailUrl.value}/${id}/${slug}`;
    // Navigate to the url
    window.location.href = url;
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
