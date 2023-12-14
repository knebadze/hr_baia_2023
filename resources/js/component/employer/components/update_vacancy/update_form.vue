<template lang="">
    <div class="panel panel-default">
    <div class="text-center">
        <h3>თქვენი ვაკანსია</h3>
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
                                <input
                                    class="form-control"
                                    v-model="m.name"
                                    :class="{ 'is-invalid': (m.name == null || v.name.$error) }"
                                    type="text"
                                    placeholder="Devid Smith"
                                    @blur="v.name.$touch"
                                >
                                <span v-if="send && !v.name.required.$response" style='color:red'>* </span>
                            </div>
                        </div>
                    </div>
                    <!--Job title-->
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>მაილი</label>
                            <div class="ls-inputicon-box">
                                <input
                                    class="form-control"
                                    :class="(m.email == null || v.email.$error)?'is-invalid':''"
                                    v-model="m.email"
                                    type="email"
                                    placeholder="employer@gmail.com"
                                    @blur="v.email.$touch"
                                >
                                <span v-if="send && !v.email.email.$response" style='color:red'>* </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ ('ტელეფონის ნომერი') }}</label>
                                <div class="input-group mb-3">
                                <button style="border-style: none;" class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span :class="`fi fi-${m.number_code.iso.toLowerCase()}`"></span>+{{ m.number_code.phonecode }}</button>
                                <ul class="dropdown-menu" style=" overflow: hidden; overflow-y: auto; max-height: calc(100vh - 550px);">
                                    <li v-for="item in cla.numberCode" @click="chooseNumberCode(item)"><a class="dropdown-item"><span :class="`fi fi-${item.iso.toLowerCase()}`"></span>+{{ item.phonecode }}</a></li>
                                </ul>
                                    <input
                                        type="text"
                                        class="form-control"
                                        :class="(m.number == null || v.number.$error)?'is-invalid':''"
                                        v-model="m.number"
                                        placeholder="555666777"
                                        onkeypress="return /[0-9]/i.test(event.key)"
                                        @blur="v.number.$touch"
                                    >
                                    <span v-if="send && !v.number.required.$response" style='color:red'>* </span>
                                    <span v-if="send && !v.number.numeric.$response" style='color:red'>* </span>
                                </div>
                            </div>
                        </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label><span class="text-danger">* </span>მისამართი</label>
                            <div class="ls-inputicon-box">
                                <input
                                    class="form-control"
                                    :class="(m.address == null || v.address.$error)?'is-invalid':''"
                                    v-model="m.address"
                                    type="text"
                                    placeholder="მაგ: თბილისი, სამგორი"
                                    @blur="v.address.$touch"
                                >
                                <span v-if="send && !v.address.required.$response" style='color:red'>* </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>ქუჩა</label>
                            <div class="ls-inputicon-box">
                                <input
                                    class="form-control"
                                    v-model="m.street"
                                    type="text"
                                    placeholder="მაგ: კახეთის გზატკეცილი 36 ბ"
                                >
                            </div>
                        </div>
                    </div>

                    <div class="panel-heading wt-panel-heading p-a20 m-b30">
                        <h4 class="panel-tittle m-a0">{{ $t('lang.employer_add_job_general_info') }}</h4>
                        <!-- <small class="text-danger">* {{ $t('lang.employer_add_job_definitely_fields') }}</small> -->
                    </div>
                    <!-- <div class="panel-body wt-panel-body p-a20 m-b30 "></div> -->
                        <!--Job title-->
                        <!--Job Category-->
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.employer_add_job_position') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        :customClass="{ 'is-invalid': (m.category == null || v.category.$error) }"
                                        v-model="m.category"
                                        :options="cla.category"
                                        deselect-label="Can't remove this value"
                                        :track-by="`name_${getLang}`"
                                        :label="`name_${getLang}`"
                                        placeholder="Select one"
                                        :searchable="true"
                                        :allow-empty="false"
                                        @blur="v.category.$touch"
                                        :disabled="true"
                                    >
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                    <span v-if="send && !v.category.required.$response" style='color:red'>* </span>
                                </div>
                            </div>
                        </div>



                        <div class="col-xl-4 col-lg-6 col-md-12" >
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ ('ვისთვის გესაჭიროებათ?') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.vacancy_for_who_need"
                                        :options="cla.forWhoNeed"
                                        :multiple="true"
                                        :close-on-select="false"
                                        :clear-on-select="false"
                                        :preserve-search="true"
                                        :placeholder="$t('lang.employer_add_job_select')"
                                        label="name_ka"
                                        track-by="name_ka"
                                        :preselect-first="false"
                                        @blur="v.vacancy_for_who_need.$touch"
                                    />
                                    <span v-if="send && !v.vacancy_for_who_need.required.$response" style='color:red'>* </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12" v-if="m.category.id == 7">
                            <div class="form-group">
                                <label>მართვის მოწმობა </label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.driving_license"
                                        :options="cla.drivingLicense"
                                        :multiple="true"
                                        :close-on-select="false"
                                        :clear-on-select="false"
                                        :preserve-search="true"
                                        :placeholder="$t('lang.employer_add_job_select')"
                                        label="name"
                                        track-by="name"
                                        :preselect-first="false"
                                    />
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_schedule_title') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.work_schedule"
                                        :options="cla.workSchedule"
                                        deselect-label="Can't remove this value"
                                        :track-by="`name_${getLang}`"
                                        :label="`name_${getLang}`"
                                        placeholder="Select one"
                                        :searchable="false"
                                        :allow-empty="false"
                                        @blur="v.work_schedule.$touch"
                                    >
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                    <span v-if="send && !v.work_schedule.required.$response" style='color:red'>* </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_salary_title') }}</label>
                                <div class="ls-inputicon-box">
                                    <input
                                        class="form-control"
                                        :class="{ 'is-invalid': (m.payment == null || v.payment.$error) }"
                                        v-model="m.payment"
                                        type="number" step="50"
                                        @blur="v.payment.$touch">
                                    <span v-if="send && !v.payment.required.$response" style='color:red'>* </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_currency_title') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.currency"
                                        :options="cla.currency"
                                        deselect-label="Can't remove this value"
                                        :track-by="`name_${getLang}`"
                                        :label="`name_${getLang}`"
                                        placeholder="Select one"
                                        :searchable="false"
                                        :allow-empty="false"
                                        @blur="v.currency.$touch"
                                    >
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                    <span v-if="send && !v.currency.required.$response" style='color:red'>* </span>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.employer_add_job_jobs_day') }}</label>
                                <p><small v-if="m.work_schedule" class='text-danger'>* სავალდებულოო სამუშაო დღეების მითითება!!! </small></p>

                                <div class="ls-inputicon-box">
                                    <textarea
                                        class="form-control"
                                        :class="{ 'is-invalid': (m.additional_schedule == null || v.additional_schedule.$error) }"
                                        v-model="m.additional_schedule"
                                        type="text"
                                        :placeholder="''"
                                        rows="3"
                                        @blur="v.additional_schedule.$touch"
                                    ></textarea>
                                    <span v-if="send && !v.additional_schedule.required.$response" style='color:red'>* </span>
                                </div>
                            </div>
                        </div>


                        <div class="panel-heading wt-panel-heading p-a20 my-3">
                            <h4 class="panel-tittle m-a0"><i class="fa fa-suitcase"></i> დამატებით</h4>
                        </div>
                        <div class="row mb-4" v-if="m.category.id == 1 || m.category.id == 2 || m.category.id == 4">
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class=" form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" v-model="m.go_vacation">
                                    <label class="form-check-label" for="exampleCheck1">შეეძლოს არდადეგებზე გაყოლა</label>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class=" form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck2" value="1" v-model="m.stay_night">
                                    <label class="form-check-label" for="exampleCheck2">შეეძლოს ღამე დარჩენა</label>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class=" form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck3" value="1" v-model="m.work_additional_hours">
                                    <label class="form-check-label" for="exampleCheck3">შეეძლო დამატებით საათებში მუშაობა</label>
                                </div>
                            </div>
                        </div>

                        <!--Start Date-->
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.employer_add_job_when_need') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" @input="startDate(m.start_date)" v-model="m.start_date" type="date" placeholder="" @blur="v.start_date.$touch">
                                    <span v-if="send && !v.start_date.required.$response" style='color:red'>* </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.employer_add_job_how_long') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.term"
                                        :options="cla.term"
                                        deselect-label="Can't remove this value"
                                        :track-by="`name_${getLang}`"
                                        :label="`name_${getLang}`"
                                        placeholder="Select one"
                                        :searchable="true"
                                        :allow-empty="false"
                                        @blur="v.term.$touch"
                                    >
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                    <span v-if="send && !v.term.required.$response" style='color:red'>* </span>
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
                                <textarea class="form-control" v-model="m.comment" type="text" :placeholder="$t('lang.employer_add_job_comment_for_agency_placeholder')" rows="3"></textarea>
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
                                    <input class="form-control" @input="minAge(m.min_age)" v-model="m.min_age" type="number" placeholder="18" min="18">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.employer_add_job_max_age') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" @input="maxAge(m.max_age)" v-model="m.max_age" type="number" placeholder="45" >
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
                            <div class="form-group">
                                <label>{{ $t('lang.employer_add_job_general_character') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.characteristic"  :options="cla.characteristic" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" :placeholder="$t('lang.employer_add_job_select')" label="name_ka" track-by="name_ka" :preselect-first="false">
                                        <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.employer_add_job_duties') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.vacancy_duty"  :options="cla.duty" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" :placeholder="$t('lang.employer_add_job_select')" label="name_ka" track-by="name_ka" :preselect-first="false" >
                                        <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                    </multiselect>
                                    <!-- <span v-if="v.m.familyWorkedSelected.required.$invalid && v.m.familyWorkedSelected.$dirty" style='color:red'>* {{ v.m.candidateFamilyWorkSkill.required.$message}}</span> -->
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12" v-if="m.category.id != 7">
                            <div class="form-group">
                                <label>მართვის მოწმობა </label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.driving_license"  :options="cla.drivingLicense" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" :placeholder="$t('lang.employer_add_job_select')" label="name" track-by="name" :preselect-first="false" >
                                        <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                    </multiselect>
                                    <!-- <span v-if="v.m.familyWorkedSelected.required.$invalid && v.m.familyWorkedSelected.$dirty" style='color:red'>* {{ v.m.candidateFamilyWorkSkill.required.$message}}</span> -->
                                </div>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.employer_add_job_additional_duties') }}</label>
                                <textarea class="form-control" v-model="m[`additional_duty_${getLang}`]" type="text" placeholder="" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class=" form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck4" value="1" v-model="m.has_experience">
                                    <label class="form-check-label" for="exampleCheck4">გამოცდილების ქონა სავალდებულოა</label>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class=" form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck5" value="1" v-model="m.has_recommendation">
                                    <label class="form-check-label" for="exampleCheck5">რეკომენდაციის ქონა სავალდებულოა</label>
                                </div>
                            </div>

                        <div class="panel-heading wt-panel-heading p-a20 my-3">
                            <h4 class="panel-tittle m-a0"><i class="fa fa-suitcase"></i> გასაუბრება</h4>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('გასაუბრების თარიღი') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.interviewDate"  type="date"  :min="minDate" :max="maxDate">
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

                        <div class="col-lg-12 col-md-12">
                            <div class="text-left">
                                <button type="submit" @click.prevent="update(m)" class="site-button m-r5">{{ $t('რედაქტირება') }}</button>
                            </div>
                        </div>
                </div>
        </div>
    </div>
</template>
<script>
import _ from 'lodash';
import { reactive, ref, computed, watch, isProxy } from 'vue';
import { I18n } from 'laravel-vue-i18n';
import { useVuelidate } from '@vuelidate/core';
import { required, numeric, maxLength, email } from '@vuelidate/validators';
import Swal from 'sweetalert2';
import moment from 'moment';
export default {
    props:{
        item: Object,
        cla: Object
    },
    emits:['emitUpdateData'],
    setup(props, {emit}) {
        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });
        const minDate = computed(() => moment().format('YYYY-MM-DD'));
        const maxDate = ref(null);
        let min_age, max_age = null;
        const workInformationSchedule = ref(null);
        const editedFields = ref([]);
        // const loader = ref(false);
        const send = ref(false);
        // const cla = ref(_.cloneDeep(props.data.classificatory));
        // cla.value.workSchedule = props.data.classificatory.workSchedule.filter(item => item.id !== 10 && item.id !== 11);
        // console.log('props.data',props.data);
        const vacancy = {...props.item.model.vacancy}

        const formData = () => {
            let [datePart, timePart] = vacancy.interview_date.split(' ');
            const { id: employer_id, ...employerWithoutId } = vacancy.employer;
            const { id: demand_id , ...demandWithoutId } = vacancy.demand;
            const data = {
                ...employerWithoutId,
                ...vacancy,
                ...demandWithoutId,
                characteristic:vacancy.characteristic,
                vacancy_duty: vacancy.vacancy_duty,
                vacancy_for_who_need: vacancy.vacancy_for_who_need,
                vacancy_benefit: vacancy.vacancy_benefit,
                interviewDate:datePart,
                interviewTime:timePart,
                driving_license: vacancy.vacancy_driving_license
            };
            data.employer_id = employer_id
            data.demand_id = demand_id

            data.name = data[`name_${getLang.value}`];
            data.address = data[`address_${getLang.value}`];
            data.street = data[`street_${getLang.value}`];

            data.additional_schedule = data[`additional_schedule_${getLang.value}`];
            data.title = data[`title_${getLang.value}`];
            data.go_vacation = data.go_vacation == 0 ? false : true;
            data.stay_night = data.stay_night == 0 ? false : true;
            data.work_additional_hours = data.work_additional_hours == 0 ? false : true;

            data.has_experience = data.has_experience == 0 ? false : true;
            data.has_recommendation = data.has_recommendation == 0 ? false : true;


            data.lang = getLang.value;
            data.getLang = getLang.value;

            return data;
        }

        const model = reactive({...formData()})
        console.log('model', model);
        const m = ref({...model})
        console.log('m', m.value);

        const isReactiveProxy = (obj) => {
            if (isProxy(obj)) {
                return true;
            }

            if (typeof obj !== 'object' || obj === null) {
                return false;
            }

            for (const key in obj) {
                if (isReactiveProxy(obj[key])) {
                    return true;
                }
            }

            return false;
        };
        const rawValue = ref(null)
        const forItem = (item, re = false) => {
            let repeat = re
            var editedFields = {};
            for (const field in item) {
                // console.log(item[field], isReactiveProxy(item[field]));
                isReactiveProxy(item[field]) ? forItem(item[field], true) : ''
                if (!repeat) {
                    rawValue.value = item[field];
                }


                 // Extract the raw value from a ref
                // console.log(item[field], model[field]);
                if (item[field] !==  model[field]) {
                    // return
                    // console.log(field, rawValue.value);
                    editedFields[field] = rawValue.value;
                }
            }
            repeat = false
            return editedFields;
        };
        // const rawValue = typeof item[field] === 'object'? item[field]['id'] : item[field]; // Extract the raw value from a ref

        //         if (rawValue !== typeof model[field] === 'object'?model[field]['id']:model[field]) {
        //             // return
        //             editedFields[field] = item[field];
        //         }
        watch(m.value, (newValues, oldValues) => {
            // Do something when form fields change
            // console.log('newValues', newValues);
            // console.log('forItem(newValues);', forItem(newValues));

            // const changedFields = Object.keys(newValues).filter((key) => {
            //     // console.log(key, newValues[key], model[key]);
            //     return newValues[key] !== model[key]});
            // console.log('changedFields', changedFields);
            // editedFields.value = changedFields;

        }, { deep: true });

        const benefitText = ref(vacancy.vacancy_benefit ? vacancy.vacancy_benefit.map(i => i[`name_${getLang.value}`]).join(', '): '');
        const  localText = () => {
            return  {
                '1':{
                    ka:'ორშაბათი_დან პარასკევის ჩათლით, 09:00_დან 18:00_მდე',
                    en:'',
                    ru:'',
                },
                '2':{
                    ka:'ორშაბათი_დან პარასკევის ჩათლით, 09:00_დან 18:00_მდე',
                    en:'',
                    ru:'',
                },
                '3':{
                    ka:'ორშაბათი_დან პარასკევის ჩათლით, 08:00_დან 13:00_მდე',
                    en:'',
                    ru:'',
                },
                '4':{
                    ka:'ორშაბათი_დან პარასკევის ჩათლით, 13:00_დან 17:00_მდე',
                    en:'',
                    ru:'',
                },
                '5':{
                    ka:'ორშაბათი_დან პარასკევის ჩათლით, 21:00_დან 07:00_მდე',
                    en:'',
                    ru:'',
                },
                '6':{
                    ka:'შაბათი და კვირა, 09:00_დან 18:00_მდე',
                    en:'',
                    ru:'',
                },
                '7':{
                    ka:'ორშაბათი, ოთხშაბათი, პარასკევი, 09:00_დან 18:00_მდე',
                    en:'',
                    ru:'',
                },
                '8':{
                    ka:'ხვალ, 09:00_დან 18:00_მდე',
                    en:'',
                    ru:'',
                },
                '9':{
                    ka:'ორშაბათი, ხუთშაბათი, შაბათი, 09:00_დან 18:00_მდე',
                    en:'',
                    ru:'',
                },

            }
        };

        const rules = {
                    name: { required },
                    number: { required, numeric },
                    address: { required },
                    email: { email },
                    category: { required },
                    payment: { required },
                    currency: { required },
                    work_schedule: { required },
                    additional_schedule: { required },
                    start_date: { required },
                    term: { required },
                vacancy_for_who_need: { required }

        };
        const v = useVuelidate(rules, m);
        const watchWorkSchedule = () => m.value.work_schedule_id;
        watch(watchWorkSchedule, (newVal) => {

            if (newVal != '') {
                m.value.additional_schedule = localText()[`${newVal.id}`][`${getLang.value}`]
                const priceMap = {
                    1: 1100,
                    2: 1300,
                    3: 500,
                    4: 500,
                    5: 900,
                    6: 500,
                    7: 700,
                    8: 50,
                    9: 600,
                    // Add more cases as needed
                };

                let price = priceMap[newVal.id] || 0;
                m.payment = price;
            }
        });

        const watchCategory = () => m.value.category_id;
        watch(watchCategory, (newVal) => {
            cla.value.forWhoNeed = _.filter(props.cla.forWhoNeed, function(o) { return o.category_id == newVal.id; });
            cla.value.duty = _.filter(props.cla.duty, function(o) { return o.category_id == newVal.id; });
        });

        const startDate = (item) =>{
            console.log('item', item);
            maxDate.value = item
        }

        const chooseNumberCode = (item) =>{
            model.value.number_code = item
        };

        const handleFileChange = (event) => {
            file.value = event.target.files[0];
            model.value.file_name = file.value.name
        };

        const addBenefit = (item) => {
            if (!m.value.vacancy_benefit.some((benefit) => benefit.id == item.id)) {
                m.value.vacancy_benefit.push(item)
            benefitText.value += `${item[`name_${getLang.value}`]}, `;
            }
        };

        const minAge = (item) =>{

            const numberAsString = item.toString();
            if (numberAsString.length == 2) {
                min_age = item
            }else if(numberAsString.length > 2){
                m.value.demand.min_age = min_age
            }
            if (numberAsString.length == 2 && item < 18) {
                m.value.demand.min_age = 18
                toast.error("მინიმალური ასაკი არ უნდა იყოს 18 ზე ნაკლები", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                return
            }
        }

        const maxAge = (item) =>{

            const numberAsString = item.toString();
            if (numberAsString.length == 2) {
                max_age = item
            }else if(numberAsString.length > 2){
                m.value.demand.max_age = max_age
            }
            if (numberAsString.length == 2 && item > 70) {
                m.value.demand.max_age = 70
                toast.error(`მაქსიმალური ასაკი არ უნდა იყოს 70 ზე მეტი`, {
                    theme: 'colored',
                    autoClose: 1000,
                });
                return
            }
        }


        const update = (item) => {
            console.log('forItem(newValues);', forItem(item));
            send.value = true
            let data = JSON.parse(JSON.stringify(item))
            // if (file.value != null && file.value.type !== 'application/pdf') {
            //     toast.error("გთხოვთ ფაილი ატვირთეთ pdf ფორმატში", {
            //         theme: 'colored',
            //         autoClose: 1000,
            //     });
            //     return
            // }
            // if (data.has_recommendation.id == 1) {
            //     data[`name_${getLang.value}`] = data.name;
            //     data[`position_${getLang.value}`] = data.position;
            // }else{
            //     data[`no_reason_info_${getLang}`] = data.no_reason_info;
            // }
            // data.candidate_id = props.data.candidate_id
            // const sendFormData = new FormData();
            // sendFormData.append('data', JSON.stringify(data))
            // if (file.value) {
            //     sendFormData.append('file', file.value);
            // }

            // loader.value = true
            data[`name_${getLang.value}`] = data.name
            data[`address_${getLang.value}`] = data.address
            data[`street_${getLang.value}`] = data.street
            data[`additional_schedule_${getLang.value}`] = data.additional_schedule

            v.value.$touch();
            if (!v.value.$invalid) {
                let editedFields =  forItem(item)
                let html =  `
                    ${data.start_date}_დან ${data.term[`name_${getLang.value}`]},
                    ${(data[`for_who_${getLang.value}`])?data[`for_who_${getLang.value}`]:''}
                    გვესაჭიროება ${data.category[`name_${getLang.value}`]}.
                    მისამართი: ${data[`address_${getLang.value}`]} ${data[`street_${getLang.value}`]},
                    გრაფიკი: ${data.work_schedule[`name_${getLang.value}`]},
                    ${data[`additional_schedule_${getLang.value}`]}.
                    ანაზღაურება: ${data.payment} ${data.currency[`name_${getLang.value}`]}.
                    მოვალეობები: ${data.vacancy_duty.map(i => i[`name_${getLang.value}`]).join(', ')}
                `;
                Swal.fire({
                    title: '<p>თქვენი ვაკანსია</p>',
                    // icon: 'info',
                    html:html,
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false,
                    confirmButtonText: 'რედაქტირება',
                    // icon: 'success',
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger',
                    },
                    width: '60%'
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {

                        emit('emitUpdateData', {model:data, edit:{...editedFields}})
                        // validateAndSubmit(data, editedFields)
                    }
                    send.value = false
                })


            }else{
                send.value = false
                toast.warning("აუცილებელია სავალდებულო ველები იყოს შევსებული", {
                    theme: 'colored',
                    autoClose: 2000,
                });
            }
        };

        return {
            m,
            // cla,
            v,
            // validateAndSubmit,
            getLang,
            chooseNumberCode,
            handleFileChange,
            // loader,
            workInformationSchedule,
            benefitText,
            addBenefit,
            send,
            minAge,
            maxAge,
            localText,
            minDate,
            maxDate,
            startDate,

            update

    };

    }
}
</script>
<style lang="">

</style>
