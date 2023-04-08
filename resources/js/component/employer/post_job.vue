<template lang="">
        <!-- LOADING AREA START ===== -->
    <div v-if="loader" class="loading-area">
        <div class="loading-box"></div>
        <div class="loading-pic">
            <div class="wrapper">
                <div class="cssload-loader"></div>
            </div>
        </div>
    </div>
    <!-- LOADING AREA  END ====== -->
    <div class="col-xl-9 col-lg-8 col-md-12 m-b30 employerPageBorder">
        <!--Filter Short By-->
        <div class="twm-right-section-panel site-bg-gray">
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">{{ $t('lang.employer_add_job_general_info') }}</h4>
                    <small class="text-danger">* {{ $t('lang.employer_add_job_definitely_fields') }}</small>
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30 ">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.employer_add_job_vacancy_name') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.vacancy[`title_${getLang}`]" type="text" :placeholder="$t('lang.employer_add_job_vacancy_name_placeholder')"  @blur="v$.m.vacancy[`title_${getLang}`].$touch">
                                    <i class="fs-input-icon fa fa-user"></i>
                                    <span v-if="v$.m.vacancy[`title_${getLang}`].required.$invalid && v$.m.vacancy[`title_${getLang}`].$dirty" style='color:red'>* {{ v$.m.vacancy[`title_${getLang}`].required.$message}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.employer_add_job_position') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.vacancy.category_id" :options="data.classificator.category" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12" v-if="m.vacancy.category_id.id == 7 || m.vacancy.category_id.id == 8 || m.vacancy.category_id.id == 9 || m.vacancy.category_id.id == 11">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ ('ვისთვის გესაჭიროებათ?') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.vacancy[`for_who_${getLang}`]"  type="text" placeholder="მაგ: 3 წლის ვაჟისთვის" >
                                    <i class="fs-input-icon fa fa-user"></i>
                                    <!-- <span v-if="v$.m.candidate.personal_number.required.$invalid && v$.m.candidate.personal_number.$dirty" style='color:red'>* {{ v$.m.candidate.personal_number.required.$message}}</span> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.employer_add_job_address') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.vacancy[`address_${getLang}`]"  type="text" placeholder="" >
                                    <i class="fs-input-icon fa fa-user"></i>
                                    <!-- <span v-if="v$.m.candidate.personal_number.required.$invalid && v$.m.candidate.personal_number.$dirty" style='color:red'>* {{ v$.m.candidate.personal_number.required.$message}}</span> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_salary_title') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.vacancy.payment" type="number" step="50" >
                                    <!-- <i class="fs-input-icon fa fa-money"></i> -->
                                    <!-- <span v-if="v$.m.getWorkInformation.payment.numeric.$invalid && v$.m.getWorkInformation.payment.$dirty" style='color:red'>* {{ v$.m.getWorkInformation.payment.numeric.$message}}</span> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_currency_title') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.vacancy.currency_id" :options="data.classificator.currency" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false" >
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                    <!-- <span v-if="v$.m.getWorkInformation.currency_id.required.$invalid && v$.m.getWorkInformation.currency_id.$dirty" style='color:red'>* {{ v$.m.getWorkInformation.currency_id.required.$message}}</span> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_schedule_title') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.vacancy.work_schedule_id" :options="data.classificator.workSchedule" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false" >
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                    <!-- <span v-if="v$.workInformationSchedule.required.$invalid && v$.workInformationSchedule.$dirty" style='color:red'>* {{ v$.workInformationSchedule.required.$message}}</span> -->
                                    <!-- <i class="fs-input-icon fa fa-smoking"></i> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.employer_add_job_jobs_day') }}</label>
                                <div class="ls-inputicon-box">
                                    <textarea class="form-control" v-model="m.vacancy[`additional_schedule_${getLang}`]" type="text" placeholder="" rows="3"></textarea>
                                    <!-- <span v-if="v$.m.candidate.personal_number.required.$invalid && v$.m.candidate.personal_number.$dirty" style='color:red'>* {{ v$.m.candidate.personal_number.required.$message}}</span> -->
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="m.vacancy.category_id.id == 7 || m.vacancy.category_id.id == 8 || m.vacancy.category_id.id == 10">
                            <div class="col-xl-4 col-lg-6 col-md-12" v-if="m.vacancy.category_id != 10">
                                <div class="form-group">

                                    <div class="ls-inputicon-box">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" v-model="m.vacancy.go_vacation" id="flexCheckDefault">
                                            <label>{{ ('უნდა შეეძლოს არდადეგებზე გამოყოლა') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">

                                    <div class="ls-inputicon-box">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" v-model="m.vacancy.stay_night" id="flexCheckDefault">
                                            <label>{{ $t('უნდა შეეძლოს ღამე დარჩენა') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">

                                    <div class="ls-inputicon-box">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" v-model="m.vacancy.work_additional_hours" id="flexCheckDefault">
                                            <label>{{ $t('უნდა შეეძლო დამატებით საათებში მუშაობა') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">{{ $t('lang.employer_add_job_jobs_day') }}</h4>
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30 ">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.employer_add_job_when_need') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.demand.start_date" type="date" placeholder="" >
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.employer_add_job_how_long') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.demand[`term_${getLang}`]" type="text" :placeholder="$t('lang.employer_add_job_how_long_placeholdser')" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.employer_add_job_additional_offers') }}</label>
                                <div class="ls-inputicon-box">
                                    <textarea class="form-control" v-model="m.vacancy[`additional_${getLang}`]" type="text" :placeholder="$t('lang.employer_add_job_additional_offers_placeholder')" rows="2"></textarea>
                                    <!-- <i class="fs-input-icon fa fa-user"></i> -->
                                    <!-- <span v-if="v$.m.candidate.personal_number.required.$invalid && v$.m.candidate.personal_number.$dirty" style='color:red'>* {{ v$.m.candidate.personal_number.required.$message}}</span> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.employer_add_job_comment_for_agency') }}</label>
                                <div class="ls-inputicon-box">
                                    <textarea class="form-control" v-model="m.vacancy.comment" type="text" :placeholder="$t('lang.employer_add_job_comment_for_agency_placeholder')" rows="3"></textarea>
                                    <!-- <i class="fs-input-icon fa fa-user"></i> -->
                                    <!-- <span v-if="v$.m.candidate.personal_number.required.$invalid && v$.m.candidate.personal_number.$dirty" style='color:red'>* {{ v$.m.candidate.personal_number.required.$message}}</span> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">{{ $t('lang.employer_add_job_requirements_for_employer') }}</h4>
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30 ">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.employer_add_job_minimal_age') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.demand.min_age" type="text" placeholder="" >
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.employer_add_job_max_age') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.demand.max_age" type="text" placeholder="" >
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.employer_add_job_minimal_edu') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.demand.education_id" :options="data.classificator.education" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" :placeholder="$t('lang.employer_add_job_select')"  :searchable="true" :allow-empty="false">
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.employer_add_job_preferred_foreign_language') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.demand.language_id" :options="data.classificator.languages" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" :placeholder="$t('lang.employer_add_job_select')"  :searchable="true" :allow-empty="false">
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.employer_add_job_foreign_language_level') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.demand.language_level_id" :options="data.classificator.languageLevels" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" :placeholder="$t('lang.employer_add_job_select')"  :searchable="true" :allow-empty="false">
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.employer_add_job_general_character') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.characteristic"  :options="data.classificator.characteristic" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" :placeholder="$t('lang.employer_add_job_select')" label="name_ka" track-by="name_ka" :preselect-first="false">
                                        <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.employer_add_job_duties') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.skill"  :options="data.classificator.skill" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" :placeholder="$t('lang.employer_add_job_select')" label="name_ka" track-by="name_ka" :preselect-first="false" >
                                        <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                    </multiselect>
                                    <!-- <span v-if="v$.m.familyWorkedSelected.required.$invalid && v$.m.familyWorkedSelected.$dirty" style='color:red'>* {{ v$.m.candidateFamilyWorkSkill.required.$message}}</span> -->
                                </div>

                            </div>
                        </div>
                        <div class=" col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.employer_add_job_additional_duties') }}</label>
                                <div class="ls-inputicon-box">
                                    <textarea class="form-control" v-model="m.demand[`additional_duty_${getLang}`]" type="text" placeholder="" rows="2"></textarea>
                                    <!-- <span v-if="v$.m.candidate.personal_number.required.$invalid && v$.m.candidate.personal_number.$dirty" style='color:red'>* {{ v$.m.candidate.personal_number.required.$message}}</span> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="text-left">
                                <button type="submit" @click.prevent="addVacancy()"  class="site-button">{{ $t('lang.employer_add_job_button_add') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
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
        data: Object
    },
    data() {
        return {
            m: {
                'vacancy':null,
                'demand':null,
                'characteristic':[],
                'skill':[]
            },
            workInformationSchedule:null,

            loader: false,
            localText:{
                schedule: {
                    '1':{
                        ka:'ორშაბათი_დან პარასკევის ჩათლით, 09:00_დან 18:00_მდე',
                        en:'',
                        ru:'',
                    }

                }
            }
        }
    },
    validations () {
        const validations = {
            m:{
                vacancy:{
                    title_ka:{},
                    title_en:{},
                    title_ru:{},
                    category_id:{
                        required:helpers.withMessage('არჩევა სავალდებულოა', required ),
                    },
                    for_who_ka:{},
                    for_who_en:{},
                    for_who_ru:{},
                    address_ka:{},
                    address_en:{},
                    address_ru:{},
                    payment:{
                        required:helpers.withMessage('შევსება სავალდებულოა', required ),
                        numeric:helpers.withMessage('უნდა შეიცავდეც მხოლოდ ციფრებს', numeric ),
                    },
                    currency_id:{
                        required:helpers.withMessage('არჩევა სავალდებულოა', required ),
                    },
                    work_schedule_id:{
                        required:helpers.withMessage('არჩევა სავალდებულოა', required ),
                    },
                    additional_schedule_ka:{},
                    additional_schedule_en:{},
                    additional_schedule_ru:{},
                },
                demand:{

                }
            }


        }
        if (this.getLang == 'ka') {
            validations.m.vacancy.title_ka ={
                required:helpers.withMessage('შევსება სავალდებულოა', required )
            }
        }else if(this.getLang == 'en'){
            validations.m.vacancy.title_en ={
                required:helpers.withMessage('შევსება სავალდებულოა', required )
            }
        }else{
            validations.m.vacancy.title_ru ={
                required:helpers.withMessage('შევსება სავალდებულოა', required )
            }
        }
        return validations
    },
    created(){
        this.m['vacancy'] = {...this.data.model.vacancy};
        this.m.vacancy['go_vacation'] = 0;
        this.m.vacancy['stay_night'] = 0;
        this.m.vacancy['work_additional_hours'] = 0;
        this.m['demand'] = {...this.data.model.demand};
        this.m.vacancy.payment = 800
        this.m.vacancy[`address_${this.getLang}`] = this.data.classificator.fullAddress
         console.log('this.m', this.m);
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
    },
    methods:{
        addVacancy(){
            this.m['lang'] = this.getLang
            var html = `${this.m.vacancy[`address_${this.getLang}`]}_ზე ${(this.m.vacancy[`for_who_${this.getLang}`])?this.m.vacancy[`for_who_${this.getLang}`]:''} გვესაჭიროება ${this.m.vacancy.category_id[`name_${this.getLang}`]}. ${this.m.vacancy.work_schedule_id[`name_${this.getLang}`]} გრაფიკით, ${this.m.vacancy[`additional_schedule_${this.getLang}`]}. ანაზღაურება: ${this.m.vacancy.payment} ${this.m.vacancy.currency_id[`name_${this.getLang}`]}.  ${`დამატებით: `+this.m.vacancy[`additional_${this.getLang}`]} `
            this.$swal(
                {
                    title: '<p>თქვენი ვაკანსია</p>',
                    // icon: 'info',
                    html:html,
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false,
                    confirmButtonText: 'დამატება',
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    let currentObj = this
                    // this.loader = true
                    axios({
                        method: "post",
                        url: "/add_vacancy",
                        data: this.m,

                    })
                    .then(function (response) {
                        console.log('response.data', response.data);
                        if (response.data.status == 200) {
                            currentObj.loader = false
                            toast.success("ვაკანსია წარმატებით დაემატა", {
                                theme: 'colored',
                                autoClose: 1000,
                            });

                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                }
            // else if (result.isDenied) {
            //     Swal.fire('Changes are not saved', '', 'info')
            // }
            })

        }
    },
    watch:{
        'm.vacancy.work_schedule_id': function (newValue, oldValue) {
            console.log('new', newValue);
            if (newValue != '') {
                this.m.vacancy[`additional_schedule_${this.getLang}`] = this.localText.schedule[`${newValue.id}`][`${this.getLang}`]
                console.log(this.localText.schedule[`${newValue.id}`][`${this.getLang}`]);
            }
        }
    },
    mounted(){
        console.log('this.data', this.data);
    }
}
</script>
<style lang="">

</style>
