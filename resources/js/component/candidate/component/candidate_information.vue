<template lang="">
    <form @submit.prevent="validateAndEmit()">
        <div class="panel panel-default">
            <div class="panel-heading wt-panel-heading p-a20">
                <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_input_basic_info') }}</h4>
                <!-- $t('lang.user_profile_page_personal_info') -->
            </div>
            <div class="panel-body wt-panel-body p-a20 m-b30 ">

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

                                    <span v-if="send && !v.personal_number.required.$response" style='color:red'>* </span>
                                    <span v-if="send && !v.personal_number.numeric.$response" style='color:red'>* </span>
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
                                    <span v-if="send && !v.nationality.required.$response" style='color:red'>* </span>

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
                                    <span v-if="send && !v.citizenship.required.$response" style='color:red'>* </span>
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
                                    <span v-if="send && !v.religion.required.$response" style='color:red'>* </span>
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
                                    <span v-if="send && !v.education.required.$response" style='color:red'>* </span>
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
                                    <span v-if="send && !v.characteristic.required.$response" style='color:red'>* </span>
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
                                    <span v-if="send && !v.marital_status.required.$response" style='color:red'>* </span>
                                </div>
                            </div>
                        </div>
                        <div v-if="m.marital_status && m.marital_status.id != 1 " class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.user_profile_page_personal_family_children') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" @input="children(m.children)" v-model="m.children" type="number" placeholder="">
                                    <!-- <i class="fs-input-icon fa fa-user"></i> -->
                                    <!-- <span v-if="!v.nationality.required.$response" style='color:red'>* </span>
                                    <span v-if="!v.nationality.required.$response" style='color:red'>* </span> -->
                                </div>
                            </div>
                        </div>
                        <div class=" col-xl-12 col-lg-12 col-md-12" v-if="m.marital_status && m.marital_status.id != 1 && m.children && m.children >= 0">
                            <childe_age

                                :age="m.children_age"
                                :childe="m.children"
                                @childrenAgeEmit="getChildrenAge"
                            ></childe_age>
                        </div>

                        <!-- <div v-if="m.marital_status && m.marital_status.id != 1 && m.children && m.children != 0" class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.user_profile_page_personal_children_age') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.children_age" type="text" placeholder="მაგ: 10,14" onkeypress="return /[0-9,]/i.test(event.key)">
                                    <i class="fs-input-icon fa fa-user"></i>
                                </div>
                            </div>
                        </div> -->
                        <div v-if="m.marital_status && m.marital_status.id == 2 " class="col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.user_profile_page_personal_family_spouse') }}</label>
                                <textarea class="form-control" v-model="m.spouse" rows="3" :placeholder="$t('lang.user_profile_page_personal_family_fill_info')" @blur="v.spouse.$touch"></textarea>
                                <span v-if="send && !v.spouse.maxLength.$response" style='color:red'>* </span>
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
                                <input class="form-control" @input="height(m.height)" v-model="m.height" type="number" placeholder="165" @blur="v.height.$touch">
                                <!-- <i class="fs-input-icon fa fa-arrows-alt-v" aria-hidden="true"></i> -->
                                <span v-if="send && !v.height.numeric.$response" style='color:red'>* </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group city-outer-bx has-feedback">
                            <label>{{ $t('lang.user_profile_page_additional_weight') }}</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" @input="weight(m.weight)" v-model="m.weight" type="number" placeholder="75" @blur="v.weight.$touch">
                                <!-- <i class="fs-input-icon fa fa-arrows-alt-h"></i> -->
                                <span v-if="send && !v.weight.numeric.$response" style='color:red'>* </span>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-group">

                            <div class="ls-inputicon-box">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" v-model="m.convection" id="flexCheckDefault">
                                    <label>{{ 'ნასამართლევი' }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-group form-check">

                            <div class="ls-inputicon-box">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" v-model="m.smoke" id="flexCheckDefault">
                                    <label>{{ $t('მწეველი') }}</label>
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

                    <!-- <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                        <button type="submit" @click.prevent="validateAndSubmit()"  class="site-button">{{ $t((!updateButton)?'lang.user_profile_page_social_button_save': 'ცვლილების შენახვა') }}</button>
                    </div> -->


                </div>

            </div>
        </div>
    </form>
</template>
<script>
import { ref, computed, watch } from 'vue';
import { I18n } from 'laravel-vue-i18n';
import { useVuelidate } from '@vuelidate/core';
import { required, numeric, maxLength } from '@vuelidate/validators';
import childe_age from './input/childe_age.vue'
export default {
    emits: ['validateAndEmit'],
    components:{
        childe_age
    },
    props: {
        data: Object,
    },
    setup(props, { emit }) {
        console.log(props.data);
        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });
        let m_height, m_weight = null;
        const send = ref(false);
        const cla = ref(props.data.cla)
        const formData = { ...props.data.model };
        const saveButton  = ref(false);
        // formData.user_id = props.data.user_id;
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
            personal_number: { required, numeric },
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
        cla.value.nationality = swapObjectsById(cla.value.nationality, 1, 101);
        function swapObjectsById(arr, id1, id2) {
            const index1 = arr.findIndex(obj => obj.id === id1);
            const index2 = arr.findIndex(obj => obj.id === id2);

            if (index1 === -1 || index2 === -1) {
                // Handle the case where one or both IDs are not found
                return arr;
            }

            // Swap the objects
            [arr[index1], arr[index2]] = [arr[index2], arr[index1]];

            return arr;
        }

        const v = useVuelidate(rules, m);

        const updateButton = () =>v.value.$invalid ? false: true

        const height = (item) =>{

            const numberAsString = item.toString();
            if (numberAsString.length == 3) {
                m_height = item
                if (item < 140) {
                    m.value.height = 140
                    toast.error("მინიმალური სიმაღლე არ უნდა იყოს 140 ზე ნაკლები", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                }
                if (item > 210) {
                    m.value.height = 210
                }
            }else if(numberAsString.length > 3){
                m.value.height = m_height
            }

        }
        const weight = (item) =>{

            const numberAsString = item.toString();
            if (numberAsString.length == 3) {
                m_weight = item
                if (item < 40) {
                    m.value.weight = 40
                    toast.error("მინიმალური წონა არ უნდა იყოს 40 ზე ნაკლები", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                }
                if (item > 180) {
                    m.value.weight = 180
                }
            }else if(numberAsString.length > 3){
                m.value.weight = m_weight
            }

        }

        const children = (item) =>{
            if(item < 0){
                m.value.children = 0
            }else if(item > 10){
                toast.error(" არ უნდა იყოს 10 ზე მეტი", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                m.value.children = 10
            }
        }

        const getChildrenAge = (item) => {
            m.value.children_age = item
        };

        const validateAndSubmit = (item) => {
            let data = {...item}
            return data

        };
        const validateAndEmit = async () => {

            v.value.$touch();
            if (!v.value.$invalid) {
                let data = validateAndSubmit(m.value)
                const isFormValid = !v.value.$invalid;
                emit("validateAndEmit", isFormValid, data, 'information', saveButton.value);
            }else{
                toast.warning("აუცილებელია სავალდებულო ველები იყოს შევსებული", {
                    theme: 'colored',
                    autoClose: 2000,
                });
            }
        }


        watch(m.value, (newVal) => {
            saveButton.value = true
        });
        return {
            m,
            cla,
            validateAndSubmit,
            v,
            getLang,
            validateAndEmit,
            updateButton,
            send,
            height,
            weight,
            children,
            getChildrenAge
        };
    },
};
</script>
