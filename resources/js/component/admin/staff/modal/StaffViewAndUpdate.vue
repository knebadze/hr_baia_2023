<script setup>
import { ref, watch } from "vue";
import axios from "axios";

const props = defineProps({
    visible: Boolean,
    data: Object,
    cla: Object,
});

const showConfirm = ref(false);
const formModel = ref(null);
const avatar = ref(null);
const imgName = ref("");

const show = () => {
    let data = { ...props.data };
    formModel.value = { ...data };
    formModel.value['password'] = "";
    console.log(formModel.value, data);
    // for (let key in data) {
    //     formModel.value[key] = data[key];
    // }
    console.log(formModel.value);
    // formModel.value = {
    //     id: data.id,
    //     hr_id: data.hr.id,
    //     name: data.name_ka,
    //     email: data.email,
    //     mobile: data.hr.mobile,
    //     date_of_birth: data.date_of_birth,
    //     gender: data.gender_id,
    //     person_number: data.hr.person_number,
    //     k_mobile: data.number,
    //     inside_number: data.hr.inside_number,
    //     branch_id: data.hr.branch_id,
    //     internship: data.hr.internship,
    //     bonus_percent: data.hr.bonus_percent,
    //     fixed_salary: data.hr.fixed_salary,
    //     fb_link: data.hr.fb_link,
    //     password: "",
    // };
    imgName.value = data.avatar;
    showConfirm.value = true;
};

const hide = () => {
    showConfirm.value = false;
};

const generatePassword = () => {
    let result = "";
    let characters =
        "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%&*";
    let charactersLength = characters.length;
    for (let i = 0; i < 8; i++) {
        result += characters.charAt(
            Math.floor(Math.random() * charactersLength)
        );
    }
    formModel.value.password = result;
};

const avatarUpload = (event) => {
    avatar.value = event.target.files[0];
    imgName.value = event.target.files[0].name;
};

const updateHR = (data) => {
    const config = {
        headers: {
            "Content-Type": "multipart/form-data",
        },
    };
    let formData = new FormData();
    Object.keys(formModel.value).forEach((key) => {
        formData.append(key, formModel.value[key]);
    });
    // formData.append("id", props.data.id);
    // formData.append("hr_id", props.data.hr.id);
    // formData.append("name", data.name);
    // formData.append("email", data.email);
    // formData.append("mobile", data.mobile);
    // formData.append("date_of_birth", data.date_of_birth);
    // formData.append("gender", data.gender);
    // formData.append("person_number", data.person_number);
    // formData.append("k_mobile", data.k_mobile);
    // formData.append("inside_number", data.inside_number);
    // formData.append("branch_id", data.branch_id);
    // formData.append("bonus_percent", data.bonus_percent);
    // formData.append("internship", data.internship);
    // formData.append("fixed_salary", data.fixed_salary);
    // formData.append("fb_link", data.fb_link);
    // formData.append("password", data.password);
    if (avatar.value != null) {
        formData.append("avatar", avatar.value);
    } else {
        formData.append("avatar", "");
    }

    axios
        .post("/update_staff", formData, config)
        .then(function (response) {
            // handle success
            console.log(response);
            if (response.status == 200) {
                hide();
                toast.success("ინფორმაცია წარმატებით განახლდა", {
                    theme: "colored",
                    autoClose: 1000,
                });
                setTimeout(() => {
                    document.location.reload();
                }, 1500);
            }
        })
        .catch(function (error) {
            console.log(error);
        });
};

