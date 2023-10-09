<template lang="">


    <!-- address -->
    <div class="panel panel-default">
        <div class="panel-heading wt-panel-heading p-a20">
            <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_address') }}</h4>
        </div>
        <div class="panel-body wt-panel-body p-a20 m-b30 ">
            <p>{{ $t('lang.user_profile_page_address_map') }}</p>
            <p>{{ $t('lang.user_profile_page_address_map_2') }}</p>
            <div class="row">
                <!-- <address_maplibre></address_maplibre> -->
                <!-- <addressMap :data="m.address" @messageFromChild="childMessage"></addressMap> -->
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_address') }}</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control" v-model="m[`address_${getLang}`]" type="text" placeholder=""  @blur="v$.m[`address_${getLang}`].$touch">
                            <i class="fs-input-icon fa fa-user"></i>
                            <span v-if="v$.m[`address_${getLang}`].required.$invalid && v$.m[`address_${getLang}`].$dirty" style='color:red'>* {{ v$.m[`address_${getLang}`].required.$message}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ $t('lang.user_profile_page_street') }}</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control" v-model="m[`street_${getLang}`]" type="text" placeholder=""  >
                            <i class="fs-input-icon fa fa-user"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                    <button type="submit" @click.prevent="add()"  class="site-button">{{ $t('lang.user_profile_page_social_button_save') }}</button>
                </div>

            </div>
        </div>
    </div>

    <!--Additional information-->


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
            cla: null
        }
    },
    validations () {
        const validations = {
            m:{

                address_ka:{},
                address_en:{},
                address_ru:{},

            },
        }

        if (this.getLang == 'ka') {
            validations.m.address_ka = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
        }else if(this.getLang == 'en'){
            validations.m.address_en = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
        }else if(this.getLang == 'ru'){
            validations.m.address_ru = {required: helpers.withMessage('შევსება სავალდებულოა', required)}
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

        this.m.user_id = this.data.user_id

    },
    methods: {
        async add(){
            const isFormCorrect = await this.v$.$validate()
            if (!isFormCorrect) return;
            this.m['lang'] = this.getLang
            let currentObj = this;
            axios({
                method: "post",
                url: "/add_candidate",
                data: {'model':this.m, 'type': 'address'},

            })
            .then(function (response) {
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
<style>

</style>
