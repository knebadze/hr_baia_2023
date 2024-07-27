<script setup>
import { ref, computed, defineProps, onMounted } from "vue";
import moment from "moment";
import Slider from "@vueform/slider";
import "@vueform/slider/themes/default.css";
// import Switch from '../../inc/Switch.vue';
import _ from "lodash";
import info_modal from "../../modal/info_modal.vue";
import table_cog from "./table_cog.vue";
import expand_body from "./expand_body.vue";
import { copyToClipboard } from "../../../../../helper/clipboard";

const props = defineProps({
    data: Object,
    role_id: Number,
    hrId: Number,
});

const itemsSelected = ref([]);

let showInfoModal = ref(false);
var modalItem = ref(null);
let modalType = ref("");

let cla = ref(null);
let hr_id = ref(props.hrId);

let blackListComponent = ref(null);
let sendMessageComponent = ref(null);
const headers = ref([
    { text: "id", value: "id" },
    { text: "ფოტო", value: "avatar" },
    { text: "სახელი გვარი", value: "user.name_ka" },
    { text: "ნომერი", value: "user.number" },
    { text: "ასაკი", value: "age", sortable: true },
    { text: "კატეგორია", value: "category" },
    { text: "სტატუსი", value: "status" },
    { text: "გადასახადი", value: "registration_fee" },
    { text: "მისამართი", value: "address_ka" },
    { text: "Operation", value: "operation" },
]);
const localData = ref(props.data);
const items = ref([]);

onMounted(() => {
    items.value = makeData(localData.value);
});
const makeData = (params) => {
    let arr = [];

    params.forEach((element) => {
        let map = element.get_work_information.map(
            (item) => item.category.name_ka
        );
        element.category = map.toString();
        element.age = age(element.user.date_of_birth);
        element.avatar = element.user.avatar;
        // element.number = element.user.number;
        arr.push(element);
    });
    return arr;
};
const age = (date_of_birth) => {
    let dob = new Date(date_of_birth);
    let diff_ms = Date.now() - dob.getTime();
    let age_dt = new Date(diff_ms);
    return Math.abs(age_dt.getUTCFullYear() - 1970);
};

