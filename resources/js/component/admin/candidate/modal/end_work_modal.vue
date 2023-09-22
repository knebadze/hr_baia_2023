<template lang="">
    <!-- Modal -->
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
          <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h6 class="modal-title" id="exampleModalLongTitle">მუშაობის შეწყვეტა</h6>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
              </div>
              <div class="modal-body">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>შეწყვეტის მიზეზი</label>
                        <div class="ls-inputicon-box">
                            <multiselect v-model="m.reason" :options="cla" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" :placeholder="$t('lang.employer_add_job_select')"  :searchable="true" :allow-empty="false">
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label> შეწყვეტის მიზეზის დამატებითი აღწერა</label>
                        <textarea class="form-control" v-model="m.reason_info" type="text" placeholder="" rows="3"></textarea>
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
            item: Number
        },
        data() {
            return {
                showConfirm: false,
                data: {},
                m: {},
                reminder:{},
                cla: null
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
                    this.cla = result.data
                    this.m.id = this.item
                    this.showConfirm = true
                } catch (error) {
                    console.log(error);
                }

            },
            hide(){
                this.showConfirm = false
            },
            // makeModel(item){
            //     var newItem = {}
            //     newItem.id = item.id
            //     newItem.status = item.status
            //     newItem.status_change_reason = item.status_change_reason

            //     return {...newItem}
            // },
            save(){
                if (!this.m.hasOwnProperty('reason') || !this.m.hasOwnProperty('reason_info')) {
                    toast.error('შევსება სავალდებულოა', {
                        theme: 'colored',
                        autoClose: 2000,
                    });
                    return
                }
                let currentObj = this
                this.$swal({
                    title: 'ნამდვილად გსურთ სამუშაოს დასრულება?',
                    html:'ცვლილება ავტომატურად მოხსნის კანდიდატს ვაკანის დასაქმებული სტატუსიდან',
                    //   showDenyButton: true,
                    cancelButtonText:'არა',
                    confirmButtonText: 'კი',
                    showCancelButton: true,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                // return
                    if (result.isConfirmed) {
                        axios({
                            method: "post",
                            url: "/end_work",
                            data: {'model': this.m},

                        })
                        .then(function (response) {
                            if (response.data.status == 200) {
                                if (response.data.data.type == 'e') {
                                    toast.error(response.data.data.message, {
                                        theme: 'colored',
                                        autoClose: 2000,
                                    });
                                    currentObj.hide()
                                }else{
                                    toast.success(response.data.data.message, {
                                        theme: 'colored',
                                        autoClose: 1000,
                                    });
                                    currentObj.hide()
                                    setTimeout(() => {
                                        document.location.reload();
                                    }, 1500)
                                }

                            }
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        })

                    } else if (result.isDenied) {
                        return
                    }
                });
            },
            getClassificatory(){
                return axios.post('/get_end_work_info' ,{
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
