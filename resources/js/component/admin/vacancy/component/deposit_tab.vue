<template lang="">
    <div>
        <div v-if="enrollment" class="alert alert-info alert-dismissible">
            <h5><i class="icon fas fa-info"></i> შეტყობინება!</h5>
            ამ ვაკანსიაზე თქვენ ელოდებით თანხის
            <u>{{ enrollment.type == 0 ? "არასრული" : "სრული" }}</u> ჩარიცხვის
            დადასტურებას.
            <ul>
                <li>დასადასტურებელი თანხა: {{ enrollment.money }} ლარი</li>
            </ul>
        </div>
        <div
            v-if="item.cancel_reason_id"
            class="alert alert-dismissible alert-danger"
        >
            <h5><i class="icon fas fa-info"></i> შეტყობინება!</h5>
            <span
                >ჩარიცხვა გაუქმებულია. მიზეზი:
                <strong>{{ item.cancel_reason }}</strong>
                </span
            >
        </div>
        <div class="row py-3 border border-success">
            <!-- <div class="row"></div> -->

            <div class="row col-md-12" v-if="m.must_be_enrolled != 0">
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label
                            >{{ title }}
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
                        <label>{{ title }} უნდა ჩაირიცხოს თარიღი</label>
                        <div class="ls-inputicon-box">
                            <input
                                class="form-control"
                                v-model="m.must_be_enrolled_date"
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
                                v-model="m.must_be_enrolled"
                                type="number"
                                placeholder="0"
                                disabled
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
                    <div class="d-flex justify-content-between">
                        <button
                            v-if="
                                item.cancel_reason_id === null &&
                                auth.role_id == 1
                            "
                            type="button"
                            class="btn btn-danger"
                            @click.prevent="cancel(m)"
                        >
                            <i class=""></i>გაუქმება
                        </button>
                        <div>
                            <button
                                v-if="hasDeposit && item.cancel_reason_id === null"
                                type="button"
                                class="btn btn-success float-right"
                                @click.prevent="emitSave"
                            >
                                <i class=""></i>შენახვა
                            </button>
                            <button
                                v-if="!hasDeposit && item.cancel_reason_id === null"
                                type="button"
                                class="btn btn-success float-right"
                                @click.prevent="emitRedacted"
                                :disabled="enrollment"
                            >
                                <i class=""></i>რედაქტირება
                            </button>
                        </div>
                    </div>
                </div>
                <div
                    class="row col-md-12"
                    v-if="status == 3 && m.must_be_enrolled != null"
                >
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
                                    v-model="model.money"
                                    type="number"
                                    placeholder="0"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>გადამხდელი </label>
                            <div class="ls-inputicon-box">
                                <input
                                    class="form-control"
                                    v-model="model.name"
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
                        <div class="d-flex justify-content-between">
                            <button
                                v-if="
                                    !enrollment ||
                                    item.cancel_reason_id !== null
                                "
                                type="button"
                                class="btn btn-primary"
                                @click.prevent="counting(model)"
                            >
                                <i class=""></i>ჩარიცხვა
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else class="col-md-12">
                <div class="form-group">
                    <label>{{ title }} სულ ჩაირიცხა</label>
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
        </div>
        <CancelDeposit
            :visible="showDepositCancelModal"
            :item="cancelDeposit"
            :cancelDepositClassificatory="reasonsCl"
            :type="type"
        />
    </div>
