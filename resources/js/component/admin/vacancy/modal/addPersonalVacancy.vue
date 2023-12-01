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
                <div v-if="busy">
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
                <div class="row" v-if="m.type && m.type.id == 4">
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
                            <input class="form-control" v-model="m.start_date" type="date" :min="startDateMin" :max="startDateMax">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> დასრულების თარიღი </label>
                            <input class="form-control" v-model="m.end_date" type="date" :min='startDateMin' :max="endDateMax">
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
  import vacancyFullInfoModal from '../modal/vacancyFullInfoModal.vue';
  import moment from 'moment'
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
                qualifyingType: [],
                startDateMin: null,
                startDateMax: null,
                endDateMax: null
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
                console.log('this.item', this.item,  new URL( location.href));
                try {
                    let result = await this.getClassificatory();
                    console.log('result', result.data);
                    this.cla = result.data.classificatory
                    this.qualifyingType = this.cla.qualifyingType.filter(item => item.id !== 6 && item.id !== 7);
                    this.info  = result.data.findCandidate
                    let filterQualifyingType = this.info && this.info.hasOwnProperty('this_vacancy') && this.info.this_vacancy ? this.cla.qualifyingType.filter(item => item.id >= this.info.this_vacancy.qualifying_type_id &&  item.id < 6) : this.qualifyingType
                    this.qualifyingType = filterQualifyingType
                    this.busy = (result.data.busy != null)?{...result.data.busy}:null
                    this.m = {...this.item}
                    this.m['type'] = (result.data.findCandidate && result.data.findCandidate.this_vacancy )?result.data.findCandidate.this_vacancy.qualifying_type:null
                    this.m.interview_place = !this.m.interview_place ? this.cla.interviewPlace.find( (o) => o.id == this.m.interview_place_id): this.m.interview_place
                    this.showConfirm = true
                    const currentDate = moment();
                    this.startDateMin = currentDate.format('YYYY-MM-DD');
                    const startDateMoment = moment(this.m.start_date);
                    const endDateMoment = moment(this.m.start_date);
                    this.startDateMax = startDateMoment.subtract(5, 'days').format('YYYY-MM-DD');
                    this.endDateMax = endDateMoment.subtract(1, 'days').format('YYYY-MM-DD');

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
                let data = this.rule(this.m)
                // this.rule(this.m)
                // return
                let currentObj = this
                axios.post('/add_vacancy_personal' ,{
                    data: data,
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

            rule(item){
                if ( item.type.id == 5) {
                    const start_date = moment(item.start_date).format('YYYY-MM-DD');
                    const end_date = moment(item.end_date).format('YYYY-MM-DD');
                    if (this.info.another_vacancy) {
                        this.info.another_vacancy.forEach(element => {
                            if (element.qualifying_type_id == 5) {
                                let start = moment(element.start_date).format('YYYY-MM-DD');
                                let end = moment(element.end_date).format('YYYY-MM-DD');
                                if (moment(start_date).isBetween(start, end) || moment(end_date).isBetween(start, end)) {
                                    // Do something if start_date or end_date is between start and end
                                    toast.error("არჩეულ დღეებში კანდიდატი დაკავებულია", {
                                        theme: 'colored',
                                        autoClose: 1000,
                                    });
                                    return
                                }
                            }
                            // else if (element.type.id == 3) {
                            //     let interview_date = moment(item.interview_date).add(1, 'hours').format('YYYY-MM-DD HH');
                            //     let min_interview_date = moment(element.interview_date).subtract(1, 'hours').format('YYYY-MM-DD HH');
                            //     let max_interview_date = moment(element.interview_date).add(1, 'hours').format('YYYY-MM-DD HH');
                            //     if (moment(interview_date).isBetween(min_interview_date, max_interview_date)) {

                            //     }
                            // }

                        });
                    }
                }
                return item
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
                        let url = new URL( location.href)
                        const parts = url.pathname.split('/');
                        const link = parts[parts.indexOf('admin') + 1];
                        console.log(link, parts);
                        if (link == 'selection_personal') {
                            currentObj.emitMessage(false)
                        }else{
                            setTimeout(() => {
                                document.location.reload();
                            }, 1500);
                        }
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
                                let url = new URL( location.href)
                                const parts = url.pathname.split('/');
                                const link = parts[parts.indexOf('admin') + 1];
                                console.log(link, parts);
                                if (link == 'selection_personal') {
                                    currentObj.emitMessage(false)
                                }else{
                                    setTimeout(() => {
                                        document.location.reload();
                                    }, 1500);
                                }
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
