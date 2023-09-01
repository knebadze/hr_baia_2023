<template lang="">
    <div>
        <div class="mb-2 d-flex justify-content-end">
            <button class="btn btn-primary" type="button" title="ხელფასის გაცემა" v-if="role_id == 1 && disbursement_of_salary_button" @click="disbursement_of_salary()">
                <i class="fa fa-check"></i> ხელფასის გაცემა
            </button>
        </div>
        <EasyDataTable
            v-model:items-selected="itemsSelected"
            :headers="headers"
            :items="items"
            table-class-name="customize-table"
            border-cell
        >
        <!-- <template #item-category="item">
            <span class="text-primary" v-for="(i, index) in item.get_work_information" :key="index" ><u style="cursor: pointer;" @click="openInfoModal('category', item.get_work_information[index])">{{ i.category.name_ka+', ' }}</u></span>
        </template>-->
        <template #item-status="item">

            <span :class="(!item.disbursement_date)?'badge bg-warning p-1':(item.disbursement_date && item.hr_agree == 0)?'badge bg-danger p-1':'badge bg-success p-1'" >{{ (!item.disbursement_date)?'მიმდინარე':(item.disbursement_date && item.hr_agree == 0)?'დასადასტურებელი':'დადასტურებული' }}</span>
        </template>
        <template #item-operation="item">
           <div class="operation-wrapper">
            <button v-if="role_id == 2" :disabled="(item.disbursement_date)?false:true" class="btn btn-success" type="button" title="დადასტურება">
                <i class="fa fa-check"></i>
            </button>
            <button v-else class="btn btn-success" type="button" title="დანამატის ჩაწერა">
                დანამატი
            </button>
          </div>
        </template>

        </EasyDataTable>
        <!-- {{ statusChangeModal }} -->
        <!-- <infoModal :visible="showInfoModal" :type="modalType" :items="item"></infoModal> -->
    </div>
    </template>
    <script>
    import { ref, computed } from "vue";
    import moment from 'moment'
    import Slider from '@vueform/slider'
    import "@vueform/slider/themes/default.css";
    // import Switch from '../../inc/Switch.vue';
    import _ from 'lodash'
    // import infoModal from '../modal/info_modal.vue'

    export default {
        components: {
            Slider,
            // infoModal,
        },
        props:{
            data: Object,
            role_id: Number,
            // hrId: Number
        },

        setup(props){
            let url = new URL( location.href)
            const itemsSelected = ref([]);
            let updateUrl = ref(url.origin+'/admin/candidate_update')

            var updateModal = ref(false)
            var item = ref()
            // let hr_id = ref(props.hrId)
            let disbursement_of_salary_button = ref(false)



            console.log('data',props.data);
            const headers = ref([
                // { text: "id", value: "id" },
                { text: "ჰრ", value: "hr.user.name_ka" },
                { text: "ფიქსირებული ხელფასი", value: "fixed_salary", sortable: true},
                { text: "ბონუსი ვაკანსიებიდან", value: "hr_bonus_from_vacancy", sortable: true},
                { text: "ბონუსი ფაისანი რეგისტრაციებიდან", value: "hr_bonus_from_paid_registration", sortable: true },
                { text: "ბონუსი უსფასო რეგისტრაციებიდან", value: "hr_bonus_from_free_registration", sortable: true},
                { text: "დანამატი", value: "supplement", sortable: true},
                { text: "სრული ხელფასი", value: "full_salary", sortable: true},
                { text: "დაწყების თარიღი", value: "created_at", sortable: true},
                { text: "გაცემის თარიღი", value: "disbursement_date"},
                { text: "სტატუსი", value: "status", sortable: true},

                { text: "Operation", value: "operation" },
            ]);

            let data =  props.data
            // console.log(data.length);
            for (let i = 0; i < data.length; i++) {
                // Access the element to update in each object
                data[i].created_at = moment(data[i].created_at).format("YYYY-MM-DD HH:mm");
            }
            //  makeData(props.data)

            // cla = ref(props.data.classificatory)
            const items = ref(data)
            console.log('let data', data);


            function makeData(params) {
                var arr = []

                params.forEach(element => {
                    // let map = element.get_work_information.map(item => item.category.name_ka)
                    element.category = map.toString()
                    element.age = age(element.user.date_of_birth)

                    arr.push(element)
                });
                return arr
            }


            return {
                headers,
                items,
                itemsSelected,

                updateModal,
                item,
                updateUrl,

                find,

                disbursement_of_salary_button
                // bodyRowClassNameFunction

                // statusChange
            };
        },
        methods:{
            disbursement_of_salary(){
                let ids = (this.itemsSelected.length > 0)?_.map(this.itemsSelected, 'id'):null
                let currentObj = this
                axios.post('/add_vacancy_personal_was_employed' ,{
                    data: ids,
                })
                .then(function (response) {
                    // handle success
                    console.log(response.data);
                    if (response.status == 200) {
                        toast.success("წარმატებით დაემატა", {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        currentObj.hide()
                        // setTimeout(() => {
                        //     document.location.reload();
                        // }, 1500);
                    }



                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                console.log('this.itemsSelected',ids);
            }
            // openInfoModal(type, item){
            //     this.modalType = type
            //     this.item = item
            //     this.showInfoModal = !this.showInfoModal
            // },
            // addInVacancy(item){
            //     this.showAddInVacancyModal = !this.showAddInVacancyModal
            //     this.item = {'id':item.id}
            // },
            // blackListModal(id){
            //     this.showBlackListModal = !this.showBlackListModal
            //     this.item = {
            //         'id': id,
            //         'type': 'candidate'
            //     }
            // },
            // pdf(item){
            //     event.preventDefault();
            //     this.$swal({
            //         title: 'აირჩიე სრული თუ არასრული ვერსია?',
            //         cancelButtonText:'არასრული',
            //         confirmButtonText: 'სრული',
            //         showCancelButton: true,
            //     }).then((result) => {
            //         console.log('result', result);
            //         if (result.isConfirmed) {

            //             window.location.href = `/candidate_full_pdf?data=${item}`
            //         } else if (result.isDismissed) {
            //             window.location.href = `/candidate_partial_pdf?data=${item}`
            //         }
            //     })
            // },
            // openSendMessageModal(item){
            //     console.log('item', item);
            //     // return
            //     this.showSendMessageModal = !this.showSendMessageModal
            //     this.item = {'id': item.id, 'number': item.user.number}
            // },
            // enrolled(item){
            //     this.showEnrolledModal = !this.showEnrolledModal
            //     this.item = item.register_log
            //     this.item['name'] = item.name_ka
            // },
            // candidateDelete(id){
            //     let currentObj = this
            //     this.$swal({
            //         title: 'ნამდვილად გსურთ წაშლა?',
            //         // html:'ცვლილება ავტომატურად მოხსნის კანდიდატს ვაკანის დასაქმებული სტატუსიდან',
            //         //   showDenyButton: true,
            //         cancelButtonText:'არა',
            //         confirmButtonText: 'კი',
            //         showCancelButton: true,
            //     }).then((result) => {
            //     /* Read more about isConfirmed, isDenied below */
            //     // return
            //         if (result.isConfirmed) {
            //             axios({
            //                 method: "post",
            //                 url: "/delete_candidate",
            //                 data: {'id': id},

            //             })
            //             .then(function (response) {
            //                 // console.log(response.data);
            //                 if (response.data.status == 200) {

            //                     toast.success('წარმატებით წაიშალა', {
            //                         theme: 'colored',
            //                         autoClose: 1000,
            //                     });
            //                     setTimeout(() => {
            //                         document.location.reload();
            //                     }, 1500);

            //                 }
            //             })
            //             .catch(function (error) {
            //                 // handle error
            //                 console.log(error);
            //             })

            //         } else if (result.isDenied) {
            //             return
            //         }
            //     });
            // }

        },
        watch:{
            itemsSelected: {
                handler(newValue, oldValue) {

                    if (newValue.length > 0) {
                        this.disbursement_of_salary_button = true
                    }else{
                        this.disbursement_of_salary_button = false
                    }
                    console.log('newValue', newValue);

                },
                deep: true
            },
        }
    }
    </script>
    <style >
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