</template>
<script>
import { ref, computed, watch } from "vue";
import Swal from "sweetalert2";
import CancelDeposit from "../modal/CancelDeposit.vue";
export default {
    components: {
        CancelDeposit,
    },
    props: {
        item: Object,
        author: String,
        enrollment: Object,
        status: Number,
        type: String,
        adminViewAndPermission: Object,
        auth: Object,
        cancelDepositClassificatory: Array,
    },
    setup(props, { emit }) {
        console.log('props.item',props.item);

        const m = ref({ ...props.item });
        const file = ref(null);
        const hasDeposit = ref(!m.value.must_be_enrolled ? true : false);
        const model = ref({
            money: m.value.must_be_enrolled,
            name: props.author,
            file_name: null,
        });

        const reasonsCl = computed(() => props.cancelDepositClassificatory);
        console.log("reasonsCl", reasonsCl.value);

        const title = ref(
            props.type == "candidate" ? "კანდიდატისგან" : "დამსაქმებლისგან"
        );

        const showDepositCancelModal = ref(false);
        const cancelDeposit = ref(null);

        const fullPermission = computed(() => {
            return props.adminViewAndPermission
                ? props.adminViewAndPermission.permission == "full"
                : null;
        });

        const watchMoney = () => model.value.money;
        watch(watchMoney, (newVal) => {
            if (newVal > m.value.must_be_enrolled) {
                toast.error(
                    "თქვენ მიერ ჩაწერილი თანხა აღემატება ჩასარიცხ თანხას",
                    {
                        theme: "colored",
                        autoClose: 1000,
                    }
                );
                model.value.money = m.value.must_be_enrolled;
                // return
            }
        });

        const emitRedacted = () => {
            if (m.value.initial_amount && m.value.must_be_enrolled_date) {
                emit("redacted", m.value, props.type); // Pass the updated model as the event payload
            } else {
                toast.error("აუცილებელია ყველა პარამეტრის შევსება", {
                    theme: "colored",
                    autoClose: 1000,
                });
            }
        };

        const emitSave = () => {
            if (m.value.initial_amount && m.value.must_be_enrolled_date) {
                emit("save", m.value, props.type); // Pass the updated model as the event payload
            } else {
                toast.error("აუცილებელია ყველა პარამეტრის შევსება", {
                    theme: "colored",
                    autoClose: 1000,
                    enrollment,
                });
            }
        };

        const handleFileChange = (event) => {
            file.value = event.target.files[0];
            model.value.file_name = file.value.name;
        };

        const counting = (item) => {
            let data = { ...item };
            let enrollmentType = data.money == m.value.must_be_enrolled ? 1 : 0;
            let model = {
                id: m.value.id,
                vacancy_id: m.value.vacancy_id,
                who_is_counting: props.type == "candidate" ? 1 : 2,
                type: enrollmentType,
                name: data.name,
                money: data.money,
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
                    // input: 'date',
                    showCancelButton: true,
                    cancelButtonText: "გაუქმება",
                    confirmButtonText: "შენახვა",
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        const date =
                            document.getElementById("swal-input").value;
                        if (!date) {
                            Swal.showValidationMessage("Please enter a date."); // Display error message if date is empty
                            return false; // Prevent the form from being submitted
                        }
                        return axios
                            .post("/deposit_date_update", {
                                id: model.id,
                                type: props.type === "candidate" ? 1 : 2,
                                date: date,
                            })
                            .then((response) => {
                                return response.data;
                            })
                            .catch((error) => {
                                Swal.fire.showValidationMessage(
                                    `Request failed: ${error}`
                                );
                            });
                    },
                    allowOutsideClick: () => !Swal.fire.isLoading(),
                }).then((result) => {
                    if (result.isConfirmed) {
                        emitSend(formData);
                    }
                });
            } else {
                Swal.fire({
                    title: "ნამდვილად გსურთ თანხის სრულად ჩარიცხვა?",
                    //   showDenyButton: true,
                    cancelButtonText: "არა",
                    confirmButtonText: "კი",
                    showCancelButton: true,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        emitSend(formData);
                    } else if (result.isDenied) {
                        return;
                    }
                });
            }
        };

        const cancel = (item) => {
            console.log("item", item);

            showDepositCancelModal.value = true;
            cancelDeposit.value = item;
        };
        const emitSend = (model) => {
            emit("send", model);
        };

        return {
            m,
            file,
            model,
            hasDeposit,
            title,
            emitRedacted,
            emitSave,
            handleFileChange,
            counting,
            emitSend,
            fullPermission,
            showDepositCancelModal,
            cancel,
            cancelDeposit,
            reasonsCl,
        };
    },
};
</script>
<style lang=""></style>
