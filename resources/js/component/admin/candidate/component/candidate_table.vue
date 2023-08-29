<template lang="">
<div>
    <EasyDataTable
        v-model:items-selected="itemsSelected"
        :headers="headers"
        :items="items"
        table-class-name="customize-table"
        :body-row-class-name="bodyRowClassNameFunction"
        border-cell
        :filter-options="filterOptions"
    >
    <template #item-category="item">
        <span class="text-primary" v-for="(i, index) in item.get_work_information" :key="index" ><u style="cursor: pointer;" @click="openInfoModal('category', item.get_work_information[index])">{{ i.category.name_ka+', ' }}</u></span>
    </template>
    <template #item-status="item">

        <span :class="`badge bg-${item.status.color} p-1`" >{{ item.status.name_ka }}</span>
    </template>
    <template #item-operation="item">
       <div class="operation-wrapper">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-cog"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

                <a class="dropdown-item"  :href="updateUrl+'/'+item.id">რედაქტირება</a>
                <!-- <a v-if="item.status_id == 10 || item.status_id == 11" class="dropdown-item" href="#" @click="freedom(item.id)">თავისუალი სტატუსი</a> -->
                <a v-if="item.status_id != 10 && item.status_id != 12" class="dropdown-item" href="#" @click="addInVacancy(item)">ვაკანსიაში დამატება</a>
                <a class="dropdown-item" :href="attachedUrl+'/'+item.id">მიბმული ვაკანსიები</a>
                <a class="dropdown-item" :href="relevantUrl+'/'+item.id">შესაბამისი ვაკანსიები</a>
                <a v-if="item.status_id == 11 || item.status_id == 14" class="dropdown-item" href="#" @click="scheduleModal(item.id)">გრაფიკი</a>
                <a v-if="item.user.register_log && item.user.register_log.creator_id == hrId && item.user.register_log.enroll_date" href="#" class="dropdown-item" >ჩარიცხა</a>
                <a class="dropdown-item" href="#"  @click="pdf(item)">ჩამოტვირთვა</a>
                <a class="dropdown-item" href="#" @click="openSendMessageModal(item)">სმს</a>
                <a v-if="item.status_id == 9" class="dropdown-item" href="#" @click="blackListModal(item.id)">შავ სიაში დამატება</a>
                <a v-if="role_id == 1" class="dropdown-item" href="#" @click="candidateDelete(item.id)"> წაშლა</a>

            </div>
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
                                <div class="row col-12" v-if="item.user.register_log">
                                    <dt class="col-sm-4">რეგისტრაციის ტიპი:</dt>
                                    <dd class="col-sm-8">{{ (item.user.register_log.type == 1)?'ფასიანი რეგისტრაცია':'უფასო რეგისტრაცია' }} </dd>
                                </div>
                                <dt class="col-sm-4">პირადი ნომერი:</dt>
                                <dd class="col-sm-8">{{ item.personal_number }}</dd>
                                <dt class="col-sm-4">ეროვნება:</dt>
                                <dd class="col-sm-8">{{ item.nationality.name_ka }}</dd>
                                <dt class="col-sm-4">მოქალაქეობა:</dt>
                                <dd class="col-sm-8">{{ item.citizenship.map(i => i.name_ka).join(', ') }}</dd>
                                <dt class="col-sm-4">რელიგია:</dt>
                                <dd class="col-sm-8">{{ item.religion.name_ka }}</dd>
                                <dt class="col-sm-4">ოჯახური მდგომარეობა:</dt>
                                <dd class="col-sm-8">{{ item.marital_status.name_ka }}</dd>
                                <div class="row col-12" v-if="item.children">
                                    <dt class="col-sm-4">შვილები:</dt>
                                    <dd class="col-sm-8">{{ item.children+' - '+item.children_age }} </dd>
                                </div>
                                <div class="row col-12" v-if="item.spouse">
                                    <dt class="col-sm-4">მეუღლე:</dt>
                                    <dd class="col-sm-8">{{ item.spouse }} </dd>
                                </div>
                                <dt class="col-sm-4">განათლება:</dt>
                                <dd class="col-sm-8">{{ item.education.name_ka }}</dd>
                                <dt class="col-sm-4">პროფესია:</dt>
                                <dd class="col-sm-8">{{ item.professions.map(i => i.name_ka).join(', ') }}</dd>
                                <dt class="col-sm-4">სპეციალობა:</dt>
                                <dd class="col-sm-8">{{ item.specialty.map(i => i.name_ka).join(', ') }}</dd>
                                <dt class="col-sm-4">უცხო ენა:</dt>
                                <dd class="col-sm-8">{{ item.get_language.map(i => i.language.name_ka+ ' - '+ i.level.name_ka ).join(', ') }}</dd>
                                <div class="row col-12" v-if="item.driving_license">
                                    <dt class="col-sm-4">მართვის მოწმობა:</dt>
                                    <dd class="col-sm-8">{{ item.driving_license.map(i => i.name).join(', ') }} </dd>
                                </div>
                                <div class="row col-12" v-if="item.allergy">
                                    <dt class="col-sm-4">ალერგია:</dt>
                                    <dd class="col-sm-8">{{ item.allergy.map(i => i.name_ka).join(', ') }} </dd>
                                </div>
                                <dt class="col-sm-4">სამუშაი გამოცდილება:</dt>
                                <dd class="col-sm-8 text-primary" @click="openInfoModal('general_work', item.general_work_experience)"><u style="cursor: pointer;">{{ (item.general_work_experience == 0)?'არა':'კი' }}</u></dd>
                                <dt class="col-sm-4">ოჯახში მუშაობის გამოცდილება:</dt>
                                <dd class="col-sm-8 text-primary" @click="openInfoModal('family_work', item.family_work_experience)"><u style="cursor: pointer;">{{ (item.family_work_experience == 0)?'არა':'კი' }}</u></dd>


                            </dl>
                        </div>
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">დამატების თარიღი:</dt>
                                <dd class="col-sm-8">{{ item.created_at }}</dd>
                                <dt class="col-sm-4">სიმაღლე:</dt>
                                <dd class="col-sm-8">{{ item.height+' სმ' }}</dd>
                                <dt class="col-sm-4">წონა:</dt>
                                <dd class="col-sm-8">{{ item.weight+ ' კგ' }}</dd>
                                <dt class="col-sm-4">მოწევა:</dt>
                                <dd class="col-sm-8">{{ (item.smoke == 0)?'არა':'კი' }}</dd>
                                <dt class="col-sm-4">ნასამართლეობა:</dt>
                                <dd class="col-sm-8">{{ (item.convection  == 0)?'არა':'კი' }}</dd>
                                <dt class="col-sm-4">საზღვარგარეთ მუშაობა:</dt>
                                <dd class="col-sm-8">{{ (item.work_abroad == 0)?'არა':'კი' }}</dd>
                                <div class="row col-12" v-if="item.characteristic">
                                    <dt class="col-sm-4">მახასიათებლები:</dt>
                                    <dd class="col-sm-8">{{ item.characteristic.map(i => i.name_ka).join(', ') }} </dd>
                                </div>
                                <dt class="col-sm-4">დაბადების თარიღი:</dt>
                                <dd class="col-sm-8">{{ item.user.date_of_birth }}</dd>
                                <div class="row col-12" v-if="item.medical_info_ka">
                                    <dt class="col-sm-4">მახასიათებლები:</dt>
                                    <dd class="col-sm-8">{{ item.medical_info_ka }} </dd>
                                </div>

                                <dt class="col-sm-4">რეკომენდაცია:</dt>
                                <dd class="col-sm-8 text-primary" @click="openInfoModal('recommendation', item.recommendation)"><u style="cursor: pointer;">{{ (item.recommendation == 0)?'არა':'კი' }}</u></dd>

                            </dl>
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
    <infoModal :visible="showInfoModal" :type="modalType" :items="item"></infoModal>
    <add_in_vacancy :visible="showAddInVacancyModal" :item="item"></add_in_vacancy>
    <add_black_list :visible="showBlackListModal" :item="item"></add_black_list>
    <send_message_modal :visible="showSendMessageModal" :item="item"></send_message_modal>
