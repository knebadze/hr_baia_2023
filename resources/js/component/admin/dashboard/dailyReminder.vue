<template lang="">
    <div class="card direct-chat direct-chat-primary">
        <div class="card-header">
            <h3 class="card-title">დღის შეხსენებები</h3>

            <div class="card-tools">
                <span title="3 New Messages" class="badge badge-primary">{{
                    items.length
                }}</span>
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
            <reminder_table :items="items" :role_id="role_id"></reminder_table>
            <!-- <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>ვაკანსიის ID</th>
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
                            <td v-if="role_id == 1">{{ item.hr.name_ka }}</td>
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
            </div> -->
        </div>
    </div>
</template>
<script>
import reminder_table from "../reminder/component/reminder_table.vue";
export default {
    components: {
        reminder_table,
    },
    props: {
        data: Object,
        role_id: Number,
    },
    data() {
        return {
            item: [],
        };
    },
    computed: {},
    created() {
        this.items = this.data;
    },
    methods: {},
};
</script>
<style lang=""></style>
