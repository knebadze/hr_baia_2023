<template lang="">
    <div class="row">
          <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">ჩანართები</h3>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">კანდიდატის ჩარიცხვა</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">დამსაქმებლის ჩარიცხვა</a></li>
                  <li v-if="data.register" class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">რეგისტრაციის ჩარიცხვა</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <div v-if="candidateEnrollment" class="alert alert-info alert-dismissible">
                        <h5><i class="icon fas fa-info"></i> შეტყობინება!</h5>
                        ამ ვაკანსიაზე თქვენ ელოდებით თანხის <u>{{ ( candidateEnrollment.type == 0)?'არასრული':'სრული' }}</u> ჩარიცხვის დადასტურებას.
                        <ul>
                            <li>დასადასტურებელი თანხა: {{ candidateEnrollment.money }} ლარი</li>
                        </ul>
                    </div>
                    <div class="row py-3 border border-success">
                        <!-- <div class="row"></div> -->

                        <div class="row col-md-12" v-if="m.must_be_enrolled_candidate != 0">
                            <div class=" col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>კანდიდატისგან  <span class="text-danger">სულ </span>უნდა ჩაირიცხოს</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.candidate_initial_amount" type="number" placeholder="0" >
                                    </div>
                                </div>
                            </div>
                            <div class=" col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>კანდიდატისგან უნდა ჩაირიცხოს თარიღი</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.must_be_enrolled_candidate_date" type="date" >
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-12">
                                <div class="form-group">
                                    <label>ჩასარიცხი დარჩა</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.must_be_enrolled_candidate" type="number" placeholder="0" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <button v-if="hasDeposit" type="button" class="btn btn-success float-right" @click.prevent="save()" ><i class=""></i>შენახვა</button>
                                <button v-else-if="!candidateEnrollment" type="button" class="btn btn-success float-right" @click.prevent="redacted()" ><i class=""></i>რედაქტირების შენახვა</button>
                            </div>
                            <div class="row col-md-12" v-if="m.must_be_enrolled_candidate != null">
                                <div class=" col-md-12 border-top border-bottom"><h5 class="mt-2 text-danger text-center">მიმდინარე ჩარიცხვა</h5></div>

                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>ამჟამინდელი ჩარიცხვის თანხა  </label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="enrollmentCandidate.money" type="number" placeholder="0" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>თანხა ჩარიცხა  </label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="enrollmentCandidate.name" type="text" placeholder="0" >
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-12">
                                    <div class="form-group">
                                        <label>ქვითარი </label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" type="file" ref="fileInput" @change="handleFileChange">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button v-if="!candidateEnrollment" type="button" class="btn btn-primary float-right" @click.prevent="counting(1)" ><i class=""></i>ჩარიცხვა</button>
                                </div>
                            </div>

                        </div>
                        <div v-else class=" col-md-12">
                            <div class="form-group">
                                <label>კანდიდატისგან სულ ჩაირიცხა</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.candidate_initial_amount" type="number" placeholder="0" disabled>
                                </div>
                            </div>
                        </div>

                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                    <div v-if="employerEnrollment" class="alert alert-info alert-dismissible">
                        <h5><i class="icon fas fa-info"></i> შეტყობინება!</h5>
                        ამ ვაკანსიაზე თქვენ ელოდებით თანხის <u>{{ ( employerEnrollment.type == 0)?'არასრული':'სრული' }}</u>  ჩარიცხვის დადასტურებას.
                        <ul>
                            <li>დასადასტურებელი თანხა: {{ employerEnrollment.money }} ლარი</li>
                        </ul>
                    </div>
                    <div class="row py-3 border border-success">
                        <!-- <div class="row"></div> -->
                        <div class="row col-md-12" v-if="m.must_be_enrolled_employer != null">
                            <div class=" col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>დამსაქმებლისგან  <span class="text-danger">სულ </span>უნდა ჩაირიცხოს</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.employer_initial_amount" type="number" placeholder="0" >
                                    </div>
                                </div>
                            </div>
                            <div class=" col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>დამსაქმებლისგან უნდა ჩაირიცხოს თარიღი</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.must_be_enrolled_employer_date" type="date" >
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-12">
                                <div class="form-group">
                                    <label>ჩასარიცხი დარჩა</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.must_be_enrolled_employer" type="number" placeholder="0" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button v-if="hasDeposit" type="button" class="btn btn-success float-right" @click.prevent="save()" ><i class=""></i>შენახვა</button>
                                <button v-else-if="!employerEnrollment" type="button" class="btn btn-success float-right" @click.prevent="redacted()" ><i class=""></i>რედაქტირების შენახვა</button>
                            </div>

                            <div class=" col-md-12 border-top border-bottom"><h5 class="mt-2 text-danger text-center">მიმდინარე ჩარიცხვა</h5></div>

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>ამჟამინდელი ჩარიცხვის თანხა  </label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="enrollmentEmployer.money" type="number" placeholder="0" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>თანხა ჩარიცხა  </label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="enrollmentEmployer.name" type="text" placeholder="0" >
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-12">
                                <div class="form-group">
                                    <label>ქვითარი </label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" type="file" ref="fileInput" @change="handleFileChange">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button v-if="!employerEnrollment" type="button" class="btn btn-primary float-right" @click.prevent="counting(2)" ><i class=""></i>ჩარიცხვა</button>
                            </div>
                        </div>
                        <div v-else class=" col-md-12">
                            <div class="form-group">
                                <label>დამსაქმებლისგან სულ ჩაირიცხა</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.employer_initial_amount" type="number" placeholder="0" disabled>
                                </div>
                            </div>
                        </div>


                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <component v-if="data.register"  :is="registerEnrollmentComponent" :item="componentItem" ></component>
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
          </div>
          <!-- /.col -->
        </div>
