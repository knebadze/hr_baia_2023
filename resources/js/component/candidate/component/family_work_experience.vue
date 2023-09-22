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
                        <label>{{ $t('lang.user_profile_page_family_work_experience_answer') }}</label>
                        <div class="ls-inputicon-box">

                            <multiselect v-model="m.has_experience" :options="cla.yesNo" :searchable="false" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :allow-empty="false" >
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                            <!-- <span v-if="v$.m.has_experience.required.$invalid && v$.m.has_experience.$dirty" style='color:red'>* {{ v$.m.has_experience.required.$message}}</span> -->
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
                                <label>{{ $t('lang.user_profile_page_family_work_experience_answer_2') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" type="number" v-model="m.families_worked_count" @blur="v$.m.families_worked_count.$touch" style="height: 40px;">
                                    <!-- <i class="fs-input-icon fa fa-smoking"></i> -->
                                    <span v-if="v$.m.families_worked_count.required.$invalid && v$.m.families_worked_count.$dirty" style='color:red'>* {{ v$.m.families_worked_count.required.$message}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.user_profile_page_family_work_staji') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.work_experience"  :options="cla.workExperiences" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false" @blur="v$.m.work_experience.$touch">
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                    <span v-if="v$.m.work_experience.required.$invalid && v$.m.work_experience.$dirty" style='color:red'>* {{ v$.m.work_experience.required.$message}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.user_profile_page_family_work_staji_time') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.longest" :options="cla.workExperiences" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false" @blur="v$.m.longest.$touch">
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                    <span v-if="v$.m.longest.required.$invalid && v$.m.longest.$dirty" style='color:red'>* {{ v$.m.longest.required.$message}}</span>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.user_profile_page_family_work_in_family') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.family_work_category"  :options="cla.category" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name_ka" track-by="name_ka" :preselect-first="false" @blur="v$.m.family_work_category.$touch">
                                        <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                    </multiselect>
                                    <span v-if="v$.m.family_work_category.required.$invalid && v$.m.family_work_category.$dirty" style='color:red'>* {{ v$.m.family_work_category.required.$message}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.user_profile_page_family_work_obligation') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.family_work_duty"  :options="cla.duty" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name_ka" track-by="name_ka" :preselect-first="false" @blur="v$.m.family_work_duty.$touch">
                                        <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                    </multiselect>
                                    <span v-if="v$.m.family_work_duty.required.$invalid && v$.m.family_work_duty.$dirty" style='color:red'>* {{ v$.m.family_work_duty.required.$message}}</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="m.has_experience && m.has_experience.id == 2"  class=" col-md-12">
                    <div  class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>სამუშაო გამოცდილების არ ქონის მიზეზი</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.no_reason" :options="cla.noExperienceReason" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false" @blur="v$.m.no_reason.$touch">
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                    <span v-if="v$.m.no_reason.required.$invalid && v$.m.no_reason.$dirty" style='color:red'>* {{ v$.m.no_reason.required.$message}}</span>
                                </div>
                            </div>
                        </div>
                        <div v-if="m.no_reason" class="col-md-12">
                            <div class="form-group">
                                <label>დამატაბითი ინფორმაცია</label>
                                <textarea class="form-control" rows="3" v-model="m[`no_reason_info_${getLang}`]" placeholder="ჩაწერეთ იმ შემთხვევაში თუ ასარჩევ ველში ვერ ნახეთ შესაფერისი მიზეზი ან გსურთ დამატებითი ინფორმაციის მოწოდება" @blur="v$.m.no_reason_info.$touch"></textarea>
                                <span v-if="v$.m.no_reason_info.maxLength.$invalid && v$.m.no_reason_info.$dirty" style='color:red'>* {{ v$.m.no_reason_info.maxLength.$message}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                    <button type="submit" @click.prevent="add()"  class="site-button">{{ $t('lang.user_profile_page_work_button_save') }}</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { useVuelidate } from '@vuelidate/core'
import { required, email, helpers, requiredIf, numeric, maxLength } from '@vuelidate/validators'
import _ from 'lodash'
export default {
    setup () {
        return { v$: useVuelidate() }
    },
    props:{
        data: Object,

    },
    data() {
        return {
            m:null,
            cla: null,
        }
    },
    validations () {
        const validations = {
            m:{
                has_experience:{
                    required:helpers.withMessage('ოჯახში მუშაობის გამოცდილების შევსება სავალდებულოა', required ),
                },
                families_worked_count:{},
                work_experience:{},
                longest:{},
                no_reason:{},
                no_reason_info:{},
                family_work_category:{},
                family_work_duty:{}
            },

        }
        if (this.m.has_experience && this.m.has_experience.id == 1) {
            validations.m.work_experience = {
                required:helpers.withMessage('სტაჟის შევსება სავალდებულოა', required )
            }
            validations.m.families_worked_count = {
                required:helpers.withMessage('შევსება სავალდებულოა', required ),
                numeric: helpers.withMessage('უნდა შედგებოდეს მხოლოდ ციფრებისგან', numeric ),
            }
            validations.m.longest = {
                required:helpers.withMessage('არჩევა სავალდებულოა', required ),
            }
            validations.m.family_work_category = {
                required:helpers.withMessage('არჩევა სავალდებულოა', required ),
            }
            validations.m.family_work_duty = {
                required:helpers.withMessage('არჩევა სავალდებულოა', required ),
            }
        }else{
            validations.m.no_reason = {
                required:helpers.withMessage('არჩევა სავალდებულოა', required ),
            }
            validations.m.no_reason_info = {
                maxLength: helpers.withMessage('დაშვებულია 100 სიმბოლო', maxLength(100) )
            }

        }


        return validations
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
    },
    created(){
        this.m = {...this.data.model}
        this.cla = _.cloneDeep(this.data.cla)
        this.m.user_id = this.data.user_id
//
    },
    methods: {
        async add(){
            const isFormCorrect = await this.v$.m.$validate()
            if (!isFormCorrect) return;
            this.m.lang = this.getLang
            this.m.candidate_id = this.data.candidate_id
            let currentObj = this;
            axios({
                method: "post",
                url: "/add_work_information",
                data: {'model':this.m, 'type': 'family_work_information'},

            })
            .then(function (response) {

                // handle success
                if (response.data.status == 200) {
                    toast.success("წარმატებით დაემატა", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                }

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
    },
    watch:{
        'm.family_work_category': function(newVal, oldVal){
            let duty = _.cloneDeep(this.data.cla.duty)
            if (newVal !== undefined && newVal != '') {
                let filteredDuty = [];
                newVal.forEach(element => {
                    let filter = _.filter(duty, function(o) {
                        return o.category_id === element.id;
                    });
                    filteredDuty = filteredDuty.concat(filter);
                });

                this.cla.duty = filteredDuty;
            }

        }
    }
}
</script>
<style lang="">

</style>
