<template lang="">
    <div>
        <button v-if="item.vacancy_status_id == 2"  class="btn btn-info btn-sm" @click="openAddPersonalModal(item)" :disabled="item.end_work_reason_id">
            განახლება
        </button>
        <div v-else class="dropdown">
            <button class="btn btn-primary dropdown-toggle"
                type="button" id="dropdownMenuButton"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                :disabled="((item.qualifying_type_id == 5 || item.qualifying_type_id == 6 || item.qualifying_type_id == 7) && item.status_id != 2)?false:true">
                <i class="fa fa-cog"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <div v-if="(item.vacancy_status_id == 3 || item.vacancy_status_id == 4)">
                    <a v-if="auth.role_id == 1 || (auth.role_id == 2 && auth.hr.id == item.vacancy_hr_id)" class="dropdown-item" href="#" @click="endWorkModal(item.id)">შეწყვეტა</a>
                </div>
                <a v-if="item.qualifying_type_id == 5 || item.qualifying_type_id == 6 || item.qualifying_type_id == 7" class="dropdown-item" href="#" @click="moveModal(item)">დასრულების თარიღის გადაწევა</a>
                <a v-if="item.qualifying_type_id == 7" class="dropdown-item" href="#" @click="scheduleModal(item.id)">გრაფიკი</a>
            </div>
        </div>
    </div>
    <add_personal_vacancy :visible="showAddPersonalModal" :item="modalItem" />
    <move_end_date :visible="moveModalShow" :item="modalItem"/>
    <end_work_modal :visible="endWorkModalShow" :item="qualifying_id"/>
    <schedule_calendar_modal :visible="scheduleModalShow" :item="qualifying_id"/>
</template>
<script>
import add_personal_vacancy from '../../modal/addPersonalVacancy.vue'
import move_end_date from '../../../candidate/modal/move_end_date.vue';
import end_work_modal from '../../../candidate/modal/end_work_modal.vue';
import schedule_calendar_modal from '../../../candidate/modal/schedule_calendar_modal.vue';
import { ref } from 'vue';

export default {
    components:{
        add_personal_vacancy,
        move_end_date,
        end_work_modal,
        schedule_calendar_modal
    },
    props:{
        item: Object,
        auth: Object
    },
    setup(props) {
        const showAddPersonalModal = ref(false);
        const moveModalShow = ref(false);
        const endWorkModalShow = ref(false);
        const scheduleModalShow = ref(false);

        const modalItem = ref(null);
        const qualifying_id = ref(null)

        const openAddPersonalModal = () =>{
            showAddPersonalModal.value = !showAddPersonalModal.value
            let obj = {
                vacancy_id: props.item.vacancy_id,
                vacancy_code: props.item.vacancy_code,
                interview_place: null,
                interview_place_id: props.item.vacancy_interview_place_id,
                interview_date: props.item.vacancy_interview_date,
                start_date: props.item.vacancy_start_date,
                candidate_id: props.item.candidate_id
            };
            modalItem.value = obj
        };

        const moveModal = (item) => {
            modalItem.value = {...item}
            moveModalShow.value = !moveModalShow.value
        };

        const endWorkModal = (id) =>{
            endWorkModalShow.value = !endWorkModalShow.value
            qualifying_id.value = id
        };

        const scheduleModal = (id) =>{
            scheduleModalShow.value = !scheduleModalShow.value
            qualifying_id.value = {id: id, candidate_id: null}
        }

        return {
            showAddPersonalModal,
            moveModalShow,
            endWorkModalShow,
            scheduleModalShow,

            modalItem,
            qualifying_id,

            openAddPersonalModal,
            moveModal,
            endWorkModal,
            scheduleModal
        }
    }
}
</script>
<style lang="">

</style>
