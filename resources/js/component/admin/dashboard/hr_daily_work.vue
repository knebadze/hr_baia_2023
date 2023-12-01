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
                            <th>დასაქმება</th>
                            <th>გამოსაცდელი ვადა</th>
                            <th>ვაკანსიის ჩარიცხვა</th>
                            <th>კანდიდატის ჩარიცხვა</th>
                            <th>კანდიდატის რეგისტრაცია</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in data.dailyWork" :key="index">
                            <td>{{ index + 1 }}.</td>
                            <td v-if="role_id == 1">{{ item.name_ka }}</td>
                            <td>{{ item.has_vacancy }}</td>
                            <td>{{ item.employed }}</td>
                            <td>{{ item.has_probationary_period }}</td>
                            <td>{{ item.has_enrollment_vacancy }}</td>
                            <td>{{ item.has_enrollment_register }}</td>
                            <td>{{ item.candidate_has_registered }}</td>
                        </tr>
                        <tr v-if="role_id == 1">
                            <td colspan="2"><strong>სულ:</strong></td>
                            <td>{{ totalVacancy }}</td>
                            <td>{{ totalEmployed }}</td>
                            <td>{{ totalProbation }}</td>
                            <td>{{ totalEnrollmentVacancy }}</td>
                            <td>{{ totalEnrollmentCandidate }}</td>
                            <td>{{ totalEnrollmentCandidate }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <p class="text-success"><strong>ვაკანსია მიიღო: {{ data.lastRecord }}</strong></p>
            <p class="text-warning"><strong>რიგშია: {{ data.nextRecord }}</strong> </p>
            <p class="text-danger"><strong>არააქტიური: {{ data.noActive.length > 0?data.noActive.map(i => i.hr.user.name_ka).join(', '):'არცერთი' }}</strong> </p>
        </div>
        <vacancyFullInfoModal :visible="vacancyModelShow" :vacancyId="item"></vacancyFullInfoModal>
    </div>
</template>
<script>
import moment from 'moment'
import vacancyFullInfoModal from '../vacancy/modal/vacancyFullInfoModal.vue';
export default {
    components:{
        vacancyFullInfoModal
    },
    props:{
        data: Object,
        role_id: Number
    },
    data() {
        return {
            vacancyModelShow: false,
            item:null
        }
    },
    computed:{
        totalVacancy(){
            return _.sumBy(this.data.dailyWork, item => (item.has_vacancy));
        },
        totalEmployed(){
            return _.sumBy(this.data.dailyWork, item => (item.employed));
        },
        totalProbation(){
            return _.sumBy(this.data.dailyWork, item => (item.has_probationary_period));
        },
        totalEnrollmentVacancy(){
            return _.sumBy(this.data.dailyWork, item => (item.has_enrollment_vacancy));
        },
        totalEnrollmentCandidate(){
            return _.sumBy(this.data.dailyWork, item => (item.has_enrollment_register));
        },
        totalRegistered(){
            return _.sumBy(this.data.dailyWork, item => (item.candidate_has_registered));
        }
    },
    created(){
    },
    methods:{
        vacancyModal(id){
            this.vacancyModelShow = !this.vacancyModelShow
            this.item = id
        },


    }

}
</script>
<style lang="">

</style>
