<template lang="">
    <!-- Modal -->
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  style="display:block">
          <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h6 class="modal-title" id="exampleModalLongTitle">სტატუსის შეცვლა</h6>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
              </div>
              <div class="modal-body">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>{{ $t('სტატუსი') }}</label>
                        <div class="ls-inputicon-box">
                            <multiselect v-model="m.status" :options="data.status" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" :placeholder="$t('lang.employer_add_job_select')"  :searchable="true" :allow-empty="false">
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                        </div>
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
                                <input class="form-control" v-model="m.status_change_reason" type="datetime-local" placeholder="" rows="3">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label> შეხსენების მიზეზი </label>
                                <textarea class="form-control" v-model="m.status_change_reason" type="text" placeholder="" rows="3"></textarea>
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
  </template>
  <script>
  import { toast } from 'vue3-toastify';
  import 'vue3-toastify/dist/index.css';

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
                reminder:{},
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
            // async
            show(){
                this.showConfirm = true

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
            save(){
                var editedFields = this.forItem(this.m)
                axios.post('/update_vacancy_status' ,{
                    data: {'model':this.m, 'edit': editedFields},
                })
                .then(function (response) {
                    // handle success
                    if (response.status == 200) {
                        toast.success("წარმატებით დაემატა", {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        setTimeout(() => {
                            document.location.reload();
                        }, 2000);
                    }



                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },
            // getClassificatory(){
            //     return axios.post('/get_status_change_info' ,{
            //           data: this.item.id,
            //       })

            // },
            // forItem(item){
            //     var editedFields = {}
            //     for (const field in item) {
            //         if ( item[field] !== this.item[field] ) {
            //                 editedFields[field] = this.item[field]
            //         }
            //     }
            //     return editedFields
            // },
            // changeFormat(time){
            //     return moment(time).format("YYYY-MM-DD HH:mm")
            // }

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
