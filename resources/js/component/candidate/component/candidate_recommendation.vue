<template lang="">
    <div class="panel panel-default">
        <div class="panel-heading wt-panel-heading p-a20">
            <h4 class="panel-tittle m-a0">
                {{ $t("lang.user_profile_page_recomendation_title") }}
            </h4>
        </div>
        <div class="panel-body wt-panel-body p-a20 m-b30">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label
                            ><span class="text-danger">* </span
                            >{{
                                $t("lang.user_profile_page_recomendation_from")
                            }}</label
                        >
                        <div class="ls-inputicon-box">
                            <multiselect
                                v-model="model.has_recommendation"
                                :options="cla.yesNo"
                                deselect-label="Can't remove this value"
                                :track-by="`name_${getLang}`"
                                :label="`name_${getLang}`"
                                placeholder="Select one"
                                :searchable="false"
                                :allow-empty="false"
                                :disabled="m.length > 0"
                                @blur="v.has_recommendation.$touch"
                            >
                                <template
                                    slot="singleLabel"
                                    slot-scope="{ option }"
                                ></template>
                            </multiselect>
                            <span
                                v-if="
                                    send &&
                                    !v.has_recommendation.required.$response
                                "
                                style="color: red"
                                >*
                            </span>
                        </div>
                    </div>
                </div>
                <div
                    class="row"
                    v-if="
                        model.has_recommendation &&
                        model.has_recommendation.id == 1
                    "
                >
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label
                                ><span class="text-danger">* </span
                                >{{
                                    $t(
                                        "lang.user_profile_page_recomendation_where_from"
                                    )
                                }}</label
                            >
                            <div class="ls-inputicon-box">
                                <multiselect
                                    v-model="model.recommendation_whom"
                                    :options="cla.recommendationFromWhom"
                                    deselect-label="Can't remove this value"
                                    :track-by="`name_${getLang}`"
                                    :label="`name_${getLang}`"
                                    placeholder="Select one"
                                    :searchable="false"
                                    :allow-empty="false"
                                    @blur="v.recommendation_whom.$touch"
                                >
                                    <template
                                        slot="singleLabel"
                                        slot-scope="{ option }"
                                    ></template>
                                </multiselect>
                                <span
                                    v-if="
                                        send &&
                                        !v.recommendation_whom.required
                                            .$response
                                    "
                                    style="color: red"
                                    >*
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label
                                ><span class="text-danger">* </span
                                >{{
                                    $t(
                                        "lang.user_profile_page_recomendation_name"
                                    )
                                }}</label
                            >
                            <div class="ls-inputicon-box">
                                <input
                                    class="form-control"
                                    v-model="model.name"
                                    type="text"
                                    placeholder=""
                                    @blur="v.name.$touch"
                                />
                                <i class="fs-input-icon fa fa-star"></i>
                                <span
                                    v-if="send && !v.name.required.$response"
                                    style="color: red"
                                    >*
                                </span>
                            </div>
                        </div>
                    </div>
                    <div
                        v-if="model.recommendation_whom.id == 2"
                        class="col-xl-6 col-lg-6 col-md-12"
                    >
                        <div class="form-group">
                            <label
                                ><span class="text-danger">* </span
                                >თანამდებობა</label
                            >
                            <div class="ls-inputicon-box">
                                <input
                                    class="form-control"
                                    v-model="model.position"
                                    type="text"
                                    placeholder=""
                                    @blur="v.position.$touch"
                                />
                                <span
                                    v-if="
                                        send && !v.position.required.$response
                                    "
                                    style="color: red"
                                    >*
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label
                                ><span class="text-danger">* </span
                                >{{
                                    $t("lang.user_profile_page_number")
                                }}</label
                            >
                            <div class="input-group mb-3">
                                <button
                                    style="border-style: none"
                                    class="btn btn-outline-secondary dropdown-toggle"
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    <span
                                        :class="`fi fi-${model.number_code.iso.toLowerCase()}`"
                                    ></span
                                    >+{{ model.number_code.phonecode }}
                                </button>
                                <ul
                                    class="dropdown-menu"
                                    style="
                                        overflow: hidden;
                                        overflow-y: auto;
                                        max-height: calc(100vh - 550px);
                                    "
                                >
                                    <NumberCodeSearchInput
                                        :classificatory="data.cla.numberCode"
                                        @search="handleNumberCodeSearch"
                                    />
                                    <li
                                        v-for="item in cla.numberCode"
                                        @click="chooseNumberCode(item)"
                                    >
                                        <a class="dropdown-item"
                                            ><span
                                                :class="`fi fi-${item.iso.toLowerCase()}`"
                                            ></span
                                            >+{{ item.phonecode }}</a
                                        >
                                    </li>
                                </ul>
                                <input
                                    type="text"
                                    class="form-control"
                                    aria-label="Text input with dropdown button"
                                    v-model="model.number"
                                    placeholder="555666777"
                                    @blur="v.number.$touch"
                                    onkeypress="return /[0-9]/i.test(event.key)"
                                />
                                <span
                                    v-if="send && !v.number.required.$response"
                                    style="color: red"
                                    >*
                                </span>
                                <!-- <span v-if="v.number.numeric.$invalid && v.number.$dirty" style='color:red'>* {{ v.number.numeric.$message}}</span> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>ფაილი</label>
                            <small class="text-danger"> (pdf format)</small>
                            <div class="ls-inputicon-box">
                                <input
                                    class="form-control"
                                    type="file"
                                    ref="fileInput"
                                    @change="handleFileChange"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="row"
                    v-if="
                        model.has_recommendation &&
                        model.has_recommendation.id == 2
                    "
                >
                    <div class="col-md-12">
                        <div class="form-group">
                            <label
                                ><span class="text-danger">* </span
                                >რეკომენდაციის არ ქონის მიზეზი</label
                            >
                            <div class="ls-inputicon-box">
                                <multiselect
                                    v-model="model.no_reason"
                                    :options="cla.noRecommendationReason"
                                    deselect-label="Can't remove this value"
                                    :track-by="`name_${getLang}`"
                                    :label="`name_${getLang}`"
                                    placeholder="Select one"
                                    :searchable="false"
                                    :allow-empty="false"
                                    @blur="v.no_reason.$touch"
                                >
                                    <template
                                        slot="singleLabel"
                                        slot-scope="{ option }"
                                    ></template>
                                </multiselect>
                                <span
                                    v-if="
                                        send && !v.no_reason.required.$response
                                    "
                                    style="color: red"
                                    >*
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>დამატაბითი ინფორმაცია</label>
                            <textarea
                                class="form-control"
                                rows="3"
                                v-model="m[`no_reason_info_${getLang}`]"
                                placeholder="ჩაწერეთ იმ შემთხვევაში თუ ასარჩევ ველში ვერ ნახეთ შესაფერისი მიზეზი ან გსურთ დამატებითი ინფორმაციის მოწოდება"
                            ></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="text-right">
                        <button
                            class="btn btn-success"
                            @click.prevent="add(model)"
                            title="დამატება"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            :disabled="send"
                        >
                            დამატება
                            <span class="fa fa-plus"></span>
                        </button>
                    </div>
                </div>
                <div
                    v-if="m.length > 0 && m[0].has_recommendation.id == 1"
                    class="col-lg-12 col-md-12"
                >
                    <div class="panel-body wt-panel-body">
                        <div class="p-a20 table-responsive">
                            <table
                                class="table twm-table table-striped table-borderless"
                            >
                                <thead>
                                    <tr>
                                        <th>N</th>
                                        <th>
                                            {{
                                                $t(
                                                    "lang.user_profile_page_recomendation_from"
                                                )
                                            }}
                                        </th>
                                        <th>
                                            {{
                                                $t(
                                                    "lang.user_profile_page_recomendation_name"
                                                )
                                            }}
                                        </th>
                                        <th>
                                            {{
                                                $t(
                                                    "lang.user_profile_page_recomendation_number"
                                                )
                                            }}
                                        </th>
                                        <th>{{ $t("პოზიცია") }}</th>
                                        <th>
                                            {{
                                                $t(
                                                    "lang.user_profile_page_recomendation_file"
                                                )
                                            }}
                                        </th>
                                        <th>
                                            {{
                                                $t(
                                                    "lang.user_profile_page_work_actions_title"
                                                )
                                            }}
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(item, index) in m" :key="index">
                                        <td>{{ index + 1 }}</td>
                                        <td>
                                            <span
                                                :class="
                                                    item.recommendation_whom
                                                        .id == 1
                                                        ? 'badge bg-success p-2'
                                                        : 'badge bg-info text-dark p-2'
                                                "
                                                >{{
                                                    item.recommendation_whom[
                                                        `name_${getLang}`
                                                    ]
                                                }}</span
                                            >
                                        </td>
                                        <td>{{ item[`name_${getLang}`] }}</td>
                                        <td>
                                            {{
                                                `+${item.number_code.phonecode} ${item.number}`
                                            }}
                                        </td>
                                        <td>
                                            {{ item[`position_${getLang}`] }}
                                        </td>
                                        <td>
                                            <u
                                                class="text-primary"
                                                @click="openPDF(item.file_path)"
                                                >{{ item.file_name }}</u
                                            >
                                        </td>
                                        <td>
                                            <button
                                                @click="remove(index, item.id)"
                                                title="წაშლა"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                            >
                                                <i class="fa fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div
                    v-if="m.length > 0 && m[0].has_recommendation.id == 2"
                    class="col-lg-12 col-md-12"
                >
                    <div class="panel-body wt-panel-body">
                        <div class="p-a20 table-responsive">
                            <table
                                class="table twm-table table-striped table-borderless"
                            >
                                <thead>
                                    <tr>
                                        <th>არ ქონის მიზეზი</th>
                                        <th>დამატებითი ინფორმაცია</th>
                                        <th>action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(item, index) in m">
                                        <td>
                                            {{
                                                item.no_reason[
                                                    `name_${getLang}`
                                                ]
                                            }}
                                        </td>
                                        <td>
                                            {{
                                                item[
                                                    `no_reason_info_${getLang}`
                                                ]
                                                    ? item[
                                                          `no_reason_info_${getLang}`
                                                      ].substr(0, 30) + "..."
                                                    : ""
                                            }}
                                        </td>
                                        <td>
                                            <button
                                                @click="remove(index, item.id)"
                                                title="წაშლა"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                            >
                                                <i class="fa fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { ref, computed, watch } from "vue";
