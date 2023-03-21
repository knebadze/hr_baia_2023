<template lang="">
    <div class="col-xl-9 col-lg-8 col-md-12 m-b30">
        <!--Filter Short By-->
        <div class="twm-right-section-panel site-bg-gray">
            <mainInfo :data="m.user" :genderCLA="data.classificator.gender"></mainInfo>
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">{{ ('პირადი ინფორმაცია') }}</h4>
                    <!-- <small class="text-danger">* აუცილებლად შესავსები ველები</small> -->
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30 ">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ 'კომპანიის სახელი' }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.company[`company_name_${getLang}`]" type="text" placeholder=""  @blur="v$.m.company[`company_name_${getLang}`].$touch">
                                    <i class="fs-input-icon fa fa-user"></i>
                                    <span v-if="v$.m.company[`company_name_${getLang}`].required.$invalid && v$.m.company[`company_name_${getLang}`].$dirty" style='color:red'>* {{ v$.m.company[`company_name_${getLang}`].required.$message}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ 'კომპანიის ობიექტის ტიპი' }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.company.company_object_type" :options="data.classificator.companyObjectType" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false" @blur="v$.m.company.company_object_type.$touch">
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                    <span v-if="v$.m.company.company_object_type.required.$invalid && v$.m.company.company_object_type.$dirty" style='color:red'>* {{ v$.m.company.company_object_type.required.$message}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ 'ჩაწერე ობიექტის ტიპი' }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.company[`object_type_${getLang}`]" type="text" placeholder=""  >
                                    <i class="fs-input-icon fa fa-user"></i>
                                    <!-- <span v-if="v$.m.candidate.personal_number.required.$invalid && v$.m.candidate.personal_number.$dirty" style='color:red'>* {{ v$.m.candidate.personal_number.required.$message}}</span> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ 'თქვენი პოზიცია კომპანიაში?' }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.company.position" type="text" placeholder=""  @blur="v$.m.company.position.$touch">
                                    <i class="fs-input-icon fa fa-user"></i>
                                    <span v-if="v$.m.company.position.required.$invalid && v$.m.company.position.$dirty" style='color:red'>* {{ v$.m.company.position.required.$message}}</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-danger">მისამართი უმჯობესია მოიძებნოს რუკაზე</p>
                        <addressMap  @messageFromChild="childMessage"></addressMap>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ 'მისამართი' }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.company[`address_${getLang}`]" type="text" placeholder=""  @blur="v$.m.company[`address_${getLang}`].$touch">
                                    <i class="fs-input-icon fa fa-user"></i>
                                    <span v-if="v$.m.company[`address_${getLang}`].required.$invalid && v$.m.company[`address_${getLang}`].$dirty" style='color:red'>* {{ v$.m.company[`address_${getLang}`].required.$message}}</span>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ 'ქუჩა' }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.company[`street_${getLang}`]" type="text" placeholder=""  >
                                    <i class="fs-input-icon fa fa-user"></i>
                                    <!-- <span v-if="v$.m.candidate.personal_number.required.$invalid && v$.m.candidate.personal_number.$dirty" style='color:red'>* {{ v$.m.candidate.personal_number.required.$message}}</span> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.user_profile_page_social_facebook') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control wt-form-control" v-model="m.company.fb_link"  type="text" placeholder="https://www.facebook.com/">
                                    <i class="fs-input-icon fab fa-facebook-f"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="text-left">
                                <button type="submit" @click.prevent="addCompany()"  class="site-button">{{ $t('lang.user_profile_page_social_button_save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
import mainInfo from '../candidate/mainInfo.vue';
import addressMap from '../map/address_map.vue'
import { useVuelidate } from '@vuelidate/core'
import { required, email, helpers, requiredIf, numeric, maxLength } from '@vuelidate/validators'
export default {
    setup () {
        return { v$: useVuelidate() }
    },
    components:{
        mainInfo,
        addressMap,
    },
    props:{
        data: Object,
    },
    data() {
        return {
            m:null
        }
    },
    validations(){
        const validations = {
            m:{
                company:{
                    company_name_ka:{},
                    company_name_en:{},
                    company_name_ru:{},
                    address_ka:{},
                    address_en:{},
                    address_ru:{},
                    company_object_type:{required: helpers.withMessage('არჩევა სავალდებულოა', required)},
                    object_type_ka:{},
                    object_type_en:{},
                    object_type_ru:{},
                    position:{required: helpers.withMessage('არჩევა სავალდებულოა', required)}
                }
            }
        }
        if (this.getLang == 'ka') {
            validations.m.company.address_ka = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
            validations.m.company.company_name_ka = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
            // validations.m.company.object_type_ka = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
        }else if(this.getLang == 'en'){
            validations.m.company.address_en = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
            validations.m.company.company_name_en = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
            // validations.m.company.object_type_en = {required: helpers.withMessage('შევსება სავალდებულოა', required)}

        }else if(this.getLang == 'ru'){
            validations.m.company.address_ru = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
            validations.m.company.company_name_ru = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
            // validations.m.company.object_type_ru = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
        }
        return validations
    },
    created(){
        this.m = { ...this.data.company, ...this.data.basic };
        console.log('this.m', this.m);
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
    },
    methods:{
        childMessage(arg){
            this.m.company[`address_${this.getLang}`] = arg.name
            this.m.company.latitude = arg.lngLat.lat
            this.m.company.longitude = arg.lngLat.lng
            // console.log('this.m.candidate.latitude', this.m.company.latitude);
        },
        async addCompany(){
            const isFormCorrect = await this.v$.$validate()
            if (!isFormCorrect) return;
            this.m.company['lang'] = this.getLang
            let currentObj = this;
            // console.log('currentObj',currentObj);
            axios({
                method: "post",
                url: "/add_company",
                data: this.m.company,
            })
            .then(function (response) {
                // handle success
                console.log('response.data',response.data);
                if (response.data.status == 200) {
                    // currentObj.candidate_id = response.data.data;
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
        }
    }
}
</script>
<style lang="">

</style>
