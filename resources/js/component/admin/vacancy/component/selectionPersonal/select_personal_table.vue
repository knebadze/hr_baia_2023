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

    >
    <template #item-status="item">
        <!-- {{ item.status }} -->
        <span :class="(item.status.id == 8)?'badge badge-warning':(item.status.id == 9)?'badge badge-primary':(item.status.id == 10)?'badge badge-success':(item.status.id == 11)?'badge badge-info':(item.status.id == 12)?'badge badge-secondary':''" >{{ item.status.name_ka }}</span>
    </template>
    <!-- :filter-options="filterOptions" -->
    <template #item-operation="item">
       <div class="operation-wrapper d-flex" >
        <div>
            <span v-if="item.badgeClass" class="badge badge-pill bg-indigo  p-2 mr-1" title="კანდიდატი უკვე დამატებულია ვაკანსიაზე"> <i class="fa fa-check"></i></span>
        </div>

        <div v-if="!itemsSelectedButton">
            <table_cog :item="item" @emitOpenModal="handlerOpenModal"/>
            <!-- <button class="btn btn-info btn-sm" @click="showModal(item)" :disabled="(item.status_id == 10)?true:false">
                <i class="fa fa-plus"></i> დამატება
            </button>
            <button class="btn btn-success btn-sm ml-1" @click="showModal(item)" >
                <i class="fa fa-envelope"></i> sms
            </button> -->
        </div>

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
    <addPersonalVacancy  :visible="showAddPersonalModal" :item="modalItem" :onMessageFromChildren="handleMessageFromChildren"></addPersonalVacancy>

</template>
<script>
import { ref, computed } from "vue";
import moment from 'moment'
import Slider from '@vueform/slider'
import "@vueform/slider/themes/default.css";
import _ from 'lodash'
import table_cog from "./table_cog.vue";
import expand_body from "../../../candidate/component/table/expand_body.vue";
import addPersonalVacancy from "../../modal/addPersonalVacancy.vue";

