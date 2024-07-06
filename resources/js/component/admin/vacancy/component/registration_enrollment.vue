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
    </div>
</template>
<script>
export default {
    props: {
        item: Object,
        adminViewAndPermission: Object,
        auth: Object,
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
        this.show();
    },
    computed: {
        fullPermission() {
            return this.adminViewAndPermission
                ? this.adminViewAndPermission.permission == "full"
                : null;
        },
    },
    methods: {
        async show() {
            let result = await this.getInfo();
            this.registerInfo =
                result.data == "" ? null : result.data ? result.data : null;
            this.showConfirm = true;
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
            enrollmentType = item.money == this.item.initial_amount ? 1 : 0;
            // enrolled = this.item.money - item.money

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
};
</script>
<style lang=""></style>
