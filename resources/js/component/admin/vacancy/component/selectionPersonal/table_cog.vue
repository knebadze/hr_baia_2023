<template lang="">
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-cog"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

            <a class="dropdown-item"  href="#" @click="showModal(item)" :disabled="(item.status_id == 10)?true:false">დამატება</a>
            <a class="dropdown-item" v-if="item.status_id == 11 || item.status_id == 14" href="#" @click="scheduleModal(item.id)">გრაფიკი</a>
            <a class="dropdown-item"  href="#" @click="showModal(item)">sms</a>

        </div>
    </div>
    <schedule_calendar_modal :visible="scheduleModalShow" :item="modalItem"/>
</template>
<script>
import { ref } from 'vue'
import schedule_calendar_modal from '../../../candidate/modal/schedule_calendar_modal.vue';
export default {
    components:{
        schedule_calendar_modal
    },
    props:{
        item: Object,

    },
    emits: ['emitOpenModal'],
    setup(props, {emit}) {
        const scheduleModalShow = ref(false);
        const modalItem = ref(null)

        const  showModal = (item) => {
            emit("emitOpenModal", item);
        };

        const scheduleModal = (id) =>{
            modalItem.value = {id: null, candidate_id: id}
            scheduleModalShow.value = !scheduleModalShow.value
        };

        return {
            showModal,
            scheduleModalShow,
            modalItem,
            scheduleModal
        }
    }
}
</script>
<style lang="">

</style>
