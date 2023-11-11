<template lang="">
    <div class="row">
          <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Tabs</h3>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">დღის</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">კვირის</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <reminder_table :items="daily" :role_id="data.role_id"></reminder_table>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="tab_2">
                    <RemainderFilter :roleId="data.role_id" @emitFilterData="handlerFilterData"></RemainderFilter>
                    <reminder_table :items="items" :role_id="data.role_id" :key="tableKey"></reminder_table>


                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
          </div>
          <!-- /.col -->
        </div>


</template>
<script>
import moment from 'moment'
import RemainderFilter from '../component/reminder_filter.vue'
import reminder_table from '../component/reminder_table.vue'
export default {
    components:{
        RemainderFilter,
        reminder_table
    },
    props:{
        data: Object
    },
    data() {
        return {
            items: null,
            vacancyId: null,
            tableKey: 0
        }
    },
    created(){

        this.items = this.data.data

    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
        daily(){
            const currentDate = moment().format('YYYY-MM-DD');
            const itemsArray = this.items;
            const filteredArray = itemsArray.filter(item => moment(item.date).isSame(currentDate, 'day'));
            return filteredArray;
        },
    },
    methods:{
        handlerFilterData(item){
            this.items = item
            this.tableKey ++
        }
    },
    watch:{

    }
}
</script>
<style lang="">

</style>
