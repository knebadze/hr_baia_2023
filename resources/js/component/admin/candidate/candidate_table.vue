<template lang="">
    <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">ფილტრი</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inputName">კატეგორია</label>
                            <multiselect v-model="category" :options="data.classificatory.category" :searchable="true" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :allow-empty="false">
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inputName">ეროვნება</label>
                            <multiselect v-model="category" :options="data.classificatory.nationality" :searchable="true" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :allow-empty="false">
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inputName">რელიგია</label>
                            <multiselect v-model="category" :options="data.classificatory.religions" :searchable="true" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :allow-empty="false">
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
    <div >
        <table class="table table-bordered  table-head-fixed">
            <thead>
            <tr>
                <th>N</th>
                <th>სახელი გვარი</th>
                <th>ასაკი</th>
                <th>მისამართი</th>
                <th>ნომერი</th>
                <th>კატეგორია</th>
                <th>სტატუსი</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item, index) in candidate" :key="index" >
                <td>{{ index + 1 }}</td>
                <td>{{ item.user.name_ka }}</td>
                <td>{{ age(item.user.date_of_birth) }}</td>
                <td>{{ item.address_ka+ ' '+item.street_ka }}</td>
                <td>{{ item.user.number }} </td>
                <td><a v-for="i in item.work_information" :key="index" class="badge badge-info mr-1" style="cursor: pointer;" @click="showInfoModal({'type':'category', 'data':i})">{{ i.name_ka }}</a> </td>
                <td><span class="badge badge-warning">{{ (item.user.status == 2)?'მზადაა':''}}</span>  </td>
                <td class="d-flex">
                    <button class="btn btn-primary btn-sm mr-1" type="button" data-toggle="collapse"
                        data-target="#collapseExample"
                        aria-expanded="false"
                        aria-controls="collapseExample"
                        @click="toggleChildren"
                    >
                        <i aria-hidden="true"
                            :class="toggleChildrenIcon"
                            @keypress="toggleChildren">
                        </i>
                    </button>
                    <button class="btn btn-info btn-sm mr-1"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
            <tr v-for="(item, index) in candidate" :key="index" class="collapse" id="collapseExample">
                <td colspan="8">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="border py-2">
                                <li><strong>პირადი ნომერი: </strong><span>{{ item.personal_number }}</span></li>
                                <li><strong>ეროვნება: </strong><span>{{ item.nationality.name_ka }}</span></li>
                                <li><strong>მოქალაქეობა: </strong><span>{{ maker(item.citizenship) }}</span></li>
                                <li><strong>რელიგია: </strong><span>{{ item.religion.name_ka }}</span></li>
                                <li><strong>ოჯახური მდგომარეობა: </strong><span>{{ item.marital_status.name_ka }}</span></li>
                                <li><strong>განათლება: </strong><span>{{ item.education.name_ka }}</span></li>
                                <li><strong>პროფესია: </strong><span>{{ maker(item.professions) }}</span></li>
                                <li><strong>სპეციალობა: </strong><span>{{ maker(item.specialty) }}</span></li>
                                <li><strong>უცხო ენები: </strong><span>{{ language(item.languages) }}</span></li>
                                <li><strong>მართვის მოწმობა: </strong><span>{{ maker(item.driving_license) }}</span></li>
                                <li><strong>ალერგია: </strong><span>{{ maker(item.allergy) }}</span></li>
                                <li><strong>ზოგადი სამუშაი გამოცდილება: </strong><span class="text-primary" @click="showInfoModal({'type':'general_work', 'data':item.general_work_experience})"><u style="cursor: pointer;">{{ (item.general_work_experience == 0)?'არა':'კი' }}</u></span></li>
                                <li><strong>ოჯახში მუშაობის გამოცდილება: </strong><span class="text-primary" @click="showInfoModal({'type':'family_work', 'data':item.family_work_experience})"><u style="cursor: pointer;">{{ (item.family_work_experience == 0)?'არა':'კი' }}</u></span></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="border py-2">
                                <li><strong>რეგისტრაციის თარიღი: </strong><span>{{item.created_at.slice(0, 10)}}</span></li>
                                <li v-if="item.marital_status_id !=1"><strong>შვილები: </strong><span>{{ item.children }}</span></li>
                                <li v-if="item.marital_status_id !=1 && item.children && item.children != 0"><strong>შვილების ასაკი: </strong><span>{{ item.children_age }}</span></li>
                                <li v-if="item.marital_status_id != 2 && item.spouse"><strong>მეუღლე: </strong><span>{{ item.spouse }}</span></li>
                                <li><strong>სიმაღლე: </strong><span>{{ item.height+' სმ' }}</span></li>
                                <li><strong>წონა: </strong><span>{{ item.weight+ ' კგ' }}</span></li>
                                <li><strong>მოწევა: </strong><span>{{ (item.smoke == 0)?'არა':'კი' }}</span></li>
                                <li><strong>ნასამართლეობა: </strong><span>{{ (item.convection == 0)?'არა':'კი' }}</span></li>
                                <li><strong>საზღვარგარეთ მუშაობა: </strong><span>{{ (item.work_abroad == 0)?'არა':'კი' }}</span></li>
                                <li><strong>მახასიათებლები: </strong><span>{{ maker(item.characteristic) }}</span></li>
                                <li><strong>დაბადების თარიღი: </strong><span>{{ item.user.date_of_birth }}</span></li>
                                <li v-if="item.medical_info_ka"><strong>სამედიციონო ინფორმაცია: </strong><span>{{ item.medical_info_ka }}</span></li>
                                <li><strong>რეკომენდაცია: </strong><span class="text-primary" @click="showInfoModal({'type':'recommendation', 'data':item.recommendation})"><u style="cursor: pointer;">{{ (item.recommendation[0] )?'კი':'არა' }}</u></span></li>

                            </ul>
                        </div>
                    </div>

                </td>
            </tr>
            </tbody>
        </table>
    </div>
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
    <info_modal :visible="show_info_modal" :type="modalType" :data="modalData"></info_modal>
