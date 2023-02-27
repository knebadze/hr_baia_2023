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
            <div class="panel panel-default">
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
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ 'გევალებოდათ' }}</label>
                                        <div class="ls-inputicon-box">
                                            <!-- <multiselect v-model="value" class="wt-select-box" :options="options" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name" track-by="name" :preselect-first="true">
                                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                            </multiselect> -->
                                            <select class="wt-select-box selectpicker" v-model="m.candidateFamilyWorkSkill"   data-live-search="true" title=""  data-bv-field="size" multiple>
                                                <option v-for="skill in setSkill" :value="skill.id">{{ skill[`name_${getLang}`] }}</option>
                                            </select>
                                            <i class="fs-input-icon fa fa-microscope"></i>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>{{ 'გევალებოდათ' }}</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect v-model="value" :options="setSkill" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name_ka" track-by="name_ka" :preselect-first="false">
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
            // workInformationModel: {
            //     category_id: '',
            //     work_schedule_id: '',
            //     from_hour: '',
            //     to_hour: '',
            //     payment: 800,
            //     currency_id: '',
            // },
            // candidateFamilyWorkSkillModal: {

            // },
            // familyWorkExperienceModel: {
            //     experience: '',
            //     families_worked_count: '',
            //     longest_time: '',
            //     work_experience_id: '',
            //     no_reason_id: '',
            //     no_reason_info: '',
            // },
            recommendationFile:[],
            setSkill:[],
            value: [],
            options: [
        { name: 'Vue.js', language: 'JavaScript' },
        { name: 'Adonis', language: 'JavaScript' },
        { name: 'Rails', language: 'Ruby' },
        { name: 'Sinatra', language: 'Ruby' },
        { name: 'Laravel', language: 'PHP' },
        { name: 'Phoenix', language: 'Elixir' }
      ]
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
            formData.append('obj',JSON.stringify(this.m))
            let currentObj = this;
            console.log('currentObj',currentObj);
            axios({
                method: "post",
                url: "/add_work_information",
                data: this.m,

            })
            .then(function (response) {
                // console.log('this.noticeFile',currentObj);
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
            // let currentObj = this;
            axios({
                method: "post",
                url: "/add_family_work_experience",
                data: this.m,

            })
            .then(function (response) {
                // console.log('this.noticeFile',currentObj);
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
            console.log('key', key);
            var obj = {
                'key': key,
                'file': event.target.files[0]
            }
            this.recommendationFile.push(obj)
            console.log('this.recommendationFile',this.recommendationFile);
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
            console.log('this.setSkill', this.setSkill);
        }
    },

    mounted() {
        // console.log('this', this.getLang);
    },

}
</script>
<!-- <style src="vue-multiselect/dist/vue-multiselect.css"></style> -->
<style>


fieldset[disabled] .multiselect {
    pointer-events: none;
  }

  .multiselect__spinner {
    position: absolute;
    right: 1px;
    top: 1px;
    width: 40px;
    height: 38px;
    background: #fff;
    display: block;
  }

  .multiselect__spinner::before,
  .multiselect__spinner::after {
    position: absolute;
    content: "";
    top: 50%;
    left: 50%;
    margin: -8px 0 0 -8px;
    width: 16px;
    height: 16px;
    border-radius: 100%;
    border-color: #41b883 transparent transparent;
    border-style: solid;
    border-width: 2px;
    box-shadow: 0 0 0 1px transparent;
  }

  .multiselect__spinner::before {
    animation: spinning 2.4s cubic-bezier(0.41, 0.26, 0.2, 0.62);
    animation-iteration-count: infinite;
  }

  .multiselect__spinner::after {
    animation: spinning 2.4s cubic-bezier(0.51, 0.09, 0.21, 0.8);
    animation-iteration-count: infinite;
  }

  .multiselect__loading-enter-active,
  .multiselect__loading-leave-active {
    transition: opacity 0.4s ease-in-out;
    opacity: 1;
  }

  .multiselect__loading-enter,
  .multiselect__loading-leave-active {
    opacity: 0;
  }

  .multiselect,
  .multiselect__input,
  .multiselect__single {
    font-family: inherit;
    font-size: 16px;
    touch-action: manipulation;
  }

  .multiselect {
    box-sizing: content-box;
    display: block;
    position: relative;
    width: 100%;
    min-height: 40px;
    text-align: left;
    color: #35495e;
  }

  .multiselect * {
    box-sizing: border-box;
  }

  .multiselect:focus {
    outline: none;
  }

  .multiselect--disabled {
    background: #ededed;
    pointer-events: none;
    opacity: 0.6;
  }

  .multiselect--active {
    z-index: 50;
  }

  .multiselect--active:not(.multiselect--above) .multiselect__current,
  .multiselect--active:not(.multiselect--above) .multiselect__input,
  .multiselect--active:not(.multiselect--above) .multiselect__tags {
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
  }

  .multiselect--active .multiselect__select {
    transform: rotateZ(180deg);
  }

  .multiselect--above.multiselect--active .multiselect__current,
  .multiselect--above.multiselect--active .multiselect__input,
  .multiselect--above.multiselect--active .multiselect__tags {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
  }

  .multiselect__input,
  .multiselect__single {
    position: relative;
    display: inline-block;
    min-height: 20px;
    line-height: 20px;
    border: none;
    border-radius: 5px;
    background: #fff;
    padding: 0 0 0 5px;
    width: calc(100%);
    transition: border 0.1s ease;
    box-sizing: border-box;
    margin-bottom: 8px;
    vertical-align: top;
  }

  .multiselect__input::placeholder {
    color: #35495e;
  }

  .multiselect__tag ~ .multiselect__input,
  .multiselect__tag ~ .multiselect__single {
    width: auto;
  }

  .multiselect__input:hover,
  .multiselect__single:hover {
    border-color: #cfcfcf;
  }

  .multiselect__input:focus,
  .multiselect__single:focus {
    border-color: #a8a8a8;
    outline: none;
  }

  .multiselect__single {
    padding-left: 5px;
    margin-bottom: 8px;
  }

  .multiselect__tags-wrap {
    display: inline;
  }

  .multiselect__tags {
    min-height: 40px;
    display: block;
    padding: 8px 40px 0 8px;
    border-radius: 5px;
    border: 1px solid #e8e8e8;
    background: #fff;
    font-size: 14px;
  }

  .multiselect__tag {
    position: relative;
    display: inline-block;
    padding: 4px 26px 4px 10px;
    border-radius: 5px;
    margin-right: 10px;
    color: #fff;
    line-height: 1;
    background: #41b883;
    margin-bottom: 5px;
    white-space: nowrap;
    overflow: hidden;
    max-width: 100%;
    text-overflow: ellipsis;
  }

  .multiselect__tag-icon {
    cursor: pointer;
    margin-left: 7px;
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
    font-weight: 700;
    font-style: initial;
    width: 22px;
    text-align: center;
    line-height: 22px;
    transition: all 0.2s ease;
    border-radius: 5px;
  }

  .multiselect__tag-icon::after {
    content: "×";
    color: #266d4d;
    font-size: 14px;
  }

  /* // Remove these lines to avoid green closing button
  //.multiselect__tag-icon:focus,
  //.multiselect__tag-icon:hover {
  //  background: #369a6e;
  //} */

  .multiselect__tag-icon:focus::after,
  .multiselect__tag-icon:hover::after {
    color: white;
  }

  .multiselect__current {
    line-height: 16px;
    min-height: 40px;
    box-sizing: border-box;
    display: block;
    overflow: hidden;
    padding: 8px 12px 0;
    padding-right: 30px;
    white-space: nowrap;
    margin: 0;
    text-decoration: none;
    border-radius: 5px;
    border: 1px solid #e8e8e8;
    cursor: pointer;
  }

  .multiselect__select {
    line-height: 16px;
    display: block;
    position: absolute;
    box-sizing: border-box;
    width: 40px;
    height: 38px;
    right: 1px;
    top: 1px;
    padding: 4px 8px;
    margin: 0;
    text-decoration: none;
    text-align: center;
    cursor: pointer;
    transition: transform 0.2s ease;
  }

  .multiselect__select::before {
    position: relative;
    right: 0;
    top: 65%;
    color: #999;
    margin-top: 4px;
    border-style: solid;
    border-width: 5px 5px 0 5px;
    border-color: #999 transparent transparent transparent;
    content: "";
  }

  .multiselect__placeholder {
    color: #adadad;
    display: inline-block;
    margin-bottom: 10px;
    padding-top: 2px;
  }

  .multiselect--active .multiselect__placeholder {
    display: none;
  }

  .multiselect__content-wrapper {
    position: absolute;
    display: block;
    background: #fff;
    width: 100%;
    max-height: 240px;
    overflow: auto;
    border: 1px solid #e8e8e8;
    border-top: none;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
    z-index: 50;
    -webkit-overflow-scrolling: touch;
  }

  .multiselect__content {
    list-style: none;
    display: inline-block;
    padding: 0;
    margin: 0;
    min-width: 100%;
    vertical-align: top;
  }

  .multiselect--above .multiselect__content-wrapper {
    bottom: 100%;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    border-bottom: none;
    border-top: 1px solid #e8e8e8;
  }

  .multiselect__content::-webkit-scrollbar {
    display: none;
  }

  .multiselect__element {
    display: block;
  }

  .multiselect__option {
    display: block;
    padding: 12px;
    min-height: 40px;
    line-height: 16px;
    text-decoration: none;
    text-transform: none;
    vertical-align: middle;
    position: relative;
    cursor: pointer;
    white-space: nowrap;
  }

  .multiselect__option::after {
    top: 0;
    right: 0;
    position: absolute;
    line-height: 40px;
    padding-right: 12px;
    padding-left: 20px;
    font-size: 13px;
  }

  .multiselect__option--highlight {
    background: #41b883;
    outline: none;
    color: white;
  }

  .multiselect__option--highlight::after {
    content: attr(data-select);
    background: #41b883;
    color: white;
  }

  .multiselect__option--selected {
    background: #f3f3f3;
    color: #35495e;
    font-weight: bold;
  }

  .multiselect__option--selected::after {
    content: attr(data-selected);
    color: silver;
  background: inherit;
  }

  .multiselect__option--selected.multiselect__option--highlight {
    background: #ff6a6a;
    color: #fff;
  }

  .multiselect__option--selected.multiselect__option--highlight::after {
    background: #ff6a6a;
    content: attr(data-deselect);
    color: #fff;
  }

  .multiselect--disabled .multiselect__current,
  .multiselect--disabled .multiselect__select {
    background: #ededed;
    color: #a6a6a6;
  }

  .multiselect__option--disabled {
    background: #ededed !important;
    color: #a6a6a6 !important;
    cursor: text;
    pointer-events: none;
  }

  .multiselect__option--group {
    background: #ededed;
    color: #35495e;
  }

  .multiselect__option--group.multiselect__option--highlight {
    background: #35495e;
    color: #fff;
  }

  .multiselect__option--group.multiselect__option--highlight::after {
    background: #35495e;
  }

  .multiselect__option--disabled.multiselect__option--highlight {
    background: #dedede;
  }

  .multiselect__option--group-selected.multiselect__option--highlight {
    background: #ff6a6a;
    color: #fff;
  }

  .multiselect__option--group-selected.multiselect__option--highlight::after {
    background: #ff6a6a;
    content: attr(data-deselect);
    color: #fff;
  }

  .multiselect-enter-active,
  .multiselect-leave-active {
    transition: all 0.15s ease;
  }

  .multiselect-enter,
  .multiselect-leave-active {
    opacity: 0;
  }

  .multiselect__strong {
    margin-bottom: 8px;
    line-height: 20px;
    display: inline-block;
    vertical-align: top;
  }

  *[dir="rtl"] .multiselect {
    text-align: right;
  }

  *[dir="rtl"] .multiselect__select {
    right: auto;
    left: 1px;
  }

  *[dir="rtl"] .multiselect__tags {
    padding: 8px 8px 0 40px;
  }

  *[dir="rtl"] .multiselect__content {
    text-align: right;
  }

  *[dir="rtl"] .multiselect__option::after {
    right: auto;
    left: 0;
  }

  *[dir="rtl"] .multiselect__clear {
    right: auto;
    left: 12px;
  }

  *[dir="rtl"] .multiselect__spinner {
    right: auto;
    left: 1px;
  }

  @keyframes spinning {
    from {
      transform: rotate(0);
    }

    to {
      transform: rotate(2turn);
    }
  }

</style>
