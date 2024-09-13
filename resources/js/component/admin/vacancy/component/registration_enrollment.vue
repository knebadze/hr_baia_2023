<template lang="">
    <div class="tab-pane" id="tab_3">
        <div v-if="registerInfo" class="alert alert-info alert-dismissible">
            <h5><i class="icon fas fa-info"></i> შეტყობინება!</h5>
            ამ კანდიდატზე თქვენ ელოდებით თანხის
            <u>{{ registerInfo.type == 0 ? "არასრული" : "სრული" }}</u> ჩარიცხვის
            დადასტურებას.
            <ul>
                <li>დასადასტურებელი თანხა: {{ registerInfo.money }} ლარი</li>
            </ul>
        </div>
        <div class="row py-3 border border-success">
            <!-- <div class="row"></div> -->

            <div class="row col-md-12" v-if="m.enroll_date">
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label
                            >რეგისტრაციის
                            <span class="text-danger">სულ </span>უნდა
                            ჩაირიცხოს</label
                        >
                        <div class="ls-inputicon-box">
                            <input
                                class="form-control"
                                v-model="m.initial_amount"
                                type="number"
                                placeholder="0"
                            />
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>უნდა ჩაირიცხოს თარიღი</label>
                        <div class="ls-inputicon-box">
                            <input
                                class="form-control"
                                v-model="m.enroll_date"
                                type="date"
                            />
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>ჩასარიცხი დარჩა</label>
                        <div class="ls-inputicon-box">
                            <input
                                class="form-control"
                                v-model="m.initial_amount"
                                type="number"
                                placeholder="0"
                                disabled
                            />
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <button
                        v-if="m.cancel_reason_id === null && auth.role_id == 1"
                        type="button"
                        class="btn btn-danger mb-1"
                        @click.prevent="cancel(m)"
                    >
                        <i class=""></i>გაუქმება
                    </button>
                    <!-- <button v-if="!registerInfo" type="button" class="btn btn-success float-right" @click.prevent="redacted()" ><i class=""></i>რედაქტირების შენახვა</button> -->
                </div>
                <div class="col-md-12 border-top border-bottom">
                    <h5 class="mt-2 text-danger text-center">
                        მიმდინარე ჩარიცხვა
                    </h5>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>ამჟამინდელი ჩარიცხვის თანხა </label>
                        <div class="ls-inputicon-box">
                            <input
                                class="form-control"
                                v-model="m.money"
                                type="number"
                                placeholder="0"
                            />
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>თანხა ჩარიცხა </label>
                        <div class="ls-inputicon-box">
                            <input
                                class="form-control"
                                v-model="m.name"
                                type="text"
                                placeholder="0"
                            />
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>ქვითარი </label>
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
                <div
                    class="col-md-12"
                    v-if="
                        auth.role_id == 2 ||
                        fullPermission ||
                        item.hr_parent_id == auth.id
                    "
                >
                    <button
                        v-if="!registerInfo"
                        type="button"
                        class="btn btn-primary float-right"
                        @click.prevent="counting(m)"
                    >
                        <i class=""></i>ჩარიცხვა
                    </button>
                </div>
            </div>
            <div v-else class="col-md-12">
                <div class="form-group">
                    <label>კანდიდატისგან სულ ჩაირიცახ</label>
                    <div class="ls-inputicon-box">
                        <input
                            class="form-control"
                            v-model="m.candidate_initial_amount"
                            type="number"
                            placeholder="0"
                            disabled
                        />
                    </div>
                </div>
            </div>
        </div>
        <CancelDeposit
            :visible="showDepositCancelModal"
            :item="cancelDeposit"
            :cancelDepositClassificatory="reasonsCl"
            type="registration"
        />
    </div>
</template>
<script setup>
import { ref, computed, onMounted } from "vue";
import CancelDeposit from "../modal/CancelDeposit.vue";

const props = defineProps({
    item: Object,
    adminViewAndPermission: Object,
    auth: Object,
    cancelDepositClassificatory: Array,
});

const showConfirm = ref(false);
const m = ref({});
const cla = ref(null);
const file = ref(null);
const registerInfo = ref(null);
const showDepositCancelModal = ref(false);
const cancelDeposit = ref(null);
const reasonsCl = computed(() => props.cancelDepositClassificatory);
const fullPermission = computed(() => {
    return props.adminViewAndPermission
        ? props.adminViewAndPermission.permission == "full"
        : null;
});

const show = async () => {
    let result = await getInfo();
    registerInfo.value =
        result.data == "" ? null : result.data ? result.data : null;
    showConfirm.value = true;
    m.value = { ...props.item };
    console.log("m.value", m.value);
};

const hide = () => {
    showConfirm.value = false;
};

const getInfo = () => {
    if (props.item.hasOwnProperty("log")) {
        return { data: null };
    }
    return axios.post("/get_register_enrollment_info", {
        data: props.item.user_id,
    });
};

const handleFileChange = (event) => {
    file.value = event.target.files[0];
};

const counting = (item) => {
    let enrollmentType = item.money == props.item.initial_amount ? 1 : 0;

    let model = {
        id: item.id,
        user_id: item.user_id,
        type: enrollmentType,
        name: item.name,
        money: item.money,
        vacancy_id: item.vacancy_id,
    };
    const formData = new FormData();
    formData.append("data", JSON.stringify(model));
    if (file.value) {
        formData.append("file", file.value);
    }
    if (enrollmentType == 0) {
        Swal.fire({
            title: "ნამდვილად გსურთ თანხის არასრული ჩარიცხვა? შეიყვანე შემდეგი გადახდის თარიღი",
            html: '<input id="swal-input" type="date" required>',
            showCancelButton: true,
            cancelButtonText: "გაუქმება",
            confirmButtonText: "შენახვა",
            showLoaderOnConfirm: true,
            preConfirm: () => {
                const date = document.getElementById("swal-input").value;
                if (!date) {
                    Swal.showValidationMessage("Please enter a date.");
                    return false;
                }
                return axios
                    .post("/register_update?id=" + model.id + "&date=" + date)
                    .then((response) => {
                        return response.data;
                    })
                    .catch((error) => {
                        Swal.showValidationMessage(`Request failed: ${error}`);
                    });
            },
            allowOutsideClick: () => !Swal.isLoading(),
        }).then((result) => {
            if (result.isConfirmed) {
                sendAxios(formData);
            }
        });
    } else {
        Swal.fire({
            title: "ნამდვილად გსურთ თანხის სრულად ჩარიცხვა?",
            cancelButtonText: "არა",
            confirmButtonText: "კი",
            showCancelButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                sendAxios(formData);
            }
        });
    }
};

const sendAxios = (formData) => {
    axios
        .post("/register_enrollment", formData)
        .then((response) => {
            if (response.status == 200) {
                toast.success("წარმატებით ჩაირიცხა", {
                    theme: "colored",
                    autoClose: 1000,
                });
                setTimeout(() => {
                    document.location.reload();
                }, 2000);
            }
        })
        .catch((error) => {
            console.log(error);
        });
};

const cancel = (item) => {
    console.log("item", item);

    showDepositCancelModal.value = true;
    cancelDeposit.value = item;
};

onMounted(() => {
    show();
});
</script>
<style lang=""></style>
