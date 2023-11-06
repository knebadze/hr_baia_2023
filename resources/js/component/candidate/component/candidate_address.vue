<template lang="">


    <!-- address -->
    <div class="panel panel-default">
        <div class="panel-heading wt-panel-heading p-a20">
            <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_address') }}</h4>
        </div>
        <div class="panel-body wt-panel-body p-a20 m-b30 ">
            <p>{{ $t('lang.user_profile_page_address_map') }}</p>
            <p>{{ $t('lang.user_profile_page_address_map_2') }}</p>
            <form @submit.prevent="validateAndEmit()">
                <div class="row">
                    <!-- <address_maplibre></address_maplibre> -->
                    <!-- <addressMap :data="m.address" @messageFromChild="childMessage"></addressMap> -->
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_address') }}</label>
                            <div class="ls-inputicon-box">
                                <input
                                    class="form-control"
                                    :class="{ 'is-invalid': (m.address == null || v.address.$error) }"
                                    v-model="m.address"
                                    type="text"
                                    placeholder=""
                                    @blur="v.address.$touch"
                                >
                                <i class="fs-input-icon fa fa-user"></i>
                                <span v-if="send && !v.address.required.$response" style='color:red'>* </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>{{ $t('lang.user_profile_page_street') }}</label>
                            <div class="ls-inputicon-box">
                                <input
                                    class="form-control"
                                    v-model="m[`street_${getLang}`]"
                                    type="text"
                                    placeholder=""
                                >
                                <i class="fs-input-icon fa fa-user"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
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
        const send = ref(false);
        const cla = ref(props.data.cla)
        const formData = { ...props.data.model };
        // formData.user_id = props.data.user_id;
        // formData.lang = getLang;
        formData.address = props.data.model[`address_${getLang.value}`];

        const m = ref(formData);
        const saveButton  = ref(false);

        const rules = {
            address: { required },
        };

        const v = useVuelidate(rules, m);


        const validateAndSubmit = (item) => {
            let data = {...item}
            data[`address_${getLang.value}`] = m.value.address
            return data

        };
        const validateAndEmit = async () => {

            v.value.$touch();
            if (!v.value.$invalid) {
                let data = validateAndSubmit(m.value)
                const isFormValid = !v.value.$invalid;
                emit("validateAndEmit", isFormValid, data, 'address', saveButton.value);
            }else{
                toast.warning("აუცილებელია სავალდებულო ველები იყოს შევსებული", {
                    theme: 'colored',
                    autoClose: 2000,
                });
            }
        }
        watch(m.value, (newVal) => {
            saveButton.value = true
        });


        return {
            m,
            cla,
            validateAndSubmit,
            v,
            getLang,
            validateAndEmit,
            send

        };
    },
};
</script>
