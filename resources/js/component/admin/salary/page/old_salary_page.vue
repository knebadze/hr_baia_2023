<template lang="">
    <div>
        <div class="container-fluid">
            <div id="accordion">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4
                            class="card-title w-100 d-flex justify-content-between"
                        >
                            <a
                                class="d-block w-100"
                                data-toggle="collapse"
                                href="#collapseOne"
                            >
                                ფილტრი
                            </a>
                            <i class="fas fa-angle-down float-right"></i>
                        </h4>
                    </div>
                    <div
                        id="collapseOne"
                        class="collapse hide"
                        data-parent="#accordion"
                    >
                        <div class="card-body">
                            <!-- <h5 class="ml-2"><i class="fa fa-user" ></i> დამკვეთი:</h5> -->
                            <hr />
                            <div class="row">
                                <!-- <month-picker @change="showDate"></month-picker> -->
                            </div>
                            <div class="row">
                                <div
                                    class="col-xl-4 col-lg-6 col-md-12"
                                    v-if="role_id == 1"
                                >
                                    <div class="form-group">
                                        <label>ჰრ</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect
                                                v-model="m.hr"
                                                :options="hr"
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
                                                        >{{
                                                            values.length
                                                        }}
                                                        options selected</span
                                                    ></template
                                                >
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    :class="
                                        role_id == 1
                                            ? 'col-xl-4 col-lg-6 col-md-12'
                                            : 'col-xl-6 col-lg-6 col-md-12'
                                    "
                                >
                                    <div class="form-group">
                                        <label> თვე (დან)</label>
                                        <div class="ls-inputicon-box">
                                            <month-picker-input
                                                @change="fromDate"
                                                :no-default="true"
                                                class="pick"
                                            ></month-picker-input>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    :class="
                                        role_id == 1
                                            ? 'col-xl-4 col-lg-6 col-md-12'
                                            : 'col-xl-6 col-lg-6 col-md-12'
                                    "
                                >
                                    <div class="form-group">
                                        <label>თვე (მდე)</label>
                                        <div class="ls-inputicon-box">
                                            <month-picker-input
                                                @change="toDate"
                                                :no-default="true"
                                                class="pick"
                                                :max-date="maxDate"
                                            ></month-picker-input>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button
                                type="button"
                                class="btn btn-primary"
                                @click="endFilter()"
                            >
                                <i class="fa fa-times"></i> ფილტრის გამორთვა
                            </button>
                            <button
                                type="button"
                                class="btn btn-success float-right"
                                @click="filter(m)"
                            >
                                <i class="fa fa-search"></i> ძებნა
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr />
        <div class="row" v-if="role_id == 1">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <!-- <h3>{{ agree_no_count }}</h3> -->
                        <h3>{{ data.info.enrollment_total??0 }}</h3>

                        <p>სულ დარიცხვები</p>
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

                        <p>ბონუსი სულ</p>
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

        <hr />
        <old_salary_table :data="items" :role_id="role_id" :key="tableKey">
        </old_salary_table>
    </div>
</template>
<script>
import old_salary_table from "../component/old_salary_table.vue";
import { MonthPickerInput } from "vue-month-picker";
import moment from "moment";
export default {
    components: {
        old_salary_table,
        MonthPickerInput,
        // MonthPicker
    },
    props: {
        data: Object,
        role_id: Number,
        hr: Object,
    },
    data() {
        return {
            items: {},
            staticItems: {},
            m: {},
            date: [],
            tableKey: 0,
        };
    },
    computed: {
        total_salary() {
            return _.sumBy(this.items, (item) => item.full_salary).toFixed(2);
        },
        total_hr_bonus() {
            let sum =
                _.sumBy(this.items, (item) => item.hr_bonus_from_vacancy) +
                _.sumBy(this.items, (item) => item.hr_bonus_from_registration);
            return sum.toFixed(2);
        },
        total_supplement() {
            return _.sumBy(this.items, (item) => item.supplement).toFixed(2);
        },
        // currentMonth(){
        //     return Number(moment().format('M') - 1);
        // },
        maxDate() {
            // Create a Moment.js object representing the current date
            const currentDate = moment();

            // Subtract one month to go back to the last month
            const lastMonth = currentDate.subtract(1, "month");

            // Get the last day of the last month
            const lastDayOfLastMonth = lastMonth.endOf("month");
            return lastDayOfLastMonth.toDate();
        },
    },
    created() {
        this.items = this.data.data;
        this.staticItems = this.data.data;
    },
    methods: {
        fromDate(date) {
            const parsedDate = moment(
                date.from.toDateString(),
                "ddd MMM DD YYYY"
            );
            this.date[0] = parsedDate.format("DD-MM-YYYY");
        },
        toDate(date) {
            const parsedDate = moment(
                date.to.toDateString(),
                "ddd MMM DD YYYY"
            );
            this.date[1] = parsedDate.format("DD-MM-YYYY");
        },
        filter(m) {
            if (this.date.length != 2) {
                toast.error("ორივე თარიღის შევსება სავალდებულოა", {
                    theme: "colored",
                    autoClose: 1000,
                });
                return;
            }
            m.date = this.date;

            // (m.hr)?m.hr = this.hrId:'';

            let currentObj = this;

            axios({
                method: "post",
                url: "/salary_filter",
                data: m,
            })
                .then(function (response) {
                    currentObj.items = response.data;
                    currentObj.tableKey++;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
        },
        endFilter() {
            this.m = {};
            this.items = this.staticItems;
        },
    },
    mounted() {},
};
</script>
<style scope>
.pick {
    z-index: 10;
}
</style>