const openInfoModal = (type, item) => {
    modalType.value = type;
    modalItem.value = item;
    showInfoModal.value = !showInfoModal.value;
};

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
    // if (choseStatus.value !== 'ყველა') {
    //     filterOptionsArray.push({
    //         field: 'status.name_ka',
    //         comparison: '=',
    //         criteria: choseStatus.value,
    //     });
    // }
    // if (choseCategory.value !== 'ყველა') {
    //     filterOptionsArray.push({
    //         field: 'category.name_ka',
    //         comparison: '=',
    //         criteria: choseCategory.value,
    //     });

    // }
    // if (choseSchedule.value !== 'ყველა') {
    //     filterOptionsArray.push({
    //         field: 'work_schedule.name_ka',
    //         comparison: '=',
    //         criteria: choseSchedule.value,
    //     });

    // }
    // if (showPaymentFilter) {
    //     filterOptionsArray.push({
    //         field: 'payment',
    //         comparison: 'between',
    //         criteria: chosePayment.value,
    //     });
    // }
    // if (choseId.value !== '') {
    //     filterOptionsArray.push({
    //         field: 'id',
    //         comparison: '=',
    //         criteria: choseId.value,
    //     });

    // }

    // return filterOptionsArray;
});
const bodyRowClassNameFunction = (item, number) => {
    if (
        item.user.register_log &&
        item.user.register_log.creator_id == hr_id.value
    )
        return "my-candidate-row";
    return "";
};
const sizeIn = (avatar) => {
    const imageUrl = `/storage/${avatar}`;
    window.open(imageUrl, "_blank").focus();
};
</script>
<template lang="">
    <div>
        <EasyDataTable
            :headers="headers"
            :items="items"
            table-class-name="customize-table"
            :hide-footer="true"
            border-cell
            :filter-options="filterOptions"
        >
            <!-- :body-row-class-name="bodyRowClassNameFunction" -->
            <template #item-id="item">
                <span
                    ref="codeDisplay"
                    role="button"
                    @click="copyToClipboard(item.id)"
                    >{{ item.id }}</span
                >
            </template>
            <template #item-avatar="item">
                <img
                    :src="`/storage/${item.avatar}`"
                    width="50"
                    height="50"
                    @click="sizeIn(item.avatar)"
                    style="cursor: zoom-in"
                />
            </template>
            <template #item-category="item">
                <span
                    class="text-primary"
                    v-for="(i, index) in item.get_work_information"
                    :key="index"
                    ><u
                        style="cursor: pointer"
                        @click="
                            openInfoModal(
                                'category',
                                item.get_work_information[index]
                            )
                        "
                        >{{ i.category.name_ka + ", " }}</u
                    ></span
                >
            </template>
            <template #item-user.number="item">
                <span
                    ref="codeDisplay"
                    role="button"
                    @click="copyToClipboard(item.user.number)"
                    >{{ item.user.number }}</span
                >
            </template>
            <template #item-status="item">
                <span :class="`badge bg-${item.status.color} p-1`">{{
                    item.status.name_ka
                }}</span>
            </template>
            <template #item-registration_fee="item">
                <span
                    :class="
                        item.registration_fee == 0
                            ? 'badge bg-warning p-1'
                            : 'badge bg-success p-1'
                    "
                    >{{
                        item.registration_fee == 0 ? "გადასახდელი" : "გადახდილი"
                    }}</span
                >
            </template>
            <template #item-operation="item">
                <div class="operation-wrapper">
                    <table_cog :item="item" :role_id="role_id" :hrId="hrId" />
                </div>
            </template>
            <template #expand="item">
                <!-- {{ item }} -->
                <!-- /.card-header -->
                <expand_body :item="item" />
                <!-- /.card-body -->
            </template>
            <!-- <template #header-status.name_ka="header">
            <div class="filter-column">
                <i class="fa fa-filter text-secondary" style="font-size:15px;" @click.stop="showStatusFilter=!showStatusFilter"></i>
                {{ header.text }}
                <div class="filter-menu filter-sport-menu" v-if="showStatusFilter">
                <select
                    class="favouriteSport-selector"
                    v-model="choseStatus"
                    name="favouriteSport"
                >
                    <option value="ყველა">
                        ყველა
                    </option>
                    <option v-for="(item, index) in data.classificatory.status" :key="index" :value="item.name_ka">
                        {{ item.name_ka }}
                    </option>

                </select>
                </div>
            </div>
        </template>
        <template #header-category.name_ka="header">
            <div class="filter-column">
                <i class="fa fa-filter text-secondary" style="font-size:15px;" @click.stop="showCategoryFilter=!showCategoryFilter"></i>
                {{ header.text }}
                <div class="filter-menu filter-sport-menu" v-if="showCategoryFilter">
                <select
                    class="favouriteSport-selector"
                    v-model="choseCategory"
                    name="favouriteSport"
                >
                    <option value="ყველა">
                        ყველა
                    </option>
                    <option v-for="(item, index) in data.classificatory.category" :key="index" :value="item.name_ka">
                        {{ item.name_ka }}
                    </option>

                </select>
                </div>
            </div>
        </template>
        <template #header-work_schedule.name_ka="header">
            <div class="filter-column">
                <i class="fa fa-filter text-secondary" style="font-size:15px;" @click.stop="showScheduleFilter=!showScheduleFilter"></i>
                {{ header.text }}
                <div class="filter-menu filter-sport-menu" v-if="showScheduleFilter">
                <select
                    class="favouriteSport-selector"
                    v-model="choseSchedule"
                    name="favouriteSport"
                >
                    <option value="ყველა">
                        ყველა
                    </option>
                    <option v-for="(item, index) in data.classificatory.workSchedule" :key="index" :value="item.name_ka">
                        {{ item.name_ka }}
                    </option>

                </select>
                </div>
            </div>
        </template>
        <template #header-payment="header">
            <div class="filter-column">
                <i class="fa fa-filter text-secondary" style="font-size:15px;" @click.stop="showPaymentFilter=!showPaymentFilter"></i>
                {{ header.text }}
                <div class="filter-menu filter-sport-menu my-2" v-if="showPaymentFilter">
                    <Slider v-model="chosePayment" :max=3000 class="slider"/>
                </div>
            </div>
        </template>
        <template #header-id="header">
            <div class="filter-column">
                <i class="fa fa-filter text-secondary" style="font-size:15px;" @click.stop="showIdFilter=!showIdFilter"></i>
                {{ header.text }}
                <div class="filter-menu filter-sport-menu my-2" v-if="showIdFilter">
                    <input v-model="choseId"/>
                </div>
            </div>
        </template> -->
        </EasyDataTable>
        <!-- {{ statusChangeModal }} -->
        <info_modal
            :visible="showInfoModal"
            :type="modalType"
            :items="modalItem"
        />
    </div>
</template>

<style>
.my-candidate-row {
    --easy-table-body-row-background-color: #f8b1b1;
    --easy-table-body-row-font-color: #070707;
}
.customize-table {
    --easy-table-border: 1px solid #445269;
    --easy-table-header-font-size: 18px;
    --easy-table-header-height: 50px;
    --easy-table-body-row-font-size: 14px;
    --easy-table-body-row-height: 50px;
    --da0d4328: 400px !important;
}
</style>
