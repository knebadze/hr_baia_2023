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
                    <th>შემკვეთი</th>
                    <th>კატეგორია</th>
                    <th>სტატუსი</th>
                    <th>ტიპი</th>
                    <th>დამატების თარიღი</th>
                    <th v-if="items[0].qualifying_type_id == 7">შეწყვეტა</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="(item, index) in items" :key="index">
                    <td><u class="text-primary" @click="openModal(item.vacancy.id)">{{ item.vacancy.code }}</u></td>
                    <td>{{ item.vacancy.employer.name_ka }}</td>
                    <td>{{ item.vacancy.category.name_ka }}</td>
                    <td>{{ item.vacancy.status.name_ka }}</td>
                    <td>{{ item.qualifying_type.name }}</td>
                    <td>{{ item.created_at }}</td>
                    <td v-if="item.qualifying_type_id == 7">
                        <button class="btn btn-danger" @click="endWork(item.id)" title="მუშაობის დასრულება" >
                            <i class="fa fa-times"></i>
                        </button>
                    </td>
                    <!-- <td>
                        <button class="btn btn-info" @click="showModal(item)" title="დამატება" >
                            <i class="fa fa-plus"></i>
                        </button>
                    </td> -->
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
        <vacancyFullInfoModal :visible="modalShow" :vacancyId="vacancy_id"></vacancyFullInfoModal>
    </div>
</template>
<script>
import moment from 'moment'
import _ from 'lodash';
import Paginate from 'vuejs-paginate-next';
import vacancyFullInfoModal from '../../../modal/vacancyFullInfoModal.vue';
export default {
    components:{
        Paginate,
        vacancyFullInfoModal
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
            vacancy_id: null
        }
    },
    computed:{

    },
    created() {
        console.log('data', this.data);
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
            }
            this.pagination = {
                'current_page':this.data.current_page,
                'last_page': this.data.last_page
            }

        },
        openModal(id){
            this.modalShow = !this.modalShow
            this.vacancy_id = id
        },
        endWork(id){
            this.$swal({
                title: 'ნამდვილად გსურთ სამუშაოს დასრულება?',
                html:'ცვლილება ავტომატურად მოხსნის კანდიდატს ვაკანის დასაქმებული სტატუსიდან',
                //   showDenyButton: true,
                cancelButtonText:'არა',
                confirmButtonText: 'კი',
                showCancelButton: true,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            // return
                if (result.isConfirmed) {
                    axios({
                        method: "post",
                        url: "/candidate_status_update",
                        data:{'id':id},

                    })
                    .then(function (response) {
                        // console.log(response.data);
                        if (response.data.status == 200) {
                            toast.success("წარმატებით წაიშალა", {
                                theme: 'colored',
                                autoClose: 1000,
                            });
                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })

                } else if (result.isDenied) {
                    return
                }
            });
        }

        // filterMeth(type,m){
        //     this.getDataType = type
        //     if (this.getDataType == 'filter') {
        //         this.filter(m)
        //     }
        // },
        // filter(m){
        //     axios({
        //         method: "post",
        //         url: '/vacancy_attached_filter?page=' + this.pagination.current_page,
        //         data: m,
        //     })
        //     .then(function (response) {
        //         console.log('response.data', response.data);
        //         currentObj.pagination = {
        //             'current_page':response.data.current_page,
        //             'last_page': response.data.last_page
        //         }
        //         currentObj.items = response.data.data

        //     })
        //     .catch(function (error) {
        //         // handle error
        //         console.log(error);
        //     })
        // }
    },
}
</script>
<style lang="">

</style>
