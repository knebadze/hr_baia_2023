<template lang="">

    <!-- <section class="content ">
        <div class="container-fluid"> -->

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
                            <div class="row">
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
                                        <label>ტელეფონის ნომერი</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.number"  type="text" placeholder="555444333" onkeypress="return event.which != 32">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>მაილი</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.email"  type="text" placeholder="example@gmail.com" onkeypress="return event.which != 32">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>მისამართი</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.address"  type="text" placeholder="თბილის სამგორი კახეთის გზატკეცილი">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>დამატების თარიღი (დან)</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.date_from"  type="date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>დამატების თარიღი (მდე)</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.date_to"  type="date">
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
        <!-- </div>
    </section> -->

        <!-- <div class="mb-2 d-flex justify-content-end">
            <a type="button" class="btn btn-success" :href="addCandidateUrl" title="კანდიდატის დამატება"><i class="fa fa-plus"></i> დაამატე კანდიდატი</a>
        </div> -->
        <employer_table :data="employer" :role_id="1" :key="tableKey"></employer_table>
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
            <!-- <info_modal :visible="show_info_modal" :type="modalType" :data="modalData"></info_modal> -->



</template>
<script>

import _ from 'lodash';
import Paginate from 'vuejs-paginate-next';
// import info_modal from '../modal/info_modal.vue'
// import Slider from '@vueform/slider'
// import axios from 'axios';
import employer_table from '../component/employer_table.vue';
export default {
    components:{
        paginate: Paginate,
        employer_table
        // info_modal,
        // Slider,
        // candidate_table
    },
    props:{
    },
    data() {
        return {
            employer:[],
            staticEmployer:[],
            pagination:{
                current_page: 1,
                last_page: 2,
            },
            getDataType:'first_data',
            category:null,
            // show_info_modal: false,
            // modalType:'',
            modalData:{},
            m:{},
            cla: {},
            colspan:'collapsed-card',
            tableKey: 0,


        }
    },
    created(){

    },
    computed:{
        // addCandidateUrl(){
        //     let url = new URL( location.href)
        //     return url.origin+'/admin/add_candidate'

        // }
    },
    methods: {
        async getData(){
            if (this.getDataType == 'first_data') {
                await this.fetchData()
            } else if (this.getDataType == 'filter') {
                this.filter(this.m)
            }

        },
        async fetchData(){

            const response = await axios.get(`/fetch_employer?page=${this.pagination.current_page}`);
            console.log('response',response);
            let data = response.data
            this.employer = data.data
            this.staticEmployer = data.data
            // this.cla = this.data.classificatory
            this.pagination = {
                'current_page':data.current_page,
                'last_page': data.last_page
            }
            this.tableKey++
        },
        filterMeth(type,m){
            this.getDataType = type
            if (this.getDataType == 'filter') {
                this.filter(m)
            }
        },
        filter(m){
            if (m.date_from || m.date_to) {
                if (!m.date_from || !m.date_to) {
                    toast.info('ორივე თარიღის შევსება სავალდებულოა', {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    return
                }
                (m.date_from || m.date_to)?m['date'] = [m.date_from, m.date_to]:'';
            }
            this.colspan = 'hide'
            let currentObj = this;
            axios({
                    method: "post",
                    url: '/employer_filter?page=' + this.pagination.current_page,
                    data: m,

                })
            .then(function (response) {
                // handle success
                currentObj.employer = response.data.data
                currentObj.pagination = {
                    'current_page':response.data.current_page,
                    'last_page': response.data.last_page
                }
                currentObj.tableKey++
                // currentObj.modalData['candidate'] = response.data

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        endFilter(){
            this.m ={}
            this.employer = this.staticEmployer
            this.tableKey++
        }
    },
    async mounted(){
        await this.getData()
    }
}
</script>
<style lang="">

</style>
