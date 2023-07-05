<template lang="">
    <EasyDataTable
        buttons-pagination
        :headers="headers"
        :items="items"
        table-class-name="customize-table"
        border-cell
        :filter-options="filterOptions"
    >
    <template #item-operation="item">
       <div class="operation-wrapper">
        <!--<button class="btn btn-info btn-sm">
            <i
                class="fa fa-cog"
                @click="deleteItem(item)"
            ></i>
        </button> -->
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-cog"></i>
            </button>
            <div class="dropdown-menu ropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#" @click="vacancyUpdateModal(item)">რედაქტირება</a>
                <a class="dropdown-item" href="#" @click="statusChange(item)">სტატუსის შეცვლა</a>
                <a v-if="item.status.id == 2" class="dropdown-item" href="#" @click="selectionPersonalModal(item)">კადრების შერჩევა</a>
                <a class="dropdown-item" href="#" @click="vacancyDepositModal(item)">დეპოზიტი</a>

                <a class="dropdown-item" href="#">გამეორება</a>
            </div>
        </div>
        <!-- <button class="btn btn-info btn-sm">
            <i
                class="fa fa-pen"
                @click="deleteItem(item)"
            ></i>
        </button>
        <button class="btn btn-info btn-sm">
            <i
            class="fa fa-trash"
            @click="editItem(item)"
            ></i>
        </button> -->
      </div>
    </template>
        <template #expand="item">
            <!-- {{ item }} -->
              <!-- /.card-header -->
              <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">სათაური:</dt>
                                <dd class="col-sm-8">{{ item.title_ka }}</dd>
                                <dt class="col-sm-4">სამუშაო დღეები:</dt>
                                <dd class="col-sm-8">{{ item.additional_schedule_ka }}</dd>
                                <div class="row col-12" v-if="item.vacancy_for_who_need.length > 0">
                                    <dt class="col-sm-4">ვისთვის ესაჭიროება:</dt>
                                    <dd class="col-sm-8"><span v-for="(i, index) in item.vacancy_for_who_need" :key="index">{{ i.name_ka+', ' }}</span> </dd>
                                </div>
                                <div class="row col-12" v-if="item.vacancy_benefit.length > 0">
                                    <dt class="col-sm-4">ბენეფიტები:</dt>
                                    <dd class="col-sm-8"><span v-for="(i, index) in item.vacancy_benefit" :key="index">{{ i.name_ka+', ' }}</span> </dd>
                                </div>
                                <div class="row col-12" v-if="item.stay_night == 1 || item.go_vacation == 1 || item.work_additional_hours == 1">
                                    <dt class="col-sm-4">უნდა შეეძლოს:</dt>
                                    <dd class="col-sm-8">
                                        <span v-if="item.stay_night == 1"> ღამე დარჩენა, </span>
                                        <span v-if="item.go_vacation  == 1"> არდადეგებზე გაყოლა, </span>
                                        <span v-if="item.work_additional_hours == 1"> დამატებითი საათები მუშაობა, </span>
                                    </dd>
                                </div>

                                <div class="row col-12" v-if="item.vacancy_duty.length > 0">
                                    <dt class="col-sm-4">მოვალეობები:</dt>
                                    <dd class="col-sm-8"><span v-for="(i, index) in item.vacancy_duty" :key="index" class="badge badge-primary">{{ i.name_ka+', ' }}</span> </dd>
                                </div>
                                <div class="row col-12" v-if="item.demand.additional_name_ka">
                                    <dt class="col-sm-4">დამატებითი მოვალეობები:</dt>
                                    <dd class="col-sm-8">{{ item.demand.additional_name_ka }} </dd>
                                </div>
                                <div class="row col-12 border-top">
                                    <dt class="col-sm-4">კანდიდატისგან უნდა ჩაირიცხოს:</dt>
                                    <dd class="col-sm-8"> {{ item.deposit.candidate_initial_amount }}</dd>
                                </div>
                                <div class="row col-12 border-top" v-if="item.deposit.must_be_enrolled_candidate_date">
                                    <dt class="col-sm-4">კანდიდატისგან უნდა ჩაირიცხოს თარიღი:</dt>
                                    <dd class="col-sm-8"> {{ item.deposit.must_be_enrolled_candidate_date }}</dd>
                                </div>
                                <div class="row col-12 border-top" v-if="item.deposit.enrolled_candidate">
                                    <dt class="col-sm-4">კანდიდატისგან ჩაირიცხა:</dt>
                                    <dd class="col-sm-8"> {{ item.deposit.enrolled_candidate }}</dd>
                                </div>
                                <div class="row col-12 border-top" v-if="item.deposit.enrolled_candidate_date">
                                    <dt class="col-sm-4">კანდიდატისგან ჩაირიცხა თარიღი:</dt>
                                    <dd class="col-sm-8"> {{ item.deposit.enrolled_candidate_date }}</dd>
                                </div>

                            </dl>
                        </div>
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">დამატების თარიღი:</dt>
                                <dd class="col-sm-8">{{ item.created_at }}</dd>
                                <dt class="col-sm-4">განახლების თარიღი:</dt>
                                <dd class="col-sm-8">{{ item.updated_at }}</dd>
                                <dt class="col-sm-4">გასაუბრების თარიღი:</dt>
                                <dd class="col-sm-8">{{ item.interview_date }}</dd>
                                <dt class="col-sm-4">გასაუბრების ადგილი:</dt>
                                <dd class="col-sm-8">{{ item.interview_place.name_ka }}</dd>
                                <dt class="col-sm-4">ვადა:</dt>
                                <dd class="col-sm-8">{{ item.term.name_ka }}</dd>
                                <div class="row col-12" v-if="item.demand.education">
                                    <dt class="col-sm-4">განათლება:</dt>
                                    <dd class="col-sm-8">{{ item.demand.education.name_ka }} </dd>
                                </div>
                                <div class="row col-12" v-if="item.demand.specialty">
                                    <dt class="col-sm-4">პროფესია:</dt>
                                    <dd class="col-sm-8">{{ item.demand.specialty.name_ka }} </dd>
                                </div>
                                <div class="row col-12" v-if="item.demand.language">
                                    <dt class="col-sm-4">უცხო ენა:</dt>
                                    <dd class="col-sm-8">{{ item.demand.language.name_ka+' -' }} {{ (item.demand.language_level)?item.demand.language_level.name_ka:''}}</dd>
                                </div>
                                <div class="row col-12" v-if="item.demand.min_age || item.demand.max_age">
                                    <dt class="col-sm-4">ასაკი:</dt>
                                    <dd class="col-sm-8">{{ item.demand.min_age+' - '+ item.demand.max_age}}</dd>
                                </div>
                                <div class="row col-12" v-if="item.characteristic.length > 0">
                                    <dt class="col-sm-4">მახასიათებლები:</dt>
                                    <dd class="col-sm-8"><span v-for="(i, index) in item.characteristic" :key="index" >{{ i.name_ka+', ' }}</span> </dd>
                                </div>

                                <div class="row col-12 border-top">
                                    <dt class="col-sm-4 ">დამსაქმებლისგან უნდა ჩაირიცხოს:</dt>
                                    <dd class="col-sm-8"> {{ item.deposit.employer_initial_amount }}</dd>
                                </div>
                                <div class="row col-12 border-top" v-if="item.deposit.must_be_enrolled_employer_date">
                                    <dt class="col-sm-4">დამსაქმებლისგან უნდა ჩაირიცხოს თარიღი:</dt>
                                    <dd class="col-sm-8"> {{ item.deposit.must_be_enrolled_employer_date }}</dd>
                                </div>
                                <div class="row col-12 border-top" v-if="item.deposit.enrolled_employer">
                                    <dt class="col-sm-4">დამსაქმებლისგან ჩაირიცხა:</dt>
                                    <dd class="col-sm-8"> {{ item.deposit.enrolled_employer }}</dd>
                                </div>
                                <div class="row col-12 border-top" v-if="item.deposit.enrolled_employer_date">
                                    <dt class="col-sm-4">დამსაქმებლისგან ჩაირიცხა თარიღი:</dt>
                                    <dd class="col-sm-8"> {{ item.deposit.enrolled_employer_date }}</dd>
                                </div>

                            </dl>
                        </div>
                    </div>

              </div>
              <!-- /.card-body -->
        </template>
        <template #header-status.name_ka="header">
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
        </template>
    </EasyDataTable>
    <!-- {{ statusChangeModal }} -->
    <changeStatus :visible="statusChangeModal" :item="statusItem"></changeStatus>
    <vacancyUpdate :visible="updateModal" :item="item"></vacancyUpdate>
    <vacancyDeposit :visible="depositModal" :item="depositItem"></vacancyDeposit>
