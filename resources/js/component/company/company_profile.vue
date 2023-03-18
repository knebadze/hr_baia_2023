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
                                    <input class="form-control" v-model="m.company[`company_name_${getLang}`]" type="text" placeholder=""  >
                                    <i class="fs-input-icon fa fa-user"></i>
                                    <!-- <span v-if="v$.m.candidate.personal_number.required.$invalid && v$.m.candidate.personal_number.$dirty" style='color:red'>* {{ v$.m.candidate.personal_number.required.$message}}</span> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ 'კომპანიის ობიექტის ტიპი' }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect v-model="m.company.company_object_type" :options="data.classificator.companyObjectType" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                    <!-- <i class="fs-input-icon fa fa-user"></i> -->
                                    <!-- <span v-if="v$.m.candidate.personal_number.required.$invalid && v$.m.candidate.personal_number.$dirty" style='color:red'>* {{ v$.m.candidate.personal_number.required.$message}}</span> -->
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
                                    <input class="form-control" v-model="m.company.position" type="text" placeholder=""  >
                                    <i class="fs-input-icon fa fa-user"></i>
                                    <!-- <span v-if="v$.m.candidate.personal_number.required.$invalid && v$.m.candidate.personal_number.$dirty" style='color:red'>* {{ v$.m.candidate.personal_number.required.$message}}</span> -->
                                </div>
                            </div>
                        </div>
                        <p class="text-danger">მისამართი უმჯობესია მოიძებნოს რუკაზე</p>
                        <addressMap  @messageFromChild="childMessage"></addressMap>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label><span class="text-danger">* </span>{{ 'მისამართი' }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" v-model="m.company[`address_${getLang}`]" type="text" placeholder=""  >
                                    <i class="fs-input-icon fa fa-user"></i>
                                    <!-- <span v-if="v$.m.candidate.personal_number.required.$invalid && v$.m.candidate.personal_number.$dirty" style='color:red'>* {{ v$.m.candidate.personal_number.required.$message}}</span> -->
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
export default {
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
        addCompany(){
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
