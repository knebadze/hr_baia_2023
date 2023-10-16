<template lang="">
    <div class="col-xl-9 col-lg-8 col-md-12 m-b30 employerPageBorder">
        <div class="twm-right-section-panel site-bg-gray">
                <!--Resume Headline-->
                <div v-if="data.get_work_information.length > 1" class="panel panel-default mb-3">
                    <div class="panel-heading wt-panel-heading p-a20 panel-heading-with-btn ">
                        <h4 class="panel-tittle m-a0">თქვენ გაქვთ <b>{{ data.get_work_information.length }}</b> რეზიუმე </h4>
                        <a data-bs-toggle="modal" href="#Resume_Headline" role="button" title="Edit" class="site-text-primary">
                        </a>
                    </div>

                    <a v-for="(item, index) in data.get_work_information"
                        :key="index"
                        style="margin-right:1%; margin-top:1%;"
                        :class="workInformation.id == item.id ? 'btn btn-success': 'btn btn-outline-success'"
                        href="javascript:void(0)"
                        @click="chooseResume(item)"
                    >{{ item.category[`name_${getLang}`] }}</a>

                </div>

                <!-- resume-body-->
                <div id="resume-body" >
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
                                            <span class="twm-s-info-discription">{{ data.nationality[`name_${getLang}`] }}</span>
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
                                            <span class="twm-s-info-discription">{{ data.citizenship.map(i => i.name_ka).join(', ') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">Marital Status</div>
                                            <span class="twm-s-info-discription">{{ data.marital_status[`name_${getLang}`] }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">Permanent Address</div>
                                            <span class="twm-s-info-discription">{{ data.address+' '+ data.street}}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">Passport Number</div>
                                            <span class="twm-s-info-discription">{{ data.personal_number }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">რელიგია</div>
                                            <span class="twm-s-info-discription">{{ data.religion[`name_${getLang}`] }}</span>
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
                                            <span class="twm-s-info-discription">{{ data.height }} სმ.</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">წონა</div>
                                            <span class="twm-s-info-discription">{{ data.weight }} კგ.</span>
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
                                            <span class="twm-s-info-discription">{{ data.characteristic.map(i => i.name_ka).join(', ') }}</span>
                                        </div>
                                    </div>

                                    <!-- <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">ნასამართლეობა</div>
                                            <span class="twm-s-info-discription">{{ (data.convection == 1)?data.yesNo[0][`name_${getLang}`]:data.yesNo[1][`name_${getLang}`] }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">მწეველი</div>
                                            <span class="twm-s-info-discription">{{ (data.smoke == 1)?data.yesNo[0][`name_${getLang}`]:data.yesNo[1][`name_${getLang}`] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">იმუშავებდით საზღარგარეთ</div>
                                            <span class="twm-s-info-discription">{{ (data.work_abroad == 1)?data.yesNo[0][`name_${getLang}`]:data.yesNo[1][`name_${getLang}`] }}</span>
                                        </div>
                                    </div> -->


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
                                            <span class="twm-s-info-discription">{{ data.education[`name_${getLang}`] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">პროფესია</div>
                                            <span class="twm-s-info-discription">{{ data.professions.map(i => i.name_ka).join(', ') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">სპეციალობა</div>
                                            <span class="twm-s-info-discription">{{ data.specialty.map(i => i.name_ka).join(', ') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">უცხო ენები</div>
                                            <span class="twm-s-info-discription">{{ data.get_language.map(i => i.language.name_ka+ ' - '+ i.level.name_ka ).join(', ') }}</span>
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
                                            <span  class="twm-s-info-discription">{{ data.allergy.map(i => i.name_ka).join(', ') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">ქრონიკული დაავადება ან მნიშვნელოვანი ოპერაცია</div>
                                            <span class="twm-s-info-discription">{{ data.medical_info }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p><a class="site-text-primary" href="javascript:;">სამედიცინო დოკუმენტი</a></p>
                        </div>

                    </div>

                    <!--ოხახური მდგომარეობა-->
                    <div v-if="data.marital_status_id != 1" class="panel panel-default mb-3">
                        <div class="panel-heading wt-panel-heading p-a20 panel-heading-with-btn ">
                            <h4 class="panel-tittle m-a0">ინფორმაცია ოჯახის შესახებ</h4>

                        </div>
                        <div class="panel-body wt-panel-body p-a20 ">
                            <div class="twm-panel-inner">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">შვილების რაოდენობა</div>
                                            <span class="twm-s-info-discription">{{ data.children }}</span>
                                        </div>
                                    </div>

                                    <div v-if="data.children != null || data.children != 0" class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">შვილების ასაკი</div>
                                            <span class="twm-s-info-discription">{{ data.children_age }} კგ.</span>
                                        </div>
                                    </div>

                                    <div v-if="data.marital_status_id == 2" class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">ინფორმაცია მეუღლეზე</div>
                                            <span class="twm-s-info-discription">{{ data.spouse }}</span>
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
                            <div v-for="(item, index) in data.general_work_experience" :key="index" class="col-md-6">
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
                                            <span class="twm-s-info-discription">{{ workInformation.get_work_schedule.map(i => i.work_schedule.name_ka).join(', ') }}</span>
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
                                            <span class="twm-s-info-discription">{{ data.family_work_experience.families_worked_count }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">მუშაობის ხანგრძლივობა ჯამში</div>
                                            <span class="twm-s-info-discription">{{ data.family_work_experience.longest[`name_${getLang}`] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">ყველაზე ხანგძლივად</div>
                                            <span class="twm-s-info-discription">{{ data.family_work_experience.work_experience[`name_${getLang}`] }}</span>
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
                            <h4 class="panel-tittle m-a0">ოჯახში მუშაობის დროს მევალებოდა</h4>

                        </div>
                        <div class="panel-body wt-panel-body p-a20 ">
                            <div class="tw-sidebar-tags-wrap">
                                <div class="tagcloud">
                                    <a v-for="item in data.family_work_experience.family_work_duty" href="javascript:void(0)">{{ item[`name_${getLang}`] }}</a>
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
                                    <div v-for="(item, index) in data.recommendation" :key="index" class="col-md-6">
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">საიდან?</div>
                                            <span class="twm-s-info-discription">{{ item[`name_${getLang}`] }}</span>
                                        </div>
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">სახელი გვარი</div>
                                            <span class="twm-s-info-discription">{{ item.pivot[`name_${getLang}`] }}</span>
                                        </div>
                                        <div v-if="item.id == 2" class="twm-s-detail-section">
                                            <div class="twm-title">თანამდებობა</div>
                                            <span class="twm-s-info-discription">{{ item.pivot[`position_${getLang}`] }}</span>
                                        </div>
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">ნომერი</div>
                                            <span class="twm-s-info-discription">{{ item.pivot.number }}</span>
                                        </div>
                                        <div class="twm-s-detail-section">
                                            <div class="twm-title">ფაილი</div>
                                            <p><a class="site-text-primary" href="javascript:;"><u class="text-primary" @click="openPDF(item.pivot.file_path)">{{ item.pivot.file_name }}</u></a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--notice-->
                    <div class="panel panel-default mb-3">
                        <div class="panel-heading wt-panel-heading p-a20 panel-heading-with-btn ">
                            <h4 class="panel-tittle m-a0">დოკუმენტები</h4>

                        </div>
                        <div class="panel-body wt-panel-body p-a20 ">
                            <div class="tw-sidebar-tags-wrap">
                                <div class="tagcloud">
                                    <a v-for="item in data.get_notice" href="javascript:;" @click="openPDF(item.file_path)">{{ item.notice[`name_${getLang}`] }}</a>
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
        }
    },
    created(){
        console.log(this.data);
        this.addLanguageLevel
        if(this.data.get_work_information.length > 0){
            this.chooseResume(this.data.get_work_information[0])
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
            return this.data.get_work_information[0].category[`name_${this.getLang}`]

        },
        showMainBody(){
            if (Object.keys(this.workInformation).length != 0) {
                return true
            }
            return false
        }
    },
    methods:{
        openPDF(item) {
            const pdfUrl = `/storage/${item}`;
            window.open(pdfUrl, '_blank');
        },
        chooseResume(item){
            this.workInformation = item
        }
    },
    mounted() {
    },
}
</script>
<style lang="">

</style>
