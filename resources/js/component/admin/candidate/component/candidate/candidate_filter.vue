<script setup>
import { ref, defineProps, defineEmits } from "vue";
import Slider from "@vueform/slider";
import axios from "axios";
import { toast } from "vue3-toastify";
// Import other dependencies as needed

const props = defineProps(["cla"]);
const emit = defineEmits();
// const { emit } = defineEmits(['emitFilterData']);

const m = ref({
    age: [18, 90],
    height: [140, 220],
    weight: [40, 180],
    payment: [50, 5000],
});

const colspanClass = ref("hide");
const isColspanVisible = ref(false);

const toggleCollapse = (item) => {
    colspanClass.value = item == "show" ? "hide" : "show";
    isColspanVisible.value = !isColspanVisible.value;
};

const filter = () => {
    const searchData = {...m.value};
    if (searchData.age && searchData.age[0] == 18 && searchData.age[1] == 90) {
        delete searchData.age;
    }
    if (searchData.height && searchData.height[0] == 140 && searchData.height[1] == 220) {
        delete searchData.height;
    }
    if (searchData.weight && searchData.weight[0] == 40 && searchData.weight[1] == 180) {
        delete searchData.weight;
    }
    if (searchData.payment && searchData.payment[0] == 50 && searchData.payment[1] == 5000) {
        delete searchData.payment;
    }
    for (let i = 0; i < Object.keys(searchData).length; i++) {
        if (searchData[i] == "") {
            delete searchData[i];
        }
    }
    if (Object.keys(searchData).length == 0) {
        toast.error("შეცვალეთ პარამეტრები", {
            theme: "colored",
            autoClose: 1000,
        });
        return;
    }
    toggleCollapse("show");
    emit("emitFilterData", searchData);
    // emitData(m.value)
    // axios.post('/candidate_filter?page=' + 1, m.value)
    //     .then((response) => {
    //         console.log(response);
    //     const obj = {
    //         candidate: response.data.data,
    //         pagination: {
    //         current_page: response.data.current_page,
    //         last_page: response.data.last_page,
    //         },
    //     };
    //     emitData(obj);
    // })
    // .catch((error) => {
    //     console.error(error);
    // });
};
</script>
<template lang="">
    <div id="accordion">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title w-100 d-flex justify-content-between">
                    <a
                        class="d-block w-100"
                        @click="toggleCollapse(colspanClass)"
                        href="#collapseOne"
                    >
                        ფილტრი
                    </a>
                    <i class="fas fa-angle-down float-right"></i>
                </h4>
            </div>
            <div
                id="collapseOne"
                class="collapse"
                :class="colspanClass"
                data-parent="#accordion"
            >
                <div class="card-body" v-if="isColspanVisible">
                    <div class="row">
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>ID</label>
                                <div class="ls-inputicon-box">
                                    <input
                                        class="form-control"
                                        v-model="m.id"
                                        type="text"
                                        placeholder="49"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>სახელი გვარი</label>
                                <div class="ls-inputicon-box">
                                    <input
                                        class="form-control"
                                        v-model="m.name"
                                        type="text"
                                        placeholder="Devid Smith"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>ტელეფონის ნომერი</label>
                                <div class="ls-inputicon-box">
                                    <input
                                        class="form-control"
                                        v-model="m.number"
                                        type="text"
                                        placeholder="555444333"
                                        onkeypress="return event.which != 32"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>პირადი ნომერი</label>
                                <div class="ls-inputicon-box">
                                    <input
                                        class="form-control"
                                        v-model="m.personal_number"
                                        type="text"
                                        placeholder="01234567890"
                                        onkeypress="return event.which != 32"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>მისამართი</label>
                                <div class="ls-inputicon-box">
                                    <input
                                        class="form-control"
                                        v-model="m.address"
                                        type="text"
                                        placeholder="თბილის სამგორი კახეთის გზატკეცილი"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label class="ml-4"> ასაკი</label>
                                <div class="ls-inputicon-box mt-4">
                                    <Slider
                                        v-model="m.age"
                                        :min="18"
                                        :max="90"
                                        :step="10"
                                        class="slider"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>სიმაღლე</label>
                                <div class="ls-inputicon-box mt-4">
                                    <Slider
                                        v-model="m.height"
                                        :min="140"
                                        :max="220"
                                        :step="10"
                                        class="slider"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>წონა</label>
                                <div class="ls-inputicon-box mt-4">
                                    <Slider
                                        v-model="m.weight"
                                        :min="40"
                                        :max="180"
                                        :step="10"
                                        class="slider"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>სქესი</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.gender"
                                        :options="cla.gender"
                                        deselect-label="Can't remove this value"
                                        track-by="name_ka"
                                        label="name_ka"
                                        placeholder="Select one"
                                        :searchable="true"
                                        :allow-empty="false"
                                    >
                                        <template
                                            slot="singleLabel"
                                            slot-scope="{ option }"
                                        ></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>ეროვნება</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.nationality"
                                        :options="cla.nationality"
                                        :multiple="true"
                                        :close-on-select="false"
                                        :clear-on-select="false"
                                        :preserve-search="true"
                                        label="name_ka"
                                        track-by="name_ka"
                                        :preselect-first="false"
                                    >
                                        <template
                                            slot="selection"
                                            slot-scope="{
                                                values,
                                                search,
                                                isOpen,
                                            }"
                                            ><span
                                                class="multiselect__single"
                                                v-if="values.length"
                                                v-show="!isOpen"
                                                >{{ values.length }} options
                                                selected</span
                                            ></template
                                        >
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>მოქალაქეობა</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.citizenship"
                                        :options="cla.citizenship"
                                        :multiple="true"
                                        :close-on-select="false"
                                        :clear-on-select="false"
                                        :preserve-search="true"
                                        label="name_ka"
                                        track-by="name_ka"
                                        :preselect-first="false"
                                    >
                                        <template
                                            slot="selection"
                                            slot-scope="{
                                                values,
                                                search,
                                                isOpen,
                                            }"
                                            ><span
                                                class="multiselect__single"
                                                v-if="values.length"
                                                v-show="!isOpen"
                                                >{{ values.length }} options
                                                selected</span
                                            ></template
                                        >
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>რელიგია</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.religion"
                                        :options="cla.religions"
                                        :multiple="true"
                                        :close-on-select="false"
                                        :clear-on-select="false"
                                        :preserve-search="true"
                                        label="name_ka"
                                        track-by="name_ka"
                                        :preselect-first="false"
                                    >
                                        <template
                                            slot="selection"
                                            slot-scope="{
                                                values,
                                                search,
                                                isOpen,
                                            }"
                                            ><span
                                                class="multiselect__single"
                                                v-if="values.length"
                                                v-show="!isOpen"
                                                >{{ values.length }} options
                                                selected</span
                                            ></template
                                        >
                                    </multiselect>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>განათლება</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.education"
                                        :options="cla.educations"
                                        :multiple="true"
                                        :close-on-select="false"
                                        :clear-on-select="false"
                                        :preserve-search="true"
                                        label="name_ka"
                                        track-by="name_ka"
                                        :preselect-first="false"
                                    >
                                        <template
                                            slot="selection"
                                            slot-scope="{
                                                values,
                                                search,
                                                isOpen,
                                            }"
                                            ><span
                                                class="multiselect__single"
                                                v-if="values.length"
                                                v-show="!isOpen"
                                                >{{ values.length }} options
                                                selected</span
                                            ></template
                                        >
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>პროფესია</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.profession"
                                        :options="cla.professions"
                                        :multiple="true"
                                        :close-on-select="false"
                                        :clear-on-select="false"
                                        :preserve-search="true"
                                        label="name_ka"
                                        track-by="name_ka"
                                        :preselect-first="false"
                                    >
                                        <template
                                            slot="selection"
                                            slot-scope="{
                                                values,
                                                search,
                                                isOpen,
                                            }"
                                            ><span
                                                class="multiselect__single"
                                                v-if="values.length"
                                                v-show="!isOpen"
                                                >{{ values.length }} options
                                                selected</span
                                            ></template
                                        >
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>სპეციალობა</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.specialty"
                                        :options="cla.specialties"
                                        :multiple="true"
                                        :close-on-select="false"
                                        :clear-on-select="false"
                                        :preserve-search="true"
                                        label="name_ka"
                                        track-by="name_ka"
                                        :preselect-first="false"
                                    >
                                        <template
                                            slot="selection"
                                            slot-scope="{
                                                values,
                                                search,
                                                isOpen,
                                            }"
                                            ><span
                                                class="multiselect__single"
                                                v-if="values.length"
                                                v-show="!isOpen"
                                                >{{ values.length }} options
                                                selected</span
                                            ></template
                                        >
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>უცხო ენა</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.language"
                                        :options="cla.languages"
                                        :multiple="true"
                                        :close-on-select="false"
                                        :clear-on-select="false"
                                        :preserve-search="true"
                                        label="name_ka"
                                        track-by="name_ka"
                                        :preselect-first="false"
                                    >
                                        <template
                                            slot="selection"
                                            slot-scope="{
                                                values,
                                                search,
                                                isOpen,
                                            }"
                                            ><span
                                                class="multiselect__single"
                                                v-if="values.length"
                                                v-show="!isOpen"
                                                >{{ values.length }} options
                                                selected</span
                                            ></template
                                        >
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>ცოდნის დონე</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.language_level"
                                        :options="cla.languageLevels"
                                        :multiple="true"
                                        :close-on-select="false"
                                        :clear-on-select="false"
                                        :preserve-search="true"
                                        label="name_ka"
                                        track-by="name_ka"
                                        :preselect-first="false"
                                    >
                                        <template
                                            slot="selection"
                                            slot-scope="{
                                                values,
                                                search,
                                                isOpen,
                                            }"
                                            ><span
                                                class="multiselect__single"
                                                v-if="values.length"
                                                v-show="!isOpen"
                                                >{{ values.length }} options
                                                selected</span
                                            ></template
                                        >
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>მართვის მოწმობა</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.drivingLicense"
                                        :options="cla.drivingLicense"
                                        :multiple="true"
                                        :close-on-select="false"
                                        :clear-on-select="false"
                                        :preserve-search="true"
                                        label="name"
                                        track-by="name"
                                        :preselect-first="false"
                                    >
                                        <template
                                            slot="selection"
                                            slot-scope="{
                                                values,
                                                search,
                                                isOpen,
                                            }"
                                            ><span
                                                class="multiselect__single"
                                                v-if="values.length"
                                                v-show="!isOpen"
                                                >{{ values.length }} options
                                                selected</span
                                            ></template
                                        >
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>ალერგია</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.allergy"
                                        :options="cla.allergies"
                                        :multiple="true"
                                        :close-on-select="false"
                                        :clear-on-select="false"
                                        :preserve-search="true"
                                        label="name_ka"
                                        track-by="name_ka"
                                        :preselect-first="false"
                                    >
                                        <template
                                            slot="selection"
                                            slot-scope="{
                                                values,
                                                search,
                                                isOpen,
                                            }"
                                            ><span
                                                class="multiselect__single"
                                                v-if="values.length"
                                                v-show="!isOpen"
                                                >{{ values.length }} options
                                                selected</span
                                            ></template
                                        >
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>ზოგადი მახასიათებლები</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.characteristic"
                                        :options="cla.characteristic"
                                        :multiple="true"
                                        :close-on-select="false"
                                        :clear-on-select="false"
                                        :preserve-search="true"
                                        label="name_ka"
                                        track-by="name_ka"
                                        :preselect-first="false"
                                    >
                                        <template
                                            slot="selection"
                                            slot-scope="{
                                                values,
                                                search,
                                                isOpen,
                                            }"
                                            ><span
                                                class="multiselect__single"
                                                v-if="values.length"
                                                v-show="!isOpen"
                                                >{{ values.length }} options
                                                selected</span
                                            ></template
                                        >
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>ოჯახური მდგომარეობა</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.maritalStatus"
                                        :options="cla.maritalStatus"
                                        :multiple="true"
                                        :close-on-select="false"
                                        :clear-on-select="false"
                                        :preserve-search="true"
                                        label="name_ka"
                                        track-by="name_ka"
                                        :preselect-first="false"
                                    >
                                        <template
                                            slot="selection"
                                            slot-scope="{
                                                values,
                                                search,
                                                isOpen,
                                            }"
                                            ><span
                                                class="multiselect__single"
                                                v-if="values.length"
                                                v-show="!isOpen"
                                                >{{ values.length }} options
                                                selected</span
                                            ></template
                                        >
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>შვილების რაოდენობა</label>
                                <div class="ls-inputicon-box">
                                    <input
                                        class="form-control"
                                        v-model="m.children"
                                        type="text"
                                        placeholder="2"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 border"></div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>კატეგორია</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.category"
                                        :options="cla.category"
                                        deselect-label="Can't remove this value"
                                        track-by="name_ka"
                                        label="name_ka"
                                        placeholder="Select one"
                                        :searchable="true"
                                        :allow-empty="false"
                                    >
                                        <template
                                            slot="singleLabel"
                                            slot-scope="{ option }"
                                        ></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>გრაფიკი</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.work_schedule"
                                        :options="cla.workSchedule"
                                        deselect-label="Can't remove this value"
                                        track-by="name_ka"
                                        label="name_ka"
                                        placeholder="Select one"
                                        :searchable="true"
                                        :allow-empty="false"
                                    >
                                        <template
                                            slot="singleLabel"
                                            slot-scope="{ option }"
                                        ></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>სტატუსი</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.status"
                                        :options="cla.candidateStatus"
                                        :multiple="true"
                                        :close-on-select="false"
                                        :clear-on-select="false"
                                        :preserve-search="true"
                                        label="name_ka"
                                        track-by="name_ka"
                                        :preselect-first="false"
                                    >
                                        <template
                                            slot="selection"
                                            slot-scope="{
                                                values,
                                                search,
                                                isOpen,
                                            }"
                                            ><span
                                                class="multiselect__single"
                                                v-if="values.length"
                                                v-show="!isOpen"
                                                >{{ values.length }} options
                                                selected</span
                                            ></template
                                        >
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>მოვალეობა</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.duty"
                                        :options="cla.candidateDuty"
                                        :multiple="true"
                                        :close-on-select="false"
                                        :clear-on-select="false"
                                        :preserve-search="true"
                                        label="name_ka"
                                        track-by="name_ka"
                                        :preselect-first="false"
                                    >
                                        <template
                                            slot="selection"
                                            slot-scope="{
                                                values,
                                                search,
                                                isOpen,
                                            }"
                                            ><span
                                                class="multiselect__single"
                                                v-if="values.length"
                                                v-show="!isOpen"
                                                >{{ values.length }} options
                                                selected</span
                                            ></template
                                        >
                                    </multiselect>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>ანაზღაურება</label>
                                <div class="ls-inputicon-box mt-4">
                                    <Slider
                                        v-model="m.payment"
                                        :min="50"
                                        :max="5000"
                                        :step="10"
                                        class="slider"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 border"></div>
                        <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="exampleCheck1"
                                    value="1"
                                    v-model="m.go_vacation"
                                />
                                <label
                                    class="form-check-label"
                                    for="exampleCheck1"
                                    >შეეძლოს არდადეგებზე გაყოლა</label
                                >
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="exampleCheck2"
                                    value="1"
                                    v-model="m.stay_night"
                                />
                                <label
                                    class="form-check-label"
                                    for="exampleCheck2"
                                    >შეეძლოს ღამე დარჩენა</label
                                >
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="exampleCheck3"
                                    value="1"
                                    v-model="m.work_additional_hours"
                                />
                                <label
                                    class="form-check-label"
                                    for="exampleCheck3"
                                    >შეეძლო დამატებით საათებში მუშაობა</label
                                >
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="exampleCheck4"
                                    value="1"
                                    v-model="m.convection"
                                />
                                <label
                                    class="form-check-label"
                                    for="exampleCheck4"
                                    >არა ნასამართლევი</label
                                >
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="exampleCheck5"
                                    value="1"
                                    v-model="m.smoke"
                                />
                                <label
                                    class="form-check-label"
                                    for="exampleCheck5"
                                    >არა მწეველი</label
                                >
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="exampleCheck6"
                                    value="1"
                                    v-model="m.work_abroad"
                                />
                                <label
                                    class="form-check-label"
                                    for="exampleCheck6"
                                    >შეეძლო საზღვარ გარეთ მუშაობა</label
                                >
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="exampleCheck7"
                                    value="1"
                                    v-model="m.has_general_work_experience"
                                />
                                <label
                                    class="form-check-label"
                                    for="exampleCheck7"
                                    >ზოგადი სამუშაო გამოცდილება</label
                                >
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="exampleCheck8"
                                    value="1"
                                    v-model="m.has_family_work_experience"
                                />
                                <label
                                    class="form-check-label"
                                    for="exampleCheck8"
                                    >ოჯახში მუშაობის გამოცდილება</label
                                >
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12 my-3">
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="exampleCheck9"
                                    value="1"
                                    v-model="m.has_recommendation"
                                />
                                <label
                                    class="form-check-label"
                                    for="exampleCheck9"
                                    >რეკომენდაცია</label
                                >
                            </div>
                        </div>
                        <div class="col-md-12 border"></div>
                        <div class="col-xl-4 col-lg-6 col-md-12 my-3">
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="exampleCheck10"
                                    value="1"
                                    v-model="m.my_registration"
                                />
                                <label
                                    class="form-check-label"
                                    for="exampleCheck10"
                                    >ჩემი დარეგისტრირებულები</label
                                >
                            </div>
                        </div>
                        <div
                            class="col-xl-4 col-lg-6 col-md-12 my-3"
                            v-if="m.my_registration"
                        >
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="exampleCheck11"
                                    value="1"
                                    v-model="m.paid_registration"
                                />
                                <label
                                    class="form-check-label"
                                    for="exampleCheck11"
                                    >ფასიანი რეგისტრაცია</label
                                >
                            </div>
                        </div>
                        <div
                            class="col-xl-4 col-lg-6 col-md-12 my-3"
                            v-if="m.my_registration"
                        >
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="exampleCheck12"
                                    value="1"
                                    v-model="m.free_registration"
                                />
                                <label
                                    class="form-check-label"
                                    for="exampleCheck12"
                                    >უფასო რეგისტრაცია</label
                                >
                            </div>
                        </div>
                        <div
                            class="col-xl-4 col-lg-6 col-md-12 my-3"
                            v-if="m.paid_registration"
                        >
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="exampleCheck13"
                                    value="1"
                                    v-model="m.paid"
                                />
                                <label
                                    class="form-check-label"
                                    for="exampleCheck13"
                                    >გადაიხადა სარეგისტრაციო</label
                                >
                            </div>
                        </div>
                        <div
                            class="col-xl-4 col-lg-6 col-md-12 my-3"
                            v-if="m.paid_registration"
                        >
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="exampleCheck14"
                                    value="1"
                                    v-model="m.has_to_pay"
                                />
                                <label
                                    class="form-check-label"
                                    for="exampleCheck14"
                                    >გადასახდელი აქვს სარეგისტრაციო</label
                                >
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <button
                                type="button"
                                class="btn btn-success float-right"
                                @click="filter"
                            >
                                <i class="fa fa-search"></i> ძებნა
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</template>

<style lang=""></style>
