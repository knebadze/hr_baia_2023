<template lang="">
    <section class="content ">
    <div class="container-fluid">
        <div class="d-flex justify-content-end">
            <div class="w-25">
                <Switch  v-model:checked="myVacancy" @change.stop="myVacancySwitch" label="ჩემი ვაკანსიები" />
            </div>

        </div>
        <div id="accordion" >
            <div class="card card-primary" >
                <div class="card-header">
                  <h4 class="card-title w-100 d-flex justify-content-between">
                    <a class="d-block w-100" data-toggle="collapse"  href="#collapseOne">
                      ფილტრი
                    </a>
                    <i class="fas fa-angle-down float-right"></i>
                  </h4>
                </div>
                <div id="collapseOne" class="collapse" :class="colspan" data-parent="#accordion" >
                    <div class="card-body">
                    <h5 class="ml-2"><i class="fa fa-user" ></i> დამკვეთი:</h5>
                    <hr>
                        <div class="row" v-if="cla">

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
                                    <label>მისამართი</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.address"  type="text" placeholder="თბილის სამგორი კახეთის გზატკეცილი">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 border mb-3"></div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>ID</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.code"  type="text" placeholder="უნიკალური კოდი">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-6 col-md-12" >
                                <div class="form-group">
                                    <label>კატეგორია</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.category"  :options="cla.category" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12" >
                                <div class="form-group">
                                    <label>გრაფიკი</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.work_schedule"  :options="cla.workSchedule" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>ანაზღაურება</label>
                                    <div class="ls-inputicon-box mt-4">
                                        <Slider v-model="m.payment" :min=50  :max=5000 :step=10 class="slider"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>ვალუტა</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.currency" :options="cla.currency" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>სტატუსი</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.status" :options="cla.status" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 border mb-3"></div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label class="ml-4"> ასაკი</label>
                                    <div class="ls-inputicon-box mt-4">
                                        <Slider v-model="m.age" :min=18 :step=10 class="slider"/>
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
                                        <multiselect v-model="m.driving_license"  :options="cla.drivingLicense" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name" track-by="name" :preselect-first="false" >
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
                            <div class="col-md-12 border mb-3"></div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>დამატების თარიღი (დან)</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.created_at_from"  type="date" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>დამატების თარიღი (მდე)</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.created_at_to"  type="date" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>გასაუბრების თარიღი (დან)</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.interview_date_from"  type="dateTime-local" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>გასაუბრების თარიღი (მდე)</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.interview_date_two"  type="dateTime-local" >
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-12" >
                                <div class="form-group">
                                    <label>გასაუბრების ადგილი</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.interview_place"  :options="cla.interviewPlace" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>დაწყების თარიღი (დან)</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.start_date_from"  type="date" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>დაწყების თარიღი (მდე)</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.start_date_to"  type="date" >
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-12" >
                                <div class="form-group">
                                    <label>ვადა</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.term"  :options="cla.term" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
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
                        <button type="button" class="btn btn-success" @click="find(m)"><i class="fa fa-search"></i> ძებნა</button>
                    </div>
                </div>
              </div>




        </div>
    </div>
    <!-- /.container-fluid -->
    <!-- <candidateTable v-if="candidate.length > 0" :data="modalData"></candidateTable> -->
  </section>
    <EasyDataTable
        v-model:items-selected="itemsSelected"
        buttons-pagination
        :headers="headers"
        :items="items"
        table-class-name="customize-table"
        :body-row-class-name="bodyRowClassNameFunction"
        border-cell
        :filter-options="filterOptions"
    >
    <template #item-operation="item">
       <div class="operation-wrapper">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-cog"></i>
            </button>
            <div class="dropdown-menu ropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#" @click="vacancyUpdateModal(item)">რედაქტირება</a>
                <a class="dropdown-item" href="#" @click="statusChange(item)">სტატუსის შეცვლა</a>
                <a v-if="item.status.id == 2" class="dropdown-item" :href="personalSelectionUrl+'/'+item.id" >კადრების შერჩევა</a>
                <a v-if="item.status.id > 1" class="dropdown-item" :href="vacancyPersonalUrl+'/'+item.id" >შერჩეული კადრები</a>
                <a v-if="item.hr_id == hr_id" class="dropdown-item" href="#" @click="vacancyReminderModal(item)">შეხსენება</a>
                <a v-if="item.hr_id == hr_id" class="dropdown-item" href="#" @click="vacancyDepositModal(item)">დეპოზიტი</a>

                <a v-if="item.status.id == 5 || item.status.id == 4" class="dropdown-item" href="#"  @click="vacancyRepeat(item)">გამეორება</a>
                <a v-if="item.status.id !== 3 && item.status.id !== 4 && item.status.id !== 5" class="dropdown-item" href="#" @click="carryInHead(item)">აპინვა </a>
            </div>
        </div>
      </div>
    </template>
        <template #expand="item">
            <!-- {{ item }} -->
              <!-- /.card-header -->
              <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">HR:</dt>
                                <dd class="col-sm-8">{{ item.hr.user.name_ka }}</dd>
                                <dt class="col-sm-4">სათაური:</dt>
                                <dd class="col-sm-8">{{ item.title_ka }}</dd>
                                <dt class="col-sm-4">სამუშაო დღეები:</dt>
                                <dd class="col-sm-8">{{ item.additional_schedule_ka }}</dd>
                                <div class="row col-12" v-if="item.vacancy_for_who_need.length > 0">
                                    <dt class="col-sm-4">ვისთვის ესაჭიროება:</dt>
                                    <dd class="col-sm-8"><span v-for="(i, index) in item.vacancy_for_who_need" :key="index">{{ i.name_ka+', ' }}</span> </dd>
                                </div>
                                <div class="row col-12" v-if="item.vacancy_benefit.length > 0">
                                    <dt class="col-sm-4">ბენეფიტები:</dt>
                                    <dd class="col-sm-8"><span v-for="(i, index) in item.vacancy_benefit" :key="index">{{ i.name_ka+', ' }}</span> </dd>
                                </div>
                                <div class="row col-12" v-if="item.stay_night == 1 || item.go_vacation == 1 || item.work_additional_hours == 1">
                                    <dt class="col-sm-4">უნდა შეეძლოს:</dt>
                                    <dd class="col-sm-8">
                                        <span v-if="item.stay_night == 1"> ღამე დარჩენა, </span>
                                        <span v-if="item.go_vacation  == 1"> არდადეგებზე გაყოლა, </span>
                                        <span v-if="item.work_additional_hours == 1"> დამატებითი საათები მუშაობა, </span>
                                    </dd>
                                </div>

                                <div class="row col-12" v-if="item.vacancy_duty.length > 0">
                                    <dt class="col-sm-4">მოვალეობები:</dt>
                                    <dd class="col-sm-8"><span v-for="(i, index) in item.vacancy_duty" :key="index" class="badge badge-primary">{{ i.name_ka+', ' }}</span> </dd>
                                </div>
                                <div class="row col-12" v-if="item.demand && item.demand.additional_name_ka">
                                    <dt class="col-sm-4">დამატებითი მოვალეობები:</dt>
                                    <dd class="col-sm-8">{{ item.demand.additional_name_ka }} </dd>
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
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">დამატების თარიღი:</dt>
                                <dd class="col-sm-8">{{ item.created_at }}</dd>
                                <dt class="col-sm-4">განახლების თარიღი:</dt>
                                <dd class="col-sm-8">{{ item.updated_at }}</dd>
                                <div class="row col-12" v-if="item.interview_date">
                                    <dt class="col-sm-4">გასაუბრების თარიღი:</dt>
                                <dd class="col-sm-8">{{ item.interview_date }}</dd>
                                </div>

                                <div class="row col-12" v-if="item.interview_place">
                                    <dt class="col-sm-4">გასაუბრების ადგილი:</dt>
                                    <dd class="col-sm-8">{{ item.interview_place.name_ka }}</dd>
                                </div>

                                <div class="row col-12" v-if="item.term">
                                    <dt class="col-sm-4">ვადა:</dt>
                                    <dd class="col-sm-8">{{ item.term.name_ka }}</dd>
                                </div>

                                <div class="row col-12" v-if="item.demand">
                                    <div class="row col-12" v-if="item.demand.education">
                                        <dt class="col-sm-4">განათლება:</dt>
                                        <dd class="col-sm-8">{{ item.demand.education.name_ka }} </dd>
                                    </div>
                                    <div class="row col-12" v-if="item.demand.specialty">
                                        <dt class="col-sm-4">პროფესია:</dt>
                                        <dd class="col-sm-8">{{ item.demand.specialty.name_ka }} </dd>
                                    </div>
                                    <div class="row col-12" v-if="item.demand.language">
                                        <dt class="col-sm-4">უცხო ენა:</dt>
                                        <dd class="col-sm-8">{{ item.demand.language.name_ka+' -' }} {{ (item.demand.language_level)?item.demand.language_level.name_ka:''}}</dd>
                                    </div>
                                    <div class="row col-12" v-if="item.demand.min_age || item.demand.max_age">
                                        <dt class="col-sm-4">ასაკი:</dt>
                                        <dd class="col-sm-8">{{ item.demand.min_age+' - '+ item.demand.max_age}}</dd>
                                    </div>
                                </div>

                                <div class="row col-12" v-if="item.characteristic.length > 0">
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
              <!-- /.card-body -->
        </template>
        <template #header-status.name_ka="header">
            <div class="filter-column">
                <i class="fa fa-filter text-secondary" style="font-size:15px;" @click.stop="showStatusFilter=!showStatusFilter"></i>
                {{ header.text }}
                <div class="filter-menu filter-sport-menu" v-if="showStatusFilter">
                <select
                    class="favouriteSport-selector"
                    v-model="choseStatus"
                    name="favouriteSport"
                >
                    <option value="ყველა">
                        ყველა
                    </option>
                    <option v-for="(item, index) in data.classificatory.status" :key="index" :value="item.name_ka">
                        {{ item.name_ka }}
                    </option>

                </select>
                </div>
            </div>
        </template>
        <template #header-category.name_ka="header">
            <div class="filter-column">
                <i class="fa fa-filter text-secondary" style="font-size:15px;" @click.stop="showCategoryFilter=!showCategoryFilter"></i>
                {{ header.text }}
                <div class="filter-menu filter-sport-menu" v-if="showCategoryFilter">
                <select
                    class="favouriteSport-selector"
                    v-model="choseCategory"
                    name="favouriteSport"
                >
                    <option value="ყველა">
                        ყველა
                    </option>
                    <option v-for="(item, index) in data.classificatory.category" :key="index" :value="item.name_ka">
                        {{ item.name_ka }}
                    </option>

                </select>
                </div>
            </div>
        </template>
        <template #header-work_schedule.name_ka="header">
            <div class="filter-column">
                <i class="fa fa-filter text-secondary" style="font-size:15px;" @click.stop="showScheduleFilter=!showScheduleFilter"></i>
                {{ header.text }}
                <div class="filter-menu filter-sport-menu" v-if="showScheduleFilter">
                <select
                    class="favouriteSport-selector"
                    v-model="choseSchedule"
                    name="favouriteSport"
                >
                    <option value="ყველა">
                        ყველა
                    </option>
                    <option v-for="(item, index) in data.classificatory.workSchedule" :key="index" :value="item.name_ka">
                        {{ item.name_ka }}
                    </option>

                </select>
                </div>
            </div>
        </template>
        <template #header-payment="header">
            <div class="filter-column">
                <i class="fa fa-filter text-secondary" style="font-size:15px;" @click.stop="showPaymentFilter=!showPaymentFilter"></i>
                {{ header.text }}
                <div class="filter-menu filter-sport-menu my-2" v-if="showPaymentFilter">
                    <Slider v-model="chosePayment" :max=3000 class="slider"/>
                </div>
            </div>
        </template>
        <template #header-id="header">
            <div class="filter-column">
                <i class="fa fa-filter text-secondary" style="font-size:15px;" @click.stop="showIdFilter=!showIdFilter"></i>
                {{ header.text }}
                <div class="filter-menu filter-sport-menu my-2" v-if="showIdFilter">
                    <input v-model="choseId"/>
                </div>
            </div>
        </template>
    </EasyDataTable>
    <!-- {{ statusChangeModal }} -->
    <changeStatus :visible="statusChangeModal" :item="statusItem"></changeStatus>
    <vacancyUpdate :visible="updateModal" :item="item"></vacancyUpdate>
    <vacancyDeposit :visible="depositModal" :item="depositItem"></vacancyDeposit>
    <vacancyReminder :visible="reminderModelShow" :item="item"></vacancyReminder>
    <vacancyRepeat :visible="repeatModelShow" :item="item"></vacancyRepeat>

