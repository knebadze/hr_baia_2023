
<script setup>
import { defineProps, ref, computed } from 'vue'
const props = defineProps({
    data: Object,
    role_id: Number
})
const items = computed(() => props.role_id === 1 ? props.data.hr : props.data);

const vacancyModelShow = ref(false)
const item = ref(null)

const totalVacancy = computed(() => _.sumBy(items.value.dailyWork, item => (item.has_vacancy)));
const totalApprove = computed(() => _.sumBy(items.value.dailyWork, item => (item.approved_by_employer)));
const totalProbation = computed(() => _.sumBy(items.value.dailyWork, item => (item.has_probationary_period)));
const totalEmployed = computed(() => _.sumBy(items.value.dailyWork, item => (item.employed)));
const totalEnrollmentVacancy = computed(() => _.sumBy(items.value.dailyWork, item => (item.has_enrollment_vacancy)));
const totalEnrollmentCandidate = computed(() => _.sumBy(items.value.dailyWork, item => (item.has_enrollment_register)));
const totalRegistered = computed(() => _.sumBy(items.dailyWork, item => (item.candidate_has_registered)));


</script>
<template lang="">
    <div class="card direct-chat direct-chat-primary">
        <div class="card-header">
            <h3 class="card-title">{{ role_id == 1?'ჰრ_ის':'' }} დღის შესრულებული სამუშაოს ცხრილი</h3>

            <div class="card-tools">
                <!-- <span title="3 New Messages" class="badge badge-primary">{{ items.length }}</span> -->
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
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
                            <th v-if="role_id == 1">HR</th>
                            <th>ვაკანსია</th>
                            <th>დამსაქმებლის მოწონებული</th>
                            <th>გამოსაცდელი ვადა</th>
                            <th>დასაქმება</th>
                            <th>ვაკანსიის ჩარიცხვა</th>
                            <th>კანდიდატის ჩარიცხვა</th>
                            <th>კანდიდატის რეგისტრაცია</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in items.dailyWork" :key="index">
                            <td>{{ index + 1 }}.</td>
                            <td v-if="role_id == 1">{{ item.name_ka }}</td>
                            <td>{{ item.has_vacancy }}</td>
                            <td>{{ item.approved_by_employer }}</td>
                            <td>{{ item.has_probationary_period }}</td>
                            <td>{{ item.employed }}</td>
                            <td>{{ item.has_enrollment_vacancy }}</td>
                            <td>{{ item.has_enrollment_register }}</td>
                            <td>{{ item.candidate_has_registered }}</td>
                        </tr>
                        <tr v-if="role_id == 1">
                            <td colspan="2"><strong>სულ:</strong></td>
                            <td>{{ totalVacancy }}</td>
                            <td>{{ totalApprove }}</td>
                            <td>{{ totalProbation }}</td>
                            <td>{{ totalEmployed }}</td>
                            <td>{{ totalEnrollmentVacancy }}</td>
                            <td>{{ totalEnrollmentCandidate }}</td>
                            <td>{{ totalEnrollmentCandidate }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between" v-if="role_id == 1">
            <p class="text-success"><strong>ვაკანსია მიიღო: {{ items.lastRecord }}</strong></p>
            <p class="text-warning"><strong>რიგშია: {{ items.nextRecord }}</strong> </p>
            <p class="text-danger"><strong>არააქტიური: {{ items.noActive.length > 0?items.noActive.map(i => i.hr.user.name_ka).join(', '):'არცერთი' }}</strong> </p>
        </div>
    </div>
</template>
<style lang="">

</style>
