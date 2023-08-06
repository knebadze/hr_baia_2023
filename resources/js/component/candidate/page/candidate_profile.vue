<template lang="">
    <div class="col-xl-9 col-lg-8 col-md-12 m-b30 employerPageBorder">
        <!--Filter Short By-->
        <div class="twm-right-section-panel site-bg-gray">
            <!-- <form> -->


            <main_info :data="m.user" :genderCLA="data.classificatory.gender"></main_info>


            <!--personal information-->
            <candidate_information></candidate_information>




                            <!--უცხო ენები-->
                 <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_foreign_lang_title') }}</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">
                        <p class="text-danger">* {{ $t('lang.user_profile_page_foreign_lang_language_comiitment') }}</p>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_foreign_lang_language') }}</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="languages" :options="data.classificatory.languages" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_foreign_lang_level') }}</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="languageLevels" :options="data.classificatory.languageLevels" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="text-right ">
                                    <button class="btn btn-success"
                                    @click="addLanguage(languages, languageLevels)"
                                    title="დამატება" data-bs-toggle="tooltip"
                                    data-bs-placement="top">{{ $t('lang.user_profile_page_foreign_lang_button_add_info') }}
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                            </div>
                            <div v-if="m.candidateLanguages.length != 0" :class="languageTableClass">
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
                        <p class="text-danger">{{ $t('lang.user_profile_page_work_exp_please_feel') }} </p>
                        <div class="row">
                            <div class=" col-md-12">
                                <div class="form-group">
                                    <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_exp_experience') }}</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="candidateWorkExperienceModel.has_experience" :options="data.classificatory.yesNo" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false" >
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                        <!-- <span v-if="v$.candidateWorkExperienceModel.has_experience.required.$invalid && v$.candidateWorkExperienceModel.has_experience.$dirty" style='color:red'>* {{ v$.candidateWorkExperienceModel.has_experience.required.$message}}</span> -->
                                    </div>
                                </div>
                            </div>
                            <div class="row" v-if="showYesWorkExperience">
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_exp') }}</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="candidateWorkExperienceModel.work_experience" :options="data.classificatory.workExperiences" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false" >
                                                <template slot="singleLabel" slot-scope="{ option }"></template>
                                            </multiselect>
                                            <!-- <span v-if="v$.candidateWorkExperienceModel.work_experience.required.$invalid && v$.candidateWorkExperienceModel.work_experience.$dirty" style='color:red'>* {{ v$.candidateWorkExperienceModel.work_experience.required.$message}}</span> -->
                                        </div>
                                    </div>
                                </div>
                                <div  class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_position') }}</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="candidateWorkExperienceModel[`position_${getLang}`]" type="text" placeholder="" >
                                            <i class="fs-input-icon fa fa-tasks"></i>
                                            <!-- <span v-if="v$.candidateWorkExperienceModel[`position_${getLang}`].required.$invalid && v$.candidateWorkExperienceModel[`position_${getLang}`].$dirty" style='color:red'>* {{ v$.candidateWorkExperienceModel[`position_${getLang}`].required.$message}}</span> -->
                                        </div>
                                    </div>
                                </div>
                                <div  class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_object') }}</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="candidateWorkExperienceModel[`object_${getLang}`]" type="text" placeholder="" >
                                            <i class="fs-input-icon fa fa-map-marker"></i>
                                            <!-- <span v-if="v$.candidateWorkExperienceModel[`object_${getLang}`].required.$invalid && v$.candidateWorkExperienceModel[`object_${getLang}`].$dirty" style='color:red'>* {{ v$.candidateWorkExperienceModel[`object_${getLang}`].required.$message}}</span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" v-if="showNoWorkExperience">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>სამუშაო გამოცდილების არ ქონის მიზეზი</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="candidateWorkExperienceModel.no_reason" :options="data.classificatory.noExperienceReason" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                                <template slot="singleLabel" slot-scope="{ option }"></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>დამატაბითი ინფორმაცია</label>
                                        <textarea class="form-control" rows="3" v-model="candidateWorkExperienceModel[`no_reason_info_${getLang}`]" :placeholder="$t('lang.user_profile_page_medical_please_info')"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div v-if="showYesWorkExperience" class="col-lg-12 col-md-12">
                                <div class="text-right ">
                                    <button class="btn btn-success"
                                    @click="addCandidateWorkExperience(candidateWorkExperienceModel)"
                                    title="დამატება" data-bs-toggle="tooltip" data-bs-placement="top">{{ $t('lang.user_profile_page_work_button_add_info') }}
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                            </div>

                            <div v-if="m.candidateWorkExperience.length != 0" class="col-lg-12 col-md-12">

                                <div class="panel-body wt-panel-body">
                                    <div class="p-a20 table-responsive">
                                        <table class="table twm-table table-striped table-borderless" v-if="m.candidateWorkExperience[0].has_experience.id == 1">
                                            <thead>
                                                <tr>
                                                <th>N</th>
                                                <th>{{ $t('lang.user_profile_page_work_exp') }}</th>
                                                <th>{{ $t('lang.user_profile_page_work_position') }}</th>
                                                <th>{{ $t('lang.user_profile_page_work_object') }}</th>
                                                <th>{{ $t('lang.user_profile_page_work_actions') }}</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(item, index) in m.candidateWorkExperience">
                                                <td>{{ index + 1 }}</td>
                                                <td>{{ (item.work_experience)?item.work_experience[`name_${getLang}`]:'' }}</td>
                                                <td>{{ item[`position_${getLang}`] }}</td>
                                                <td>{{ item[`object_${getLang}`] }}</td>
                                                <td>
                                                    <button @click="removeRow('experience',index)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table twm-table table-striped table-borderless" v-if="m.candidateWorkExperience[0].has_experience.id == 2">
                                            <thead>
                                                <tr>

                                                <th>არ ქონის მიზეზი</th>
                                                <th>დამატებითი ინფორმაცია</th>
                                                <th>action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(item, index) in m.candidateWorkExperience">
                                                    <td>{{ item.no_reason[`name_${getLang}`] }}</td>
                                                    <td>{{(item[`no_reason_info_${getLang}`])?item[`no_reason_info_${getLang}`].substr(0, 30)+ '...':''  }}</td>
                                                <td>
                                                    <button @click="removeRow('experience',index)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <i class="fa fa-pen"></i>
                                                    </button>
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



                 <!--დამატებითი ნომრები-->
                 <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_title') }}</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_number') }}</label>
                                    <div class="input-group mb-3">
                                    <button style="border-style: none;" class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span :class="`fi fi-${numberCode.iso.toLowerCase()}`"></span>+{{ numberCode.phonecode }}</button>
                                    <ul class="dropdown-menu" style=" overflow: hidden; overflow-y: auto; max-height: calc(100vh - 550px);">
                                        <li v-for="item in data.classificatory.numberCode" @click="chooseNumberCode(item.phonecode, item.iso.toLowerCase())"><a class="dropdown-item"><span :class="`fi fi-${item.iso.toLowerCase()}`"></span>+{{ item.phonecode }}</a></li>
                                    </ul>
                                    <input type="text" class="form-control" aria-label="Text input with dropdown button" v-model="candidateNumberModel.number" placeholder="555666777" onkeypress="return /[0-9]/i.test(event.key)" @blur="v$.candidateNumberModel.number.$touch">
                                    <span v-if="v$.candidateNumberModel.number.numeric.$invalid && v$.candidateNumberModel.number.$dirty" style='color:red'>* {{ v$.candidateNumberModel.number.numeric.$message}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_number_owner') }}</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="candidateNumberModel.number_owner" :options="data.classificatory.numberOwner" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false" @blur="v$.candidateNumberModel.number_owner.$touch">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                        <!-- <span v-if="v$.candidateNumberModel.number_owner.required.$invalid && v$.candidateNumberModel.number_owner.$dirty" style='color:red'>* {{ v$.candidateNumberModel.number_owner.required.$message}}</span> -->
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="text-right ">
                                    <button class="btn btn-success"
                                    @click="addNumber(numberCode, candidateNumberModel)"
                                    title="Add Number" data-bs-toggle="tooltip"
                                    data-bs-placement="top">{{ $t('lang.user_profile_page_foreign_lang_button_add_info') }}
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                            </div>
                            <div v-if="m.candidateNumber.length != 0" class="col-lg-12 col-md-12">
                                <div class="panel-body wt-panel-body">
                                    <div class="p-a20 table-responsive">
                                        <table class="table twm-table table-striped table-borderless">
                                            <thead>
                                                <tr>
                                                <th>N</th>
                                                <th>{{ $t('lang.user_profile_page_work_number_code') }}</th>
                                                <th>{{ $t('lang.user_profile_page_number') }}</th>
                                                <th>{{ $t('lang.user_profile_page_number_owner') }}</th>
                                                <th>{{ $t('lang.user_profile_page_work_number_actions') }}</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <!--1-->
                                                <tr v-for="(item, index) in m.candidateNumber">
                                                <td>{{ index + 1 }}</td>
                                                <td>+{{ item.number_code.phonecode }}</td>
                                                <td>{{ item.number }}</td>
                                                <td>{{ item.number_owner[`name_${getLang}`] }}</td>
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
                                    <multiselect v-model="candidateNoticeModel.notice" :options="data.classificatory.notices" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
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
                                            <th>{{ $t('lang.user_profile_page_references_reference') }}</th>
                                            <th>{{ $t('lang.user_profile_page_references_file') }}</th>
                                            <th>{{ $t('lang.user_profile_page_references_action') }}</th>
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
import main_info from '../component/main_info.vue'
import candidate_information from '../component/candidate_information.vue'
// import mainInfo from '../component/mainInfo.vue'
import { I18n } from 'laravel-vue-i18n'
// import miniTable from './miniTable.vue'
import _ from 'lodash'
import { useVuelidate } from '@vuelidate/core'
import { required, email, helpers, requiredIf, numeric, maxLength } from '@vuelidate/validators'
// import addressMap from '../map/address_map.vue'
// import addressGoogleMap from '../map/address_google_map.vue'
// import address_maplibre from '../map/address_maplibre.vue'
import { uuid } from 'vue-uuid'

export default {
    setup () {
        return { v$: useVuelidate() }
    },
    components:{
        main_info,
        candidate_information
        // miniTable,
        // mainInfo,
        // addressMap,
        // addressGoogleMap,
        // address_maplibre
    },
    props:{
        data:Object
    },
    data() {
        return {
            uuid: uuid.v1(),
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
                'has_experience':'',
                'work_experience':'',
                'position_ka':'',
                'position_en':'',
                'position_ru':'',
                'object_ka':'',
                'object_en':'',
                'object_ru':'',
                'no_reason':'',
                'no_reason_info_ka':'',
                'no_reason_info_en':'',
                'no_reason_info_ru':'',
            },
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
                'number_owner':'',
            },
            candidate_id: null,
            showNoWorkExperience: false,
            showYesWorkExperience: false

        }
    },
    // validations () {
    //     const validations = {
    //         m:{
    //             auth:{
    //                 number: {
    //                     required: helpers.withMessage('შევსება სავალდებულოა', required ),
    //                     numeric: helpers.withMessage('ნომერი უნდა შედგებოდეს მხოლოდ ციფრებისგან', numeric ),
    //                     maxLength: helpers.withMessage('ნომერი უნდა შედგებოდეს 9 ციფრებისგან', maxLength(9) )
    //                 },
    //                 gender_id: {required: helpers.withMessage('სქესის არჩევა სავალდებულოა', required )},
    //                 date_of_birth: {required: helpers.withMessage('დაბადების თარიღის შევსება სავალდებულოა', required )}

    //             },
    //             candidate:{
    //                 personal_number: { required: helpers.withMessage('შევსება სავალდებულოა', required)},
    //                 nationality: { required: helpers.withMessage('არჩევა სავალდებულოა', required)},
    //                 religion: { required: helpers.withMessage('არჩევა სავალდებულოა', required) },
    //                 education: { required: helpers.withMessage('არჩევა სავალდებულოა', required) },
    //                 marital_status: { required: helpers.withMessage('არჩევა სავალდებულოა', required) },
    //                 children: {
    //                     numeric: helpers.withMessage('უნდა შედგებოდეს მხოლოდ ციფრებისგან', numeric ),
    //                     maxLength: helpers.withMessage('დასაშვებია 2 ციფრი', maxLength(2) )
    //                 },
    //                 spouse: { maxLength: helpers.withMessage('დასაშვებია 150 სიმბოლო', maxLength(150) ) },
    //                 address_ka:{},
    //                 address_en:{},
    //                 address_ru:{},
    //                 height: { numeric: helpers.withMessage('უნდა შედგებოდეს მხოლოდ ციფრებისგან', numeric ) },
    //                 weight: { numeric: helpers.withMessage('უნდა შედგებოდეს მხოლოდ ციფრებისგან', numeric ) },
    //             },
    //             candidateCitizenships: { required: helpers.withMessage('არჩევა სავალდებულოა', required) },
    //             candidateCharacteristic: { required: helpers.withMessage('არჩევა სავალდებულოა', required) }
    //             // candidateProfessions: { required: helpers.withMessage('არჩევა სავალდებულოა', required) },
    //         },
    //         candidateNumberModel:{
    //             number:{numeric: helpers.withMessage('უნდა შედგებოდეს მხოლოდ ციფრებისგან', numeric )},
    //             number_owner:{}
    //         }
    //     }

    //     if (this.getLang == 'ka') {
    //         validations.m.candidate.address_ka = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
    //     }else if(this.getLang == 'en'){
    //         validations.m.candidate.address_en = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
    //     }else if(this.getLang == 'ru'){
    //         validations.m.candidate.address_ru = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
    //     }


    //     if (this.candidateNumberModel.number != '') {
    //         validations.candidateNumberModel.number_owner = { required: helpers.withMessage('არჩევა სავალდებულოა', required) }
    //     }
    //     return validations
    // },
    created(){
        this.m = { ...this.data.model, ...this.data.basic };
        if (this.m.candidate.convction == 1) {
            this.m.candidate.convction = true
        }
        if (this.m.candidate.smoke == 1) {
            this.m.candidate.smoke = true
        }
        if (this.m.candidate.work_abroad == 1) {
            this.m.candidate.work_abroad = true
        }
        console.log('this.m.', this.data);
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
            if (!isFormCorrect) return;
            if (this.candidateWorkExperienceModel.has_experience.id == 2) {
                this.m.candidateWorkExperience.push(this.candidateWorkExperienceModel)
            }
            this.m['lang'] = this.getLang
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
            console.log('this.candidateID', this.candidateID);
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
            var arr = [this.candidateNoticeModel.notice.id, event.target.files[0]]
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
            this.language = '';
            this.languageLevels = '';
        },
        addCandidateWorkExperience(workExperience){
            console.log('workExperience',JSON.parse(JSON.stringify(workExperience)));
            var data = JSON.parse(JSON.stringify(workExperience))
            if (data.has_experience.id == 1 && (data.work_experience == '' || data[`position_${this.getLang}`] == '' || data[`object_${this.getLang}`]== '')) {
                toast.error("სამუშაო გამოცდილების ყველ ველის შევსება სავალდებულოა", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                return;
            }
            // var workExperienceFind = _.find(this.data.classificatory.workExperiences, function(o) { return o.id == workExperience.work_experience_id; });
            this.m.candidateWorkExperience.push(data)
            this.candidateWorkExperienceModel['work_experience'] = ''
            this.candidateWorkExperienceModel[`position_${this.getLang}`] = ''
            this.candidateWorkExperienceModel[`object_${this.getLang}`] = ''
        },
        addNotice(notice){
            // var noticeFind = _.find(this.data.classificatory.notices, function(o) { return o.id == notice.notice_id; });
            // notice['notice'] = noticeFind;
            notice['file'] = this.noticeFile.name
            this.upsert(this.m.candidateNotices, notice, "notice");
        },
        chooseNumberCode(code, iso){
            this.numberCode['phonecode'] = code;
            this.numberCode['iso'] = iso
        },
        addNumber(code, model){
            var numberCodeId = _.find(this.data.classificatory.numberCode, function(o) { return o.phonecode == code.phonecode; });
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
        },
        childMessage(arg){
            this.m.candidate[`address_${this.getLang}`] = arg.name
            this.m.candidate.latitude = arg.lngLat.lat
            this.m.candidate.longitude = arg.lngLat.lng
            console.log('this.m.candidate.latitude', this.m.candidate.latitude);
        }
    },
    watch:{
        'candidateWorkExperienceModel.has_experience.id': function(newVal, oldVa){
            console.log();
            if (newVal == 2) {
                this.showNoWorkExperience = true;
                this.showYesWorkExperience = false;
            }

            if(newVal == 1){
                this.showYesWorkExperience = true;
                this.showNoWorkExperience = false;
            }

            console.log('this.showNoWorkExperience',this.showYesWorkExperience);
            console.log('newValue', newVal);
            if (this.m.candidateWorkExperience.length != 0 && this.m.candidateWorkExperience[0].experience != newVal && newVal != '' && newVal != undefined) {
                this.$swal({
                    title: 'თქვენ უკვე შეავსეთ ზოგადი სამუშაო ინფორმაცია თუ ამ ცვლილებას დაეთანხმებით ავტომატურად წაიშლება წინა შევსებული ინფორმაცია. <br><p>გსურთ გაგრძელება?</p>',
                    showDenyButton: true,
                    confirmButtonText: 'კი',
                    denyButtonText: `არა`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let currentObj = this
                        axios.post('/remove_old_general_work_experience' ,{
                            id: this.m.candidateWorkExperience[0].id
                        })
                        .then((response)=> {
                            console.log('response.data', response.data);
                            if (response.status == 200) {
                                currentObj.m.candidateWorkExperience = [];
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    } else if (result.isDenied) {
                        this.showYesWorkExperience = false;
                        this.candidateWorkExperienceModel.has_experience = '';
                    }
                })
            }
            if(this.m.candidateWorkExperience.length != 0 && this.m.candidateWorkExperience[0].experience == 2 && newVal == 2){
                this.showNoWorkExperience = false
                this.candidateWorkExperienceModel.has_experience = '';
                this.$swal({
                    title: '<p>თქვენ უკვე შეავსეთ ზოგადი სამუშაო ინფორმაცია</p>',
                    icon: 'info',
                    html:
                        'ცვლილების შესატანად გამოიყენეთ რედაქტირების ღილაკი',
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false,
                    // confirmButtonText: 'შესავსებად გადასვლა',
                })
            }
        }
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
