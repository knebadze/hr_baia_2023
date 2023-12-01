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
                      <td><u class="text-primary" @click="openVacancyFullInfoModal(item.vacancy_id)">{{ item.code }}</u></td>
                      <td>{{ item.employer_name }}</td>
                      <td>{{ item.category_name }}</td>
                      <td>{{ item.status_name }}</td>
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
    <vacancyFullInfoModal :visible="vacancyFullInfoModalShow" :vacancyId="vacancy_id"></vacancyFullInfoModal>
    <end_work_info :visible="showEndWorkInfoModal " :item="modalItem"/>
</template>
<script>
import { ref } from 'vue';
import moment from 'moment'
// import table_cog from './table_cog.vue';
import table_cog from '../../../vacancy/component/personalTables/table_cog.vue';
import vacancyFullInfoModal from '../../../vacancy/modal/vacancyFullInfoModal.vue';
import end_work_info from '../../modal/end_work_modal.vue';
export default {
  components:{
      table_cog,
      vacancyFullInfoModal,
      end_work_info
  },
  props:{
      items: Object,
      auth: Object
  },
  setup(props) {
    console.log('tenms', props.items);
      const data = ref(props.items.data);
      const type = ref(props.items.type);
      for (let i = 0; i < data.value.length; i++) {
          // Access the element to update in each object
          data.value[i].created_at = moment(data.value[i].created_at).format("YYYY-MM-DD HH:mm");
          data.value[i].start_date = (data.value[i].start_date)?moment(data.value[i].start_date).format("YYYY-MM-DD"):null;
          data.value[i].end_date = (data.value[i].end_date)?moment(data.value[i].end_date).format("YYYY-MM-DD"):null;
          data.value[i].status = (!data.value[i].status_id)? 'მიმდინარე' :data.value[i].status_id == 1? 'დასრულებული': 'გაუქმებული'
      }

      const vacancyFullInfoModalShow = ref(false);
      const vacancy_id = ref(null)

      const openVacancyFullInfoModal = (id) =>{
          vacancyFullInfoModalShow.value = !vacancyFullInfoModalShow.value;
          vacancy_id.value = id
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

          vacancyFullInfoModalShow,
          vacancy_id,

          showEndWorkInfoModal,
          modalItem,

          openVacancyFullInfoModal,
          openEndWorkInfoModal

      }
  }
}
</script>
<style lang="">

</style>
