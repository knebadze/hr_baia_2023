<template lang="">
    <!-- Modal -->
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
          <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h6 class="modal-title" id="exampleModalLongTitle">შეხსენების წაშლა</h6>
                  <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button> -->
              </div>
              <div class="modal-body ">
                    <div >
                        <p class="text-danger">ვაკანსიაზე ამ სტატუსის მინიჭების შემთხვევაში აუცილებელია წაიშალოს <u>არასაჭირო</u> შეხსენებები!!!</p>
                    </div>
                    <EasyDataTable
                        v-model:items-selected="itemsSelected"

                        :headers="headers"
                        :items="items"
                        table-class-name="customize-table"

                        border-cell

                    >
                    </EasyDataTable>

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger" @click.prevent="save()" ><i class=""></i>წაშლა</button>
              </div>
              </div>
          </div>
      </div>
  </template>
    <script>
    import { ref, computed, watchEffect } from "vue";
    import { toast } from 'vue3-toastify';
    import 'vue3-toastify/dist/index.css';
    import moment from 'moment'
    export default {
        components:{
        },
        props:{
            visible: Boolean,
            item: Object
        },
        setup(props){
            let showConfirm = ref(false)
            const items = ref([])
            const headers = ref()
            const itemsSelected = ref([]);
            watchEffect(() => {
                if (props.visible) {
                    show();
                    items.value = table()
                }

            });

            function show() {
                showConfirm.value = true
            }

            function table(params) {
                // return item
                itemsSelected.value = props.item
                 headers.value = [
                    // { text: "id", value: "code" },
                    { text: "თარიღი", value: "date" },
                    { text: "მიზეზი", value: "reason"},
                    // { text: "დამსაქმებელი", value: "employer.name_ka"},
                    // { text: "ნომერი", value: "employer.number"},
                    // { text: "სტატუსი", value: "status.name_ka"},
                    // { text: "ანაზღაურება", value: "payment", sortable: true},
                    // { text: "საჭიროება", value: "start_date", sortable: true},
                    // { text: "Operation", value: "operation" },
                ];
                let data = ref(props.item)
                return data
            }


            return {
                showConfirm,
                headers,
                items,
                itemsSelected,
                // hide
            }
        },


  }
  </script>
  <style lang="">

  </style>
