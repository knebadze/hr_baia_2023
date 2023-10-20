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
                                    <input
                                        class="form-control"
                                        v-model="m.employer.name"
                                        :class="{ 'is-invalid': (m.employer.name == null || v.employer.name.$error) }"
                                        type="text"
                                        placeholder="Devid Smith"
                                        @blur="v.employer.name.$touch"
                                    >
                                    <span v-if="send && !v.employer.name.required.$response" style='color:red'>* </span>
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
                                        :class="(m.employer.email == null || v.employer.email.$error)?'is-invalid':''"
                                        v-model="m.employer.email"
                                        type="email"
                                        placeholder="employer@gmail.com"
                                        @blur="v.employer.email.$touch"
                                    >
                                    <span v-if="send && !v.employer.email.email.$response" style='color:red'>* </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label><span class="text-danger">* </span>{{ ('ტელეფონის ნომერი') }}</label>
                                    <div class="input-group mb-3">
                                    <button style="border-style: none;" class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span :class="`fi fi-${m.employer.number_code.iso.toLowerCase()}`"></span>+{{ m.employer.number_code.phonecode }}</button>
                                    <ul class="dropdown-menu" style=" overflow: hidden; overflow-y: auto; max-height: calc(100vh - 550px);">
                                        <li v-for="item in cla.numberCode" @click="chooseNumberCode(item)"><a class="dropdown-item"><span :class="`fi fi-${item.iso.toLowerCase()}`"></span>+{{ item.phonecode }}</a></li>
                                    </ul>
                                        <input
                                            type="text"
                                            class="form-control"
                                            :class="(m.employer.number == null || v.employer.number.$error)?'is-invalid':''"
                                            v-model="m.employer.number"
                                            placeholder="555666777"
                                            onkeypress="return /[0-9]/i.test(event.key)"
                                            @blur="v.employer.number.$touch"
                                        >
                                        <span v-if="send && !v.employer.number.required.$response" style='color:red'>* </span>
                                        <span v-if="send && !v.employer.number.numeric.$response" style='color:red'>* </span>
                                    </div>
                                </div>
                            </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>მისამართი</label>
                                <div class="ls-inputicon-box">
                                    <input
                                        class="form-control"
                                        :class="(m.employer.address == null || v.employer.address.$error)?'is-invalid':''"
                                        v-model="m.employer.address"
                                        type="text"
                                        placeholder="მაგ: თბილისი, სამგორი"
                                        @blur="v.employer.address.$touch"
                                    >
                                    <span v-if="send && !v.employer.address.required.$response" style='color:red'>* </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>ქუჩა</label>
                                <div class="ls-inputicon-box">
                                    <input
                                        class="form-control"
                                        v-model="m.employer.street"
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
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label><span class="text-danger">* </span>{{ $t('lang.employer_add_job_vacancy_name') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input
                                            class="form-control"
                                            :class="(m.vacancy.title == null || v.vacancy.title.$error)?'is-invalid':''"
                                            v-model="m.vacancy.title"
                                            type="text"
                                            :placeholder="$t('lang.employer_add_job_vacancy_name_placeholder')"
                                            @blur="v.vacancy.title.$touch"
                                        >
                                        <span v-if="send && !v.vacancy.title.required.$response" style='color:red'>* </span>
                                        <span v-if="send && !v.vacancy.title.maxLength.$response" style='color:red'>* </span>
                                    </div>
                                </div>
                            </div>

                            <!--Job Category-->
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label><span class="text-danger">* </span>{{ $t('lang.employer_add_job_position') }}</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect
                                            :customClass="{ 'is-invalid': (m.vacancy.category_id == null || v.vacancy.category_id.$error) }"
                                            v-model="m.vacancy.category_id"
                                            :options="cla.category"
                                            deselect-label="Can't remove this value"
                                            :track-by="`name_${getLang}`"
                                            :label="`name_${getLang}`"
                                            placeholder="Select one"
                                            :searchable="true"
                                            :allow-empty="false"
                                            @blur="v.vacancy.category_id.$touch"
                                        >
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                        <span v-if="send && !v.vacancy.category_id.required.$response" style='color:red'>* </span>
                                    </div>
                                </div>
                            </div>



                            <div class="col-xl-4 col-lg-6 col-md-12" >
                                <div class="form-group">
                                    <label><span class="text-danger">* </span>{{ ('ვისთვის გესაჭიროებათ?') }}</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect
                                            v-model="m.for_who_need"
                                            :options="cla.forWhoNeed"
                                            :multiple="true"
                                            :close-on-select="false"
                                            :clear-on-select="false"
                                            :preserve-search="true"
                                            :placeholder="$t('lang.employer_add_job_select')"
                                            label="name_ka"
                                            track-by="name_ka"
                                            :preselect-first="false"
                                            @blur="v.for_who_need.$touch"
                                        />
                                        <span v-if="send && !v.for_who_need.required.$response" style='color:red'>* </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12" v-if="m.vacancy.category_id.id == 7">
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
                                            v-model="m.vacancy.work_schedule_id"
                                            :options="cla.workSchedule"
                                            deselect-label="Can't remove this value"
                                            :track-by="`name_${getLang}`"
                                            :label="`name_${getLang}`"
                                            placeholder="Select one"
                                            :searchable="false"
                                            :allow-empty="false"
                                            @blur="v.vacancy.work_schedule_id.$touch"
                                        >
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                        <span v-if="send && !v.vacancy.work_schedule_id.required.$response" style='color:red'>* </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_salary_title') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input
                                            class="form-control"
                                            :class="{ 'is-invalid': (m.vacancy.payment == null || v.vacancy.payment.$error) }"
                                            v-model="m.vacancy.payment"
                                            type="number" step="50"
                                            @blur="v.vacancy.payment.$touch">
                                        <span v-if="send && !v.vacancy.payment.required.$response" style='color:red'>* </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_currency_title') }}</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect
                                            v-model="m.vacancy.currency_id"
                                            :options="cla.currency"
                                            deselect-label="Can't remove this value"
                                            :track-by="`name_${getLang}`"
                                            :label="`name_${getLang}`"
                                            placeholder="Select one"
                                            :searchable="false"
                                            :allow-empty="false"
                                            @blur="v.vacancy.currency_id.$touch"
                                        >
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                        <span v-if="send && !v.vacancy.currency_id.required.$response" style='color:red'>* </span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><span class="text-danger">* </span>{{ $t('lang.employer_add_job_jobs_day') }}</label>
                                    <p><small v-if="m.vacancy.work_schedule_id" class='text-danger'>* სავალდებულოო სამუშაო დღეების მითითება!!! </small></p>

                                    <div class="ls-inputicon-box">
                                        <textarea
                                            class="form-control"
                                            :class="{ 'is-invalid': (m.vacancy.additional_schedule == null || v.vacancy.additional_schedule.$error) }"
                                            v-model="m.vacancy.additional_schedule"
                                            type="text"
                                            :placeholder="''"
                                            rows="3"
                                            @blur="v.vacancy.additional_schedule.$touch"
                                        ></textarea>
                                        <span v-if="send && !v.vacancy.additional_schedule.required.$response" style='color:red'>* </span>
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
                                        <label class="form-check-label" for="exampleCheck2">შეეძლოს ღამე დარჩენა</label>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class=" form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck3" value="1" v-model="m.vacancy.work_additional_hours">
                                        <label class="form-check-label" for="exampleCheck3">შეეძლო დამატებით საათებში მუშაობა</label>
                                    </div>
                                </div>
                            </div>

                            <!--Start Date-->
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label><span class="text-danger">* </span>{{ $t('lang.employer_add_job_when_need') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" @input="startDate(m.vacancy.start_date)" v-model="m.vacancy.start_date" type="date" placeholder="" @blur="v.vacancy.start_date.$touch">
                                        <span v-if="send && !v.vacancy.start_date.required.$response" style='color:red'>* </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label><span class="text-danger">* </span>{{ $t('lang.employer_add_job_how_long') }}</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect
                                            v-model="m.vacancy.term_id"
                                            :options="cla.term"
                                            deselect-label="Can't remove this value"
                                            :track-by="`name_${getLang}`"
                                            :label="`name_${getLang}`"
                                            placeholder="Select one"
                                            :searchable="true"
                                            :allow-empty="false"
                                            @blur="v.vacancy.term_id.$touch"
                                        >
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                        <span v-if="send && !v.vacancy.term_id.required.$response" style='color:red'>* </span>
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
                                        <input class="form-control" @input="minAge(m.demand.min_age)" v-model="m.demand.min_age" type="number" placeholder="18" min="18">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.employer_add_job_max_age') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" @input="maxAge(m.demand.max_age)" v-model="m.demand.max_age" type="number" placeholder="45" >
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
                                        <multiselect v-model="m.duty"  :options="cla.duty" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" :placeholder="$t('lang.employer_add_job_select')" label="name_ka" track-by="name_ka" :preselect-first="false" >
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                        <!-- <span v-if="v.m.familyWorkedSelected.required.$invalid && v.m.familyWorkedSelected.$dirty" style='color:red'>* {{ v.m.candidateFamilyWorkSkill.required.$message}}</span> -->
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12" v-if="m.vacancy.category_id.id != 7">
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
                                    <textarea class="form-control" v-model="m.demand[`additional_duty_${getLang}`]" type="text" placeholder="" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class=" form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck4" value="1" v-model="m.demand.has_experience">
                                        <label class="form-check-label" for="exampleCheck4">გამოცდილების ქონა სავალდებულოა</label>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class=" form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck5" value="1" v-model="m.demand.has_recommendation">
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
                                        <multiselect v-model="m.vacancy.interview_place_id" :options="cla.interviewPlace" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" :placeholder="$t('lang.employer_add_job_select')"  :searchable="true" :allow-empty="false">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="text-left">
                                    <button type="submit" @click.prevent="add(m)" class="site-button m-r5">{{ $t('lang.employer_add_job_button_add') }}</button>
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
import { ref, computed, watch, watchEffect } from 'vue';
import { I18n } from 'laravel-vue-i18n';
import { useVuelidate } from '@vuelidate/core';
import { required, numeric, maxLength, email } from '@vuelidate/validators';
import Swal from 'sweetalert2';
import moment from 'moment';
export default {
    props: {
        data: Object,
    },
    setup(props) {
        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });
        const minDate = computed(() => moment().format('YYYY-MM-DD'));
        const maxDate = ref(null);
        let min_age, max_age = null;
        const workInformationSchedule = ref(null);
        const loader = ref(false);
        const send = ref(false);
        const cla = ref(_.cloneDeep(props.data.classificatory));
        cla.value.workSchedule = props.data.classificatory.workSchedule.filter(item => item.id !== 10 && item.id !== 11);
        const formData = {
            employer: {...props.data.model.employer},
            vacancy: {...props.data.model.vacancy},
            demand: {...props.data.model.demand},
            characteristic:[],
            duty: [],
            for_who_need: [],
            benefit: [],
            interviewDate:'',
            interviewTime:'',
        };
        formData.employer.name = formData.employer[`name_${getLang.value}`];
        formData.employer.address = formData.employer[`address_${getLang.value}`];
        formData.employer.street = formData.employer[`street_${getLang.value}`];
        formData.employer.number_code = cla.value.numberCode.find(element => element.phonecode == 995);
        formData.vacancy.additional_schedule = formData.vacancy[`additional_schedule_${getLang.value}`];
        formData.vacancy.title = formData.vacancy[`title_${getLang.value}`];
        formData.vacancy.payment = 800;
        formData.vacancy['go_vacation'] = 0;
        formData.vacancy['stay_night'] = 0;
        formData.vacancy['work_additional_hours'] = 0;
        formData.lang = getLang;

        const m = ref(formData)


        formData.getLang = getLang;
        formData.number_code = cla.value.numberCode.find(element => element.phonecode == 995);

        const benefitText = ref('');
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
                    ka:'ორშაბათი_დან პარასკევის ჩათლით, 09:00_დან 18:00_მდე',
                    en:'',
                    ru:'',
                },
                '4':{
                    ka:'ორშაბათი_დან პარასკევის ჩათლით, 09:00_დან 18:00_მდე',
                    en:'',
                    ru:'',
                },
                '5':{
                    ka:'ორშაბათი_დან პარასკევის ჩათლით, 09:00_დან 18:00_მდე',
                    en:'',
                    ru:'',
                },
                '6':{
                    ka:'ორშაბათი_დან პარასკევის ჩათლით, 09:00_დან 18:00_მდე',
                    en:'',
                    ru:'',
                },
                '7':{
                    ka:'ორშაბათი_დან პარასკევის ჩათლით, 09:00_დან 18:00_მდე',
                    en:'',
                    ru:'',
                },
                '8':{
                    ka:'ორშაბათი_დან პარასკევის ჩათლით, 09:00_დან 18:00_მდე',
                    en:'',
                    ru:'',
                },
                '9':{
                    ka:'ორშაბათი_დან პარასკევის ჩათლით, 09:00_დან 18:00_მდე',
                    en:'',
                    ru:'',
                },

            }
        };

        const rules = {

                employer:{
                    name: { required },
                    number: { required, numeric },
                    address: { required },
                    email: { email }
                },
                vacancy:{
                    title: { required, maxLength:maxLength(50) },
                    category_id: { required },
                    payment: { required },
                    currency_id: { required },
                    work_schedule_id: { required },
                    additional_schedule: { required },
                    start_date: { required },
                    term_id: { required },
                },
                for_who_need: { required }

        };
        const v = useVuelidate(rules, m);
        const watchWorkSchedule = () => m.value.vacancy.work_schedule_id;
        watch(watchWorkSchedule, (newVal) => {

            if (newVal != '') {
                m.value.vacancy.additional_schedule = localText()[`${newVal.id}`][`${getLang.value}`]
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
                m.value.vacancy.payment = price;
            }
        });

        const watchCategory = () => m.value.vacancy.category_id;
        watch(watchCategory, (newVal) => {
            cla.value.forWhoNeed = _.filter(props.data.classificatory.forWhoNeed, function(o) { return o.category_id == newVal.id; });
            cla.value.duty = _.filter(props.data.classificatory.duty, function(o) { return o.category_id == newVal.id; });
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
            if (!m.value.benefit.some((benefit) => benefit.id == item.id)) {
                m.value.benefit.push(item)
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

        const add = (item) =>{
            let data = {...item}
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
            loader.value = true
            data.employer[`name_${getLang.value}`] = data.employer.name
            data.employer[`address_${getLang.value}`] = data.employer.address
            data.employer[`street_${getLang.value}`] = data.employer.street
            data.vacancy[`additional_schedule_${getLang.value}`] = data.vacancy.additional_schedule
            data.vacancy[`title_${getLang.value}`] = data.vacancy.title

            v.value.$touch();
            if (!v.value.$invalid) {
                let html =  `
                    ${data.vacancy.start_date}_დან ${data.vacancy.term_id[`name_${getLang.value}`]},
                    ${(data.vacancy[`for_who_${getLang.value}`])?data.vacancy[`for_who_${getLang.value}`]:''}
                    გვესაჭიროება ${data.vacancy.category_id[`name_${getLang.value}`]}.
                    მისამართი: ${data.employer[`address_${getLang.value}`]} ${data.employer[`street_${getLang.value}`]},
                    გრაფიკი: ${data.vacancy.work_schedule_id[`name_${getLang.value}`]},
                    ${data.vacancy[`additional_schedule_${getLang.value}`]}.
                    ანაზღაურება: ${data.vacancy.payment} ${data.vacancy.currency_id[`name_${getLang.value}`]}.
                    მოვალეობები: ${data.duty.map(i => i[`name_${getLang.value}`]).join(', ')}
                `;
                Swal.fire({
                    title: '<p>თქვენი ვაკანსია</p>',
                    // icon: 'info',
                    html:html,
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false,
                    confirmButtonText: 'დამატება',
                    // icon: 'success',
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger',
                    },
                    width: '60%'
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        validateAndSubmit(data)
                    }
                })


            }else{
                loader.value = false
                toast.warning("აუცილებელია სავალდებულო ველები იყოს შევსებული", {
                    theme: 'colored',
                    autoClose: 2000,
                });
            }
        }
        const validateAndSubmit = (data) => {
            send.value = true
            axios({
                method: "post",
                url: "/add_vacancy",
                data: data,

            })
            .then(function (response) {
                if (response.data.status == 200) {
                    if (response.data.data.type == "e") {
                        toast.error(response.data.data.message, {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        return
                    }
                    loader.value = false
                    m.value = formData
                    showAlert()
                }
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        };
        const showAlert = () => {
            //let html =  `ეწვიეთ ლინკს სადაც შეგიძლიათ მიიღოთ ინფორმაცია თქვენი ვაკანსიის შესახებ, თქვენი ტელეფონის ნომრის გამოყენებით`;
            Swal.fire({
                        title: '<strong>ვაკანსია წარმატებით დაემატა</strong>',
                        icon: 'success',
                        html:'',

                        showCloseButton: true,
                        confirmButtonText: 'მთავარზე დაბრუნება',
                        showCancelButton: false,
                        focusConfirm: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = new URL( location.href)
                            if (props.data.model.role_id == 3) {
                                window.location.replace(`${url.origin}/ka`);
                            }else{
                                window.location.replace( `${url.origin}/admin/vacancy?ka`);
                            }

                        }

                    })
        };

        return {
            m,
            // model,
            cla,
            v,
            validateAndSubmit,
            add,
            getLang,
            chooseNumberCode,
            handleFileChange,
            loader,
            workInformationSchedule,
            benefitText,
            addBenefit,
            send,
            minAge,
            maxAge,
            localText,
            minDate,
            maxDate,
            startDate

        };
    },
    methods: {


    },
};
</script>
<style lang="">

</style>
