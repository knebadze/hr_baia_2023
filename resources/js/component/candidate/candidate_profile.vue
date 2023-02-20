<template lang="">
    <div class="col-xl-9 col-lg-8 col-md-12 m-b30">
        <!--Filter Short By-->
        <div class="twm-right-section-panel site-bg-gray">
            <!-- <form> -->


            <!--Basic Information-->
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_input_basic_info') }}</h4>
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30 ">
                    <form @submit.prevent="authUpdate()">
                        <div class="row" >

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_input_name') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.auth[`name_${getLang}`]"  type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-user "></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_input_phone') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control"  v-model="m.auth.number" type="text" >
                                        <i class="fs-input-icon fa fa-phone-alt"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_input_email') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control"  v-model="m.auth.email" type="email" placeholder="">
                                        <i class="fs-input-icon fas fa-at"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_input_birth_date') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control d" data-provide=""  type="date" v-model="m.auth.date_of_birth" placeholder="mm/dd/yyyy">
                                        <i class="fs-input-icon far fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <!--Gender-->
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_input_gender') }}</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="m.auth.gender_id"  data-live-search="true" title="" id="gender" data-bv-field="size">
                                            <option>Choose Gender</option>
                                            <option v-for="gender in data.classificator.gender " :value="gender.id">{{ gender[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-venus-mars"></i>
                                    </div>
                                </div>
                            </div>



                            <div class="col-lg-12 col-md-12 mt-4">
                                <div class="text-left">
                                    <button type="" class="site-button" >{{ $t('lang.user_profile_page_button_save_changes') }}</button>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
            </div>

            <!-- <form @submit.prevent="addCandidate()"> -->
                 <!--personal information-->
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_personal_info') }}</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">
                        <!-- <form @submit.prevent="addPersonalInfo()"> -->
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_personal_number') }}</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.candidate.personal_number" type="text" placeholder="">
                                            <i class="fs-input-icon fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_personal_nationality') }}</label>
                                        <div class="ls-inputicon-box">
                                            <select class="wt-select-box selectpicker" v-model="m.candidate.nationality_id"  data-live-search="true" title=""  data-bv-field="size">
                                                <option v-for="national in data.classificator.nationality " :value="national.id">{{ national[`name_${getLang}`] }}</option>
                                            </select>
                                            <i class="fs-input-icon fa fa-flag"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_personal_citizenship') }}</label>
                                        <div class="ls-inputicon-box">
                                            <select class="wt-select-box selectpicker" v-model="m.candidateCitizenships"  data-live-search="true" title=""  data-bv-field="size" multiple>
                                                <option v-for="citizen in data.classificator.citizenship " :value="citizen.id">{{ citizen[`name_${getLang}`] }}</option>
                                            </select>
                                            <i class="fs-input-icon fa fa-user-plus"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_personal_religion') }}</label>
                                        <div class="ls-inputicon-box">
                                            <select class="wt-select-box selectpicker" v-model="m.candidate.religion_id"  data-live-search="true" title=""  data-bv-field="size">
                                                <option v-for="religion in data.classificator.religions " :value="religion.id">{{ religion[`name_${getLang}`] }}</option>
                                            </select>
                                            <i class="fs-input-icon fa fa-cross"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_personal_education') }}</label>
                                        <div class="ls-inputicon-box">
                                            <select class="wt-select-box selectpicker" v-model="m.candidate.education_id"  data-live-search="true" title=""  data-bv-field="size">
                                                <option v-for="education in data.classificator.educations " :value="education.id">{{ education[`name_${getLang}`] }}</option>
                                            </select>
                                            <i class="fs-input-icon fa fa-school"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_personal_profession') }}</label>
                                        <div class="ls-inputicon-box">
                                            <select class="wt-select-box selectpicker" v-model="m.candidateProfessions"  data-live-search="true" title=""  data-bv-field="size" multiple>
                                                <option v-for="profession in data.classificator.professions " :value="profession.id" >{{ profession[`name_${getLang}`] }}</option>
                                            </select>
                                            <i class="fs-input-icon fa fa-graduation-cap"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_personal_specialty') }}</label>
                                        <div class="ls-inputicon-box">
                                            <select class="wt-select-box selectpicker" v-model="m.candidateSpecialties"  data-live-search="true" title=""  data-bv-field="size" multiple>
                                                <option v-for="specialty in data.classificator.specialties " :value="specialty.id">{{ specialty[`name_${getLang}`] }}</option>
                                            </select>
                                            <i class="fs-input-icon fa fa-microscope"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_personal_family') }}</label>
                                        <div class="ls-inputicon-box">
                                            <select class="wt-select-box selectpicker" v-model="m.candidate.marital_status_id"  data-live-search="false" title=""  data-bv-field="size">
                                                <option v-for="marital in data.classificator.maritalStatus " :value="marital.id">{{ marital[`name_${getLang}`] }}</option>
                                            </select>
                                            <i class="fs-input-icon fa fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="m.candidate.marital_status_id && m.candidate.marital_status_id != 1 " class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_personal_children') }}</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.candidate.children" type="number" placeholder="">
                                            <i class="fs-input-icon fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="m.candidate.marital_status_id && m.candidate.marital_status_id != 1 && m.candidate.children && m.candidate.children != 0" class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_personal_children_age') }}</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.candidate.children_age" type="text" placeholder="მაგ: 10,14">
                                            <i class="fs-input-icon fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="m.candidate.marital_status_id && m.candidate.marital_status_id == 2 " class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_personal_spouse') }}</label>
                                        <textarea class="form-control" v-model="m.candidate.spouse" rows="3" placeholder="{{ $t('lang.user_profile_page_personal_family_fill_info') }}"></textarea>
                                    </div>
                                </div>
                                         <!-- Driving License -->
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <label>{{ $t('lang.user_profile_page_driving_license') }}</label>
                                    <div class="driving_license">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="driving_license_a" value="A" v-model="checkedLicenseNames">
                                            <label class="form-check-label" for="driving_license_a">A</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="driving_license_b" value="B" v-model="checkedLicenseNames">
                                            <label class="form-check-label" for="driving_license_b">B</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="driving_license_c" value="C" v-model="checkedLicenseNames">
                                            <label class="form-check-label" for="driving_license_c">C</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="driving_license_d" value="D" v-model="checkedLicenseNames">
                                            <label class="form-check-label" for="driving_license_d">D</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="driving_license_e" value="E" v-model="checkedLicenseNames">
                                            <label class="form-check-label" for="driving_license_e">E</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="col-lg-12 col-md-12 mt-4">
                                    <div class="text-left">
                                        <button type="" class="site-button" >{{ (candidateID == null)?'შენახვა':'შეინახე ცვლილება' }}</button>
                                    </div>
                                </div> -->
                            </div>
                        <!-- </form> -->
                    </div>
                </div>



                <!--სამედიცინო ინფორმაცია-->
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_medical_info') }}</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">
                        <!-- <form @submit.prevent="addMedicalInfo()" > -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_medical_alergy') }}</label>
                                        <div class="ls-inputicon-box">
                                            <select class="wt-select-box selectpicker" v-model="m.candidateAllergies"  data-live-search="true" title=""  data-bv-field="size" multiple>
                                                <option v-for="allergy in data.classificator.allergies " :value="allergy.id">{{ allergy[`name_${getLang}`] }}</option>
                                            </select>
                                            <i class="fs-input-icon fa fa-allergies"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_medical_operation') }}</label>
                                        <textarea class="form-control" rows="3" v-model="m.candidate.medical_info" :placeholder="$t('lang.user_profile_page_medical_please_info')"></textarea>
                                    </div>
                                </div>

                                <!-- <div class="col-lg-12 col-md-12 mt-4">
                                    <div class="text-left">
                                        <button type="" class="site-button" >{{ (candidateAllergyArr.length > 0 || candidate.medical_info)? "შეინახე ცვლილება":'შენახვა' }}</button>
                                    </div>
                                </div> -->
                            </div>
                        <!-- </form> -->
                    </div>
                </div>

                 <!--უცხო ენები-->
                 <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_foreign_lang_title') }}</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_foreign_lang_language') }}</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker"  v-model="languages.id"  data-live-search="true" title=""  data-bv-field="size">
                                            <option v-for="language in data.classificator.languages " :value="language">{{ language[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-language"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_foreign_lang_level') }}</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="languageLevels.id"   data-live-search="false" title=""  data-bv-field="size">
                                            <option v-for="languageLevel in data.classificator.languageLevels " :value="languageLevel">{{ languageLevel[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-level-up-alt"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="text-right ">
                                    <button class="btn btn-success"
                                    @click="addLanguage(languages.id, languageLevels.id)"
                                    title="დამატება" data-bs-toggle="tooltip"
                                    data-bs-placement="top">{{ $t('lang.user_profile_page_foreign_lang_button_add_info') }}
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                                <!-- <div class="text-right  ">
                                    <button type="submit" class="site-button">დამატება</button>
                                </div> -->
                            </div>
                            <div v-if="m.candidateLanguages.length != 0" :class="languageTableClass">
                                <!-- <miniTable :key="tableType" :tableType="tableType" :tableRow="tableRow" :tableData="candidateLanguage" @messageFromChild="childMessage"></miniTable> -->
                                <div class="panel-body wt-panel-body">
                                    <div class="p-a20 table-responsive">
                                        <table class="table twm-table table-striped table-borderless">
                                            <thead>
                                                <tr>
                                                <th>N</th>
                                                <th>ენა</th>
                                                <th>დონე</th>
                                                <th>actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <!--1-->
                                                <tr v-for="(item, index) in m.candidateLanguages">
                                                <td>{{ index + 1 }}</td>
                                                <td>{{ item.language[`name_${getLang}`] }}</td>
                                                <td>{{ item.level[`name_${getLang}`] }}</td>
                                                <td>
                                                    <button @click="removeRow('language', index)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-12 col-md-12 mt-4">
                                    <div class="text-left">
                                        <button type="" class="site-button" @click="addLanguageInfo()" >{{ (candidateLanguageArr.length > 0)? "შეინახე ცვლილება":'შენახვა' }}</button>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <!--ზოგადი სამუშაო გამოცდილება-->
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_work_exp_title') }}</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>გაქვთ თუ არა სამუშაო გამოცდილება?</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="m.candidateWorkExperience.experience"  data-live-search="false" title=""  data-bv-field="size">
                                            <option :value="1">კი</option>
                                            <option :value="0">არა</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-smoking"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12" :class="(m.candidateWorkExperience.experience == 2)?'':'visually-hidden'">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_work_exp') }}</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker"  v-model="m.candidateWorkExperience.work_experience_id"  data-live-search="true" title=""  data-bv-field="size">
                                            <option v-for="workExperience in data.classificator.workExperiences " :value="workExperience">{{ workExperience[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-history"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="m.candidateWorkExperience.experience == 1" class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_work_position') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.candidateWorkExperience.position" type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-tasks"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="m.candidateWorkExperience.experience == 1" class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_work_object') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.candidateWorkExperience.object" type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-map-marker"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="m.candidateWorkExperience.experience == 1" class="col-lg-12 col-md-12">
                                <div class="text-right ">
                                    <button class="btn btn-success"
                                    @click="addCandidateWorkExperience(m.candidateWorkExperience.work_experience_id, m.candidateWorkExperience.position, candidateWorkExperience.object)"
                                    title="დამატება" data-bs-toggle="tooltip" data-bs-placement="top">{{ $t('lang.user_profile_page_work_button_add_info') }}
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                            </div>
                            <!-- <div v-if="candidateExperience.length != 0" :class="ExperienceTableClass">

                                <div class="panel-body wt-panel-body">
                                    <div class="p-a20 table-responsive">
                                        <table class="table twm-table table-striped table-borderless">
                                            <thead>
                                                <tr>
                                                <th>N</th>
                                                <th>გამოცდილება</th>
                                                <th>პოზიცია</th>
                                                <th>ობიექტი</th>
                                                <th>actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(item, index) in candidateExperienceArr">
                                                <td>{{ index + 1 }}</td>
                                                <td>{{ item.experience[`name_${getLang}`] }}</td>
                                                <td>{{ item.position }}</td>
                                                <td>{{ item.object }}</td>
                                                <td>
                                                    <button @click="removeRow('experience',index)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> -->

                            <div class="col-xl-6 col-lg-6 col-md-12" :class="(m.candidateWorkExperience.experience == 0)?'':'visually-hidden'">
                                <div class="form-group">
                                    <label>სამუშაო გამოცდილების არ ქონის მიზეზი</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker"  v-model="m.candidateWorkExperience.no_reason_id"  data-live-search="true" title=""  data-bv-field="size">
                                            <option v-for="workExperience in workExperiences " :value="workExperience">{{ workExperience[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-history"></i>
                                    </div>
                                </div>
                            </div>
                             <div :class="(m.candidateWorkExperience.experience == 0)?'':'visually-hidden'" class="col-md-12">
                                <div class="form-group">
                                    <label>დამატაბითი ინფორმაცია</label>
                                    <textarea class="form-control" rows="3" v-model="m.candidate.no_reason_info" :placeholder="$t('lang.user_profile_page_medical_please_info')"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--რეკომენდაცია-->
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_recomendation_title') }}</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_recomendation_from') }}</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker"  v-model="m.candidateRecommendation.recommendation"  data-live-search="false" title=""  data-bv-field="size">
                                            <!-- <option v-for="recommendation in recommendations " :value="recommendation.id">{{ recommendation[`name_${getLang}`] }}</option> -->
                                        </select>
                                        <i class="fs-input-icon fa fa-thumbs-up"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 " :class="(m.candidateRecommendation.recommendation == 2 || m.candidateRecommendation.recommendation == 3)?'':'visually-hidden'" >
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_recomendation_where_from') }}</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker"  v-model="m.candidateRecommendation.recommendation_from_whom_id"  data-live-search="false" title=""  data-bv-field="size">
                                            <option v-for="recommendationFrom in data.classificator.recommendationFromWhom " :value="recommendationFrom.id">{{ recommendationFrom[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-industry"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="m.candidateRecommendation.recommendation == 2 " class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_recomendation_name') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.candidateRecommendation.name" type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="m.candidateRecommendation.recommendation == 2 " class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>თანამდებობა</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.candidateRecommendation.position" type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="m.candidateRecommendation.recommendation == 2" class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_recomendation_number') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.candidateRecommendation.number" type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-phone"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="m.candidateRecommendation.recommendation == 3" class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>ფაილი</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" ref="upload" type="file" @change="recommendationFileUpload" placeholder="">
                                        <i class="fs-input-icon fa fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-lg-12 col-md-12">
                                <div class="text-right ">
                                    <button class="btn btn-success"
                                    @click="addCandidateWorkExperience(candidateWorkExperience.work_experience_id, candidateWorkExperience.position, candidateWorkExperience.object)"
                                    title="დამატება" data-bs-toggle="tooltip" data-bs-placement="top">დამატება
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                            </div> -->
                            <!--  -->
                        </div>
                    </div>
                </div>

                <!--Additional information-->
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_additional_title') }}</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group city-outer-bx has-feedback">
                                    <label>{{ $t('lang.user_profile_page_additional_height') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.candidate.height" type="text" placeholder="65K">
                                        <i class="fs-input-icon fa fa-arrows-alt-v" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group city-outer-bx has-feedback">
                                    <label>{{ $t('lang.user_profile_page_additional_weight') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.candidate.weight" type="text" placeholder="75K">
                                        <i class="fs-input-icon fa fa-arrows-alt-h"></i>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_additional_conviction') }}</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="m.candidate.convection"  data-live-search="false" title=""  data-bv-field="size">
                                            <option :value="1">კი</option>
                                            <option :value="0">არა</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-gavel"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_additional_smoke') }}</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="m.candidate.smoke"  data-live-search="false" title=""  data-bv-field="size">
                                            <option :value="1">კი</option>
                                            <option :value="0">არა</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-smoking"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_additional_work_abroad') }}</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="m.candidate.work_abroad"  data-live-search="false" title=""  data-bv-field="size">
                                            <option :value="1">კი</option>
                                            <option :value="0">არა</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-globe-europe"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                 <!--ცნობები-->
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_references_title') }}</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_references_name_notice') }}</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="m.candidateNotices.notice_id"  data-live-search="true" title=""  data-bv-field="size">
                                            <option v-for="notice in data.classificator.notices " :value="notice.id">{{ notice[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-sticky-note"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_references_file') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" type="file" @change="noticeFileUpload"  :placeholder="$t('lang.user_profile_page_medical_please_info')">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="text-right ">
                                    <button class="btn btn-success"
                                    @click="addNotice(candidateNotices.notice_id,)"
                                    title="დამატება" data-bs-toggle="tooltip" data-bs-placement="top">{{ $t('lang.user_profile_page_references_button_add_info') }}
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                            </div>
                            <!-- <div v-if="candidateNoticeArr.lenght != 0" :class="noticeTableClass">
                                <div class="panel-body wt-panel-body">
                                    <div class="p-a20 table-responsive">
                                        <table class="table twm-table table-striped table-borderless">
                                            <thead>
                                                <tr>
                                                <th>N</th>
                                                <th>ცნობა</th>
                                                <th>ფაილი</th>
                                                <th>actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(item, index) in candidateNoticeArr">
                                                <td>{{ index + 1 }}</td>
                                                <td>{{ item.notice }}</td>
                                                <td>{{ item.file.name }}</td>
                                                <td>
                                                    <button @click="removeRow('notice',index)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> -->

                        </div>
                    </div>
                </div>

                <!--Social Network-->
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_social_title') }}</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">

                        <div class="row">

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_social_facebook') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control wt-form-control" name="company_name" type="text" placeholder="https://www.youtube.com/">
                                        <i class="fs-input-icon fab fa-facebook-f"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_social_youtube') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control wt-form-control" name="company_name" type="text" placeholder="https://www.youtube.com/">
                                        <i class="fs-input-icon fab fa-youtube"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="text-left">
                                    <button type="submit" @click.prevent="addCandidate()"  class="site-button">{{ $t('lang.user_profile_page_social_button_save') }}</button>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div>
</template>

<script>
import { I18n } from 'laravel-vue-i18n'
import miniTable from './miniTable.vue'
import _ from 'lodash'
export default {
    components:{
        miniTable
    },
    props:{
        data:Object
    },
    data() {
        return {
            m: null,
            languages: {},
            languageLevels: {},
            formData:new FormData(),
            drivingLicenseCategory:['A', 'B', 'C', 'D','E'],
            checkedLicenseNames:[],
            candidateFullData: {},

            //v-model
            language_id: null,
            language_level_id: null,


            //table component
            //file
            noticeFile: {},
            recommendationFile: {},

            //candidateID:
            candidate_id: null,

            // experienceCheck:null

        }
    },
    created(){

        this.m = { ...this.data.candidate, ...this.data.basic };

        console.log('this.m.candidateCitizenships',this.m.candidateWorkExperience);
        console.log("this.m ", this.m);

    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
        languageTableClass(){
            return (this.m.candidateLanguages.length > 0 )?'col-lg-12 col-md-12':'col-lg-12 col-md-12 visually-hidden'
        },
        ExperienceTableClass(){
            return (this.candidateExperienceArr.length > 0 )?'col-lg-12 col-md-12':'col-lg-12 col-md-12 visually-hidden'
        },
        noticeTableClass(){
            return (this.candidateNoticeArr.length > 0 )?'col-lg-12 col-md-12':'col-lg-12 col-md-12 visually-hidden'
        },
        candidateID(){
            if (Object.keys(this.candidate).length != 0) {
                return this.candidate.id
            }else{
                return this.candidate_id
            }
        }
    },
    methods:{
        authUpdate(){
            console.log(this.auth);
            axios({
                method: "post",
                url: "/profile_update",
                data: this.auth
            })
            .then(function (response) {
                // handle success
                console.log(response.data);

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })

        },
        addCandidate(){
            console.log('cthis.m',this.m);
            axios({
                method: "post",
                url: "/add_candidate",
                data: this.m
            })
            .then(function (response) {
                // handle success
                console.log(response.data);
                this.formData.append('file', this.recommendationFile)
                this.formData.append('candidate_id', response.data)
                axios({
                    method: "post",
                    url: "/add_candidate_file",
                    data: candidateFullData
                })
                .then(function (response) {
                    // handle success
                    console.log(response.data);


                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        recommendationFileUpload(event){
            this.recommendationFile = event.target.files[0]
        },
        noticeFileUpload(event){
            this.noticeFile = event.target.files[0]
        },


        upsert(array, data, keyName) {
            try {
                console.log('array', array);
                console.log('data', data);
                const i = array.findIndex(_element => _element[keyName].id === data[keyName].id);
                console.log('i', i);
                if (i > -1) array[i] = { ...data }; // (2)
                else array.push(data);
            } catch (e) {
                console.log("e", e)
                array.splice(0, array.length)
                array.push(data);
                console.log("upsert array", array)
            }
        },

        addLanguage(language, level){
            console.log('language', language);
            console.log('level', level);

            this.upsert(this.m.candidateLanguages, {
                'language': language,
                'level': level,
            }, "language");

            console.log('this.candidateLanguageArr', this.m.candidateLanguages);
        },
        addCandidateWorkExperience(workExperience_id, position, object){

            var tableData = {
                'experience': workExperience_id,
                'position': position,
                'object': object,
            }
            this.candidateExperienceArr.push(tableData)
            console.log('this.candidateExperienceArr', this.candidateExperienceArr);
        },
        addNotice(notice_id){
            var noticeObj =  _.find(this.notices, function(o) { return o.id ==  notice_id; });
            var tableData = {
                'notice':noticeObj[`name_${this.getLang}`],
                'file': this.noticeFile,
            }
            this.candidateNoticeArr.push(tableData)
        },
        removeRow(type, index){
            if (type == 'language') {
                const removed = this.candidateLanguageArr.splice(index, 1);
            }else if(type == 'experience'){
                const removed = this.candidateExperienceArr.splice(index, 1);
            }else if(type == 'notice'){
                const removed = this.candidateNoticeArr.splice(index, 1)
            }

        },
    },
    watch:{
        // experienceCheck:{
        //     handler(newValue, oldValue) {
        //         if (newValue == 0 ) {
        //             this.$swal(
        //                 {
        //                     title: '<p>შეგახსენებთ რომ დამსაქმებელთა უმეტესობისთვის პრიორიტეტია სამუშაო გამოცდილების ქონა</p>',
        //                     icon: 'info',
        //                     html:
        //                         'თუმცა თქვენ შეგიძლიათ დამსაქმებელს აუხსნათ თუ რატომ არ გაქვთ გამოცდილება',
        //                     showCloseButton: true,
        //                     showCancelButton: false,
        //                     focusConfirm: false,
        //                 }
        //             );
        //         }
        //     }
        // }
    },

    mounted(){
        console.log('this.candidateRecommendation', this.data.candidateRecommendation);

console.log('this.data.candidateCitizenships', this.data.candidateCitizenships);
        if (Array.isArray(this.data.candidateCitizenships)) {
            ''
        }
        // if (Object.values(this.data.candidateCitizenships).length != 0 ) {
        //     console.log('this.data.candidateCitizenships', this.data.candidateCitizenships);
        //     this.data.candidateCitizenships.forEach(element => {
        //         this.candidateCitizenshipArr.push(element.citizenship_id)
        //     });
        // }
        // if (Object.keys(this.data.candidateProfessions).length != 0 ) {
        //     this.data.candidateProfessions.forEach(element => {
        //         this.candidateProfessionArr.push(element.profession_id)
        //     });
        // }
        // if (Object.keys(this.data.candidateAllergies).length != 0 ) {
        //     this.data.candidateAllergies.forEach(element => {
        //         this.candidateAllergyArr.push(element.allergy_id)
        //     });
        // }
        // if (Object.keys(this.data.candidateLanguages).length != 0 ) {
        //     console.log('this.data.candidateLanguages', this.data.candidateLanguages);
        //     this.data.candidateLanguages.forEach(element => {
        //         var language =  _.find(this.languages, function(o)  { return o.id ==  element.language_id; });
        //         var level = _.find(this.languageLevels, function(o)  { return o.id ==  element.language_level_id; });
        //         var tableData = {
        //             'language': language,
        //             'level': level
        //         }
        //         this.candidateLanguageArr.push(tableData)
        //     });
        // }
        // var obj = this.candidate.reduce(function(acc, cur, i) {
        //     acc[i] = cur;
        //     return acc;
        // }, {});
        // console.log('obj', obj);
console.log(this.candidate);

    }
}
</script>
<style lang="">
</style>
