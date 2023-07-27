<template lang="">
    <!-- Modal -->
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h6 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-hourglass-start"></i> შეხსენების დამატება</h6>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
              </div>
              <div class="modal-body">
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
        },
        methods:{
            show(){

                    this.m = this.makeModel(this.item)
                    this.showConfirm = true
                    this.max = moment(moment().add(2, 'd').format('YYYY/MM/DD HH:mm')).toISOString().slice(0, -8)
                    this.min = moment(new Date()).toISOString().slice(0, -8);

            },
            hide(){
                this.showConfirm = false
            },
            makeModel(item){
                console.log(item);

                var newItem = {}
                newItem.vacancy_id = item.vacancy_id
                newItem.date = null
                newItem.reason = null
                newItem.active = 1
                newItem.id = item.id

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
                        setTimeout(() => {
                            document.location.reload();
                        }, 1500);
                    }



                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },

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
