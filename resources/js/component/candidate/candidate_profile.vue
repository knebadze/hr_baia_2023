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
                        <div class="row">

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_input_name') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="auth[`name_${getLang}`]"  type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-user "></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_input_phone') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control"  v-model="auth.number" type="text" >
                                        <i class="fs-input-icon fa fa-phone-alt"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_input_email') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control"  v-model="auth.email" type="email" placeholder="">
                                        <i class="fs-input-icon fas fa-at"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_input_birth_date') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control d" data-provide=""  type="date" v-model="auth.date_of_birth" placeholder="mm/dd/yyyy">
                                        <i class="fs-input-icon far fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <!--Gender-->
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_input_gender') }}</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="auth.gender_id"  data-live-search="true" title="" id="gender" data-bv-field="size">
                                            <option>Choose Gender</option>
                                            <option v-for="gender in this.gender " :value="gender.id">{{ gender[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-venus-mars"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- Driving License -->
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <label>{{ $t('lang.user_profile_page_driving_license') }}</label>
                                <div class="driving_license">
                                    <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="driving_license_a" value="license_a">
                                      <label class="form-check-label" for="driving_license_a">A</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="checkbox" id="driving_license_b" value="license_b">
                                      <label class="form-check-label" for="driving_license_b">B</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="checkbox" id="driving_license_c" value="license_c">
                                      <label class="form-check-label" for="driving_license_c">C</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="checkbox" id="driving_license_d" value="license_d">
                                      <label class="form-check-label" for="driving_license_d">D</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="checkbox" id="driving_license_e" value="license_e">
                                      <label class="form-check-label" for="driving_license_e">E</label>
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

            <form @submit.prevent="addCandidate()">
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
                                            <input class="form-control" v-model="candidate.personal_number" type="text" placeholder="">
                                            <i class="fs-input-icon fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_personal_nationality') }}</label>
                                        <div class="ls-inputicon-box">
                                            <select class="wt-select-box selectpicker" v-model="candidate.nationality_id"  data-live-search="true" title=""  data-bv-field="size">
                                                <option v-for="national in nationality " :value="national.id">{{ national[`name_${getLang}`] }}</option>
                                            </select>
                                            <i class="fs-input-icon fa fa-flag"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_personal_citizenship') }}</label>
                                        <div class="ls-inputicon-box">
                                            <select class="wt-select-box selectpicker" v-model="candidateCitizenshipArr"  data-live-search="true" title=""  data-bv-field="size" multiple>
                                                <option v-for="citizen in citizenship " :value="citizen.id" :selected="candidateCitizenships.citizenship_id == citizen.id">{{ citizen[`name_${getLang}`] }}</option>
                                            </select>
                                            <i class="fs-input-icon fa fa-user-plus"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_personal_religion') }}</label>
                                        <div class="ls-inputicon-box">
                                            <select class="wt-select-box selectpicker" v-model="candidate.religion_id"  data-live-search="true" title=""  data-bv-field="size">
                                                <option v-for="religion in religions " :value="religion.id">{{ religion[`name_${getLang}`] }}</option>
                                            </select>
                                            <i class="fs-input-icon fa fa-cross"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_personal_education') }}</label>
                                        <div class="ls-inputicon-box">
                                            <select class="wt-select-box selectpicker" v-model="candidate.education_id"  data-live-search="true" title=""  data-bv-field="size">
                                                <option v-for="education in educations " :value="education.id">{{ education[`name_${getLang}`] }}</option>
                                            </select>
                                            <i class="fs-input-icon fa fa-school"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_personal_profession') }}</label>
                                        <div class="ls-inputicon-box">
                                            <select class="wt-select-box selectpicker" v-model="candidateProfessionArr"  data-live-search="true" title=""  data-bv-field="size" multiple>
                                                <option v-for="profession in professions " :value="profession.id" :selected="candidateProfessions.profession_id == profession.id">{{ profession[`name_${getLang}`] }}</option>
                                            </select>
                                            <i class="fs-input-icon fa fa-graduation-cap"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_personal_specialty') }}</label>
                                        <div class="ls-inputicon-box">
                                            <select class="wt-select-box selectpicker" v-model="candidateSpecialtyArr"  data-live-search="true" title=""  data-bv-field="size" multiple>
                                                <option v-for="specialty in specialties " :value="specialty.id">{{ specialty[`name_${getLang}`] }}</option>
                                            </select>
                                            <i class="fs-input-icon fa fa-microscope"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_personal_family') }}</label>
                                        <div class="ls-inputicon-box">
                                            <select class="wt-select-box selectpicker" v-model="candidate.marital_status_id"  data-live-search="false" title=""  data-bv-field="size">
                                                <option v-for="marital in maritalStatus " :value="marital.id">{{ marital[`name_${getLang}`] }}</option>
                                            </select>
                                            <i class="fs-input-icon fa fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="candidate.marital_status_id && candidate.marital_status_id != 1 " class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_personal_children') }}</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="candidate.children" type="number" placeholder="">
                                            <i class="fs-input-icon fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="candidate.marital_status_id && candidate.marital_status_id != 1 && candidate.children && candidate.children != 0" class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_personal_children_age') }}</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="candidate.children_age" type="text" placeholder="მაგ: 10,14">
                                            <i class="fs-input-icon fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="candidate.marital_status_id && candidate.marital_status_id == 2 " class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_personal_spouse') }}</label>
                                        <textarea class="form-control" v-model="candidate.spouse" rows="3" placeholder="{{ $t('lang.user_profile_page_personal_family_fill_info') }}"></textarea>
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
                                            <select class="wt-select-box selectpicker" v-model="candidateAllergyArr"  data-live-search="true" title=""  data-bv-field="size">
                                                <option v-for="allergy in allergies " :value="allergy.id">{{ allergy[`name_${getLang}`] }}</option>
                                            </select>
                                            <i class="fs-input-icon fa fa-allergies"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_medical_operation') }}</label>
                                        <textarea class="form-control" rows="3" v-model="candidate.medical_info" placeholder="{{ $t('lang.user_profile_page_medical_please_info') }}"></textarea>
                                        <input class="form-control">
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
                                        <select class="wt-select-box selectpicker"  v-model="candidateLanguages.language_id"  data-live-search="true" title=""  data-bv-field="size">
                                            <option v-for="language in languages " :value="language.id">{{ language[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-language"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_foreign_lang_level') }}</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="candidateLanguages.language_level_id"   data-live-search="false" title=""  data-bv-field="size">
                                            <option v-for="languageLevel in languageLevels " :value="languageLevel.id">{{ languageLevel[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-level-up-alt"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="text-right ">
                                    <button class="btn btn-success"
                                    @click="addLanguage(candidateLanguages.language_id, candidateLanguages.language_level_id)"
                                    title="დამატება" data-bs-toggle="tooltip"
                                    data-bs-placement="top">{{ $t('lang.user_profile_page_foreign_lang_button_add_info') }}
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                                <!-- <div class="text-right  ">
                                    <button type="submit" class="site-button">დამატება</button>
                                </div> -->
                            </div>
                            <div v-if="candidateLanguageArr.length != 0" :class="languageTableClass">
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
                                                <tr v-for="(item, index) in candidateLanguageArr">
                                                <td>{{ index + 1 }}</td>
                                                <td>{{ item.language }}</td>
                                                <td>{{ item.level }}</td>
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
                                    <label>{{ $t('lang.user_profile_page_work_exp') }}</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker"  v-model="candidateWorkExperience.work_experience_id"  data-live-search="true" title=""  data-bv-field="size">
                                            <option v-for="workExperience in workExperiences " :value="workExperience.id">{{ workExperience[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-history"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_work_position') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="candidateWorkExperience.position" type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-tasks"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_work_object') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="candidateWorkExperience.object" type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-map-marker"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="text-right ">
                                    <button class="btn btn-success"
                                    @click="addCandidateWorkExperience(candidateWorkExperience.work_experience_id, candidateWorkExperience.position, candidateWorkExperience.object)"
                                    title="დამატება" data-bs-toggle="tooltip" data-bs-placement="top">{{ $t('lang.user_profile_page_work_button_add_info') }}
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                            </div>
                            <div v-if="candidateExperienceArr.length != 0" :class="ExperienceTableClass">
                                <!-- <miniTable :key="tableType" :tableType="tableType" :tableRow="tableRow" :tableData="candidateExperience" @messageFromChild="childMessage"></miniTable> -->
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
                                                <!--1-->
                                                <tr v-for="(item, index) in candidateExperienceArr">
                                                <td>{{ index + 1 }}</td>
                                                <td>{{ item.experience }}</td>
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
                                        <select class="wt-select-box selectpicker"  v-model="candidateRecommendation.recommendation_id"  data-live-search="true" title=""  data-bv-field="size">
                                            <option v-for="recommendation in recommendations " :value="recommendation.id">{{ recommendation[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-thumbs-up"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidateRecommendation.recommendation_id != 4" class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_recomendation_where_from') }}</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker"  v-model="candidateRecommendation.recommendation_from_whom_id"  data-live-search="true" title=""  data-bv-field="size">
                                            <option v-for="recommendationFrom in recommendationFromWhom " :value="recommendationFrom.id">{{ recommendationFrom[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-industry"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidateRecommendation.recommendation_id != 4 || candidateRecommendation.recommendation_id != 1" class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_recomendation_name') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="candidateRecommendation.name" type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidateRecommendation.recommendation_from_whom_id == 1" class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>თანამდებობა</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="candidateRecommendation.position" type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidateRecommendation.recommendation_id != 4 || candidateRecommendation.recommendation_id != 1" class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_recomendation_number') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="candidateRecommendation.number" type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-phone"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidateRecommendation.recommendation_id == 3" class="col-xl-6 col-lg-6 col-md-12">
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
                                        <input class="form-control" v-model="candidate.height" type="text" placeholder="65K">
                                        <i class="fs-input-icon fa fa-arrows-alt-v" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group city-outer-bx has-feedback">
                                    <label>{{ $t('lang.user_profile_page_additional_weight') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="candidate.weight" type="text" placeholder="75K">
                                        <i class="fs-input-icon fa fa-arrows-alt-h"></i>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_additional_conviction') }}</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="candidate.convection"  data-live-search="false" title=""  data-bv-field="size">
                                            <option :value="0">{{ $t('lang.user_page_yes') }}</option>
                                            <option :value="1">{{ $t('lang.user_page_no') }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-gavel"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_additional_smoke') }}</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="candidate.smoke"  data-live-search="false" title=""  data-bv-field="size">
                                            <option :value="0">{{ $t('lang.user_page_yes') }}</option>
                                            <option :value="1">{{ $t('lang.user_page_no') }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-smoking"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_additional_work_abroad') }}</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="candidate.work_abroad"  data-live-search="false" title=""  data-bv-field="size">
                                            <option :value="0">{{ $t('lang.user_page_yes') }}</option>
                                            <option :value="1">{{ $t('lang.user_page_no') }}</option>
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
                                        <select class="wt-select-box selectpicker" v-model="candidateNotices.notice_id"  data-live-search="true" title=""  data-bv-field="size">
                                            <option v-for="notice in notices " :value="notice.id">{{ notice[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-sticky-note"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_references_file') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" type="file" @change="noticeFileUpload"  placeholder="">
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
                            <div v-if="candidateNoticeArr.lenght != 0" :class="noticeTableClass">
                                <!-- <miniTable :key="tableType" :tableType="tableType" :tableRow="tableRow" :tableData="candidateExperience" @messageFromChild="childMessage"></miniTable> -->
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
                                                <!--1-->
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
                                        <input class="form-control wt-form-control" name="company_name" type="text" placeholder="https://www.facebook.com/">
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
                                    <button type="submit" class="site-button">{{ $t('lang.user_profile_page_social_button_save') }}</button>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </form>
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
            auth: {},
            candidate:{},
            candidateWorkExperience: {},
            candidateRecommendation: {},
            candidateNotices: {},
            candidateLanguages: {},
            candidateAllergies: {},
            candidateCitizenships: {},
            candidateProfessions: {},
            candidateSpecialties: {},
            //კლასიპიკატორები
            gender: {},
            nationality: {},
            religions: {},
            educations: {},
            maritalStatus: {},
            citizenship: {},
            professions: {},
            specialties: {},
            allergies: {},
            languages: {},
            languageLevels: {},
            workExperiences: {},
            recommendations: {},
            recommendationFromWhom: {},
            notices: {},


            candidateCitizenshipArr: [],
            candidateSpecialtyArr: [],
            candidateProfessionArr: [],
            candidateAllergyArr: [],
            candidateLanguageArr: [],
            candidateExperienceArr: [],
            candidateNoticeArr: [],

            // step: {
            //     step1: {},
            //     step2: {}
            // }
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

        }
    },
    created(){
        this.auth = this.data.auth
        this.candidate = this.data.candidate
        this.gender = this.data.gender
        this.nationality = this.data.nationality
        this.religions = this.data.religions
        this.educations = this.data.educations
        this.maritalStatus = this.data.maritalStatus
        this.citizenship = this.data.citizenship
        this.candidateCitizenships = this.data.candidateCitizenships
        this.professions = this.data.professions
        this.candidateProfessions = this.data.candidateProfessions
        this.specialties = this.data.specialties
        this.candidateSpecialties = this.data.candidateSpecialties
        this.allergies = this.data.allergies
        this.candidateAllergies = this.data.candidateAllergies
        this.languages = this.data.languages
        this.languageLevels = this.data.languageLevels
        this.candidateLanguages = this.data.candidateLanguages
        this.workExperiences = this.data.workExperiences
        this.candidateWorkExperience = this.data.candidateWorkExperience
        this.recommendations = this.data.recommendations
        this.candidateRecommendation = this.data.candidateRecommendation
        this.recommendationFromWhom = this.data.recommendationFromWhom
        this.notices = this.data.notices
        this.candidateNotices = this.data.candidateNotices

        // this.tableRow = {'language': this.tableRowL}
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
        languageTableClass(){
            return (this.candidateLanguageArr.length > 0 )?'col-lg-12 col-md-12':'col-lg-12 col-md-12 visually-hidden'
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
            var candidateFullData = {
                'candidate': this.candidate,
                'citizenship': this.candidateCitizenshipArr,
                'professions': this.candidateProfessionArr,
                'specialty': this.candidateSpecialtyArr,
                'language': this.candidateLanguageArr,
                'allergy': this.candidateAllergyArr,
                'work_experience': this.candidateWorkExperience,
                'recommendation': this.candidateRecommendation,
                'notice': this.candidateNoticeArr
            }
            console.log('candidateFullData',candidateFullData);
            axios({
                method: "post",
                url: "/add_candidate",
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
        },
        addPersonalInfo(){
            axios.post('/candidate_personal_info',{
                user_id:this.auth.id,
                personal_number: this.candidate.personal_number,
                nationality_id: this.candidate.nationality_id,
                religion_id: this.candidate.religion_id,
                education_id: this.candidate.education_id,
                marital_status_id: this.candidate.marital_status_id,
                children: this.candidate.children,
                children_age: this.candidate.children_age,
                spouse: this.candidate.spouse,
                citizenship: this.candidateCitizenshipArr,
                professions: this.candidateProfessionArr,
                specialties: this.candidateSpecialtyArr,
            })
            .then((response) => {
                // handle success
                console.log(response.data);
                this.candidate_id = response.data
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        addMedicalInfo(){
            axios.post('/candidate_medical_info',{
                // candidate_id:this.candidateID,
                allergy: this.candidateAllergyArr,
                medical_info: this.candidate.medical_info
            })
            .then((response) => {
                // handle success
                console.log(response.data);
                this.candidate_id = response.data
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },

        addLanguageInfo(){
            axios({
                method: "post",
                url: "/candidate_language_info",
                data: this.candidateLanguageArr
            })
            .then((response)=> {
                // handle success
                console.log(response.data);

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

        addLanguage(language_id, language_level_id){
            var languageObj =  _.find(this.languages, function(o) { return o.id ==  language_id; });
            var languageLevelObj = _.find(this.languageLevels, function(o) { return o.id ==  language_level_id; });
            var tableData = {
                'language': languageObj[`name_${this.getLang}`],
                'level': languageLevelObj[`name_${this.getLang}`],
            }
            this.candidateLanguageArr.push(tableData)
        },
        addCandidateWorkExperience(workExperience_id, position, object){
            this.candidateWorkExperience = {
                'work_experience_id':workExperience_id,
                'position': position,
                'object': object,
            }
            var workExperienceObj =  _.find(this.workExperiences, function(o) { return o.id ==  workExperience_id; });

            var tableData = {
                'experience': workExperienceObj[`name_${this.getLang}`],
                'position': position,
                'object': object,
            }
            this.candidateExperienceArr.push(tableData)

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

        // addCandidate(){
        //     console.log('hello');
        // }
    },
    // watch:{
    //     candidateCitizenshipArr:{
    //         handler(newValue, oldValue) {
    //             console.log('new',newValue);
    //         }
    //     }
    // },

    mounted(){
        console.log(this.getLang)
        console.log('this.candidateCitizenships',this.candidateCitizenships);
        if (Object.keys(this.data.candidateCitizenships).length != 0 ) {
            this.data.candidateCitizenships.forEach(element => {
                this.candidateCitizenshipArr.push(element.citizenship_id)
            });
        }
        if (Object.keys(this.data.candidateProfessions).length != 0 ) {
            this.data.candidateProfessions.forEach(element => {
                this.candidateProfessionArr.push(element.profession_id)
            });
        }
        console.log('this.candidateProfessions',this.candidateProfessions);

    }
}
</script>
<style lang="">

</style>
