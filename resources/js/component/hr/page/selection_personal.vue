<template lang="">
    <section class="content ">
    <div class="container-fluid">
        <div id="accordion">
            <div class="card card-primary">
                <div class="card-header">
                  <h4 class="card-title w-100 d-flex justify-content-between">
                    <a class="d-block w-100" data-toggle="collapse"  href="#collapseOne">
                      პერსონალის ძიება
                    </a>
                    <i class="fas fa-angle-down float-right"></i>
                  </h4>
                </div>
                <div id="collapseOne" class="collapse" :class="colspan" data-parent="#accordion" >
                    <div class="card-body">
                    <!-- <h5 class="ml-2"><i class="fa fa-map" ></i> ინფორმაცია სარეგისტრატორო უბანზე:</h5> -->
                        <div class="row">
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>სახელი გვარი</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.name"  type="text" placeholder="Devid Smith">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>ტელეფონის ნომერი</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.number"  type="text" placeholder="555444333" onkeypress="return event.which != 32">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>პირადი ნომერი</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.personal_number"  type="text" placeholder="01234567890" onkeypress="return event.which != 32">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>მისამართი</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.address"  type="text" placeholder="თბილის სამგორი კახეთის გზატკეცილი">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label class="ml-4"> ასაკი</label>
                                    <div class="ls-inputicon-box mt-4">
                                        <!-- <input class="form-control" v-model="m.min_age"  type="number" placeholder="25"> -->
                                        <Slider v-model="m.age" :min=18 :step=10 class="slider"/>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>მაქსიმალური ასაკი</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.max_age"  type="number" placeholder="45">
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>სიმაღლე</label>
                                    <div class="ls-inputicon-box mt-4">
                                        <!-- <input class="form-control" v-model="m.height"  type="number" placeholder="168"> -->
                                        <Slider v-model="m.height" :min=140  :max=220 :step=10 class="slider"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>წონა</label>
                                    <div class="ls-inputicon-box mt-4">
                                        <!-- <input class="form-control" v-model="m.weight"  type="number" placeholder="75"> -->
                                        <Slider v-model="m.weight" :min=40  :max=120 :step=10 class="slider"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>სქესი</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.gender" :options="cla.gender" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-6 col-md-12" >
                                <div class="form-group">
                                    <label>ეროვნება</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.nationality"  :options="cla.nationality" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12" >
                                <div class="form-group">
                                    <label>მოქალაქეობა</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.citizenship"  :options="cla.citizenship" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12" >
                                <div class="form-group">
                                    <label>რელიგია</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.religion"  :options="cla.religions" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-6 col-md-12" >
                                <div class="form-group">
                                    <label>განათლება</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.education"  :options="cla.educations" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12" >
                                <div class="form-group">
                                    <label>პროფესია</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.profession"  :options="cla.professions" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12" >
                                <div class="form-group">
                                    <label>სპეციალობა</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.specialty"  :options="cla.specialties" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12" >
                                <div class="form-group">
                                    <label>უცხო ენა</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.language"  :options="cla.languages" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12" >
                                <div class="form-group">
                                    <label>ცოდნის დონე</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.language_level"  :options="cla.languageLevels" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12" >
                                <div class="form-group">
                                    <label>მართვის მოწმობა</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.drivingLicense"  :options="cla.drivingLicense" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name" track-by="name" :preselect-first="false" >
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12" >
                                <div class="form-group">
                                    <label>ალერგია</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.allergy"  :options="cla.allergies" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12" >
                                <div class="form-group">
                                    <label>ზოგადი მახასიათებლები</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.characteristic"  :options="cla.characteristic" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12" >
                                <div class="form-group">
                                    <label>ოჯახური მდგომარეობა</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.maritalStatus"  :options="cla.maritalStatus" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-xl-4 col-lg-6 col-md-12" >
                                <div class="form-group">
                                    <label>ალერგია</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.education"  :options="cla.allergies" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>შვილების რაოდენობა</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.children"  type="text" placeholder="2">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 border "></div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>კატეგორია</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.category" :options="cla.category" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>გრაფიკი</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.work_schedule" :options="cla.workSchedule" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>ანაზღაურება</label>
                                    <div class="ls-inputicon-box mt-4">
                                        <!-- <input class="form-control" v-model="m.weight"  type="number" placeholder="75"> -->
                                        <Slider v-model="m.payment" :min=50  :max=5000 :step=10 class="slider"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 border "></div>
                            <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                <div class=" form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" v-model="m.go_vacation">
                                    <label class="form-check-label" for="exampleCheck1">შეეძლოს არდადეგებზე გაყოლა</label>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                <div class=" form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck2" value="1" v-model="m.stay_night">
                                    <label class="form-check-label" for="exampleCheck1">შეეძლოს ღამე დარჩენა</label>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                <div class=" form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck3" value="1" v-model="m.work_additional_hours">
                                    <label class="form-check-label" for="exampleCheck1">შეეძლო დამატებით საათებში მუშაობა</label>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                <div class=" form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck3" value="1" v-model="m.convection">
                                    <label class="form-check-label" for="exampleCheck1">არა ნასამართლევი</label>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                <div class=" form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck3" value="1" v-model="m.smoke">
                                    <label class="form-check-label" for="exampleCheck1">არა მწეველი</label>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                <div class=" form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck3" value="1" v-model="m.work_abroad">
                                    <label class="form-check-label" for="exampleCheck1">შეეძლო საზღვარ გარეთ მუშაობა</label>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                <div class=" form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck3" value="1" v-model="m.has_general_work_experience">
                                    <label class="form-check-label" for="exampleCheck1">ზოგადი სამუშაო გამოცდილება</label>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                <div class=" form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck3" value="1" v-model="m.has_family_work_experience">
                                    <label class="form-check-label" for="exampleCheck1">ოჯახში მუშაობის გამოცდილება</label>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                <div class=" form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck3" value="1" v-model="m.has_recommendation">
                                    <label class="form-check-label" for="exampleCheck1">რეკომენდაცია</label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-success" @click="find()"><i class="fa fa-search"></i> ძებნა</button>
                    </div>
                </div>
              </div>




        </div>
    </div>
    <!-- /.container-fluid -->
    <select_personal_table v-if="candidate.length > 0" :data="modalData" :key="tableKey"></select_personal_table>
  </section>
