<template lang="">
   <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-cog"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

            <a class="dropdown-item"  :href="`${updateUrl}${item.id}`">რედაქტირება</a>
            <!-- <a v-if="item.status_id == 10 || item.status_id == 11" class="dropdown-item" href="#" @click="freedom(item.id)">თავისუალი სტატუსი</a> -->
            <a v-if="item.status_id != 10 && item.status_id != 12" class="dropdown-item" href="#" @click="addInVacancy(item)">ვაკანსიაში დამატება</a>
            <a class="dropdown-item" :href="attachedUrl+'/'+item.id">მიბმული ვაკანსიები</a>
            <a class="dropdown-item" :href="relevantUrl+'/'+item.id">შესაბამისი ვაკანსიები</a>
            <a v-if="item.status_id == 11 || item.status_id == 14" class="dropdown-item" href="#" @click="scheduleModal(item.id)">გრაფიკი</a>
            <a v-if="item.user.register_log && item.user.register_log.creator_id == hrId && item.registration_fee != 1" href="#" class="dropdown-item" @click="enrolled(item.user)">ჩარიცხა</a>
            <a v-if="!item.user.register_log &&  item.registration_fee != 1 && item.status_id != 12" href="#" class="dropdown-item" @click="enrolled(item.user)">ჩარიცხა</a>
            <a class="dropdown-item" href="#"  @click="pdf(item)">ჩამოტვირთვა</a>
            <a class="dropdown-item" href="#" @click="openSendMessageModal(item)">სმს</a>
            <a v-if="item.status_id == 9" class="dropdown-item" href="#" @click="blackListModal(item.id)">შავ სიაში დამატება</a>
            <a v-if="role_id == 1" class="dropdown-item bg-danger" href="#" @click="candidateDelete(item.id)"> წაშლა</a>

        </div>
    </div>
    <add_in_vacancy :visible="showAddInVacancyModal" :item="modalItem"/>
    <schedule_calendar_modal :visible="scheduleModalShow" :item="modalItem"/>
    <register_enrollment :visible="showEnrolledModal" :item="modalItem"/>
    <component  :is="sendMessageComponent" v-if="sendMessageComponent" :visible="showSendMessageModal" :item="modalItem"/>
    <component  :is="blackListComponent" v-if="blackListComponent" :visible="showBlackListModal" :item="item" :type="'candidate'"/>
</template>
<script>
import { ref, markRaw } from 'vue';
import Swal from 'sweetalert2';
import add_in_vacancy from '../../modal/add_in_vacancy.vue';
import schedule_calendar_modal from '../../modal/schedule_calendar_modal.vue';
import register_enrollment from '../../modal/register_enrollment.vue';
export default {
    components:{
        add_in_vacancy,
        schedule_calendar_modal,
        register_enrollment
    },
    props:{
        item: Object,
        role_id: Number,
        hrId:Number
    },
    setup(props) {
        let url = new URL( location.href);
        // let url = new URL( location.href)
                    // window.location.replace(`${url.origin}/ka/user/userProfile?user=`);
        let updateUrl = ref(url.origin+'/ka/user/userProfile?user=');
        let attachedUrl = ref(url.origin+'/admin/vacancy_attached');
        let relevantUrl = ref(url.origin+'/admin/relevant_vacancy');

        const showAddInVacancyModal = ref(false);
        const scheduleModalShow = ref(false);
        const showEnrolledModal = ref(false);
        const showSendMessageModal = ref(false);
        const showBlackListModal = ref(false);

        const sendMessageComponent = ref(null);
        const blackListComponent = ref(null);

        const modalItem = ref(null);
        const modalId = ref(null);



        const addInVacancy = (item) =>{
            showAddInVacancyModal.value = !showAddInVacancyModal.value
            modalItem.value = {'id':item.id}
        };

        const scheduleModal = (id) =>{
            modalItem.value = {id: null, candidate_id: id}
            scheduleModalShow.value = !scheduleModalShow.value
        };

        const enrolled = (item) =>{
            showEnrolledModal.value = !showEnrolledModal.value
            modalItem.value = (item.register_fee)?item.register_fee:{'log': null}
            modalItem.value['name'] = item.name_ka
        };

        const pdf = (item) =>{
            event.preventDefault();
            Swal.fire({
                title: 'აირჩიე სრული თუ არასრული ვერსია?',
                cancelButtonText:'არასრული',
                confirmButtonText: 'სრული',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {

                    window.location.href = `/candidate_full_pdf?data=${item.id}`
                } else if (result.isDismissed) {
                    window.location.href = `/candidate_partial_pdf?data=${item.id}`
                }
            })
        };

        const openSendMessageModal = async (item) =>{
            // return
            if (!sendMessageComponent.value) {
                let module = await import('../../modal/send_message_modal.vue');
                sendMessageComponent.value = markRaw(module.default);
            }
            showSendMessageModal.value = !showSendMessageModal.value
            modalItem.value = {id: item.id, number: item.user.number}
        };

        const blackListModal = async (id) =>{
            if (!blackListComponent.value) {
                let module = await import('../../modal/add_black_list.vue');
                blackListComponent.value = markRaw(module.default);
            }
            showBlackListModal.value = !showBlackListModal.value
            modalItem.value = {
                id: id
            }
        };

        const candidateDelete = (id) =>{
            Swal.fire({
                title: 'ნამდვილად გსურთ წაშლა?',
                cancelButtonText:'არა',
                confirmButtonText: 'კი',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    axios({
                        method: "post",
                        url: "/delete_candidate",
                        data: {'id': id},

                    })
                    .then(function (response) {
                        if (response.status == 200) {

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
        };



        return {
            updateUrl,
            attachedUrl,
            relevantUrl,

            showAddInVacancyModal,
            scheduleModalShow,
            showEnrolledModal,
            showSendMessageModal,
            showBlackListModal,

            sendMessageComponent,
            blackListComponent,

            modalItem,
            modalId,
            // openInfoModal,
            addInVacancy,
            blackListModal,
            pdf,
            openSendMessageModal,
            enrolled,
            candidateDelete,
            scheduleModal
        }
    }
}
</script>
<style lang="">

</style>
