<template lang="">
    <div class="card card-primary " :class="colspan">
            <div class="card-header">
              <h3 class="card-title">ფილტრი</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
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
                    <div class="col-md-12 mt-3">
                        <button type="button" class="btn btn-success float-right" @click="find()"><i class="fa fa-search"></i> ძებნა</button>
                    </div>

                </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
    <div >
        <table class="table table-bordered  table-head-fixed">
            <thead>
            <tr>
                <th>N</th>
                <th>სახელი გვარი</th>
                <th>ასაკი</th>
                <th>მისამართი</th>
                <th>ნომერი</th>
                <th>კატეგორია</th>
                <th>სტატუსი</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item, index) in candidate" :key="index" >
                <td>{{ index + 1 }}</td>
                <td>{{ item.user.name_ka }}</td>
                <td>{{ age(item.user.date_of_birth) }}</td>
                <td>{{ item.address_ka+ ' '+item.street_ka }}</td>
                <td>{{ item.user.number }} </td>
                <td><a v-for="i in item.work_information" :key="index" class="badge badge-info mr-1" style="cursor: pointer;" @click="showInfoModal({'type':'category', 'data':i})">{{ i.name_ka }}</a> </td>
                <td><span class="badge badge-warning">{{ (item.user.status == 2)?'მზადაა':''}}</span>  </td>
                <td class="d-flex">
                    <button class="btn btn-primary btn-sm mr-1" type="button" data-toggle="collapse"
                        data-target="#collapseExample"
                        aria-expanded="false"
                        aria-controls="collapseExample"
                        @click="toggleChildren"
                    >
                        <i aria-hidden="true"
                            :class="toggleChildrenIcon"
                            @keypress="toggleChildren">
                        </i>
                    </button>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-cog"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#" @click="vacancyUpdateModal(item)">რედაქტირება</a>
                            <a class="dropdown-item" href="#" @click="vacancyUpdateModal(item)">წაშლა</a>
                            <a class="dropdown-item" href="#" @click="vacancyUpdateModal(item)">შავი სია</a>
                            <a class="dropdown-item" href="#" @click="vacancyUpdateModal(item)">ვაკანსიაზე დამატება</a>
                            <a class="dropdown-item" href="#" @click="vacancyUpdateModal(item)">ისტორია</a>

                        </div>
                    </div>
                </td>
            </tr>
            <tr v-for="(item, index) in candidate" :key="index" class="collapse" id="collapseExample">
                <td colspan="8">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="border py-2">
                                <li><strong>პირადი ნომერი: </strong><span>{{ item.personal_number }}</span></li>
                                <li><strong>ეროვნება: </strong><span>{{ item.nationality.name_ka }}</span></li>
                                <li><strong>მოქალაქეობა: </strong><span>{{ maker(item.citizenship) }}</span></li>
                                <li><strong>რელიგია: </strong><span>{{ item.religion.name_ka }}</span></li>
                                <li><strong>ოჯახური მდგომარეობა: </strong><span>{{ item.marital_status.name_ka }}</span></li>
                                <li><strong>განათლება: </strong><span>{{ item.education.name_ka }}</span></li>
                                <li><strong>პროფესია: </strong><span>{{ maker(item.professions) }}</span></li>
                                <li><strong>სპეციალობა: </strong><span>{{ maker(item.specialty) }}</span></li>
                                <li><strong>უცხო ენები: </strong><span>{{ language(item.languages) }}</span></li>
                                <li><strong>მართვის მოწმობა: </strong><span>{{ maker(item.driving_license) }}</span></li>
                                <li><strong>ალერგია: </strong><span>{{ maker(item.allergy) }}</span></li>
                                <li><strong>ზოგადი სამუშაი გამოცდილება: </strong><span class="text-primary" @click="showInfoModal({'type':'general_work', 'data':item.general_work_experience})"><u style="cursor: pointer;">{{ (item.general_work_experience == 0)?'არა':'კი' }}</u></span></li>
                                <li><strong>ოჯახში მუშაობის გამოცდილება: </strong><span class="text-primary" @click="showInfoModal({'type':'family_work', 'data':item.family_work_experience})"><u style="cursor: pointer;">{{ (item.family_work_experience == 0)?'არა':'კი' }}</u></span></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="border py-2">
                                <li><strong>რეგისტრაციის თარიღი: </strong><span>{{item.created_at.slice(0, 10)}}</span></li>
                                <li v-if="item.marital_status_id !=1"><strong>შვილები: </strong><span>{{ item.children }}</span></li>
                                <li v-if="item.marital_status_id !=1 && item.children && item.children != 0"><strong>შვილების ასაკი: </strong><span>{{ item.children_age }}</span></li>
                                <li v-if="item.marital_status_id != 2 && item.spouse"><strong>მეუღლე: </strong><span>{{ item.spouse }}</span></li>
                                <li><strong>სიმაღლე: </strong><span>{{ item.height+' სმ' }}</span></li>
                                <li><strong>წონა: </strong><span>{{ item.weight+ ' კგ' }}</span></li>
                                <li><strong>მოწევა: </strong><span>{{ (item.smoke == 0)?'არა':'კი' }}</span></li>
                                <li><strong>ნასამართლეობა: </strong><span>{{ (item.convection == 0)?'არა':'კი' }}</span></li>
                                <li><strong>საზღვარგარეთ მუშაობა: </strong><span>{{ (item.work_abroad == 0)?'არა':'კი' }}</span></li>
                                <li><strong>მახასიათებლები: </strong><span>{{ maker(item.characteristic) }}</span></li>
                                <li><strong>დაბადების თარიღი: </strong><span>{{ item.user.date_of_birth }}</span></li>
                                <li v-if="item.medical_info_ka"><strong>სამედიციონო ინფორმაცია: </strong><span>{{ item.medical_info_ka }}</span></li>
                                <li><strong>რეკომენდაცია: </strong><span class="text-primary" @click="showInfoModal({'type':'recommendation', 'data':item.recommendation})"><u style="cursor: pointer;">{{ (item.recommendation[0] )?'კი':'არა' }}</u></span></li>

                            </ul>
                        </div>
                    </div>

                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <paginate
        v-model="pagination.current_page"
        :page-count="pagination.last_page"
        :page-range="3"
        :margin-pages="2"
        :click-handler="getData"
        :prev-text="'უკან'"
        :next-text="'წინ'"
        :container-class="'pagination'"
        :page-class="'page-item'"
        >
    </paginate>
    <info_modal :visible="show_info_modal" :type="modalType" :data="modalData"></info_modal>