watch(
    () => props.visible,
    (newVal) => {
         show();
    }
);
</script>
<template>
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
            class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable"
            role="document"
        >
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">
                        სრულად ნახვა და რედაქტირება
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"
                                    >სახელი გვარი</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="exampleInputEmail1"
                                    v-model="formModel.name"
                                    placeholder="სახელი გვარი"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="exampleInputEmail2"
                                    v-model="formModel.email"
                                    placeholder="ემაილი"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"
                                    >საკუთარი ტელეფონის ნომერი</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="exampleInputEmail3"
                                    v-model="formModel.mobile"
                                    placeholder="საკუთარი ტელეფონის ნომერი"
                                    minlength="9"
                                />
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"
                                    >დაბადების თარიღი</label
                                >
                                <input
                                    type="date"
                                    class="form-control"
                                    v-model="formModel.date_of_birth"
                                    id="exampleInputEmail4"
                                />
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <label for="">სქესი</label>
                            <div class="form-group d-flex border rounded p-2">
                                <div class="form-check mr-2">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        value="1"
                                        v-model="formModel.gender_id"
                                    />
                                    <label class="form-check-label">კაცი</label>
                                </div>
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        value="2"
                                        v-model="formModel.gender_id"
                                    />
                                    <label class="form-check-label">ქალი</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"
                                    >პირადი ნომერი</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="exampleInputEmail7"
                                    v-model="formModel.person_number"
                                    placeholder="პირადი ნომერი"
                                    minlength="11"
                                />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputFile">პაროლი</label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="exampleInputPassword1"
                                        v-model="formModel.password"
                                        placeholder="Password"
                                    />
                                    <div class="input-group-append">
                                        <button
                                            class="btn btn-info"
                                            @click="generatePassword"
                                        >
                                            პაროლის გენერირება
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"
                                    >კორპორატიული ნომერი</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="exampleInputEmail5"
                                    v-model="formModel.k_mobile"
                                    placeholder="კორპორატიული ნომერი"
                                    minlength="9"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"
                                    >შიდა ნომერი</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="exampleInputEmail6"
                                    v-model="formModel.inside_number"
                                    placeholder="შიდა ნომერი"
                                />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1"
                                    >ფილიალი
                                </label>
                                <select
                                    class="form-control"
                                    id="exampleFormControlSelect1"
                                    v-model="formModel.branch_id"
                                >
                                    <option value="" disabled selected>
                                        აირჩიე ფილიალი
                                    </option>
                                    <option
                                        v-for="(item, index) in cla"
                                        :key="index"
                                        :value="item.id"
                                    >
                                        {{ item.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"
                                    >ბონუსის პროცენტი</label
                                >
                                <input
                                    type="number"
                                    class="form-control"
                                    id="exampleInputEmail6"
                                    v-model="formModel.bonus_percent"
                                    placeholder="ვაკანსისი ბონუსის პროცენტი"
                                    step="0.5"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"
                                    >ფიქსირებული ხელფასი</label
                                >
                                <input
                                    type="number"
                                    class="form-control"
                                    id="exampleInputEmail6"
                                    v-model="formModel.fixed_salary"
                                    placeholder="ფიქსირებული ხელფასი"
                                />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            id="exampleCheck1"
                                            v-model="formModel.internship"
                                        />
                                        <label
                                            class="form-check-label"
                                            for="exampleCheck1"
                                            >სტაჟიორი</label
                                        >
                                    </div>
                                </div>
                            </div>

                            <hr>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1"
                                    >Facebook ლინკი</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="exampleInputEmail8"
                                    v-model="formModel.fb_link"
                                    placeholder="Facebook ლინკი"
                                />
                            </div>
                        </div>
                        <img
                            :src="`/storage/${data.avatar}`"
                            alt=""
                            style="height: 200px; width: 200px"
                        />
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputFile"
                                    >განაახლე სურათი</label
                                >
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input
                                            type="file"
                                            class="custom-file-input"
                                            id="exampleInputFile"
                                            @change="avatarUpload"
                                        />
                                        <label
                                            class="custom-file-label"
                                            for="exampleInputFile"
                                            >{{ imgName }}</label
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- /.card-body -->
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-success"
                        @click="updateHR(model)"
                    >
                        <i class=""></i>განახლება
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
