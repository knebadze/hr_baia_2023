<template lang="">
    <!--Basic Information-->
    <div class="panel panel-default">
        <div class="panel-heading wt-panel-heading p-a20">
            <h4 class="panel-tittle m-a0">
                {{ $t("lang.user_profile_page_input_basic_info") }}
            </h4>
        </div>
        <div class="panel-body wt-panel-body p-a20 m-b30">
            <form @submit.prevent="validateAndEmit()">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label
                                ><span class="text-danger">* </span
                                >{{ $t("სახელი და გვარი") }}</label
                            >
                            <div class="ls-inputicon-box">
                                <input
                                    class="form-control"
                                    :class="
                                        m.name == null || v.name.$error
                                            ? 'is-invalid'
                                            : ''
                                    "
                                    v-model="m.name"
                                    type="text"
                                    placeholder=""
                                    @blur="v.name.$touch"
                                />
                                <!-- <i class="fs-input-icon fa fa-user"></i> -->
                                <span
                                    v-if="
                                        m.name !== null &&
                                        !v.name.required.$response
                                    "
                                    style="color: red"
                                    >*{{ $t(v.name.required.$message) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label
                                ><span class="text-danger">* </span
                                >{{
                                    $t("lang.user_profile_page_input_phone")
                                }}</label
                            >
                            <div class="ls-inputicon-box">
                                <input
                                    class="form-control"
                                    :class="
                                        m.number == null || v.number.$error
                                            ? 'is-invalid'
                                            : ''
                                    "
                                    v-model="m.number"
                                    type="text"
                                    @blur="v.number.$touch"
                                    onkeypress="return /[0-9]/i.test(event.key)"
                                    maxLength="9"
                                />
                                <!-- <i class="fs-input-icon fa fa-phone-alt"></i> -->
                                <span
                                    v-if="!v.number.required.$response"
                                    style="color: red"
                                    >*{{ $t(v.number.required.$message) }}
                                </span>
                                <span
                                    v-if="!v.number.numeric.$response"
                                    style="color: red"
                                    >*{{ $t(v.number.numeric.$message) }}
                                </span>
                                <span
                                    v-if="!v.number.maxLength.$response"
                                    style="color: red"
                                    >*
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>
                                {{
                                    $t("lang.user_profile_page_input_email")
                                }}</label
                            >
                            <div class="ls-inputicon-box">
                                <input
                                    class="form-control"
                                    :class="
                                         v.email.$error
                                            ? 'is-invalid'
                                            : ''
                                    "
                                    v-model="m.email"
                                    type="email"
                                    placeholder=""
                                    @blur="v.email.$touch"
                                />
                                <!-- <i class="fs-input-icon fas fa-at"></i> -->

                            </div>
                            <div v-for="(item, index) in rules.email" :key="index">
                                <span
                                    v-if="!v.email[index].$response"
                                    style="color: red"
                                    >* {{ $t(v.email[index].$message) }}</span
                                >
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label
                                ><span class="text-danger">* </span
                                >{{
                                    $t(
                                        "lang.user_profile_page_input_birth_date"
                                    )
                                }}</label
                            >
                            <div class="ls-inputicon-box">
                                <input
                                    class="form-control"
                                    auth-provide=""
                                    type="date"
                                    v-model="m.date_of_birth"
                                    placeholder="mm/dd/yyyy"
                                    @blur="v.date_of_birth.$touch"
                                />
                                <!-- <i class="fs-input-icon far fa-calendar"></i> -->
                                <span
                                    v-if="!v.date_of_birth.required.$response"
                                    style="color: red"
                                    >*{{
                                        $t(v.date_of_birth.required.$message)
                                    }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label
                                ><span class="text-danger">* </span
                                >{{
                                    $t("lang.user_profile_page_input_gender")
                                }}</label
                            >
                            <div class="ls-inputicon-box">
                                <multiselect
                                    v-model="m.gender"
                                    :options="cla.gender"
                                    deselect-label="Can't remove this value"
                                    :track-by="`name_${getLang}`"
                                    :label="`name_${getLang}`"
                                    placeholder="Select one"
                                    :searchable="true"
                                    :allow-empty="false"
                                    @blur="v.gender.$touch"
                                >
                                    <template
                                        slot="singleLabel"
                                        slot-scope="{ option }"
                                    ></template>
                                </multiselect>
                                <span
                                    v-if="!v.gender.required.$response"
                                    style="color: red"
                                    >*{{ $t(v.gender.required.$message) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-lg-12 col-md-12 mt-4 d-flex justify-content-center" >
                    <button type="submit"  class="site-button" >{{ $t('lang.user_profile_page_button_save_changes') }}</button>
                </div> -->
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import { ref, computed, watch, reactive } from "vue";
import { I18n } from "laravel-vue-i18n";
import { useVuelidate } from "@vuelidate/core";
import {
    required,
    email,
    numeric,
    maxLength,
    helpers,
} from "@vuelidate/validators";
export default {
    emits: ["validateAndEmit", "validateAndSubmit"],
    props: {
        data: Object,
    },
    setup(props, { emit }) {
        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });
        const cla = ref(props.data.cla);
        const formData = { ...props.data.model };
        formData.name = props.data.model[`name_${getLang.value}`];
        const m = ref(formData);
        const saveButton = ref(false);

        const rules = reactive({
            name: {
                required: helpers.withMessage(
                    "lang.validation_error.required",
                    required
                ),
            },
            number: {
                required: helpers.withMessage(
                    "lang.validation_error.required",
                    required
                ),
                numeric: helpers.withMessage(
                    "lang.validation_error.numeric",
                    numeric
                ),
                maxLength: maxLength(9),
            },
            email: {
                // required: helpers.withMessage(
                //     "lang.validation_error.required",
                //     required
                // ),
                email: helpers.withMessage(
                    "lang.validation_error.email",
                    email
                ),
            },
            gender: {
                required: helpers.withMessage(
                    "lang.validation_error.required",
                    required
                ),
            },
            date_of_birth: {
                required: helpers.withMessage(
                    "lang.validation_error.required",
                    required
                ),
            },
        });

        const v = useVuelidate(rules, m);

        const validateAndSubmit = (item) => {
            let data = { ...item };
            // v.value.$touch();
            // if (!v.value.$invalid) {
            data[`name_${getLang.value}`] = m.value.name;
            return data;
            // }else {
            //     toast.error("შეავსეთ სავალდებულო ველები", {
            //         theme: 'colored',
            //         autoClose: 2000,
            //     });
            //     return
            // }
        };
        const validateAndEmit = async () => {
            v.value.$touch();
            if (!v.value.$invalid) {
                let data = validateAndSubmit(m.value);
                const isFormValid = !v.value.$invalid;
                emit(
                    "validateAndEmit",
                    isFormValid,
                    data,
                    "main",
                    saveButton.value
                );
            } else {
                toast.error("შეავსეთ სავალდებულო ველები", {
                    theme: "colored",
                    autoClose: 2000,
                });
            }
        };

        watch(m.value, (newVal) => {
            saveButton.value = true;
        });

        return {
            m,
            cla,
            //   validateAndSubmit,
            v,
            getLang,
            rules,
            validateAndEmit,
        };
    },
};
</script>
