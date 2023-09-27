<template lang="">
    <!-- Modal -->
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h6 class="modal-title" id="exampleModalLongTitle">ვაკანსიისთვის კანდიდატის შერჩევა</h6>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
              </div>
              <div class="modal-body">
                <div v-if="info && info.hasOwnProperty('this_vacancy') && info.this_vacancy" class="col-12">
                    <div  class="alert alert-dismissible alert-info" >
                        <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                        <h5><i class="icon fas fa-info"></i> შეტყობინება!</h5>
                        <span>ეს კანდიდატი უკვე გყავთ დამატებული ამ ვაკანსიაზე <strong>{{ ` "${m.type.name}" ` }}</strong>  ველში</span>
                    </div>
                </div>

                <div v-if="info && info.hasOwnProperty('another_vacancy') && info.another_vacancy.length > 0" class="col-12">
                    <div  class="alert alert-dismissible alert-danger" >
                        <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                        <h5><i class="icon fas fa-info"></i> შეტყობინება!</h5>
                        <span>ეს კანდიდატი უკვე გყავთ დამატებული <u>სხვა</u> ვაკანსიაზე</span>
                        <ul class="border py-2">
                            <li v-for="(item, index) in info.another_vacancy" :key="index"><u class="text-primary" @click="openModal(item.vacancy.id)">{{ item.vacancy.code }}</u> -- {{ item.qualifying_type.name }}</li>
                        </ul>
                        <span>დარწმუნებული ხართ რომ მაინც გსურთ დაამატოთ ამ ვაკანსიაზეც?</span>
                    </div>
                </div>
                <div v-if="busy && !m.interview_place">
                    <p class="text-danger">ეს კანდიდატი უკვე ყავს ქვემოთ ჩამოთვლილ HR_ს (ებს) თავის აქტიურ ვაკანსიებში ჩასმული.
                    </p>
                        <h6>ინსტრუქცია</h6>
                    <p>მიმართეთ hr უთხარით
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>  კანდიდატის ID: {{ item.candidate_id }}
                        <i class="fa fa-arrow-right" aria-hidden="true"></i> ვაკანსისი ID: {{ item.vacancy_code }}
                        <i class="fa fa-arrow-right" aria-hidden="true"></i> სასურველი კატეგორია</p>
                    <ul>
                        <li v-for="(item, index) in busy" :key="index">{{ item.vacancy.hr.user.name_ka }} N: {{ item.vacancy.hr.user.number }}</li>
                    </ul>
                </div>
                <div v-else class=" col-md-12">
                    <div class="form-group">
                        <label>შესარჩევი კატეგორია</label>
                        <div class="ls-inputicon-box">
                            <multiselect v-model="m.type" :options="qualifyingType" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="აირჩიე ტიპი"  :searchable="true" :allow-empty="false">
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="m.type && m.type.id == 3">
                    <div class=" col-md-6" >
                        <div class="form-group">
                            <label>გასაუბრების ადგილი</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="m.interview_place" :options="cla.interviewPlace" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="აირჩიე ტიპი"  :searchable="true" :allow-empty="false">
                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                </multiselect>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                                <label> გასაუბრების დრო </label>
                                <input class="form-control" v-model="m.interview_date" type="datetime-local" >
                            </div>
                        </div>
                </div>
                <div class="row" v-if="m.type && m.type.id == 5">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> დაწყების თარიღი</label>
                            <input class="form-control" v-model="m.start_date" type="date" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> დასრულების თარიღი </label>
                            <input class="form-control" v-model="m.end_date" type="date" >
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button v-if="busy" type="button" class="btn btn-secondary" @click.prevent="hide()" ><i class=""></i>გაუქმება</button>
                <div v-else>
                    <div v-if="info && info.hasOwnProperty('this_vacancy') && info.this_vacancy">
                        <button  type="button" class="btn btn-danger mr-2" @click.prevent="deletePersonal()" ><i class=""></i>წაშლა</button>
                        <button  type="button" class="btn btn-success" @click.prevent="update()" ><i class=""></i>განახლება</button>
                    </div>

                    <button v-else type="button" class="btn btn-success" @click.prevent="save()" ><i class=""></i>შენახვა</button>
                </div>

              </div>
              </div>
          </div>
          <vacancyFullInfoModal :visible="modalShow" :vacancyId="vacancy_id"></vacancyFullInfoModal>
      </div>
  </template>
  <script>
  import { toast } from 'vue3-toastify';
  import 'vue3-toastify/dist/index.css';
  import vacancyFullInfoModal from '../../modal/vacancyFullInfoModal.vue';
  export default {
        components:{
            vacancyFullInfoModal
        },
        props:{
            visible: Boolean,
            item: Object,
            onMessageFromChildren: Function,
        },
        data() {
            return {
                showConfirm: false,
                cla:{},
                m: null,
                info: {},
                busy: null,
                modalShow:false,
                vacancy_id:null,
                qualifyingType: []
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
                    this.cla = result.data.classificatory
                    this.qualifyingType = this.cla.qualifyingType.filter(item => item.id !== 6 && item.id !== 7);
                    this.info  = result.data.findCandidate
                    this.busy = (result.data.busy != null)?{...result.data.busy}:null
                    this.m = {...this.item}
                    this.m['type'] = (result.data.findCandidate && result.data.findCandidate.this_vacancy )?result.data.findCandidate.this_vacancy.qualifying_type:null
                    this.showConfirm = true

                } catch (error) {
                    console.log(error);
                }

            },
            hide(){
                this.showConfirm = false
            },
            getClassificatory(){
                return axios.post('/get_add_personal_info' ,{
                    data: {'candidate_id':this.item.candidate_id, 'vacancy_id':this.item.vacancy_id },
                })

            },

            save(){

                let currentObj = this
                axios.post('/add_vacancy_personal' ,{
                    data: this.m,
                })
                .then(function (response) {
                    // handle success
                    if (response.status == 200) {
                        toast.success("წარმატებით დაემატა", {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        currentObj.emitMessage(true)
                        currentObj.hide()
                        // setTimeout(() => {
                        //     document.location.reload();
                        // }, 2000);
                    }



                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },
            update(){

                let currentObj = this
                axios.post('/update_vacancy_personal' ,{
                    data: this.m,
                })
                .then(function (response) {
                    // handle success
                    if (response.status == 200) {
                        toast.success("წარმატებით განახლდა", {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        currentObj.emitMessage(true)
                        currentObj.hide()
                        // setTimeout(() => {
                        //     document.location.reload();
                        // }, 2000);
                    }



                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },
            deletePersonal(){
                this.$swal(
                {
                    title: 'ნამდვილად გსურთ ამ კანდიდატის ამოშლა ვაკანსიიდან?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'კი',
                    denyButtonText: `არა`,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        let currentObj = this
                        axios.post('/delete_vacancy_personal' ,{
                            data: {'candidate_id':this.item.candidate_id, 'vacancy_id':this.item.vacancy_id },
                        })
                        .then(function (response) {
                            // handle success
                            if (response.status == 200) {
                                toast.success("წარმატებით წაიშალა", {
                                    theme: 'colored',
                                    autoClose: 1000,
                                });
                                currentObj.emitMessage(false)
                                currentObj.hide()
                                // setTimeout(() => {
                                //     document.location.reload();
                                // }, 2000);
                            }



                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        })
                    }
                    // else if (result.isDenied) {
                    //     Swal.fire('Changes are not saved', '', 'info')
                    // }
                })
            },
            emitMessage(bool) {
                this.onMessageFromChildren(this.item.candidate_id, bool);
            },
            openModal(id){
                this.modalShow = !this.modalShow
                this.vacancy_id = id
            }

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