</template>
<script>
import _ from 'lodash';
import Paginate from 'vuejs-paginate-next';
import info_modal from './modal/info_modal.vue'
import Slider from '@vueform/slider'
// import axios from 'axios';
export default {
    components:{
        paginate: Paginate,
        info_modal,
        Slider
    },
    props:{
        data:Object,
    },
    data() {
        return {
            candidate:null,
            pagination:{
                current_page: 1,
                last_page: 2,
            },
            category:null,
            showChildren: false,
            show_info_modal: false,
            modalType:'',
            modalData:{},
            m:{},
            cla: {},
            colspan:'collapsed-card'
        }
    },
    created(){
        // this.candidate = {...this.data.candidate}
        console.log('data',this.data);
        this.getData()
    },
    computed:{
        toggleChildrenIcon() {
            return this.showChildren ? 'fas fa-angle-down' : 'fas fa-angle-right'
        },
    },
    methods: {

        getData(){
            this.candidate = {...this.data.candidate.data}
            this.cla = this.data.classificatory
            this.pagination = {
                'current_page':this.data.candidate.current_page,
                'last_page': this.data.candidate.last_page
            }
            this.m.age = [18, 80]
            this.m.height = [140, 200]
            this.m.weight = [40, 100]
            this.m.payment = [50, 4000]
            // axios.get('/candidate_data?page=' + this.pagination.current_page )
            // .then((response)=> {
            //     console.log('response', response)
            //     this.candidate = {...response.data.data}
            //     this.pagination = {
            //         'current_page':response.data.current_page,
            //         'last_page': response.data.last_page
            //     }

            // })
            // .catch(function (error) {
            //     console.log(error);
            // });

        },
        age(date_of_birth){
            var dob = new Date(date_of_birth)
            var diff_ms = Date.now() - dob.getTime();
            var age_dt = new Date(diff_ms);
            return Math.abs(age_dt.getUTCFullYear() - 1970);
        },
        maker(params) {
            var result = ''
            _.forEach(params, function(value) {
                result += (value.name_ka)?value.name_ka+', ':value.name+', '
            });
            return result
        },
        language(params) {
            var result = ''
            params.forEach(value => {
                result += value.name_ka+' - '+this.languageLevel(value.pivot.language_level_id)+', '
            });
            return result
        },
        languageLevel(params) {
            var result = '';
            if (params == 1) {
                result = 'მშობლიური'
            } else if(params == 2) {
                result = 'კარგად'
            } else if(params == 3) {
                result = 'საშუალოდ'
            } else if(params == 4) {
                result = 'ცუდად'
            }
            return result
        },
        toggleChildren() {
            this.showChildren = !this.showChildren
        },
        showInfoModal(item){
            this.modalType = item.type
            this.modalData = item.data
            this.show_info_modal = !this.show_info_modal
        },
        find(){
            this.colspan = 'hide'
            let currentObj = this;
            axios({
                    method: "post",
                    url: '/candidate_filter',
                    data: this.m,

                })
            .then(function (response) {
                // handle success
                console.log(response.data);
                currentObj.candidate = response.data.data
                currentObj.pagination = {
                    'current_page':response.data.current_page,
                    'last_page': response.data.last_page
                }
                // currentObj.modalData['candidate'] = response.data

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        }
    },
    mounted(){

    }
}
</script>
<style lang="">

</style>
