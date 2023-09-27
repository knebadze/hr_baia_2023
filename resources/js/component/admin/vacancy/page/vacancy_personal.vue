<template lang="">
    <div>
        <!-- <div id="accordion" >
            <div class="card card-primary" >
                <div class="card-header">
                <h4 class="card-title w-100 d-flex justify-content-between">
                    <a class="d-block w-100" data-toggle="collapse"  href="#collapseOne">
                    ფილტრი
                    </a>
                    <i class="fas fa-angle-down float-right"></i>
                </h4>
                </div>
                <div id="collapseOne" class="collapse hide" data-parent="#accordion" >
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>ID</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.code"  type="text" placeholder="უნიკალური კოდი">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>სახელი გვარი</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.name"  type="text" placeholder="Devid Smith">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>კატეგორია</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.category"  :options="cla.category" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>სტატუსი</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.status"  :options="cla.status" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>ტიპი</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.qualifying_type"  :options="cla.qualifyingType" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name" track-by="name" :preselect-first="false" >
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-success" @click="filterMeth( 'filter', m )"><i class="fa fa-search"></i> ძებნა</button>
                    </div>
                </div>
            </div>
        </div> -->
        <div>
            <table class="table twm-table table-striped table-border">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>სახელი გვარი</th>
                    <!-- <th>კატეგორია</th> -->
                    <!-- <th>სტატუსი</th> -->
                    <th>ტიპი</th>
                    <th>დამატების თარიღი</th>
                    <th>დაწყების თარიღი</th>
                    <th>დასრულების თარიღი</th>
                    <th>მოქმედება</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="(item, index) in items" :key="index">
                    <td><u class="text-primary" @click="openModal(item.vacancy.id)">{{ item.candidate.id }}</u></td>
                    <td>{{ item.candidate.user.name_ka }}</td>
                    <td>{{ item.qualifying_type.name }}</td>
                    <td>{{ item.created_at }}</td>
                    <td>{{ item.start_date }}</td>
                    <td>{{ item.end_date }}</td>
                    <td>
                        <button v-if="showUpdateButton && item.vacancy.status_id == 2" class="btn btn-info btn-sm" @click="showModal(item)">
                            განახლება
                        </button>
                        <div v-else class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" :disabled="(item.qualifying_type.id == 5 || item.qualifying_type.id == 6 || item.qualifying_type.id == 7)?false:true">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                 <div v-if="(item.vacancy.status_id == 3 || item.vacancy.status_id == 4)">
                                    <a v-if="cla.auth.role_id == 1 || (cla.auth.role_id == 2 && cla.auth.hr.id == item.vacancy.hr_id)" class="dropdown-item" href="#" @click="endWorkModal(item.id)">შეწყვეტა</a>
                                </div>
                                <a v-if="item.qualifying_type_id == 5 || item.qualifying_type_id == 6 || item.qualifying_type_id == 7" class="dropdown-item" href="#" @click="moveModal(item)">დასრულების თარიღის გადაწევა</a>
                                <a v-if="item.qualifying_type_id == 7" class="dropdown-item" href="#" @click="scheduleModal(item.id)">გრაფიკი</a>
                            </div>
                        </div>
                    </td>
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
        <!-- <vacancyFullInfoModal :visible="modalShow" :vacancyId="vacancy_id"></vacancyFullInfoModal> -->
        <end_work_modal :visible="endWorkModalShow" :item="item"></end_work_modal>
        <move_end_date :visible="moveModalShow" :item="moveModalData"></move_end_date>
        <schedule_calendar_modal :visible="scheduleModalShow" :item="item"></schedule_calendar_modal>
        <addPersonalVacancy :visible="showAddPersonalModal" :item="modalItem"></addPersonalVacancy>

    </div>
</template>
<script>
import moment from 'moment'
import _ from 'lodash';
import Paginate from 'vuejs-paginate-next';
// import vacancyFullInfoModal from '../../../modal/vacancyFullInfoModal.vue';
import end_work_modal from '../../candidate/modal/end_work_modal.vue';
import move_end_date from '../../candidate/modal/move_end_date.vue';
import schedule_calendar_modal from '../../candidate/modal/schedule_calendar_modal.vue';
import addPersonalVacancy from '../../../hr/modal/addPersonalVacancy.vue';
export default {
    components:{
        Paginate,
        // vacancyFullInfoModal,
        end_work_modal,
        move_end_date,
        schedule_calendar_modal,
        addPersonalVacancy
    },
    props:{
        data:Object,
        cla:Object
    },
    data() {
        return {
            pagination:{
                current_page: 1,
                last_page: 2,
            },
            items:{},
            // m:{},
            // getDataType:'first_data',
            modalShow: false,
            vacancy_id: null,
            endWorkModalShow: false,
            item: null,
            moveModalShow:false,
            moveModalData:{},
            scheduleModalShow:false,
            showAddPersonalModal:false,
            modalItem:{}
            // vacancy: {},

        }
    },
    computed:{
        showUpdateButton(){
            return !this.items.some((o) => o.qualifying_type_id === 6 || o.qualifying_type_id === 7);
        }
    },
    created() {
        this.getData()
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
            this.items = this.data.data
            for (let i = 0; i < this.items.length; i++) {
                // Access the element to update in each object
                this.items[i].created_at = moment(this.items[i].created_at).format("YYYY-MM-DD HH:mm");
                this.items[i].start_date = (this.items[i].start_date)?moment(this.items[i].start_date).format("YYYY-MM-DD"):null;
                this.items[i].end_date = (this.items[i].end_date)?moment(this.items[i].end_date).format("YYYY-MM-DD"):null;
            }
            this.pagination = {
                'current_page':this.data.current_page,
                'last_page': this.data.last_page
            }
            // this.vacancy.interview_date =

        },
        showModal(item){
            this.showAddPersonalModal = !this.showAddPersonalModal
            this.modalItem.interview_date = item.vacancy.interview_date
            this.modalItem.interview_place = item.vacancy.interview_place
            this.modalItem.vacancy_id = item.vacancy_id
            this.modalItem.candidate_id = item.candidate_id
        },
        openModal(id){
            this.modalShow = !this.modalShow
            this.vacancy_id = id
        },
        endWorkModal(id){
            this.item = id
            this.endWorkModalShow = !this.endWorkModalShow
        },
        moveModal(item){
            this.moveModalData = {...item}
            this.moveModalShow = !this.moveModalShow
        },
        scheduleModal(id){
            this.item = id
            this.scheduleModalShow = !this.scheduleModalShow
        }

    },
}
</script>
<style lang="">

</style>
