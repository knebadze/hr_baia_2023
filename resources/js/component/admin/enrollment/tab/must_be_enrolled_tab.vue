<template lang="">
    <section class="content">
        <!-- <div class="container-fluid"> -->
        <div id="accordion">
            <!-- <div class="card card-primary">
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
                        class="collapse"
                        :class="colspan"
                        data-parent="#accordion"
                    >
                        <div class="card-body">
                            <hr />
                            <div class="row">
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>ტიპი</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect
                                                v-model="m.enrollment_type"
                                                :options="cla.enrollment_type"
                                                deselect-label="Can't remove this value"
                                                track-by="name"
                                                label="name"
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
                                <div
                                    class="col-xl-4 col-lg-6 col-md-12"
                                    v-if="role_id == 1 && m.enrollment_type"
                                >
                                    <div class="form-group">
                                        <label>staff</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect
                                                v-model="m.hr"
                                                :options="cla.hr"
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
                                    class="col-xl-4 col-lg-6 col-md-12"
                                    v-if="
                                        m.enrollment_type &&
                                        m.enrollment_type.id == 2
                                    "
                                >
                                    <div class="form-group">
                                        <label>ვაკანსის კოდი</label>
                                        <div class="ls-inputicon-box">
                                            <input
                                                class="form-control"
                                                v-model="m.code"
                                                type="text"
                                                placeholder="ვაკანსის კოდი"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="col-xl-4 col-lg-6 col-md-12"
                                    v-if="
                                        m.enrollment_type &&
                                        m.enrollment_type.id == 1
                                    "
                                >
                                    <div class="form-group">
                                        <label>კანდიდატის ID</label>
                                        <div class="ls-inputicon-box">
                                            <input
                                                class="form-control"
                                                v-model="m.candidate_id"
                                                type="text"
                                                placeholder="კანდიდატის ID"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="col-xl-4 col-lg-6 col-md-12"
                                    v-if="
                                        m.enrollment_type &&
                                        m.enrollment_type.id == 2
                                    "
                                >
                                    <div class="form-group">
                                        <label>ვისი</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect
                                                v-model="m.who_is_counting"
                                                :options="cla.who"
                                                deselect-label="Can't remove this value"
                                                track-by="name"
                                                label="name"
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
                                        <label>ჩარიცხვის თარიღი (დან)</label>
                                        <div class="ls-inputicon-box">
                                            <input
                                                class="form-control"
                                                v-model="m.date_from"
                                                type="date"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>ჩარიცხვის თარიღი (მდე)</label>
                                        <div class="ls-inputicon-box">
                                            <input
                                                class="form-control"
                                                v-model="m.date_to"
                                                :min="minDate"
                                                type="date"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button
                                type="button"
                                class="btn btn-success float-right"
                                @click="filterMeth('filter', m)"
                            >
                                <i class="fa fa-search"></i> ძებნა
                            </button>
                        </div>
                    </div>
                </div>-->
        </div>
        <div class="row">
            <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ money }}</h3>
                        <p>ჩაირიცხება</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-coins"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-indigo">
                    <div class="inner">
                        <h3>{{ bonus.toFixed(2) }}</h3>

                        <p>ბონუსი იქნება</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6"></div>
        </div>
        <must_be_enrolled_table
            :items="items"
            :role_id="role_id"
            :key="tableKey"
        ></must_be_enrolled_table>

        <div class="mt-2">
            <paginate
                v-model="pagination.current_page"
                :page-count="pagination.last_page"
                :page-range="3"
                :margin-pages="2"
                :click-handler="getData"
                :prev-text="'უკან'"
                :next-text="'წინ'"
                :container-class="'pagination'"
                :page-class="'page-item'"
            >
            </paginate>
        </div>
    </section>
