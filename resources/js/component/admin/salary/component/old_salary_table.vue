<template lang="">
    <div>
        <h4>ბოლო სამი თვის მონაცემი:</h4>
        <!-- <div class="mb-2 d-flex justify-content-end">
            <button class="btn btn-primary" type="button" title="ხელფასის გაცემა" v-if="role_id == 1 && disbursement_of_salary_button" @click="disbursement_of_salary()">
                <i class="fa fa-check"></i> ხელფასის გაცემა
            </button>
        </div> -->
        <hr />
        <EasyDataTable
            :headers="headers"
            :items="items"
            table-class-name="customize-table"
            border-cell
        >
            <!-- <template #item-category="item">
            <span class="text-primary" v-for="(i, index) in item.get_work_information" :key="index" ><u style="cursor: pointer;" @click="openInfoModal('category', item.get_work_information[index])">{{ i.category.name_ka+', ' }}</u></span>
        </template>-->
            <template #item-status="item">
                <span
                    :class="
                        !item.disbursement_date
                            ? 'badge bg-warning p-1'
                            : item.disbursement_date && item.hr_agree == 0
                            ? 'badge bg-danger p-1'
                            : 'badge bg-success p-1'
                    "
                    >{{
                        !item.disbursement_date
                            ? "მიმდინარე"
                            : item.disbursement_date && item.hr_agree == 0
                            ? "დასადასტურებელი"
                            : "დადასტურებული"
                    }}</span
                >
            </template>
            <!-- <template #item-operation="item">
           <div class="operation-wrapper">
            <button v-if="role_id == 2" :disabled="(item.disbursement_date)?false:true" class="btn btn-success" type="button" title="დადასტურება" @click="agree(item)">
                <i class="fa fa-check"></i>
            </button>
            <button v-else class="btn btn-success" type="button" title="დანამატის ჩაწერა" @click="openSupplementModal(item)">
                დანამატი
            </button>
          </div>
        </template> -->
        </EasyDataTable>
        <!-- {{ statusChangeModal }} -->
        <!-- <infoModal :visible="showInfoModal" :type="modalType" :items="item"></infoModal> -->
        <component
            :is="supplementModalComponent"
            v-if="supplementModalComponent"
            :visible="showSupplementModal"
            :item="item"
        ></component>
    </div>
</template>
<script>
import { ref, computed } from "vue";
import moment from "moment";
import Slider from "@vueform/slider";
import "@vueform/slider/themes/default.css";
// import Switch from '../../inc/Switch.vue';
import _ from "lodash";
import { markRaw } from "vue";
// import infoModal from '../modal/info_modal.vue'

export default {
    components: {
        Slider,
        // infoModal,
    },
    props: {
        data: Object,
        role_id: Number,
        // hrId: Number
    },

    setup(props) {
        let url = new URL(location.href);
        const itemsSelected = ref([]);
        let updateUrl = ref(url.origin + "/admin/candidate_update");

        var showSupplementModal = ref(false);
        var item = ref();
        // let hr_id = ref(props.hrId)
        let disbursement_of_salary_button = ref(false);
        let supplementModalComponent = ref(null);
        let checkDisbursement = ref(false);

        const headers = ref([
            // { text: "id", value: "id" },
            // { text: "staff", value: "staff" },
            {
                text: "ფიქსირებული ხელფასი",
                value: "fixed_salary",
                sortable: true,
            },
            {
                text: "ბონუსი ვაკანსიებიდან",
                value: "hr_bonus_from_vacancy",
                sortable: true,
            },
            {
                text: "ბონუსი ფაისანი რეგისტრაციებიდან",
                value: "hr_bonus_from_registration",
                sortable: true,
            },
            { text: "დანამატი", value: "supplement", sortable: true },
            { text: "სრული ხელფასი", value: "full_salary", sortable: true },
            { text: "დაწყების თარიღი", value: "created_at", sortable: true },
            { text: "გაცემის თარიღი", value: "disbursement_date" },
            { text: "თვე", value: "month" },
            { text: "სტატუსი", value: "status", sortable: true },

            // { text: "Operation", value: "operation" },
        ]);

        if(props.role_id == 1){
            headers.value.unshift({ text: "role", value: "role" });
            headers.value.unshift({ text: "staff", value: "staff" });

        }

        let data = props.data;
        const georgianMonthNames = {
            January: "იანვარი",
            February: "თებერვალი",
            March: "მარტი",
            April: "აპრილი",
            May: "მაისი",
            June: "ივნისი",
            July: "ივლისი",
            August: "აგვისტო",
            September: "სექტემბერი",
            October: "ოქტომბერი",
            November: "ნოემბერი",
            December: "დეკემბერი",
        };

        for (let i = 0; i < data.length; i++) {
            // const date = moment(data[i].created_at);
            // const start_date = moment(data[i].created_at); // Set locale to Georgian
            // data[i].created_at = start_date.format("YYYY-MM-DD HH:mm");

            // Get the English month name
            // const englishMonthName = date.format("MMMM");

            // Use the translation mapping to get the Georgian month name
            // const georgianMonthName =
            //     georgianMonthNames[englishMonthName] || englishMonthName;

            // data[i].month = georgianMonthName;
        }

        //  makeData(props.data)

        // cla = ref(props.data.classificatory)
        const items = ref(data);

        function makeData(params) {
            var arr = [];

            params.forEach((element) => {
                // let map = element.get_work_information.map(item => item.category.name_ka)
                element.category = map.toString();
                element.age = age(element.user.date_of_birth);

                arr.push(element);
            });
            return arr;
        }

        return {
            headers,
            items,
            itemsSelected,

            showSupplementModal,
            item,
            updateUrl,

            find,

            disbursement_of_salary_button,
            supplementModalComponent,
            checkDisbursement,
            // bodyRowClassNameFunction

            // statusChange
        };
    },
    methods: {
        async openSupplementModal(item) {
            if (!this.supplementModalComponent) {
                let module = await import("../modal/supplement_modal.vue");
                this.supplementModalComponent = markRaw(module.default);
            }
            this.item = item;
            this.showSupplementModal = !this.showSupplementModal;
        },
    },
    watch: {
        itemsSelected: {
            handler(newValue, oldValue) {
                if (newValue.length > 0) {
                    this.disbursement_of_salary_button = true;
                } else {
                    this.disbursement_of_salary_button = false;
                }
            },
            deep: true,
        },
    },
};
</script>
<style>
/* .my-candidate-row  {
            --easy-table-body-row-background-color: #f8b1b1;
            --easy-table-body-row-font-color: #070707;
        } */
.customize-table {
    --easy-table-border: 1px solid #445269;
    --easy-table-header-font-size: 18px;
    --easy-table-header-height: 50px;
    --easy-table-body-row-font-size: 14px;
    --easy-table-body-row-height: 50px;
}
</style>
