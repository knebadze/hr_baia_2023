<script setup>
import { reactive, ref, computed } from "vue";
import { useUnfinishedRegistrationStore } from "../../../../store/admin/unfinishedRegistrationStore";
import { storeToRefs } from "pinia";
import moment from "moment";
import { some } from "lodash";
import { toastNotification } from "../../../../helper/toastNotification";
const colspanClass = ref("hide");
const isColspanVisible = ref(true);
const unfinishedRegistrationStore = useUnfinishedRegistrationStore();
const { cla, filterItem } = storeToRefs(unfinishedRegistrationStore);
const { completed, filterUnfinishedRegistrations } =
    unfinishedRegistrationStore;
const props = defineProps({
    cla: Object,
    role_id: Number,
});
const maxDate = computed(() => moment().format("YYYY-MM-DD"));
function toggleCollapse() {
    isColspanVisible.value = !isColspanVisible.value;
}
toggleCollapse("show");

const filter = (page = 0) => {
    const hasNonNull = some(filterItem.value, (value) => value !== null);
    if (hasNonNull) {
        filterUnfinishedRegistrations(page, filterItem.value);
    } else {
        toastNotification("აირჩიეთ პარამეტრი", "error");
    }
};
</script>
<template>
    <div id="accordion">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title w-100 d-flex justify-content-between">
                    <a
                        class="d-block w-100"
                        @click="toggleCollapse"
                        href="#collapseOne"
                    >
                        ფილტრი
                    </a>
                    <i
                        :class="
                            !isColspanVisible
                                ? 'fas fa-angle-down float-right'
                                : 'fas fa-angle-up float-right'
                        "
                    ></i>
                </h4>
            </div>
            <div
                id="collapseOne"
                class="collapse"
                :class="{ show: isColspanVisible }"
                data-parent="#accordion"
            >
                <div class="card-body">
                    <div class="row">
                        <div
                            :class="
                                role_id != 1
                                    ? 'col-xl-6 col-lg-6 col-md-12'
                                    : 'col-xl-4 col-lg-6 col-md-12'
                            "
                        >
                            <!-- v-if="role_id == 1" -->
                            <div class="form-group">
                                <label>ავტორი</label>
                                <div
                                    class="ls-inputicon-box"
                                    v-if="cla.unfinishedRegistrationAuthor"
                                >
                                    <multiselect
                                        v-model="filterItem.author"
                                        :options="
                                            cla.unfinishedRegistrationAuthor
                                        "
                                        :multiple="true"
                                        :close-on-select="false"
                                        :clear-on-select="false"
                                        :preserve-search="true"
                                        label="name_ka"
                                        track-by="name_ka"
                                        :preselect-first="false"
                                    >
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-xl-4 col-lg-6 col-md-12"
                            v-if="role_id == 1"
                        >
                            <!-- v-if="role_id == 1" -->
                            <div class="form-group">
                                <label>დაეწერა</label>
                                <div
                                    class="ls-inputicon-box"
                                    v-if="cla.administrator"
                                >
                                    <multiselect
                                        v-model="filterItem.assigned"
                                        :options="cla.administrator"
                                        :multiple="true"
                                        :close-on-select="false"
                                        :clear-on-select="false"
                                        :preserve-search="true"
                                        label="name_ka"
                                        track-by="name_ka"
                                        :preselect-first="false"
                                    >
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div
                            :class="
                                role_id != 1
                                    ? 'col-xl-6 col-lg-6 col-md-12'
                                    : 'col-xl-4 col-lg-6 col-md-12'
                            "
                        >
                            <div class="form-group">
                                <label>სტატუსი</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="filterItem.status"
                                        :options="[
                                            { id: 2, name: 'წარმოებაში' },
                                            { id: 4, name: 'დასრულდა' },
                                        ]"
                                        deselect-label="Can't remove this value"
                                        :multiple="true"
                                        :close-on-select="false"
                                        :clear-on-select="false"
                                        track-by="name"
                                        label="name"
                                        placeholder="Select one"
                                        :searchable="true"
                                        :preselect-first="false"
                                    >
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>კანდიდატი</label>
                                <div class="ls-inputicon-box">
                                    <input
                                        class="form-control"
                                        v-model="filterItem.candidate_name"
                                        type="text"
                                        placeholder="სახელი გვარი"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>ნომერი</label>
                                <div class="ls-inputicon-box">
                                    <input
                                        class="form-control"
                                        v-model="filterItem.candidate_number"
                                        type="text"
                                        placeholder="555999333"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>დამატების თარიღი (დან)</label>
                                <div class="ls-inputicon-box">
                                    <input
                                        class="form-control"
                                        v-model="filterItem.date_from"
                                        type="date"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>დამატების თარიღი (მდე)</label>
                                <div class="ls-inputicon-box">
                                    <input
                                        class="form-control"
                                        v-model="filterItem.date_to"
                                        :max="maxDate"
                                        type="date"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 mt-3">
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="exampleCheck1"
                                    value="1"
                                    v-model="filterItem.all"
                                />
                                <label
                                    class="form-check-label"
                                    for="exampleCheck1"
                                    >ყველას გამოჩენა</label
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <!-- <button
                                type="button"
                                class="btn btn-primary"
                                @click="endFilter()"
                            >
                                <i class="fa fa-times"></i> ფილტრის გამორთვა
                            </button> -->
                    <button
                        type="button"
                        class="btn btn-success float-right"
                        @click="filter()"
                    >
                        <i class="fa fa-search"></i> ძებნა
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
