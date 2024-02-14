<template lang="">
    <!-- Modal -->
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h6 class="modal-title" id="exampleModalLongTitle">შეტყობინების გაგზავნა</h6>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
              </div>
              <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label> ნომერი</label>
                            <input class="form-control" v-model="m.number" type="text">
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>დამატებითი ნომერი</label>
                            <div class="ls-inputicon-box d-flex">
                                <button class="mr-2" :class="{'btn btn-secondary': true}" v-for="(item, index) in cla" :key="index" @click="choseNumber(item)">
                                    {{ `${item.number_code.phonecode}-${item.number} - (${item.number_owner.name_ka})`}}
                                </button>
                                <button :class="{'btn btn-primary': true}" @click="choseNumber('main')">
                                    {{item.number}} - (ძირითადი)
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label> ტექსტი</label>
                            <textarea class="form-control" v-model="m.text" rows="3" placeholder=""></textarea>
                        </div>
                    </div>
                </div>

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-success" @click.prevent="save()" ><i class=""></i>გაგზავნა</button>
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
                m: {},
                reminder:{},
                cla: null,
                min:null,
                selectNumber:0
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
                    console.log(result);
                    this.cla = result.data
                    console.log(this.item);
                    this.m = {...this.item}
                    this.showConfirm = true
                } catch (error) {
                }

            },
            hide(){
                this.showConfirm = false
            },
            getClassificatory(){
                return axios.post('/get_candidate_additional_number' ,{
                      data: this.item.id,
                  })

            },
            choseNumber(item){
                if (item === 'main') {
                    this.m.number = this.item.number
                }else{
                    this.m.number = item.number
                }
            },
            save(){
                let currentObj = this
                this.$swal({
                    title: 'ნამდვილად გსურთ სმს გაგზავნა?',
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
                            url: "/send_sms_candidate",
                            data:  this.m,

                        })
                        .then(function (response) {
                            if (response.status == 200) {

                                toast.success('წარმატებით გაიგზავნა', {
                                    theme: 'colored',
                                    autoClose: 1000,
                                });

                            }else{
                                toast.error('ვერ გაიგზავნა', {
                                    theme: 'colored',
                                    autoClose: 1000,
                                });
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