</template>
<script>
import _ from 'lodash';
import Paginate from 'vuejs-paginate-next';
import info_modal from './modal/info_modal.vue'
// import axios from 'axios';
export default {
    components:{
        paginate: Paginate,
        info_modal,
    },
    props:{
        data:Object

    },
    data() {
        return {
            candidate:null,
            pagination:{
                current_page: 1,
                last_page: 2,
            },
            category:null,
            showChildren: false,
            show_info_modal: false,
            modalType:'',
            modalData:{},
        }
    },
    created(){
        // this.candidate = {...this.data.candidate}
        console.log('data',this.data);
        this.getData()
    },
    computed:{
        toggleChildrenIcon() {
            return this.showChildren ? 'fas fa-angle-down' : 'fas fa-angle-right'
        },
    },
    methods: {

        getData(){
            this.candidate = {...this.data.candidate.data}
            this.pagination = {
                    'current_page':this.data.candidate.current_page,
                    'last_page': this.data.candidate.last_page
                }
            // axios.get('/candidate_data?page=' + this.pagination.current_page )
            // .then((response)=> {
            //     console.log('response', response)
            //     this.candidate = {...response.data.data}
            //     this.pagination = {
            //         'current_page':response.data.current_page,
            //         'last_page': response.data.last_page
            //     }

            // })
            // .catch(function (error) {
            //     console.log(error);
            // });

        },
        age(date_of_birth){
            var dob = new Date(date_of_birth)
            var diff_ms = Date.now() - dob.getTime();
            var age_dt = new Date(diff_ms);
            return Math.abs(age_dt.getUTCFullYear() - 1970);
        },
        maker(params) {
            var result = ''
            _.forEach(params, function(value) {
                result += (value.name_ka)?value.name_ka+', ':value.name+', '
            });
            return result
        },
        language(params) {
            var result = ''
            params.forEach(value => {
                result += value.name_ka+' - '+this.languageLevel(value.pivot.language_level_id)+', '
            });
            return result
        },
        languageLevel(params) {
            var result = '';
            if (params == 1) {
                result = 'მშობლიური'
            } else if(params == 2) {
                result = 'კარგად'
            } else if(params == 3) {
                result = 'საშუალოდ'
            } else if(params == 4) {
                result = 'ცუდად'
            }
            return result
        },
        toggleChildren() {
            this.showChildren = !this.showChildren
        },
        showInfoModal(item){
            this.modalType = item.type
            this.modalData = item.data
            this.show_info_modal = !this.show_info_modal
        }
    },
    mounted(){

    }
}
</script>
<style lang="">

</style>