export default {
    components: {
      Slider,
      table_cog,
      expand_body,
      addPersonalVacancy
    },
    props:{
        data: Object,
        vacancy: Object
    },

    setup(props){
        //variable
        const itemsSelected = ref([]);
        let itemsSelectedButton = ref(false)
        let showAddPersonalModal = ref(false)
        let badgeClass = ref(false)
        const vacancyData = () =>{
            return (props.vacancy)?props.vacancy:props.data.vacancy
        }
        // let statusChangeModal = ref(false)
        let modalItem = ref()

        const headers = ref([
            { text: "id", value: "id" },
            { text: "სახელი გვარი", value: "user.name_ka"},
            { text: "ნომერი", value: "user.number"},
            { text: "პირადი ნომერი", value: "personal_number"},

            { text: "სტატუსი", value: "status"},
            { text: "დამატების თარიღი", value: "created_at", sortable: true},
            { text: "Operation", value: "operation" },
        ]);


        const items = ref(makeData(('candidate' in props.data)?props.data.candidate:props.data));
        function makeData(params) {
            params.forEach((element, key) => {
                params[key].created_at = moment(element.created_at).format("YYYY-MM-DD HH:mm")
            });
            return params
        }

        const bodyRowClassNameFunction = ( item, number) => {

            let find = _.some(item.qualifying_candidate, function(o) { return o.vacancy_id == props.data.vacancy.vacancy_id  })
            if (find) {
                badgeClass.value = true
                item.badgeClass = badgeClass
                return 'my-vacancy-row'
            }else if (!find && _.find(item.qualifying_candidate, function(o) { return o.qualifying_type_id == 6 && (o.vacancy.status == 3 || o.vacancy.status == 4)})) {
                return 'was-employed'
            }else if (!find && _.find(item.qualifying_candidate, function(o) { return o.qualifying_type_id == 5 && o.vacancy.status == 2})) {
                return 'probationary-period'
            }else if (!find && _.find(item.qualifying_candidate, function(o) { return o.qualifying_type_id == 3 && o.vacancy.status == 2})) {
                return 'employer-approved'
            }else if (!find && _.find(item.qualifying_candidate, function(o) { return o.qualifying_type_id == 4 && o.vacancy.status == 2})) {
                return 'interviewer'
            }
        };

        function handleMessageFromChildren(id, message) {
            badgeClass.value = message
            items.value[_.findIndex(items.value, function(o) { return o.id == id })].badgeClass = badgeClass.value
        };

        const showModal = (item) => {
           showAddPersonalModal.value = !showAddPersonalModal.value
            modalItem.value = vacancyData()
            modalItem.value['candidate_id'] = (itemsSelected.value.length > 0)?itemsSelected.value.map(({ id }) => id):item.id
        }

        const handlerOpenModal = (item) =>{
            showModal(item)
        };

        // console.log('itemsSelected.value.length',itemsSelected.value.length);
        // if (itemsSelected.value.length > 0) {
        //     console.log('itemsSelected.value.length',itemsSelected.value.length);
        // }

        // const showStatusFilter = ref(false);
        // const showCategoryFilter = ref(false);
        // const showScheduleFilter = ref(false);
        // const showPaymentFilter = ref(false);
        // const showIdFilter = ref(false);
        // const choseStatus = ref('ყველა');
        // const choseCategory = ref('ყველა');
        // const choseSchedule = ref('ყველა');
        // const chosePayment = ref([500, 1500]);
        // const choseId = ref('');
        // const filterOptions = computed(()=> {
        //     const filterOptionsArray =  [];
        //     if (choseStatus.value !== 'ყველა') {
        //         filterOptionsArray.push({
        //             field: 'status.name_ka',
        //             comparison: '=',
        //             criteria: choseStatus.value,
        //         });
        //     }
        //     if (choseCategory.value !== 'ყველა') {
        //         filterOptionsArray.push({
        //             field: 'category.name_ka',
        //             comparison: '=',
        //             criteria: choseCategory.value,
        //         });

        //     }
        //     if (choseSchedule.value !== 'ყველა') {
        //         filterOptionsArray.push({
        //             field: 'work_schedule.name_ka',
        //             comparison: '=',
        //             criteria: choseSchedule.value,
        //         });

        //     }
        //     if (showPaymentFilter) {
        //         filterOptionsArray.push({
        //             field: 'payment',
        //             comparison: 'between',
        //             criteria: chosePayment.value,
        //         });
        //     }
        //     if (choseId.value !== '') {
        //         filterOptionsArray.push({
        //             field: 'id',
        //             comparison: '=',
        //             criteria: choseId.value,
        //         });

        //     }

        //     return filterOptionsArray;
        // });


        // var url = new URL( location.href)

        // var personalSelectionUrl = ref(url.origin+'/admin/selection_personal')
        // console.log(personalSelectionUrl);


        return {
            headers,
            items,
            // showStatusFilter,
            // choseStatus,
            // showCategoryFilter,
            // choseCategory,
            // showScheduleFilter,
            // choseSchedule,
            // showPaymentFilter,
            // chosePayment,
            // showIdFilter,
            // choseId,
            // filterOptions,
            itemsSelected,
            itemsSelectedButton,
            // statusChangeModal,
            showAddPersonalModal,
            modalItem,
            badgeClass,
            bodyRowClassNameFunction,
            handleMessageFromChildren,
            handlerOpenModal
        };
    },
    methods:{
        // handleMessageFromChildren(id, message) {
        //     this.badgeClass = message
        //     _.find(item.qualifying_candidate, function(o) { return o.qualifying_type_id == 5 && o.vacancy.status == 2})
        // },
    },
    watch:{
        itemsSelected: {
            handler(newValue, oldValue) {

                if (newValue.length > 0) {
                    this.itemsSelectedButton = true
                }else{
                    this.itemsSelectedButton = false
                }

            },
            deep: true
        },
    }
}
</script>
<style >
    .my-vacancy-row  {
        --easy-table-body-row-background-color: #befdc1;
        --easy-table-body-row-font-color: #070707;
    }
    .was-employed{
        --easy-table-body-row-background-color: #cc8b8e;
        --easy-table-body-row-font-color: #070707;
    }
    .probationary-period{
        --easy-table-body-row-background-color: #cfb0e6 ;
        --easy-table-body-row-font-color: #070707;
    }
    .employer-approved{
        --easy-table-body-row-background-color: #ffdab9 ;
        --easy-table-body-row-font-color: #070707;
    }
    .interviewer{
        --easy-table-body-row-background-color: #f5f5dc  ;
        --easy-table-body-row-font-color: #070707;
    }
    .customize-table {
        --easy-table-border: 1px solid #445269;
        /* --easy-table-row-border: 1px solid #445269; */

        --easy-table-header-font-size: 18px;
         --easy-table-header-height: 50px;
         --easy-table-body-row-font-size: 14px;
         --easy-table-body-row-height: 50px;
    }
</style>
