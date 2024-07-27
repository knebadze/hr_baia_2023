<script setup>
import { ref, computed } from "vue";
import Slider from "@vueform/slider";
import "@vueform/slider/themes/default.css";
import _ from "lodash";
import table_cog from "./table_cog.vue";
import expand_body from "./expand_body.vue";
import { copyToClipboard } from "../../../../../helper/clipboard";

const props = defineProps({
    data: Object,
    hrId: Number,
    classificatory: Object,
    roleId: Number,
    adminId: Number,
    fullPermission: Boolean,
    fullView: Boolean,
});

const itemsSelected = ref([]);

const hr_id = ref(props.hrId);
// let myVacancy = ref(false)
const cla = ref(props.classificatory);
const role_id = ref(props.roleId ? props.roleId : 1);

const headers = ref([
    { text: "id", value: "code" },
    { text: "კატეგორია", value: "category" },
    { text: "გრაფიკი", value: "work_schedule.name_ka" },
    { text: "დამსაქმებელი", value: "employer.name_ka" },
    { text: "ნომერი", value: "employer.number" },
    { text: "სტატუსი", value: "status" },
    { text: "ანაზღაურება", value: "payment", sortable: true },
    { text: "საჭიროება", value: "start_date", sortable: true },
    { text: "მისამართი", value: "address" },
    { text: "Operation", value: "operation" },
]);
const data = ref(props.data);

const items = ref(data);

// const bodyRowClassNameFunction = ( item, number) => {
//     if (item.hr_id == hr_id.value) return 'my-vacancy-row';
//     return '';
// };
const showStatusFilter = ref(false);
const showCategoryFilter = ref(false);
const showScheduleFilter = ref(false);
const showPaymentFilter = ref(false);
const showIdFilter = ref(false);
const choseStatus = ref("ყველა");
const choseCategory = ref("ყველა");
const choseSchedule = ref("ყველა");
const chosePayment = ref([50, 3000]);
const choseId = ref("");

const filterOptions = computed(() => {
    const filterOptionsArray = [];
    if (choseStatus.value !== "ყველა") {
        filterOptionsArray.push({
            field: "status.name_ka",
            comparison: "=",
            criteria: choseStatus.value,
        });
    }
    if (choseCategory.value !== "ყველა") {
        filterOptionsArray.push({
            field: "category.name_ka",
            comparison: "=",
            criteria: choseCategory.value,
        });
    }
    if (choseSchedule.value !== "ყველა") {
        filterOptionsArray.push({
            field: "work_schedule.name_ka",
            comparison: "=",
            criteria: choseSchedule.value,
        });
    }
    if (showPaymentFilter) {
        filterOptionsArray.push({
            field: "payment",
            comparison: "between",
            criteria: chosePayment.value,
        });
    }
    if (choseId.value !== "") {
        filterOptionsArray.push({
            field: "id",
            comparison: "=",
            criteria: choseId.value,
        });
    }

    return filterOptionsArray;
});

const bodyRowClassNameFunction = (item, number) => {
    if (props.fullView && item.hr.parent_id == props.adminId)
        return "my-vacancy-row";
};

