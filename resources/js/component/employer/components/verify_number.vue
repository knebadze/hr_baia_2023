<template lang="">
    <div class="container-fluid">
        <loading
            :active="loadingActive"
            :can-cancel="true"
            loader="dots"
            color="#01ecd5"
            :is-full-page="true"
        />
        <div class="main">
            <div class="row parent">
                <div class="col-md-12 text-center">
                    <h3 class="pb-2 pt-2">ვაკანსიის დამატება</h3>
                    <h5>ნომრის ვერიფიკაცია</h5>
                </div>
                <div class="col-xl-6 col-lg-8 col-md-12">
                    <div class="form-group mobile-form-group">
                        <label
                            ><span class="text-danger">* </span
                            >{{ "ტელეფონის ნომერი" }}</label
                        >
                        <div class="input-group mb-0 mb-md-3">
                            <button
                                style="border-style: none"
                                class="btn btn-outline-secondary dropdown-toggle input-d drop-btn"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                <span
                                    :class="`fi fi-${m.number_code.iso.toLowerCase()}`"
                                ></span
                                ><span class="drop-span"
                                    >+{{ m.number_code.phonecode }}</span
                                >
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
                                    :classificatory="cla"
                                    @search="handleNumberCodeSearch"
                                />
                                <li
                                    v-for="item in phoneCodeCla"
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
                                class="form-control input-d"
                                :class="m.number == null ? 'is-invalid' : ''"
                                v-model="m.number"
                                placeholder="555666777"
                                onkeypress="return /[0-9]/i.test(event.key)"
                                @keyup.enter="send"
                                :maxlength="
                                    m.number_code.phonecode == 995 ? 9 : 15
                                "
                            />
                        </div>
                        <span
                            v-if="showError && !v.number.required.$response"
                            style="color: red"
                            >{{ errorMessage("required") }}</span
                        >
                        <span
                            v-if="showError && !v.number.numeric.$response"
                            style="color: red"
                            >{{ errorMessage("numeric") }}</span
                        >
                    </div>
                </div>

                <div class="col-xl-6 col-lg-4 col-md-12 button-div">
                    <div class="form-group mobile-form-group">
                        <label for="" class="button-label"></label>
                        <div class="input-group mb-0 mb-md-3">
                            <button
                                class="site-button"
                                @click="send"
                                :disabled="sendButtonDisabled"
                            >
                                გაგზავნა
                                <span v-if="sendButtonDisabled">{{
                                    countdown
                                }}</span>
                            </button>
                        </div>
                    </div>
                </div>
                <verify_code_div
                    :visible="showVerifyCodeInput"
                    :item="checkData"
                    @sendParentAction="handlerAction"
                    :key="repeatKey"
                />
                <!-- <div class="col-xl-12 col-lg-12 col-md-12 " v-if="showVerifyCodeInput">
                <hr>
                <div class="text-center">
                    <p>შეიყვანეთ ვერიფიკაციის კოდი</p>
                </div>
                <div class="form-group">
                    <div class="input-group mt-3">
                        <CodeInput
                            :fields="5"
                            :fieldWidth="32"
                            :fieldHeight="32"
                            :required="true"
                            @change="onChange"
                            @complete="onComplete"
                        />
                        <p class="mr-2 countDownSeconds" style="">
                            {{ countdown }}
                        </p>
                    </div>
                    <p class="text-danger" v-if="showError">კოდი არასწორია!</p>
                </div>
            </div> -->
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, defineComponent, computed, watch } from "vue";
// import CodeInput from "./CodeInput.vue";
import Swal from "sweetalert2";
import verify_code_div from "./verify_code_div.vue";
import Loading from "vue3-loading-overlay";
import { I18n } from "laravel-vue-i18n";
import { useLoadingStore } from "../../../store/loaderStore";
import { storeToRefs } from "pinia";
import { useVuelidate } from "@vuelidate/core";
import { required, numeric } from "@vuelidate/validators";
import { errorMessage } from "../../../plugins/vuelidate/validationMessages";
import NumberCodeSearchInput from "../../input/NumberCodeSearchInput.vue";
const props = defineProps({
    cla: Object,
});
const emit = defineEmits(["verifyEmit"]);
const m = ref({
    number: null,
    number_code: null,
});
const phoneCodeCla = ref(props.cla);
const showVerifyCodeInput = ref(false);
const verifyNumber = ref(null);
const checkNumberData = ref(null);
const showError = ref(false);
const checkData = ref(null);
m.value.number_code = props.cla.find((item) => item.id == 79);
let repeatKey = ref(0);
let activeVacancyIds = ref([]);
const loadingStore = useLoadingStore();
const { loadingActive } = storeToRefs(loadingStore);
const sendButtonDisabled = ref(false);
const chooseNumberCode = (item) => {
    m.value.number_code = item;
};
const search_number_code = ref(null);
const getLang = computed(() => {
    return I18n.getSharedInstance().options.lang;
});
const rules = {
    number: { required, numeric },
};
const countdown = ref(60);
const v = useVuelidate(rules, m.value);
const send = () => {
    console.log("countdown.value", countdown.value);
    if (countdown.value != 0 && countdown.value != 60) {
        return;
    }
    showError.value = true;
    v.value.$touch();
    if (v.value.$invalid) {
        return;
    }
    loadingActive.value = true;
    showVerifyCodeInput.value = false;
    countdown.value = 60;
    sendButtonDisabled.value = true;
    repeatKey.value++;
    checkData.value = {
        type: "employer",
        number: m.value.number,
    };
    axios({
        method: "post",
        url: "/send_add_vacancy_validate_sms",
        data: { model: m.value },
    })
        .then(function (response) {
            if (response.status == 200) {
                showError.value = false;
                toast.success("ნომერზე გაიგზავნა ვერიფიკაციის კოდი", {
                    theme: "colored",
                    autoClose: 2000,
                });

                setInterval(() => {
                    if (countdown.value > 0) {
                        countdown.value--;
                    }
                    if (countdown.value == 0) {
                        sendButtonDisabled.value = false;
                    }
                }, 1000);
                // verifyNumber.value = response.data.randomNumber
                checkNumberData.value = response.data.data;
                // if (!response.data.has_sms) {
                //     getSwal()

                // }
                showVerifyCodeInput.value = !showVerifyCodeInput.value;
                loadingActive.value = false;
            }
        })
        .catch(function (error) {
            // handle error
            showError.value = false;
            loadingActive.value = false;
            console.log(error);
        });
};

