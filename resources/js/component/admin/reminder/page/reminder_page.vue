<template lang="">
    <div class="row">
          <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Tabs</h3>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">დღის</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">მიმდინარე</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">კვირის</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>ვაკანსისი ID</th>
                                <th v-if="data.role_id == 1">HR</th>
                                <th>შეხსენების მიზეზი</th>
                                <th>თარიღი</th>
                                <th>სტატუსი</th>
                                <th>მოქმედება</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in daily" :key="index">
                                <td>{{ index + 1 }}.</td>
                                <td><u class="text-primary" @click="vacancyModal(item.vacancy_id)">{{ item.vacancy.code }}</u> </td>
                                <td v-if="data.role_id == 1">{{ item.hr.user.name_ka }}</td>
                                <td>{{ item.reason }}</td>
                                <td>{{ item.date }}</td>
                                <td>
                                    <span v-if="item.status == 0" class="badge badge-danger">გადაცილებული</span>
                                    <span v-if="item.status == 1" class="badge badge-warning">მიმდინარე</span>
                                    <span v-if="item.status == 2" class="badge badge-success">შესრულებული</span>
                                </td>
                                <td>
                                    <div v-if="data.role_id == 2 ">
                                        <button type="button" class="btn btn-info" @click="remainderShow(item)" title="" v-if="item.status == 1"><i class="fa fa-check-square"></i> შევასრულე</button>
                                    </div>
                                    <div v-else>
                                        <button type="button" class="btn btn-info mr-1" @click="remainderShow(item)" title="შევასრულე" v-if="item.status == 1"><i class="fa fa-check-square"></i> </button>
                                        <button type="button" class="btn btn-success" @click="editModal(item)" title="რედაქტირება" ><i class="fa fa-pen"></i> </button>
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>ვაკანსისი ID</th>
                                <th v-if="data.role_id == 1">HR</th>
                                <th>შეხსენების მიზეზი</th>
                                <th>თარიღი</th>
                                <th>მოქმედება</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in data.data.current" :key="index">
                                <td>{{ index + 1 }}.</td>
                                <td><u class="text-primary" @click="vacancyModal(item.vacancy_id)">{{ item.vacancy.code }}</u> </td>
                                <td v-if="data.role_id == 1">{{ item.hr.user.name_ka }}</td>
                                <td>{{ item.reason }}</td>
                                <td>{{ item.date }}</td>
                                <td>
                                    <div v-if="data.role_id == 2 ">
                                        <button type="button" class="btn btn-info" @click="remainderShow(item)" title="" ><i class="fa fa-check-square"></i> შევასრულე</button>
                                    </div>
                                    <div v-else>
                                        <button type="button" class="btn btn-info mr-1" @click="remainderShow(item)" title="შევასრულე"><i class="fa fa-check-square"></i> </button>
                                        <button type="button" class="btn btn-success" @click="editModal(item)" title="რედაქტირება" ><i class="fa fa-pen"></i> </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>ვაკანსისი ID</th>
                                <th v-if="data.role_id == 1">HR</th>
                                <th>შეხსენების მიზეზი</th>
                                <th>თარიღი</th>
                                <th>სტატუსი</th>
                                <th>მოქმედება</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in weekly" :key="index">
                                <td>{{ index + 1 }}.</td>
                                <td><u class="text-primary" @click="vacancyModal(item.vacancy_id)">{{ item.vacancy.code }}</u> </td>
                                <td v-if="data.role_id == 1">{{ item.hr.user.name_ka }}</td>
                                <td>{{ item.reason }}</td>
                                <td>{{ item.date }}</td>
                                <td>
                                    <span v-if="item.status == 0" class="badge badge-danger">გადაცილებული</span>
                                    <span v-if="item.status == 1" class="badge badge-warning">მიმდინარე</span>
                                    <span v-if="item.status == 2" class="badge badge-success">შესრულებული</span>
                                </td>
                                <td>
                                    <div v-if="data.role_id == 2 ">
                                        <button type="button" class="btn btn-info" @click="remainderShow(item)" title="" v-if="item.status == 1"><i class="fa fa-check-square"></i> შევასრულე</button>
                                    </div>
                                    <div v-else>
                                        <button type="button" class="btn btn-info mr-1" @click="remainderShow(item)" title="შევასრულე" v-if="item.status == 1"><i class="fa fa-check-square"></i> </button>
                                        <button type="button" class="btn btn-success" @click="editModal(item)" title="რედაქტირება" ><i class="fa fa-pen"></i> </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
        <RemainderFilter :roleId="data.role_id"></RemainderFilter>
        <filledReminder  :visible="reminderModelShow" :item="item"></filledReminder>
        <vacancyFullInfoModal :visible="vacancyModelShow" :vacancyId="vacancyId"></vacancyFullInfoModal>
        <reminderEdit  :visible="reminderEditModelShow" :item="item"></reminderEdit>
