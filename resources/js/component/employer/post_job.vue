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
    <div class="col-xl-9 col-lg-8 col-md-12 m-b30">
        <!--Filter Short By-->
        <div class="twm-right-section-panel site-bg-gray">
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">{{ ('ძირითადი ინფორმაცია') }}</h4>
                    <small class="text-danger">* აუცილებლად შესავსები ველები</small>
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30 ">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ ('ვაკანსისი სათაური') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.vacancy[`title_${getLang}`]" type="text" placeholder="მაგ: ვეძებ გამოცდილ ძიძას" >
                                    <i class="fs-input-icon fa fa-user"></i>
                                    <!-- <span v-if="v$.m.candidate.personal_number.required.$invalid && v$.m.candidate.personal_number.$dirty" style='color:red'>* {{ v$.m.candidate.personal_number.required.$message}}</span> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ ('პოზიცია') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.vacancy.category_id" :options="data.classificator.category" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
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
                                <label><span class="text-danger">* </span>{{ ('მისამართი') }}</label>
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
                                <label><span class="text-danger">* </span>{{ ('სამუშაო დღეები და საათები') }}</label>
                                <div class="ls-inputicon-box">
                                    <textarea class="form-control" v-model="m.vacancy[`additional_schedule_${getLang}`]" type="text" placeholder="" rows="3"></textarea>
                                    <!-- <span v-if="v$.m.candidate.personal_number.required.$invalid && v$.m.candidate.personal_number.$dirty" style='color:red'>* {{ v$.m.candidate.personal_number.required.$message}}</span> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">{{ ('დამატებითი ინფორმაცია') }}</h4>
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30 ">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ ('როდის გჭირდებათ') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.demand.start_date" type="date" placeholder="" >
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ ('რამდენი ხნით') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.demand[`term_${getLang}`]" type="text" placeholder="მაგ: 6 თვე, 3 კვირა" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ ('დამატება შეთავაზება, პირობები ან მოთხოვნები') }}</label>
                                <div class="ls-inputicon-box">
                                    <textarea class="form-control" v-model="m.vacancy[`additional_${getLang}`]" type="text" placeholder="მაგ: ულიმიტო სამგზავრო ბარათი, მძღოლი მოგიყვანთ ა.შ" rows="2"></textarea>
                                    <!-- <i class="fs-input-icon fa fa-user"></i> -->
                                    <!-- <span v-if="v$.m.candidate.personal_number.required.$invalid && v$.m.candidate.personal_number.$dirty" style='color:red'>* {{ v$.m.candidate.personal_number.required.$message}}</span> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ ('კომენტარი სააგენტოსთვის') }}</label>
                                <div class="ls-inputicon-box">
                                    <textarea class="form-control" v-model="m.vacancy.comment" type="text" placeholder="მაგ: სპეც მოთხოვნები" rows="3"></textarea>
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
                    <h4 class="panel-tittle m-a0">{{ ('მოთხოვნები დამსაქმებლის მიმართ') }}</h4>
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30 ">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ ('მინიმალური ასაკი') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.demand.min_age" type="text" placeholder="" >
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ ('მაქსიმალური ასაკი') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.demand.max_age" type="text" placeholder="" >
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ ('მინიმალური განათლება') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.demand.education_id" :options="data.classificator.education" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ 'ზოგადი მახასიათებელი' }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.characteristic"  :options="data.classificator.characteristic" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name_ka" track-by="name_ka" :preselect-first="false">
                                        <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-12">
                            <div class="form-group">
                                <label>{{ ('მოვალეობები') }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.skill"  :options="data.classificator.skill" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name_ka" track-by="name_ka" :preselect-first="false" >
                                        <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                    </multiselect>
                                    <!-- <span v-if="v$.m.familyWorkedSelected.required.$invalid && v$.m.familyWorkedSelected.$dirty" style='color:red'>* {{ v$.m.candidateFamilyWorkSkill.required.$message}}</span> -->
                                </div>

                            </div>
                        </div>
                        <div class=" col-md-12">
                            <div class="form-group">
                                <label>{{ ('დამატებითი მოვალეობები') }}</label>
                                <div class="ls-inputicon-box">
                                    <textarea class="form-control" v-model="m.demand[`additional_duty_${getLang}`]" type="text" placeholder="" rows="2"></textarea>
                                    <!-- <span v-if="v$.m.candidate.personal_number.required.$invalid && v$.m.candidate.personal_number.$dirty" style='color:red'>* {{ v$.m.candidate.personal_number.required.$message}}</span> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="text-left">
                                <button type="submit" @click.prevent="addVacancy()"  class="site-button">{{ ('დამატება') }}</button>
                            </div>
                        </div>
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
            m: {
                'vacancy':null,
                'demand':null,
                'characteristic':[],
                'skill':[]
            },
            workInformationSchedule:null,
            schedule: 'ორშაბათი_დან პარასკევის ჩათლით, 09:00_დან 18:00_მდე, შაბათ-კვირა დასვენა',
            loader: false
        }
    },
    created(){
        this.m['vacancy'] = {...this.data.model.vacancy};
        this.m['demand'] = {...this.data.model.demand};
        this.m.vacancy.payment = 800
        if(this.data.model.employer[`address_${this.getLang}`]) this.m.vacancy[`address_${this.getLang}`] = this.data.model.employer[`address_${this.getLang}`].substring(0, this.data.model.employer[`address_${this.getLang}`].lastIndexOf(", "))+', '+this.data.model.employer[`street_${this.getLang}`]
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
            this.$swal(
                {
                    title: '<p>თქვენი ვაკანსია</p>',
                    // icon: 'info',
                    html:
                        `${this.m.vacancy[`address_${this.getLang}`]}_ზე ${this.m.vacancy[`for_who_${this.getLang}`]} გვესაჭიროება ${this.m.vacancy.category_id[`name_${this.getLang}`]}. ${this.m.vacancy.work_schedule_id[`name_${this.getLang}`]} გრაფიკით, ${this.m.vacancy[`additional_schedule_${this.getLang}`]}. ანაზღაურება: ${this.m.vacancy.payment} ${this.m.vacancy.currency_id[`name_${this.getLang}`]}.  ${`დამატებით: `+this.m.vacancy[`additional_${this.getLang}`]} `,
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false,
                    confirmButtonText: 'დამატება',
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    let currentObj = this
                    this.loader = true
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
    mounted(){
        console.log('this.data', this.data);
    }
}
</script>
<style lang="">

</style>
