<template lang="">
    <div>
        <monthly_salary_table v-if="role_id == 2" :data="items" :role_id="role_id"> </monthly_salary_table>
        <div v-else>
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <!-- <h3>{{ agree_no_count }}</h3> -->
                            <h3>{{ data.info.enrollment_total }}</h3>

                            <p> სულ დარიცხვები</p>
                        </div>
                        <div class="icon">
                        <i class="fa fa-times"></i>
                        </div>
                        <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ total_salary }}</h3>
                            <p>ხელფასი სულ</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-coins"></i>
                        </div>
                        <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-indigo">
                        <div class="inner">
                            <h3>{{ total_hr_bonus }}</h3>

                            <p>ჰრ_ის ბონუსი სულ</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                        </div>
                        <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <!-- <h3>{{ agree_count }}</h3> -->
                            <h3>{{ total_supplement }}</h3>
                            <p>დანამატი</p>
                        </div>
                        <div class="icon">
                        <i class="fa fa-check"></i>
                        </div>
                        <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                    </div>
                </div>
                <!-- ./col -->

            </div>

            <hr>

            <monthly_salary_table :data="items" :role_id="role_id"> </monthly_salary_table>
        </div>
    </div>
</template>
<script>
import monthly_salary_table from '../component/monthly_salary_table.vue'
export default {
    components:{
        monthly_salary_table
    },
    props:{
        data: Object,
        role_id:Number
    },
    data() {
        return {
            items: {}
        }
    },
    computed:{
        total_salary(){
            return  _.sumBy(this.data.data, item => (item.full_salary)).toFixed(2);
        },
        total_hr_bonus(){
            return  (_.sumBy(this.data.data, item => (item.hr_bonus_from_vacancy)) + _.sumBy(this.data.data, item => (item.hr_bonus_from_registration))).toFixed(2);
        },
        total_supplement() {
            return  _.sumBy(this.data.data, item => (item.supplement)).toFixed(2);
        }
    },
    created() {

        this.items = this.data.data
    },
    methods: {

    },
}
</script>
<style lang="">

</style>