</template>
<script>
import { ref, computed } from "vue";
import moment from 'moment'
import Slider from '@vueform/slider'
import "@vueform/slider/themes/default.css";

// import { Header, Item, FilterOption } from "vue3-easy-data-table";
import changeStatus from "../modal/changeStatus.vue";
import vacancyUpdate from "../modal/vacancyUpdate.vue"
import vacancyDeposit from "../modal/vacancyDeposit.vue";
export default {
    components: {
      Slider,
      changeStatus,
      vacancyUpdate,
      vacancyDeposit
    },
    props:{
        data: Object
    },

    setup(props){
        console.log('data',props.data.vacancy);
        const headers = ref([
            { text: "id", value: "code" },
            { text: "კატეგორია", value: "category.name_ka" },
            { text: "გრაფიკი", value: "work_schedule.name_ka"},
            { text: "დამსაქმებელი", value: "employer.name_ka"},
            { text: "ნომერი", value: "employer.number"},
            { text: "სტატუსი", value: "status.name_ka"},
            { text: "ანაზღაურება", value: "payment", sortable: true},
            { text: "საჭიროება", value: "start_date", sortable: true},
            { text: "Operation", value: "operation" },
        ]);

        const items = ref(props.data.vacancy)
        // ref(makeData(props.data.vacancy));
        function makeData(params) {
            var arr = []
            console.log('params',params);
            params.forEach(element => {
                var data = {
                    'id': element.code,
                    'category':element.category.name_ka,
                    'schedule':element.work_schedule.name_ka,
                    'employer':element.employer.name_ka,
                    'number':element.employer.number,
                    'status':element.status.name_ka,
                    'payment':element.payment,
                    'startDate':element.start_date,
                    'workDay':element.additional_schedule_ka,
                    'vacancy_for_who_need':element.vacancy_for_who_need,
                    'title': element.title_ka,
                    'created_at':moment(element.created_at).format("YYYY-MM-DD HH:mm"),
                    'updated_at':moment(element.updated_at).format("YYYY-MM-DD HH:mm"),
                    'comment':element.category,
                    'go_vacation':element.go_vacation,
                    'stay_night': element.stay_night,
                    'work_additional_hours': element.work_additional_hours,
                    'interview_date':element.interview_date,
                    'interview_place':element.interview_place.name_ka,
                    'term':element.term.name_ka,
                    'benefit': element.vacancy_benefit,
                    'duty': element.vacancy_duty,
                    'demand':element.demand,
                    'characteristic':element.characteristic,
                }
                arr.push(data)
            });
            return arr
        }
        const showStatusFilter = ref(false);
        const showCategoryFilter = ref(false);
        const showScheduleFilter = ref(false);
        const showPaymentFilter = ref(false);
        const showIdFilter = ref(false);
        const choseStatus = ref('ყველა');
        const choseCategory = ref('ყველა');
        const choseSchedule = ref('ყველა');
        const chosePayment = ref([500, 1500]);
        const choseId = ref('');
        const filterOptions = computed(()=> {
            const filterOptionsArray =  [];
            if (choseStatus.value !== 'ყველა') {
                filterOptionsArray.push({
                    field: 'status.name_ka',
                    comparison: '=',
                    criteria: choseStatus.value,
                });
            }
            if (choseCategory.value !== 'ყველა') {
                filterOptionsArray.push({
                    field: 'category.name_ka',
                    comparison: '=',
                    criteria: choseCategory.value,
                });

            }
            if (choseSchedule.value !== 'ყველა') {
                filterOptionsArray.push({
                    field: 'work_schedule.name_ka',
                    comparison: '=',
                    criteria: choseSchedule.value,
                });

            }
            if (showPaymentFilter) {
                filterOptionsArray.push({
                    field: 'payment',
                    comparison: 'between',
                    criteria: chosePayment.value,
                });
            }
            if (choseId.value !== '') {
                filterOptionsArray.push({
                    field: 'id',
                    comparison: '=',
                    criteria: choseId.value,
                });

            }

            return filterOptionsArray;
        });

        var statusChangeModal = ref(false)
        var updateModal = ref(false)
        var depositModal = ref(false)
        var selectionPersonalModalShow = ref(false)
        var statusItem = ref()
        var item = ref()
        var depositItem =ref()
        // function statusChange(item) {
        //     statusChangeModal = !statusChangeModal
        //     console.log('statusChangeModal', statusChangeModal);
        //     console.log('item', item);
        // }
        return {
            headers,
            items,
            showStatusFilter,
            choseStatus,
            showCategoryFilter,
            choseCategory,
            showScheduleFilter,
            choseSchedule,
            showPaymentFilter,
            chosePayment,
            showIdFilter,
            choseId,
            filterOptions,
            statusChangeModal,
            statusItem,
            updateModal,
            item,
            depositModal,
            depositItem,
            selectionPersonalModalShow

            // statusChange
        };
    },
    methods:{
        statusChange(item) {
            this.statusChangeModal = !this.statusChangeModal
            this.statusItem = item
        },
        vacancyUpdateModal(item) {
            this.updateModal = !this.updateModal
            this.item = item
        },
        vacancyDepositModal(item) {
            this.depositModal = !this.depositModal
            this.depositItem = item.deposit
        },
        selectionPersonalModal(item){
            this.selectionPersonalModalShow = !this.selectionPersonalModalShow
        }
    }
}
</script>
<style >
    .customize-table {
        --easy-table-border: 1px solid #445269;
        /* --easy-table-row-border: 1px solid #445269; */

        --easy-table-header-font-size: 18px;
         --easy-table-header-height: 50px;
         --easy-table-body-row-font-size: 14px;
         --easy-table-body-row-height: 50px;
        /*--easy-table-header-font-color: #c1cad4;
        --easy-table-header-background-color: #2d3a4f; */

        /* --easy-table-header-item-padding: 10px 15px;

        --easy-table-body-even-row-font-color: #fff;
        --easy-table-body-even-row-background-color: #4c5d7a;

        --easy-table-body-row-font-color: #c0c7d2;
        --easy-table-body-row-background-color: #2d3a4f;
        --easy-table-body-row-height: 50px;
        --easy-table-body-row-font-size: 14px;

        --easy-table-body-row-hover-font-color: #2d3a4f;
        --easy-table-body-row-hover-background-color: #eee;

        --easy-table-body-item-padding: 10px 15px;

        --easy-table-footer-background-color: #2d3a4f;
        --easy-table-footer-font-color: #c0c7d2;
        --easy-table-footer-font-size: 14px;
        --easy-table-footer-padding: 0px 10px;
        --easy-table-footer-height: 50px;

        --easy-table-rows-per-page-selector-width: 70px;
        --easy-table-rows-per-page-selector-option-padding: 10px;
        --easy-table-rows-per-page-selector-z-index: 1;


        --easy-table-scrollbar-track-color: #2d3a4f;
        --easy-table-scrollbar-color: #2d3a4f;
        --easy-table-scrollbar-thumb-color: #4c5d7a;;
        --easy-table-scrollbar-corner-color: #2d3a4f;

        --easy-table-loading-mask-background-color: #2d3a4f; */
    }
</style>
