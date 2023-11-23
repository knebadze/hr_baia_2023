<template lang="">
      <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ items.title }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table twm-table table-striped table-border">
                <thead>
                    <tr>
                        <th v-for="(item, index) in items.header" :key="index">{{ item }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in data" :key="index">
                        <td><u class="text-primary" @click="openCandidateFullInfoModal(item.candidate_id)">{{ item.candidate_id }}</u></td>
                        <td>{{ item.candidate_name }}</td>
                        <td v-if="type == 'note'">{{ item.qualifying_type }}</td>
                        <td>{{ item.created_at }}</td>
                        <td v-if="type == 'employed' || type == 'trail'">{{ item.start_date }}</td>
                        <td v-if="type == 'employed' || type == 'trail'">{{ item.end_date }}</td>
                        <td v-if="type == 'employed' || type == 'trail'" :class="item.end_work_reason_id?'text-primary':''" @click="openEndWorkInfoModal(item)">{{ item.status }}</td>
                        <td v-if="type == 'interview'">{{ item.interview_date }}</td>
                        <td v-if="type == 'interview'">{{ item.interview_place }}</td>
                        <td>
                            <table_cog :item = "item" :auth="auth"/>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
      </div>
      <candidateFullInfoModalVue :visible="candidateFullInfoModalShow" :candidate_id="candidate_id"></candidateFullInfoModalVue>
      <end_work_info :visible="showEndWorkInfoModal " :item="modalItem"/>
</template>
<script>
import { ref } from 'vue';
import moment from 'moment'
import table_cog from './table_cog.vue';
import candidateFullInfoModalVue from '../../../../modal/candidateFullInfoModal.vue';
import end_work_info from '../../modal/end_work_info.vue';
export default {
    components:{
        table_cog,
        candidateFullInfoModalVue,
        end_work_info
    },
    props:{
        items: Object,
        auth: Object
    },
    setup(props) {

        const data = ref(props.items.data);
        const type = ref(props.items.type);
        for (let i = 0; i < data.value.length; i++) {
            // Access the element to update in each object
            data.value[i].created_at = moment(data.value[i].created_at).format("YYYY-MM-DD HH:mm");
            data.value[i].start_date = (data.value[i].start_date)?moment(data.value[i].start_date).format("YYYY-MM-DD"):null;
            data.value[i].end_date = (data.value[i].end_date)?moment(data.value[i].end_date).format("YYYY-MM-DD"):null;
            data.value[i].status = (!data.value[i].status_id)? 'მიმდინარე' :data.value[i].status_id == 1? 'დასრულებული': 'გაუქმებული'
        }

        const candidateFullInfoModalShow = ref(false);
        const candidate_id = ref(null)

        const openCandidateFullInfoModal = (id) =>{
            candidateFullInfoModalShow.value = !candidateFullInfoModalShow.value;
            candidate_id.value = id
        };

        const showEndWorkInfoModal = ref(false)
        const modalItem = ref(null)
        const openEndWorkInfoModal = (item) =>{
            if (!item.end_work_reason_id) {
                return
            }
             console.log(item, ';;');
            showEndWorkInfoModal.value = !showEndWorkInfoModal.value
            modalItem.value = {
                end_work_reason_id: item.end_work_reason_id,
                end_work_reason: item.end_work_reason

            }
        }

        return {
            data,
            type,

            candidateFullInfoModalShow,
            candidate_id,

            showEndWorkInfoModal,
            modalItem,

            openCandidateFullInfoModal,
            openEndWorkInfoModal

        }
    }
}
</script>
<style lang="">

</style>
