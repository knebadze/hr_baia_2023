<template lang="">
    <!-- Modal -->
    <div
        v-if="showConfirm"
        class="modal fade show"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalCenterTitle"
        id="modalMap"
        aria-hidden="true"
        style="display: block"
    >
        <div
            class="modal-dialog modal-dialog-centered modal-xl"
            role="document"
        >
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">
                        სარეგისტრაციოს ჩარიცხვა
                    </h6>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                        @click="hide()"
                    >
                        X
                    </button>
                </div>
                <div class="modal-body">
                    <div
                        v-if="registerInfo"
                        class="alert alert-info alert-dismissible"
                    >
                        <h5><i class="icon fas fa-info"></i> შეტყობინება!</h5>
                        ამ კანდიდატზე თქვენ ელოდებით თანხის
                        <u>{{
                            registerInfo.type == 0 ? "არასრული" : "სრული"
                        }}</u>
                        ჩარიცხვის დადასტურებას.
                        <ul>
                            <li>
                                დასადასტურებელი თანხა:
                                {{ registerInfo.money }} ლარი
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> ჩასარიცხი თანხა</label>
                                <input
                                    class="form-control"
                                    v-model="m.money"
                                    type="number"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> ჩარიცხვის თარიღი</label>
                                <input
                                    class="form-control"
                                    v-model="m.enroll_date"
                                    type="date"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> ვინ რიცხავს</label>
                                <input
                                    class="form-control"
                                    v-model="m.name"
                                    type="text"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> ქვითარი</label>
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
                <div class="modal-footer">
                    <button
                        v-if="!registerInfo"
                        type="button"
                        class="btn btn-success"
                        @click.prevent="counting(m)"
                    >
                        <i class=""></i>ჩარიცხვა
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import moment from "moment";
export default {
    props: {
        visible: Boolean,
        item: Object,
    },
    data() {
        return {
            showConfirm: false,
            m: {},
            cla: null,
            file: null,
            registerInfo: null,
        };
    },
    created() {
        // this.showConfirm = this.visible
    },
    computed: {
        getLang() {
            return I18n.getSharedInstance().options.lang;
        },
    },
    methods: {
        async show() {
            let result = await this.getInfo();
            this.registerInfo = result.data;
            this.showConfirm = true;
            console.log(this.item);
            this.m = { ...this.item };
            // this.min = this.item.end_date;
        },
        hide() {
            this.showConfirm = false;
        },
        getInfo() {
            if (this.item.hasOwnProperty("log")) {
                return { data: null };
            }
            return axios.post("/get_register_enrollment_info", {
                data: this.item.user_id,
            });
        },
        handleFileChange(event) {
            this.file = event.target.files[0];
            // this.enrollmentEmployer.file_name = this.file.name
        },
        counting(m) {
            let item = m;
            let enrollmentType;
            // let enrolled;
            enrollmentType =
                item.money == this.item.money || item.money == 30 ? 1 : 0;
            // enrolled = this.item.money - item.money

            let model = {
                id: item.id,
                user_id: item.user_id,
                type: enrollmentType,
                name: item.name,
                money: item.money,
            };
            const formData = new FormData();
            formData.append("data", JSON.stringify(model));
            if (this.file) {
                formData.append("file", this.file);
            }
            if (enrollmentType == 0) {
                this.$swal({
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
                            .post(
                                "/register_update?id=" +
                                    model.id +
                                    "&date=" +
                                    date
                            )
                            .then((response) => {
                                return response.data;
                            })
                            .catch((error) => {
                                this.$swal.showValidationMessage(
                                    `Request failed: ${error}`
                                );
                            });
                    },
                    allowOutsideClick: () => !this.$swal.isLoading(),
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.sendAxios(formData);
                    }
                });
            } else {
                this.$swal({
                    title: "ნამდვილად გსურთ თანხის სრულად ჩარიცხვა?",
                    //   showDenyButton: true,
                    cancelButtonText: "არა",
                    confirmButtonText: "კი",
                    showCancelButton: true,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        this.sendAxios(formData);
                    } else if (result.isDenied) {
                        return;
                    }
                });
            }
        },
        sendAxios(formData) {
            let currentObj = this;
            axios
                .post("/register_enrollment", formData)
                .then(function (response) {
                    console.log("response", response);
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
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
        },
    },
    watch: {
        visible: function () {
            this.show();
        },
    },
};
</script>
<style lang=""></style>
