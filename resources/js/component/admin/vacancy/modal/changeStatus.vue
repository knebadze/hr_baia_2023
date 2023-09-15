<template lang="">
    <!-- Modal -->
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
          <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h6 class="modal-title" id="exampleModalLongTitle">სტატუსის შეცვლა</h6>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
              </div>
              <div class="modal-body ">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>{{ $t('სტატუსი') }}</label>
                        <div class="ls-inputicon-box">
                            <multiselect v-model="m.status" :options="cla" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" :placeholder="$t('lang.employer_add_job_select')"  :searchable="true" :allow-empty="false">
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" v-if="m.status.id == 7">
                    <div class="form-group">
                        <label> სადამდე </label>
                        <input class="form-control" v-model="m.suspended_date" type="date" placeholder="" rows="3">
                    </div>
                </div>
                <div class="col-md-12" v-if="m.status.id == 5 || m.status.id == 7">
                    <div class="form-group">
                        <label> სტატუსის შეცვლის მიზეზი </label>
                        <textarea class="form-control" v-model="m.status_change_reason" type="text" placeholder="" rows="3"></textarea>
                    </div>
                </div>

                <div v-if="m.status.id == 6">
                    <hr>
                    <h6><i class="fa fa-hourglass-start"></i> შეხსენება</h6>
                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label> შეხსენების დრო </label>
                                <input class="form-control" v-model="reminder.date" type="datetime-local" placeholder="" rows="3">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label> შეხსენების მიზეზი </label>
                                <textarea class="form-control" v-model="reminder.reason" type="text" placeholder="" rows="3"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div v-if="data.history.length > 0">
                    <hr>
                    <h6><i class="fa fa-list"></i> ისტორია</h6>
                    <hr>
                    <div class="row">
                        <div v-for="(item, index) in data.history" :key="index" class="col-md-5 ml-1 border">
                            <p v-if="item.column_name == 'status'" class=''><strong>შეცვლის თარიღი: </strong><span>{{ changeFormat(item.created_at) }}</span></p>
                            <p v-if="item.column_name == 'status'"  class=''><strong>ძველი სტატუსი: </strong><span>{{ JSON.parse(item.old_value).name_ka }}</span></p>
                        </div>
                    </div>

                </div>

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-success" @click.prevent="save()" ><i class=""></i>შენახვა</button>
              </div>
              </div>
          </div>
      </div>
      <addPersonalWasEmployed :visible="showModal" :item="modalItem"></addPersonalWasEmployed>
      <deleteReminder :visible="showDeleteReminderModal" :item="modalItem"> </deleteReminder>
  </template>
    <script>
    import { toast } from 'vue3-toastify';
    import 'vue3-toastify/dist/index.css';
    import moment from 'moment'
    import addPersonalWasEmployed from './addPersonalWasEmployed.vue'
    import deleteReminder from './deleteReminder.vue'
    export default {
        components:{
            addPersonalWasEmployed,
            deleteReminder
        },
        props:{
            visible: Boolean,
            item: Object
        },
        data() {
            return {
                showConfirm: false,
                data: {},
                m: null,
                cla:null,
                reminder:{},
                showModal: false,
                modalItem: null,
                showDeleteReminderModal: false
            }
        },
        created(){
            // this.showConfirm = this.visible
        },
        computed:{
            getLang(){
                return I18n.getSharedInstance().options.lang
            },
        },
        methods:{
            async show(){
                try {
                    let result = await this.getClassificatory();
                    console.log('result', result.data);
                    this.data = result.data

                    this.m = this.makeModel(this.item)
                    this.cla = this.makeCla(this.item.status.id)
                    console.log('this.item', this.item);
                    this.showConfirm = true
                } catch (error) {
                    console.log(error);
                }

            },
            hide(){
                this.showConfirm = false
            },

            makeModel(item){
                var newItem = {}
                newItem.id = item.id
                newItem.status = item.status
                newItem.status_change_reason = item.status_change_reason

                return {...newItem}
            },
            makeCla(id){
                console.log('id', id);
                let status = []
                if (id == 1) {
                    status = this.data.status.filter(item => item.id != id && item.id != 3 && item.id != 4 &&  item.id != 13);
                }else if(id == 2){
                    status = this.data.status.filter(item => item.id != id && item.id != 4 &&  item.id != 13);
                }else if(id == 3){
                    status = this.data.status.filter(item => item.id != id && item.id != 1 && item.id != 2 && item.id != 5 &&  item.id != 6 && item.id != 7 && item.id != 13);
                }
                // if (id != 3) {
                //     status = this.data.status.filter(item => item.id != id && item.id != 3 && item.id != 4 &&  item.id != 13);
                // }
                if (this.data.role_id == 2) {
                    if(id == 3 ){
                        status = this.data.status.filter(item => item.id == 4);
                    }
                }


                return status
            },
            save(){
                // console.log('this.m', this.m);
                // return
                if (this.m.status.id == 6) {
                    this.m['reminder'] = this.reminder
                }
                //შეხსენების წაშლა იხსნება მოდალი სადაც ჩამონათვალია
                // if (this.m.status.id == 4  || this.m.status.id == 5) {
                //     this.reminderInfo(this.m.id)
                // }
                // return
                var editedFields = this.forItem(this.m)
                let currentObj = this
                console.log('editedFields', editedFields);
                axios.post('/update_vacancy_status' ,{
                    data: {'model':this.m, 'edit': editedFields},
                })
                .then(function (response) {
                    // handle success
                    console.log('response.data',response.data.data);
                    if (response.status == 200 && response.data.data[0].type == 's') {

                        toast.success(response.data.data[0].message, {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        setTimeout(() => {
                            document.location.reload();
                        }, 2000);
                    }else if(response.status == 200 && response.data.data[0].type == 'e'){
                        toast.error(response.data.data[0].message, {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        if(response.data.data[0].message !== "ამ სტატუსის მისანიჭებლად აუცილებელია ვაკანსიის თანხა იყოს ჩარიცხული სრულად")
                        {
                            currentObj.openModal()
                        }


                    }



                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },
            getClassificatory(){
                return axios.post('/get_status_change_info' ,{
                      data: this.item.id,
                  })

            },
            reminderInfo(id){
                let currentObj = this
                axios.post('/get_reminder_info' ,{
                    data: id,
                })
                .then(function (response) {
                    // handle success
                    console.log('response.data',response.data);
                    if (response.data || response.data.next.length > 0) {
                        currentObj.openDeleteReminderModal(response.data.next)
                    }
                    // if (response.status == 200 && response.data.data[0].type == 's') {

                    //     toast.success(response.data.data[0].message, {
                    //         theme: 'colored',
                    //         autoClose: 1000,
                    //     });
                    //     setTimeout(() => {
                    //         document.location.reload();
                    //     }, 2000);
                    // }else if(response.status == 200 && response.data.data[0].type == 'e'){
                    //     toast.error(response.data.data[0].message, {
                    //         theme: 'colored',
                    //         autoClose: 1000,
                    //     });
                    //     currentObj.openModal()

                    // }

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },
            forItem(item){
                var editedFields = {}
                for (const field in item) {
                    if ( item[field] !== this.item[field] ) {
                            editedFields[field] = this.item[field]
                    }
                }
                return editedFields
            },
            changeFormat(time){
                return moment(time).format("YYYY-MM-DD HH:mm")
            },
            openModal(){
                console.log('this.item modal', this.item);
                this.showModal = !this.showModal
                this.modalItem = this.item
            },
            openDeleteReminderModal(item){
                console.log('openDeleteReminderModal(item)' ,item);
                this.showDeleteReminderModal = !this.showDeleteReminderModal
                this.modalItem = item
            }

        },
        watch:{
            visible: function(){
                this.show()
            },
        }
  }
  </script>
  <style lang="">

  </style>
