<template lang="">
    <!-- Modal -->
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  style="display:block">
          <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h6 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-hourglass-start"></i> შეხსენების დამატება</h6>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
              </div>
              <div class="modal-body">

                <!-- <div v-if="m.status.id == 6"> -->
                    <!-- <hr> -->
                    <!-- <h6><i class="fa fa-hourglass-start"></i> შეხსენება</h6>
                    <hr> -->
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label> შეხსენების დრო </label>
                                <input class="form-control" v-model="m.date" type="datetime-local" placeholder="" :max="max" :min="min">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label> შეხსენების მიზეზი </label>
                                <textarea class="form-control" v-model="m.reason" type="text" placeholder="" rows="3"></textarea>
                            </div>
                        </div>

                    </div>
                <!-- </div> -->
                <div v-if="data.next.length > 0">
                    <hr>
                    <h6><i class="fa fa-list"></i> მომდევნო შეხსენება</h6>
                    <hr>
                    <reminder_table :items="data.next" :role_id="roleId"></reminder_table>

                </div>
                <div v-if="data.history.length > 0">
                    <hr>
                    <h6><i class="fa fa-list"></i> ისტორია</h6>
                    <hr>
                    <reminder_table :items="data.history" :role_id="roleId"></reminder_table>

                </div>



              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-success" @click.prevent="save()" ><i class=""></i>შენახვა</button>
              </div>
              </div>
          </div>
      </div>
  </template>
  <script>
  import { toast } from 'vue3-toastify';
  import 'vue3-toastify/dist/index.css';
  import moment from 'moment';
  import reminder_table from '../../reminder/component/reminder_table.vue';
  export default {
        components:{
            reminder_table
        },
        props:{
            visible: Boolean,
            item: Object,
            roleId:Number

        },
        data() {
            return {
                showConfirm: false,
                data: {},
                m: null,
                max: null,
                min: null
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
                    this.data = result.data

                    this.m = this.makeModel(this.item)
                    this.showConfirm = true
                    this.max = moment(moment().add(2, 'd').format('YYYY/MM/DD HH:mm')).toISOString().slice(0, -8)
                    this.min = moment(new Date()).toISOString().slice(0, -8)
;
                } catch (error) {
                    console.log(error);
                }

            },
            hide(){
                this.showConfirm = false
            },
            makeModel(item){

                var newItem = {}
                newItem.vacancy_id = item.id
                newItem.date = null
                newItem.reason = null
                newItem.main = 0

                return {...newItem}
            },
            save(){
                if (this.m.date == null || this.m.reason == null) {
                    toast.error("სავალდებულოა ორივე ველის შევსება", {
                        theme: 'colored',
                        autoClose: 1500,
                    });
                    return
                }
                //  ვამოწმებ შეხსენება ემატება თუ არა სამუშაო საათებში
                if (this.m.date) {
                    let arr = ['09', '10', '11', '12', '13', '14', '15', '16', '17', '18']
                    const [datePart, timePart] = this.m.date.split('T');
                    const [hour, minute] = timePart.split(':');
                    if (!arr.includes(hour)) {
                        toast.error("გთხოვთ შეხსენება დაამატოთ სამუშაო საათებში", {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        return
                    }

                }
                let currentObj = this
                axios.post('/add_reminder_vacancy' ,{
                    data: this.m,
                })
                .then(function (response) {
                    // handle success
                    if (response.status == 200) {
                        toast.success("წარმატებით დაემატა", {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        currentObj.hide();
                    }



                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },
            getClassificatory(){
                return axios.post('/get_reminder_info' ,{
                      data: this.item.id,
                  })

            },
            changeFormat(time){
                return moment(time).format("YYYY-MM-DD HH:mm")
            }

        },
        watch:{
            visible: function(){
                this.show()
            },
        }
  }
  </script>
  <style scoped>
  .modal-body{
      height: 250px;
      overflow-y: auto;
  }

  @media (min-height: 500px) {
      .modal-body { height: 400px; }
  }

  @media (min-height: 800px) {
      .modal-body { height: 600px; }
  }
  </style>
