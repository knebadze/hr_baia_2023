<template lang="">
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
                            <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_personal_number') }}</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="m.personal_number" type="text" placeholder=""  @blur="v$.m.personal_number.$touch">
                                <i class="fs-input-icon fa fa-user"></i>
                                <span v-if="v$.m.personal_number.required.$invalid && v$.m.personal_number.$dirty" style='color:red'>* {{ v$.m.personal_number.required.$message}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_personal_nationality') }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="m.nationality" :options="data.classificatory.nationality" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false" @blur="v$.m.nationality.$touch">
                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                </multiselect>
                                <span v-if="v$.m.nationality.required.$invalid && v$.m.nationality.$dirty" style='color:red'>* {{ v$.m.nationality.required.$message}}</span>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_personal_citizenship') }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="m.candidateCitizenships"  :options="data.classificatory.citizenship" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" :label="`name_${getLang}`" :track-by="`name_${getLang}`" :preselect-first="false" @blur="v$.m.candidateCitizenships.$touch">
                                    <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                </multiselect>
                                <span v-if="v$.m.candidateCitizenships.required.$invalid && v$.m.candidateCitizenships.$dirty" style='color:red'>* {{ v$.m.candidateCitizenships.required.$message}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_personal_religion') }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="m.religion" :options="data.classificatory.religions" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false" @blur="v$.m.religion.$touch">
                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                </multiselect>
                                <span v-if="v$.m.religion.required.$invalid && v$.m.religion.$dirty" style='color:red'>* {{ v$.m.religion.required.$message}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_personal_education') }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="m.education" :options="data.classificatory.educations" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false" @blur="v$.m.education.$touch">
                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                </multiselect>
                                <span v-if="v$.m.education.required.$invalid && v$.m.education.$dirty" style='color:red'>* {{ v$.m.education.required.$message}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>{{ $t('lang.user_profile_page_personal_profession') }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="m.candidateProfessions"  :options="data.classificatory.professions" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" :label="`name_${getLang}`" :track-by="`name_${getLang}`" :preselect-first="false" >
                                    <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                </multiselect>
                                <!-- <span v-if="v$.m.candidateProfessions.required.$invalid && v$.m.candidateProfessions.$dirty" style='color:red'>* {{ v$.m.candidateProfessions.required.$message}}</span> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>{{ $t('lang.user_profile_page_personal_specialty') }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="m.candidateSpecialties"  :options="data.classificatory.specialties" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" :label="`name_${getLang}`" :track-by="`name_${getLang}`" :preselect-first="false" >
                                    <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                </multiselect>
                                <!-- <span v-if="v$.m.candidateProfessions.required.$invalid && v$.m.candidateProfessions.$dirty" style='color:red'>* {{ v$.m.candidateProfessions.required.$message}}</span> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_personal_general_characters') }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="m.candidateCharacteristic"  :options="data.classificatory.characteristic" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" :label="`name_${getLang}`" :track-by="`name_${getLang}`" :preselect-first="false" @blur="v$.m.candidateCharacteristic.$touch">
                                    <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                </multiselect>
                                <span v-if="v$.m.candidateCharacteristic.required.$invalid && v$.m.candidateCharacteristic.$dirty" style='color:red'>* {{ v$.m.candidateCharacteristic.required.$message}}</span>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_personal_family') }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="m.marital_status" :options="data.classificatory.maritalStatus" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false" @blur="v$.m.marital_status.$touch">
                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                </multiselect>
                                <span v-if="v$.m.marital_status.required.$invalid && v$.m.marital_status.$dirty" style='color:red'>* {{ v$.m.marital_status.required.$message}}</span>
                            </div>
                        </div>
                    </div>
                    <div v-if="m.marital_status && m.marital_status.id != 1 " class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>{{ $t('lang.user_profile_page_personal_family_children') }}</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="m.children" type="number" placeholder="" @blur="v$.m.children.$touch">
                                <i class="fs-input-icon fa fa-user"></i>
                                <span v-if="v$.m.children.numeric.$invalid && v$.m.children.$dirty" style='color:red'>* {{ v$.m.children.numeric.$message}}</span>
                                <span v-if="v$.m.children.maxLength.$invalid && v$.m.children.$dirty" style='color:red'>* {{ v$.m.children.maxLength.$message}}</span>
                            </div>
                        </div>
                    </div>
                    <div v-if="m.marital_status && m.marital_status.id != 1 && m.children && m.children != 0" class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>{{ $t('lang.user_profile_page_personal_children_age') }}</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="m.children_age" type="text" placeholder="მაგ: 10,14" onkeypress="return /[0-9,]/i.test(event.key)">
                                <i class="fs-input-icon fa fa-user"></i>
                            </div>
                        </div>
                    </div>
                    <div v-if="m.marital_status && m.marital_status.id == 2 " class="col-md-12">
                        <div class="form-group">
                            <label>{{ $t('lang.user_profile_page_personal_family_spouse') }}</label>
                            <textarea class="form-control" v-model="m.spouse" rows="3" :placeholder="$t('lang.user_profile_page_personal_family_fill_info')" @blur="v$.m.spouse.$touch"></textarea>
                            <span v-if="v$.m.spouse.maxLength.$invalid && v$.m.spouse.$dirty" style='color:red'>* {{ v$.m.spouse.maxLength.$message}}</span>
                            <!-- " -->
                        </div>
                    </div>
                                <!-- Driving License -->
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <label>{{ $t('lang.user_profile_page_driving_license') }}</label>
                        <div class="driving_license">
                            <div v-for="category in data.classificatory.drivingLicense" class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="driving_license_a" :value="category.id" v-model="m.candidateDrivingLicense" >
                                <label class="form-check-label" for="driving_license_a">{{ category.name }}</label>
                            </div>
                        </div>
                    </div>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{ $t('lang.user_profile_page_medical_alergy') }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="m.candidateAllergies"  :options="data.classificatory.allergies" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" :label="`name_${getLang}`" :track-by="`name_${getLang}`" :preselect-first="false">
                                    <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                </multiselect>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{ $t('lang.user_profile_page_medical_operation') }}</label>
                            <textarea class="form-control" rows="3" v-model="m[`medical_info_${getLang}`]" :placeholder="$t('lang.user_profile_page_medical_please_info')"></textarea>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <!-- address -->
    <div class="panel panel-default">
        <div class="panel-heading wt-panel-heading p-a20">
            <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_address') }}</h4>
        </div>
        <div class="panel-body wt-panel-body p-a20 m-b30 ">
            <p>{{ $t('lang.user_profile_page_address_map') }}</p>
            <p>{{ $t('lang.user_profile_page_address_map_2') }}</p>
            <div class="row">
                <!-- <address_maplibre></address_maplibre> -->
                <!-- <addressMap :data="m.address" @messageFromChild="childMessage"></addressMap> -->
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_address') }}</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control" v-model="m[`address_${getLang}`]" type="text" placeholder=""  @blur="v$.m[`address_${getLang}`].$touch">
                            <i class="fs-input-icon fa fa-user"></i>
                            <span v-if="v$.m[`address_${getLang}`].required.$invalid && v$.m[`address_${getLang}`].$dirty" style='color:red'>* {{ v$.m[`address_${getLang}`].required.$message}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ $t('lang.user_profile_page_street') }}</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control" v-model="m[`street_${getLang}`]" type="text" placeholder=""  >
                            <i class="fs-input-icon fa fa-user"></i>
                        </div>
                    </div>
                </div>

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
                            <input class="form-control" v-model="m.height" type="text" placeholder="65K" @blur="v$.m.height.$touch">
                            <i class="fs-input-icon fa fa-arrows-alt-v" aria-hidden="true"></i>
                            <span v-if="v$.m.height.numeric.$invalid && v$.m.height.$dirty" style='color:red'>* {{ v$.m.height.numeric.$message}}</span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group city-outer-bx has-feedback">
                        <label>{{ $t('lang.user_profile_page_additional_weight') }}</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control" v-model="m.weight" type="text" placeholder="75K" @blur="v$.m.weight.$touch">
                            <i class="fs-input-icon fa fa-arrows-alt-h"></i>
                            <span v-if="v$.m.weight.numeric.$invalid && v$.m.weight.$dirty" style='color:red'>* {{ v$.m.weight.numeric.$message}}</span>
                        </div>

                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">

                        <div class="ls-inputicon-box">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" v-model="m.convection" id="flexCheckDefault">
                                <label>{{ 'ნასამართლევი ხართ?' }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group form-check">

                        <div class="ls-inputicon-box">

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" v-model="m.smoke" id="flexCheckDefault">
                                <label>{{ $t('lang.user_profile_page_additional_smoke') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">

                        <div class="ls-inputicon-box">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" v-model="m.work_abroad" id="flexCheckDefault">
                                <label>{{ $t('lang.user_profile_page_additional_work_abroad') }}</label>
                            </div>
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
                            <input class="form-control wt-form-control" v-model="m.fb_link"  type="text" placeholder="https://www.facebook.com/">
                            <i class="fs-input-icon fab fa-facebook-f"></i>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ $t('lang.user_profile_page_social_youtube') }}</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control wt-form-control" v-model="m.youtube_link" type="text" placeholder="https://www.youtube.com/">
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
</template>
<script>
export default {
    props:{
        data: Object
    },
    data() {
        return {
            m:{}
        }
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
    },
    created(){

    },
    methods: {

    },
    watch:{

    }
}
</script>
<style lang="">

</style>
