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
                                <input
                                    class="form-control"
                                    v-model="m.personal_number"
                                    :class="{ 'is-invalid': (m.personal_number == null || v.personal_number.$error) }"
                                    type="text"
                                    placeholder=""
                                    @blur="v.personal_number.$touch"
                                >
                                <i class="fs-input-icon fa fa-user"></i>
                                <span v-if="!v.personal_number.required.$response" style='color:red'>* </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_personal_nationality') }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect
                                    v-model="m.nationality"
                                    :options="cla.nationality"
                                    deselect-label="Can't remove this value"
                                    :track-by="`name_${getLang}`"
                                    :label="`name_${getLang}`"
                                    placeholder="Select one"
                                    :searchable="true"
                                    :allow-empty="false"
                                    @blur="v.nationality.$touch"
                                >
                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                </multiselect>
                                <span v-if="!v.nationality.required.$response" style='color:red'>* </span>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_personal_citizenship') }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect
                                    v-model="m.citizenship"
                                    :options="cla.citizenship"
                                    :multiple="true"
                                    :close-on-select="false"
                                    :clear-on-select="false"
                                    :preserve-search="true"
                                    placeholder="Pick some"
                                    :label="`name_${getLang}`"
                                    :track-by="`name_${getLang}`"
                                    :preselect-first="false"
                                    @blur="v.citizenship.$touch"

                                >
                                    <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                </multiselect>
                                <span v-if="!v.citizenship.required.$response" style='color:red'>* </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_personal_religion') }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect
                                    v-model="m.religion"
                                    :options="cla.religions"
                                    deselect-label="Can't remove this value"
                                    :track-by="`name_${getLang}`"
                                    :label="`name_${getLang}`"
                                    placeholder="Select one"
                                    :searchable="true"
                                    :allow-empty="false"
                                    @blur="v.religion.$touch"
                                >
                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                </multiselect>
                                <span v-if="!v.religion.required.$response" style='color:red'>* </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_personal_education') }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect
                                    v-model="m.education"
                                    :options="cla.educations"
                                    deselect-label="Can't remove this value"
                                    :track-by="`name_${getLang}`"
                                    :label="`name_${getLang}`"
                                    placeholder="Select one"
                                    :searchable="true"
                                    :allow-empty="false"
                                    @blur="v.education.$touch"
                                >
                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                </multiselect>
                                <span v-if="!v.education.required.$response" style='color:red'>* </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>{{ $t('lang.user_profile_page_personal_profession') }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect
                                    v-model="m.professions"
                                    :options="cla.professions"
                                    :multiple="true"
                                    :close-on-select="false"
                                    :clear-on-select="false"
                                    :preserve-search="true"
                                    placeholder="Pick some"
                                    :label="`name_${getLang}`"
                                    :track-by="`name_${getLang}`"
                                    :preselect-first="false"
                                >
                                    <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                </multiselect>
                                <!-- <span v-if="!v.nationality.required.$response" style='color:red'>* </span> professions.required.$invalid && v.professions.$dirty" style='color:red'>* {{ v.professions.required.$message}}</span> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>{{ $t('lang.user_profile_page_personal_specialty') }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect
                                    v-model="m.specialty"
                                    :options="cla.specialties"
                                    :multiple="true"
                                    :close-on-select="false"
                                    :clear-on-select="false"
                                    :preserve-search="true"
                                    placeholder="Pick some"
                                    :label="`name_${getLang}`"
                                    :track-by="`name_${getLang}`"
                                    :preselect-first="false"
                                >
                                    <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                </multiselect>
                                <!-- <span v-if="!v.nationality.required.$response" style='color:red'>* </span> professions.required.$invalid && v.professions.$dirty" style='color:red'>* {{ v.professions.required.$message}}</span> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_personal_general_characters') }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect
                                    v-model="m.characteristic"
                                    :options="cla.characteristic"
                                    :multiple="true"
                                    :close-on-select="false"
                                    :clear-on-select="false"
                                    :preserve-search="true"
                                    placeholder="Pick some"
                                    :label="`name_${getLang}`"
                                    :track-by="`name_${getLang}`"
                                    :preselect-first="false"
                                    @blur="v.characteristic.$touch"
                                >
                                    <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                </multiselect>
                                <span v-if="!v.characteristic.required.$response" style='color:red'>* </span>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_personal_family') }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect
                                    v-model="m.marital_status"
                                    :options="cla.maritalStatus"
                                    deselect-label="Can't remove this value"
                                    :track-by="`name_${getLang}`"
                                    :label="`name_${getLang}`"
                                    placeholder="Select one"
                                    :searchable="true"
                                    :allow-empty="false"
                                    @blur="v.marital_status.$touch"
                                >
                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                </multiselect>
                                <span v-if="!v.marital_status.required.$response" style='color:red'>* </span>
                            </div>
                        </div>
                    </div>
                    <div v-if="m.marital_status && m.marital_status.id != 1 " class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>{{ $t('lang.user_profile_page_personal_family_children') }}</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="m.children" type="number" placeholder="">
                                <i class="fs-input-icon fa fa-user"></i>
                                <!-- <span v-if="!v.nationality.required.$response" style='color:red'>* </span>
                                <span v-if="!v.nationality.required.$response" style='color:red'>* </span> -->
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
                            <textarea class="form-control" v-model="m.spouse" rows="3" :placeholder="$t('lang.user_profile_page_personal_family_fill_info')" @blur="v.spouse.$touch"></textarea>
                            <span v-if="!v.spouse.maxLength.$response" style='color:red'>* </span>
                            <!-- " -->
                        </div>
                    </div>
                                <!-- Driving License -->
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <label>{{ $t('lang.user_profile_page_driving_license') }}</label>
                        <div class="ls-inputicon-box">
                            <multiselect v-model="m.driving_license"  :options="cla.drivingLicense" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name" track-by="name" :preselect-first="false" >
                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                            </multiselect>
                        </div>
                        <!-- <div class="driving_license">
                            <div v-for="(item, index) in cla.drivingLicense" :key="index"  class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" :id="item.name" :value="item.id" v-model="m.driving_license" >
                                <label class="form-check-label" :for="item.name">{{ item.name }}</label>
                            </div>
                        </div> -->
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
                                <multiselect v-model="m.allergy"  :options="cla.allergies" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" :label="`name_${getLang}`" :track-by="`name_${getLang}`" :preselect-first="false">
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
                            <input class="form-control" v-model="m.height" type="text" placeholder="65K" @blur="v.height.$touch">
                            <i class="fs-input-icon fa fa-arrows-alt-v" aria-hidden="true"></i>
                            <span v-if="!v.height.numeric.$response" style='color:red'>* </span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group city-outer-bx has-feedback">
                        <label>{{ $t('lang.user_profile_page_additional_weight') }}</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control" v-model="m.weight" type="text" placeholder="75K" @blur="v.weight.$touch">
                            <i class="fs-input-icon fa fa-arrows-alt-h"></i>
                            <span v-if="!v.weight.numeric.$response" style='color:red'>* </span>
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

                <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                    <button type="submit" @click.prevent="validateAndSubmit()"  class="site-button">{{ $t((!updateButton)?'lang.user_profile_page_social_button_save': 'ცვლილების შენახვა') }}</button>
                </div>


            </div>

        </div>
    </div>
</template>
<script>
import { ref, computed, watch } from 'vue';
import { I18n } from 'laravel-vue-i18n';
import { useVuelidate } from '@vuelidate/core';
import { required, numeric, maxLength } from '@vuelidate/validators';

export default {
    emits: ['validateAndEmit'],
    props: {
        data: Object,
    },
    setup(props, { emit }) {
        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });


        const cla = ref(props.data.cla)
        const formData = { ...props.data.model };
        formData.user_id = props.data.user_id;
        formData.lang = getLang;
        if (formData.convection == 1) {
            formData.convection = true
        }
        if (formData.smoke == 1) {
            formData.smoke = true
        }
        if (formData.work_abroad == 1) {
            formData.work_abroad = true
        }
        const m = ref(formData);

        const rules = {
            personal_number: { required },
            nationality: { required },
            religion: { required },
            education: { required },
            marital_status: { required },
            spouse: {maxLength: maxLength(150)},
            citizenship: { required },
            characteristic: { required },
            height: { numeric },
            weight: { numeric },
        };

        const v = useVuelidate(rules, m);

        const updateButton = () =>v.value.$invalid ? false: true
        const validateAndSubmit = () => {
            v.value.$touch();
            if (!v.value.$invalid) {


                axios({
                    method: "post",
                    url: "/add_candidate",
                    data: {'model':m.value, 'type': 'information'},
                })
                .then(function (response) {
                    // handle success
                    if (response.status == 200) {
                        toast.success("ინფორმაცია წარმატებით შეინახა", {
                            theme: 'colored',
                            autoClose: 2000,
                        });
                    }


                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            }else{
                toast.warning("აუცილებელია სავალდებულო ველები იყოს შევსებული", {
                    theme: 'colored',
                    autoClose: 2000,
                });
            }
        };
        const validateAndEmit = () => {
            const isFormValid = !v.value.$invalid;
            emit("validateAndEmit", isFormValid);
        }


        return {
            m,
            cla,
            validateAndSubmit,
            v,
            getLang,
            validateAndEmit,
            updateButton
        };
    },
};
</script>
