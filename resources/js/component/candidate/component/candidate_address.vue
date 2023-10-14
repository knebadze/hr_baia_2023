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
                            <input class="form-control" v-model="m.address" type="text" placeholder=""  @blur="v.address.$touch">
                            <i class="fs-input-icon fa fa-user"></i>
                            <span v-if="!v.address.required.$response" style='color:red'>* </span>
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
                    <button type="submit" @click.prevent="validateAndSubmit()"  class="site-button">{{ $t('lang.user_profile_page_social_button_save') }}</button>
                </div>

            </div>
        </div>
    </div>

    <!--Additional information-->


</template>
<script>
import { ref, computed, watch } from 'vue';
import { I18n } from 'laravel-vue-i18n';
import { useVuelidate } from '@vuelidate/core';
import { required, email, numeric, maxLength } from '@vuelidate/validators';

export default {
    emits: ['validateAndEmit'],
    props: {
        data: Object,
    },
    setup(props, { emit }) {
        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });

        const cla = ref(props.data.cla)
        const formData = { ...props.data.model };
        formData.user_id = props.data.user_id;
        formData.getLang = getLang;
        formData.address = props.data.model[`address_${getLang.value}`];

        const m = ref(formData);

        const rules = {
            address: { required },
        };

        const v = useVuelidate(rules, m);


        const validateAndSubmit = () => {
            v.value.$touch();
            if (!v.value.$invalid) {
                m.value[`address_${getLang.value}`] = m.value.address

                axios({
                    method: "post",
                    url: "/add_candidate",
                    data: {'model':m.value, 'type': 'address'},
                })
                .then(function (response) {
                    // handle success
                    if (response.status == 200) {
                        toast.success("ინფორმაცია წარმატებით შეინახა", {
                            theme: 'colored',
                            autoClose: 2000,
                        });
                    }


                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            }else{
                toast.warning("აუცილებელია სავალდებულო ველები იყოს შევსებული", {
                    theme: 'colored',
                    autoClose: 2000,
                });
            }
        };
        const validateAndEmit = () => {
            const isFormValid = !v.value.$invalid;
            emit("validateAndEmit", isFormValid);
        }


        return {
            m,
            cla,
            validateAndSubmit,
            v,
            getLang,
            validateAndEmit,

        };
    },
};
</script>
