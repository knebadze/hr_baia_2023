<template lang="">
    <div class="col-xl-9 col-lg-8 col-md-12 m-b30 employerPageBorder">
        <!--Filter Short By-->
        <div class="twm-right-section-panel site-bg-gray">
            <mainInfo :data="m.user" :genderCLA="data.classificator.gender"></mainInfo>
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">{{ $t('lang.employer_profile_page_personal_info') }}</h4>
                    <!-- <small class="text-danger">* აუცილებლად შესავსები ველები</small> -->
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30 ">
                    <div class="row">
                        <addressMap  @messageFromChild="childMessage"></addressMap>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.employer_profile_page_address') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.employer[`address_${getLang}`]" type="text" placeholder=""  @blur="v$.m.employer[`address_${getLang}`].$touch">
                                    <i class="fs-input-icon fa fa-user"></i>
                                    <span v-if="v$.m.employer[`address_${getLang}`].required.$invalid && v$.m.employer[`address_${getLang}`].$dirty" style='color:red'>* {{ v$.m.employer[`address_${getLang}`].required.$message}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ $t('lang.employer_profile_page_street') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.employer[`street_${getLang}`]" type="text" placeholder=""  >
                                    <i class="fs-input-icon fa fa-user"></i>
                                    <!-- <span v-if="v$.m.candidate.personal_number.required.$invalid && v$.m.candidate.personal_number.$dirty" style='color:red'>* {{ v$.m.candidate.personal_number.required.$message}}</span> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>{{ $t('lang.user_profile_page_social_facebook') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control wt-form-control" v-model="m.employer.fb_link"  type="text" placeholder="https://www.facebook.com/">
                                    <i class="fs-input-icon fab fa-facebook-f"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="text-left">
                                <button type="submit" @click.prevent="addEmployer()"  class="site-button">{{ $t('lang.user_profile_page_social_button_save') }}</button>
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
import mainInfo from '../candidate/mainInfo.vue';
import addressMap from '../map/address_map.vue'
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
                employer:{
                    address_ka:{},
                    address_en:{},
                    address_ru:{},
                }
            }
        }
        if (this.getLang == 'ka') {
                validations.m.employer.address_ka = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
            }else if(this.getLang == 'en'){
                validations.m.employer.address_en = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
            }else if(this.getLang == 'ru'){
                validations.m.employer.address_ru = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
            }
        return validations
    },
    created(){
        this.m = { ...this.data.employer, ...this.data.basic };
        console.log('this.m', this.m);
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
    },
    methods:{
        childMessage(arg){
            this.m.employer[`address_${this.getLang}`] = arg.name
            this.m.employer.latitude = arg.lngLat.lat
            this.m.employer.longitude = arg.lngLat.lng
            console.log('this.m.candidate.latitude', this.m.employer.latitude);
        },
        async addEmployer(){
            const isFormCorrect = await this.v$.$validate()
            if (!isFormCorrect) return;
            this.m.employer['lang'] = this.getLang
            let currentObj = this;
            // console.log('currentObj',currentObj);
            axios({
                method: "post",
                url: "/add_employer",
                data: this.m.employer,
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
