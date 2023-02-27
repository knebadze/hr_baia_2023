<template lang="">
    <div class="col-xl-9 col-lg-8 col-md-12 m-b30">
        <!--Filter Short By-->
        <div class="twm-right-section-panel site-bg-gray">
            <!--personal information-->
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <!-- <div class="d-flex justify-content-between"> -->
                        <h4 class="panel-tittle m-a0">{{ 'კატეგორია და გრაფიკი' }}</h4>
                        <!-- <button type="button" class="btn btn-success" @click="addWorkInfoModal()"><i class="fa fa-plus"></i> დამატება</button> -->

                    <!-- </div> -->
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30 ">
                    <p class="text-danger">შეგიძლიათ შეავსოთ რამოდენიმე კატეგორიაზე და ჩვენ შემოგთავაზებთ თქვენ მიერ არჩეული კატეგორიების შესაბამის ვაკანისებს.</p>
                    <small>ინფორმაციის შევსების შემდეგ გამოიყენეთ ღილაკი შენახვა რის შემდეგაც საშვალება მოგეცემათ დაიწყოთ ინფორმაციის შევსება სხვა კატეგორიაზე.</small>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ 'კატეგორია' }}</label>
                                <div class="ls-inputicon-box">
                                    <select class="wt-select-box selectpicker" v-model="m.getWorkInformation.category_id"   data-live-search="true" title=""  data-bv-field="size">
                                        <option v-for="category in data.classificator.category" :value="category.id">{{ category[`name_${getLang}`] }}</option>
                                    </select>
                                    <!-- <i class="fs-input-icon fa fa-smoking"></i> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ 'სამუშაო გრაფიკი' }}</label>
                                <div class="ls-inputicon-box">
                                    <select class="wt-select-box selectpicker" v-model="m.getWorkInformation.work_schedule_id"  data-live-search="false" title=""  data-bv-field="size">
                                        <option v-for="schedule in data.classificator.workSchedule" :value="schedule.id">{{ schedule[`name_${getLang}`] }}</option>
                                    </select>
                                    <!-- <i class="fs-input-icon fa fa-smoking"></i> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ 'რომელი სათიდან?' }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" type="time" step="1" v-model="m.getWorkInformation.from_hour">

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ 'რომელი სათამდე?' }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" type="time" step="1" v-model="m.getWorkInformation.to_hour">

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ 'ანაზღაურება' }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" type="number" step="50" v-model="m.getWorkInformation.payment">
                                    <i class="fs-input-icon fa fa-money"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ 'ვალუტა' }}</label>
                                <div class="ls-inputicon-box">
                                    <select class="wt-select-box selectpicker" v-model="m.getWorkInformation.currency_id" data-live-search="false" title=""  data-bv-field="size">
                                        <option v-for="currency in data.classificator.currency" :value="currency.id">{{ currency[`name_${getLang}`] }}</option>
                                    </select>
                                    <i class="fs-input-icon fa fa-usd"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!--რეკომენდაცია-->
                 <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_recomendation_title') }}</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_recomendation_from') }}</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker"  v-model="candidateRecommendationModel.recommendation"  data-live-search="false" title=""  data-bv-field="size">
                                            <option :value="1">წარმოვადგენ</option>
                                            <option :value="2">ვერ წარმოვადგენ</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-thumbs-up"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 " :class="(candidateRecommendationModel.recommendation == 1)?'':'visually-hidden'" >
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_recomendation_where_from') }}</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker"  v-model="candidateRecommendationModel.recommendation_from_whom_id"  data-live-search="false" title=""  data-bv-field="size">
                                            <option v-for="recommendationFrom in data.classificator.recommendationFromWhom " :value="recommendationFrom.id">{{ recommendationFrom[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-industry"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidateRecommendationModel.recommendation == 1 " class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_recomendation_name') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="candidateRecommendationModel.name" type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidateRecommendationModel.recommendation_from_whom_id == 2 " class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>თანამდებობა</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="candidateRecommendationModel.position" type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidateRecommendationModel.recommendation == 1" class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_recomendation_number') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="candidateRecommendationModel.number" type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-phone"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidateRecommendationModel.recommendation == 1" class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>ფაილი</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" ref="upload" type="file" @change="recommendationFileUpload" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12" :class="(candidateRecommendationModel.recommendation == 2)?'':'visually-hidden'">
                                <div class="form-group">
                                    <label>რეცომდაციის არ ქონის მიზეზი</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker"  v-model="candidateRecommendationModel.no_reason_id"  data-live-search="true" title=""  data-bv-field="size">
                                            <option v-for="recommendation in data.classificator.noRecommendationReason" :value="recommendation.id">{{ recommendation[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-history"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidateRecommendationModel.recommendation == 2" class="col-md-12">
                                <div class="form-group">
                                    <label>დამატაბითი ინფორმაცია</label>
                                    <textarea class="form-control" rows="3" v-model="candidateRecommendationModel.no_reason_info" placeholder="ჩაწერეთ იმ შემთხვევაში თუ ასარჩევ ველში ვერ ნახეთ შესაფერისი მიზეზი ან გსურთ დამატებითი ინფორმაციის მოწოდება"></textarea>
                                </div>
                            </div>
                            <div v-if="candidateRecommendationModel.recommendation == 1" class="col-lg-12 col-md-12">
                                <div class="text-right ">
                                    <button class="btn btn-success"
                                    @click="addCandidateRecommendation(candidateRecommendationModel)"
                                    title="დამატება" data-bs-toggle="tooltip" data-bs-placement="top">დამატება
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                            </div>
                            <div v-if="m.candidateRecommendation.length > 0" class="col-lg-12 col-md-12">
                                <div class="panel-body wt-panel-body">
                                    <div class="p-a20 table-responsive">
                                        <table class="table twm-table table-striped table-borderless">
                                            <thead>
                                                <tr>
                                                <th>N</th>
                                                <th>საიდან?</th>
                                                <th>სახელი გვარი</th>
                                                <th>ნომერი</th>
                                                <th>თანამდებობა</th>
                                                <th>ფაილი</th>
                                                <th>action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(item, index) in m.candidateRecommendation">
                                                <td>{{ index + 1 }}</td>
                                                <td><span :class="(item.recommendation_from_whom_id == 1)?'badge bg-success p-2':'badge bg-info text-dark p-2'">{{ item.recommendation_whom[`name_${getLang}`] }}</span></td>
                                                <td>{{ item.name }}</td>
                                                <td>{{ item.number }}</td>
                                                <td>{{ item.position }}</td>
                                                <td>{{ item.file }}</td>
                                                <td>
                                                    <button @click="removeRow('recommendation',index)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 mt-4">
                                <div class="text-left">
                                    <button type="submit" @click.prevent="addWorkInfo()"  class="site-button">{{ 'შენახვა' }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!--  -->
            <div class="panel panel-default" v-if="m.getWorkInformation.category_id > 0 && m.getWorkInformation.category_id < 9">
                <div class="panel-heading wt-panel-heading p-a20">
                    <!-- <div class="d-flex justify-content-between"> -->
                        <h4 class="panel-tittle m-a0">{{ 'ოჯახში მუშაობის გამოცდილება' }}</h4>
                        <!-- <button type="button" class="btn btn-success" @click="addWorkInfoModal()"><i class="fa fa-plus"></i> დამატება</button> -->

                    <!-- </div> -->
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30 ">
                    <p class="text-danger">რადგან გსურთ ოჯახში დასაქმება კლიენტებისთვის მნიშვნელოვანია იცოდნენ თქვენი გამოცილების შესახებ</p>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>გაქვთ ოჯახში მუშაობის გამოცდილება?</label>
                                <div class="ls-inputicon-box">
                                    <select class="wt-select-box selectpicker" v-model="m.familyWorkExperience.experience"  data-live-search="false" title=""  data-bv-field="size">
                                        <option :value="1">კი</option>
                                        <option :value="2">არა</option>
                                    </select>
                                    <i class="fs-input-icon fa fa-star"></i>
                                    <!-- <span v-if="v$.candidateWorkExperienceModel.experience.required.$invalid && v$.candidateWorkExperienceModel.experience.$dirty" style='color:red'>* {{ v$.candidateWorkExperienceModel.experience.required.$message}}</span> -->
                                </div>
                            </div>
                        </div>
                        <div :class="(m.familyWorkExperience.experience == 1)?'':'visually-hidden'" class=" col-md-12">
                            <div class="row">
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ 'რამდენ ოჯახში გიმუშავიათ?' }}</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" type="text" v-model="m.familyWorkExperience.families_worked_count">
                                            <i class="fs-input-icon fa fa-smoking"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ 'სტაჟი (ჯამში)' }}</label>
                                        <div class="ls-inputicon-box">
                                            <select class="wt-select-box selectpicker" v-model="m.familyWorkExperience.work_experience_id"  data-live-search="false" title=""  data-bv-field="size">
                                                <option v-for="workExperience in data.classificator.workExperience" :value="workExperience.id">{{ workExperience[`name_${getLang}`] }}</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ 'ყველაზე ხანგრძლივად' }}</label>
                                        <div class="ls-inputicon-box">
                                            <select class="wt-select-box selectpicker" v-model="m.familyWorkExperience.longest_time"  data-live-search="false" title=""  data-bv-field="size">
                                                <option v-for="workExperience in data.classificator.workExperience" :value="workExperience.id">{{ workExperience[`name_${getLang}`] }}</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>


                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ 'ოჯახში მუშაობდით' }}</label>
                                        <div class="ls-inputicon-box">
                                            <select class="wt-select-box selectpicker" v-model="m.familyWorkedSelected"  data-live-search="true" title=""  data-bv-field="size" multiple>
                                                <option v-for="familyCategory in data.classificator.familyCategory " :value="familyCategory.id">{{ familyCategory[`name_${getLang}`] }}</option>
                                            </select>
                                            <i class="fs-input-icon fa fa-microscope"></i>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ 'გევალებოდათ' }}</label>
                                        <div class="ls-inputicon-box">
                                            <select class="wt-select-box selectpicker" v-model="m.candidateFamilyWorkSkill"   data-live-search="true" title=""  data-bv-field="size" multiple>
                                                <option v-for="skill in setSkill" :value="skill.id">{{ skill[`name_${getLang}`] }}</option>
                                            </select>
                                            <i class="fs-input-icon fa fa-microscope"></i>
                                        </div>

                                    </div>
                                </div> -->
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ 'გევალებოდათ' }}</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="m.candidateFamilyWorkSkill"  :options="setSkill" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name_ka" track-by="name_ka" :preselect-first="false">
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div :class="(m.familyWorkExperience.experience == 2)?'':'visually-hidden'" class=" col-md-12">
                            <div  class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>სამუშაო გამოცდილების არ ქონის მიზეზი</label>
                                        <div class="ls-inputicon-box">
                                            <select class="wt-select-box selectpicker"  v-model="m.familyWorkExperience.no_reason_id"  data-live-search="true" title=""  data-bv-field="size">
                                                <option v-for="workExperience in data.classificator.noExperienceReason" :value="workExperience.id">{{ workExperience[`name_${getLang}`] }}</option>
                                            </select>
                                            <i class="fs-input-icon fa fa-history"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>დამატაბითი ინფორმაცია</label>
                                        <textarea class="form-control" rows="3" v-model="m.familyWorkExperience.no_reason_info" placeholder="ჩაწერეთ იმ შემთხვევაში თუ ასარჩევ ველში ვერ ნახეთ შესაფერისი მიზეზი ან გსურთ დამატებითი ინფორმაციის მოწოდება"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="text-left">
                                <button type="submit" @click.prevent="addFamilyWorkExperience()"  class="site-button">{{ 'შენახვა' }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
export default {
    components:{
    },
    props:{
        data: Object
    },
    data() {
        return {
            time:'15:20:00',
            m: null,
            candidateRecommendationModel: {
                recommendation: '',
                recommendation_from_whom_id :'',
                name:'',
                position:'',
                number:'',
                no_reason_id:'',
                no_reason_info:'',
            },
            recommendationFile:null,
            setSkill:[],
            formData:new FormData(),
        }
    },
    created(){
        this.m = { ...this.data.model };
        console.log(this.m);
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },

    },
    methods:{
        childMessageReceived(arg){
            this.showWorkInformation = arg
        },
        addWorkInfo(){
            if (this.candidateRecommendationModel.recommendation == 2) {
                this.m.candidateRecommendation.push(this.candidateRecommendationModel)
            }
            const formData = new FormData();
            const config = {headers: {'content-type': 'multipart/from-data'}}
            formData.append('obj',this.m)
            let currentObj = this;
            axios({
                method: "post",
                url: "/add_work_information",
                data: this.m,

            })
            .then(function (response) {

                // handle success
                console.log('response.data',response.data);
                if (response.data.status == 200) {
                    toast.success("ინფორმაცია წარმატებით დაემატა", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                }

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        addFamilyWorkExperience(){
            console.log('this.noticeFile',this.m.candidateFamilyWorkSkill);
            let currentObj = this;
            axios({
                method: "post",
                url: "/add_family_work_experience",
                data: this.m,

            })
            .then(function (response) {
                console.log('response.data',response.data);
                if (response.data.status == 200) {
                    // toast.success("ინფორმაცია წარმატებით დაემატა", {
                    //     theme: 'colored',
                    //     autoClose: 1000,
                    // });
                    currentObj.$swal(
                    {
                        title: '<p>გილოცავთ თქვენ დაასრულეთ ინფორმაციის შევსება</p>',
                        icon: 'info',
                        html:
                            'თქვენი კანდიდატურა უკვე ჩანს დამსაქმებლებთან და ასევე ჩვენი ეიჩარები ვაკანსიების მიღებს შემთხვევაში გაითვალისწინებენ თქვენს კანდიდატურას',
                        showCloseButton: true,
                        showCancelButton: false,
                        focusConfirm: false,
                        // confirmButtonText: 'შესავსებად გადასვლა',
                    })
                }

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        addCandidateRecommendation(recommendation){
            if (this.recommendationFile != null) {
                recommendation['file'] = this.recommendationFile.name
            }

            var recomendationWhomFind = _.find(this.data.classificator.recommendationFromWhom, function(o) { return o.id == recommendation.recommendation_from_whom_id; });
            recommendation['recommendation_whom'] = recomendationWhomFind;
            this.m.candidateRecommendation.push(JSON.parse(JSON.stringify(recommendation)))
        },

        recommendationFileUpload(event){
            var key = this.m.candidateRecommendation.length + 1
            // console.log('key', key);
            // var obj = {
            //     'key': key,
            //     'file': event.target.files[0]
            // }

            this.recommendationFile = event.target.files[0]
            this.formData.append(`${key}`, JSON.stringify(this.recommendationFile))
            // console.log('this.recommendationFile',this.recommendationFile);
        },
    },
    watch: {
        'm.familyWorkedSelected': function(newVal, oldVal){
            if (this.m.familyWorkedSelected.length == 0) {
                this.setSkill = []
            }else{
                let filteredX = this.data.classificator.skill.filter(itemX => this.m.familyWorkedSelected.includes(itemX.category_id));
                this.setSkill = filteredX

            }
            // console.log('this.setSkill', this.setSkill);
        },
        'm.familyWorkExperience.experience': function(newVal, oldVa){
            console.log('newVal', newVal);
            if (newVal == 2 ) {
                this.$swal(
                {
                    title: '<p>შეგახსენებთ!!!</p>',
                    icon: 'info',
                    html:
                        'ჩვენი კლიენტები დასაქმების დროს ითვალისწინებელ სამუშაო გამოცდილებას ვინაიდან არ გაქვთ გამოცდილება გთხოვთ შეავსოთ გამოცდილების არ ქონის მიზეზი ',
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false,
                    // confirmButtonText: 'შესავსებად გადასვლა',
                })
            }
        }
    },

    mounted() {
        // console.log('this', this.data);
    },

}
</script>

<style>


</style>
