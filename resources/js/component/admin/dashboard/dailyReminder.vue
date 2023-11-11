<template lang="">
    <div class="card direct-chat direct-chat-primary">
        <div class="card-header">
            <h3 class="card-title">დღის შეხსენებები</h3>

            <div class="card-tools">
                <span title="3 New Messages" class="badge badge-primary">{{ items.length }}</span>
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
                            <th>ვაკანსისი ID</th>
                            <th v-if="role_id == 1">HR</th>
                            <th>შეხსენების მიზეზი</th>
                            <th>დრო</th>
                            <th>ტიპი</th>
                            <th>სტატუსი</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in items" :key="index">
                            <td>{{ index + 1 }}.</td>
                            <td><u class="text-primary" @click="vacancyModal(item.vacancy_id)">{{ item.vacancy.code }}</u> </td>
                            <td v-if="role_id == 1">{{ item.hr.user.name_ka }}</td>
                            <td>{{ item.reason }}</td>
                            <td>{{ item.date }}</td>
                            <td><span :class="item.main == 0 ?'badge badge-warning':'badge badge-danger'">{{ item.main == 0 ? 'ჩანაწერი': 'ძირითადი' }}</span></td>
                            <td>
                                <span v-if="item.status == 0" class="badge badge-danger">გადაცილებული</span>
                                <span v-if="item.status == 1" class="badge badge-warning">მიმდინარე</span>
                                <span v-if="item.status == 2" class="badge badge-success">შესრულებული</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <vacancyFullInfoModal :visible="vacancyModelShow" :vacancyId="item"></vacancyFullInfoModal>
    </div>
</template>
<script>
import moment from 'moment'
import vacancyFullInfoModal from '../../modal/vacancyFullInfoModal.vue';
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
        items(){
            const currentDateTime = moment();
            let arr = []
            this.data.forEach(element => {
                let baseDateTime = element.date;
                // Convert base time to a moment object
                let baseTimeMoment = moment(baseDateTime, "YYYY-MM-DD HH:mm");
                if (currentDateTime.isAfter(baseTimeMoment) ) {
                    // Current time is greater than the base time
                    if (element.active == 0) {
                        element['status'] = 0
                    } else {
                        element['status'] = 2
                    }
                } else if (currentDateTime.isBefore(baseTimeMoment) ) {
                    // Current time is less than the base time
                    if (element.active == 0) {
                        element['status'] = 1
                    }else{
                        element['status'] = 2
                    }
                } else{
                }
                arr.push(element)
            });
            return arr
        }
    },
    created(){
    },
    methods:{
        vacancyModal(id){
            this.vacancyModelShow = !this.vacancyModelShow
            this.item = id
        }

    }

}
</script>
<style lang="">

</style>