</template>
<script>
import moment from 'moment'
import RemainderFilter from '../component/reminder_filter.vue'
import filledReminder from '../../../hr/modal/filledReminder.vue'
import vacancyFullInfoModal from '../../../modal/vacancyFullInfoModal.vue'
import reminderEdit from '../modal/reminder_edit.vue'
export default {
    components:{
        RemainderFilter,
        filledReminder,
        vacancyFullInfoModal,
        reminderEdit
    },
    props:{
        data: Object
    },
    data() {
        return {
            reminderModelShow: false,
            vacancyModelShow: false,
            reminderEditModelShow:false,
            item: null,
            vacancyId: null
        }
    },
    created(){
        console.log('data', this.data);
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
        daily(){
            const currentDateTime = moment();
            let arr = []
            this.data.data.daily.forEach(element => {
                let baseDateTime = element.date;
                // Convert base time to a moment object
                let baseTimeMoment = moment(baseDateTime, "YYYY-MM-DD HH:mm");
                if (currentDateTime.isAfter(baseTimeMoment) ) {
                    // Current time is greater than the base time
                    if (element.active == 0) {
                        element['status'] = 0
                    } else {
                        element['status'] = 2
                    }
                } else if (currentDateTime.isBefore(baseTimeMoment) ) {
                    // Current time is less than the base time
                    if (element.active == 0) {
                        element['status'] = 1
                    }else{
                        element['status'] = 2
                    }
                } else{
                    console.log('else');
                }
                arr.push(element)
            });
            return arr
        },
        weekly(){
            const currentDateTime = moment();
            let arr = []
            this.data.data.weekly.forEach(element => {
                let baseDateTime = element.date;
                // Convert base time to a moment object
                let baseTimeMoment = moment(baseDateTime, "YYYY-MM-DD HH:mm");
                if (currentDateTime.isAfter(baseTimeMoment) ) {
                    // Current time is greater than the base time
                    if (element.active == 0) {
                        element['status'] = 0
                    } else {
                        element['status'] = 2
                    }
                } else if (currentDateTime.isBefore(baseTimeMoment) ) {
                    // Current time is less than the base time
                    if (element.active == 0) {
                        element['status'] = 1
                    }else{
                        element['status'] = 2
                    }
                } else{
                    console.log('else');
                }
                arr.push(element)
            });
            return arr
        }
    },
    methods:{
        remainderShow(item){
            this.reminderModelShow = !this.reminderModelShow
            this.item = {
                'id': item.id,
                'vacancy_id':item.vacancy_id
            }
        },
        vacancyModal(id){
            this.vacancyModelShow = !this.vacancyModelShow
            this.vacancyId = id
        },
        editModal(item){
            console.log('hi');
            this.reminderEditModelShow = !this.reminderEditModelShow
            this.item = item
        }
    },
    watch:{

    }
}
</script>
<style lang="">

</style>
