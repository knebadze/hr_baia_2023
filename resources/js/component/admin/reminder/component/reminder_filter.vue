<template lang="">
    <section class="content ">
    <div class="container-fluid">
        <div id="accordion">
            <div class="card card-primary">
                <div class="card-header">
                  <h4 class="card-title w-100 d-flex justify-content-between">
                    <a class="d-block w-100" data-toggle="collapse"  href="#collapseOne">
                      ფილტრი
                    </a>
                    <i class="fas fa-angle-down float-right"></i>
                  </h4>
                </div>
                <div id="collapseOne" class="collapse" :class="colspan" data-parent="#accordion" >
                    <div class="card-body">
                         <div class="row">
                            <div class=" col-md-12" v-if="roleId == 1">
                                <div class="form-group">
                                    <label>HR</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.hr" :options="hr" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>ვაკანსისი ID</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.vacancy_id"  type="text" placeholder="907368268">
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-6" >
                                <div class="form-group">
                                    <label>სტატუსი</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.status" :options="status" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>თარიღი (დან)</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" type="date" v-model="m.date_from">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>თარიღი (მდე)</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" type="date" v-model="m.date_to">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-success" @click="find(m)"><i class="fa fa-search"></i> ძებნა</button>
                    </div>
                </div>
              </div>




        </div>
    </div>
    <div class="card" v-if="data != null">
        <div class="card-header d-flex p-0">
            <h3 class="card-title p-3">მოიძებნა {{ data.length }} ჩანაწერი</h3>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>ვაკანსისი ID</th>
                                <th v-if="roleId == 1">HR</th>
                                <th>შეხსენების მიზეზი</th>
                                <th>თარიღი</th>
                                <th>სტატუსი</th>
                                <th>მოქმედება</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in data" :key="index">
                                <td>{{ index + 1 }}.</td>
                                <td><u class="text-primary" @click="vacancyModal(item.vacancy_id)">{{ item.vacancy.code }}</u> </td>
                                <td v-if="roleId == 1">{{ item.hr.user.name_ka }}</td>
                                <td>{{ item.reason }}</td>
                                <td>{{ item.date }}</td>
                                <td>
                                    <span v-if="item.status == 0" class="badge badge-danger">გადაცილებული</span>
                                    <span v-if="item.status == 1" class="badge badge-warning">მიმდინარე</span>
                                    <span v-if="item.status == 2" class="badge badge-success">შესრულებული</span>
                                </td>
                                <td>
                                    <div v-if="roleId == 2 ">
                                        <button type="button" class="btn btn-info" @click="remainderShow(item)" title="" v-if="item.status == 1"><i class="fa fa-check-square"></i> შევასრულე</button>
                                    </div>
                                    <div v-else>
                                        <button type="button" class="btn btn-info mr-1" @click="remainderShow(item)" title="შევასრულე" v-if="item.status == 1"><i class="fa fa-check-square"></i> </button>
                                        <button type="button" class="btn btn-success" @click="remainderShow(item)" title="რედაქტირება" ><i class="fa fa-pen"></i> </button>
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.tab-pane -->
            </div>
        <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
  </section>
    <filledReminder  :visible="reminderModelShow" :item="item"></filledReminder>
    <vacancyFullInfoModal :visible="vacancyModelShow" :vacancyId="item"></vacancyFullInfoModal>
</template>
<script>
import moment from 'moment'
import axios from 'axios';
import filledReminder from '../../../hr/modal/filledReminder.vue'
import vacancyFullInfoModal from '../../../modal/vacancyFullInfoModal.vue'
export default {
    components:{
        filledReminder,
        vacancyFullInfoModal
    },
    props:{
        roleId: Number
    },
    data() {
        return {
            m:{},
            colspan: 'hide',
            status:[
                {
                    'id': 0,
                    'name': 'გადაცილებული',
                },
                {
                    'id': 1,
                    'name': 'მიმდინარე',
                },
                {
                    'id': 2,
                    'name': 'შესრულებული',
                }
            ],
            data: null,
            reminderModelShow: false,
            vacancyModelShow: false,
            item: null,
            vacancyId: null,
            hr:[]
        }
    },
    created(){
        let currentObj = this
        axios({
                method: "post",
                url: '/get_hr_cla',
                // data: m,

            })
            .then(function (response) {

                currentObj.hr = response.data
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
    },
    methods:{
        find(m){
            if (m.date_from && !m.date_to) {
                toast.error("თარიღი (მდე) შევსვება სავალდებულოა", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                return
            }
            // this.colspan = 'hide'
            m.date = (m.date_from || m.date_to)?[m.date_from, m.date_to]:null
            let currentObj = this
            axios({
                method: "post",
                url: '/vacancy_reminder_filter',
                data: m,

            })
            .then(function (response) {

                currentObj.data = currentObj.maker(response.data)
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        remainderShow(item){
            this.reminderModelShow = !this.reminderModelShow
            this.item = {
                'id': item.id,
                'vacancy_id':item.vacancy_id
            }
        },
        vacancyModal(id){
            this.vacancyModelShow = !this.vacancyModelShow
            this.item = id
        },
        maker(item){
            const currentDateTime = moment();
            let arr = []
            item.forEach(element => {
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
                }
                arr.push(element)
            });
            return arr
        },
    },
    watch:{

    }
}
</script>
<style lang="">

</style>
