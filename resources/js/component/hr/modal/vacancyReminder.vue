<template lang="">
    <!-- Modal -->
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
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
                    <div class="row">
                        <div v-for="(item, index) in data.history" :key="index" class="col-md-5 ml-1 border border-success">
                            <p class=''><strong>შეხსენების თარიღი: </strong><span>{{ item.date }}</span></p>
                            <p  class=''><strong>შეხსენების მიზეზი: </strong><span>{{ item.reason }}</span></p>
                            <p class=''><strong>დამატების თარიღი: </strong><span>{{ changeFormat(item.created_at) }}</span></p>
                        </div>
                    </div>

                </div>
                <div v-if="data.history.length > 0">
                    <hr>
                    <h6><i class="fa fa-list"></i> ისტორია</h6>
                    <hr>
                    <div class="row">
                        <div v-for="(item, index) in data.history" :key="index" class="col-md-5 ml-1 border border-danger">
                            <p class=''><strong>შეხსენების თარიღი: </strong><span>{{ item.date }}</span></p>
                            <p  class=''><strong>შეხსენების მიზეზი: </strong><span>{{ item.reason }}</span></p>
                            <p class=''><strong>დამატების თარიღი: </strong><span>{{ changeFormat(item.created_at) }}</span></p>
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
  </template>
  <script>
  import { toast } from 'vue3-toastify';
  import 'vue3-toastify/dist/index.css';
  import moment from 'moment'
  export default {
        props:{
            visible: Boolean,
            item: Object
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
            console.log(this.min);
        },
        computed:{
            getLang(){
                return I18n.getSharedInstance().options.lang
            },
            // max(){
            //     let d = moment().format("DD/MM/YYYY")
            //     return  moment(moment('2023/07/11 16:00:00').add(7, 'd').format('YYYY/MM/DD HH:mm:ss'))
            //     // moment(moment(d).add(2, 'd').format('YYYY/MM/DD'))
            // }
        },
        methods:{
            async show(){
                try {
                    let result = await this.getClassificatory();
                    console.log('result', result.data);
                    this.data = result.data

                    this.m = this.makeModel(this.item)
                    console.log(this.m);
                    this.showConfirm = true
                    this.max = moment(moment().add(2, 'd').format('YYYY/MM/DD HH:mm')).toISOString().slice(0, -8)
                    this.min = moment(new Date()).toISOString().slice(0, -8)

                    // console.log('this.item',this.item);
                } catch (error) {
                    console.log(error);
                }

            },
            hide(){
                this.showConfirm = false
            },
            makeModel(item){
                console.log(item);

                var newItem = {}
                newItem.vacancy_id = item.id
                newItem.date = null
                newItem.reason = null

                return {...newItem}
            },
            save(){
                // if (this.m.status.id == 6) {
                //     this.m['reminder'] = this.reminder
                // }
                // var editedFields = this.forItem(this.m)
                // console.log('editedFields', editedFields);
                if (this.m.date == null || this.m.reason == null) {
                    toast.error("სავალდებულოა ორივე ველის შევსება", {
                        theme: 'colored',
                        autoClose: 1500,
                    });
                    return
                }
                let currentObj = this
                axios.post('/add_reminder_vacancy' ,{
                    data: this.m,
                })
                .then(function (response) {
                    // handle success
                    console.log(response.data);
                    if (response.status == 200) {
                        toast.success("წარმატებით დაემატა", {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        currentObj.hide();
                        // setTimeout(() => {
                        //     document.location.reload();
                        // }, 2000);
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
            // forItem(item){
            //     var editedFields = {}
            //     for (const field in item) {
            //         if ( item[field] !== this.item[field] ) {
            //                 editedFields[field] = this.item[field]
            //         }
            //     }
            //     return editedFields
            // },
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
