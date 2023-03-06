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

                </div>



                <!--IT Skills-->
                <div class="panel panel-default mb-3">
                    <div class="panel-heading wt-panel-heading p-a20 panel-heading-with-btn ">
                        <h4 class="panel-tittle m-a0">IT Skills</h4>
                        <a data-bs-toggle="modal" href="#IT_skills" role="button" title="Edit" class="site-text-primary">
                            <span class="fa fa-edit"></span>
                        </a>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 ">
                        <div class="twm-panel-inner">
                            <p>Mention your employment detail including your current and previous company work experience</p>
                            <div class="table-responsive">
                                <table class="table twm-table table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th>Skills</th>
                                        <th>Version</th>
                                        <th>Last Used</th>
                                        <th>Experience</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <!--1-->
                                    <tr>
                                        <td>Python</td>
                                        <td>13</td>
                                        <td>2020</td>
                                        <td>1 Year</td>
                                        <td>
                                            <a data-bs-toggle="modal" href="#IT_skills" role="button" title="Edit" class="site-text-primary">
                                                <span class="fa fa-edit"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    <!--2-->
                                    <tr>
                                        <td>Bootstrap</td>
                                        <td>5</td>
                                        <td>2021</td>
                                        <td>1 Year</td>
                                        <td>
                                            <a data-bs-toggle="modal" href="#IT_skills" role="button" title="Edit" class="site-text-primary">
                                                <span class="fa fa-edit"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    <!--3-->
                                    <tr>
                                        <td>HTML</td>
                                        <td>5</td>
                                        <td>2020</td>
                                        <td>1 Year</td>
                                        <td>
                                            <a data-bs-toggle="modal" href="#IT_skills" role="button" title="Edit" class="site-text-primary">
                                                <span class="fa fa-edit"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    <!--4-->
                                    <tr>
                                        <td>Photoshop</td>
                                        <td>CC-2022</td>
                                        <td>2022</td>
                                        <td>1 Year</td>
                                        <td>
                                            <a data-bs-toggle="modal" href="#IT_skills" role="button" title="Edit" class="site-text-primary">
                                                <span class="fa fa-edit"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    <!--5-->
                                    <tr>
                                        <td>Css</td>
                                        <td>3</td>
                                        <td>2018</td>
                                        <td>1 Year</td>
                                        <td>
                                            <a data-bs-toggle="modal" href="#IT_skills" role="button" title="Edit" class="site-text-primary">
                                                <span class="fa fa-edit"></span>
                                            </a>
                                        </td>
                                    </tr>

                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!--IT_skills -->
                    <div class="modal fade twm-saved-jobs-view" id="IT_skills" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form>

                                    <div class="modal-header">
                                        <h2 class="modal-title">IT Skills</h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">

                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12">
                                                <div class="form-group">
                                                    <label>IT Skills</label>
                                                    <div class="ls-inputicon-box">
                                                        <input class="form-control"  type="text" placeholder="Enter IT Skills">
                                                        <i class="fs-input-icon fa fa-address-card"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-6 col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label>Version</label>
                                                    <div class="ls-inputicon-box">
                                                        <input class="form-control"  type="text" placeholder="Enter Version">
                                                        <i class="fs-input-icon fa fa-info"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-6 col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label>Last Used</label>
                                                    <div class="ls-inputicon-box">
                                                        <select class="wt-select-box selectpicker"  data-live-search="true" title=""  data-bv-field="size">
                                                            <option class="bs-title-option" value="">Select Category</option>
                                                            <option>2021</option>
                                                            <option>2020</option>
                                                        </select>
                                                        <i class="fs-input-icon fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-6 col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label>Experience year</label>
                                                    <div class="ls-inputicon-box">
                                                        <select class="wt-select-box selectpicker"  data-live-search="true" title=""  data-bv-field="size">
                                                            <option class="bs-title-option" value="">Select Category</option>
                                                            <option>2021</option>
                                                            <option>2020</option>
                                                        </select>
                                                        <i class="fs-input-icon fa fa-user-edit"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-6 col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label>Month</label>
                                                    <div class="ls-inputicon-box">
                                                        <select class="wt-select-box selectpicker"  data-live-search="true" title=""  data-bv-field="size">
                                                            <option class="bs-title-option" value="">Select Category</option>
                                                            <option>January</option>
                                                            <option>February</option>
                                                        </select>
                                                        <i class="fs-input-icon fa fa-user-edit"></i>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                    </div>

                                    <div class="modal-footer">

                                        <button type="button" class="site-button" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="site-button">Save</button>

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                </div>






                <!--Attach Resume-->
                <div class="panel panel-default mb-3">
                    <div class="panel-heading wt-panel-heading p-a20 panel-heading-with-btn ">
                        <h4 class="panel-tittle m-a0">Attach Resume</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 ">
                        <div class="twm-panel-inner">
                            <p>Resume is the most important document recruiters look for. Recruiters generally do not look at profiles without resumes.</p>
                            <div class="dashboard-cover-pic">
                                <form action="https://thewebmax.org/jobzilla/upload.php" class="dropzone"></form>
                                <p>Upload Resume File size is 3 MB</p>
                            </div>

                        </div>
                    </div>

                </div>

                <!--Accomplishments-->
                <div class="panel panel-default mb-3">
                    <div class="panel-heading wt-panel-heading p-a20 panel-heading-with-btn ">
                        <h4 class="panel-tittle m-a0">Accomplishments</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 ">
                        <div class="twm-panel-inner">
                            <div class="twm-list-wrap">
                                <div class="twm-list-inner d-flex justify-content-between">
                                    <b>Online Profile</b>
                                    <a data-bs-toggle="modal" href="#Online_Profile" role="button" title="Edit" class="site-text-primary">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                </div>
                                <p>Add link to Online profiles (e.g. Linkedin, Facebook etc.).</p>
                            </div>
                            <!--Online Profile Modal -->
                            <div class="modal fade twm-saved-jobs-view" id="Online_Profile" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form>

                                            <div class="modal-header">
                                                <h2 class="modal-title">Online Profiles</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-xl-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label>Social Profile</label>
                                                            <div class="ls-inputicon-box">
                                                                <input class="form-control"  type="text" placeholder="Enter Social Profile Name">
                                                                <i class="fs-input-icon fa fa-address-card"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label>URL</label>
                                                            <div class="ls-inputicon-box">
                                                                <input class="form-control"  type="text" placeholder="Enter Url">
                                                                <i class="fs-input-icon fa fa-globe-americas"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group mb-0">
                                                            <label>Description</label>
                                                            <textarea class="form-control" rows="3" placeholder="Type Description"></textarea>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="modal-footer">

                                                <button type="button" class="site-button" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="site-button">Save</button>

                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="twm-list-wrap">
                                <div class="twm-list-inner d-flex justify-content-between">
                                    <b>Work Sample</b>
                                    <a data-bs-toggle="modal" href="#Work_Sample" role="button" title="Edit" class="site-text-primary">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                </div>
                                <p>Add link to your Projects (e.g. Github links etc.).</p>
                            </div>
                            <!--Work Sample Modal -->
                            <div class="modal fade twm-saved-jobs-view" id="Work_Sample" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form>

                                            <div class="modal-header">
                                                <h2 class="modal-title">Work Sample</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-xl-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label>Work Title</label>
                                                            <div class="ls-inputicon-box">
                                                                <input class="form-control"  type="text" placeholder="Enter Work Title">
                                                                <i class="fs-input-icon fa fa-address-card"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label>URL</label>
                                                            <div class="ls-inputicon-box">
                                                                <input class="form-control"  type="text" placeholder="Enter Url">
                                                                <i class="fs-input-icon fa fa-globe-americas"></i>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <!--Start Date-->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Duration From</label>
                                                            <div class="ls-inputicon-box">
                                                                <input class="form-control datepicker" data-provide="datepicker" name="company_since" type="text" placeholder="mm/dd/yyyy">
                                                                <i class="fs-input-icon far fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--End Date-->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Duration to</label>
                                                            <div class="ls-inputicon-box">
                                                                <input class="form-control datepicker" data-provide="datepicker" name="company_since" type="text" placeholder="mm/dd/yyyy">
                                                                <i class="fs-input-icon far fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12 col-lg-12">
                                                        <div class="form-group">
                                                            <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="Working_on" checked>
                                                            <label class="form-check-label" for="Working_on">
                                                                I am currently working on this
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group mb-0">
                                                            <label>Description</label>
                                                            <textarea class="form-control" rows="3" placeholder="Type Description"></textarea>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="modal-footer">

                                                <button type="button" class="site-button" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="site-button">Save</button>

                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="twm-list-wrap">
                                <div class="twm-list-inner d-flex justify-content-between">
                                    <b>White Paper / Research Publication / Journal Entry</b>
                                    <a data-bs-toggle="modal" href="#Research_Publication" role="button" title="Edit" class="site-text-primary">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                </div>
                                <p>Add links to your Online publications.</p>
                            </div>
                            <!--White Paper / Research Publication / Journal Entry Modal -->
                            <div class="modal fade twm-saved-jobs-view" id="Research_Publication" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form>

                                            <div class="modal-header">
                                                <h2 class="modal-title">White Paper / Research Publication / Journal Entry</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-xl-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label>Title</label>
                                                            <div class="ls-inputicon-box">
                                                                <input class="form-control"  type="text" placeholder="Title">
                                                                <i class="fs-input-icon fa fa-address-card"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label>URL</label>
                                                            <div class="ls-inputicon-box">
                                                                <input class="form-control"  type="text" placeholder="Enter Url">
                                                                <i class="fs-input-icon fa fa-globe-americas"></i>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <!--Start Date-->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Published On</label>
                                                            <div class="ls-inputicon-box">
                                                                <input class="form-control datepicker" data-provide="datepicker" name="company_since" type="text" placeholder="mm/dd/yyyy">
                                                                <i class="fs-input-icon far fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group mb-0">
                                                            <label>Description</label>
                                                            <textarea class="form-control" rows="3" placeholder="Type Description"></textarea>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="modal-footer">

                                                <button type="button" class="site-button" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="site-button">Save</button>

                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="twm-list-wrap">
                                <div class="twm-list-inner d-flex justify-content-between">
                                    <b>Presentation</b>
                                    <a data-bs-toggle="modal" href="#Presentation_modal" role="button" title="Edit" class="site-text-primary">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                </div>
                                <p>Add links to your Online presentations (e.g. Slideshare presentation links etc.).</p>
                            </div>
                            <!--Presentation Modal -->
                            <div class="modal fade twm-saved-jobs-view" id="Presentation_modal" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form>

                                            <div class="modal-header">
                                                <h2 class="modal-title">Presentation</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-xl-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label>Social Profile</label>
                                                            <div class="ls-inputicon-box">
                                                                <input class="form-control"  type="text" placeholder="Enter Social Profile Name">
                                                                <i class="fs-input-icon fa fa-address-card"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label>URL</label>
                                                            <div class="ls-inputicon-box">
                                                                <input class="form-control"  type="text" placeholder="Enter Url">
                                                                <i class="fs-input-icon fa fa-globe-americas"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group mb-0">
                                                            <label>Description</label>
                                                            <textarea class="form-control" rows="3" placeholder="Type Description"></textarea>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="modal-footer">

                                                <button type="button" class="site-button" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="site-button">Save</button>

                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="twm-list-wrap">
                                <div class="twm-list-inner d-flex justify-content-between">
                                    <b>Certification</b>
                                    <a data-bs-toggle="modal" href="#Certification_modal" role="button" title="Edit" class="site-text-primary">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                </div>
                                <p>Add details of Certification you have filed.</p>
                            </div>
                            <!--Certification Modal -->
                            <div class="modal fade twm-saved-jobs-view" id="Certification_modal" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form>

                                            <div class="modal-header">
                                                <h2 class="modal-title">Certification</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-xl-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label>Certification Name</label>
                                                            <div class="ls-inputicon-box">
                                                                <input class="form-control"  type="text" placeholder="Enter Certification Name">
                                                                <i class="fs-input-icon fa fa-address-card"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label>Certification Body</label>
                                                            <div class="ls-inputicon-box">
                                                                <input class="form-control"  type="text" placeholder="Enter Certification Body">
                                                                <i class="fs-input-icon fa fa-address-card"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12 col-lg-12">
                                                        <div class="form-group mb-0">
                                                            <label>Year Onlabel</label>
                                                            <div class="ls-inputicon-box">
                                                                <select class="wt-select-box selectpicker"  data-live-search="true" title=""  data-bv-field="size">
                                                                    <option class="bs-title-option" value="">Year</option>
                                                                    <option>2021</option>
                                                                    <option>2020</option>
                                                                    <option>2019</option>
                                                                    <option>2018</option>
                                                                    <option>2017</option>
                                                                    <option>2016</option>
                                                                    <option>2015</option>
                                                                    <option>2014</option>
                                                                    <option>2013</option>
                                                                    <option>2012</option>
                                                                    <option>2011</option>
                                                                </select>
                                                                <i class="fs-input-icon fa fa-calendar-alt"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="modal-footer">

                                                <button type="button" class="site-button" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="site-button">Save</button>

                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="twm-list-wrap">
                                <div class="twm-list-inner d-flex justify-content-between">
                                    <b>Patent</b>
                                    <a data-bs-toggle="modal" href="#Patent_modal" role="button" title="Edit" class="site-text-primary">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                </div>
                                <p>Add details of Patents you have filed.</p>
                            </div>
                            <!--Patent Modal -->
                            <div class="modal fade twm-saved-jobs-view" id="Patent_modal" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form>

                                            <div class="modal-header">
                                                <h2 class="modal-title">Patent</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-xl-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label>Title</label>
                                                            <div class="ls-inputicon-box">
                                                                <input class="form-control"  type="text" placeholder="Enter Title">
                                                                <i class="fs-input-icon fa fa-address-card"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label>Url</label>
                                                            <div class="ls-inputicon-box">
                                                                <input class="form-control"  type="text" placeholder="Enter Url ">
                                                                <i class="fs-input-icon fa fa-globe-americas"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label>Patent Office</label>
                                                            <div class="ls-inputicon-box">
                                                                <input class="form-control"  type="text" placeholder="Enter Patent Office">
                                                                <i class="fs-input-icon fa fa-building"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label>Application Number</label>
                                                            <div class="ls-inputicon-box">
                                                                <input class="form-control"  type="text" placeholder="Enter Application Number">
                                                                <i class="fs-input-icon fa fa-dice-d6"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <div class="row twm-form-radio-inline">

                                                                <div class="col-md-6">
                                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="Patent_Issued">
                                                                    <label class="form-check-label" for="Patent_Issued">
                                                                        Patent Issued
                                                                    </label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="Patent_pending" checked>
                                                                    <label class="form-check-label" for="Patent_pending">
                                                                        Patent pending
                                                                    </label>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--Start Date-->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Published On</label>
                                                            <div class="ls-inputicon-box">
                                                                <input class="form-control datepicker" data-provide="datepicker" name="company_since" type="text" placeholder="mm/dd/yyyy">
                                                                <i class="fs-input-icon far fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group mb-0">
                                                            <label>Description</label>
                                                            <textarea class="form-control" rows="3" placeholder="Type Description"></textarea>
                                                        </div>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="modal-footer">

                                                <button type="button" class="site-button" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="site-button">Save</button>

                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>



                </div>

                <!--Profile Summary-->
                <div class="panel panel-default mb-3">
                    <div class="panel-heading wt-panel-heading p-a20 panel-heading-with-btn ">
                        <h4 class="panel-tittle m-a0">Profile Summary</h4>
                        <a data-bs-toggle="modal" href="#Profile_Summary" role="button" title="Edit" class="site-text-primary">
                            <span class="fa fa-edit"></span>
                        </a>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 ">
                        <div class="twm-panel-inner">
                            <p>Your Profile Summary should mention the highlights of your career and education, what your professional interests are, and what kind of a career you are looking for. Write a meaningful summary of more than 50 characters.</p>
                        </div>
                    </div>
                    <!--Modal Popup -->
                    <div class="modal fade twm-saved-jobs-view" id="Profile_Summary" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form>

                                    <div class="modal-header">
                                        <h2 class="modal-title">Profile Summary</h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <p>Your Profile Summary should mention the highlights of your career and education, what your professional interests are, and what kind of a career you are looking for. Write a meaningful summary of more than 50 characters.</p>

                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group twm-textarea-full">
                                                    <textarea class="form-control" placeholder="Detail of Project"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="modal-footer">

                                        <button type="button" class="site-button" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="site-button">Save</button>

                                    </div>

                                </form>
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
