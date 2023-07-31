<template lang="">
    <!-- Modal -->
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
        <div class="modal-dialog modal-dialog-centered modal-xl " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">რედაქტირება</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <label for="exampleInputEmail1">სახელი გვარი</label>
                            <input class="form-control" v-model="m.user[`name_${getLang}`]" type="text" :placeholder="$t('lang.employer_add_job_vacancy_name_placeholder')">
                        </div>
                        <div class="col-6">
                            <label>მაილი</label>
                            <input class="form-control" v-model="m.user.email" type="email" placeholder="employer@gmail.com">
                        </div>
                        <div class="col-6">
                            <label>ტელეფონის ნომერი</label>
                            <input class="form-control" v-model="m.user.number" type="email" >
                        </div>
                        <!-- <div class="col-6">
                             <label>{{ ('ტელეფონის ნომერი') }}</label>
                            <div class="input-group input-group mb-3">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                                        <span :class="`fi fi-${numberCode.iso.toLowerCase()}`"></span>+{{ numberCode.phonecode }}
                                    </button>
                                    <ul class="dropdown-menu" style=" overflow: hidden; overflow-y: auto; max-height: calc(100vh - 550px);">
                                        <li v-for="item in cla.numberCode" @click="chooseNumberCode(item)"><a class="dropdown-item"><span :class="`fi fi-${item.iso.toLowerCase()}`"></span>+{{ item.phonecode }}</a></li>
                                    </ul>
                                </div>
                            <input type="text" class="form-control" aria-label="Text input with dropdown button" v-model="m.number" placeholder="555666777" onkeypress="return /[0-9]/i.test(event.key)" >
                            </div>
                        </div> -->
                        <div class="col-6">
                            <label for="exampleInputEmail1">მისამართი</label>
                            <input class="form-control" v-model="m[`address_${getLang}`]" type="text" >
                        </div>
                    </div>
                    <div class=" p-a20 my-3">
                        <h6 class=" m-a0"><i class="fa fa-info"></i> ძირითადი ინფორმაცია</h6>
                    </div>
                    <hr>
                    <!-- <div class="row">

                        <div class="col-4">
                            <label for="exampleInputEmail1">სათაური</label>
                            <input class="form-control" :class="(!m.title_ka)?'border border-danger':''" v-model="m[`title_${getLang}`]" type="text" :placeholder="$t('lang.employer_add_job_vacancy_name_placeholder')">
                        </div>
                        <div class="col-4">
                            <label >კატეგორია</label>
                            <div class="ls-inputicon-box">
                                <multiselect  v-model="m.category" :options="cla.category" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                </multiselect>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12" >
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ ('ვისთვის გესაჭიროებათ?') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.vacancy_for_who_need"  :options="cla.forWhoNeed" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" :placeholder="$t('lang.employer_add_job_select')" label="name_ka" track-by="name_ka" :preselect-first="false" :class="(!m.vacancy_for_who_need)?'border border-danger':''">
                                        <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_schedule_title') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.work_schedule" :options="cla.workSchedule" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false" >
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_salary_title') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.payment" type="number" step="50" >
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_currency_title') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.currency" :options="cla.currency" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false" >
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.employer_add_job_jobs_day') }}</label>
                                <div class="ls-inputicon-box">
                                    <textarea class="form-control" v-model="m[`additional_schedule_${getLang}`]" type="text" placeholder="" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class=" p-a20 my-3">
                        <h6 class=" m-a0"><i class="fa fa-info"></i> დამატებით</h6>
                    </div>
                    <hr>
                    <!-- <div class="row mb-4" v-if="m.category.id == 1 || m.category.id == 2 || m.category.id == 4">
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class=" form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" v-model="m.go_vacation">
                                <label class="form-check-label" for="exampleCheck1">შეეძლოს არდადეგებზე გაყოლა</label>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class=" form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck2" value="1" v-model="m.stay_night">
                                <label class="form-check-label" for="exampleCheck1">შეეძლოს ღამე დარჩენა</label>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class=" form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck3" value="1" v-model="m.work_additional_hours">
                                <label class="form-check-label" for="exampleCheck1">შეეძლო დამატებით საათებში მუშაობა</label>
                            </div>
                        </div>
                    </div> -->

                    <!-- <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.employer_add_job_when_need') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.start_date" type="date" placeholder="" >
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.employer_add_job_how_long') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.term" :options="cla.term" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false" >
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('ბენეფიტები') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.vacancy_benefit"  :options="cla.benefit" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" :placeholder="$t('lang.employer_add_job_select')" label="name_ka" track-by="name_ka" :preselect-first="false" >
                                        <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.employer_add_job_comment_for_agency') }}</label>
                                <textarea class="form-control" v-model="m.comment" type="text" :placeholder="$t('lang.employer_add_job_comment_for_agency_placeholder')" rows="3"></textarea>
                            </div>
                        </div>

                    </div> -->
                    <div class=" p-a20 my-3">
                        <h6 class=" m-a0"><i class="fa fa-user"></i> მოთხოვნები კანდიდატის მიმართ</h6>
                    </div>
                    <hr>
                    <!-- <div class="row">
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.employer_add_job_minimal_age') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.min_age" type="number" placeholder="25" >
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.employer_add_job_max_age') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.max_age" type="number" placeholder="45" >
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.employer_add_job_minimal_edu') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.education" :options="cla.educations" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" :placeholder="$t('lang.employer_add_job_select')"  :searchable="true" :allow-empty="false">
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ ('სპეციალობა') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.specialty" :options="cla.specialties" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" :placeholder="$t('lang.employer_add_job_select')"  :searchable="true" :allow-empty="false">
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.employer_add_job_preferred_foreign_language') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.language" :options="cla.languages" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" :placeholder="$t('lang.employer_add_job_select')"  :searchable="true" :allow-empty="false">
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.employer_add_job_foreign_language_level') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.language_level" :options="cla.languageLevels" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" :placeholder="$t('lang.employer_add_job_select')"  :searchable="true" :allow-empty="false">
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <label>{{ $t('lang.employer_add_job_general_character') }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="m.characteristic"  :options="cla.characteristic" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" :placeholder="$t('lang.employer_add_job_select')" label="name_ka" track-by="name_ka" :preselect-first="false">
                                    <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                </multiselect>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.employer_add_job_duties') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.vacancy_duty"  :options="cla.duty" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" :placeholder="$t('lang.employer_add_job_select')" label="name_ka" track-by="name_ka" :preselect-first="false" :class="(!m.vacancy_duty)?'border border-danger':''">
                                        <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                    </multiselect>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.employer_add_job_additional_duties') }}</label>
                                <textarea class="form-control" v-model="m[`additional_duty_${getLang}`]" type="text" placeholder="" rows="3"></textarea>
                            </div>
                        </div>
                    </div> -->
                    <div class=" p-a20 my-3">
                        <h6 class=" m-a0"><i class="fa fa-clock"></i> გასაუბრება</h6>
                    </div>
                    <hr>
                    <!-- <div class="row">
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('გასაუბრების თარიღი') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.interviewDate"  type="date"  >
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('გასაუბრების დრო') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.interviewTime"  type="time"  >
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('გასაუბრების ადგილი') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.interview_place" :options="cla.interviewPlace" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" :placeholder="$t('lang.employer_add_job_select')"  :searchable="true" :allow-empty="false">
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="hide()" ><i class=""></i>გაუქმება</button>
                    <button type="button" class="btn btn-success" @click.prevent="save()" ><i class=""></i>შენახვა</button>
                </div>
            </div>
        </div>
    </div>
  </template>
  <script>
  import { toast } from 'vue3-toastify';
  import 'vue3-toastify/dist/index.css';
  import _ from 'lodash'
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
                classificatory:{},
                numberCode: {
                    'phonecode': '',
                    'iso':''
                },
                editedFields:[]
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
                    // console.log('result', result);
                    this.classificatory = {...result.data}
                    this.cla = result.data
                    let item = this.item
                    this.m = {...this.item}
                    console.log(this.cla);
                    // this.cla.forWhoNeed = _.filter(this.classificatory.forWhoNeed, function(o) { return o.category_id == item.category_id; });
                    // this.cla.duty = _.filter(this.classificatory.duty, function(o) { return o.category_id == item.category_id; });
                    // this.m = this.makeModel(this.item)
                    // {...this.item}
                    // (this.m.stay_night == 1)? this.m.stay_night = true: this.m.stay_night = false
                    // this.makeModel()
                    console.log('this.item',this.item);
                    this.showConfirm = true
                } catch (error) {
                    console.log(error);
                }

            },
            hide(){
                this.showConfirm = false
            },
            getClassificatory(){
                return axios.post('/get_classificatory' ,{
                    //   data: updateData,
                  })

            },
            // makeModel(item){
            //     this.numberCode.phonecode = item.employer.number_code.phonecode
            //     item.number_code = item.employer.number_code
            //     this.numberCode.iso = item.employer.number_code.iso
            //     item.employer_id = item.employer.id
            //     item.name_ka = item.employer.name_ka
            //     item.name_en = item.employer.name_en
            //     item.name_ru = item.employer.name_ru
            //     item.email = item.employer.email
            //     item.number = item.employer.number
            //     item.address_ka = item.employer.address_ka
            //     item.address_en = item.employer.address_en
            //     item.address_ru = item.employer.address_ru
            //     if (item.stay_night == 1) {
            //         item.stay_night = true
            //     }
            //     if (item.go_vacation == 1) {
            //         item.go_vacation = true
            //     }
            //     if (item.work_additional_hours == 1) {
            //         item.work_additional_hours = true
            //     }
            //     item.demand_id = item.demand.id
            //     item.min_age = item.demand.min_age
            //     item.max_age = item.demand.max_age
            //     item.education = item.demand.education
            //     item.specialty = item.demand.specialty
            //     item.language = item.demand.language
            //     item.language_level = item.demand.language_level
            //     item.additional_duty_ka = item.demand.additional_duty_ka
            //     item.additional_duty_en = item.demand.additional_duty_en
            //     item.additional_duty_ru = item.demand.additional_duty_ru
            //     var splitData = item.interview_date.split(" ")
            //     item.interviewDate = splitData[0]
            //     item.interviewTime = splitData[1]
            //     item.lang = this.getLang
            //     return {...item}
            // },
            // chooseNumberCode(item){

            //     this.m.number_code = item
            //     console.log('this.m', this.m);
            //     this.numberCode = {
            //         'phonecode': item.phonecode,
            //         'iso':item.iso
            //     }
            // },
            // forItem(item){
            //     var editedFields = {}
            //     for (const field in item) {
            //         if ( item[field] !== this.item[field] ) {
            //                 editedFields[field] = this.item[field]
            //         }
            //     }
            //     // console.log('this.editedFields', this.editedFields);
            //     return editedFields
            // },
            // save(){
            //     if (this.m.title_ka == null || this.m.vacancy_for_who_need == null) {
            //         toast.error("აუცილებელია გაწითლებული ველების შევსება", {
            //             theme: 'colored',
            //             autoClose: 1000,
            //         });
            //         return;
            //     }
            //     var editedFields = this.forItem(this.m)
            //     console.log('editedFields',editedFields);
            //     let currentObj = this
            //     this.$swal({
            //         title: 'ნამდვილად გსურთ ვაკანსიის რედაქტირება?',
            //         //   showDenyButton: true,
            //         cancelButtonText:'არა',
            //         confirmButtonText: 'კი',
            //         showCancelButton: true,
            //     }).then((result) => {
            //     /* Read more about isConfirmed, isDenied below */
            //         if (result.isConfirmed) {
            //             axios.post('/update_vacancy' ,{
            //                 data: {'model':this.m, 'edit': editedFields},
            //             })
            //             .then(function (response) {
            //                 // handle success
            //                 // console.log(response.data);
            //                 if (response.status == 200) {
            //                     currentObj.hide()
            //                     toast.success("წარმატებით დარედაქტირდა", {
            //                         theme: 'colored',
            //                         autoClose: 1000,
            //                     });
            //                     setTimeout(() => {
            //                         document.location.reload();
            //                     }, 2000);
            //                 }



            //             })
            //             .catch(function (error) {
            //                 // handle error
            //                 console.log(error);
            //             })
            //             // this.hide()

            //         } else if (result.isDenied) {
            //             return
            //         }
            //     });

            // }

        },
        watch:{
            visible: function(){
                this.show()
            },
            m: {
                deep: true,
                handler(newValue, oldValue) {
                },

            },
            'm.category': function (newValue, oldValue) {
                console.log('newValue',newValue);
                if (newValue != this.item.vacancy_for_who_need && oldValue != null) {
                    this.m.title_ka = null
                    this.m.vacancy_for_who_need = null
                    this.m.vacancy_duty = null
                    this.cla.forWhoNeed = _.filter(this.classificatory.forWhoNeed, function(o) { return o.category_id == newValue.id; });
                    this.cla.duty = _.filter(this.classificatory.duty, function(o) { return o.category_id == newValue.id; });
                }

            }
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
