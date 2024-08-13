<script setup>
import { ref, reactive, watch } from "vue";
import axios from "axios";

const props = defineProps({
    visible: Boolean,
    role: Number,
    cla: Object,
});

const showConfirm = ref(false);
const avatar = ref(null);
const imgName = ref("აირჩიე სურათი");
const model = reactive({
    role_id: null,
    name: "",
    email: "",
    mobile: "",
    date_of_birth: "",
    gender_id: "",
    person_number: "",
    number: "",
    inside_number: "",
    branch_id: "",
    internship: "",
    fb_link: "",
    password: "",
});

const show = () => {
    showConfirm.value = true;
    model.role_id = props.role;
};

const hide = () => {
    showConfirm.value = false;
};
watch(
    () => props.visible,
    (newValue) => {
        show();
    }
);
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
    model.password = result;
};

const avatarUpload = (event) => {
    avatar.value = event.target.files[0];
    imgName.value = event.target.files[0].name;
};

const addStaff = async () => {
    const config = {
        headers: {
            "Content-Type": "multipart/form-data",
        },
    };
    let formData = new FormData();
    Object.keys(model).forEach((key) => {
        formData.append(key, model[key]);
    });
    if (avatar.value != null) {
        formData.append("avatar", avatar.value);
    } else {
        formData.append("avatar", "");
    }

    try {
        const response = await axios.post("/add_staff", formData, config);
        if (response.status == 200) {
            hide();
            toast.success("ინფორმაცია წარმატებით შეინახა", {
                theme: "colored",
                autoClose: 1000,
            });
            setTimeout(() => {
                document.location.reload();
            }, 1500);
        } else {
            toast.error("ინფორმაცია არასწორია", {
                theme: "colored",
                autoClose: 1000,
            });
        }
    } catch (error) {
        console.log(error);
        toast.error("ინფორმაცია არასწორია", {
            theme: "colored",
            autoClose: 1000,
        });
    }
};
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
        style="display: block"
    >
        <div
            class="modal-dialog modal-dialog-centered modal-xl"
            role="document"
        >
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">
                        {{
                            `ახალი ${
                                role == 2 ? `HR` : `ადმინისტრატორი`
                            } - ის დამატება`
                        }}
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
                                    ><span class="text-danger">* </span>სახელი
                                    გვარი</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="exampleInputEmail1"
                                    v-model="model.name"
                                    placeholder="სახელი გვარი"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"
                                    ><span class="text-danger">* </span
                                    >Email</label
                                >
                                <input
                                    type="email"
                                    class="form-control"
                                    id="exampleInputEmail2"
                                    v-model="model.email"
                                    placeholder="ემაილი"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"
                                    ><span class="text-danger">* </span>საკუთარი
                                    ტელეფონის ნომერი</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="exampleInputEmail3"
                                    v-model="model.mobile"
                                    placeholder="საკუთარი ტელეფონის ნომერი"
                                    minlength="9"
                                />
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"
                                    ><span class="text-danger">* </span
                                    >დაბადების თარიღი</label
                                >
                                <input
                                    type="date"
                                    class="form-control"
                                    v-model="model.date_of_birth"
                                    id="exampleInputEmail4"
                                />
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <label for=""
                                ><span class="text-danger">* </span>სქესი</label
                            >
                            <div class="form-group d-flex border rounded p-2">
                                <div class="form-check mr-2">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        value="1"
                                        v-model="model.gender_id"
                                    />
                                    <label class="form-check-label">კაცი</label>
                                </div>
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        value="2"
                                        v-model="model.gender_id"
                                    />
                                    <label class="form-check-label">ქალი</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"
                                    ><span class="text-danger">* </span>პირადი
                                    ნომერი</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="exampleInputEmail7"
                                    v-model="model.person_number"
                                    placeholder="პირადი ნომერი"
                                    maxlength="11"
                                    onkeypress="return /[0-9]/i.test(event.key)"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputFile"
                                    >ატვირთე სურათი</label
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputFile"
                                    ><span class="text-danger">* </span
                                    >პაროლი</label
                                >
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="exampleInputPassword1"
                                        v-model="model.password"
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
                                    ><span class="text-danger">* </span
                                    >კორპორატიული ნომერი</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="exampleInputEmail5"
                                    v-model="model.number"
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
                                    v-model="model.inside_number"
                                    placeholder="შიდა ნომერი"
                                />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1"
                                    ><span class="text-danger">* </span
                                    >ფილიალი</label
                                >
                                <select
                                    class="form-control"
                                    id="exampleFormControlSelect1"
                                    v-model="model.branch_id"
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
                                    ><span class="text-danger">* </span>ბონუსის
                                    პროცენტი</label
                                >
                                <input
                                    type="number"
                                    class="form-control"
                                    id="exampleInputEmail6"
                                    v-model="model.bonus_percent"
                                    placeholder="ვაკანსიის ბონუსის პროცენტი"
                                    step="0.5"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"
                                    ><span class="text-danger">* </span
                                    >ფიქსირებული ხელფასი</label
                                >
                                <input
                                    type="number"
                                    class="form-control"
                                    id="exampleInputEmail6"
                                    v-model="model.fixed_salary"
                                    placeholder="ფიქსირებული ხელფასი"
                                />
                            </div>
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
                                    v-model="model.fb_link"
                                    placeholder="Facebook ლინკი"
                                />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="exampleCheck1"
                                    v-model="model.internship"
                                />
                                <label
                                    class="form-check-label"
                                    for="exampleCheck1"
                                    >სტაჟიორი</label
                                >
                            </div>
                        </div>
                    </div>

                    <!-- /.card-body -->
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-success"
                        @click="addStaff"
                    >
                        <i class=""></i>დამატება
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.modal-body {
    height: 250px;
    overflow-y: auto;
}

@media (min-height: 500px) {
    .modal-body {
        height: 400px;
    }
}

@media (min-height: 800px) {
    .modal-body {
        height: 700px;
    }
}
</style>
