<template lang="">
    <!-- Modal -->
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
        <div class="modal-dialog modal-dialog-centered modal-xl " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-credit-card"></i> დეპოზიტი</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
                </div>
                <div class="modal-body">

                    <div class=" p-a20 my-3">
                        <h6 class=" m-a0">დამსაქმებელი </h6>
                    </div>
                    <hr>
                    <div class="row py-3 border border-success">
                        <!-- <div class="row"></div> -->
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>დამსაქმებლისგან <span class="text-danger">უნდა</span> ჩაირიცხოს</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.must_be_enrolled_employer" type="number" placeholder="0" >
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>დამსაქმებლისგან <span class="text-danger">უნდა</span> ჩაირიცხოს თარიღი</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.must_be_enrolled_employer_date" type="date" >
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12" v-if="m.must_be_enrolled_employer_date">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>დამსაქმებლისგან ჩაირიცხა</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.enrolled_employer" type="number" placeholder="" >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>დამსაქმებლისგან ჩარიცხვის თარიღი</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.enrolled_employer_date" type="datetime-local" min="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>ავანსი</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="payment.employer_payment" disabled type="text" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-md-12  d-flex justify-content-end">
                            <button type="button" class="btn btn-success" @click.prevent="save()" ><i class=""></i>შენახვა</button>
                        </div> -->


                    </div>
                    <div class=" p-a20 my-3">
                        <h6 class=" m-a0">კანდიდატი </h6>
                    </div>
                    <hr>
                    <div class="row py-3 border border-danger">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>კანდიდატისგან <span class="text-danger">უნდა</span> ჩაირიცხოს</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.must_be_enrolled_candidate" type="number" placeholder="45" >
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>კანდიდატისგან <span class="text-danger">უნდა</span> ჩაირიცხოს თარიღი</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.must_be_enrolled_candidate_date" type="date" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" v-if="m.must_be_enrolled_candidate_date ">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>კანდიდატისგან ჩაირიცხა</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.enrolled_candidate" type="number" placeholder="" >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>კანდიდატისგან ჩარიცხვის თარიღი</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.enrolled_candidate_date" type="date" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>ავანსი</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="payment.candidate_payment" disabled type="text" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-success" @click.prevent="save()" ><i class=""></i>შენახვა</button>
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <strong  class="text-danger">ავანსი სულ: {{ (payment.candidate_payment + payment.employer_payment).toFixed(2) }} ლარი</strong>
                    <div>
                        <button type="button" class="btn btn-secondary mr-3" @click="hide()" ><i class=""></i>გაუქმება</button>
                        <button type="button" class="btn btn-success" @click.prevent="save()" ><i class=""></i>შენახვა</button>
                    </div>

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
            item: Object
        },
        data() {
            return {
                showConfirm: false,
                m: null,
                cla:[],
                numberCode: {
                    'phonecode': '',
                    'iso':''
                },
                editedFields:[],
                payment:{
                    employer_payment:0,
                    candidate_payment:0,
                    sum:0
                }

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
                // try {
                //     let result = await this.getClassificatory();
                //     // console.log('result', result);
                //     this.cla = result.data

                    this.m = {...this.item}
                    this.payment = {
                        employer_payment:(this.m.enrolled_employer * this.m.employer_percent) / 100,
                        candidate_payment:(this.m.enrolled_candidate * this.m.candidate_percent) / 100,
                    }
                //     // {...this.item}
                //     // (this.m.stay_night == 1)? this.m.stay_night = true: this.m.stay_night = false
                // this.m = this.makeModel(this.item)
                    this.showConfirm = true
                // } catch (error) {
                //     console.log(error);
                // }

            },
            hide(){
                this.showConfirm = false
            },
            // getClassificatory(){
            //     return axios.post('/get_classificatory' ,{
            //         //   data: updateData,
            //       })

            // },
            makeModel(item){

                return {...item}
            },
            // save(){
            //     this.forItem(this.m)
            // },
            forItem(item){
                var editedFields = {}
                for (const field in item) {
                    if ( item[field] !== this.item[field] ) {
                            editedFields[field] = this.item[field]
                    }
                }
                return editedFields
            },
            save(){
                var editedFields = this.forItem(this.m)
                this.m.hr_bonus = (this.payment.candidate_payment + this.payment.employer_payment).toFixed(2)
                let currentObj = this
                this.$swal({
                    title: 'ნამდვილად გსურთ ვაკანსიის რედაქტირება?',
                    //   showDenyButton: true,
                    cancelButtonText:'არა',
                    confirmButtonText: 'კი',
                    showCancelButton: true,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        axios.post('/update_vacancy_deposit' ,{
                            data: {'model':this.m, 'edit': editedFields},
                        })
                        .then(function (response) {
                            // handle success
                            // console.log(response.data);
                            if (response.status == 200) {
                                currentObj.hide()
                                toast.success("წარმატებით დარედაქტირდა", {
                                    theme: 'colored',
                                    autoClose: 1000,
                                });
                                setTimeout(() => {
                                    document.location.reload();
                                }, 2000);
                            }



                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        })
                        // this.hide()

                    } else if (result.isDenied) {
                        return
                    }
                });

            }

        },
        watch:{
            visible: function(){
                this.show()
            },
            'm.enrolled_candidate': function(newVal, oldVal){
                if ( newVal > this.item.candidate_initial_amount  ) {
                    toast.error("თქვენ მიერ ჩაწერილი თანხა აღემატება ჩასარიცხ თანხას", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    this.m.enrolled_candidate = this.item.enrolled_candidate
                    this.payment.candidate_payment = (this.item.enrolled_candidate * this.m.candidate_percent) / 100
                }else if (newVal != oldVal ) {
                    (this.m.must_be_enrolled_candidate != 0)?this.m.must_be_enrolled_candidate = this.item.must_be_enrolled_candidate - this.m.enrolled_candidate:0
                    this.payment.candidate_payment = (newVal * this.m.candidate_percent) / 100

                }else if(oldVal != 0 && newVal == 0){
                    this.m.must_be_enrolled_candidate = this.item.must_be_enrolled_candidate
                }
            },
            'm.enrolled_employer': function(newVal, oldVal){
                if ( newVal > this.item.employer_initial_amount) {

                    toast.error("თქვენ მიერ ჩაწერილი თანხა აღემატება ჩასარიცხ თანხას", {
                        theme: 'colored',
                        autoClose: 1000,
                    });

                    this.m.enrolled_employer = this.item.enrolled_employer
                    this.payment.employer_payment = (this.item.enrolled_employer * this.m.employer_percent) / 100

                }else if (newVal != oldVal) {
                    (this.m.must_be_enrolled_employer != 0)?this.m.must_be_enrolled_employer = this.item.must_be_enrolled_employer - this.m.enrolled_employer:0
                    this.payment.employer_payment = (newVal * this.m.employer_percent) / 100

                }else if(oldVal != 0 && newVal == 0){
                    this.m.must_be_enrolled_employer = this.item.must_be_enrolled_employer

                }
            },
            // 'payment': function(newVal, oldVal){

            // }
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
      .modal-body { height: 700px;  }
  }
  </style>
