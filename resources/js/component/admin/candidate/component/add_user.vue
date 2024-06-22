<template lang="">
    <div class="row">
        <div class="col-sm-4">
            <!-- text input -->
            <div class="form-group">
                <label>რეგისტრაციის ტიპი</label>
                <multiselect
                    v-model="m.type"
                    :options="registerType"
                    deselect-label="Can't remove this value"
                    track-by="name"
                    label="name"
                    placeholder="Select one"
                    :searchable="true"
                    :allow-empty="false"
                    @blur="v$.m.type.$touch"
                >
                    <template
                        slot="singleLabel"
                        slot-scope="{ option }"
                    ></template>
                </multiselect>
            </div>
        </div>
        <div class="row col-sm-8" v-if="m.type && m.type.id == 1">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>ჩასარიცხი თანხა</label>
                    <input
                        type="number"
                        class="form-control"
                        v-model="m.money"
                        placeholder="მაგ: 30"
                    />
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>ჩარიცხვის თარიღი</label>
                    <input
                        type="date"
                        class="form-control"
                        v-model="m.enroll_date"
                    />
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <!-- text input -->
            <div class="form-group">
                <label>სახელი გვარი</label>
                <input
                    type="text"
                    class="form-control"
                    v-model="m.name_ka"
                    placeholder="სახელი გვარი"
                />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>ნომერი</label>
                <input
                    class="form-control"
                    :class="v$.m.number.$error ? 'is-invalid' : ''"
                    v-model="m.number"
                    type="text"
                    @blur="v$.m.number.$touch"
                    placeholder="ნომერი"
                />
                <span
                    v-if="v$.m.number.required.$invalid && v$.m.number.$dirty"
                    style="color: red"
                    >* {{ v$.m.number.required.$message }}</span
                >
                <span
                    v-if="v$.m.number.numeric.$invalid && v$.m.number.$dirty"
                    style="color: red"
                    >* {{ v$.m.number.numeric.$message }}</span
                >
                <span
                    v-if="v$.m.number.maxLength.$invalid && v$.m.number.$dirty"
                    style="color: red"
                    >* {{ v$.m.number.maxLength.$message }}</span
                >
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>მაილი</label>
                <input
                    class="form-control"
                    v-model="m.email"
                    type="email"
                    placeholder="მაილი"
                />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>პაროლი</label>
                <input
                    class="form-control"
                    v-model="m.password"
                    type="text"
                    placeholder="პაროლი"
                />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>დაბადების თარიღი</label>
                <input
                    class="form-control d"
                    auth-provide=""
                    type="date"
                    v-model="m.date_of_birth"
                    placeholder="mm/dd/yyyy"
                    @blur="v$.m.date_of_birth.$touch"
                />
                <span
                    v-if="
                        v$.m.date_of_birth.required.$invalid &&
                        v$.m.date_of_birth.$dirty
                    "
                    style="color: red"
                    >* {{ v$.m.date_of_birth.required.$message }}</span
                >
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>სქესი</label>
                <multiselect
                    v-model="m.gender"
                    :options="cla.gender"
                    deselect-label="Can't remove this value"
                    track-by="name_ka"
                    label="name_ka"
                    placeholder="Select one"
                    :searchable="true"
                    :allow-empty="false"
                    @blur="v$.m.gender.$touch"
                >
                    <template
                        slot="singleLabel"
                        slot-scope="{ option }"
                    ></template>
                </multiselect>
                <span
                    v-if="v$.m.gender.required.$invalid && v$.m.gender.$dirty"
                    style="color: red"
                    >* {{ v$.m.gender.required.$message }}</span
                >
            </div>
        </div>
        <!-- <div class="col-xl-12 col-lg-12 col-md-12 mb-3">
            <div class="form-check">
                <input
                    type="checkbox"
                    class="form-check-input"
                    id="exampleCheck1"
                    :value="true"
                    v-model="m.was_assigned"
                />
                <label class="form-check-label" for="exampleCheck1"
                    >დაეწეროს ადმინისტრატორ დასასრულებლად</label
                >
            </div>
        </div> -->
        <div class="col-12">
            <div class="row">
                <div class="col-sm-4 mb-2">
                    <button class="btn btn-primary" @click="generatePassword()">
                        პაროლის გენერირება
                    </button>
                </div>
                <div class="col-sm-5 mb-2">
                    <div class="form-check">
                        <input
                            type="checkbox"
                            class="form-check-input"
                            id="exampleCheck1"
                            style="width: 18px; height: 18px"
                            :value="true"
                            v-model="m.was_assigned"
                        />
                        <label class="form-check-label" for="exampleCheck1">
                            დაეწეროს ადმინისტრატორს დასასრულებლად</label
                        >
                    </div>
                </div>
                <div class="col-sm-3 d-flex justify-content-end">
                    <button class="btn btn-success" @click.prevent="add()">
                        დამატება
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { useVuelidate } from "@vuelidate/core";
import {
    required,
    email,
    helpers,
    numeric,
    maxLength,
} from "@vuelidate/validators";
export default {
    setup() {
        return { v$: useVuelidate() };
    },
    props: {
        data: Object,
    },
    data() {
        return {
            m: null,
            cla: {},
            registerType: [
                { id: 1, name: "ფასიანი რეგისტრაცია" },
                { id: 2, name: "უფასო რეგისტრაცია" },
            ],
        };
    },
    validations() {
        const validations = {
            m: {
                type: {
                    required: helpers.withMessage(
                        "არჩევა სავალდებულოა",
                        required
                    ),
                },
                number: {
                    required: helpers.withMessage(
                        "ნომრის შევსება სავალდებულოა",
                        required
                    ),
                    numeric: helpers.withMessage(
                        "ნომრი უნდა შედგებოდეს მხოლოდ ციფრებისგან",
                        numeric
                    ),
                    maxLength: helpers.withMessage(
                        "ნომრი უნდა შედგებოდეს 9 ციფრებისგან",
                        maxLength(9)
                    ),
                },
                gender: {
                    required: helpers.withMessage(
                        "სქესის არჩევა სავალდებულოა",
                        required
                    ),
                },
                date_of_birth: {
                    required: helpers.withMessage(
                        "დაბადების თარიღის შევსება სავალდებულოა",
                        required
                    ),
                },
            },
        };
        return validations;
    },
    created() {
        this.m = {
            type: null,
            money: null,
            enroll_date: null,
            name_ka: null,
            number: null,
            email: null,
            password: null,
            date_of_birth: null,
            gender: null,
            was_assigned: false,
        };
        console.log(this.data);
        this.cla = this.data.cla;
    },
    methods: {
        async add() {
            // console.log(this.m);
            // return;
            const isFormCorrect = await this.v$.$validate();
            if (!isFormCorrect) return;
            let currentObj = this;
            axios({
                method: "post",
                url: "/add_user",
                data: this.m,
            })
                .then(function (response) {
                    if (response.data.status == 200) {
                        toast.success("ინფორმაცია წარმატებით შეინახა", {
                            theme: "colored",
                            autoClose: 1000,
                        });
                        let url = new URL(location.href);
                        let nextUrl = this.m.was_assigned
                            ? `${url.origin}/admin/vacancy?ka`
                            : `${url.origin}/ka/user/userProfile?user=${response.data.data.id}`;
                        window.location.replace(
                            nextUrl
                        );
                        // setTimeout(() => {
                        //     document.location.reload();
                        // }, 1500);
                    }
                })
                .catch(function (error) {
                    console.log(error);
                    // Display an error message to the user
                    toast.error(
                        "შეცდომა: ინფორმაციის შენახვის პროცესში შეცდომა",
                        {
                            theme: "colored",
                            autoClose: 3000, // Show the error message for 3 seconds
                        }
                    );
                });
        },
        generatePassword() {
            const length = 8;
            const characters =
                "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789!@#$%";
            let password = "";

            for (let i = 0; i < length; i++) {
                password += characters.charAt(
                    Math.floor(Math.random() * characters.length)
                );
            }
            this.m.password = password;
        },
    },
    watch: {},
};
</script>
<style lang=""></style>
