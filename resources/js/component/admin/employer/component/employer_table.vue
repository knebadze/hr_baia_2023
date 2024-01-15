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
                    <a class="dropdown-item" href="#"  @click="openUpdateModal(item)">რედაქტირება</a>
                    <a class="dropdown-item" :href="attachedUrl+'/'+item.id">მიბმული ვაკანსიები</a>
                    <a v-if="item.number_code_id == 79" class="dropdown-item" href="#" @click="openSendMessageModal(item)">სმს</a>
                    <a class="dropdown-item" href="#" @click="blackListModal(item.id)">შავ სიაში დამატება</a>
                    <a v-if="role_id == 1" class="dropdown-item" href="#" @click="candidateDelete(item.id)"> წაშლა</a>

                </div>
            </div>
          </div>
        </template>
        </EasyDataTable>

        <component  :is="updateComponent" v-if="updateComponent" :visible="showUpdateModal" :item="item"></component>
        <component  :is="blackListComponent" v-if="blackListComponent" :visible="showBlackListModal" :item="item" :type="'employer'"></component>
        <component  :is="sendMessageComponent" v-if="sendMessageComponent" :visible="showSendMessageModal" :item="item"></component>
    </div>
    </template>
    <script>
    import { ref, computed } from "vue";
    import moment from 'moment'
    import Slider from '@vueform/slider'
    import "@vueform/slider/themes/default.css";
    // import Switch from '../../inc/Switch.vue';
    import _ from 'lodash'
    import { markRaw } from 'vue';
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
            let attachedUrl = ref(url.origin+'/admin/employer_vacancy')
            let relevantUrl = ref(url.origin+'/admin/relevant_vacancy')
            var showUpdateModal = ref(false)
            var showAddInVacancyModal = ref(false)
            let showBlackListModal = ref(false);
            let showSendMessageModal = ref(false)
            var updateModal = ref(false)
            var item = ref()
            let modalType = ref('')
            let updateComponent = ref(null);
            let blackListComponent = ref(null);
            let sendMessageComponent = ref(null);


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


                showUpdateModal,
                updateComponent,
                showBlackListModal,
                blackListComponent,
                showAddInVacancyModal,
                showSendMessageModal,
                sendMessageComponent,
                updateModal,
                item,
                modalType,
                updateUrl,
                attachedUrl,
                relevantUrl,

                find

                // statusChange
            };
        },
        methods:{
            async openUpdateModal(item){
                this.item = item
                if (!this.updateComponent) {
                    let module = await import('../modal/update_modal.vue');
                    this.updateComponent = markRaw(module.default);
                }
                this.showUpdateModal = !this.showUpdateModal
            },
            // addInVacancy(item){
            //     this.showAddInVacancyModal = !this.showAddInVacancyModal
            //     this.item = {'id':item.id}
            // },
            async blackListModal(id){
                if (!this.blackListComponent) {
                    let module = await import('../../candidate/modal/add_black_list.vue');
                    this.blackListComponent = markRaw(module.default);
                }
                this.showBlackListModal = !this.showBlackListModal
                this.item = {
                    'id': id
                }
            },
            async openSendMessageModal(item){
                // return
                if (!this.sendMessageComponent) {
                    let module = await import('../../candidate/modal/send_message_modal.vue');
                    this.sendMessageComponent = markRaw(module.default);
                }
                this.showSendMessageModal = !this.showSendMessageModal
                this.item = {'id': item.id, 'number': item.number}
            },


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