</template>
<script>
import Slider from '@vueform/slider'
import select_personal_table from '../component/select_personal_table.vue'

export default {
    components: {
      Slider,
      select_personal_table
    },
    props:{
        data: Object
    },
    data() {
        return {
            m:{},
            cla:null,
            candidate:[],
            colspan: 'show',
            modalData:{},
            vacancy:null,
            tableKey: 0,
        }
    },
    computed:{

    },
    created(){
        this.cla = this.data.classificatory
        this.m.height = [150, 200]
        this.m.weight = [60, 90]
        this.m.payment = (this.data.vacancy.payment)?[this.data.vacancy.payment-200, this.data.vacancy.payment+200]:[500, 2000]
        this.m.category = this.data.vacancy.category
        this.m.work_schedule = this.data.vacancy.work_schedule
        if (this.data.vacancy.demand) {
            this.m.age = ( this.data.vacancy.demand.min_age && this.data.vacancy.demand.max_age)?[this.data.vacancy.demand.min_age, this.data.vacancy.demand.max_age]:[18, 80]
            this.m.education = (this.data.vacancy.demand.education)?[this.data.vacancy.demand.education]:''
            this.m.specialty = (this.data.vacancy.demand.specialty)?[this.data.vacancy.demand.specialty]:''
            this.m.language = (this.data.vacancy.demand.language)?[this.data.vacancy.demand.language]:''
            this.m.language_level = (this.data.vacancy.demand.language_level)?[this.data.vacancy.demand.language_level]:''
        }else{
            this.m.age = [18, 80]
        }

        this.m.characteristic = (this.data.vacancy.characteristic)?this.data.vacancy.characteristic:''
        this.m.go_vacation = (this.data.vacancy.go_vacation == 1 )?true:''
        this.m.work_additional_hours = (this.data.vacancy.work_additional_hours == 1 )?true:''
        this.m.stay_night = (this.data.vacancy.stay_night == 1 )?true:''
        this.vacancy = {
            'vacancy_id': this.data.vacancy.id,
            'vacancy_code': this.data.vacancy.code,
            'interview_place': this.data.vacancy.interview_place,
            'interview_date': this.data.vacancy.interview_date
        }
        this.modalData['vacancy'] = this.vacancy
    },
    methods:{
        find(){
            this.colspan = 'hide'
            let currentObj = this;
            axios({
                    method: "post",
                    url: '/find_personal',
                    data: this.m,

                })
            .then(function (response) {
                // handle success
                console.log(response.data);
                currentObj.candidate = response.data
                currentObj.modalData['candidate'] = response.data
                currentObj.tableKey++

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        }
    },
    mounted() {
        console.log(this.data);
    },
}
</script>
<style scoped>
    .slider{
        --slider-height: 12px;

    }
</style>
