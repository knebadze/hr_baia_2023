<template lang="">
    <div>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-cog"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <a v-if="item.status.id != 4 && item.status.id != 5" class="dropdown-item" href="#" @click="openModal(item, 1)">რედაქტირება</a>
                <a v-if="item.status.id != 3 && item.status.id != 4 && item.status.id != 5" class="dropdown-item" href="#" @click="openModal(item, 2)">სტატუსის შეცვლა</a>
                <a v-if="item.status.id == 2" class="dropdown-item" :href="personalSelectionUrl+'/'+item.id" >კადრების შერჩევა</a>
                <a v-if="item.status.id > 1" class="dropdown-item" :href="vacancyPersonalUrl+'/'+item.id" >შერჩეული კადრები</a>
                <a v-if="item.hr_id == hr_id" class="dropdown-item" href="#" @click="openModal(item, 3)">შეხსენება</a>
                <a v-if="item.hr_id == hr_id &&  item.status.id != 4 && item.status.id != 5 " class="dropdown-item" :href="vacancyDepositUrl+'/'+item.id" >დეპოზიტი</a>
                <a v-if="item.status.id == 4 || item.status.id == 5" class="dropdown-item" href="#"  @click="openModal(item, 4)">გამეორება</a>
                <a v-if="item.status.id !== 3 && item.status.id !== 4 && item.status.id !== 5" class="dropdown-item" href="#" @click="carryInHead(item)">აპინვა </a>
                <a class="dropdown-item" href="#" @click="openModal(item.id, 5)">ისტორია</a>
            </div>
        </div>
        <vacancyUpdate
            :visible="showUpdateModal"
            :item="modalData"
        ></vacancyUpdate>
        <changeStatus
            :visible="showStatusModal"
            :item="modalData"
        ></changeStatus>
        <vacancyReminder
            :visible="showReminderModal"
            :item="modalData"
            :roleId="roleId"
        ></vacancyReminder>
        <vacancyRepeat
            :visible="showRepeatModal"
            :item="modalData"
        ></vacancyRepeat>
        <redactedHistory
            :visible="showHistoryModal"
            :item="modalData"
        ></redactedHistory>
    </div>
</template>
<script>
import { ref, computed, nextTick  } from "vue";
// import { markRaw } from 'vue';
import vacancyUpdate from "../modal/vacancyUpdate.vue"
import changeStatus from "../modal/changeStatus.vue";
import vacancyReminder from "../modal/vacancyReminder.vue";
import vacancyRepeat from "../../../hr/modal/vacancyRepeat.vue";
import redactedHistory from "../../../hr/modal/redactedHistory.vue"
import Swal from 'sweetalert2';
export default {
    components:{
        vacancyUpdate,
        changeStatus,
        vacancyReminder,
        vacancyRepeat,
        redactedHistory,
        // test_modal: markRaw(test_modal),
    },
    props:{
        item: Object,
        hr_id: Number,
        roleId: Number
    },
    setup(props) {
        // console.log(props.item);
        const modalComponent = ref(null);
        const showUpdateModal = ref(false);
        const showStatusModal = ref(false);
        const showReminderModal = ref(false);
        const showRepeatModal = ref(false);
        const showHistoryModal = ref(false);
        const modalData = ref(null);

        const url = new URL( location.href)
        const personalSelectionUrl = ref(url.origin+'/admin/selection_personal')
        const vacancyPersonalUrl = ref(url.origin+'/admin/vacancy_personal')
        const vacancyDepositUrl = ref(url.origin+'/admin/vacancy_deposit')

        const openModal = (item, index) =>{
            modalData.value = item
            if (index == 1) {
                showUpdateModal.value = !showUpdateModal.value;
            }else if(index == 2){
                showStatusModal.value = !showStatusModal.value
            }else if(index == 3){
                showReminderModal.value = !showReminderModal.value
            }else if(index == 4){
                showRepeatModal.value = !showRepeatModal.value
            }else if(index == 5){
                showHistoryModal.value = !showHistoryModal.value
            }


        };
        const carryInHead = (item) =>{
            let editedFields = {
                'carry_in_head_date': item.carry_in_head_date,
            }
            Swal.fire({
                title: 'ნამდვილად გსურთ ვაკანსიის თავში ატანა?',
                //   showDenyButton: true,
                cancelButtonText:'არა',
                confirmButtonText: 'კი',
                showCancelButton: true,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios.post('/carry_in_head_vacancy' ,{
                        data: {'id':item.id, 'edit': editedFields},
                    })
                    .then(function (response) {
                        if (response.status == 200) {
                            toast.success("წარმატებით შესრულდა", {
                                theme: 'colored',
                                autoClose: 1000,
                            });
                            setTimeout(() => {
                                document.location.reload();
                            }, 2000);
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

        return{
            modalComponent,
            showUpdateModal,
            showStatusModal,
            showReminderModal,
            showRepeatModal,
            showHistoryModal,
            modalData,

            openModal,
            carryInHead,

            // url
            personalSelectionUrl,
            vacancyPersonalUrl,
            vacancyDepositUrl
        }
    }
}
</script>
<style lang="">

</style>
