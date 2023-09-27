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
            <button class="btn btn-info btn-sm" @click="showModal(item)" :disabled="(item.status_id == 10)?true:false">
                <i class="fa fa-plus"></i> დამატება
            </button>
            <button class="btn btn-success btn-sm ml-1" @click="showModal(item)" >
                <i class="fa fa-envelope"></i> sms
            </button>
        </div>

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
                        <div class="col-md-12 ">
                            <hr>
                            <h6>რეკომენდაცია</h6>
                            <hr>
                            <div class='row'>
                                <div v-for="(i, index) in item.recommendation" :key="index" class="col-md-6">
                                    <dl class="row border">
                                        <dt class="col-sm-4">სახელი გვარი :</dt>
                                        <dd class="col-sm-8"> {{ i.pivot.name_ka }}</dd>
                                        <dt class="col-sm-4">ნომერი:</dt>
                                        <dd class="col-sm-8"> {{ i.pivot.number }}</dd>
                                        <!-- <dt class="col-sm-4">სტაჟი:</dt>
                                        <dd class="col-sm-8"> {{ i.name_ka }}</dd> -->

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

     <addPersonalVacancy  :visible="showAddPersonalModal" :item="modalItem" :onMessageFromChildren="handleMessageFromChildren"></addPersonalVacancy>
</template>
<script>
import { ref, computed } from "vue";
import moment from 'moment'
import Slider from '@vueform/slider'
import "@vueform/slider/themes/default.css";
import addPersonalVacancy from "../modal/addPersonalVacancy.vue";
import _ from 'lodash'
// import { Header, Item, FilterOption } from "vue3-easy-data-table";

export default {
    components: {
      Slider,
      addPersonalVacancy,
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
            }else if (!find && _.find(item.qualifying_candidate, function(o) { return o.qualifying_type_id == 4 && o.vacancy.status == 2})) {
                return 'employer-approved'
            }else if (!find && _.find(item.qualifying_candidate, function(o) { return o.qualifying_type_id == 3 && o.vacancy.status == 2})) {
                return 'interviewer'
            }
        };

        function handleMessageFromChildren(id, message) {
            badgeClass.value = message
            items.value[_.findIndex(items.value, function(o) { return o.id == id })].badgeClass = badgeClass.value
        }
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

        // var personalSelectionUrl = ref(url.origin+'/hr/selection_personal')
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
            handleMessageFromChildren
        };
    },
    methods:{
        showModal(item){
            this.showAddPersonalModal = !this.showAddPersonalModal
            this.modalItem = (this.vacancy)?this.vacancy:this.data.vacancy
            this.modalItem['candidate_id'] = (this.itemsSelected.length > 0)?this.itemsSelected.map(({ id }) => id):item.id
        },
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