</div>
</template>showSendMessageModal
<script>
import { ref, computed } from "vue";
import moment from 'moment'
import Slider from '@vueform/slider'
import "@vueform/slider/themes/default.css";
// import Switch from '../../inc/Switch.vue';
import _ from 'lodash'
import infoModal from '../modal/info_modal.vue'
import add_in_vacancy from "../modal/add_in_vacancy.vue";
import add_black_list from '../modal/add_black_list.vue'
import send_message_modal from '../modal/Send_message_modal.vue'

export default {
    components: {
        Slider,
        infoModal,
        add_in_vacancy,
        add_black_list,
        send_message_modal
    },
    props:{
        data: Object,
        role_id: Number,
        hrId: Number
    },

    setup(props){
        let url = new URL( location.href)
        const itemsSelected = ref([]);
        let updateUrl = ref(url.origin+'/admin/candidate_update')
        let attachedUrl = ref(url.origin+'/admin/vacancy_attached')
        let relevantUrl = ref(url.origin+'/admin/relevant_vacancy')

        var showInfoModal = ref(false)
        var showAddInVacancyModal = ref(false)
        let showBlackListModal = ref(false);
        let showSendMessageModal = ref(false)
        var updateModal = ref(false)
        var item = ref()
        let modalType = ref('')
        let cla = ref(null);
        let hr_id = ref(props.hrId)



        console.log('data',props.data);
        const headers = ref([
            { text: "id", value: "id" },
            { text: "სახელი გვარი", value: "user.name_ka" },
            { text: "ნომერი", value: "user.number"},
            { text: "ასაკი", value: "age", sortable: true},
            { text: "კატეგორია", value: "category" },
            { text: "სტატუსი", value: "status"},
            { text: "დამატების თარიღი", value: "created_at", sortable: true},
            { text: "Operation", value: "operation" },
        ]);
        let data = makeData(props.data)

        // cla = ref(props.data.classificatory)
        const items = ref(data)
        console.log('let data', data);


        function makeData(params) {
            var arr = []

            params.forEach(element => {
                let map = element.get_work_information.map(item => item.category.name_ka)
                element.category = map.toString()
                element.age = age(element.user.date_of_birth)

                arr.push(element)
            });
            return arr
        }
        function age(date_of_birth){
            var dob = new Date(date_of_birth)
            var diff_ms = Date.now() - dob.getTime();
            var age_dt = new Date(diff_ms);
            return Math.abs(age_dt.getUTCFullYear() - 1970);
        }

        const showStatusFilter = ref(false);
        const showCategoryFilter = ref(false);
        const showScheduleFilter = ref(false);
        const showPaymentFilter = ref(false);
        const showIdFilter = ref(false);
        const choseStatus = ref('ყველა');
        const choseCategory = ref('ყველა');
        const choseSchedule = ref('ყველა');
        const chosePayment = ref([50, 3000]);
        const choseId = ref('');
        const filterOptions = computed(()=> {
            const filterOptionsArray =  [];
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
        const bodyRowClassNameFunction = ( item, number) => {
            if (item.user.register_log && item.user.register_log.creator_id == hr_id.value) return 'my-candidate-row';
            return '';
        };



        return {
            headers,
            items,
            itemsSelected,
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

            showInfoModal,
            showAddInVacancyModal,
            showBlackListModal,
            showSendMessageModal,
            updateModal,
            item,
            modalType,
            updateUrl,
            attachedUrl,
            relevantUrl,

            cla,
            find,
            bodyRowClassNameFunction

            // statusChange
        };
    },
    methods:{
        openInfoModal(type, item){
            this.modalType = type
            this.item = item
            this.showInfoModal = !this.showInfoModal
        },
        addInVacancy(item){
            this.showAddInVacancyModal = !this.showAddInVacancyModal
            this.item = {'id':item.id}
        },
        blackListModal(id){
            this.showBlackListModal = !this.showBlackListModal
            this.item = {
                'id': id,
                'type': 'candidate'
            }
        },
        pdf(item){
            event.preventDefault();
            this.$swal({
                title: 'აირჩიე სრული თუ არასრული ვერსია?',
                cancelButtonText:'არასრული',
                confirmButtonText: 'სრული',
                showCancelButton: true,
            }).then((result) => {
                console.log('result', result);
                if (result.isConfirmed) {

                    window.location.href = `/candidate_full_pdf?data=${item}`
                } else if (result.isDismissed) {
                    window.location.href = `/candidate_partial_pdf?data=${item}`
                }
            })
        },
        openSendMessageModal(item){
            console.log('item', item);
            // return
            this.showSendMessageModal = !this.showSendMessageModal
            this.item = {'id': item.id, 'number': item.user.number}
        },
        candidateDelete(id){
            let currentObj = this
            this.$swal({
                title: 'ნამდვილად გსურთ წაშლა?',
                // html:'ცვლილება ავტომატურად მოხსნის კანდიდატს ვაკანის დასაქმებული სტატუსიდან',
                //   showDenyButton: true,
                cancelButtonText:'არა',
                confirmButtonText: 'კი',
                showCancelButton: true,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            // return
                if (result.isConfirmed) {
                    axios({
                        method: "post",
                        url: "/delete_candidate",
                        data: {'id': id},

                    })
                    .then(function (response) {
                        // console.log(response.data);
                        if (response.data.status == 200) {

                            toast.success('წარმატებით წაიშალა', {
                                theme: 'colored',
                                autoClose: 1000,
                            });
                            setTimeout(() => {
                                document.location.reload();
                            }, 1500);

                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })

                } else if (result.isDenied) {
                    return
                }
            });
        }

    }
}
</script>
<style >
    .my-candidate-row  {
        --easy-table-body-row-background-color: #f8b1b1;
        --easy-table-body-row-font-color: #070707;
    }
    .customize-table {
        --easy-table-border: 1px solid #445269;
        --easy-table-header-font-size: 18px;
        --easy-table-header-height: 50px;
        --easy-table-body-row-font-size: 14px;
        --easy-table-body-row-height: 50px;
    }
</style>
