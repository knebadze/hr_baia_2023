<script setup>
import { defineProps, computed } from "vue";
import _ from "lodash";
const props = defineProps({
    data: Object,
    role_id: Number,
});
const items = computed(() =>
    props.role_id === 1 ? props.data.administrator : props.data
);
const totalAddVacancy = computed(() => {
    return _.sumBy(items.value.dailyWork, (item) => item.add_vacancy);
});
const totalEnrollmentCandidate = computed(() => {
    return _.sumBy(
        items.value.dailyWork,
        (item) => item.has_enrollment_register
    );
});
const totalRegistered = computed(() => {
    return _.sumBy(
        items.value.dailyWork,
        (item) => item.candidate_has_registered
    );
});
</script>
<template>
    <div class="card direct-chat direct-chat-primary">
        <div class="card-header">
            <h3 class="card-title">
                {{ role_id == 1 ? "ადმინისტრატორის" : "" }} დღის შესრულებული
                სამუშაოს ცხრილი
            </h3>

            <div class="card-tools">
                <!-- <span title="3 New Messages" class="badge badge-primary">{{ items.length }}</span> -->
                <button
                    type="button"
                    class="btn btn-tool"
                    data-card-widget="collapse"
                >
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <!-- <th>ჰრ</th> -->
                            <th v-if="role_id == 1">ადმინისტრატორი</th>
                            <th>კანდიდატის რეგისტრაცია</th>
                            <th>კანდიდატის ჩარიცხვა</th>
                            <th>ვაკანსიის დამატება</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(item, index) in items.dailyWork"
                            :key="index"
                        >
                            <td>{{ index + 1 }}.</td>
                            <td v-if="role_id == 1">{{ item.name_ka }}</td>
                            <td>{{ item.candidate_has_registered }}</td>
                            <td>{{ item.has_enrollment_register }}</td>
                            <td>{{ item.add_vacancy }}</td>
                        </tr>
                        <tr v-if="role_id == 1">
                            <td colspan="2"><strong>სულ:</strong></td>
                            <td>{{ totalRegistered }}</td>
                            <td>{{ totalEnrollmentCandidate }}</td>
                            <td>{{ totalAddVacancy }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div
            class="card-footer d-flex justify-content-between"
            v-if="role_id == 1"
        >
            <!-- <p class="text-success"><strong>ვაკანსია მიიღო: {{ data.lastRecord }}</strong></p>
            <p class="text-warning"><strong>რიგშია: {{ data.nextRecord }}</strong> </p> -->
            <p class="text-danger">
                <strong
                    >არააქტიური:
                    {{
                        items.noActive.length > 0
                            ? items.noActive
                                  .map((i) => i.hr.user.name_ka)
                                  .join(", ")
                            : "არცერთი"
                    }}</strong
                >
            </p>
        </div>
    </div>
</template>
