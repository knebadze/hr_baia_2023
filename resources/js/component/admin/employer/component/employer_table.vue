<template lang="">
    <div>
        <EasyDataTable
            :headers="headers"
            :items="items"
            table-class-name="customize-table"
            border-cell
        >
        <template #item-operation="item">
           <div class="operation-wrapper">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item"  :href="updateUrl+'/'+item.id">რედაქტირება</a>
                    <a class="dropdown-item" :href="attachedUrl+'/'+item.id">მიბმული ვაკანსიები</a>
                    <a class="dropdown-item" href="#" @click="openSendMessageModal(item)">სმს</a>
                    <a class="dropdown-item" href="#" @click="blackListModal(item.id)">შავ სიაში დამატება</a>
                    <a v-if="role_id == 1" class="dropdown-item" href="#" @click="candidateDelete(item.id)"> წაშლა</a>

                </div>
            </div>
          </div>
        </template>
        </EasyDataTable>
        <!-- {{ statusChangeModal }} -->
        <!-- <infoModal :visible="showInfoModal" :type="modalType" :items="item"></infoModal>
        <add_in_vacancy :visible="showAddInVacancyModal" :item="item"></add_in_vacancy>
        <add_black_list :visible="showBlackListModal" :item="item"></add_black_list>
        <send_message_modal :visible="showSendMessageModal" :item="item"></send_message_modal> -->
    </div>
    </template>showSendMessageModal
    <script>
    import { ref, computed } from "vue";
    import moment from 'moment'
    import Slider from '@vueform/slider'
    import "@vueform/slider/themes/default.css";
    // import Switch from '../../inc/Switch.vue';
    import _ from 'lodash'
    // import infoModal from '../modal/info_modal.vue'
    // import add_in_vacancy from "../modal/add_in_vacancy.vue";
    // import add_black_list from '../modal/add_black_list.vue'
    // import send_message_modal from '../modal/Send_message_modal.vue'

    export default {
        components: {
            Slider,
            // infoModal,
            // add_in_vacancy,
            // add_black_list,
            // send_message_modal
        },
        props:{
            data: Object,
            role_id: Number
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



            console.log('data.props',props.data);
            const headers = ref([
                { text: "id", value: "id" },
                { text: "სახელი გვარი", value: "name_ka" },
                { text: "ნომერი", value: "number"},
                { text: "მაილი", value: "email"},
                { text: "მისამართი", value: "address_ka"},
                { text: "დამატების თარიღი", value: "created_at", sortable: true},
                { text: "Operation", value: "operation" },
            ]);
            let data = props.data
            // makeData(props.data)

            // cla = ref(props.data.classificatory)
            for (let i = 0; i < data.length; i++) {
                // Access the element to update in each object
                data[i].created_at = moment(data[i].created_at).format("YYYY-MM-DD HH:mm");
            }
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





            return {
                headers,
                items,
                itemsSelected,


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
                find

                // statusChange
            };
        },
        methods:{
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
            // openSendMessageModal(item){
            //     console.log('item', item);
            //     // return
            //     this.showSendMessageModal = !this.showSendMessageModal
            //     this.item = {'id': item.id, 'number': item.user.number}
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

        }
    }
    </script>
    <style >
        /* .my-vacancy-row  {
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
