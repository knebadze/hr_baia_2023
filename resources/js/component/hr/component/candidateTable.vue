<template lang="">
    <EasyDataTable
        buttons-pagination
        :headers="headers"
        :items="items"
        table-class-name="customize-table"
        border-cell

    >
    <!-- :filter-options="filterOptions" -->
    <template #item-operation="item">
       <div class="operation-wrapper">
        <button class="btn btn-info btn-sm" @click="deleteItem(item)">
            <i class="fa fa-plus"></i> დამატება
        </button>
      </div>
    </template>
        <template #expand="item">
            <!-- {{ item }} -->
              <!-- /.card-header -->
              <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <img :src="'/images/user-avatar/'+item.user.avatar" alt="#" style="height:100px">
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">მისამართი:</dt>
                                <dd class="col-sm-8">{{ item.address_ka }}</dd>
                                <dt class="col-sm-4">ეროვნება:</dt>
                                <dd class="col-sm-8">{{ item.nationality.name_ka }}</dd>
                                <dt class="col-sm-4">მოქალაქეობა:</dt>
                                <dd class="col-sm-8"><span v-for="(i, index) in item.citizenship" :key="index">{{ i.name_ka+', ' }}</span> </dd>
                                <dt class="col-sm-4">რელიგია:</dt>
                                <dd class="col-sm-8">{{ item.religion.name_ka }}</dd>
                                <dt class="col-sm-4">განათლება:</dt>
                                <dd class="col-sm-8">{{ item.education.name_ka }}</dd>
                                <dt class="col-sm-4">პროფესია:</dt>
                                <dd class="col-sm-8"><span v-for="(i, index) in item.professions" :key="index">{{ i.name_ka+', ' }}</span> </dd>
                                <dt class="col-sm-4">სპეციალობა:</dt>
                                <dd class="col-sm-8"><span v-for="(i, index) in item.specialty" :key="index">{{ i.name_ka+', ' }}</span> </dd>
                                <dt class="col-sm-4">უცხო ენა:</dt>
                                <dd class="col-sm-8"><span v-for="(i, index) in item.get_language" :key="index">{{ i.language.name_ka+ ' - '+i.level.name_ka+', ' }}</span> </dd>
                                <dt class="col-sm-4">ალერგია:</dt>
                                <dd class="col-sm-8"><span v-for="(i, index) in item.allergy" :key="index">{{ i.name_ka+', ' }}</span> </dd>
                                <div class="row col-12" v-if="item.medical_info_ka">
                                    <dt class="col-sm-4">სამედიცინო ინფორმაცია:</dt>
                                    <dd class="col-sm-8">{{ item.medical_info_ka }} </dd>
                                </div>
                                <div class="row col-12" v-if="item.driving_license">
                                    <dt class="col-sm-4">მართვის მოწმობა:</dt>
                                    <dd class="col-sm-8"><span v-for="(i, index) in item.driving_license" :key="index">{{ i.name+', ' }}</span> </dd>
                                </div>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">მაილი:</dt>
                                <dd class="col-sm-8">{{ item.user.email }}</dd>
                                <dt class="col-sm-4">დაბადების თარიღი:</dt>
                                <dd class="col-sm-8">{{ item.user.date_of_birth }}</dd>
                                <dt class="col-sm-4">სიმაღლე:</dt>
                                <dd class="col-sm-8">{{ item.height }}</dd>
                                <dt class="col-sm-4">წონა:</dt>
                                <dd class="col-sm-8">{{ item.weight }}</dd>
                                <dt class="col-sm-4">სქესი:</dt>
                                <dd class="col-sm-8">{{ item.user.gender.name_ka }}</dd>
                                <dt class="col-sm-4">ოჯახური მდგომარეობა:</dt>
                                <dd class="col-sm-8">{{ item.marital_status.name_ka }}</dd>
                                <div class="row col-12" v-if="item.children">
                                    <dt class="col-sm-4">შვილების რაოდენობა:</dt>
                                    <dd class="col-sm-8">{{ item.children }} </dd>
                                </div>
                                <div class="row col-12" v-if="item.children_age">
                                    <dt class="col-sm-4">შვილებისა ასაკი:</dt>
                                    <dd class="col-sm-8">{{ item.children_age }} </dd>
                                </div>
                                <div class="row col-12" v-if="item.spouse">
                                    <dt class="col-sm-4">მეუღლე:</dt>
                                    <dd class="col-sm-8">{{ item.spouse }} </dd>
                                </div>
                                <dt class="col-sm-4">ნასამართლეობა:</dt>
                                <dd class="col-sm-8">{{ (item.convection == 0)?'არა':'კი' }}</dd>
                                <dt class="col-sm-4">მწეველი:</dt>
                                <dd class="col-sm-8">{{ (item.smoke == 0)?'არა':'კი' }}</dd>
                                <dt class="col-sm-4">იმუშავებს საზღვარგარეთ:</dt>
                                <dd class="col-sm-8">{{ (item.work_abroad == 0)?'არა':'კი' }}</dd>

                            </dl>
                        </div>
                        <div class="col-md-12 ">
                            <hr>
                            <h6>უნდა დასაქმება</h6>
                            <hr>
                            <div class="row">
                                <div v-for="(i, index) in item.get_work_information" :key="index" class="col-md-6">
                                    <dl class="row border">
                                        <dt class="col-sm-4">კატეგორია:</dt>
                                        <dd class="col-sm-8"> {{ i.category.name_ka }}</dd>
                                        <dt class="col-sm-4">სამუშაო გრაფიკი:</dt>
                                        <dd class="col-sm-8"><span v-for="(x, index) in i.work_schedule" :key="index" >{{ x.name_ka+', ' }}</span> </dd>
                                        <div class="row col-12" v-if="i.additional_schedule_ka">
                                            <dt class="col-sm-4">დამატებითი გრაფიკი:</dt>
                                            <dd class="col-sm-8">{{ i.additional_schedule_ka }} </dd>
                                        </div>
                                        <dt class="col-sm-4">ანაზღაურება:</dt>
                                        <dd class="col-sm-8"> {{ i.payment +' '+ i.currency.icon }}</dd>
                                        <dt class="col-sm-4">ღამე დარჩენა:</dt>
                                        <dd class="col-sm-8">{{ (i.stay_night == 0)?'არა':'კი' }}</dd>
                                        <dt class="col-sm-4">არდადეგებზე გაყოლა:</dt>
                                        <dd class="col-sm-8">{{ (i.go_vacation == 0)?'არა':'კი' }}</dd>
                                        <dt class="col-sm-4">დამატებითი საათები მუშაობა:</dt>
                                        <dd class="col-sm-8">{{ (i.work_additional_hours == 0)?'არა':'კი' }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 ">
                            <hr>
                            <h6>ოჯახში მუშაობის გამოცდილება</h6>
                            <hr>
                            <div class='row'>
                                <div v-if="item.family_work_experience.experience == 1" class="col-md-12">
                                    <dl class="row border" >
                                        <dt class="col-sm-4">რამდენ ოჯახში:</dt>
                                        <dd class="col-sm-8"> {{ item.family_work_experience.families_worked_count }}</dd>
                                        <dt class="col-sm-4">ყველაზე ხანგრძლივად:</dt>
                                        <dd class="col-sm-8"> {{ item.family_work_experience.longest.name_ka }}</dd>
                                        <dt class="col-sm-4">სტაჟი სულ:</dt>
                                        <dd class="col-sm-8"> {{ item.family_work_experience.work_experience.name_ka }}</dd>

                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 ">
                            <hr>
                            <h6>ზოგადი სამუშაო გამოცდილება</h6>
                            <hr>
                            <div class='row'>
                                <div v-for="(i, index) in item.general_work_experience" :key="index" class="col-md-6">
                                    <dl class="row border">
                                        <dt class="col-sm-4">ობიექტი :</dt>
                                        <dd class="col-sm-8"> {{ i.pivot.object_ka }}</dd>
                                        <dt class="col-sm-4">პოზიცია:</dt>
                                        <dd class="col-sm-8"> {{ i.pivot.position_ka }}</dd>
                                        <dt class="col-sm-4">სტაჟი:</dt>
                                        <dd class="col-sm-8"> {{ i.name_ka }}</dd>

                                    </dl>
                                </div>
                            </div>
                        </div>


                    </div>





              </div>
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
    <!-- <changeStatus :visible="statusChangeModal" :item="statusItem"></changeStatus>
    <vacancyUpdate :visible="updateModal" :item="item"></vacancyUpdate>
    <vacancyDeposit :visible="depositModal" :item="depositItem"></vacancyDeposit> -->
</template>
<script>
import { ref, computed } from "vue";
import moment from 'moment'
import Slider from '@vueform/slider'
import "@vueform/slider/themes/default.css";

// import { Header, Item, FilterOption } from "vue3-easy-data-table";
// import changeStatus from "../modal/changeStatus.vue";
// import vacancyUpdate from "../modal/vacancyUpdate.vue"
// import vacancyDeposit from "../modal/vacancyDeposit.vue";
export default {
    components: {
      Slider,
    //   changeStatus,
    //   vacancyUpdate,
    //   vacancyDeposit
    },
    props:{
        data: Object
    },

    setup(props){
        console.log('data',props.data);
        const headers = ref([
            { text: "id", value: "id" },
            { text: "სახელი გვარი", value: "user.name_ka"},
            { text: "ნომერი", value: "user.number"},
            { text: "პირადი ნომერი", value: "personal_number"},
            // { text: "კატეგორია", value: "get_work_information.category.name_ka" },
            // { text: "გრაფიკი", value: "get_work_information.work_schedule.name_ka"},

            // { text: "სტატუსი", value: "status.name_ka"},
            // { text: "ანაზღაურება", value: "get_work_information.payment", sortable: true},
            { text: "დამატების თარიღი", value: "created_at", sortable: true},
            { text: "Operation", value: "operation" },
        ]);

        // console.log('data',props.data);
        const items = ref(props.data);
        // ref(props.data)
        // ref(makeData(props.data.vacancy));
        function makeData(params) {
            var arr = []
            console.log('params',params);
            params.forEach(element => {
                console.log('element', element);
                var data = {
                    'id': element.id,
                    'name': element.user.name_ka,
                    'number':element.user.number,
                    // 'status':element.status.name_ka,
                    'personal_number':element.personal_number,
                    'created_at':moment(element.created_at).format("YYYY-MM-DD HH:mm"),
                }
                arr.push(data)
            });
            return arr
        }
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

        // var personalSelectionUrl = ref(url.origin+'/hr/selection_personal')
        // console.log(personalSelectionUrl);

        // var statusChangeModal = ref(false)
        // var updateModal = ref(false)
        // var depositModal = ref(false)
        // var selectionPersonalModalShow = ref(false)
        // var statusItem = ref()
        // var item = ref()
        // var depositItem =ref()
        // function statusChange(item) {
        //     statusChangeModal = !statusChangeModal
        //     console.log('statusChangeModal', statusChangeModal);
        //     console.log('item', item);
        // }
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
            // statusChangeModal,
            // statusItem,
            // updateModal,
            // item,
            // depositModal,
            // depositItem,
            // selectionPersonalModalShow,
            // personalSelectionUrl

            // statusChange
        };
    },
    methods:{
        // statusChange(item) {
        //     this.statusChangeModal = !this.statusChangeModal
        //     this.statusItem = item
        // },
        // vacancyUpdateModal(item) {
        //     this.updateModal = !this.updateModal
        //     this.item = item
        // },
        // vacancyDepositModal(item) {
        //     this.depositModal = !this.depositModal
        //     this.depositItem = item.deposit
        // },
        // selectionPersonalModal(item){
        //     this.selectionPersonalModalShow = !this.selectionPersonalModalShow
        // }
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
    }
</style>