// const myVacancySwitch = () =>{
//     if (!myVacancy.value) {
//        data.value =  _.sortBy(_.filter(props.data.vacancy, function(o) { return o.hr_id == hr_id.value; }), [function(o) { return o.start_date; }]);
//     }else{
//         data.value = props.data.vacancy
//     }
// };
// const copyToClipboard = (item) => {
//     navigator.clipboard
//         .writeText(item)
//         .then(() => {
//             toast.success("დაკოპირდა", {
//                 theme: "colored",
//                 autoClose: 1000,
//             });
//             // You can add any success message or actions here
//         })
//         .catch((err) => {
//             console.error("Error copying text: ", err);
//             // You can handle the error here, e.g., show an error message
//         });
// };
</script>
<template>
    <div>
        <EasyDataTable
            :headers="headers"
            :items="items"
            table-class-name="customize-table"
            :body-row-class-name="bodyRowClassNameFunction"
            border-cell
            :filter-options="filterOptions"
            :hide-footer="true"
        >
            <template #item-operation="item">
                <div class="operation-wrapper">
                    <table_cog
                        :item="item"
                        :key="item.id"
                        :roleId="role_id"
                        :adminId="adminId"
                        :fullPermission="fullPermission"
                    ></table_cog>
                </div>
            </template>
            <template #item-code="item">
                <span
                    ref="codeDisplay"
                    role="button"
                    @click="copyToClipboard(item.code)"
                    >{{ item.code }}</span
                >
            </template>
            <template #item-category="item">
                <span :class="`badge bg-${item.category.color} p-1`">{{
                    item.category.name_ka
                }}</span>
            </template>
            <template #item-status="item">
                <span :class="`badge bg-${item.status.color} p-1`">{{
                    item.reason_for_cancel && item.reason_for_cancel.id == 35
                        ? item.reason_for_cancel.name_ka
                        : item.status.name_ka
                }}</span>
            </template>
            <template #item-address="item">
                {{ `${item.employer.address_ka} ${item.employer.street_ka}` }}
            </template>
            <template #expand="item">
                <expand_body :item="item" :hr_id="hr_id" :roleId="role_id" />
            </template>
            <template #item-employer.number="item">
                <span
                    ref="codeDisplay"
                    role="button"
                    @click="copyToClipboard(item.employer.number)"
                    >{{
                        item.employer.number_code.id != 79
                            ? `+${item.employer.number_code.numcode} ${item.employer.number}`
                            : item.employer.number
                    }}</span
                >
            </template>
            <template #header-status.name_ka="header">
                <div class="filter-column">
                    <i
                        class="fa fa-filter text-secondary"
                        style="font-size: 15px"
                        @click.stop="showStatusFilter = !showStatusFilter"
                    ></i>
                    {{ header.text }}
                    <div
                        class="filter-menu filter-sport-menu"
                        v-if="showStatusFilter"
                    >
                        <select
                            class="favouriteSport-selector"
                            v-model="choseStatus"
                            name="favouriteSport"
                        >
                            <option value="ყველა">ყველა</option>
                            <option
                                v-for="(item, index) in data.classificatory
                                    .status"
                                :key="index"
                                :value="item.name_ka"
                            >
                                {{ item.name_ka }}
                            </option>
                        </select>
                    </div>
                </div>
            </template>
            <template #header-category.name_ka="header">
                <div class="filter-column">
                    <i
                        class="fa fa-filter text-secondary"
                        style="font-size: 15px"
                        @click.stop="showCategoryFilter = !showCategoryFilter"
                    ></i>
                    {{ header.text }}
                    <div
                        class="filter-menu filter-sport-menu"
                        v-if="showCategoryFilter"
                    >
                        <select
                            class="favouriteSport-selector"
                            v-model="choseCategory"
                            name="favouriteSport"
                        >
                            <option value="ყველა">ყველა</option>
                            <option
                                v-for="(item, index) in data.classificatory
                                    .category"
                                :key="index"
                                :value="item.name_ka"
                            >
                                {{ item.name_ka }}
                            </option>
                        </select>
                    </div>
                </div>
            </template>
            <template #header-work_schedule.name_ka="header">
                <div class="filter-column">
                    <i
                        class="fa fa-filter text-secondary"
                        style="font-size: 15px"
                        @click.stop="showScheduleFilter = !showScheduleFilter"
                    ></i>
                    {{ header.text }}
                    <div
                        class="filter-menu filter-sport-menu"
                        v-if="showScheduleFilter"
                    >
                        <select
                            class="favouriteSport-selector"
                            v-model="choseSchedule"
                            name="favouriteSport"
                        >
                            <option value="ყველა">ყველა</option>
                            <option
                                v-for="(item, index) in cla"
                                :key="index"
                                :value="item.name_ka"
                            >
                                {{ item.name_ka }}
                            </option>
                        </select>
                    </div>
                </div>
            </template>
            <template #header-payment="header">
                <div class="filter-column">
                    <i
                        class="fa fa-filter text-secondary"
                        style="font-size: 15px"
                        @click.stop="showPaymentFilter = !showPaymentFilter"
                    ></i>
                    {{ header.text }}
                    <div
                        class="filter-menu filter-sport-menu my-2"
                        v-if="showPaymentFilter"
                    >
                        <Slider
                            v-model="chosePayment"
                            :max="3000"
                            class="slider"
                        />
                    </div>
                </div>
            </template>
            <template #header-id="header">
                <div class="filter-column">
                    <i
                        class="fa fa-filter text-secondary"
                        style="font-size: 15px"
                        @click.stop="showIdFilter = !showIdFilter"
                    ></i>
                    {{ header.text }}
                    <div
                        class="filter-menu filter-sport-menu my-2"
                        v-if="showIdFilter"
                    >
                        <input v-model="choseId" />
                    </div>
                </div>
            </template>
        </EasyDataTable>
    </div>
</template>
<style scoped>
.customize-table {
    --easy-table-border: 1px solid #445269;
    --easy-table-header-font-size: 18px;
    --easy-table-header-height: 50px;
    --easy-table-body-row-font-size: 14px;
    --easy-table-body-row-height: 50px;
    --da0d4328: 400px !important;
}
.my-vacancy-row {
    --easy-table-body-row-background-color: #befdc1;
    --easy-table-body-row-font-color: #070707;
}
</style>
