<template lang="">
   <div class="panel panel-default">
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
                        <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_family_work_experience_answer') }}</label>
                        <div class="ls-inputicon-box">

                            <multiselect v-model="m.has_experience" :options="cla.yesNo" :searchable="false" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :allow-empty="false" >
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                            <span v-if="!v.has_experience.required.$response" style='color:red'>* </span>

                        </div>
                    </div>
                </div>
                <div v-if="m.has_experience && m.has_experience.id == 2" class=" col-md-12 mb-2">
                    <strong>ჩვენი კლიენტები დასაქმების დროს ითვალისწინებელ სამუშაო გამოცდილებას ვინაიდან არ გაქვთ გამოცდილება გთხოვთ შეავსოთ გამოცდილების არ ქონის მიზეზი</strong>
                </div>
                <div v-if="m.has_experience && m.has_experience.id == 1" class=" col-md-12">
                    <div class="row">
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_family_work_experience_answer_2') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" type="number" v-model="m.families_worked_count" @blur="v.families_worked_count.$touch" style="height: 40px;">
                                    <span v-if="!v.families_worked_count.required.$response" style='color:red'>* </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_family_work_staji') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.work_experience"  :options="cla.workExperiences" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false" @blur="v.work_experience.$touch">
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                    <span v-if="!v.work_experience.required.$response" style='color:red'>* </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12" v-if="m.has_experience">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_family_work_staji_time') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.longest" :options="cla.workExperiences" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false" @blur="v.longest.$touch">
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                    <span v-if="!v.longest.required.$response" style='color:red'>* </span>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_family_work_in_family') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.family_work_category"  :options="cla.category" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name_ka" track-by="name_ka" :preselect-first="false" @blur="v.family_work_category.$touch">
                                        <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                    </multiselect>
                                    <span v-if="!v.family_work_category.required.$response" style='color:red'>* </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_family_work_obligation') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.family_work_duty"  :options="cla.duty" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name_ka" track-by="name_ka" :preselect-first="false" @blur="v.family_work_duty.$touch">
                                        <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                    </multiselect>
                                    <span v-if="!v.family_work_duty.required.$response" style='color:red'>* </span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="m.has_experience && m.has_experience.id == 2"  class=" col-md-12">
                    <div  class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>სამუშაო გამოცდილების არ ქონის მიზეზი</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.no_reason" :options="cla.noExperienceReason" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false" @blur="v.no_reason.$touch">
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                    <span v-if="!v.no_reason.required.$response" style='color:red'>* </span>
                                </div>
                            </div>
                        </div>
                        <div v-if="m.no_reason" class="col-md-12">
                            <div class="form-group">
                                <label>დამატაბითი ინფორმაცია</label>
                                <textarea class="form-control" rows="3" v-model="m[`no_reason_info_${getLang}`]" placeholder="ჩაწერეთ იმ შემთხვევაში თუ ასარჩევ ველში ვერ ნახეთ შესაფერისი მიზეზი ან გსურთ დამატებითი ინფორმაციის მოწოდება" @blur="v.no_reason_info.$touch"></textarea>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                    <button type="submit" @click.prevent="validateAndSubmit()"  class="site-button">{{ $t('lang.user_profile_page_work_button_save') }}</button>
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

        // const showAdditionalSchedule = ref(false);
        const cla = ref(_.cloneDeep(props.data.cla))
        const formData = {...props.data.model};

        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });


        formData.getLang = getLang;
        formData.user_id = props.data.user_id
        const m = ref(formData)

        const rules = {
            has_experience: { required },
            families_worked_count:{required: withConditionalValidation((value) => m.value.has_experience.id == 1), },
            work_experience:{required: withConditionalValidation((value) => m.value.has_experience.id  == 1), },
            longest:{required: withConditionalValidation((value) => m.value.has_experience.id == 1), },
            family_work_category:{required: withConditionalValidation((value) => m.value.has_experience.id == 1), },
            family_work_duty:{required: withConditionalValidation((value) => m.value.has_experience.id == 1), },

            no_reason:{required: withConditionalValidation((value) => m.value.has_experience.id == 2), },

        };

        const v = useVuelidate(rules, m);
        function withConditionalValidation(condition) {
            return (value) => {
                return !condition(value) || !!value;
            };
        }

        const watchItem = () => m.value.family_work_category;
        watch(watchItem, (newVal) => {
            let duty = _.cloneDeep(props.data.cla.duty)
            if (newVal !== undefined && newVal != '') {
                let filteredDuty = [];
                newVal.forEach(element => {
                    let filter = _.filter(duty, function(o) {
                        return o.category_id === element.id;
                    });
                    filteredDuty = filteredDuty.concat(filter);
                });
                cla.value.duty = filteredDuty;
            }
        });



        const validateAndSubmit = () => {
            v.value.$touch();
            // console.log(v.value);
            if (!v.value.$invalid) {
                axios({
                    method: "post",
                    url: "/add_candidate",
                    data: {'model':m.value, 'type': 'family_work_information', 'user_id': props.data.user_id},

                })
                .then(function (response) {
                    if (response.data.status == 200) {

                        toast.success("ინფორმაცია წარმატებით შეინახა", {
                            theme: 'colored',
                            autoClose: 1000,
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
            console.log('isFormValid', isFormValid);
            emit("validateAndEmit", isFormValid);
        };

        return {
            m,
            // model,
            cla,
            v,
            validateAndSubmit,
            // add,
            getLang,
            validateAndEmit,
            // showAdditionalSchedule

        };
    },
    methods: {

    },
};
</script>
<style lang="">

</style>
