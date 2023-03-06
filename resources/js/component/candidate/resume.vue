<template lang="">
    <div class="col-xl-9 col-lg-8 col-md-12 m-b30">
        <div class="twm-right-section-panel site-bg-gray">
                <!--Resume Headline-->
                <div v-if="data.workInformation.length > 1" class="panel panel-default mb-3">
                    <div class="panel-heading wt-panel-heading p-a20 panel-heading-with-btn ">
                        <h4 class="panel-tittle m-a0">თქვენ გაქვთ <b>{{ data.workInformation.length }}</b> რეზიუმე </h4>
                        <a data-bs-toggle="modal" href="#Resume_Headline" role="button" title="Edit" class="site-text-primary">
                            <!-- <span class="fa fa-edit"></span> -->
                        </a>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 ">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                               {{ (categoryName == null)?'აირჩიეთ კატეგორია':categoryName }}
                            </button>
                            <ul class="dropdown-menu">
                                <li v-for="(item, index) in data.workInformation" :key="index"><a class="dropdown-item" href="javascript:void(0)" @click="chooseResume(item)">{{ item.category[`name_${getLang}`] }}</a></li>
                                <!-- <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                            </ul>
                        </div>

                    </div>
                </div>

                <!-- resume-body -->
                <div id="resume-body" v-if="showMainBody">
                     <!--Resume Headline-->
                    <div class="panel panel-default mb-3">
                        <div class="panel-heading wt-panel-heading p-a20 panel-heading-with-btn ">
                            <h4 class="panel-tittle m-a0">რეზიუმეს სათაური</h4>
                            <!-- <a data-bs-toggle="modal" href="#Resume_Headline" role="button" title="Edit" class="site-text-primary">
                                <span class="fa fa-edit"></span>
                            </a> -->
                        </div>
                        <div class="panel-body wt-panel-body p-a20 ">
                            <div class="twm-panel-inner">
                                <h3>{{ headLine }}</h3>
                            </div>
                        </div>
                    </div>
                    <!--Personal Details-->
                    <div class="panel panel-default mb-3">
                        <div class="panel-heading wt-panel-heading p-a20 panel-heading-with-btn ">
                            <h4 class="panel-tittle m-a0">Personal Details</h4>

                        </div>
                        <div class="panel-body wt-panel-body p-a20 ">
                            <div class="twm-panel-inner">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">სახელი გვარი</div>
                                            <span class="twm-s-info-discription">{{ data.user[`name_${getLang}`] }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">ტელეფონის ნომერი</div>
                                            <span class="twm-s-info-discription">{{ data.user.number }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">Date of Birth</div>
                                            <span class="twm-s-info-discription">{{ data.user.date_of_birth }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">ეროვნება</div>
                                            <span class="twm-s-info-discription">{{ data.candidate.nationality[`name_${getLang}`] }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">Gender</div>
                                            <span class="twm-s-info-discription">{{ data.user.gender[`name_${getLang}`] }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">მოქალაქეობა</div>
                                            <span v-for="(item, index) in data.candidate.citizenship" :key="index" class="twm-s-info-discription">{{ item[`name_${getLang}`]+', ' }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">Marital Status</div>
                                            <span class="twm-s-info-discription">{{ data.candidate.marital_status[`name_${getLang}`] }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">Permanent Address</div>
                                            <span class="twm-s-info-discription">{{ data.candidate.address+' '+ data.candidate.street}}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">Passport Number</div>
                                            <span class="twm-s-info-discription">{{ data.candidate.personal_number }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">რელიგია</div>
                                            <span class="twm-s-info-discription">{{ data.candidate.religion[`name_${getLang}`] }}</span>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>

                    </div>

                    <!--Additional Details-->
                    <div class="panel panel-default mb-3">
                        <div class="panel-heading wt-panel-heading p-a20 panel-heading-with-btn ">
                            <h4 class="panel-tittle m-a0">დამატაბითი ინფორმაცია</h4>

                        </div>
                        <div class="panel-body wt-panel-body p-a20 ">
                            <div class="twm-panel-inner">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">სიმაღლე</div>
                                            <span class="twm-s-info-discription">{{ data.candidate.height }} სმ.</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">წონა</div>
                                            <span class="twm-s-info-discription">{{ data.candidate.weight }} კგ.</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">ასაკი</div>
                                            <span class="twm-s-info-discription">{{ age }} წლის</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">მახასიათებლები</div>
                                            <span v-for="(item, index) in data.candidate.characteristic" :key="index" class="twm-s-info-discription">{{ item[`name_${getLang}`]+', ' }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">ნასამართლეობა</div>
                                            <span class="twm-s-info-discription">{{ (data.candidate.convection == 1)?data.yesNo[0][`name_${getLang}`]:data.yesNo[1][`name_${getLang}`] }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">მწეველი</div>
                                            <span class="twm-s-info-discription">{{ (data.candidate.smoke == 1)?data.yesNo[0][`name_${getLang}`]:data.yesNo[1][`name_${getLang}`] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">იმუშავებდით საზღარგარეთ</div>
                                            <span class="twm-s-info-discription">{{ (data.candidate.work_abroad == 1)?data.yesNo[0][`name_${getLang}`]:data.yesNo[1][`name_${getLang}`] }}</span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Education-->
                    <div class="panel panel-default mb-3">
                        <div class="panel-heading wt-panel-heading p-a20 panel-heading-with-btn ">
                            <h4 class="panel-tittle m-a0">განათლება</h4>

                        </div>
                        <div class="panel-body wt-panel-body p-a20 ">
                            <div class="twm-panel-inner">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">განათლება</div>
                                            <span class="twm-s-info-discription">{{ data.candidate.education[`name_${getLang}`] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">პროფესია</div>
                                            <span v-for="(item, index) in data.candidate.professions" :key="index" class="twm-s-info-discription">{{ item[`name_${getLang}`]+', ' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">სპეციალობა</div>
                                            <span v-for="(item, index) in data.candidate.specialty" :key="index" class="twm-s-info-discription">{{ item[`name_${getLang}`]+', ' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">უცხო ენები</div>
                                            <span v-for="(item, index) in data.candidate.languages" :key="index" class="twm-s-info-discription"><b>{{ item[`name_${getLang}`]+'-' }}</b>{{ item.language_level[`name_${getLang}`]+', ' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <p><a class="site-text-primary" href="javascript:;">დიპლომი</a></p>
                            </div>
                        </div>

                    </div>

                    <!--სამედიცინო ინფორმაცია-->
                    <div class="panel panel-default mb-3">
                        <div class="panel-heading wt-panel-heading p-a20 panel-heading-with-btn ">
                            <h4 class="panel-tittle m-a0">სამედიცინო ინფორმაცია</h4>

                        </div>
                        <div class="panel-body wt-panel-body p-a20 ">
                            <div class="twm-panel-inner">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">ალერგია</div>
                                            <span v-for="(item, index) in data.candidate.allergy" :key="index" class="twm-s-info-discription">{{ item[`name_${getLang}`]+', ' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">ქრონიკული დაავადება ან მნიშვნელოვანი ოპერაცია</div>
                                            <span class="twm-s-info-discription">{{ data.candidate.medical_info }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p><a class="site-text-primary" href="javascript:;">სამედიცინო დოკუმენტი</a></p>
                        </div>

                    </div>

                    <!--ოხახური მდგომარეობა-->
                    <div v-if="data.candidate.marital_status_id != 1" class="panel panel-default mb-3">
                        <div class="panel-heading wt-panel-heading p-a20 panel-heading-with-btn ">
                            <h4 class="panel-tittle m-a0">ინფორმაცია ოჯახის შესახებ</h4>

                        </div>
                        <div class="panel-body wt-panel-body p-a20 ">
                            <div class="twm-panel-inner">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">შვილების რაოდენობა</div>
                                            <span class="twm-s-info-discription">{{ data.candidate.children }}</span>
                                        </div>
                                    </div>

                                    <div v-if="data.candidate.children != null || data.candidate.children != 0" class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">შვილების ასაკი</div>
                                            <span class="twm-s-info-discription">{{ data.candidate.children_age }} კგ.</span>
                                        </div>
                                    </div>

                                    <div v-if="data.candidate.marital_status_id == 2" class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">ინფორმაცია მეუღლეზე</div>
                                            <span class="twm-s-info-discription">{{ data.candidate.spouse }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Employment-->
                    <div class="panel panel-default mb-3">
                        <div class="panel-heading wt-panel-heading p-a20 panel-heading-with-btn ">
                            <h4 class="panel-tittle m-a0">ზოგადი სამუშაო გამოცდილება</h4>

                        </div>
                        <div class="row">
                            <div v-for="(item, index) in data.candidate.general_work_experience" :key="index" class="col-md-6">
                                <div  v-if="item.pivot.experience == 1" class="panel-body wt-panel-body p-a20">
                                    <div class="twm-panel-inner">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">პოზიცია</div>
                                            <span class="twm-s-info-discription">{{ item.pivot.position }}</span>
                                        </div>
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">ობიექტი</div>
                                            <span class="twm-s-info-discription">{{ item.pivot.object }}</span>
                                        </div>
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">ხანგრძლივობა</div>
                                            <span class="twm-s-info-discription">{{ item[`name_${getLang}`] }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- -->
                            </div>
                            <div v-if="data.generalWorkNoExperience && data.generalWorkNoExperience.experience == 2" class="col-md-12">
                                <div  class="panel-body wt-panel-body p-a20 ">
                                    <div class="twm-panel-inner">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">მიზეზი</div>
                                            <span class="twm-s-info-discription">{{ data.generalWorkNoExperience.no_reason[`name_${getLang}`] }}</span>
                                        </div>
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">დამატებითი ინფორმაცია</div>
                                            <span class="twm-s-info-discription">{{ data.generalWorkNoExperience.no_reason_info }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!--family Employment-->
                    <div class="panel panel-default mb-3">
                        <div class="panel-heading wt-panel-heading p-a20 panel-heading-with-btn ">
                            <h4 class="panel-tittle m-a0">სამუშაო ინფორმაცია</h4>

                        </div>
                        <div class="panel-body wt-panel-body p-a20 ">
                            <div class="twm-panel-inner">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">გრაფიკი</div>
                                            <span v-for="(item, index) in workInformation.work_schedule" :key="index" class="twm-s-info-discription">{{ item[`name_${getLang}`]+', ' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">ანაზღაურება</div>
                                            <span class="twm-s-info-discription">{{ workInformation.payment }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">ვალუტა</div>
                                            <span class="twm-s-info-discription">{{ workInformation.currency[`name_${getLang}`] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--family Employment-->
                    <div class="panel panel-default mb-3">
                        <div class="panel-heading wt-panel-heading p-a20 panel-heading-with-btn ">
                            <h4 class="panel-tittle m-a0">ოჯახში მუშაობის გამოცდილება</h4>

                        </div>
                        <div class="panel-body wt-panel-body p-a20 ">
                            <div class="twm-panel-inner">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">რამდენ ოჯახში გიმუშავით</div>
                                            <span class="twm-s-info-discription">{{ data.candidate.family_work_experience.families_worked_count }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">მუშაობის ხანგრძლივობა ჯამში</div>
                                            <span class="twm-s-info-discription">{{ data.candidate.family_work_experience.longest[`name_${getLang}`] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">ყველაზე ხანგძლივად</div>
                                            <span class="twm-s-info-discription">{{ data.candidate.family_work_experience.work_experience[`name_${getLang}`] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">ოჯახში მუშაობდით</div>
                                            <span v-for="(item, index) in data.familyWorkSkillCategory" :key="index" class="twm-s-info-discription">{{ item[`name_${getLang}`]+', ' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Key Skills-->
                    <div class="panel panel-default mb-3">
                        <div class="panel-heading wt-panel-heading p-a20 panel-heading-with-btn ">
                            <h4 class="panel-tittle m-a0">სქილები</h4>

                        </div>
                        <div class="panel-body wt-panel-body p-a20 ">
                            <div class="tw-sidebar-tags-wrap">
                                <div class="tagcloud">
                                    <a v-for="item in data.candidate.family_work_skill" href="javascript:void(0)">{{ item[`name_${getLang}`] }}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--recommendation-->
                    <div class="panel panel-default mb-3">
                        <div class="panel-heading wt-panel-heading p-a20 panel-heading-with-btn ">
                            <h4 class="panel-tittle m-a0">რეკომენდაცია</h4>

                        </div>
                        <div class="panel-body wt-panel-body p-a20 ">
                            <div class="twm-panel-inner">
                                <div class="row">
                                    <div v-for="(item, index) in data.candidate.recommendation" :key="index" class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">საიდან?</div>
                                            <span class="twm-s-info-discription">{{ item[`name_${getLang}`] }}</span>
                                        </div>
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">სახელი გვარი</div>
                                            <span class="twm-s-info-discription">{{ item.pivot.name }}</span>
                                        </div>
                                        <div v-if="item.id == 2" class="twm-s-detail-section">
                                            <div class="twm-title">თანამდებობა</div>
                                            <span class="twm-s-info-discription">{{ item.pivot.position }}</span>
                                        </div>
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">ნომერი</div>
                                            <span class="twm-s-info-discription">{{ item.pivot.number }}</span>
                                        </div>
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">ფაილი</div>
                                            <p><a class="site-text-primary" href="javascript:;">{{ item.pivot.file }}</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

        </div>
    </div>
</template>
<script>
import _ from 'lodash'
import axios, { Axios } from 'axios'
export default {
    props:{
        data: Object
    },
    data() {
        return {
            // show: false
            workInformation:{},
            categoryName:null,
        }
    },
    created(){
        this.addLanguageLevel
        if(this.data.workInformation.length == 1){
            this.chooseResume(this.data.workInformation[0])
        }
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
        age(){
            var dob = new Date(this.data.user.date_of_birth)
            var diff_ms = Date.now() - dob.getTime();
            var age_dt = new Date(diff_ms);

            return Math.abs(age_dt.getUTCFullYear() - 1970);
        },
        headLine(){
            if (Object.keys(this.workInformation).length != 0) {
                // console.log('this.workInformation', this.workInformation);
                return this.workInformation.category[`name_${this.getLang}`]
            }
        },
        addLanguageLevel(){
            this.data.candidate.languages.forEach(element => {
               var find =  _.find(this.data.languageLevel, function(o) { return o.id == element.pivot.language_level_id; });
                element['language_level'] = find
            });
        },
        showMainBody(){
            if (Object.keys(this.workInformation).length != 0) {
                return true
            }
            return false
        }
    },
    methods:{
        chooseResume(item){
            console.log(item);
            this.categoryName = item.category[`name_${this.getLang}`]
            console.log('this.categoryName', this.categoryName);
            axios.post('/resume_data' ,{
                id: item.id,
            })
            .then((response)=> {
                if (response.status == 200) {
                    console.log('response.data', response.data);
                    this.workInformation = response.data
                }

            })
            .catch(function (error) {
                this.output = error;
            });
        }
    },
    mounted() {
        console.log('data', this.data);
    },
}
</script>
<style lang="">

</style>
