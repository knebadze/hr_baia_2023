<script setup>
import { ref, computed } from "vue";
import moment from "moment";
import Slider from "@vueform/slider";
import "@vueform/slider/themes/default.css";
import _ from "lodash";
import table_cog from "./table_cog.vue";
import expand_body from "../../../candidate/component/candidate/expand_body.vue";
import addPersonalVacancy from "../../modal/addPersonalVacancy.vue";
import { copyToClipboard } from "../../../../../helper/clipboard";

const props = defineProps({
    data: Object,
    vacancy: Object,
});



const itemsSelected = ref([]);
let itemsSelectedButton = ref(false);
let showAddPersonalModal = ref(false);
let badgeClass = ref(false);
const vacancyData = () => {
    return props.vacancy ? props.vacancy : props.data.vacancy;
};
// let statusChangeModal = ref(false)
let modalItem = ref();

const headers = ref([
    { text: "id", value: "id" },
    { text: "ფოტო", value: "user.avatar" },
    { text: "სახელი გვარი", value: "user.name_ka" },
    { text: "ნომერი", value: "user.number" },
    { text: "პირადი ნომერი", value: "personal_number" },

    { text: "სტატუსი", value: "status" },
    { text: "მისამართი", value: "address_ka" },
    { text: "Operation", value: "operation" },
]);

const items = ref(
    makeData("candidate" in props.data ? props.data.candidate : props.data)
);
function makeData(params) {
    params.forEach((element, key) => {
        params[key].created_at = moment(element.created_at).format(
            "YYYY-MM-DD HH:mm"
        );
    });
    return params;
}

const bodyRowClassNameFunction = (item, number) => {
    if (!item.qualifying_candidate || item.qualifying_candidate.length === 0) {
        return "";
    }

    const vacancyId = props.data.vacancy.vacancy_id;

    // Check if there is any matching qualifying_candidate with the current vacancy_id
    const find = _.some(
        item.qualifying_candidate,
        (o) => o.vacancy_id == vacancyId
    );

    if (find) {
        badgeClass.value = true;
        item.badgeClass = badgeClass;
        return "my-vacancy-row";
    }

    // Define criteria for other classes
    const criteria = [
        { type: 6, statuses: [3, 4], className: "was-employed" },
        { type: 5, statuses: [2], className: "probationary-period" },
        { type: 3, statuses: [2], className: "employer-approved" },
        { type: 4, statuses: [2], className: "interviewer" },
    ];

    for (const { type, statuses, className } of criteria) {
        if (
            _.find(
                item.qualifying_candidate,
                (o) =>
                    o.qualifying_type_id == type &&
                    statuses.includes(props.data.vacancy.status_id)
            )
        ) {
            return className;
        }
    }

    return "";
};

const handleMessageFromChildren = (item) => {
    badgeClass.value = item.bool;
    items.value[
        _.findIndex(items.value, function (o) {
            return o.id == item.id;
        })
    ].badgeClass = badgeClass.value;
};

const showModal = (item) => {
    modalItem.value = vacancyData();
    modalItem.value["candidate_id"] =
        itemsSelected.value.length > 0
            ? itemsSelected.value.map(({ id }) => id)
            : item.id;
    showAddPersonalModal.value = !showAddPersonalModal.value;
};

const handlerOpenModal = (item) => {
    showModal(item);
};
const sizeIn = (avatar) => {
    const imageUrl = `/storage/${avatar}`;
    window.open(imageUrl, "_blank").focus();
};
</script>
<template lang="">
    <div v-if="itemsSelectedButton" class="d-flex justify-content-end mb-2">
        <button class="btn btn-info btn-sm" @click="showModal(item)">
            <i class="fa fa-plus"></i> დამატება
        </button>
    </div>
    <EasyDataTable
        v-model:items-selected="itemsSelected"
        buttons-pagination
        :headers="headers"
        :items="items"
        table-class-name="customize-table"
        :body-row-class-name="bodyRowClassNameFunction"
        border-cell
        :hide-footer="true"
    >
        <template #item-id="item">
            <span
                ref="codeDisplay"
                role="button"
                @click="copyToClipboard(item.id)"
                >{{ item.id }}</span
            >
        </template>
        <template #item-user.avatar="item">
            <img
                :src="`/storage/${item.user.avatar}`"
                width="50"
                height="50"
                @click="sizeIn(item.user.avatar)"
                style="cursor: zoom-in"
            />
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
        <!-- :filter-options="filterOptions" -->
        <template #item-operation="item">
            <div class="operation-wrapper d-flex">
                <div>
                    <span
                        v-if="item.badgeClass"
                        class="badge badge-pill bg-indigo p-2 mr-1"
                        title="კანდიდატი უკვე დამატებულია ვაკანსიაზე"
                    >
                        <i class="fa fa-check"></i
                    ></span>
                </div>

                <div v-if="!itemsSelectedButton">
                    <table_cog :item="item" @emitOpenModal="handlerOpenModal" />
                </div>
            </div>
        </template>
        <template #expand="item">
            <!-- {{ item }} -->
            <!-- /.card-header -->
            <expand_body :item="item" />
            <!-- /.card-body -->
        </template>
    </EasyDataTable>
    <addPersonalVacancy
        :visible="showAddPersonalModal"
        :item="modalItem"
        :emitResponse="handleMessageFromChildren"
    />
</template>

<style>
.my-vacancy-row {
    --easy-table-body-row-background-color: #befdc1;
    --easy-table-body-row-font-color: #070707;
}
.was-employed {
    --easy-table-body-row-background-color: #cc8b8e;
    --easy-table-body-row-font-color: #070707;
}
.probationary-period {
    --easy-table-body-row-background-color: #cfb0e6;
    --easy-table-body-row-font-color: #070707;
}
.employer-approved {
    --easy-table-body-row-background-color: #ffdab9;
    --easy-table-body-row-font-color: #070707;
}
.interviewer {
    --easy-table-body-row-background-color: #f5f5dc;
    --easy-table-body-row-font-color: #070707;
}
.customize-table {
    --easy-table-border: 1px solid #445269;
    /* --easy-table-row-border: 1px solid #445269; */

    --easy-table-header-font-size: 18px;
    --easy-table-header-height: 50px;
    --easy-table-body-row-font-size: 14px;
    --easy-table-body-row-height: 50px;
    --da0d4328: 400px !important;
}
</style>
