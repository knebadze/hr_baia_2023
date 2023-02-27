<template lang="">
    <div class="col-xl-9 col-lg-8 col-md-12 m-b30">
        <!--Filter Short By-->
        <div class="twm-right-section-panel site-bg-gray">
            <!-- <form> -->


                <mainInfo :data="m.auth" :genderCLA="data.classificator.gender"></mainInfo>

            <!-- <form @submit.prevent="addCandidate()"> -->
                 <!--personal information-->
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_input_basic_info') }}</h4>
                        <!-- $t('lang.user_profile_page_personal_info') -->
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">
                        <!-- <form @submit.prevent="addPersonalInfo()"> -->
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_personal_number') }}</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.candidate.personal_number" type="text" placeholder=""  @blur="v$.m.candidate.personal_number.$touch">
                                            <i class="fs-input-icon fa fa-user"></i>
                                            <span v-if="v$.m.candidate.personal_number.required.$invalid && v$.m.candidate.personal_number.$dirty" style='color:red'>* {{ v$.m.candidate.personal_number.required.$message}}</span>
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
                                        <label>{{ 'ზოგადი მახასიათებელი' }}</label>
                                        <div class="ls-inputicon-box">
                                            <select class="wt-select-box selectpicker" v-model="m.candidateCharacteristic"  data-live-search="true" title=""  data-bv-field="size" multiple>
                                                <option v-for="item in data.classificator.characteristic " :value="item.id">{{ item[`name_${getLang}`] }}</option>
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
                                        <div v-for="category in data.classificator.drivingLicense" class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="driving_license_a" :value="category.id" v-model="m.candidateDrivingLicense" >
                                            <label class="form-check-label" for="driving_license_a">{{ category.name }}</label>
                                        </div>
                                        <!-- <div class="form-check form-check-inline">
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
                                        </div> -->
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
                                                <th>{{ $t('lang.user_profile_page_foreign_lang_language_lang') }}</th>
                                                <th>{{ $t('lang.user_profile_page_foreign_lang_language_level') }}</th>
                                                <th>{{ $t('lang.user_profile_page_foreign_lang_language_action') }}</th>
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
                                    <label>{{ $t('lang.user_profile_page_work_exp_experience') }}</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="candidateWorkExperienceModel.experience"  data-live-search="false" title=""  data-bv-field="size" @blur="v$.candidateWorkExperienceModel.experience.$touch">
                                            <option :value="1">კი</option>
                                            <option :value="2">არა</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-star"></i>
                                        <!-- <span v-if="v$.candidateWorkExperienceModel.experience.required.$invalid && v$.candidateWorkExperienceModel.experience.$dirty" style='color:red'>* {{ v$.candidateWorkExperienceModel.experience.required.$message}}</span> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12" :class="(candidateWorkExperienceModel.experience ==1)?'':'visually-hidden'">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_work_exp') }}</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker"  v-model="candidateWorkExperienceModel.work_experience_id"  data-live-search="true" title=""  data-bv-field="size">
                                            <option v-for="workExperience in data.classificator.workExperiences " :value="workExperience.id">{{ workExperience[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-history"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidateWorkExperienceModel.experience == 1" class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_work_position') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="candidateWorkExperienceModel.position" type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-tasks"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidateWorkExperienceModel.experience == 1" class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_work_object') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="candidateWorkExperienceModel.object" type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-map-marker"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12" :class="(candidateWorkExperienceModel.experience == 2)?'':'visually-hidden'">
                                <div class="form-group">
                                    <label>სამუშაო გამოცდილების არ ქონის მიზეზი</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker"  v-model="candidateWorkExperienceModel.no_reason_id"  data-live-search="true" title=""  data-bv-field="size">
                                            <option v-for="workExperience in data.classificator.noExperienceReason" :value="workExperience.id">{{ workExperience[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-history"></i>
                                    </div>
                                </div>
                            </div>
                             <div :class="(candidateWorkExperienceModel.experience == 2)?'':'visually-hidden'" class="col-md-12">
                                <div class="form-group">
                                    <label>დამატაბითი ინფორმაცია</label>
                                    <textarea class="form-control" rows="3" v-model="candidateWorkExperienceModel.no_reason_info" :placeholder="$t('lang.user_profile_page_medical_please_info')"></textarea>
                                </div>
                            </div>
                            <div v-if="candidateWorkExperienceModel.experience == 1" class="col-lg-12 col-md-12">
                                <div class="text-right ">
                                    <button class="btn btn-success"
                                    @click="addCandidateWorkExperience(candidateWorkExperienceModel)"
                                    title="დამატება" data-bs-toggle="tooltip" data-bs-placement="top">{{ $t('lang.user_profile_page_work_button_add_info') }}
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                            </div>

                            <div v-if="m.candidateWorkExperience.length != 0 && m.candidateWorkExperience[0].experience == 1" class="col-lg-12 col-md-12">

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
                                                <tr v-for="(item, index) in m.candidateWorkExperience">
                                                <td>{{ index + 1 }}</td>
                                                <td>{{ (item.work_experience)?item.work_experience[`name_${getLang}`]:'' }}</td>
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
                            </div>


                        </div>
                    </div>
                </div>

                <!--რეკომენდაცია-->
                <!-- <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_recomendation_title') }}</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_recomendation_from') }}</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker"  v-model="candidateRecommendationModel.recommendation"  data-live-search="false" title=""  data-bv-field="size">
                                            <option :value="1">წარმოვადგენ</option>
                                            <option :value="2">ვერ წარმოვადგენ</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-thumbs-up"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 " :class="(candidateRecommendationModel.recommendation == 1)?'':'visually-hidden'" >
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_recomendation_where_from') }}</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker"  v-model="candidateRecommendationModel.recommendation_from_whom_id"  data-live-search="false" title=""  data-bv-field="size">
                                            <option v-for="recommendationFrom in data.classificator.recommendationFromWhom " :value="recommendationFrom.id">{{ recommendationFrom[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-industry"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidateRecommendationModel.recommendation == 1 " class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_recomendation_name') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="candidateRecommendationModel.name" type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidateRecommendationModel.recommendation_from_whom_id == 2 " class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>თანამდებობა</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="candidateRecommendationModel.position" type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidateRecommendationModel.recommendation == 1" class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_recomendation_number') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="candidateRecommendationModel.number" type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-phone"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidateRecommendationModel.recommendation == 1" class="col-lg-12 col-md-12">
                                <p>----------------------ან ატვირთეთ ფაილი-------------------------</p>
                            </div>
                            <div v-if="candidateRecommendationModel.recommendation == 1" class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>ფაილი</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" ref="upload" type="file" @change="recommendationFileUpload" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12" :class="(candidateRecommendationModel.recommendation == 2)?'':'visually-hidden'">
                                <div class="form-group">
                                    <label>რეცომდაციის არ ქონის მიზეზი</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker"  v-model="candidateRecommendationModel.no_reason_id"  data-live-search="true" title=""  data-bv-field="size">
                                            <option v-for="recommendation in data.classificator.noRecommendationReason" :value="recommendation.id">{{ recommendation[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-history"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidateRecommendationModel.recommendation == 2" class="col-md-12">
                                <div class="form-group">
                                    <label>დამატაბითი ინფორმაცია</label>
                                    <textarea class="form-control" rows="3" v-model="candidateRecommendationModel.no_reason_info" :placeholder="$t('lang.user_profile_page_medical_please_info')"></textarea>
                                </div>
                            </div>
                            <div v-if="candidateRecommendationModel.recommendation == 1" class="col-lg-12 col-md-12">
                                <div class="text-right ">
                                    <button class="btn btn-success"
                                    @click="addCandidateRecommendation(candidateRecommendationModel)"
                                    title="დამატება" data-bs-toggle="tooltip" data-bs-placement="top">დამატება
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                            </div>
                            <div  class="col-lg-12 col-md-12">
                                <div class="panel-body wt-panel-body">
                                    <div class="p-a20 table-responsive">
                                        <table class="table twm-table table-striped table-borderless">
                                            <thead>
                                                <tr>
                                                <th>N</th>
                                                <th>საიდან?</th>
                                                <th>სახელი გვარი</th>
                                                <th>ნომერი</th>
                                                <th>თანამდებობა</th>
                                                <th>ფაილი</th>
                                                <th>action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(item, index) in m.candidateRecommendation">
                                                <td>{{ index + 1 }}</td>
                                                <td><span :class="(item.recommendation_from_whom_id == 1)?'badge bg-success p-2':'badge bg-info text-dark p-2'">{{ item.recommendation_whom[`name_${getLang}`] }}</span></td>
                                                <td>{{ item.name }}</td>
                                                <td>{{ item.number }}</td>
                                                <td>{{ item.position }}</td>
                                                <td>{{ item.file }}</td>
                                                <td>
                                                    <button @click="removeRow('recommendation',index)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div> -->

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

                 <!--დამატებითი ნომრები-->
                 <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">{{ 'დამატებითი ნომრები' }}</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ 'ნომერი' }}</label>
                                    <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span :class="`fi fi-${numberCode.iso.toLowerCase()}`"></span>+{{ numberCode.phonecode }}</button>
                                    <ul class="dropdown-menu" style=" overflow: hidden; overflow-y: auto; max-height: calc(100vh - 550px);">
                                        <li v-for="item in data.classificator.numberCode" @click="chooseNumberCode(item.phonecode, item.iso.toLowerCase())"><a class="dropdown-item"><span :class="`fi fi-${item.iso.toLowerCase()}`"></span>+{{ item.phonecode }}</a></li>
                                    </ul>
                                    <input type="text" class="form-control" aria-label="Text input with dropdown button" v-model="candidateNumberModel.number" placeholder="555666777">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ 'მფლობელი' }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="candidateNumberModel.owner" type="text" placeholder="სახელი გვარი">
                                        <i class="fs-input-icon fa fa-arrows-alt-v" aria-hidden="true"></i>
                                    </div>

                                </div>
                            </div>
                            <!-- <input type="text" hidden v-model="candidateNumberModel.number_code_id"> -->
                            <div class="col-lg-12 col-md-12">
                                <div class="text-right ">
                                    <button class="btn btn-success"
                                    @click="addNumber(numberCode, candidateNumberModel)"
                                    title="დამატება" data-bs-toggle="tooltip"
                                    data-bs-placement="top">{{ $t('lang.user_profile_page_foreign_lang_button_add_info') }}
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                                <!-- <div class="text-right  ">
                                    <button type="submit" class="site-button">დამატება</button>
                                </div> -->
                            </div>
                            <div v-if="m.candidateNumber.length != 0" class="col-lg-12 col-md-12">
                                <div class="panel-body wt-panel-body">
                                    <div class="p-a20 table-responsive">
                                        <table class="table twm-table table-striped table-borderless">
                                            <thead>
                                                <tr>
                                                <th>N</th>
                                                <th>კოდი</th>
                                                <th>ნომერი</th>
                                                <th>მფლობელი</th>
                                                <th>actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <!--1-->
                                                <tr v-for="(item, index) in m.candidateNumber">
                                                <td>{{ index + 1 }}</td>
                                                <td>+{{ item.number_code.phonecode }}</td>
                                                <td>{{ item.number }}</td>
                                                <td>{{ item.owner }}</td>
                                                <td>
                                                    <button @click="removeRow('number', index)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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
                                    <select class="wt-select-box selectpicker" v-model="candidateNoticeModel.notice_id"  data-live-search="true" title=""  data-bv-field="size">
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
                                @click="addNotice(candidateNoticeModel)"
                                title="დამატება" data-bs-toggle="tooltip" data-bs-placement="top">{{ $t('lang.user_profile_page_references_button_add_info') }}
                                    <span class="fa fa-plus"></span>
                                </button>
                            </div>
                        </div>
                        <div v-if="m.candidateNotices.length != 0" class="col-lg-12 col-md-12">
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
                                            <tr v-for="(item, index) in m.candidateNotices">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ item.notice[`name_${getLang}`] }}</td>
                                            <td> <a v-on:click="showFile(item.file)">{{ item.file }}</a> </td>
                                            <td>
                                                <button @click="removeRow('notice', index)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                    <i class="fa fa-trash-alt"></i>
                                                </button>
                                            </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="text-left">
                                <button type="submit" @click.prevent="uploadNotice()"  class="site-button">{{ $t('lang.user_profile_page_social_button_save') }}</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import mainInfo from './mainInfo.vue'
import { I18n } from 'laravel-vue-i18n'
import miniTable from './miniTable.vue'
import _ from 'lodash'
import { useVuelidate } from '@vuelidate/core'
import { required, email, helpers, requiredIf, numeric, maxLength } from '@vuelidate/validators'


export default {
    setup () {
        return { v$: useVuelidate() }
    },
    components:{
        miniTable,
        mainInfo
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
            candidateWorkExperienceModel: {
                experience:'',
                work_experience_id :'',
                position:'',
                object:'',
                no_reason_id:'',
                no_reason_info:'',
            },
            // candidateRecommendationModel: {
            //     recommendation: '',
            //     recommendation_from_whom_id :'',
            //     name:'',
            //     position:'',
            //     number:'',
            //     no_reason_id:'',
            //     no_reason_info:'',
            // }
            candidateNoticeModel:{
                'notice_id':'',
                'notice':'',
                'file':'',
            },
            imgSrc:'',
            noticeFileInfo:[],
            numberCode: {
                phonecode: 995,
                iso:'ge'
            },
            candidateNumberModel:{
                'number_code_id':'',
                'number':'',
                'owner':'',
            },
            candidate_id: null,

        }
    },
    validations () {
        const validations = {
            m:{
                auth:{
                    number: {
                        required: helpers.withMessage('ნომრის შევსება სავალდებულოა', required ),
                        numeric: helpers.withMessage('ნომრი უნდა შედგებოდეს მხოლოდ ციფრებისგან', numeric ),
                        maxLength: helpers.withMessage('ნომრი უნდა შედგებოდეს 9 ციფრებისგან', maxLength(9) )
                    },
                    gender_id: {required: helpers.withMessage('სქესის არჩევა სავალდებულოა', required )},
                    date_of_birth: {required: helpers.withMessage('დაბადების თარიღის შევსება სავალდებულოა', required )}

                },
                candidate:{
                    personal_number: { required: helpers.withMessage('პირადი ნომრის შევსება სავალდებულოა', required)},
                },

            },
            candidateWorkExperienceModel:{
                // experience: { required: helpers.withMessage('სამუშაო გამოცდილების შესახებ ინფორმაციის შევსება სავალდებულოა', required)},
            }
        }
        return validations
    },
    created(){
        this.m = { ...this.data.candidate, ...this.data.basic };
        console.log('this.m.', this.m);
        console.log('m.candidateNotices',this.m.candidateNotices);
        // this.candidateWorkExperienceModel = this.initWorkExperience([...this.m.candidateWorkExperience]);

        // this.candidateDrivingLicense
        if(this.m.candidateDrivingLicense.length > 0){
            var arr = []
            this.m.candidateDrivingLicense.forEach(element => {
                arr.push(element.driving_license_id)
            });
            this.m.candidateDrivingLicense = arr
        }


    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
        languageTableClass(){
            return (this.m.candidateLanguages.length > 0 )?'col-lg-12 col-md-12':'col-lg-12 col-md-12 visually-hidden'
        },
        candidateID(){
            if (this.m.candidate != '') {
                return this.m.candidate.id
            }else if(this.candidate_id != null){
                return this.candidate_id
            }
        },
    },
    methods:{

        initWorkExperience (arr) {
            let k = arr.reduce(function (acc, obj, i) {
                if(i == 0) {

                    let j = Object.keys(obj).reduce(function (previous, key) {
                        previous[key] = "";
                        return previous;
                    }, {});

                    acc[0] = j;
                }
                return acc;
            }, []);
            arr.splice(0, arr.length);
            return k[0];
        },

        clearObject (obj) {
            let clear =  Object.keys(obj).reduce(function (previous, key) {
                previous[key] = "";
                return previous;
            }, {});

            Object.assign(obj, clear)

            return obj;
        },


        async addCandidate(){
            const isFormCorrect = await this.v$.$validate()
            // alert('Form failed validation')
            if (!isFormCorrect) return;
            if (this.candidateWorkExperienceModel.experience == 2) {
                this.m['candidateWorkExperienceModel'] = this.candidateWorkExperienceModel
            }
            let currentObj = this;
            console.log('currentObj',currentObj);
            axios({
                method: "post",
                url: "/add_candidate",
                data: this.m,

            })
            .then(function (response) {
                console.log('this.noticeFile',currentObj);
                // handle success
                console.log(response.data);
                if (response.data.status == 200) {
                    currentObj.candidate_id = response.data.data;
                    toast.success("ინფორმაცია წარმატებით შეინახა", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    // alert()

                }


            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        uploadNotice(){
            let currentObj = this;
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            let formData = new FormData();
            console.log('currentObj.noticeFileInfo', currentObj.noticeFileInfo);
            for( var i = 0; i < currentObj.noticeFileInfo.length; i++ ){
                let file = currentObj.noticeFileInfo[i][1];
                formData.append('file_'+ currentObj.noticeFileInfo[i][0] , file);
            }
            formData.append('candidate_id', this.candidateID);

            // send upload request
            axios.post('/add_candidate_file', formData, config)
            .then(function (response) {
                console.log('response',response);
                if (response.data.status == 200) {
                    toast.success("ცნობები წარმატებით დაემატა", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                }
            })
            .catch(function (error) {
                console.log('error',error);
            // currentObj.output = error;
            });
        },
        // recommendationFileUpload(event){
        //     this.recommendationFile = event.target.files[0]
        // },
        noticeFileUpload(event){
            this.noticeFile = event.target.files[0]
            var arr = [this.candidateNoticeModel.notice_id, event.target.files[0]]
            this.noticeFileInfo.push(arr)
        },



        upsert(array, data, keyName) {
            try {
                const i = array.findIndex(_element => _element[keyName].id === data[keyName].id);
                if (i > -1) array[i] = { ...data }; // (2)
                else array.push(JSON.parse(JSON.stringify(data)));
            } catch (e) {
                array.splice(0, array.length)
                array.push(data);
            }
        },

        addLanguage(language, level){
            this.upsert(this.m.candidateLanguages, {
                'language': language,
                'level': level,
            }, "language");
        },
        addCandidateWorkExperience(workExperience){
            var workExperienceFind = _.find(this.data.classificator.workExperiences, function(o) { return o.id == workExperience.work_experience_id; });
            workExperience['work_experience'] = workExperienceFind;
            this.m.candidateWorkExperience.push(JSON.parse(JSON.stringify(workExperience)))
        },
        addNotice(notice){
            var noticeFind = _.find(this.data.classificator.notices, function(o) { return o.id == notice.notice_id; });
            notice['notice'] = noticeFind;
            notice['file'] = this.noticeFile.name
            this.upsert(this.m.candidateNotices, notice, "notice");
        },
        // addCandidateRecommendation(recommendation){
        //     recommendation['file'] = this.recommendationFile.name
        //     var recomendationWhomFind = _.find(this.data.classificator.recommendationFromWhom, function(o) { return o.id == recommendation.recommendation_from_whom_id; });
        //     recommendation['recommendation_whom'] = recomendationWhomFind;
        //     console.log('recommendation', recommendation);

        //     console.log('this.m.candidateRecommendation_1', this.m.candidateRecommendation);
        //     this.m.candidateRecommendation.push(JSON.parse(JSON.stringify(recommendation)))
        //     console.log('this.m.candidateRecommendation_2', this.m.candidateRecommendation);
        // },
        chooseNumberCode(code, iso){
            this.numberCode['phonecode'] = code;
            this.numberCode['iso'] = iso
        },
        addNumber(code, model){
            var numberCodeId = _.find(this.data.classificator.numberCode, function(o) { return o.phonecode == code.phonecode; });
            model['number_code_id'] = numberCodeId.id
            model['number_code'] = code
            this.m.candidateNumber.push(JSON.parse(JSON.stringify(model)))
        },
        removeRow(type, index){
            if (type == 'language') {
                const removed = this.candidateLanguageArr.splice(index, 1);
            }else if(type == 'experience'){
                const removed = this.m.candidateWorkExperience.splice(index, 1);
            }else if(type == 'notice'){
                const removed = this.m.candidateNotices.splice(index, 1)
            }
            else if( type == 'number'){
                const removed = this.m.candidateNumber.splice(index, 1)
            }

        },
        showFile(name){
            var pdf = `../../../public/user-documentation/${name}`;
            window.open(pdf);
        }
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
        // candidateWorkExperienceModel:{
        //     handler(newValue, oldValue){
        //         console.log('newValue', newValue);
        //         if (this.candidateWorkExperienceModel.experience == 2) {
        //             alert()
        //         }
        //     }
        // }
    },

    mounted(){
        if (this.m.candidateWorkExperience.length != 0 && this.m.candidateWorkExperience[0].experience == 2) {
            this.candidateWorkExperienceModel['experience'] = this.m.candidateWorkExperience[0].experience;
            this.candidateWorkExperienceModel['no_reason_id'] = this.m.candidateWorkExperience[0].no_reason_id;
            this.candidateWorkExperienceModel['no_reason_info'] = this.m.candidateWorkExperience[0].no_reason_info
        }
        // console.log('candidateID',this.candidateID);

        // if(this.m.candidateNotices.length != 0){
        //     this.m.candidateNotices.forEach(element => {
        //         var arr = [element.notice_id, event.target.files[0]]
        //         this.noticeFileInfo.push(arr)
        //     });
        // }

    }
}
</script>
<style lang="">
</style>
