<template lang="">
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
                            <multiselect v-model="m.category" :options="cla.category" :searchable="true" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :allow-empty="false" @blur="v$.m.category.$touch">
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                            <span v-if="v$.m.category.required.$invalid && v$.m.category.$dirty" style='color:red'>* {{ v$.m.category.required.$message}}</span>
                            <!-- <i class="fs-input-icon fa fa-smoking"></i> -->
                        </div>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_schedule_title') }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="workInformationSchedule"  :options="cla.workSchedule" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name_ka" track-by="name_ka" :preselect-first="false" @blur="v$.workInformationSchedule.$touch">
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
                            <textarea class="form-control" rows="3" v-model="m[`additional_schedule_${getLang}`]" placeholder="ჩაწერეთ სასურველი სამუშაო დღეები და საათები" @blur="v$.m[`additional_schedule_${getLang}`].$touch"></textarea>
                            <span v-if="v$.m[`additional_schedule_${getLang}`].required.$invalid && v$.m[`additional_schedule_${getLang}`].$dirty" style='color:red'>* {{ v$.m[`additional_schedule_${getLang}`].required.$message}}</span>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_salary_title') }}</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" type="number" step="50" v-model="m.payment" @blur="v$.m.payment.$touch" style='height:45px;'>
                                <!-- <i class="fs-input-icon fa fa-money"></i> -->
                                <span v-if="v$.m.payment.numeric.$invalid && v$.m.payment.$dirty" style='color:red'>* {{ v$.m.payment.numeric.$message}}</span>
                                <span v-if="v$.m.payment.required.$invalid && v$.m.payment.$dirty" style='color:red'>* {{ v$.m.payment.required.$message}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_currency_title') }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="m.currency" :options="cla.currency" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false" @blur="v$.m.currency.$touch">
                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                </multiselect>
                                <span v-if="v$.m.currency.required.$invalid && v$.m.currency.$dirty" style='color:red'>* {{ v$.m.currency.required.$message}}</span>
                                <!-- <i class="fs-input-icon fa fa-usd"></i> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div v-if="m.category"> -->
                <div class="row" v-if=" m.category.id == 1 || m.category.id == 2 || m.category.id == 4">
                    <div class="col-xl-4 col-lg-6 col-md-12" v-if="m.category.id != 4">
                        <div class="form-group">

                            <div class="ls-inputicon-box">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" v-model="m.go_vacation" id="flexCheckDefault">
                                    <label>{{ ('შეძლებთ არდადეგებზე გაყოლას?') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-group">

                            <div class="ls-inputicon-box">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" v-model="m.stay_night" id="flexCheckDefault">
                                    <label>{{ $t('შეძლებთ ღამე დარჩენას?') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-group">

                            <div class="ls-inputicon-box">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" v-model="m.work_additional_hours" id="flexCheckDefault">
                                    <label>{{ $t('შეძლებთ დამატებით საათებში მუშაობას?') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </div> -->
                <div class="col-lg-12 col-md-12 mt-4" >
                    <div class="text-left">
                        <button type="submit" @click.prevent="addWorkInfo()"  class="site-button">{{ $t('lang.user_profile_page_work_button_save') }}</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- table -->
    <div class="panel panel-default" v-if="m.length != 0" >
        <div class="panel-heading wt-panel-heading p-a20">
            <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_category_end_schedule_table') }}</h4>
        </div>
        <div class="panel-body wt-panel-body p-a20 m-b30 ">
            <div class="p-a20 table-responsive">
                <!-- <table class="table twm-table table-striped table-borderless">
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
                    <tr v-for="(item,index) in m">
                    <td>{{ index + 1 }}</td>
                    <td><span style="margin-bottom: 5px; margin-right: 5px;" class="badge rounded-pill bg-success p-2">{{ item.category[`name_${getLang}`] }}</span></td>
                    <td><span style="margin-bottom: 5px; margin-right: 5px;" v-for="i in item.work_schedule" class="badge rounded-pill bg-primary p-2">{{ i[`name_${getLang}`] }}</span></td>
                    <td>{{ item.payment }}</td>
                    <td>{{ item.currency[`name_${getLang}`] }}</td>
                    <td>
                        <button type="button" :title="$t('lang.user_profile_page_category_end_schedule_table_action_tooltips_view')" data-bs-toggle="tooltip" data-bs-placement="top" @click="editWorkInformation(item)">
                            <i class="fa fa-eye"></i>
                        </button>
                        <button :title="$t('lang.user_profile_page_category_end_schedule_table_action_tooltips_del')" data-bs-toggle="tooltip" data-bs-placement="top" @click="deleteWorkInformation(index, item.id)">
                            <i class="fa fa-trash-alt"></i>
                        </button>
                    </td>
                    </tr>
                </tbody>
                </table> -->
            </div>
        </div>
    </div>
</template>
<script>
import { useVuelidate } from '@vuelidate/core'
import { required, email, helpers, requiredIf, numeric, maxLength } from '@vuelidate/validators'
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
            workInformationSchedule: [],
            showAdditionalSchedule:false,
        }
    },
    validations () {
        const validations = {
            m:{
                // getWorkInformation:{
                    category:{
                        required:helpers.withMessage('არჩევა სავალდებულოა', required ),
                    },
                    payment:{
                        required:helpers.withMessage('არჩევა სავალდებულოა', required ),
                        numeric: helpers.withMessage('უნდა შედგებოდეს მხოლოდ ციფრებისგან', numeric ),
                    },
                    currency:{
                        required:helpers.withMessage('არჩევა სავალდებულოა', required )
                    },
                    additional_schedule_ka:{},
                    additional_schedule_ka:{},
                    additional_schedule_ka:{},
                // },
                // familyWorkExperience:{
                //     has_experience:{
                //         required:helpers.withMessage('ოჯახში მუშაობის გამოცდილების შევსება სავალდებულოა', required ),
                //     },
                //     families_worked_count:{},
                //     work_experience:{},
                //     longest:{},
                //     no_reason:{},
                //     no_reason_info:{}
                // },
                // familyWorkedSelected:{},
                // candidateFamilyWorkSkill:{},
                // showNoWorkExperience:false


            },

            workInformationSchedule:{required:helpers.withMessage('სამუშაო გრაფიკის არჩევა სავალდებულოა', required )},




            // candidateRecommendationModel:{
            //     has_recommendation:{
            //         required:helpers.withMessage('რეკომენდაციის შევსება სავალდებულოა', required )
            //     },
            //     recommendation_whom:{},
            //     name_ka:{},
            //     name_en:{},
            //     name_ru:{},
            //     position_ka:{},
            //     position_en:{},
            //     position_ru:{},
            //     number:{},
            //     no_reason:{},
            //     no_reason_info_ka:{},
            //     no_reason_info_en:{},
            //     no_reason_info_ru:{},
            // }
        }

        // if (this.m.familyWorkExperience.has_experience && this.m.familyWorkExperience.has_experience.id == 1) {
        //     validations.m.familyWorkExperience.work_experience = {
        //         required:helpers.withMessage('სტაჟის შევსება სავალდებულოა', required )
        //     }
        //     validations.m.familyWorkExperience.families_worked_count = {
        //         required:helpers.withMessage('შევსება სავალდებულოა', required ),
        //         numeric: helpers.withMessage('უნდა შედგებოდეს მხოლოდ ციფრებისგან', numeric ),
        //     }
        //     validations.m.familyWorkExperience.longest = {
        //         required:helpers.withMessage('არჩევა სავალდებულოა', required ),
        //     }
        //     validations.m.familyWorkedSelected = {
        //         required:helpers.withMessage('არჩევა სავალდებულოა', required ),
        //     }
        //     validations.m.candidateFamilyWorkSkill = {
        //         required:helpers.withMessage('არჩევა სავალდებულოა', required ),
        //     }
        // }else{
        //     validations.m.familyWorkExperience.no_reason = {
        //         required:helpers.withMessage('არჩევა სავალდებულოა', required ),
        //     }
        //     validations.m.familyWorkExperience.no_reason_info = {
        //         maxLength: helpers.withMessage('დაშვებულია 100 სიმბოლო', maxLength(100) )
        //     }

        // }

        // if (this.candidateRecommendationModel.has_recommendation && this.candidateRecommendationModel.has_recommendation.id == 1) {
        //     validations.candidateRecommendationModel.recommendation_whom = {
        //         required:helpers.withMessage('არჩევა სავალდებულოა', required )
        //     }
        //     if (this.candidateRecommendationModel.recommendation_whom.id == 2) {
        //         validations.candidateRecommendationModel[`position_${this.getLang}`] = {
        //             required:helpers.withMessage('შევსება სავალდებულოა', required )
        //         }
        //     }
        //     validations.candidateRecommendationModel[`name_${this.getLang}`] = {
        //         required:helpers.withMessage('შევსება სავალდებულოა', required )
        //     }
        //     validations.candidateRecommendationModel.number = {
        //         required:helpers.withMessage('შევსება სავალდებულოა', required ),
        //         numeric: helpers.withMessage('ნომერი უნდა შედგებოდეს მხოლოდ ციფრებისგან', numeric ),
        //     }
        // } else {
        //     validations.candidateRecommendationModel.no_reason = {
        //         required:helpers.withMessage('არჩევა სავალდებულოა', required )
        //     }
        //     validations.candidateRecommendationModel[`no_reason_info_${this.getLang}`] = {
        //         maxLength: helpers.withMessage('დაშვებულია 100 სიმბოლო', maxLength(100) )
        //     }
        // }

        // if (this.workInformationSchedule.id == 9) {
        //     if (this.getLang == 'ka') {
        //         validations.m.getWorkInformation.additional_schedule_ka = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
        //     }else if(this.getLang == 'en'){
        //         validations.m.getWorkInformation.additional_schedule_en = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
        //     }else if(this.getLang == 'ru'){
        //         validations.m.getWorkInformation.additional_schedule_ru = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
        //     }
        // }


        return validations
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
    },
    created(){
        console.log('his.data.', this.data);
        this.m = {...this.data.model}
        this.cla = this.data.cla
        this.m.user_id = this.data.user_id
        console.log('this.m,',this.data.model);
//
    },
    methods: {
        async addCandidate(){
            const isFormCorrect = await this.v$.$validate()
            if (!isFormCorrect) return;
            this.m['lang'] = this.getLang
            let currentObj = this;
            console.log('currentObj',currentObj);
            axios({
                method: "post",
                url: "/add_candidate",
                data: {'model':this.m, 'type': 'information'},

            })
            .then(function (response) {
                console.log(response.data);
                if (response.data.status == 200) {
                    currentObj.candidate_id = response.data.data;
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
        },
    },
    watch:{

    }
}
</script>
<style lang="">

</style>
