<template lang="">
    <!-- Modal -->
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h6 class="modal-title" id="exampleModalLongTitle">შავ სიაში დამატება</h6>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
              </div>
              <div class="modal-body">
                <div v-if="type == 'employer' && check" class="alert alert-info alert-dismissible">
                    <h5><i class="icon fas fa-info"></i> შეტყობინება!</h5>
                    <p>ამ დამსაქმებელს აქვს ვაკანსია (ები) აქტიურ სტატუსში:</p>
                    <ul>
                        <li v-for="(item, index) in check" :key="index">ID: <a><u>{{ item.code }},</u></a> სტატუსი: {{ item.status.name_ka }}</li>
                    </ul>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>შავ სიაში დამატების მიზეზი</label>
                        <div class="ls-inputicon-box">
                            <multiselect v-model="m.reason" :options="cla" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" :placeholder="$t('lang.employer_add_job_select')"  :searchable="true" :allow-empty="false">
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>დამატებითი კომენტარი</label>
                        <div class="ls-inputicon-box">
                            <textarea class="form-control" v-model="m.comment" type="text" placeholder="" rows="3"></textarea>
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
            item: Object,
            type: String
        },
        data() {
            return {
                showConfirm: false,
                data: {},
                m: {},
                reminder:{},
                cla: null,
                check: null
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
                    this.cla = result.data.cla
                    this.check = result.data.check
                    this.m = this.item
                    this.showConfirm = true
                } catch (error) {
                    console.log(error);
                }

            },
            hide(){
                this.showConfirm = false
            },
            save(){
                if (!this.m.hasOwnProperty('reason')) {
                    toast.error('შევსება სავალდებულოა', {
                        theme: 'colored',
                        autoClose: 2000,
                    });
                    return
                }
                let currentObj = this
                this.$swal({
                    title: 'ნამდვილად გსურთ შავ სიაში დამატება?',
                    // html:'ცვლილება ავტომატურად მოხსნის კანდიდატს ვაკანის დასაქმებული სტატუსიდან',
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
                            url: "/add_black_list",
                            data: {'model': this.m, 'type': this.type},

                        })
                        .then(function (response) {
                            if (response.status == 200) {
                                toast.success('წარმატებით შესრულდა', {
                                    theme: 'colored',
                                    autoClose: 1000,
                                });
                                setTimeout(() => {
                                    document.location.reload();
                                }, 1500);
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
                return axios.post('/get_add_black_list_info' ,{
                      data: {'id':this.item.id, 'type': this.type},
                  })

            },
            showFullVacancyModal(){

            }

        },
        watch:{
            visible: {
                immediate: true,
                handler(newVal) {
                    this.show()
                },
            },
        }
  }
  </script>
  <style lang="">

  </style>
