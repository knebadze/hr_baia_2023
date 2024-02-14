<template lang="">
    <div>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-cog"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <a v-if="item.status.id != 4 && item.status.id != 5 && item.status.id != 13" class="dropdown-item" href="#" @click="openModal(item, 1)">რედაქტირება</a>
                <a v-if="item.status.id != 3 && item.status.id != 4 && item.status.id != 5 && item.status.id != 13" class="dropdown-item" href="#" @click="openModal(item, 2)">სტატუსის შეცვლა</a>
                <a v-if="item.status.id == 2" class="dropdown-item" :href="personalSelectionUrl+'/'+item.id" >კადრების შერჩევა</a>
                <a v-if="item.status.id > 1" class="dropdown-item" :href="vacancyPersonalUrl+'/'+item.id" >შერჩეული კადრები</a>
                <a v-if="item.status.id != 4 && item.status.id != 5  && item.status.id != 13" class="dropdown-item" href="#" @click="openModal(item, 3)">შეხსენება</a>
                <!-- <a v-else-if="item.status.id != 4 && item.status.id != 5  && item.status.id != 13" class="dropdown-item" href="#" @click="openModal(item, 3)">შეხსენება</a> -->
                <a v-if="item.status.id != 4 && item.status.id != 5  && item.status.id != 13" class="dropdown-item" :href="vacancyDepositUrl+'/'+item.id" >დეპოზიტი</a>
                <!-- <a v-else-if="item.status.id != 4 && item.status.id != 5 && item.status.id != 13" class="dropdown-item" :href="vacancyDepositUrl+'/'+item.id" >დეპოზიტი</a> -->
                <a v-if="item.status.id == 13 || item.status.id == 5" class="dropdown-item" href="#"  @click="openModal(item, 4)">გამეორება</a>
                <a v-if="item.status.id !== 3 && item.status.id !== 4 && item.status.id !== 5 && item.status.id !== 13" class="dropdown-item" href="#" @click="carryInHead(item)">აპინვა </a>
                <a class="dropdown-item" href="#" @click="openModal(item, 5)">ისტორია</a>

                <a v-if="roleId == 1 && (item.status.id == 1 || item.status.id == 2 || item.status.id == 6)" class="dropdown-item" href="#" @click="openModal(item, 6)"> გადაწერა</a>
                <a v-if="roleId == 1" class="dropdown-item bg-danger" href="#" @click="vacancyDelete(item.id)">წაშლა</a>

            </div>
        </div>
        <vacancyUpdate :visible="showUpdateModal" :item="modalData" />

        <changeStatus :visible="showStatusModal" :item="modalData" />

        <vacancyReminder :visible="showReminderModal" :item="modalData" :roleId="roleId" />

        <redactedHistory :visible="showHistoryModal" :vacancyId="vacancyId" />

        <change_hr :visible="hrModelShow" :item="modalData"/>
    </div>
</template>
<script>
import { ref } from "vue";
// import { markRaw } from 'vue';
import vacancyUpdate from "../../modal/vacancyUpdate.vue"
import changeStatus from "../../modal/changeStatus.vue";
import vacancyReminder from "../../modal/vacancyReminder.vue";
import redactedHistory from "../../modal/redactedHistory.vue";
import change_hr from '../../modal/change_hr.vue';
import Swal from 'sweetalert2';

export default {
    components:{
        vacancyUpdate,
        changeStatus,
        vacancyReminder,
        redactedHistory,
        change_hr
    },
    props:{
        item: Object,
        // hr_id: Number,
        roleId: Number
    },
    setup(props) {
        const modalComponent = ref(null);
        const showUpdateModal = ref(false);
        const showStatusModal = ref(false);
        const showReminderModal = ref(false);
        const showRepeatModal = ref(false);
        const showHistoryModal = ref(false);
        const hrModelShow = ref(false);
        const modalData = ref(null);
        const vacancyId = ref(null)

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
                let url = new URL( location.href)
                window.location.replace(`${url.origin}/ka/post_job/${item.id}/${item.code}`);
                // showRepeatModal.value = !showRepeatModal.value
            }else if(index == 5){
                showHistoryModal.value = !showHistoryModal.value
                vacancyId.value = item.id
            }else if(index == 6){
                hrModelShow.value = !hrModelShow.value
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
        };

        const vacancyDelete = (id) => {
            Swal.fire({
                title: "ნამდვილად გსურთ ვაკანსიის წაშლა?",

                showCancelButton: true,
                cancelButtonText:'არა',
                confirmButtonText: "კი",
                showLoaderOnConfirm: true,
                preConfirm: async () => {
                    try {
                    const response = await  axios({
                        method: "post",
                        url: '/delete_vacancy',
                        data: {id: id, check: true},

                    });
                    if (!response.status == 200) {
                        return Swal.showValidationMessage(`
                        ${JSON.stringify(await response.error)}
                        `);
                    }
                    return response;
                    } catch (error) {
                    Swal.showValidationMessage(`
                        Request failed: ${error}
                    `);
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                if (result.isConfirmed) {
                    if (result.value.data.data) {
                        Swal.fire({
                            title: 'ამ ვაკანსიას აქვას გამეორების ისტორია. წასაშლელად აუცილებელია ისტრორიის წაშლა, გსურთ ეს?',
                            //   showDenyButton: true,
                            cancelButtonText:'არა',
                            confirmButtonText: 'კი',
                            showCancelButton: true,
                        }).then((result) => {
                            sendDeleteAxios(id)
                        })
                    }else{
                        sendDeleteAxios(id)
                    }
                }
            });
            return

        };

        const sendDeleteAxios = (id) =>{
            axios({
                method: "post",
                url: '/delete_vacancy',
                data: {id: id, check: false},

            })
            .then(function (response) {
                // items.value = response.data
                if (response.status == 200) {
                    toast.success("წარმატებით წაიშალა", {
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
        };

        return{
            modalComponent,
            showUpdateModal,
            showStatusModal,
            showReminderModal,
            showRepeatModal,
            showHistoryModal,
            hrModelShow,
            modalData,
            vacancyId,

            openModal,
            carryInHead,
            vacancyDelete,

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
