<template lang="">
    <!-- Modal -->
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
          <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h6 class="modal-title" id="exampleModalLongTitle">რედაქტირება</h6>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
              </div>
              <div class="modal-body">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>სახელი გვარი</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="m.name_ka" type="text" placeholder="" >
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>ნომერი</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="m.number" type="text" placeholder="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>მაილი</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="m.email" type="email" placeholder="" >
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>მისამართი</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="m.address_ka" type="text">
                            </div>
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
                m: {},
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
                this.m = {...this.item}

            },
            hide(){
                this.showConfirm = false
            },
            save(){
                let currentObj = this
                this.$swal({
                    title: 'ნამდვილად გსურთ რედაქტირება?',
                    cancelButtonText:'არა',
                    confirmButtonText: 'კი',
                    showCancelButton: true,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                // return
                    if (result.isConfirmed) {
                        axios({
                            method: "post",
                            url: "/employer_update",
                            data: {'model': this.m},

                        })
                        .then(function (response) {
                            // Check if the response contains a message
                            if (response.data && response.data.message) {

                                if (response.status === 200) {
                                    // Success message
                                    toast.success(response.data.message, {
                                        theme: 'colored',
                                        autoClose: 1000,
                                    });
                                    setTimeout(() => {
                                        document.location.reload();
                                    }, 1500);
                                } else {

                                    // Handle other types of messages (if needed)
                                    toast.error(response.data.message, {
                                        theme: 'colored',
                                        autoClose: 1000,
                                    });
                                }
                            } else {
                                // Handle cases where the response doesn't contain a message
                                console.error("Unexpected response format");
                            }
                        })
                        .catch(function (error) {
                            // Handle network or other errors
                            console.error(error);
                        });

                    } else if (result.isDenied) {
                        return
                    }
                });
            },
            getClassificatory(){
                return axios.post('/get_add_black_list_info' ,{
                      data: {'id':this.item.id, 'type': this.item.type},
                  })

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
