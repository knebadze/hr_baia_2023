<template lang="">
    <!-- Modal -->
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h6 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-hourglass-half"></i> შეხსენების ჩამონათვალი</h6>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
              </div>
              <div class="modal-body">
                <div>
                    <p class="text-danger">გადაცილებამდე დარჩა ნახევარი საათზე ნაკლები გთხოვთ დაუყოვნებლივ შეასრულოთ შეხსენების მიზეზი!!!</p>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>ვაკანსისი ID</th>
                                <th>შეხსენების მიზეზი</th>
                                <th>თარიღი</th>
                                <th>მოქმედება</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in items" :key="index">
                                <td>{{ index + 1 }}.</td>
                                <td><u class="text-primary" @click="vacancyModal(item.vacancy_id)">{{ item.vacancy.code }}</u> </td>
                                <td>{{ item.reason }}</td>
                                <td>{{ item.date }}</td>
                                <td>
                                    <button type="button" class="btn btn-info" @click="remainderShow(item)" title=""><i class="fa fa-check-square"></i> შევასრულე</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" @click="hide()" >გათიშვა</button>
              </div>
              </div>
          </div>
          <filledReminder  :visible="reminderModelShow" :item="item"></filledReminder>
          <vacancyFullInfoModal :visible="vacancyModelShow" :vacancyId="item"></vacancyFullInfoModal>
      </div>

  </template>
  <script>
  import { toast } from 'vue3-toastify';
  import 'vue3-toastify/dist/index.css';
  import moment from 'moment'
  import filledReminder from '../../admin/reminder/modal/filledReminder.vue';
  import vacancyFullInfoModal from '../../modal/vacancyFullInfoModal.vue';
    export default {
        components:{
            filledReminder,
            vacancyFullInfoModal
        },
        props:{
            visible: Boolean,
            items: Object
        },
        data() {
            return {
                showConfirm: false,
                reminderModelShow: false,
                item: null,
                vacancyModelShow:false
            }
        },
        created(){
        },
        computed:{
            getLang(){
                return I18n.getSharedInstance().options.lang
            },
        },
        methods:{
            show(){
                this.showConfirm = true

            },
            hide(){
                this.showConfirm = false
            },
            remainderShow(item){
                this.reminderModelShow = !this.reminderModelShow
                this.item = {
                    'id': item.id,
                    'vacancy_id':item.vacancy_id
                }
            },
            vacancyModal(id){
                this.vacancyModelShow = !this.vacancyModelShow
                this.item = id
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
