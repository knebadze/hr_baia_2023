<template lang="">
    <div>
        <div class="card card-outline card-primary">
            <div class="card-header">
            <h3 class="card-title">რის მიხედვით შესაბამისი?</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
            </div>
            <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class='row'>
                    <div class="col-xl-3 col-lg-6 col-md-12">
                        <div class=" form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" v-model="payment" @input="paymentEvent(payment)">
                            <label class="form-check-label" for="exampleCheck1">ანაზღაურება</label>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-12">
                        <div class=" form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck2" value="1" v-model="work_schedule" @input="workScheduleEvent(work_schedule)">
                            <label class="form-check-label" for="exampleCheck2">გრაფიკი</label>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-12">
                        <div class=" form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck3" value="1" v-model="category" @input="categoryEvent(category)">
                            <label class="form-check-label" for="exampleCheck3">კატეგორია</label>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-12">
                        <div class=" form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck4" value="1" v-model="address" @input="addressEvent(address)">
                            <label class="form-check-label" for="exampleCheck4">ქალაქი, უბანი</label>
                        </div>
                    </div>
                    <div class=" col-md-12" v-if="data.role_id == 1">
                        <hr>
                        <div class="form-group">
                            <label>HR</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="hrs"  :options="data.hr" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false">
                                    <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                </multiselect>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <div>
            <table class="table twm-table table-striped table-border">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>შემკვეთი</th>
                    <th>კატეგორია</th>
                    <th>სტატუსი</th>
                    <!-- <th>ტიპი</th> -->
                    <th>დამატების თარიღი</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-if="items.length > 0" v-for="(item, index) in items" :key="index">
                    <td><u class="text-primary" @click="openModal(item.id)">{{ item.code }}</u></td>
                    <td>{{ item.employer.name_ka }}</td>
                    <td>{{ item.category.name_ka }}</td>
                    <td>{{ item.status.name_ka }}</td>
                    <!-- <td>{{ item.qualifying_type.name }}</td> -->
                    <td>{{ item.created_at }}</td>
                    <!-- <td>
                        <button class="btn btn-info" @click="showModal(item)" title="დამატება" >
                            <i class="fa fa-plus"></i>
                        </button>
                    </td> -->
                    </tr>
                    <tr v-else>
                        <td colspan='5' class="text-center"> ვაკანსია არ მოიძებნა!!!</td>
                    </tr>
                </tbody>
            </table>
        </div>
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
    </div>
</template>
<script>
import moment from 'moment'
import _ from 'lodash';
import axios from 'axios'
import Paginate from 'vuejs-paginate-next';
import vacancyFullInfoModal from '../../../modal/vacancyFullInfoModal.vue';
export default {
    components:{
        Paginate,
        vacancyFullInfoModal
    },
    props:{
        data:Object,
    },
    data() {
        return {
            pagination:{
                current_page: 1,
                last_page: 2,
            },
            items:{},
            m:{},
            payment: true,
            work_schedule: true,
            category: true,
            address: true,
            hrs:[],
            // getDataType:'first_data',
            modalShow: false,
            vacancy_id: null
        }
    },
    computed:{

    },
    created() {
        // this.m.id = this.data
        console.log('data', this.data);
        // this.getData()
        this.m.payment = this.data.candidate.get_work_information.map(item => item.payment);
        this.m.work_schedule = this.data.candidate.get_work_information.flatMap(item => item.get_work_schedule.map(schedule => schedule.work_schedule_id));
        this.m.category = this.data.candidate.get_work_information.map(item => item.category_id);
        this.m.address = this.data.candidate.address_ka

        console.log(this.m);

    },
    methods: {
        // getData(){
        //     if (this.getDataType == 'first_data') {
        //         this.firstData()
        //     } else if (this.getDataType == 'filter') {
        //         this.filter(this.m)
        //     }

        // },
        getData(){
            let currentObj = this
            let data = this.m;
            axios({
                    method: "post",
                    url: '/admin_relevant_vacancy_data?page=' + this.pagination.current_page,
                    data: data,

                })
            .then((response)=> {
                // console.log('response.data',response.data.data);
                this.pagination = {
                    'current_page':response.data.current_page,
                    'last_page': response.data.last_page
                }
                this.items = response.data.data
                for (let i = 0; i < this.items.length; i++) {
                    // Access the element to update in each object
                    this.items[i].created_at = moment(this.items[i].created_at).format("YYYY-MM-DD HH:mm");
                }
                // console.log('this.items', this.items);
            })
            .catch(function (error) {
                console.log(error);
            });


        },
        paymentEvent(newVal){
            if (newVal) {
                delete this.m['payment']
            }else{
                this.m.payment = this.data.candidate.get_work_information.map(item => item.payment);
            }

        },
        workScheduleEvent(newVal){
            if (newVal) {
                delete this.m['work_schedule']
            }else{
                this.m.work_schedule = this.data.candidate.get_work_information.flatMap(item => item.get_work_schedule.map(schedule => schedule.work_schedule_id));
            }
        },
        categoryEvent(newVal){
            if (newVal) {
                delete this.m['category']
            }else{
                this.m.category = this.data.candidate.get_work_information.map(item => item.category_id);
            }
        },
        addressEvent(newVal){
            if (newVal) {
                delete this.m['address']
            }else{
                this.m.address = this.data.candidate.address_ka
            }
        },
        openModal(id){
            this.modalShow = !this.modalShow
            this.vacancy_id = id
        }

    },
    watch:{
        m: {
            deep: true,
            handler(newValue, oldValue) {
                this.getData()
            },

        },
        hrs: {
            deep: true,
            handler(newValue, oldValue) {
                console.log(newValue.length);
                if (newValue.length == 0) {
                    delete this.m['hrs']
                }else{
                    console.log(newValue.map(item => item.hr.id));
                    this.m.hrs = newValue.map(item => item.hr.id);
                }
            },

        },
    }
}
</script>
<style lang="">

</style>
