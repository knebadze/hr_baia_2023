<template lang="">
<!--Basic Information-->
<div class="panel panel-default">
    <div class="panel-heading wt-panel-heading p-a20">
        <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_input_basic_info') }}</h4>
    </div>
    <div class="panel-body wt-panel-body p-a20 m-b30 ">
        <form @submit.prevent="authUpdate()">
            <div class="row" >

                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ $t('lang.user_profile_page_input_name') }}</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control" v-model="m[`name_${getLang}`]"  type="text" placeholder="">
                            <i class="fs-input-icon fa fa-user "></i>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ $t('lang.user_profile_page_input_phone') }}</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control " :class="(m.number == null || v$.m.number.$error)?'is-invalid':''"  v-model="m.number" type="text" @blur="v$.m.number.$touch">
                            <i class="fs-input-icon fa fa-phone-alt"></i>
                            <span v-if="v$.m.number.required.$invalid && v$.m.number.$dirty" style='color:red'>* {{ v$.m.number.required.$message}}</span>
                            <span v-if="v$.m.number.numeric.$invalid && v$.m.number.$dirty" style='color:red'>* {{ v$.m.number.numeric.$message}}</span>
                            <span v-if="v$.m.number.maxLength.$invalid && v$.m.number.$dirty" style='color:red'>* {{ v$.m.number.maxLength.$message}}</span>

                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ $t('lang.user_profile_page_input_email') }}</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control"  v-model="m.email" type="email" placeholder="">
                            <i class="fs-input-icon fas fa-at"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ $t('lang.user_profile_page_input_birth_date') }}</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control d" auth-provide=""  type="date" v-model="m.date_of_birth" placeholder="mm/dd/yyyy" @blur="v$.m.date_of_birth.$touch">
                            <i class="fs-input-icon far fa-calendar"></i>
                            <span v-if="v$.m.date_of_birth.required.$invalid && v$.m.date_of_birth.$dirty" style='color:red'>* {{ v$.m.date_of_birth.required.$message}}</span>
                        </div>
                    </div>
                </div>
                <!--Gender-->
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ $t('lang.user_profile_page_input_gender') }}</label>
                        <div class="ls-inputicon-box">
                            <multiselect v-model="m.gender" :options="cla.gender" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one" :searchable="true" :allow-empty="false" @blur="v$.m.gender_id.$touch">
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                            <span v-if="v$.m.gender_id.required.$invalid && v$.m.gender_id.$dirty" style='color:red'>* {{ v$.m.gender_id.required.$message}}</span>
                        </div>
                    </div>
                </div>



                <div class="col-lg-12 col-md-12 mt-4 d-flex justify-content-center" >
                    <button type="" class="site-button" >{{ $t('lang.user_profile_page_button_save_changes') }}</button>
                </div>


            </div>
        </form>
    </div>
</div>
</template>
<script>
import { I18n } from 'laravel-vue-i18n'
import { useVuelidate } from '@vuelidate/core'
import { required, email, helpers,  numeric, maxLength } from '@vuelidate/validators'
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
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
            cla:{}
        }
    },
    validations () {
        const validations = {
                m:{
                    number: {
                        required: helpers.withMessage('ნომრის შევსება სავალდებულოა', required ),
                        numeric: helpers.withMessage('ნომრი უნდა შედგებოდეს მხოლოდ ციფრებისგან', numeric ),
                        maxLength: helpers.withMessage('ნომრი უნდა შედგებოდეს 9 ციფრებისგან', maxLength(9) )
                    },
                    gender_id: {required: helpers.withMessage('სქესის არჩევა სავალდებულოა', required )},
                    date_of_birth: {required: helpers.withMessage('დაბადების თარიღის შევსება სავალდებულოა', required )}

                },
        }
        return validations
    },
    created(){
        console.log('this.data',this.data);
        this.m = {...this.data.model}
        this.cla = this.data.cla
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
    },
    methods:{
        async authUpdate(){
            // console.log(this.auth);
            // console.log('this.v$.$validate()', this.v$);
            const isFormCorrect = await this.v$.$validate()
            if (!isFormCorrect) return;
            axios({
                method: "post",
                url: "/profile_update",
                data: this.m
            })
            .then(function (response) {
                // handle success
                console.log(response);
                if (response.status == 200) {
                    toast.success("წარმატებით განახლდა", {
                        theme: 'colored',
                        autoClose: 2000,
                    });
                }


            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })

        },
    },
    mounted(){
        console.log('data',this.data);
    }
}
</script>

