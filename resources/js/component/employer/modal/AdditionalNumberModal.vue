<script setup>
import { ref, computed, watch, reactive } from "vue";
import { errorMessage } from "../../../plugins/vuelidate/validationMessages";
import { cloneDeep } from "lodash";
const props = defineProps({
    visible: Boolean,
    cla: Object,
    message:{
        type: String,
        default: null
    }
});
const emit = defineEmits(["closeModal", "sendData"]);
const showConfirm = ref(false);
const showError = ref(false);
const m = reactive({
    number_code: null,
    number: null,
    number_owner: null,
    comment: null,
});
const show = async () => {
    try {
        // let result = await getData();
        // interest.value = result.data
        showConfirm.value = true;
        const georgianNumber = _.find(props.cla.numberCode, { iso: "GE" });
        m.number_code = georgianNumber;
        console.log("m", m);
        // m.value.id = props.id
        console.log("cla", props.cla);
    } catch (error) {}
};
const numberError = ref('');
const numberOwnerError = ref('');
const validateData = (model) => {
    let isValid = true;

    // Check if the 'number' field is filled in
    if (!model.number) {
        numberError.value = errorMessage("required");
        isValid = false; // Update validity to false
    } else if (!/^\d+$/.test(model.number)) {
        // Check if the 'number' field contains only numbers
        numberError.value = errorMessage("numeric");
        isValid = false; // Update validity to false
    } else {
        numberError.value = ""; // Clear error message
    }

    // Check if the 'number_owner' field is filled in
    if (!model.number_owner) {
        numberOwnerError.value = errorMessage("required");
        isValid = false; // Update validity to false
    } else {
        // Optionally, add specific validation for 'number_owner' here
        numberOwnerError.value = ""; // Clear error message
    }

    return isValid;
};
const hide = () => {
    showConfirm.value = false;
    showError.value = false;
    for (const key in m) {
        if (m.hasOwnProperty(key)) {
            m[key] = null;
        }
    }
    emit("closeModal", false);
};
const sendParent = () => {
    showError.value = true;
    if (!validateData(m)) {
        return;
    }
    const formData = _.cloneDeep(m);
    emit("sendData", formData);
    hide();
};
const getLang = computed(() => {
    return I18n.getSharedInstance().options.lang;
});

console.log("m", m);
const chooseNumberCode = (item) => {
    m.number_code = item;
};

watch(
    () => props.visible,
    (value) => {
        console.log(value);
        if (value) {
            show();
        }
    }
);
</script>
<template>
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
                        დამატებითი საკონტაქტო ნომრების დამატება
                    </h6>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                        @click="hide()"
                    ></button>
                </div>
                <div class="modal-body">
                    <div v-if="message" class="d-flex justify-content-center">
                        <p class="text-danger">{{ message }}!!!</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label
                                    ><span class="text-danger">* </span
                                    >{{ "ტელეფონის ნომერი" }}</label
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
                                            :class="`fi fi-${m.number_code.iso.toLowerCase()}`"
                                        ></span
                                        >+{{ m.number_code.phonecode }}
                                    </button>
                                    <ul
                                        class="dropdown-menu"
                                        style="
                                            overflow: hidden;
                                            overflow-y: auto;
                                            max-height: 30vh;
                                        "
                                    >
                                        <li
                                            v-for="item in cla.numberCode"
                                            @click="chooseNumberCode(item)"
                                            :key="item.id"
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
                                        :class="
                                            m.number == null ? 'is-invalid' : ''
                                        "
                                        v-model="m.number"
                                        placeholder="ნომერი"
                                        :maxLength="
                                            m.number_code.id == 79 ? 9 : 20
                                        "
                                        onkeypress="return /[0-9]/i.test(event.key)"
                                    />

                                </div>
                                <span
                                    v-if="
                                        showError && numberError !== ''
                                    "
                                    style="color: red"
                                    >{{ numberError }}</span
                                >
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <span class="text-danger">* </span
                                ><label>{{
                                    $t("lang.user_profile_page_number_owner")
                                }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.number_owner"
                                        :options="cla.numberOwner"
                                        deselect-label="წაშალე არჩეული"
                                        :track-by="`name_${getLang}`"
                                        :label="`name_${getLang}`"
                                        placeholder="Select one"
                                        :searchable="true"
                                        :allow-empty="true"
                                    >
                                        <!-- :disabled="m.length == limit" -->
                                    </multiselect>
                                </div>
                            </div>
                            <span
                                v-if="
                                    showError && numberOwnerError !== ''
                                "
                                style="color: red"
                                >{{ numberOwnerError }}</span
                            >
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>დამატებითი ინფორმაცია </label>
                                <textarea
                                    class="form-control"
                                    v-model="m.comment"
                                    rows="2"
                                    placeholder="მფლობელის სახელი გვარი ან რაიმე დამატებითი ინფორმაცია მასთან დარეკვის თაობაზე"
                                ></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a
                        type="button"
                        class="btn btn-success"
                        @click="sendParent()"
                        ><i class=""></i>დამატება</a
                    >
                </div>
            </div>
        </div>
    </div>
</template>