</template>
<script>
import Paginate from "vuejs-paginate-next";
import must_be_enrolled_table from "../component/must_be_enrolled_table.vue";
import _ from "lodash";
import moment from "moment";
export default {
    components: {
        Paginate,
        must_be_enrolled_table,
    },
    props: {
        data: Object,
        auth: Object,
    },
    data() {
        return {
            colspan: "hide",
            pagination: {
                current_page: 1,
                last_page: 2,
            },
            getDataType: "first_data",
            items: {},
            // role_id: null,
            // money: 0,
            // bonus: 0,
            viewAndPermission: null,
            m: {},
            cla: {
                enrollment_type: [
                    { id: 1, name: "რეგისტრაცია" },
                    { id: 2, name: "ვაკანსია" },
                ],
                who: [
                    { id: 1, name: "კანდიდატი" },
                    { id: 2, name: "დამსაქმებელი" },
                ],
            },
            tableKey: 0,
        };
    },
    computed: {
        minDate() {
            const today = moment().format("YYYY-MM-DD");
            return today;
        },
        money() {
            return _.reduce(this.items, (sum, item) => sum + item.money, 0);
        },

        bonus() {
            return _.reduce(
                this.items,
                (sum, item) => {
                    return item.type == 2
                        ? sum + (item.money * item.bonus_percent) / 100
                        : sum + 10;
                },
                0
            );
        },
    },
    created() {
        this.getData();
        this.role_id = this.auth.role_id;
        console.log(this.data);
        // this.role_id = this.data.role_id
    },
    methods: {
        async getData() {
            if (this.getDataType == "first_data") {
                await this.firstData();
            } else if (this.getDataType == "filter") {
                await this.filter(this.m);
            }
        },
        filterHr(adminViewAndPermission) {
            if (adminViewAndPermission.filter == "child") {
                return this.data.hr.filter(
                    (item) => item.parent_id == adminViewAndPermission.admin_id
                );
            }
            return this.data.hr;
        },

        async firstData() {
            // this.pagination = {
            //     'current_page': this.data.items.current_page,
            //     'last_page': this.data.items.last_page
            // };
            try {
                const response = await axios.post(
                    `/must_be_enrolled_fetch?page=${this.pagination.current_page}`
                );
                if (response.status == 200) {
                    const { data } = response;
                    const { mustBeEnrollment, adminViewAndPermission } = data;
                    this.pagination = {
                        current_page: mustBeEnrollment.current_page,
                        last_page: mustBeEnrollment.last_page,
                    };
                    this.items = _.sortBy(mustBeEnrollment.data, [
                        function (o) {
                            return o.date;
                        },
                    ]);
                    this.viewAndPermission = adminViewAndPermission;
                    this.cla.hr = this.filterHr(adminViewAndPermission);
                    this.tableKey++;
                    for (let i = 0; i < this.items.length; i++) {
                        // Access the element to update in each object
                        const createdAtMoment = moment(this.items[i].date);
                        this.items[i].created_at = moment(
                            this.items[i].created_at
                        ).format("YYYY-MM-DD HH:mm");
                        if (createdAtMoment.isBefore(moment(), "day")) {
                            this.items[i]["status"] = "გადაცილება";
                        } else {
                            this.items[i]["status"] = "მიმდინარე";
                        }
                    }
                }
            } catch (error) {
                console.log(error);
            }

            // this.data.items.data.forEach(element => {
            //     let candidate = {
            //         'type': 1,
            //         'id':element.id,
            //         'code':element.code,
            //         'vacancy_id':element.vacancy_id,
            //         'initial_amount':element.candidate_initial_amount,
            //         'must_be_enrolled':element.must_be_enrolled_candidate,
            //         'must_be_enrolled_date':element.must_be_enrolled_candidate_date,
            //         'date':element.date
            //     }
            //     let employer = {
            //         'type': 2,
            //         'id':element.id,
            //         'code':element.code,
            //         'vacancy_id':element.vacancy_id,
            //         'initial_amount':element.employer_initial_amount,
            //         'must_be_enrolled':element.must_be_enrolled_employer,
            //         'must_be_enrolled_date':element.must_be_enrolled_employer_date,
            //         'date':element.date
            //     }
            //     this.items = [candidate, employer]
            // });
            // this.items = _.sortBy(this.data.items, [function(o) { return o.date; }]);
        },
        filterMeth(type, m) {
            this.getDataType = type;
            if (this.getDataType == "filter") {
                this.filter(m);
            }
        },
        async filter(m) {},
    },
    watch: {},
};
</script>
<style lang=""></style>