</template>
<script>
import { markRaw } from 'vue';
import moment from 'moment'
import _ from 'lodash';
export default {
    components:{
    },
    props:{
        data: Object
    },
    data() {
        return {
            m: null,
            editedFields:[],
            enrollmentEmployer:{},
            enrollmentCandidate:{},
            file:null,
            item:{},
            registerEnrollmentComponent: null,
            componentItem: null
        }
    },
    created(){

        this.m = {...this.data.deposit}
        console.log('this.m', this.data);
        this.item = this.data.deposit
        this.enrollmentEmployer = {
            'money': this.m.must_be_enrolled_employer,
            'name': this.data.employer.name_ka,
            'file_name': null
        }
        this.enrollmentCandidate = {
            'money': this.m.must_be_enrolled_candidate,
            'name': this.data.employer.name_ka,
            'file_name': null
        }
        this.data.register?this.registerEnrollment():null
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
        candidateEnrollment(){
            let find = null;
            if (this.data.enrollment) {
                find = _.find(this.data.enrollment, function(o) { return o.who_is_counting == 1; });
            }
            return find;
        },
        employerEnrollment(){
            let find = null;
            if (this.data.enrollment) {
                find = _.find(this.data.enrollment, function(o) { return o.who_is_counting == 2; });
            }
            return find;
        },
        hasDeposit(){
            const filter = Object.keys(this.data.deposit).filter((key) => this.data.deposit[key] !== null);
            return filter.length > 1 ? false : true
        }


    },
    methods:{
        handleFileChange(event) {
            this.file = event.target.files[0];
            this.enrollmentEmployer.file_name = this.file.name
        },
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
            // this.m.hr_bonus = (this.payment.candidate_payment + this.payment.employer_payment).toFixed(2)
            let currentObj = this
            this.$swal({
                title: 'ნამდვილად გსურთ ვაკანსიის ჩარიცხვის შენახვა?',
                //   showDenyButton: true,
                cancelButtonText:'არა',
                confirmButtonText: 'კი',
                showCancelButton: true,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios.post('/save_vacancy_deposit' ,{
                        data: {'model':this.m, 'edit': editedFields},
                    })
                    .then(function (response) {
                        // handle success
                        if (response.status == 200) {
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
        },
        redacted(){
            var editedFields = this.forItem(this.m)
            // this.m.hr_bonus = (this.payment.candidate_payment + this.payment.employer_payment).toFixed(2)
            let currentObj = this
            this.$swal({
                title: 'ნამდვილად გსურთ ვაკანსიის ჩარიცხვის რედაქტირება?',
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
                        if (response.status == 200) {
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
        },
        counting(type){
            let item;
            let enrollmentType;
            let enrolled;
            if (type == 1) {
                item = this.enrollmentCandidate
                enrollmentType = (item.money == this.m.must_be_enrolled_candidate)?1:0
                // enrolled = this.m.must_be_enrolled_candidate - item.money
            }else{
                item = this.enrollmentEmployer
                enrollmentType = (item.money == this.m.must_be_enrolled_employer)?1:0
                // enrolled = this.m.must_be_enrolled_employer - item.money
            }



            let model = {
                'id': this.m.id,
                'vacancy_id': this.m.vacancy_id,
                'who_is_counting': type,
                'type': enrollmentType,
                'name': item.name,
                'money': item.money,
            }
            const formData = new FormData();
            formData.append('data', JSON.stringify(model))
            if (this.file) {
                formData.append('file', this.file);
            }
            if (enrollmentType == 0) {

                this.$swal({
                    title: 'ნამდვილად გსურთ თანხის არასრული ჩარიცხვა? შეიყვანე შემდეგი გადახდის თარიღი',
                    html: '<input id="swal-input" type="date">',
                    // input: 'date',
                    showCancelButton: true,
                    cancelButtonText: 'გაუქმება',
                    confirmButtonText: 'შენახვა',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        const date = document.getElementById('swal-input').value;
                        return axios.post('/deposit_date_update?id=' + this.m.id + '&type=' + type + '&date=' + date)
                        .then(response => {
                            return response.data;
                        })
                        .catch(error => {
                            this.$swal.showValidationMessage(`Request failed: ${error}`);
                        });
                    },
                    allowOutsideClick: () => !this.$swal.isLoading(),
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.sendAxios(formData)
                    }
                });

            }else{
                this.$swal({
                    title: 'ნამდვილად გსურთ თანხის სრულად ჩარიცხვა?',
                    //   showDenyButton: true,
                    cancelButtonText:'არა',
                    confirmButtonText: 'კი',
                    showCancelButton: true,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        this.sendAxios(formData)

                    } else if (result.isDenied) {
                        return
                    }
                });
            }

        },
        sendAxios(formData){
            let currentObj = this;
            axios.post('/vacancy_enrollment', formData)
            .then(function (response) {
                if (response.status == 200) {
                    toast.success("წარმატებით ჩაირიცხა", {
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
        },
        async registerEnrollment(){
            if (!this.registerEnrollmentComponent) {

                let module = await import('../component/registration_enrollment.vue');
                this.registerEnrollmentComponent = markRaw(module.default);
            }

            this.componentItem = this.data.register
            this.componentItem.name = this.enrollmentCandidate.name
        }
    },
    watch:{
        'enrollmentEmployer.money': function(newVal, oldVal){
            if ( newVal > this.m.must_be_enrolled_employer) {

                toast.error("თქვენ მიერ ჩაწერილი თანხა აღემატება ჩასარიცხ თანხას", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                this.enrollmentEmployer.money = this.m.must_be_enrolled_employer
                return
            }else if( oldVal != undefined){
                // this.m.must_be_enrolled_employer = this.data.deposit.must_be_enrolled_employer - this.enrollmentEmployer.money
            }

        },

        'enrollmentCandidate.money': function(newVal, oldVal){
            if ( newVal > this.m.must_be_enrolled_candidate) {

                toast.error("თქვენ მიერ ჩაწერილი თანხა აღემატება ჩასარიცხ თანხას", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                this.enrollmentCandidate.money = this.m.must_be_enrolled_candidate
                return
            }else if( oldVal != undefined){
                // this.m.must_be_enrolled_candidate = this.data.deposit.must_be_enrolled_candidate - this.enrollmentCandidate.money
            }

        },
    }
}
</script>
<style lang="">

</style>