import { I18n } from "laravel-vue-i18n";
import { useVuelidate } from "@vuelidate/core";
import { required } from "@vuelidate/validators";
import _ from "lodash";
import Swal from "sweetalert2";
import NumberCodeSearchInput from "../../input/NumberCodeSearchInput.vue";
export default {
    components: {
        NumberCodeSearchInput,
    },
    emits: ["validateAndEmit"],
    props: {
        data: Object,
    },
    setup(props, { emit }) {
        const send = ref(false);
        const file = ref(null);
        const showNoRecommendation = ref(false);
        const cla = ref(_.cloneDeep(props.data.cla));
        const formData = { ...props.data.model.recommendation };

        const m = ref(props.data.model.candidateRecommendation);

        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });

        formData.lang = getLang;
        formData.user_id = props.data.model.user_id;
        formData.candidate_id = props.data.model.candidate_id;
        formData.number_code = cla.value.numberCode.find(
            (element) => element.phonecode == 995
        );
        formData.has_recommendation =
            m.value.length > 0
                ? m.value[0].has_recommendation
                : formData.has_recommendation;
        const model = ref(formData);

        const rules = {
            has_recommendation: { required },
            recommendation_whom: {
                required: withConditionalValidation(
                    (value) => model.value.has_recommendation.id == 1
                ),
            },
            name: {
                required: withConditionalValidation(
                    (value) => model.value.has_recommendation.id == 1
                ),
            },
            position: {
                required: withConditionalValidation(
                    (value) =>
                        model.value.has_recommendation.id == 1 &&
                        model.value.recommendation_whom.id == 2
                ),
            },
            number: {
                required: withConditionalValidation(
                    (value) => model.value.has_recommendation.id == 1
                ),
            },

            no_reason: {
                required: withConditionalValidation(
                    (value) => model.value.has_recommendation.id == 2
                ),
            },
        };

        const v = useVuelidate(rules, model);
        function withConditionalValidation(condition) {
            return (value) => {
                return !condition(value) || !!value;
            };
        }

        const chooseNumberCode = (item) => {
            model.value.number_code = item;
        };
        const handleFileChange = (event) => {
            file.value = event.target.files[0];
            model.value.file_name = file.value.name;
        };

        const openPDF = (item) => {
            const pdfUrl = `/storage/${item}`;
            window.open(pdfUrl, "_blank");
        };

        const add = (item) => {
            send.value = true;
            let data = { ...item };
            if (file.value != null && file.value.type !== "application/pdf") {
                toast.error("გთხოვთ ფაილი ატვირთეთ pdf ფორმატში", {
                    theme: "colored",
                    autoClose: 1000,
                });
                send.value = false;
                return;
            }
            if (
                m.value.length > 0 &&
                _.find(m.value, { number: data.number })
            ) {
                toast.error("ამ ნომრით უკვე გავთ რეკომენდატორი", {
                    theme: "colored",
                    autoClose: 1000,
                });
                send.value = false;
                return;
            }
            if (data.has_recommendation.id == 1) {
                data[`name_${getLang.value}`] = data.name;
                data[`position_${getLang.value}`] = data.position;
            } else {
                data[`no_reason_info_${getLang}`] = data.no_reason_info;
            }

            const sendFormData = new FormData();
            sendFormData.append("data", JSON.stringify(data));
            if (file.value) {
                sendFormData.append("file", file.value);
            }

            v.value.$touch();
            if (!v.value.$invalid) {
                validateAndSubmit(sendFormData);
            } else {
                toast.warning("აუცილებელია სავალდებულო ველები იყოს შევსებული", {
                    theme: "colored",
                    autoClose: 2000,
                });
                send.value = false;
            }
        };

        const clearModel = () => {
            model.value.name = "";
            model.value.position = "";
            model.value.number = "";
            model.value.recommendation_whom = "";
        };
        const validateAndSubmit = (formData) => {
            axios
                .post("/add_candidate_recommendation", formData)
                .then(function (response) {
                    if (response.data.status == 200) {
                        m.value.push(response.data.data.data);
                        send.value = false;
                        clearModel();
                        toast.success("ინფორმაცია წარმატებით შეინახა", {
                            theme: "colored",
                            autoClose: 1000,
                        });
                    }
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
        };
        const validateAndEmit = () => {
            const isFormValid = m.value.length > 0 ? true : false;
            emit("validateAndEmit", isFormValid);
        };

        const remove = (index, id) => {
            Swal.fire({
                title: "ნამდვილად გსურთ წაშლა?",
                //   showDenyButton: true,
                cancelButtonText: "არა",
                confirmButtonText: "კი",
                showCancelButton: true,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    const removed = m.value.splice(index, 1);
                    axios
                        .post("/delete_candidate_recommendation", {
                            data: id,
                        })
                        .then(function (response) {
                            if (response.status == 200) {
                                toast.success("წარმატებით წაიშალა", {
                                    theme: "colored",
                                    autoClose: 1000,
                                });
                            }
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        });
                    // this.hide()
                } else if (result.isDenied) {
                    return;
                }
            });
        };

        const handleNumberCodeSearch = (value) => {
            cla.value.numberCode = value;
        };

        return {
            m,
            model,
            cla,
            v,
            validateAndSubmit,
            add,
            getLang,
            validateAndEmit,
            chooseNumberCode,
            handleFileChange,
            showNoRecommendation,
            openPDF,
            send,
            remove,
            handleNumberCodeSearch,
        };
    },
    methods: {},
};
</script>
<style lang=""></style>
