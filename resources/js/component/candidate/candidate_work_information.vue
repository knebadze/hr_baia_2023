<template lang="">
    <div class="col-xl-9 col-lg-8 col-md-12 m-b30 employerPageBorder">
        <!--Filter Short By-->
        <div class="twm-right-section-panel site-bg-gray">
            <!--personal information-->
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <!-- <div class="d-flex justify-content-between"> -->
                        <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_category_end_schedule') }}</h4>
                        <!-- <button type="button" class="btn btn-success" @click="addWorkInfoModal()"><i class="fa fa-plus"></i> დამატება</button> -->

                    <!-- </div> -->
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30 ">
                    <p class="text-danger">{{ $t('lang.user_profile_page_category_end_schedule_title') }}</p>
                    <small>{{ $t('lang.user_profile_page_category_end_schedule_title_2') }}</small>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_category_title') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.getWorkInformation.category_id" :options="data.classificatory.category" :searchable="true" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :allow-empty="false" @blur="v$.m.getWorkInformation.category_id.$touch">
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                    <span v-if="v$.m.getWorkInformation.category_id.required.$invalid && v$.m.getWorkInformation.category_id.$dirty" style='color:red'>* {{ v$.m.getWorkInformation.category_id.required.$message}}</span>
                                    <!-- <i class="fs-input-icon fa fa-smoking"></i> -->
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_schedule_title') }}</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="workInformationSchedule"  :options="data.classificatory.workSchedule" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name_ka" track-by="name_ka" :preselect-first="false" @blur="v$.workInformationSchedule.$touch">
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                        <span v-if="v$.workInformationSchedule.required.$invalid && v$.workInformationSchedule.$dirty" style='color:red'>* {{ v$.workInformationSchedule.required.$message}}</span>
                                        <!-- <i class="fs-input-icon fa fa-smoking"></i> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8" v-if="showAdditionalSchedule">
                                <div class="form-group">
                                    <label><span class="text-danger">* </span>სასურველი სამუშაო გრაფიკი</label>
                                    <textarea class="form-control" rows="3" v-model="m.getWorkInformation[`additional_schedule_${getLang}`]" placeholder="ჩაწერეთ სასურველი სამუშაო დღეები და საათები" @blur="v$.m.getWorkInformation[`additional_schedule_${getLang}`].$touch"></textarea>
                                    <span v-if="v$.m.getWorkInformation[`additional_schedule_${getLang}`].required.$invalid && v$.m.getWorkInformation[`additional_schedule_${getLang}`].$dirty" style='color:red'>* {{ v$.m.getWorkInformation[`additional_schedule_${getLang}`].required.$message}}</span>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_salary_title') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" type="number" step="50" v-model="m.getWorkInformation.payment" @blur="v$.m.getWorkInformation.payment.$touch" style='height:45px;'>
                                        <!-- <i class="fs-input-icon fa fa-money"></i> -->
                                        <span v-if="v$.m.getWorkInformation.payment.numeric.$invalid && v$.m.getWorkInformation.payment.$dirty" style='color:red'>* {{ v$.m.getWorkInformation.payment.numeric.$message}}</span>
                                        <span v-if="v$.m.getWorkInformation.payment.required.$invalid && v$.m.getWorkInformation.payment.$dirty" style='color:red'>* {{ v$.m.getWorkInformation.payment.required.$message}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_currency_title') }}</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.getWorkInformation.currency_id" :options="data.classificatory.currency" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false" @blur="v$.m.getWorkInformation.currency_id.$touch">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                        <span v-if="v$.m.getWorkInformation.currency_id.required.$invalid && v$.m.getWorkInformation.currency_id.$dirty" style='color:red'>* {{ v$.m.getWorkInformation.currency_id.required.$message}}</span>
                                        <!-- <i class="fs-input-icon fa fa-usd"></i> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div v-if="m.getWorkInformation.category_id"> -->
                        <div class="row" v-if=" m.getWorkInformation.category_id.id == 7 || m.getWorkInformation.category_id.id == 8 || m.getWorkInformation.category_id.id == 10">
                            <div class="col-xl-4 col-lg-6 col-md-12" v-if="m.getWorkInformation.category_id.id != 10">
                                <div class="form-group">

                                    <div class="ls-inputicon-box">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" v-model="m.getWorkInformation.go_vacation" id="flexCheckDefault">
                                            <label>{{ ('შეძლებთ არდადეგებზე გაყოლას?') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">

                                    <div class="ls-inputicon-box">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" v-model="m.getWorkInformation.stay_night" id="flexCheckDefault">
                                            <label>{{ $t('შეძლებთ ღამე დარჩენას?') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">

                                    <div class="ls-inputicon-box">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" v-model="m.getWorkInformation.work_additional_hours" id="flexCheckDefault">
                                            <label>{{ $t('შეძლებთ დამატებით საათებში მუშაობას?') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
                        <div class="col-lg-12 col-md-12 mt-4" v-if="m.getWorkInformation.category_id.type == 1  ">
                            <div class="text-left">
                                <button type="submit" @click.prevent="addWorkInfo()"  class="site-button">{{ $t('lang.user_profile_page_work_button_save') }}</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="panel panel-default" v-if="m.getWorkInformation.category_id.type == 2  ||( m.workInformation[0] && m.workInformation[0].category_id > 13)">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">{{ $t('სამუშაო გამოცდილე') }}</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">
                        <p class="text-danger">{{ $t('სავალდებულოა შეავსოთ არჩეული კატეგორიის შესაბამისი სამუშაო გამოცდილების შესახებ ინფორმაცია') }}</p>
                        <hr>
                        <div class="row">
                            <div class=" col-md-12">
                                <div class="form-group">
                                    <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_exp_experience') }}</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="noFamilyWorkExperienceModel.has_experience" :options="data.classificatory.yesNo" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false" @blur="v$.noFamilyWorkExperienceModel.has_experience.$touch">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                        <span v-if="v$.noFamilyWorkExperienceModel.has_experience.required.$invalid && v$.noFamilyWorkExperienceModel.has_experience.$dirty" style='color:red'>* {{ v$.noFamilyWorkExperienceModel.has_experience.required.$message}}</span>
                                     </div>
                                </div>
                            </div>
                            <div class="row" v-if="showYesWorkExperience">
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_exp') }}</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="noFamilyWorkExperienceModel.work_experience" :options="data.classificatory.workExperience" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false" @blur="v$.noFamilyWorkExperienceModel.work_experience.$touch">
                                                <template slot="singleLabel" slot-scope="{ option }"></template>
                                            </multiselect>
                                            <span v-if="v$.noFamilyWorkExperienceModel.work_experience.required.$invalid && v$.noFamilyWorkExperienceModel.work_experience.$dirty" style='color:red'>* {{ v$.noFamilyWorkExperienceModel.work_experience.required.$message}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div  class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_object') }}</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="noFamilyWorkExperienceModel[`object_${getLang}`]" type="text" placeholder="" @blur="v$.noFamilyWorkExperienceModel[`object_${getLang}`].$touch">
                                            <i class="fs-input-icon fa fa-map-marker"></i>
                                            <span v-if="v$.noFamilyWorkExperienceModel[`object_${getLang}`].required.$invalid && v$.noFamilyWorkExperienceModel[`object_${getLang}`].$dirty" style='color:red'>* {{ v$.noFamilyWorkExperienceModel[`object_${getLang}`].required.$message}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" v-if="showNoWorkExperience">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>სამუშაო გამოცდილების არ ქონის მიზეზი</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="noFamilyWorkExperienceModel.no_reason" :options="data.classificatory.noExperienceReason" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                                <template slot="singleLabel" slot-scope="{ option }"></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>დამატაბითი ინფორმაცია</label>
                                        <textarea class="form-control" rows="3" v-model="noFamilyWorkExperienceModel[`no_reason_info_${getLang}`]" :placeholder="$t('lang.user_profile_page_medical_please_info')"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div v-if="showYesWorkExperience" class="col-lg-12 col-md-12">
                                <div class="text-right ">
                                    <button class="btn btn-success"
                                    @click="addCandidateWorkExperience(noFamilyWorkExperienceModel)"
                                    title="დამატება" data-bs-toggle="tooltip" data-bs-placement="top">{{ $t('lang.user_profile_page_work_button_add_info') }}
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                            </div>

                            <div v-if="m.getWorkInformation.no_family_has_work_information.length != 0" class="col-lg-12 col-md-12">

                                <div class="panel-body wt-panel-body">
                                    <div class="p-a20 table-responsive">
                                        <table class="table twm-table table-striped table-borderless" v-if="m.getWorkInformation.no_family_has_work_information[0].has_experience.id == 1">
                                            <thead>
                                                <tr>
                                                <th>N</th>
                                                <th>{{ $t('lang.user_profile_page_work_exp') }}</th>
                                                <!-- <th>{{ $t('lang.user_profile_page_work_position') }}</th> -->
                                                <th>{{ $t('lang.user_profile_page_work_object') }}</th>
                                                <th>{{ $t('lang.user_profile_page_work_actions') }}</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(item, index) in m.getWorkInformation.no_family_has_work_information">
                                                <td>{{ index + 1 }}</td>
                                                <td>{{ (item.work_experience)?item.work_experience[`name_${getLang}`]:'' }}</td>
                                                <!-- <td>{{ item[`position_${getLang}`] }}</td> -->
                                                <td>{{ item[`object_${getLang}`] }}</td>
                                                <td>
                                                    <button @click="removeNWFE(index)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table twm-table table-striped table-borderless" v-if="m.getWorkInformation.no_family_has_work_information[0].has_experience.id == 2">
                                            <thead>
                                                <tr>

                                                <th>არ ქონის მიზეზი</th>
                                                <th>დამატებითი ინფორმაცია</th>
                                                <th>action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(item, index) in m.getWorkInformation.no_family_has_work_information">
                                                    <td>{{ item.no_reason[`name_${getLang}`] }}</td>
                                                    <td>{{(item[`no_reason_info_${getLang}`])?item[`no_reason_info_${getLang}`].substr(0, 30)+ '...':''  }}</td>
                                                <td>
                                                    <button @click="removeNWFE(index)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <i class="fa fa-pen"></i>
                                                    </button>
                                                    <!-- <button @click="removeRow('experience',index)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </button> -->

                                                </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 mt-4">
                                <div class="text-left">
                                    <button type="submit" @click.prevent="addWorkInfo()"  class="site-button">{{ $t('lang.user_profile_page_work_button_save') }}</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>



                <div class="panel panel-default" v-if="m.workInformation.length != 0" >
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_category_end_schedule_table') }}</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">
                        <div class="p-a20 table-responsive">
                          <table class="table twm-table table-striped table-borderless">
                            <thead>
                              <tr>
                                <th>N</th>
                                <th>{{ $t('lang.user_profile_page_category_title') }}</th>
                                <th>{{ $t('lang.user_profile_page_work_schedule_title') }}</th>
                                <th>{{ $t('lang.user_profile_page_work_salary_title') }}</th>
                                <th>{{ $t('lang.user_profile_page_work_currency_title') }}</th>
                                <th>{{ $t('lang.user_profile_page_work_actions_title') }}</th>
                              </tr>
                            </thead>

                            <tbody>
                              <!--1-->
                              <tr v-for="(item,index) in m.workInformation">
                                <td>{{ index + 1 }}</td>
                                <td><span style="margin-bottom: 5px; margin-right: 5px;" class="badge rounded-pill bg-success p-2">{{ item.category[`name_${getLang}`] }}</span></td>
                                <td><span style="margin-bottom: 5px; margin-right: 5px;" v-for="i in item.work_schedule" class="badge rounded-pill bg-primary p-2">{{ i[`name_${getLang}`] }}</span></td>
                                <td>{{ item.payment }}</td>
                                <td>{{ item.currency[`name_${getLang}`] }}</td>
                                <td>
                                    <button type="button" :title="$t('lang.user_profile_page_category_end_schedule_table_action_tooltips_view')" data-bs-toggle="tooltip" data-bs-placement="top" @click="editWorkInformation(item)">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <!-- <a type="button" title="ნახვა" data-bs-toggle="tooltip" data-bs-placement="top" :href="`/${this.getLang}/user/work_information_detail/${item.id}`">
                                        <i class="fa fa-eye"></i>
                                    </a> -->
                                    <button :title="$t('lang.user_profile_page_category_end_schedule_table_action_tooltips_del')" data-bs-toggle="tooltip" data-bs-placement="top" @click="deleteWorkInformation(index, item.id)">
                                        <i class="fa fa-trash-alt"></i>
                                    </button>
                                </td>
                              </tr>





                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            <!--ოჯახში მუშაობის გამოცდიელბა  -->
            <div class="panel panel-default" v-if="m.getWorkInformation.category_id.type == 1  || (m.workInformation[0] &&  m.workInformation[0].category_id < 14)">
                <div class="panel-heading wt-panel-heading p-a20">
                    <!-- <div class="d-flex justify-content-between"> -->
                        <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_family_work_experience_title') }}</h4>
                        <!-- <button type="button" class="btn btn-success" @click="addWorkInfoModal()"><i class="fa fa-plus"></i> დამატება</button> -->

                    <!-- </div> -->
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30 ">
                    <p class="text-danger">{{ $t('lang.user_profile_page_family_work_experience_description') }}</p>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.user_profile_page_family_work_experience_answer') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.familyWorkExperience.has_experience" :options="data.classificatory.yesNo" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false" @blur="v$.m.familyWorkExperience.has_experience.$touch">
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                    <span v-if="v$.m.familyWorkExperience.has_experience.required.$invalid && v$.m.familyWorkExperience.has_experience.$dirty" style='color:red'>* {{ v$.m.familyWorkExperience.has_experience.required.$message}}</span>
                                    <!-- <i class="fs-input-icon fa fa-star"></i> -->
                                    <!-- <span v-if="v$.noFamilyWorkExperienceModel.has_experience.required.$invalid && v$.noFamilyWorkExperienceModel.has_experience.$dirty" style='color:red'>* {{ v$.noFamilyWorkExperienceModel.has_experience.required.$message}}</span> -->
                                </div>
                            </div>
                        </div>
                        <div v-if="m.familyWorkExperience.has_experience && m.familyWorkExperience.has_experience.id == 2" class=" col-md-12 mb-2">
                            <strong>ჩვენი კლიენტები დასაქმების დროს ითვალისწინებელ სამუშაო გამოცდილებას ვინაიდან არ გაქვთ გამოცდილება გთხოვთ შეავსოთ გამოცდილების არ ქონის მიზეზი</strong>
                        </div>
                        <div v-if="m.familyWorkExperience.has_experience && m.familyWorkExperience.has_experience.id == 1" class=" col-md-12">
                            <div class="row">
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_family_work_experience_answer_2') }}</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" type="number" v-model="m.familyWorkExperience.families_worked_count" @blur="v$.m.familyWorkExperience.families_worked_count.$touch" style="height: 40px;">
                                            <!-- <i class="fs-input-icon fa fa-smoking"></i> -->
                                            <span v-if="v$.m.familyWorkExperience.families_worked_count.required.$invalid && v$.m.familyWorkExperience.families_worked_count.$dirty" style='color:red'>* {{ v$.m.familyWorkExperience.families_worked_count.required.$message}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_family_work_staji') }}</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.familyWorkExperience.work_experience" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one" :options="data.classificatory.workExperience" :searchable="false" :allow-empty="false" @blur="v$.m.familyWorkExperience.work_experience.$touch">
                                                <template slot="singleLabel" slot-scope="{ option }"></template>
                                            </multiselect>
                                            <span v-if="v$.m.familyWorkExperience.work_experience.required.$invalid && v$.m.familyWorkExperience.work_experience.$dirty" style='color:red'>* {{ v$.m.familyWorkExperience.work_experience.required.$message}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_family_work_staji_time') }}</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.familyWorkExperience.longest" :options="data.classificatory.workExperience" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false" @blur="v$.m.familyWorkExperience.longest.$touch">
                                                <template slot="singleLabel" slot-scope="{ option }"></template>
                                            </multiselect>
                                            <span v-if="v$.m.familyWorkExperience.longest.required.$invalid && v$.m.familyWorkExperience.longest.$dirty" style='color:red'>* {{ v$.m.familyWorkExperience.longest.required.$message}}</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_family_work_in_family') }}</label>
                                        <div class="ls-inputicon-box">
                                            <!-- <multiselect v-model="m.familyWorkedSelected"  :options="data.classificatory.familyCategory" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name_ka" track-by="name_ka" :preselect-first="false" @blur="v$.m.familyWorkedSelected.$touch">
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect> -->
                                            <!-- <span v-if="v$.m.familyWorkedSelected.required.$invalid && v$.m.familyWorkedSelected.$dirty" style='color:red'>* {{ v$.m.familyWorkedSelected.required.$message}}</span> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_family_work_obligation') }}</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.candidateFamilyWorkSkill"  :options="setSkill" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name_ka" track-by="name_ka" :preselect-first="false" @blur="v$.m.candidateFamilyWorkSkill.$touch">
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect>
                                            <span v-if="v$.m.familyWorkedSelected.required.$invalid && v$.m.familyWorkedSelected.$dirty" style='color:red'>* {{ v$.m.candidateFamilyWorkSkill.required.$message}}</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="m.familyWorkExperience.has_experience && m.familyWorkExperience.has_experience.id == 2"  class=" col-md-12">
                            <div  class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>სამუშაო გამოცდილების არ ქონის მიზეზი</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.familyWorkExperience.no_reason" :options="data.classificatory.noExperienceReason" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false" @blur="v$.m.familyWorkExperience.no_reason.$touch">
                                                <template slot="singleLabel" slot-scope="{ option }"></template>
                                            </multiselect>
                                            <span v-if="v$.m.familyWorkExperience.no_reason.required.$invalid && v$.m.familyWorkExperience.no_reason.$dirty" style='color:red'>* {{ v$.m.familyWorkExperience.no_reason.required.$message}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="m.familyWorkExperience.no_reason" class="col-md-12">
                                    <div class="form-group">
                                        <label>დამატაბითი ინფორმაცია</label>
                                        <textarea class="form-control" rows="3" v-model="m.familyWorkExperience[`no_reason_info_${getLang}`]" placeholder="ჩაწერეთ იმ შემთხვევაში თუ ასარჩევ ველში ვერ ნახეთ შესაფერისი მიზეზი ან გსურთ დამატებითი ინფორმაციის მოწოდება" @blur="v$.m.familyWorkExperience.no_reason_info.$touch"></textarea>
                                        <span v-if="v$.m.familyWorkExperience.no_reason_info.maxLength.$invalid && v$.m.familyWorkExperience.no_reason_info.$dirty" style='color:red'>* {{ v$.m.familyWorkExperience.no_reason_info.maxLength.$message}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="text-left">
                                <button type="submit" @click.prevent="addFamilyWorkExperience()"  class="site-button">{{ $t('lang.user_profile_page_work_button_save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--რეკომენდაცია-->
            <div class="panel panel-default" v-if="m.familyWorkExperience.has_experience && m.familyWorkExperience.has_experience.id == 1">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_recomendation_title') }}</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_recomendation_from') }}</label>
                                    <div class="ls-inputicon-box">
                                        <!-- <select class="wt-select-box selectpicker"  v-model="candidateRecommendationModel.recommendation"  data-live-search="false" title=""  data-bv-field="size">
                                            <option :value="1">წარმოვადგენ</option>
                                            <option :value="2">ვერ წარმოვადგენ</option>
                                        </select> -->
                                        <multiselect v-model="candidateRecommendationModel.has_recommendation" :options="data.classificatory.yesNo" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false" @blur="v$.candidateRecommendationModel.has_recommendation.$touch">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                        <span v-if="v$.candidateRecommendationModel.has_recommendation.required.$invalid && v$.candidateRecommendationModel.has_recommendation.$dirty" style='color:red'>* {{ v$.candidateRecommendationModel.has_recommendation.required.$message}}</span>

                                    </div>
                                </div>
                            </div>
                            <div class="row" v-if="candidateRecommendationModel.has_recommendation.id == 1">
                                <div class="col-xl-6 col-lg-6 col-md-12 " >
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_recomendation_where_from') }}</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="candidateRecommendationModel.recommendation_whom" :options="data.classificatory.recommendationFromWhom" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false" @blur="v$.candidateRecommendationModel.recommendation_whom.$touch">
                                                <template slot="singleLabel" slot-scope="{ option }"></template>
                                            </multiselect>
                                            <span v-if="v$.candidateRecommendationModel.recommendation_whom.required.$invalid && v$.candidateRecommendationModel.recommendation_whom.$dirty" style='color:red'>* {{ v$.candidateRecommendationModel.recommendation_whom.required.$message}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('lang.user_profile_page_recomendation_name') }}</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="candidateRecommendationModel[`name_${getLang}`]" type="text" placeholder="" @blur="v$.candidateRecommendationModel[`name_${getLang}`].$touch">
                                            <i class="fs-input-icon fa fa-star"></i>
                                            <span v-if="v$.candidateRecommendationModel[`name_${getLang}`].required.$invalid && v$.candidateRecommendationModel[`name_${getLang}`].$dirty" style='color:red'>* {{ v$.candidateRecommendationModel[`name_${getLang}`].required.$message}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="candidateRecommendationModel.recommendation_whom.id == 2 " class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>თანამდებობა</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="candidateRecommendationModel[`position_${getLang}`]" type="text" placeholder="" @blur="v$.candidateRecommendationModel[`position_${getLang}`].$touch">
                                            <span v-if="v$.candidateRecommendationModel[`position_${getLang}`].required.$invalid && v$.candidateRecommendationModel[`position_${getLang}`].$dirty" style='color:red'>* {{ v$.candidateRecommendationModel[`position_${getLang}`].required.$message}}</span>
                                            <i class="fs-input-icon fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_number') }}</label>
                                    <div class="input-group mb-3">
                                    <button style="border-style: none;" class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span :class="`fi fi-${numberCode.iso.toLowerCase()}`"></span>+{{ numberCode.phonecode }}</button>
                                    <ul class="dropdown-menu" style=" overflow: hidden; overflow-y: auto; max-height: calc(100vh - 550px);">
                                        <li v-for="item in data.classificatory.numberCode" @click="chooseNumberCode(item.phonecode, item.iso.toLowerCase())"><a class="dropdown-item"><span :class="`fi fi-${item.iso.toLowerCase()}`"></span>+{{ item.phonecode }}</a></li>
                                    </ul>
                                    <input type="text" class="form-control" aria-label="Text input with dropdown button" v-model="candidateRecommendationModel.number" placeholder="555666777" @blur="v$.candidateRecommendationModel.number.$touch">
                                        <span v-if="v$.candidateRecommendationModel.number.required.$invalid && v$.candidateRecommendationModel.number.$dirty" style='color:red'>* {{ v$.candidateRecommendationModel.number.required.$message}}</span>
                                        <span v-if="v$.candidateRecommendationModel.number.numeric.$invalid && v$.candidateRecommendationModel.number.$dirty" style='color:red'>* {{ v$.candidateRecommendationModel.number.numeric.$message}}</span>
                                    </div>
                                </div>
                            </div>
                                <div  class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>ფაილი</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" ref="upload" type="file" @change="recommendationFileUpload" placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" v-if="showNoReccomendation">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>რეცომდაციის არ ქონის მიზეზი</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="candidateRecommendationModel.no_reason" :options="data.classificatory.noRecommendationReason" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false" @blur="v$.candidateRecommendationModel.no_reason.$touch">
                                                <template slot="singleLabel" slot-scope="{ option }"></template>
                                            </multiselect>
                                            <span v-if="v$.candidateRecommendationModel.no_reason.required.$invalid && v$.candidateRecommendationModel.no_reason.$dirty" style='color:red'>* {{ v$.candidateRecommendationModel.no_reason.required.$message}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>დამატაბითი ინფორმაცია</label>
                                        <textarea class="form-control" rows="3" v-model="candidateRecommendationModel[`no_reason_info_${getLang}`]" placeholder="ჩაწერეთ იმ შემთხვევაში თუ ასარჩევ ველში ვერ ნახეთ შესაფერისი მიზეზი ან გსურთ დამატებითი ინფორმაციის მოწოდება"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidateRecommendationModel.has_recommendation.id == 1" class="col-lg-12 col-md-12">
                                <div class="text-right ">
                                    <button class="btn btn-success"
                                    @click="addCandidateRecommendation(candidateRecommendationModel)"
                                    title="დამატება" data-bs-toggle="tooltip" data-bs-placement="top">დამატება
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                            </div>
                            <div v-if="m.candidateRecommendation.length > 0 && m.candidateRecommendation[0].has_recommendation.id == 1 " class="col-lg-12 col-md-12">
                                <div class="panel-body wt-panel-body">
                                    <div class="p-a20 table-responsive">
                                        <table class="table twm-table table-striped table-borderless">
                                            <thead>
                                                <tr>
                                                <th>N</th>
                                                <th>{{ $t('lang.user_profile_page_recomendation_from') }}</th>
                                                <th>{{$t('lang.user_profile_page_recomendation_name')}}</th>
                                                <th>{{ $t('lang.user_profile_page_work_number_code') }}</th>
                                                <th>{{$t('lang.user_profile_page_recomendation_number')}}</th>
                                                <th>{{$t('პოზიცია')}}</th>
                                                <th>{{$t('lang.user_profile_page_recomendation_file')}}</th>
                                                <th>{{$t('lang.user_profile_page_work_actions_title')}}</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(item, index) in m.candidateRecommendation">
                                                <td>{{ index + 1 }}</td>
                                                <td><span :class="( item.recommendation_whom.id == 1)?'badge bg-success p-2':'badge bg-info text-dark p-2'">{{ item.recommendation_whom[`name_${getLang}`] }}</span></td>
                                                <td>{{ item[`name_${getLang}`] }}</td>
                                                <td>+{{ item.number_code.phonecode}}</td>
                                                <td>{{ item.number }}</td>
                                                <td>{{ item[`position_${getLang}`] }}</td>
                                                <td>{{ item.file }}</td>
                                                <td>
                                                    <button @click="removeRecommendation(index, item.id)" title="წაშლა" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </button>
                                                    <button @click="editRecommendation(item)" title="რედაქტირება" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <i class="fa fa-pen"></i>
                                                    </button>
                                                </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div v-if="m.candidateRecommendation.length > 0 && m.candidateRecommendation[0].has_recommendation.id == 2" class="col-lg-12 col-md-12">
                                <div class="panel-body wt-panel-body">
                                    <div class="p-a20 table-responsive">
                                        <table class="table twm-table table-striped table-borderless">
                                            <thead>
                                                <tr>
                                                <th>არ ქონის მიზეზი</th>
                                                <th>დამატებითი ინფორმაცია</th>
                                                <th>action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(item, index) in m.candidateRecommendation">
                                                <td>{{ item.no_reason[`name_${getLang}`] }}</td>
                                                <td>{{ item[`no_reason_info_${getLang}`].substr(0, 30)+ '...' }}</td>
                                                <td>
                                                    <button @click="removeRecommendation(index, item.id)" title="წაშლა" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </button>
                                                    <button @click="editRecommendation(item)" title="რედაქტირება" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <i class="fa fa-pen"></i>
                                                    </button>
                                                </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 mt-4">
                                <div class="text-left">
                                    <button type="submit" @click.prevent="addRecomendation()"  class="site-button">{{$t('lang.user_profile_page_work_button_save')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <editWorkInformation :visible="showWorkInformation" :data="editWorkInformationData"></editWorkInformation>
    <editRecommendation :visible="showRecommendationEditModal" :data="editRecommendationData"></editRecommendation>
</template>
<script>
import editWorkInformation from '../modal/editWorkInformation.vue'
import editRecommendation from '../modal/editRecommendation.vue'
import { uuid } from 'vue-uuid'
import _ from 'lodash'
import { useVuelidate } from '@vuelidate/core'
import { required, email, helpers, requiredIf, numeric, maxLength } from '@vuelidate/validators'
export default {
    setup () {
        return { v$: useVuelidate() }
    },
    components:{
        editWorkInformation,
        editRecommendation
    },
    props:{
        data: Object
    },
    data() {
        return {
            uuid: uuid.v1(),
            showWorkInformation: false,
            editWorkInformationData:{},
            m: null,
            candidateRecommendationModel: {
                'id':'',
                'recommendation': '',
                'has_recommendation': '',
                'recommendation_whom':'',
                'name_ka':'',
                'name_en':'',
                'name_ru':'',
                'position_ka':'',
                'position_en':'',
                'position_ru':'',
                'number':'',
                'file':'',
                'no_reason':'',
                'no_reason_info_ka':'',
                'no_reason_info_en':'',
                'no_reason_info_ru':'',
            },
            noFamilyWorkExperienceModel: {
                'has_experience':'',
                'work_experience':'',
                // 'position_ka':'',
                // 'position_en':'',
                // 'position_ru':'',
                'object_ka':'',
                'object_en':'',
                'object_ru':'',
                'no_reason':'',
                'no_reason_info_ka':'',
                'no_reason_info_en':'',
                'no_reason_info_ru':'',
            },
            workInformationSchedule: [],
            recommendationFile:null,
            setSkill:[],
            formData:new FormData(),
            candidateRecommendationArr: [],

            //modal
            showRecommendationEditModal: false,
            editRecommendationData: {},
            showNoReccomendation:false,
            showNoWorkExperience: false,
            showYesWorkExperience:false,
            showAdditionalSchedule:false,
            noFamilyWorkInformation: [],
            numberCode: {
                phonecode: 995,
                iso:'ge'
            },
        }
    },
    validations () {
        const validations = {
            m:{
                getWorkInformation:{
                    category_id:{
                        required:helpers.withMessage('არჩევა სავალდებულოა', required ),
                    },
                    payment:{
                        required:helpers.withMessage('არჩევა სავალდებულოა', required ),
                        numeric: helpers.withMessage('უნდა შედგებოდეს მხოლოდ ციფრებისგან', numeric ),
                    },
                    currency_id:{
                        required:helpers.withMessage('არჩევა სავალდებულოა', required )
                    },
                    additional_schedule_ka:{},
                    additional_schedule_ka:{},
                    additional_schedule_ka:{},
                },
                familyWorkExperience:{
                    has_experience:{
                        required:helpers.withMessage('ოჯახში მუშაობის გამოცდილების შევსება სავალდებულოა', required ),
                    },
                    families_worked_count:{},
                    work_experience:{},
                    longest:{},
                    no_reason:{},
                    no_reason_info:{}
                },
                familyWorkedSelected:{},
                candidateFamilyWorkSkill:{},
                showNoWorkExperience:false


            },

            workInformationSchedule:{required:helpers.withMessage('სამუშაო გრაფიკის არჩევა სავალდებულოა', required )},

            noFamilyWorkExperienceModel:{
                has_experience:{},
                work_experience:{},
                object_ka:{},
                object_en:{},
                object_ru:{},
                no_reason:{},
                no_reason_info_ka:{},
                no_reason_info_en:{},
                no_reason_info_ru:{},
            },


            candidateRecommendationModel:{
                has_recommendation:{
                    required:helpers.withMessage('რეკომენდაციის შევსება სავალდებულოა', required )
                },
                recommendation_whom:{},
                name_ka:{},
                name_en:{},
                name_ru:{},
                position_ka:{},
                position_en:{},
                position_ru:{},
                number:{},
                no_reason:{},
                no_reason_info_ka:{},
                no_reason_info_en:{},
                no_reason_info_ru:{},
            }
        }

        if (this.m.familyWorkExperience.has_experience && this.m.familyWorkExperience.has_experience.id == 1) {
            validations.m.familyWorkExperience.work_experience = {
                required:helpers.withMessage('სტაჟის შევსება სავალდებულოა', required )
            }
            validations.m.familyWorkExperience.families_worked_count = {
                required:helpers.withMessage('შევსება სავალდებულოა', required ),
                numeric: helpers.withMessage('უნდა შედგებოდეს მხოლოდ ციფრებისგან', numeric ),
            }
            validations.m.familyWorkExperience.longest = {
                required:helpers.withMessage('არჩევა სავალდებულოა', required ),
            }
            validations.m.familyWorkedSelected = {
                required:helpers.withMessage('არჩევა სავალდებულოა', required ),
            }
            validations.m.candidateFamilyWorkSkill = {
                required:helpers.withMessage('არჩევა სავალდებულოა', required ),
            }
        }else{
            validations.m.familyWorkExperience.no_reason = {
                required:helpers.withMessage('არჩევა სავალდებულოა', required ),
            }
            validations.m.familyWorkExperience.no_reason_info = {
                maxLength: helpers.withMessage('დაშვებულია 100 სიმბოლო', maxLength(100) )
            }

        }

        if (this.candidateRecommendationModel.has_recommendation && this.candidateRecommendationModel.has_recommendation.id == 1) {
            validations.candidateRecommendationModel.recommendation_whom = {
                required:helpers.withMessage('არჩევა სავალდებულოა', required )
            }
            if (this.candidateRecommendationModel.recommendation_whom.id == 2) {
                validations.candidateRecommendationModel[`position_${this.getLang}`] = {
                    required:helpers.withMessage('შევსება სავალდებულოა', required )
                }
            }
            validations.candidateRecommendationModel[`name_${this.getLang}`] = {
                required:helpers.withMessage('შევსება სავალდებულოა', required )
            }
            validations.candidateRecommendationModel.number = {
                required:helpers.withMessage('შევსება სავალდებულოა', required ),
                numeric: helpers.withMessage('ნომერი უნდა შედგებოდეს მხოლოდ ციფრებისგან', numeric ),
            }
        } else {
            validations.candidateRecommendationModel.no_reason = {
                required:helpers.withMessage('არჩევა სავალდებულოა', required )
            }
            validations.candidateRecommendationModel[`no_reason_info_${this.getLang}`] = {
                maxLength: helpers.withMessage('დაშვებულია 100 სიმბოლო', maxLength(100) )
            }
        }

        if (this.workInformationSchedule.id == 9) {
            if (this.getLang == 'ka') {
                validations.m.getWorkInformation.additional_schedule_ka = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
            }else if(this.getLang == 'en'){
                validations.m.getWorkInformation.additional_schedule_en = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
            }else if(this.getLang == 'ru'){
                validations.m.getWorkInformation.additional_schedule_ru = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
            }
        }

        if (this.m.getWorkInformation.category_id.type == 2) {
            validations.noFamilyWorkExperienceModel.has_experience = {required:helpers.withMessage('არჩევა სავალდებულოა', required )}
            if (this.noFamilyWorkExperienceModel.has_experience.id == 1) {
                validations.noFamilyWorkExperienceModel.work_experience = {required:helpers.withMessage('არჩევა სავალდებულოა', required )}
                if (this.getLang == 'ka') {
                    validations.noFamilyWorkExperienceModel.object_ka = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
                }else if(this.getLang == 'en'){
                    validations.noFamilyWorkExperienceModel.object_ka = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
                }else if(this.getLang == 'ru'){
                    validations.noFamilyWorkExperienceModel.object_ka = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
                }
            }
            else if(this.noFamilyWorkExperienceModel.has_experience.id == 2){
                // if (!this.noFamilyWorkExperienceModel.no_reason) {
                //     if (this.getLang == 'ka') {
                //         validations.noFamilyWorkExperienceModel.no_reason_info_ka = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
                //     }else if(this.getLang == 'en'){
                //         validations.noFamilyWorkExperienceModel.no_reason_info_ka = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
                //     }else if(this.getLang == 'ru'){
                //         validations.noFamilyWorkExperienceModel.no_reason_info_ka = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
                //     }
                // }
            }
        }
        return validations
    },
    created(){
        this.data.model.getWorkInformation['payment'] = 800;
        console.log('data', this.data);

        this.m = { ...this.data.model };
        this.m.getWorkInformation['no_family_has_work_information'] = []
        // if (this.m.familyWorkExperience.experience != null) {
        //     var That = this;
        //     this.m.familyWorkExperience.experience = _.find(this.yesNo, function(o) { return o.id == That.m.familyWorkExperience.experience; });

        // }
        console.log(this.m);
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
    },
    methods:{
        childMessageReceived(arg){
            this.showWorkInformation = arg
        },
        swal(){
            this.$swal({
                title: '<p>გილოცავთ თქვენ დაასრულეთ ინფორმაციის შევსება</p>',
                icon: 'info',
                html:
                    'თქვენი კანდიდატურა უკვე ჩანს დამსაქმებლებთან და ასევე ჩვენი ეიჩარები ვაკანსიების მიღებს შემთხვევაში გაითვალისწინებენ თქვენს კანდიდატურას',
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                // confirmButtonText: 'შესავსებად გადასვლა',
            })
        },
        successToast(msg){
            toast.success(msg, {
                theme: 'colored',
                autoClose: 1000,
            });
        },
        errorToast(msg){
            toast.error(msg, {
                theme: 'colored',
                autoClose: 1000,
            });
        },
        //add table and model
        addCandidateRecommendation(recommendation){
            var uuid = this.$uuid.v4()
            if (this.recommendationFile != null) {
                recommendation['file'] = this.recommendationFile.name
                this.formData.append(uuid, this.recommendationFile)
            }
            recommendation['uuid'] = uuid
            console.log('recommendation', recommendation);
            var code = this.numberCode.phonecode
            var numberCode = _.find(this.data.classificatory.numberCode, function(o) { return o.phonecode == code; });
            console.log('numberCode', numberCode);
            // recommendation['number_code_id'] = numberCode.id
            recommendation['number_code'] = numberCode
            recommendation['lang'] = this.getLang
            this.m.candidateRecommendation.push(JSON.parse(JSON.stringify(recommendation)))

            this.candidateRecommendationModel['recommendation_whom'] = '';
            this.candidateRecommendationModel[`name_${this.getLang}`] = '';
            this.candidateRecommendationModel[`position_${this.getLang}`] = '';
            this.candidateRecommendationModel['number'] = '';
            this.candidateRecommendationModel['file'] = '';
        },
        recommendationFileUpload(event){
            this.recommendationFile = event.target.files[0]
        },
        //axios
        async addWorkInfo(){
            const isFormCorrect = await this.v$.m.getWorkInformation.$validate()
            if (!isFormCorrect) return;
            let currentObj = this;
            axios({
                method: "post",
                url: "/add_work_information",
                data: {
                    'getWorkInformation': this.m.getWorkInformation,
                    'workInformationSchedule': this.workInformationSchedule,
                    'noFamilyWorkExperience': this.m.getWorkInformation.no_family_has_work_information,
                    'lang':this.getLang
                },

            })
            .then(function (response) {

                // handle success
                console.log('response.data',response.data);
                if (response.data.status == 200) {
                    if (response.data.data.message) {
                        toast.error(response.data.data.message, {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        return
                    }
                    toast.success("წარმატებით დაემატა", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    setTimeout(() => {
                        document.location.reload();
                    }, 1500);
                    // currentObj.saveRecomendationFile()
                }

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        addFamilyWorkExperience(){
            console.log('this.noticeFile',this.m.candidateFamilyWorkSkill);
            let currentObj = this;
            axios({
                method: "post",
                url: "/add_family_work_experience",
                data: this.m,

            })
            .then(function (response) {
                console.log('response.data',response.data);
                if (response.data.status == 200) {
                    if (response.data.data == 2) {
                        currentObj.swal()
                    }else{
                        currentObj.successToast('წარმატებით შეინახა')
                    }
                }

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        addRecomendationRule(){
            console.log('typeof', typeof this.candidateRecommendationModel);
            if (this.m.candidateRecommendation.length != 0 && this.m.candidateRecommendation[0].recommendation != this.candidateRecommendationModel.has_recommendation.id ) {
                this.$swal({
                    title: 'თქვენ უკვე შეავსეთ რეკომენდაციის ინფორმაცია თუ ამ ცვლილებას შეინახავთ წაიშლება წინა შევსებული ინფორმაცია. <br><p>გსურთ გაგრძელება?</p>',
                    showDenyButton: true,
                    confirmButtonText: 'კი',
                    denyButtonText: `არა`,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        this.addRecomendation()
                    } else if (result.isDenied) {
                    }
                })
            }
            if (this.m.candidateRecommendation.length == 0) {
                this.errorToast('რეკომენდაციის შესანახად აუცილებელია გამოიყენოთ დამატების ღილაკი')
                return;
            }
        },
        addRecomendation(){

            if (this.candidateRecommendationModel.has_recommendation.id == 2) {
                this.m.candidateRecommendation.push(this.candidateRecommendationModel)
            }
            // this.m.candidateRecommendation['lang'] = this.getLang
            console.log('this.m.candidateRecommendation',this.m.candidateRecommendation);
            let currentObj = this
            axios({
                method: "post",
                url: "/add_recommendation",
                data: this.m.candidateRecommendation,

            })
            .then(function (response) {
                console.log('response.data',response.data);
                if (response.data.status == 200) {
                    if (response.data.data == true) {
                        currentObj.saveRecommendationFile()
                    }else{
                        currentObj.swal()
                    }

                }

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })

        },
        saveRecommendationFile(){
            let currentObj = this;
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            axios.post('/add_recommendation_file', this.formData, config)
            .then(function (response) {
                console.log('response',response);
                if (response.data.status == 200) {
                    //  toast.success("ინფორმაცია წარმატებით დაემატა", {
                    //     theme: 'colored',
                    //     autoClose: 1000,
                    // });
                    // setTimeout(() => {
                    //     document.location.reload();
                    // }, 1500);
                    currentObj.swal()
                }
            })
            .catch(function (error) {
                console.log('error',error);
            // currentObj.output = error;
            });
        },

        //workInformation
        deleteWorkInformation(index, id){
            this.$swal({
                    title: 'ნამდვილად გსურთ წაშლა',
                    showDenyButton: true,
                    // showCancelButton: true,
                    confirmButtonText: 'კი',
                    denyButtonText: `არა`,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    const removed = this.m.workInformation.splice(index, 1);
                    axios.post('/delete_work_information' ,{
                        id:id
                    })
                    .then((response)=> {
                        console.log(response.data);
                        if (response.status == 200) {
                            toast.success("წარმატებით წაიშალა", {
                                theme: 'colored',
                                autoClose: 1000,
                            });
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                } else if (result.isDenied) {
                }
            })
        },
        editWorkInformation(item){
            this.editWorkInformationData = {
                'item':item,
                'classificatory': this.data.classificatory
            }
            this.showWorkInformation = !this.showWorkInformation
        },
        //recommendation Action
        removeRecommendation(index, id){
            this.$swal({
                title: 'ნამდვილად გსურთ წაშლა',
                showDenyButton: true,
                // showCancelButton: true,
                confirmButtonText: 'კი',
                denyButtonText: `არა`,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        const removed = this.m.candidateRecommendation.splice(index, 1);
                        axios.post('/remove_recommendation' ,{
                            id: id
                        })
                        .then((response)=> {
                            console.log(response.data);
                            if (response.status == 200) {
                                toast.success("წარმატებით წაიშალა", {
                                    theme: 'colored',
                                    autoClose: 1000,
                                });
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });

                    } else if (result.isDenied) {
                    }
                })

        },
        editRecommendation(item){
            this.showRecommendationEditModal = !this.showRecommendationEditModal;
            this.editRecommendationData = {
                'item': item,
                'classificatory': this.data.classificatory
            };
        },

        addCandidateWorkExperience(workExperience){
            // var workExperienceFind = _.find(this.data.classificatory.workExperiences, function(o) { return o.id == workExperience.work_experience_id; });
            // this.m.getWorkInformation['no_family_has_work_information'] = []
            this.m.getWorkInformation.no_family_has_work_information.push(JSON.parse(JSON.stringify(workExperience)))

            this.noFamilyWorkExperienceModel['object_ka'] = ''
            this.noFamilyWorkExperienceModel['object_en'] = ''
            this.noFamilyWorkExperienceModel['object_ru'] = ''
            this.noFamilyWorkExperienceModel['work_experience'] = ''
        },
        removeNWFE( index){
            const removed = this.m.getWorkInformation.no_family_has_work_information.splice(index, 1);

        },
        chooseNumberCode(code, iso){
            this.numberCode['phonecode'] = code;
            this.numberCode['iso'] = iso
        },
    },
    watch: {
        'm.familyWorkedSelected': function(newVal, oldVal){
            var arr = [];
            if (this.m.familyWorkedSelected.length == 0) {
                this.setSkill = []
            }else{
                this.m.familyWorkedSelected.forEach(element => {
                    arr.push(element.id)
                });

                console.log(this.m.familyWorkedSelected);
                console.log('arr',arr);
                let filteredX = this.data.classificatory.skill.filter(item => arr.includes(item.category_id));
                console.log('filteredX',filteredX);
                this.setSkill = filteredX

            }
        },
        'candidateRecommendationModel.has_recommendation': function (newVal, oldVa) {
            if (newVal.id == 2) {
                this.showNoReccomendation = true;
            }

            if (this.m.candidateRecommendation.length != 0 && this.m.candidateRecommendation[0].recommendation != newVal.id ) {
                this.$swal({
                    title: 'თქვენ უკვე შეავსეთ რეკომენდაციის ინფორმაცია თუ ამ ცვლილებას დაეთანხმებით ავტომატურად წაიშლება წინა შევსებული ინფორმაცია. <br><p>გსურთ გაგრძელება?</p>',
                    showDenyButton: true,
                    confirmButtonText: 'კი',
                    denyButtonText: `არა`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log('this.m', this.m.candidateRecommendation);
                        var idArr = [];
                        this.m.candidateRecommendation.forEach(element => {
                            idArr.push(element.id)
                            console.log('idArr',idArr);
                        });
                        axios.post('/trash_recommendation' ,{
                            id: idArr
                        })
                        .then((response)=> {
                            console.log('response.data', response.data);
                            if (response.status == 200) {
                                this.m.candidateRecommendation = [];
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    } else if (result.isDenied) {
                    }
                })
            }
            if(this.m.candidateRecommendation.length != 0 && this.m.candidateRecommendation[0].recommendation == 2 && newVal.id == 2){
                this.showNoReccomendation = false
                this.$swal({
                    title: '<p>თქვენ უკვე შეავსეთ რეკომენდაციის ინფორმაცია</p>',
                    icon: 'info',
                    html:
                        'ცვლილების შესატანად გამოიყენეთ რედაქტირების ღილაკი',
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false,
                    // confirmButtonText: 'შესავსებად გადასვლა',
                })
            }
            console.log('new', newVal.id);
        },
        'workInformationSchedule': function (newVal, oldVa) {
            console.log('newVal', newVal);
            this.showAdditionalSchedule = _.find(newVal, function(o) { if(o.id == 9) return true; });
        },
        'noFamilyWorkExperienceModel.has_experience.id': function(newVal, oldVa){
            if (newVal == 2) {
                this.showNoWorkExperience = true;
            }

            if(newVal == 1)this.showYesWorkExperience = true;

            console.log('newValue', newVal);
            // if (this.m.candidateWorkExperience.length != 0 && this.m.candidateWorkExperience[0].experience != newVal && newVal != '' && newVal != undefined) {
            //     this.$swal({
            //         title: 'თქვენ უკვე შეავსეთ ზოგადი სამუშაო ინფორმაცია თუ ამ ცვლილებას დაეთანხმებით ავტომატურად წაიშლება წინა შევსებული ინფორმაცია. <br><p>გსურთ გაგრძელება?</p>',
            //         showDenyButton: true,
            //         confirmButtonText: 'კი',
            //         denyButtonText: `არა`,
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             let currentObj = this
            //             axios.post('/remove_old_general_work_experience' ,{
            //                 id: this.m.candidateWorkExperience[0].id
            //             })
            //             .then((response)=> {
            //                 console.log('response.data', response.data);
            //                 if (response.status == 200) {
            //                     currentObj.m.candidateWorkExperience = [];
            //                 }
            //             })
            //             .catch(function (error) {
            //                 console.log(error);
            //             });
            //         } else if (result.isDenied) {
            //             this.showYesWorkExperience = false;
            //             this.noFamilyWorkExperienceModel.has_experience = '';
            //         }
            //     })
            // }
            // if(this.m.candidateWorkExperience.length != 0 && this.m.candidateWorkExperience[0].experience == 2 && newVal == 2){
            //     this.showNoWorkExperience = false
            //     this.noFamilyWorkExperienceModel.has_experience = '';
            //     this.$swal({
            //         title: '<p>თქვენ უკვე შეავსეთ ზოგადი სამუშაო ინფორმაცია</p>',
            //         icon: 'info',
            //         html:
            //             'ცვლილების შესატანად გამოიყენეთ რედაქტირების ღილაკი',
            //         showCloseButton: true,
            //         showCancelButton: false,
            //         focusConfirm: false,
            //         // confirmButtonText: 'შესავსებად გადასვლა',
            //     })
            // }
        }

        // 'm.familyWorkExperience.experience': function(newVal, oldVa){
        //     console.log('newVal', newVal);
        //     if (newVal.id == 2 ) {
        //         this.$swal(
        //         {
        //             title: '<p>შეგახსენებთ!!!</p>',
        //             icon: 'info',
        //             html:
        //                 'ჩვენი კლიენტები დასაქმების დროს ითვალისწინებელ სამუშაო გამოცდილებას ვინაიდან არ გაქვთ გამოცდილება გთხოვთ შეავსოთ გამოცდილების არ ქონის მიზეზი ',
        //             showCloseButton: true,
        //             showCancelButton: false,
        //             focusConfirm: false,
        //             // confirmButtonText: 'შესავსებად გადასვლა',
        //         })
        //     }
        // }
    },

    mounted() {
        // console.log('data', this.data);
    },

}
</script>

<style>


</style>
