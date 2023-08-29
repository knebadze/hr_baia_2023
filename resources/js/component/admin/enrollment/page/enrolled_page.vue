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
                        <h5 class="ml-2"><i class="fa fa-user" ></i> დამკვეთი:</h5>
                        <hr>
                            <!-- <div class="row" v-if="cla">

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
                                        <label>მისამართი</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.address"  type="text" placeholder="თბილის სამგორი კახეთის გზატკეცილი">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 border mb-3"></div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>ID</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.code"  type="text" placeholder="უნიკალური კოდი">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12" >
                                    <div class="form-group">
                                        <label>კატეგორია</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.category"  :options="cla.category" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12" >
                                    <div class="form-group">
                                        <label>გრაფიკი</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.work_schedule"  :options="cla.workSchedule" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>ანაზღაურება</label>
                                        <div class="ls-inputicon-box mt-4">
                                            <Slider v-model="m.payment" :min=50  :max=5000 :step=10 class="slider"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>ვალუტა</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.currency" :options="cla.currency" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                                <template slot="singleLabel" slot-scope="{ option }"></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>სტატუსი</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.status" :options="cla.status" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                                <template slot="singleLabel" slot-scope="{ option }"></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12" v-if="roleId == 1">
                                    <div class="form-group">
                                        <label>HR</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.hrs"  :options="cla.hr" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 border mb-3"></div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label class="ml-4"> ასაკი</label>
                                        <div class="ls-inputicon-box mt-4">
                                            <Slider v-model="m.age" :min=18 :step=10 class="slider"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12" >
                                    <div class="form-group">
                                        <label>განათლება</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.education"  :options="cla.educations" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12" >
                                    <div class="form-group">
                                        <label>სპეციალობა</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.specialty"  :options="cla.specialties" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12" >
                                    <div class="form-group">
                                        <label>უცხო ენა</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.language"  :options="cla.languages" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12" >
                                    <div class="form-group">
                                        <label>ცოდნის დონე</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.language_level"  :options="cla.languageLevels" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12" >
                                    <div class="form-group">
                                        <label>მართვის მოწმობა</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.driving_license"  :options="cla.drivingLicense" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name" track-by="name" :preselect-first="false" >
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12" >
                                    <div class="form-group">
                                        <label>ზოგადი მახასიათებლები</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.characteristic"  :options="cla.characteristic" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 border mb-3"></div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>დამატების თარიღი (დან)</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.created_at_from"  type="date" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>დამატების თარიღი (მდე)</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.created_at_to"  type="date" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>გასაუბრების თარიღი (დან)</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.interview_date_from"  type="dateTime-local" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>გასაუბრების თარიღი (მდე)</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.interview_date_two"  type="dateTime-local" >
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-12" >
                                    <div class="form-group">
                                        <label>გასაუბრების ადგილი</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.interview_place"  :options="cla.interviewPlace" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>დაწყების თარიღი (დან)</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.start_date_from"  type="date" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>დაწყების თარიღი (მდე)</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" v-model="m.start_date_to"  type="date" >
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-12" >
                                    <div class="form-group">
                                        <label>ვადა</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.term"  :options="cla.term" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                    <div class=" form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" v-model="m.go_vacation">
                                        <label class="form-check-label" for="exampleCheck1">შეეძლოს არდადეგებზე გაყოლა</label>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                    <div class=" form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck2" value="1" v-model="m.stay_night">
                                        <label class="form-check-label" for="exampleCheck2">შეეძლოს ღამე დარჩენა</label>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                    <div class=" form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck3" value="1" v-model="m.work_additional_hours">
                                        <label class="form-check-label" for="exampleCheck3">შეეძლო დამატებით საათებში მუშაობა</label>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                    <div class=" form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck4" value="1" v-model="m.has_family_work_experience">
                                        <label class="form-check-label" for="exampleCheck4">ოჯახში მუშაობის გამოცდილება</label>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                    <div class=" form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck5" value="1" v-model="m.has_recommendation">
                                        <label class="form-check-label" for="exampleCheck5">რეკომენდაცია</label>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12 mt-3" v-if="roleId == 2">
                                    <div class=" form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck6" value="true" v-model="m.hr">
                                        <label class="form-check-label" for="exampleCheck6">ჩემი ვაკანსიები</label>
                                    </div>
                                </div>
                            </div> -->

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
                        <h3>{{ data.info.total_money }}</h3>
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
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ data.info.total_hr_bonus }}</h3>

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
                        <h3>{{ data.info.agree_count }}</h3>

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
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ data.info.agree_no_count }}</h3>

                        <p>დასადასტურებელი</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-times"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <!-- ./col -->
        </div>
        <enrolled_table :items="items" :role_id="role_id"></enrolled_table>


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
import Paginate from 'vuejs-paginate-next';
import enrolled_table from '../component/enrolled_table.vue'
export default {
    components:{
        Paginate,
        enrolled_table
    },
    props:{
        data:Object
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
            role_id: null
        }
    },
    computed:{

    },
    created() {
        console.log('data', this.data);
        this.getData()
        this.role_id = this.data.role_id
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
            this.pagination = {
                'current_page': this.data.items.current_page,
                'last_page': this.data.items.last_page
            };
            this.items = this.data.items.data;
        },
        filterMeth(type,m){
            this.getDataType = type
            if (this.getDataType == 'filter') {
                this.filter(m)
            }
        },
        async filter(m){

        }
    },
    watch:{

    },
}
</script>
<style lang="">

</style>