</template>
<script>
import { ref, computed } from "vue";
import moment from 'moment'
import Slider from '@vueform/slider'
import "@vueform/slider/themes/default.css";
// import Switches from 'vue-switches';
import Switch from '../../inc/Switch.vue';
import _ from 'lodash'

// import { Header, Item, FilterOption } from "vue3-easy-data-table";
import changeStatus from "../modal/changeStatus.vue";
import vacancyUpdate from "../modal/vacancyUpdate.vue"
import vacancyDeposit from "../modal/vacancyDeposit.vue";
import vacancyReminder from "../modal/vacancyReminder.vue";
import vacancyRepeat from "../modal/vacancyRepeat.vue";
export default {
    components: {
      Slider,
      changeStatus,
      vacancyUpdate,
      vacancyDeposit,
      vacancyReminder,
      vacancyRepeat,
        Switch
    },
    props:{
        data: Object
    },

    setup(props){
        var url = new URL( location.href)
        const itemsSelected = ref([]);
        var personalSelectionUrl = ref(url.origin+'/hr/selection_personal')
        var vacancyPersonalUrl = ref(url.origin+'/hr/vacancy_personal')

        var statusChangeModal = ref(false)
        var updateModal = ref(false)
        var depositModal = ref(false)
        var selectionPersonalModalShow = ref(false)
        let reminderModelShow = ref(false)
        let repeatModelShow = ref(false)
        var statusItem = ref()
        var item = ref()
        var depositItem =ref()
        let m = ref({'payment': [50, 4000], 'age':[18, 65]})
        let colspan = ref('hide')
        let hr_id = ref(props.data.hr_id)
        let myVacancy = ref(false)
        let cla = ref(null)


        console.log('data',props.data.vacancy);
        const headers = ref([
            { text: "id", value: "code" },
            { text: "კატეგორია", value: "category.name_ka" },
            { text: "გრაფიკი", value: "work_schedule.name_ka"},
            { text: "დამსაქმებელი", value: "employer.name_ka"},
            { text: "ნომერი", value: "employer.number"},
            { text: "სტატუსი", value: "status.name_ka"},
            { text: "ანაზღაურება", value: "payment", sortable: true},
            { text: "საჭიროება", value: "start_date", sortable: true},
            { text: "Operation", value: "operation" },
        ]);
        let data = ref(props.data.vacancy)

        cla = ref(props.data.classificatory)
        const items = ref(data)
        console.log('let data', items.value);
        // ref(makeData(props.data.vacancy));
        function makeData(params) {
            var arr = []
            console.log('params',params);
            params.forEach(element => {
                var data = {
                    'id': element.code,
                    'category':element.category.name_ka,
                    'schedule':element.work_schedule.name_ka,
                    'employer':element.employer.name_ka,
                    'number':element.employer.number,
                    'status':element.status.name_ka,
                    'payment':element.payment,
                    'startDate':element.start_date,
                    'workDay':element.additional_schedule_ka,
                    'vacancy_for_who_need':element.vacancy_for_who_need,
                    'title': element.title_ka,
                    'created_at':moment(element.created_at).format("YYYY-MM-DD HH:mm"),
                    'updated_at':moment(element.updated_at).format("YYYY-MM-DD HH:mm"),
                    'comment':element.category,
                    'go_vacation':element.go_vacation,
                    'stay_night': element.stay_night,
                    'work_additional_hours': element.work_additional_hours,
                    'interview_date':element.interview_date,
                    'interview_place':element.interview_place.name_ka,
                    'term':element.term.name_ka,
                    'benefit': element.vacancy_benefit,
                    'duty': element.vacancy_duty,
                    'demand':element.demand,
                    'characteristic':element.characteristic,
                }
                arr.push(data)
            });
            return arr
        }

        const bodyRowClassNameFunction = ( item, number) => {
            if (item.hr_id == hr_id.value) return 'my-vacancy-row';
            return '';
        };
        const showStatusFilter = ref(false);
        const showCategoryFilter = ref(false);
        const showScheduleFilter = ref(false);
        const showPaymentFilter = ref(false);
        const showIdFilter = ref(false);
        const choseStatus = ref('ყველა');
        const choseCategory = ref('ყველა');
        const choseSchedule = ref('ყველა');
        const chosePayment = ref([50, 3000]);
        const choseId = ref('');
        const filterOptions = computed(()=> {
            const filterOptionsArray =  [];
            if (choseStatus.value !== 'ყველა') {
                filterOptionsArray.push({
                    field: 'status.name_ka',
                    comparison: '=',
                    criteria: choseStatus.value,
                });
            }
            if (choseCategory.value !== 'ყველა') {
                filterOptionsArray.push({
                    field: 'category.name_ka',
                    comparison: '=',
                    criteria: choseCategory.value,
                });

            }
            if (choseSchedule.value !== 'ყველა') {
                filterOptionsArray.push({
                    field: 'work_schedule.name_ka',
                    comparison: '=',
                    criteria: choseSchedule.value,
                });

            }
            if (showPaymentFilter) {
                filterOptionsArray.push({
                    field: 'payment',
                    comparison: 'between',
                    criteria: chosePayment.value,
                });
            }
            if (choseId.value !== '') {
                filterOptionsArray.push({
                    field: 'id',
                    comparison: '=',
                    criteria: choseId.value,
                });

            }

            return filterOptionsArray;
        });




        function myVacancySwitch(){
            if (!myVacancy.value) {
               data.value =  _.sortBy(_.filter(props.data.vacancy, function(o) { return o.hr_id == hr_id.value; }), [function(o) { return o.start_date; }]);
            }else{
                data.value = props.data.vacancy
            }
        }

        function find(m){
            m['created_at'] = [m.created_at_from, m.created_at_to]
            m['start_date'] = [m.start_date_from, m.start_date_to]
            m['interview_date'] = [m.interview_date_from, m.interview_date_to]

            axios({
                method: "post",
                url: '/admin_vacancy_filter',
                data: m,

            })
            .then(function (response) {
                console.log('response',  response.data);
                items.value = response.data.data
                if (response.status == 200) {
                    // items.value = response.data.data
                    // toast.success("წარმატებით შესრულდა", {
                    //     theme: 'colored',
                    //     autoClose: 1000,
                    // });
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

        // onBeforeMount(async () => {
        //     try {
        //         const response = await axios.post('/get_vacancy_filter_classificatory');
        //         cla.value = response.data;
        //     } catch (error) {
        //         console.error(error);
        //     }
        // });
        return {
            headers,
            items,
            itemsSelected,
            showStatusFilter,
            choseStatus,
            showCategoryFilter,
            choseCategory,
            showScheduleFilter,
            choseSchedule,
            showPaymentFilter,
            chosePayment,
            showIdFilter,
            choseId,
            filterOptions,

            statusChangeModal,
            statusItem,
            updateModal,
            item,
            depositModal,
            depositItem,
            selectionPersonalModalShow,
            reminderModelShow,
            repeatModelShow,
            personalSelectionUrl,
            vacancyPersonalUrl,

            colspan,
            hr_id,
            myVacancy,
            myVacancySwitch,
            bodyRowClassNameFunction,
            m,
            cla,
            find

            // statusChange
        };
    },
    methods:{
        statusChange(item) {
            this.statusChangeModal = !this.statusChangeModal
            this.statusItem = item
        },
        vacancyUpdateModal(item) {
            this.updateModal = !this.updateModal
            this.item = item
        },
        vacancyDepositModal(item) {
            this.depositModal = !this.depositModal
            this.depositItem = item.deposit
        },
        selectionPersonalModal(item){
            this.selectionPersonalModalShow = !this.selectionPersonalModalShow
        },
        vacancyReminderModal(item){
            this.reminderModelShow = !this.reminderModelShow
            this.item = item
        },
        vacancyRepeat(item){
            this.repeatModelShow = !this.repeatModelShow
            this.item = item
        },
        carryInHead(item){
            console.log('head', item);
            let editedFields = {
                'carry_in_head_date': item.carry_in_head_date,
            }
            let currentObj = this
            this.$swal({
                title: 'ნამდვილად გსურთ ვაკანსიის თავში ატანა?',
                //   showDenyButton: true,
                cancelButtonText:'არა',
                confirmButtonText: 'კი',
                showCancelButton: true,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios.post('/carry_in_head_vacancy' ,{
                        data: {'id':item.id, 'edit': editedFields},
                    })
                    .then(function (response) {
                        if (response.status == 200) {
                            toast.success("წარმატებით შესრულდა", {
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

                } else if (result.isDenied) {
                    return
                }
            });
        },

    }
}
</script>
<style >
    .my-vacancy-row  {
        --easy-table-body-row-background-color: #f8b1b1;
        --easy-table-body-row-font-color: #070707;
    }
    .customize-table {
        --easy-table-border: 1px solid #445269;
        --easy-table-header-font-size: 18px;
        --easy-table-header-height: 50px;
        --easy-table-body-row-font-size: 14px;
        --easy-table-body-row-height: 50px;
    }
</style>