const sendSms = async (item, type = "main") => {
    try {
        const response = await axios({
            method: "post",
            url: "/send_sms_add_vacancy",
            data: { model: item },
        });

        if (response.status == 200) {
            // handle success
            if (type === "want_call") {
                let url = new URL(location.href);
                window.location.replace(
                    `${url.origin}/${getLang.value}/candidate_search/[${activeVacancyIds.value}]`
                );
            }
            // return response;
        }
        // return response;
    } catch (error) {
        // handle error
        console.log(error);
        throw error;
    }
};
// const verifyFull = ref(false)

const getSwal = () => {
    let postVacancyData = {
        active: true,
        employer: m.value,
        used_category: null,
    };

    if (checkNumberData.value.length > 0) {
        let activeVacancy = checkNumberData.value.filter(
            (x) => x.status_id == 1 || x.status_id == 2 || x.status_id == 3
        );
        let closeVacancy = checkNumberData.value.some((x) => x.status_id > 3);
        let hr = checkNumberData.value[0].hr;
        let employer = checkNumberData.value[0].employer;
        postVacancyData.employer = employer;
        if (activeVacancy.length > 0) {
            // let filter = checkNumberData.value.filter((x) => x.status_id == 1 || x.status_id == 2 || x.status_id == 3 );
            activeVacancyIds.value = activeVacancy.map((i) => i.category_id);
            postVacancyData.used_category = activeVacancyIds.value;
            let html = `თქვენ უკვე გემსახურებათ HR: ${hr.name_ka}.
                        თუ ნამდვილად გსურთ ახალი ვაკანსიის დამატებას დააწექით ღილაკს "დამატება",
                        თუ მიმდინარე ვაკანსიაზე გსურთ ინფორმაცია დააწექით ღილაკს "შეხსენება"`;
            Swal.fire({
                title: "<p>თქვენი გაქვთ აქტიური ვაკანსია</p>",
                // icon: 'info',
                html: html,
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: "დამატება",
                denyButtonText: '<i class="fa fa-bell"></i> შეხსენება',
                // icon: 'success',
                customClass: {
                    confirmButton: "btn-success",
                    denyButton: "btn-primary",
                },
                // width: '60%'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    emit("verifyEmit", postVacancyData);
                    return;
                } else if (result.isDenied) {
                    sendSms(
                        {
                            data: {
                                to: hr.number,
                                number: employer.number,
                                name: employer.name_ka,
                            },
                            type: "employer_want_call_you_hr",
                        },
                        "want_call"
                    );

                    return;
                }
            });
        } else if (closeVacancy) {
            let html = `
                        <div>
                            <h3>თქვენ უკვე გქონდათ ჩვენთან განთავსებული ვაკანსია,</h3>
                            <small>თუ ნამდვილად გსურთ ახალი ვაკანსიის დამატება, დააწექით ღილაკს "დამატება"</small>
                            <small>თუ გსურთ დაგიკავშირდეთ HR, დააწექით ღილაკს "გადმორეკვა"</small>
                            <small>თუ გსურთ ძველი ვაკანსიის გამეორება, დააწექით ღილაკს "გამეორება"</small>
                        </div>
                        <hr/>
                        <div class="swal-buttons">
                            <button class="btn btn-success" id="confirmBtn">დამატება</button>
                            <button class="btn btn-primary" id="denyBtn"><i class="fa fa-bell"></i> გადმორეკვა</button>
                            <button class="btn btn-info" id="redoBtn">გამეორება</button>
                        </div>
                    `;

            Swal.fire({
                title: "",
                html: html,
                showConfirmButton: false,
                showDenyButton: false,
                showCancelButton: false,
                customClass: {
                    container: "custom-swal-container",
                },
                didOpen: () => {
                    const confirmBtn =
                        Swal.getPopup().querySelector("#confirmBtn");
                    const denyBtn = Swal.getPopup().querySelector("#denyBtn");
                    const redoBtn = Swal.getPopup().querySelector("#redoBtn");

                    confirmBtn.addEventListener("click", () => {
                        emit("verifyEmit", postVacancyData);
                        Swal.close();
                    });

                    denyBtn.addEventListener("click", () => {
                        sendSms({
                            data: {
                                hr_number: hr.number,
                                hr_name: hr.name_ka,
                                employer_number: employer.number,
                                employer_name: employer.name_ka,
                            },
                            type: [
                                "try_add_vacancy_again_send_employer",
                                "try_add_vacancy_again_send_hr",
                            ],
                        });
                        Swal.close();
                        let url = new URL(location.href);
                        window.location.replace(
                            `${url.origin}/${getLang.value}/candidate`
                        );
                    });

                    redoBtn.addEventListener("click", () => {
                        // Call your redo function here
                        // Example: redoFunction();
                        alert();
                        Swal.close();
                    });
                },
            });
        }
    } else {
        emit("verifyEmit", postVacancyData);
    }
};
const handleNumberCodeSearch = (value) => {
    phoneCodeCla.value = value;
};

