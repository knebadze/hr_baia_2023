<template lang="">
    <!-- Modal -->
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
        <div class="modal-dialog modal-dialog-centered modal-xl " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-"></i> ვაკანსია ID: {{ item.code }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
                </div>
                <div class="modal-body">

                    <div class=" p-a20">
                        <h6 class=" m-a0"><i class="fa fa-info"></i> ინფორმაცია </h6>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 border">
                            <dl class="row">
                                <!-- <dt class="col-sm-4">HR:</dt>
                                <dd class="col-sm-8">{{ item.hr.user.name_ka }}</dd> -->
                                <!-- <div class="row col-12 border-top"> -->
                                    <dt class="col-sm-4">დამსაქმებელი:</dt>
                                    <dd class="col-sm-8">{{ item.employer.name_ka }}</dd>
                                <!-- </div> -->
                                <div class="row col-12 border-top">
                                    <dt class="col-sm-4">დამსაქმებელის ნომერი:</dt>
                                    <dd class="col-sm-8">{{ item.employer.number }}</dd>
                                </div>
                                <div class="row col-12 border-top">
                                    <dt class="col-sm-4">სათაური:</dt>
                                    <dd class="col-sm-8">{{ item.title_ka }}</dd>
                                </div>
                                <div class="row col-12 border-top">
                                    <dt class="col-sm-4">კატეგორია:</dt>
                                    <dd class="col-sm-8">{{ item.category.name_ka }}</dd>
                                </div>
                                <div class="row col-12 border-top">
                                    <dt class="col-sm-4">სტატუსი:</dt>
                                    <dd class="col-sm-8">{{ item.status.name_ka }}</dd>
                                </div>
                                <div class="row col-12 border-top">
                                    <dt class="col-sm-4">სამუშაო დღეები:</dt>
                                    <dd class="col-sm-8">{{ item.additional_schedule_ka }}</dd>
                                </div>
                                <div class="row col-12 border-top" v-if="item.vacancy_for_who_need.length > 0">
                                    <dt class="col-sm-4">ვისთვის ესაჭიროება:</dt>
                                    <dd class="col-sm-8"><span v-for="(i, index) in item.vacancy_for_who_need" :key="index">{{ i.name_ka+', ' }}</span> </dd>
                                </div>
                                <div class="row col-12 border-top" v-if="item.vacancy_benefit.length > 0">
                                    <dt class="col-sm-4">ბენეფიტები:</dt>
                                    <dd class="col-sm-8"><span v-for="(i, index) in item.vacancy_benefit" :key="index">{{ i.name_ka+', ' }}</span> </dd>
                                </div>
                                <div class="row col-12 border-top" v-if="item.stay_night == 1 || item.go_vacation == 1 || item.work_additional_hours == 1">
                                    <dt class="col-sm-4">უნდა შეეძლოს:</dt>
                                    <dd class="col-sm-8">
                                        <span v-if="item.stay_night == 1"> ღამე დარჩენა, </span>
                                        <span v-if="item.go_vacation  == 1"> არდადეგებზე გაყოლა, </span>
                                        <span v-if="item.work_additional_hours == 1"> დამატებითი საათები მუშაობა, </span>
                                    </dd>
                                </div>

                                <div class="row col-12 border-top" v-if="item.vacancy_duty.length > 0">
                                    <dt class="col-sm-4">მოვალეობები:</dt>
                                    <dd class="col-sm-8"><span v-for="(i, index) in item.vacancy_duty" :key="index" >{{ i.name_ka+', ' }}</span> </dd>
                                </div>
                                <div class="row col-12 border-top" v-if="item.demand && item.demand.additional_name_ka">
                                    <dt class="col-sm-4">დამატებითი მოვალეობები:</dt>
                                    <dd class="col-sm-8">{{ item.demand.additional_name_ka }} </dd>
                                </div>
                                <div class="row col-12 border-top" v-if="item.vacancy_driving_license.length > 0">
                                    <dt class="col-sm-4">მართვის მოწმობა:</dt>
                                    <dd class="col-sm-8"><span v-for="(i, index) in item.vacancy_driving_license" :key="index" class="badge badge-primary">{{ i.name+', '}}</span> </dd>
                                </div>
                                <div class="row col-12" v-if="item.hr_id == hr_id">
                                    <div class="row col-12 border-top">
                                        <dt class="col-sm-4">კანდიდატისგან უნდა ჩაირიცხოს:</dt>
                                        <dd class="col-sm-8"> {{ item.deposit.candidate_initial_amount }}</dd>
                                    </div>
                                    <div class="row col-12 border-top" v-if="item.deposit.must_be_enrolled_candidate_date">
                                        <dt class="col-sm-4">კანდიდატისგან უნდა ჩაირიცხოს თარიღი:</dt>
                                        <dd class="col-sm-8"> {{ item.deposit.must_be_enrolled_candidate_date }}</dd>
                                    </div>
                                    <div class="row col-12 border-top" v-if="item.deposit.enrolled_candidate">
                                        <dt class="col-sm-4">კანდიდატისგან ჩაირიცხა:</dt>
                                        <dd class="col-sm-8"> {{ item.deposit.enrolled_candidate }}</dd>
                                    </div>
                                    <div class="row col-12 border-top" v-if="item.deposit.enrolled_candidate_date">
                                        <dt class="col-sm-4">კანდიდატისგან ჩაირიცხა თარიღი:</dt>
                                        <dd class="col-sm-8"> {{ item.deposit.enrolled_candidate_date }}</dd>
                                    </div>
                                </div>

                            </dl>
                        </div>
                        <div class="col-md-6 border">
                            <dl class="row">
                                <dt class="col-sm-4">დამატების თარიღი:</dt>
                                <dd class="col-sm-8">{{ item.created_at }}</dd>
                                <div class="row col-12 border-top">
                                    <dt class="col-sm-4">განახლების თარიღი:</dt>
                                    <dd class="col-sm-8">{{ item.updated_at }}</dd>
                                </div>
                                <div class="row col-12 border-top" v-if="item.interview_date">
                                    <dt class="col-sm-4">გასაუბრების თარიღი:</dt>
                                    <dd class="col-sm-8">{{ item.interview_date }}</dd>
                                </div>

                                <div class="row col-12 border-top" v-if="item.interview_place">
                                    <dt class="col-sm-4">გასაუბრების ადგილი:</dt>
                                    <dd class="col-sm-8">{{ item.interview_place.name_ka }}</dd>
                                </div>
                                <div class="row col-12 border-top" v-if="item.carry_in_head_date">
                                    <dt class="col-sm-4">აპინვა:</dt>
                                    <dd class="col-sm-8">{{ item.carry_in_head_date }}</dd>
                                </div>
                                <div class="row col-12 border-top" v-if="item.start_date">
                                    <dt class="col-sm-4">დაწყების თარიღი:</dt>
                                    <dd class="col-sm-8">{{ item.start_date }}</dd>
                                </div>
                                <div class="row col-12 border-top" v-if="item.term">
                                    <dt class="col-sm-4">ვადა:</dt>
                                    <dd class="col-sm-8">{{ item.term.name_ka }}</dd>
                                </div>

                                <div class="row col-12 " v-if="item.demand">
                                    <div class="row col-12 border-top" v-if="item.demand.education">
                                        <dt class="col-sm-4">განათლება:</dt>
                                        <dd class="col-sm-8">{{ item.demand.education.name_ka }} </dd>
                                    </div>
                                    <div class="row col-12 border-top" v-if="item.demand.specialty">
                                        <dt class="col-sm-4">პროფესია:</dt>
                                        <dd class="col-sm-8">{{ item.demand.specialty.name_ka }} </dd>
                                    </div>
                                    <div class="row col-12 border-top" v-if="item.demand.language">
                                        <dt class="col-sm-4">უცხო ენა:</dt>
                                        <dd class="col-sm-8">{{ item.demand.language.name_ka+' -' }} {{ (item.demand.language_level)?item.demand.language_level.name_ka:''}}</dd>
                                    </div>
                                    <div class="row col-12 border-top" v-if="item.demand.min_age || item.demand.max_age">
                                        <dt class="col-sm-4">ასაკი:</dt>
                                        <dd class="col-sm-8">{{ item.demand.min_age+' - '+ item.demand.max_age}}</dd>
                                    </div>
                                </div>

                                <div class="row col-12 border-top" v-if="item.characteristic.length > 0">
                                    <dt class="col-sm-4">მახასიათებლები:</dt>
                                    <dd class="col-sm-8"><span v-for="(i, index) in item.characteristic" :key="index" >{{ i.name_ka+', ' }}</span> </dd>
                                </div>
                                <div class="row col-12" v-if="item.hr_id == hr_id">
                                    <div class="row col-12 border-top">
                                        <dt class="col-sm-4 ">დამსაქმებლისგან უნდა ჩაირიცხოს:</dt>
                                        <dd class="col-sm-8"> {{ item.deposit.employer_initial_amount }}</dd>
                                    </div>
                                    <div class="row col-12 border-top" v-if="item.deposit.must_be_enrolled_employer_date">
                                        <dt class="col-sm-4">დამსაქმებლისგან უნდა ჩაირიცხოს თარიღი:</dt>
                                        <dd class="col-sm-8"> {{ item.deposit.must_be_enrolled_employer_date }}</dd>
                                    </div>
                                    <div class="row col-12 border-top" v-if="item.deposit.enrolled_employer">
                                        <dt class="col-sm-4">დამსაქმებლისგან ჩაირიცხა:</dt>
                                        <dd class="col-sm-8"> {{ item.deposit.enrolled_employer }}</dd>
                                    </div>
                                    <div class="row col-12 border-top" v-if="item.deposit.enrolled_employer_date">
                                        <dt class="col-sm-4">დამსაქმებლისგან ჩაირიცხა თარიღი:</dt>
                                        <dd class="col-sm-8"> {{ item.deposit.enrolled_employer_date }}</dd>
                                    </div>
                                </div>



                            </dl>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary mr-3" @click="hide()" ><i class=""></i>გაუქმება</button>

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
            vacancyId: Number
        },
        data() {
            return {
                showConfirm: false,
                item:{},
                hr_id: null
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
                    let result = await this.getInfo();
                    this.item = result.data.vacancy
                    this.hr_id = result.data.hr_id
                    this.showConfirm = true
                } catch (error) {
                    console.log(error);
                }

            },
            getInfo(){
                return axios.post('/get_vacancy_full_info' ,{
                    data: this.vacancyId,
                })
            },
            hide(){
                this.showConfirm = false
            },
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
      .modal-body { height: 700px;  }
  }
  </style>

