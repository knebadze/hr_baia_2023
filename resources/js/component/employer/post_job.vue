<template lang="">
        <!-- LOADING AREA START ===== -->
    <div v-if="loader" class="loading-area">
        <div class="loading-box"></div>
        <div class="loading-pic">
            <div class="wrapper">
                <div class="cssload-loader"></div>
            </div>
        </div>
    </div>
    <!-- LOADING AREA  END ====== -->
    <div class="panel panel-default">
        <div class="text-center">
            <h3>დაამატე ახალი ვაკანსია ან გაიმეორე ძველი</h3>
        </div>
        <div class="panel-heading wt-panel-heading p-a20">
            <h4 class="panel-tittle m-a0">{{ ('პირადი ინფორმაცია') }}</h4>
            <!-- <h4 class="panel-tittle m-a0">{{ $t('lang.employer_add_job_general_info') }}</h4> -->
            <small class="text-danger">* {{ $t('lang.employer_add_job_definitely_fields') }}</small>
        </div>
            <div class="panel-body wt-panel-body p-a20 m-b30 ">

                    <div class="row">
                        <!--Job title-->
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>სახელი გვარი</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.employer[`name_${getLang}`]"  type="text" placeholder="Devid Smith" @blur="v$.m.employer[`name_${getLang}`].$touch">
                                    <span v-if="v$.m.employer[`name_${getLang}`].required.$invalid && v$.m.employer[`name_${getLang}`].$dirty" style='color:red'>* {{ v$.m.employer[`name_${getLang}`].required.$message}}</span>
                                    <!-- <i class="fs-input-icon fa fa-address-card"></i> -->
                                </div>
                            </div>
                        </div>
                        <!--Job title-->
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>მაილი</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.employer.email" type="email" placeholder="employer@gmail.com">
                                    <!-- <i class="fs-input-icon fa fa-address-card"></i> -->
                                </div>
                            </div>
                        </div>
                        <!--Job title-->
                        <!-- <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>ტელეფონის ნომერი</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.employer.number" type="text" placeholder="555444333" onkeypress="return /[0-9]/i.test(event.key)">

                                </div>
                            </div>
                        </div> -->
                        <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ ('ტელეფონის ნომერი') }}</label>
                                    <div class="input-group mb-3">
                                    <button style="border-style: none;" class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span :class="`fi fi-${numberCode.iso.toLowerCase()}`"></span>+{{ numberCode.phonecode }}</button>
                                    <ul class="dropdown-menu" style=" overflow: hidden; overflow-y: auto; max-height: calc(100vh - 550px);">
                                        <li v-for="item in cla.numberCode" @click="chooseNumberCode(item)"><a class="dropdown-item"><span :class="`fi fi-${item.iso.toLowerCase()}`"></span>+{{ item.phonecode }}</a></li>
                                    </ul>
                                    <input type="text" class="form-control" aria-label="Text input with dropdown button" v-model="m.employer.number" placeholder="555666777" onkeypress="return /[0-9]/i.test(event.key)" >
                                    <!-- <span v-if="v$.candidateNumberModel.number.numeric.$invalid && v$.candidateNumberModel.number.$dirty" style='color:red'>* {{ v$.candidateNumberModel.number.numeric.$message}}</span> -->
                                    </div>
                                </div>
                            </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>მისამართი</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.employer[`address_${getLang}`]" type="text" placeholder="მაგ: თბილისი, სამგორი, კახეთის გზატკეცილი 36 ბ">
                                    <!-- <i class="fs-input-icon fa fa-address-card"></i> -->
                                </div>
                            </div>
                        </div>

                        <div class="panel-heading wt-panel-heading p-a20 m-b30">
                            <h4 class="panel-tittle m-a0">{{ $t('lang.employer_add_job_general_info') }}</h4>
                            <!-- <small class="text-danger">* {{ $t('lang.employer_add_job_definitely_fields') }}</small> -->
                        </div>
                        <!-- <div class="panel-body wt-panel-body p-a20 m-b30 "></div> -->
                            <!--Job title-->
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label><span class="text-danger">* </span>{{ $t('lang.employer_add_job_vacancy_name') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.vacancy[`title_${getLang}`]" type="text" :placeholder="$t('lang.employer_add_job_vacancy_name_placeholder')"  @blur="v$.m.vacancy[`title_${getLang}`].$touch">
                                        <!-- <i class="fs-input-icon fa fa-user"></i> -->
                                        <span v-if="v$.m.vacancy[`title_${getLang}`].required.$invalid && v$.m.vacancy[`title_${getLang}`].$dirty" style='color:red'>* {{ v$.m.vacancy[`title_${getLang}`].required.$message}}</span>
                                    </div>
                                </div>
                            </div>

                            <!--Job Category-->
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label><span class="text-danger">* </span>{{ $t('lang.employer_add_job_position') }}</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.vacancy.category_id" :options="cla.category" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>



                            <div class="col-xl-4 col-lg-6 col-md-12" >
                                <div class="form-group">
                                    <label><span class="text-danger">* </span>{{ ('ვისთვის გესაჭიროებათ?') }}</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.for_who_need"  :options="cla.forWhoNeed" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" :placeholder="$t('lang.employer_add_job_select')" label="name_ka" track-by="name_ka" :preselect-first="false" >
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                        <!-- <span v-if="v$.m.candidate.personal_number.required.$invalid && v$.m.candidate.personal_number.$dirty" style='color:red'>* {{ v$.m.candidate.personal_number.required.$message}}</span> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_schedule_title') }}</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.vacancy.work_schedule_id" :options="cla.workSchedule" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false" >
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                        <!-- <span v-if="v$.workInformationSchedule.required.$invalid && v$.workInformationSchedule.$dirty" style='color:red'>* {{ v$.workInformationSchedule.required.$message}}</span> -->
                                        <!-- <i class="fs-input-icon fa fa-smoking"></i> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_salary_title') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.vacancy.payment" type="number" step="50" >
                                        <!-- <i class="fs-input-icon fa fa-money"></i> -->
                                        <!-- <span v-if="v$.m.getWorkInformation.payment.numeric.$invalid && v$.m.getWorkInformation.payment.$dirty" style='color:red'>* {{ v$.m.getWorkInformation.payment.numeric.$message}}</span> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_currency_title') }}</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.vacancy.currency_id" :options="cla.currency" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false" >
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                        <!-- <span v-if="v$.m.getWorkInformation.currency_id.required.$invalid && v$.m.getWorkInformation.currency_id.$dirty" style='color:red'>* {{ v$.m.getWorkInformation.currency_id.required.$message}}</span> -->
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><span class="text-danger">* </span>{{ $t('lang.employer_add_job_jobs_day') }}</label>
                                    <div class="ls-inputicon-box">
                                        <textarea class="form-control" v-model="m.vacancy[`additional_schedule_${getLang}`]" type="text" placeholder="" rows="3"></textarea>
                                        <!-- <span v-if="v$.m.candidate.personal_number.required.$invalid && v$.m.candidate.personal_number.$dirty" style='color:red'>* {{ v$.m.candidate.personal_number.required.$message}}</span> -->
                                    </div>
                                </div>
                            </div>


                            <div class="panel-heading wt-panel-heading p-a20 my-3">
                                <h4 class="panel-tittle m-a0"><i class="fa fa-suitcase"></i> დამატებით</h4>
                            </div>
                            <div class="row mb-4" v-if="m.vacancy.category_id.id == 1 || m.vacancy.category_id.id == 2 || m.vacancy.category_id.id == 4">
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class=" form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" v-model="m.vacancy.go_vacation">
                                        <label class="form-check-label" for="exampleCheck1">შეეძლოს არდადეგებზე გაყოლა</label>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class=" form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck2" value="1" v-model="m.vacancy.stay_night">
                                        <label class="form-check-label" for="exampleCheck1">შეეძლოს ღამე დარჩენა</label>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class=" form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck3" value="1" v-model="m.vacancy.work_additional_hours">
                                        <label class="form-check-label" for="exampleCheck1">შეეძლო დამატებით საათებში მუშაობა</label>
                                    </div>
                                </div>
                            </div>

                            <!--Start Date-->
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label><span class="text-danger">* </span>{{ $t('lang.employer_add_job_when_need') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.vacancy.start_date" type="date" placeholder="" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label><span class="text-danger">* </span>{{ $t('lang.employer_add_job_how_long') }}</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.vacancy.term_id" :options="cla.term" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false" >
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('ბენეფიტები') }}</label>
                                    <div class="my-4">
                                        <span class="text-primary benefitsColor" style="text-decoration:none; cursor: pointer; padding-right:20px" v-for="(item, index) in cla.benefit" :key="index" @click="addBenefit(item)">{{ item[`name_${getLang}`]+', ' }}</span>
                                    </div>
                                    <textarea class="form-control" v-model="benefitText" type="text" :placeholder="$t('lang.employer_add_job_additional_offers_placeholder')" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.employer_add_job_comment_for_agency') }}</label>
                                    <textarea class="form-control" v-model="m.vacancy.comment" type="text" :placeholder="$t('lang.employer_add_job_comment_for_agency_placeholder')" rows="3"></textarea>
                                </div>
                            </div>


                            <div class="panel-heading wt-panel-heading p-a20 my-3">
                                <h4 class="panel-tittle m-a0"><i class="fa fa-suitcase"></i> მოთხოვნები კანდიდატის მიმართ</h4>
                            </div>
                            <!--Experience-->
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.employer_add_job_minimal_age') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.demand.min_age" type="number" placeholder="25" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.employer_add_job_max_age') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.demand.max_age" type="number" placeholder="45" >
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.employer_add_job_minimal_edu') }}</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.demand.education_id" :options="cla.educations" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" :placeholder="$t('lang.employer_add_job_select')"  :searchable="true" :allow-empty="false">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ ('სპეციალობა') }}</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.demand.specialty_id" :options="cla.specialties" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" :placeholder="$t('lang.employer_add_job_select')"  :searchable="true" :allow-empty="false">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.employer_add_job_preferred_foreign_language') }}</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.demand.language_id" :options="cla.languages" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" :placeholder="$t('lang.employer_add_job_select')"  :searchable="true" :allow-empty="false">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.employer_add_job_foreign_language_level') }}</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.demand.language_level_id" :options="cla.languageLevels" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" :placeholder="$t('lang.employer_add_job_select')"  :searchable="true" :allow-empty="false">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.employer_add_job_general_character') }}</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.characteristic"  :options="cla.characteristic" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" :placeholder="$t('lang.employer_add_job_select')" label="name_ka" track-by="name_ka" :preselect-first="false">
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.employer_add_job_duties') }}</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.duty"  :options="cla.duty" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" :placeholder="$t('lang.employer_add_job_select')" label="name_ka" track-by="name_ka" :preselect-first="false" >
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                        <!-- <span v-if="v$.m.familyWorkedSelected.required.$invalid && v$.m.familyWorkedSelected.$dirty" style='color:red'>* {{ v$.m.candidateFamilyWorkSkill.required.$message}}</span> -->
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.employer_add_job_additional_duties') }}</label>
                                    <textarea class="form-control" v-model="m.demand[`additional_duty_${getLang}`]" type="text" placeholder="" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="panel-heading wt-panel-heading p-a20 my-3">
                                <h4 class="panel-tittle m-a0"><i class="fa fa-suitcase"></i> გასაუბრება</h4>
                            </div>
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
                                        <multiselect v-model="m.vacancy.interview_place_id" :options="cla.interviewPlace" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" :placeholder="$t('lang.employer_add_job_select')"  :searchable="true" :allow-empty="false">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="text-left">
                                    <button type="submit" @click.prevent="addVacancy()" class="site-button m-r5">{{ $t('lang.employer_add_job_button_add') }}</button>
                                </div>
                            </div>




                    </div>
            </div>
            <hr>
            <div class="row text-center border border-info py-4">
                <div class="col-lg-12 col-md-12 mb-4">
                    <div class="twm-error-content">
                        <h4 class="twm-error-title2 site-text-primary">ძველი ვაკანისის გამეორება</h4>
                        <p>გამოიყენეთ თქვენს მიერ ძველ ვაკანსიაში მითითებული ტელეფონის ნომერი.</p>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="twm-error-image">
                        <div class="twm-bnr-search-bar">
                            <form>
                                <div class="row">

                                    <!--Location-->
                                    <div class="form-group  col-md-9">
                                        <label>{{ ('ტელეფონის ნომერი') }}</label>
                                        <div class="twm-inputicon-box">
                                            <input  type="text"  required class="form-control" :placeholder=" $t('lang.welcome_leftside_bar_search_job_location_job_search')">

                                        </div>
                                    </div>


                                    <!--Find job btn-->
                                    <div class="form-group col-xl-3 col-lg-6 col-md-6">
                                        <button type="button" class="site-button" >{{ $t('lang.welcome_leftside_bar_search_job_location_job_search') }}</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>
