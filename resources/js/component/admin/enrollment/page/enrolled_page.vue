<template lang="">
    <section class="content ">
        <div class="container-fluid">
            <div id="accordion" >
                <div class="card card-primary" >
                    <div class="card-header">
                    <h4 class="card-title w-100 d-flex justify-content-between">
                        <a class="d-block w-100" data-toggle="collapse"  href="#collapseOne">
                        ფილტრი
                        </a>
                        <i class="fas fa-angle-down float-right"></i>
                    </h4>
                    </div>
                    <div id="collapseOne" class="collapse" :class="colspan" data-parent="#accordion" >
                        <div class="card-body">
                        <!-- <h5 class="ml-2"><i class="fa fa-user" ></i> დამკვეთი:</h5> -->
                        <hr>
                            <div class="row">

                                <div class="col-xl-4 col-lg-6 col-md-12" >
                                    <div class="form-group">
                                        <label>ტიპი</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.enrollment_type" :options="cla.enrollment_type" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                                <template slot="singleLabel" slot-scope="{ option }"></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12" v-if="role_id == 1 && m.enrollment_type">
                                    <div class="form-group">
                                        <label>ჰრ</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.hr"  :options="data.hr" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12" v-if="m.enrollment_type && m.enrollment_type.id == 2">
                                    <div class="form-group">
                                        <label>ვაკანსის კოდი</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.code"  type="text" placeholder="ვაკანსის კოდი">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12" v-if="m.enrollment_type && m.enrollment_type.id == 1">
                                    <div class="form-group">
                                        <label>კანდიდატის ID</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.candidate_id"  type="text" placeholder="კანდიდატის ID">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12" v-if="m.enrollment_type && m.enrollment_type.id == 2">
                                    <div class="form-group">
                                        <label>ვისი</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.who_is_counting" :options="cla.who" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                                <template slot="singleLabel" slot-scope="{ option }"></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>ვინ ჩარიცხა</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.name"  type="text" placeholder="სახელი გვარი">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12" >
                                    <div class="form-group">
                                        <label>ჩარიცხვის ტიპი</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.type" :options="cla.type" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                                <template slot="singleLabel" slot-scope="{ option }"></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12" >
                                    <div class="form-group">
                                        <label>სტატუსი</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.status" :options="cla.status" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                                <template slot="singleLabel" slot-scope="{ option }"></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>ჩარიცხვის თარიღი (დან)</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.date_from"  type="date" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>ჩარიცხვის თარიღი (მდე)</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.date_to" :max="maxDate"  type="date" >
                                        </div>
                                    </div>
                                </div>


                            </div>


                        </div>
                        <div class="card-footer ">
                            <button type="button" class="btn btn-primary" @click="endFilter()"><i class="fa fa-times"></i> ფილტრის გამორთვა</button>
                            <button type="button" class="btn btn-success float-right" @click="filterMeth( 'filter', m )"><i class="fa fa-search"></i> ძებნა</button>
                        </div>
                    </div>
                </div>




            </div>
        </div>
        <!-- <div>
            <h5><i class="fa fa-info"></i> ინფორმაცია</h5>
            <hr>
        </div> -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ total_money }}</h3>
                        <p>ჩაირიცხა</p>
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

                        <p>ჰრ_ის ბონუსი</p>
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
                        <h3>{{ agree_count }}</h3>

                        <p>დადასტურებული</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-check"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ agree_no_count }}</h3>

                        <p>მიმდიანარე</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-times"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <!-- ./col -->
        </div>
        <enrolled_table :items="items" :role_id="role_id" :start_date="data.start_date"></enrolled_table>


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
import _ from 'lodash';
import moment from 'moment'
import Paginate from 'vuejs-paginate-next';
import enrolled_table from '../component/enrolled_table.vue'
export default {
    components:{
        Paginate,
        enrolled_table
    },
    props:{
        data:Object,
        role_id: Number
    },
    data() {
        return {
            colspan: 'hide',
            pagination:{
                current_page: 1,
                last_page: 2,
            },
            getDataType:'first_data',
            items:{},
            // role_id: null,
            m:{},
            cla:{
                'enrollment_type':[
                    {'id': 1, 'name':'რეგისტრაცია'},
                    {'id': 2, 'name':'ვაკანსია'},
                ],
                'who':[
                    {'id': 1, 'name':'კანდიდატი'},
                    {'id': 2, 'name':'დამსაქმებელი'},
                ],
                'type':[
                    {'id': 0, 'name':'არასრული'},
                    {'id': 1, 'name':'სრული'},
                ],
                'status':[
                    {'id': 0, 'name':'მიმდინარე'},
                    {'id': 1, 'name':'დადასტურებული'},
                ],
            }
        }
    },
    computed:{
        maxDate() {
            const today = moment().format('YYYY-MM-DD');
            return today;
        },
        total_money(){
            return  _.sumBy(this.items, item => (item.agree == 1 ? item.money : 0)).toFixed(2);
        },
        total_hr_bonus(){
            return  _.sumBy(this.items, item => (item.agree == 1 ? item.hr_bonus : 0)).toFixed(2);
        },
        agree_count(){
            return _.countBy(this.items, 'agree')[1] || 0;
        },
        agree_no_count(){
            return _.countBy(this.items, 'agree')[0] || 0;
        },

    },
    created() {
        console.log(this.data);
        this.getData()
        // this.role_id = this.data.role_id
        let arr = [
            {'id': 1, 'money': 500, 'agree': 0},
            {'id': 2, 'money': 100, 'agree': 1},
            {'id': 3, 'money': 400, 'agree': 0},
            {'id': 4, 'money': 200, 'agree': 1},
        ]
    },
    methods: {
        async getData() {
            if (this.getDataType == 'first_data') {
                await this.firstData();
            } else if ( this.getDataType == 'filter') {
                await this.filter(this.m);
            }
        },

        async firstData() {
            if(this.data.items){
                this.items = this.data.items.data;
                this.pagination = {
                    'current_page': this.data.items.current_page,
                    'last_page': this.data.items.last_page
                };
            }


        },
        filterMeth(type,m){
            this.getDataType = type
            if (this.getDataType == 'filter') {
                this.filter(m)
            }
        },
        async filter(m){
            if (m.date_from || m.date_to) {
                if (!m.date_from || !m.date_to) {
                    toast.error('ორივე თარიღის შევსება სავალდებულოა', {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    return
                }
                (m.date_from || m.date_to)?m['date'] = [m.date_from, m.date_to]:'';
            }

            // (m.hr)?m.hr = this.hrId:'';


            let currentObj = this

            axios({
                method: "post",
                url: '/enrollment_filter?page=' + this.pagination.current_page,
                data: m,
            })
            .then(function (response) {
                // console.log('response.data', response.data);
                currentObj.pagination = {
                    'current_page':response.data.current_page,
                    'last_page': response.data.last_page
                }
                currentObj.items = response.data.data
                // console.log('this.items', currentObj.items);



            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        }
    },
    watch:{

    },
}
</script>
<style lang="">

</style>
