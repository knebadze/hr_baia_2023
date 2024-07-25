<template lang="">
    <div class="panel panel-default">
        <div class="panel-heading wt-panel-heading p-a20">
            <h4 class="panel-tittle m-a0">
                {{ $t("lang.user_profile_page_title") }}
            </h4>
        </div>
        <div class="panel-body wt-panel-body p-a20 m-b30">
            <div
                class="d-flex justify-content-between border border-info p-2 mb-2"
            >
                <span>შეგიძლიათ დაამატოთ {{ limit }} ნომერი</span>
                <span>{{ m.length }} / {{ limit }}</span>
            </div>

            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ $t("lang.user_profile_page_number") }}</label>
                        <div class="input-group mb-3 dropdown" ref="myDiv">
                            <button
                                style="border-style: none"
                                class="btn btn-outline-secondary dropdown-toggle"
                                type="button"
                                @click="toggleDropdown"
                            >
                                <span
                                    :class="`fi fi-${selectedOption.iso.toLowerCase()}`"
                                ></span>
                                +{{ selectedOption.phonecode }}
                            </button>
                            <ul
                                class="dropdown-menu"
                                :class="{ show: isDropdownOpen }"
                                style="position: absolute"
                            >
                                <NumberCodeSearchInput
                                    :classificatory="data.cla.numberCode"
                                    @search="handleNumberCodeSearch"
                                />
                                <li
                                    v-for="(option, index) in cla.numberCode"
                                    :key="index"
                                >
                                    <a
                                        class="dropdown-item"
                                        @click="selectOption(option)"
                                    >
                                        <span
                                            :class="`fi fi-${option.iso.toLowerCase()}`"
                                        ></span
                                        >+{{ option.phonecode }}
                                    </a>
                                </li>
                            </ul>
                            <input
                                type="text"
                                class="form-control"
                                aria-label="Text input with dropdown button"
                                v-model="model.number"
                                placeholder="555666777"
                                onkeypress="return /[0-9]/i.test(event.key)"
                                :disabled="m.length == limit"
                            />
                        </div>
                        <!-- <div class="input-group mb-3">
                        <button style="border-style: none;" class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span :class="`fi fi-${numberCode.iso.toLowerCase()}`"></span>+{{ numberCode.phonecode }}</button>
                            <ul class="dropdown-menu" style=" overflow: hidden; overflow-y: auto; max-height: calc(100vh - 550px);">
                                <li v-for="item in cla.numberCode" @click="chooseNumberCode(item)"><a class="dropdown-item"><span :class="`fi fi-${item.iso.toLowerCase()}`"></span>+{{ item.phonecode }}</a></li>
                            </ul>
                            <input type="text" class="form-control" aria-label="Text input with dropdown button" v-model="model.number" placeholder="555666777" onkeypress="return /[0-9]/i.test(event.key)" >

                        </div> -->
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{
                            $t("lang.user_profile_page_number_owner")
                        }}</label>
                        <div class="ls-inputicon-box">
                            <multiselect
                                v-model="model.number_owner"
                                :options="cla.numberOwner"
                                deselect-label="Can't remove this value"
                                :track-by="`name_${getLang}`"
                                :label="`name_${getLang}`"
                                placeholder="Select one"
                                :searchable="true"
                                :allow-empty="false"
                                :disabled="m.length == limit"
                            >
                                <template
                                    slot="singleLabel"
                                    slot-scope="{ option }"
                                ></template>
                            </multiselect>
                            <!-- <span v-if="v$.candidateNumberModel.number_owner.required.$invalid && v$.candidateNumberModel.number_owner.$dirty" style='color:red'>* {{ v$.candidateNumberModel.number_owner.required.$message}}</span> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="text-right">
                        <button
                            class="btn btn-success"
                            @click.prevent="add(selectedOption, model)"
                            title="Add Number"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            :disabled="send || m.length == limit"
                        >
                            {{
                                $t(
                                    "lang.user_profile_page_foreign_lang_button_add_info"
                                )
                            }}
                            <span class="fa fa-plus"></span>
                        </button>
                    </div>
                </div>
                <div v-if="m.length != 0" class="col-lg-12 col-md-12">
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
                                                    "lang.user_profile_page_number"
                                                )
                                            }}
                                        </th>
                                        <th>
                                            {{
                                                $t(
                                                    "lang.user_profile_page_number_owner"
                                                )
                                            }}
                                        </th>
                                        <th>
                                            {{
                                                $t(
                                                    "lang.user_profile_page_work_number_actions"
                                                )
                                            }}
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(item, index) in m">
                                        <td>{{ index + 1 }}</td>
                                        <td>
                                            {{
                                                `+${item.number_code.phonecode} ${item.number}`
                                            }}
                                        </td>
                                        <td>
                                            {{
                                                item.number_owner[
                                                    `name_${getLang}`
                                                ]
                                            }}
                                        </td>
                                        <td>
                                            <button
                                                @click="remove(index, item.id)"
                                                title="delete"
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
import { ref, computed } from "vue";
import { I18n } from "laravel-vue-i18n";
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
        const limit = ref(3);
        const send = ref(false);
        const classificatory = props.data.cla;
        const sort = () => {
            classificatory.numberCode[0] = _.find(
                classificatory.numberCode,
                function (o) {
                    return o.phonecode == 995;
                }
            );
            const index = _.findIndex(props.data.cla.numberCode, function (o) {
                return o.phonecode == 995;
            });
            classificatory.numberCode[index] = props.data.cla.numberCode[0];
            return classificatory;
        };
        const cla = ref(sort());
        const formData = props.data.model.candidateNumber;
        const isDropdownOpen = ref(false);
        const selectedOption = ref(
            _.find(cla.value.numberCode, function (o) {
                return o.phonecode == 995;
            })
        );
        const myDiv = ref(null);

        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });

        formData.lang = getLang;

        let m = ref(formData);
        const model = ref({
            number: "",
            number_owner: "",
        });

        const add = (code, item) => {
            let data = { ...item };
            send.value = true;
            data["number_code"] = code;
            if (
                data.number == "" ||
                data.number_code == "" ||
                data.number_owner == ""
            ) {
                toast.error("აუცილებელია ყველა პარამეტრის შევსება", {
                    theme: "colored",
                    autoClose: 1000,
                });
                send.value = false;
                return;
            }
            if (m.value.length == 2) {
                toast.error("თქვენ უკვე დაამატეთ 2 ნომერი", {
                    theme: "colored",
                    autoClose: 1000,
                });
                send.value = false;
                return;
            }

            validateAndSubmit(data);
            model.value.number = "";
            model.value.number_owner = "";
        };

        const validateAndSubmit = (item) => {
            axios({
                method: "post",
                url: "/add_candidate",
                data: {
                    model: item,
                    type: "number",
                    user_id: props.data.model.user_id,
                },
            })
                .then(function (response) {
                    if (response.data.status == 200) {
                        m.value = response.data.data;
                        send.value = false;
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
            if (m.value.length == 0) {
                toast.error("აუცილებელია მინიმუმ ერთი ნომრის დამატება", {
                    theme: "colored",
                    autoClose: 2000,
                });
                return;
            }
            const isFormValid = m.value.length > 0 ? true : false;
            emit("validateAndEmit", isFormValid);
        };

        // drop down input const isDropdownOpen = ref(false);

        const toggleDropdown = () => {
            isDropdownOpen.value = !isDropdownOpen.value;
        };

        const selectOption = (option) => {
            selectedOption.value = option;
            isDropdownOpen.value = false;
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
                    axios({
                        method: "post",
                        url: "/delete_candidate_info",
                        data: { id: id, type: "number" },
                    })
                        .then(function (response) {
                            if (response.data.status == 200) {
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
            validateAndSubmit,
            add,
            getLang,
            validateAndEmit,

            isDropdownOpen,
            selectedOption,
            toggleDropdown,
            selectOption,
            myDiv,
            send,
            remove,
            limit,
            handleNumberCodeSearch,
        };
    },
};
</script>
<style>
.dropdown-menu {
    overflow: hidden;
    overflow-y: auto;
    max-height: calc(100vh - 600px);
}
</style>
