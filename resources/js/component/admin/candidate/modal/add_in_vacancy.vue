<template lang="">
    <!-- Modal -->
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">ვაკანსიისთვის კანდიდატის შერჩევა</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label> ჩაწერეთ ვაკანსიის ID </label>
                            <input class="form-control" v-model="searchId" type="text" placeholder="ID:" @input="searchEvent(searchId)"  onkeypress="return /[0-9]/i.test(event.key)">
                        </div>
                    </div>
                    <div v-if="items.length > 0">
                        <table class="table twm-table table-striped table-border">
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>შემკვეთი</th>
                                <th>კატეგორია</th>
                                <th>სტატუსი</th>
                                <th>HR</th>
                                <th>დამატება</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-if="items.length > 0" v-for="(item, index) in items" :key="index">
                                <td>{{ item.code }}</td>
                                <td>{{ item.employer.name_ka }}</td>
                                <td>{{ item.category.name_ka }}</td>
                                <td>{{ item.status.name_ka }}</td>
                                <td>{{ item.hr.user.name_ka }}</td>
                                <td>
                                    <button class="btn btn-info" @click="showModal(item)" title="დამატება" >
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                    <p v-else class="text-center text-danger">
                        საძიებო კოდით ვერ მოიძებნა ვერცერთი ვაკანსია რომელიც ამ ეტაპზე წარმოებაშია!!!
                    </p>
              </div>
              <div class="modal-footer">

                <button type="button" class="btn btn-secondary" @click="hide()" ><i class=""></i>გაუქმება</button>
              </div>
              </div>
          </div>
          <addPersonalVacancy :visible="showAddPersonalModal" :item="modalItem" :onMessageFromChildren="handleMessageFromChildren"></addPersonalVacancy>
      </div>
  </template>
  <script>
  import { toast } from 'vue3-toastify';
  import 'vue3-toastify/dist/index.css';
  import addPersonalVacancy from '../../../hr/modal/addPersonalVacancy.vue';
  export default {
        components:{
            addPersonalVacancy
        },
        props:{
            visible: Boolean,
            item: Object
        },
        data() {
            return {
                showConfirm: false,
                searchId: null,
                items: [],
                showAddPersonalModal: false,
                modalItem: {}
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
            show(){
                console.log('item', this.item);
                this.showConfirm = true

            },
            hide(){
                this.showConfirm = false
            },
            searchEvent(newVal){

                if (!newVal.length > 3) {
                    return
                }
                // alert()
                let currentObj = this
                axios.post('/find_vacancy' ,{
                    data: newVal,
                })
                .then(function (response) {
                    // handle success
                    console.log('response',response.data);
                    currentObj.items = response.data

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },
            showModal(item){
                this.showAddPersonalModal = !this.showAddPersonalModal
                this.modalItem = {
                    'candidate_id': this.item.id,
                    'interview_date':item.interview_date,
                    'interview_place':item.interview_place,
                    'vacancy_code':item.code,
                    'vacancy_id':item.id
                }
                // (this.vacancy)?this.vacancy:this.data.vacancy
                // this.modalItem['candidate_id'] = (this.itemsSelected.length > 0)?this.itemsSelected.map(({ id }) => id):item.id
            },
            handleMessageFromChildren(){}


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

