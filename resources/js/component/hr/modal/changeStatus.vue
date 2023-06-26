<template lang="">
    <!-- Modal -->
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
          <div class="modal-dialog modal-dialog-centered " role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h6 class="modal-title" id="exampleModalLongTitle">ინფორმაცია</h6>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
              </div>
              <div class="modal-body">

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-success" @click.prevent="save(updateData)" ><i class=""></i>შეცვლა</button>
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
        },
        data() {
            return {
                showConfirm: false,
            }
        },
        created(){
            // this.showConfirm = this.visible
        },
        computed:{

        },
        methods:{
            show(){
                this.showConfirm = true
            },
            hide(){
                this.showConfirm = false
            },
            //   save(updateData){
            //       axios.post('/unknown_profile_update' ,{
            //           data: updateData,
            //       })
            //       .then(function (response) {
            //           // handle success
            //           console.log(response.data);
            //           if (response.status == 200) {
            //               toast.success("წარმატებით დაემატა", {
            //                   theme: 'colored',
            //                   autoClose: 1000,
            //               });
            //               setTimeout(() => {
            //                   document.location.reload();
            //               }, 2000);
            //           }



            //       })
            //       .catch(function (error) {
            //           // handle error
            //           console.log(error);
            //       })
            //   }

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
