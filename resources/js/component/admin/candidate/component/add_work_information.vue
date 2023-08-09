<template lang="">
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
        <div class="row col-md-12" >
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group">
                    <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_schedule_title') }}</label>
                    <div class="ls-inputicon-box">
                        <multiselect v-model="m.work_schedule"  :options="cla.workSchedule" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name_ka" track-by="name_ka" :preselect-first="false" @blur="v$.m.work_schedule.$touch">
                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                        </multiselect>
                        <span v-if="v$.m.work_schedule.required.$invalid && v$.m.work_schedule.$dirty" style='color:red'>* {{ v$.m.work_schedule.required.$message}}</span>
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
        <div class="row col-md-12" v-if=" m.category.id == 1 || m.category.id == 2 || m.category.id == 4">
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
        <div class="col-sm-12 d-flex justify-content-end">
            <button class="btn btn-success" @click.prevent="add()"> დამატება</button>
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
            items:[],
            // m.work_schedule: [],
            showAdditionalSchedule:false,
        }
    },
    validations () {
        const validations = {
            m:{
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
                additional_schedule_en:{},
                additional_schedule_ru:{},
                work_schedule:{required:helpers.withMessage('სამუშაო გრაფიკის არჩევა სავალდებულოა', required )},

            },

        }
        if (this.m.work_schedule != '' &&  this.m.work_schedule[0].id == 9) {
            if (this.getLang == 'ka') {
                validations.m.additional_schedule_ka = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
            }else if(this.getLang == 'en'){
                validations.m.additional_schedule_en = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
            }else if(this.getLang == 'ru'){
                validations.m.additional_schedule_ru = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
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
        this.m = {...this.data.model.workInformation}
        this.m.stay_night = 0;
        this.m.go_vacation = 0;
        this.m.work_additional_hours = 0;
        this.items = this.data.model.getWorkInformation
        this.cla = this.data.cla
        this.m.user_id = this.data.user_id
//
    },
    methods: {
        async add(){
            const isFormCorrect = await this.v$.m.$validate()
            if (!isFormCorrect) return;
            if (this.items.length > 0 && this.items.some((element) => element.category_id === this.m.category.id)) {
                toast.error('არჩეულ კატეგორიაზე უკვე გაქვთ ინფორმაცია შევსებული', {
                    theme: 'colored',
                    autoClose: 1000,
                });
                return
            }
            this.m.lang = this.getLang
            this.m.candidate_id = this.data.candidate_id
            let currentObj = this;
            axios({
                method: "post",
                url: "/add_work_information",
                data: {'model':this.m, 'type': 'work_information'},

            })
            .then(function (response) {

                // handle success
                if (response.data.status == 200) {
                    toast.success("წარმატებით დაემატა", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    currentObj.items.push(response.data.data)
                    currentObj.m.category = '';
                    currentObj.m.work_schedule = '';
                    currentObj.m.payment = 800;
                    currentObj.m.currency = '';
                }

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        remove(index, id){
            this.$swal({
                title: 'ნამდვილად გსურთ წაშლა?',
                //   showDenyButton: true,
                cancelButtonText:'არა',
                confirmButtonText: 'კი',
                showCancelButton: true,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    const removed = this.m.splice(index, 1);
                    axios({
                        method: "post",
                        url: "/delete_candidate_info",
                        data: {'id':id, 'type': 'work_information'},

                    })
                    .then(function (response) {
                        if (response.data.status == 200) {
                            toast.success("წარმატებით წაიშალა", {
                                theme: 'colored',
                                autoClose: 1000,
                            });
                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })

                } else if (result.isDenied) {
                    return
                }
            });


        },
    },
    watch:{
        'm.work_schedule': function (newVal, oldVa) {
            this.showAdditionalSchedule = _.find(newVal, function(o) { if(o.id == 9) return true; });
        },
    }
}
</script>
<style lang="">

</style>