const handlerAction = () => {
    getSwal();
};

//         return {
//             m,
//             chooseNumberCode,
//             send,
//             showVerifyCodeInput,
//             handlerAction,
//             checkData,
//             repeatKey,
//         };
//     },
// });
</script>
<style scoped>
.main {
    background-image: url("/public/images/candidates/candidate-bg2.jpg");
    background-position: center;
    background-repeat: no-repeat;
    width: 100%;
    height: 70vh;
    border-radius: 5px;
    position: relative;
}

.parent {
    background-color: rgb(255, 255, 255);
    position: absolute;
    /* padding: 60px 0; */
    left: 10%;
    top: 30%;
    width: 80%;
}
.btn:hover {
    color: inherit;
    background-color: inherit;
    border-color: inherit;
    border: none !important;
    outline: none !important;
}

@media (max-width: 575.98px) {
    h2 {
        font-size: 16px;
        font-weight: 600;
    }
    h5 {
        font-size: 13px;
        font-weight: 500;
    }
    label {
        font-size: 12px;
        font-weight: 500;
    }
    .input-d {
        height: 10px;
    }
    .drop-btn {
        width: 30%;
    }
    .drop-span {
        display: none;
    }
}

@media (max-width: 768px) {
    .mobile-form-group {
        margin: 10px;
    }
    .button-div{
        padding: 0px;
    }
    .button-label{
        display: none;
    }
    .main {
        height: 100vh;
    }
}

@media (max-width: 991.98px) {
    .site-button {
        width: 100%;
    }
}

@media (max-width: 1199.98px) {
}
@media (max-width: 1399.98px) {
}
</style>