<script>
import _ from 'lodash';
import { useVuelidate } from '@vuelidate/core'
import { required, email, helpers, requiredIf, numeric, maxLength } from '@vuelidate/validators'
export default {
    setup () {
        return { v$: useVuelidate() }
    },
    props:{
        data: Object
    },
    data() {
        return {
            m: {
                'employer':null,
                'vacancy':null,
                'demand':null,
                'characteristic':[],
                'duty': [],
                'for_who_need': [],
                'benefit': [],
                'interviewDate':'',
                'interviewTime':'',
            },
            workInformationSchedule:null,
            cla:null,
            loader: false,
            localText:{
                schedule: {
                    '1':{
                        ka:'ორშაბათი_დან პარასკევის ჩათლით, 09:00_დან 18:00_მდე',
                        en:'',
                        ru:'',
                    }

                }
            },
            benefitText:'',
            numberCode: {
                'phonecode': 995,
                'iso':'ge'
            },


        }
    },
    validations () {
        const validations = {
            m:{
                employer:{
                    name_ka:{},
                    name_en:{},
                    name_ru:{},
                    // email:{required:helpers.withMessage('შევსება სავალდებულოა', required )},
                    number:{
                        required:helpers.withMessage('შევსება სავალდებულოა', required ),
                        numeric:helpers.withMessage('უნდა შეიცავდეც მხოლოდ ციფრებს', numeric )
                    }
                },
                vacancy:{
                    title_ka:{},
                    title_en:{},
                    title_ru:{},
                    category_id:{
                        required:helpers.withMessage('არჩევა სავალდებულოა', required ),
                    },
                    for_who_ka:{},
                    for_who_en:{},
                    for_who_ru:{},
                    address_ka:{},
                    address_en:{},
                    address_ru:{},
                    payment:{
                        required:helpers.withMessage('შევსება სავალდებულოა', required ),
                        numeric:helpers.withMessage('უნდა შეიცავდეც მხოლოდ ციფრებს', numeric ),
                    },
                    currency_id:{
                        required:helpers.withMessage('არჩევა სავალდებულოა', required ),
                    },
                    work_schedule_id:{
                        required:helpers.withMessage('არჩევა სავალდებულოა', required ),
                    },
                    additional_schedule_ka:{},
                    additional_schedule_en:{},
                    additional_schedule_ru:{},
                },
                demand:{

                }
            }


        }
        if (this.getLang == 'ka') {
            validations.m.employer.name_ka ={
                required:helpers.withMessage('შევსება სავალდებულოა', required )
            }
            validations.m.vacancy.title_ka ={
                required:helpers.withMessage('შევსება სავალდებულოა', required )
            }
        }else if(this.getLang == 'en'){
            validations.m.employer.name_en ={
                required:helpers.withMessage('შევსება სავალდებულოა', required )
            }
            validations.m.vacancy.title_en ={
                required:helpers.withMessage('შევსება სავალდებულოა', required )
            }
        }else{
            validations.m.employer.name_ru ={
                required:helpers.withMessage('შევსება სავალდებულოა', required )
            }
            validations.m.vacancy.title_ru ={
                required:helpers.withMessage('შევსება სავალდებულოა', required )
            }
        }
        return validations
    },
    created(){
        this.createModel()
        this.cla = { ...this.data.classificatory}
        console.log('this.cla', this.cla);
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
    },
    methods:{

        createModel(){
            this.m['employer'] = {...this.data.model.employer}
            this.m.employer.number_code_id = 79
            this.m['vacancy'] = {...this.data.model.vacancy};
            this.m.vacancy['go_vacation'] = 0;
            this.m.vacancy['stay_night'] = 0;
            this.m.vacancy['work_additional_hours'] = 0;
            this.m['demand'] = {...this.data.model.demand};
            this.m.vacancy.payment = 800
            this.m['characteristic'] = []
            this.m['duty'] = []
            console.log('this.m', this.m);
        },
        addVacancy(){
            this.m['lang'] = this.getLang
            var html = `${this.m.employer[`address_${this.getLang}`]}_ზე ${(this.m.vacancy[`for_who_${this.getLang}`])?this.m.vacancy[`for_who_${this.getLang}`]:''} გვესაჭიროება ${this.m.vacancy.category_id[`name_${this.getLang}`]}. ${this.m.vacancy.work_schedule_id[`name_${this.getLang}`]} გრაფიკით, ${this.m.vacancy[`additional_schedule_${this.getLang}`]}. ანაზღაურება: ${this.m.vacancy.payment} ${this.m.vacancy.currency_id[`name_${this.getLang}`]}.  ${`დამატებით: `+this.m.vacancy[`additional_${this.getLang}`]} `
            this.$swal(
                {
                    title: '<p>თქვენი ვაკანსია</p>',
                    // icon: 'info',
                    html:html,
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false,
                    confirmButtonText: 'დამატება',
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    let currentObj = this
                    // this.loader = true
                    console.log('this.m', this.m);
                    // return;
                    axios({
                        method: "post",
                        url: "/add_vacancy",
                        data: this.m,

                    })
                    .then(function (response) {
                        console.log('response.data', response.data);
                        if (response.data.status == 200) {
                            currentObj.loader = false
                            currentObj.createModel()

                            currentObj.$swal({
                                title: '<strong>ვაკანსია წარმატებით დაემატა</strong>',
                                icon: 'info',
                                html:
                                    `თქვენი ვაკანსიის კოდია <b>${ response.data.data }</b>, დააკოპირეთ კოდი და ეწვიეთ
                                    <a href="//sweetalert2.github.io"><u>ლინკს</u></a>
                                    სადაც შეგიძლიათ მიიღოთ ინფორმაცია თქვენი ვაკანსიის შესახებ`,
                                showCloseButton: true,
                                showCancelButton: true,
                                focusConfirm: false,
                            })

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
        addBenefit(item){
            this.m.benefit.push(item)
            this.benefitText += item[`name_${this.getLang}`]+', '
        },
        chooseNumberCode(item){
            this.m.employer.number_code_id = item.id
            this.numberCode = {
                'phonecode': item.phonecode,
                'iso':item.iso
            }
        }


    },
    watch:{
        'm.vacancy.work_schedule_id': function (newValue, oldValue) {
            // console.log('new', newValue);
            if (newValue != '') {
                this.m.vacancy[`additional_schedule_${this.getLang}`] = this.localText.schedule[`${newValue.id}`][`${this.getLang}`]
                console.log(this.localText.schedule[`${newValue.id}`][`${this.getLang}`]);
            }
        },
        'm.vacancy.category_id': function (newValue, oldValue) {
            this.cla.forWhoNeed = _.filter(this.data.classificatory.forWhoNeed, function(o) { return o.category_id == newValue.id; });
            this.cla.duty = _.filter(this.data.classificatory.duty, function(o) { return o.category_id == newValue.id; });
        }
    },
    mounted(){
        console.log('this.data', this.data);
    }
}
</script>
<style lang="">

</style>
