<template lang="">
    <div class="col-xl-9 col-lg-8 col-md-12 m-b30">
        <!--Filter Short By-->
        <div class="twm-right-section-panel site-bg-gray">
            <!-- <form> -->


                <!--Basic Information-->
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">Basic Informations</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">
                        <form @submit.prevent="authUpdate()">
                            <div class="row">

                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Your Name</label>
                                            <div class="ls-inputicon-box">
                                                <input class="form-control" name="name_ka"  v-model="auth[`name_${getLang}`]"  type="text" placeholder="">
                                                <i class="fs-input-icon fa fa-user "></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <div class="ls-inputicon-box">
                                                <input class="form-control" name="company_phone" v-model="auth.number" type="text" >
                                                <i class="fs-input-icon fa fa-phone-alt"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <div class="ls-inputicon-box">
                                                <input class="form-control" name="company_Email" v-model="auth.email" type="email" placeholder="">
                                                <i class="fs-input-icon fas fa-at"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Date of birth</label>
                                            <div class="ls-inputicon-box">
                                                <input class="form-control d" data-provide="" name="company_since" type="date" v-model="auth.date_of_birth" placeholder="mm/dd/yyyy">
                                                <i class="fs-input-icon far fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Gender-->
                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <div class="ls-inputicon-box">
                                                <select class="wt-select-box selectpicker" v-model="auth.gender_id"  data-live-search="true" title="" id="gender" data-bv-field="size">
                                                    <option>choose gender</option>
                                                    <option v-for="gender in this.gender " :value="gender.id">{{ gender[`name_${getLang}`] }}</option>
                                                </select>
                                                <i class="fs-input-icon fa fa-venus-mars"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-xl-6 col-lg-6 col-md-12" >
                                        <p>ნასამართლევი ხართ?</p>
                                            <div class="form-check form-check-inline">
                                                <input  type="radio" name="gender_id" value="0" class="form-check-input" id="male" >
                                                <label class="form-check-label" for="male">არა</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" name="gender_id" value="1" class="form-check-input" id="female" >
                                                <label class="form-check-label" for="female">კი</label>
                                            </div>

                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12" >
                                        <p>ეწევი?</p>
                                            <div class="form-check form-check-inline">
                                                <input  type="radio" name="" value="0" class="form-check-input" id="male" >
                                                <label class="form-check-label" for="male">არა</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" name="" value="1" class="form-check-input" id="female" >
                                                <label class="form-check-label" for="female">კი</label>
                                            </div>

                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12" >
                                        <p>საზღვარგარეთ იმუშავებდი?</p>
                                            <div class="form-check form-check-inline">
                                                <input  type="radio" name="" value="0" class="form-check-input" id="male" >
                                                <label class="form-check-label" for="male">არა</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" name="" value="1" class="form-check-input" id="female" >
                                                <label class="form-check-label" for="female">კი</label>
                                            </div>

                                    </div> -->



                                    <!-- <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Qualification</label>
                                            <div class="ls-inputicon-box">
                                                <input class="form-control" name="company_since" type="text" placeholder="BTech">
                                                <i class="fs-input-icon fa fa-user-graduate"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Language</label>
                                            <div class="ls-inputicon-box">
                                                <input class="form-control" name="company_since" type="text" placeholder="e.x English, Spanish">
                                                <i class="fs-input-icon fa fa-language"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="form-group city-outer-bx has-feedback">
                                            <label>Job Category</label>
                                            <div class="ls-inputicon-box">
                                                <input class="form-control" name="company_since" type="text" placeholder="IT & Software">
                                                <i class="fs-input-icon fa fa-border-all"></i>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="form-group city-outer-bx has-feedback">
                                            <label>Experience</label>
                                            <div class="ls-inputicon-box">
                                                <input class="form-control" name="company_since" type="text" placeholder="05 Years">
                                                <i class="fs-input-icon fa fa-user-edit"></i>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group city-outer-bx has-feedback">
                                            <label>Current Salary</label>
                                            <div class="ls-inputicon-box">
                                                <input class="form-control" name="company_since" type="text" placeholder="65K">
                                                <i class="fs-input-icon fa fa-dollar-sign"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group city-outer-bx has-feedback">
                                            <label>Expected Salary</label>
                                            <div class="ls-inputicon-box">
                                                <input class="form-control" name="company_since" type="text" placeholder="75K">
                                                <i class="fs-input-icon fa fa-dollar-sign"></i>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-lg-12 col-md-12">
                                        <div class="form-group city-outer-bx has-feedback">
                                            <label>Age</label>
                                            <div class="ls-inputicon-box">
                                                <input class="form-control" name="company_since" type="text" placeholder="35 Years">
                                                <i class="fs-input-icon fa fa-child"></i>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group city-outer-bx has-feedback">
                                            <label>Country</label>
                                            <div class="ls-inputicon-box">
                                                <input class="form-control" name="company_since" type="text" placeholder="USA">
                                                <i class="fs-input-icon fa fa-globe-americas"></i>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group city-outer-bx has-feedback">
                                            <label>City</label>
                                            <div class="ls-inputicon-box">
                                                <input class="form-control" name="company_since" type="text" placeholder="Texas">
                                                <i class="fs-input-icon fa fa-globe-americas"></i>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-12 col-md-12">
                                        <div class="form-group city-outer-bx has-feedback">
                                            <label>Postcode</label>
                                            <div class="ls-inputicon-box">
                                                <input class="form-control" name="company_since" type="text" placeholder="75462">
                                                <i class="fs-input-icon fas fa-map-pin"></i>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                        <div class="form-group city-outer-bx has-feedback">
                                            <label>Full Address</label>
                                            <div class="ls-inputicon-box">
                                                <input class="form-control" name="company_since" type="text" placeholder="1363-1385 Sunset Blvd Angeles, CA 90026 ,USA">
                                                <i class="fs-input-icon fas fa-map-marker-alt"></i>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" rows="3">Greetings! when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</textarea>
                                        </div>
                                    </div> -->


                                    <div class="col-lg-12 col-md-12 mt-4">
                                        <div class="text-left">
                                            <button type="" class="site-button" >შეინახე ცვლილება</button>
                                        </div>
                                    </div>


                            </div>
                        </form>
                    </div>
                </div>

                 <!--personal information-->
                 <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">Personal Information</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Personal number</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="candidate.personal_number" type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-user"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Nationality</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="candidate.nationality_id"  data-live-search="true" title="" id="" data-bv-field="size">
                                            <option v-for="national in nationality " :value="national.id">{{ national[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-venus-mars"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Citizenship</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="candidateCitizenship"  data-live-search="true" title="" id="" data-bv-field="size" multiple>
                                            <option v-for="citizen in citizenship " :value="citizen.id">{{ citizen[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-venus-mars"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Religion</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="candidate.religion_id"  data-live-search="true" title="" id="" data-bv-field="size">
                                            <option v-for="religion in religions " :value="religion.id">{{ religion[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-venus-mars"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Education</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="candidate.education_id"  data-live-search="true" title="" id="" data-bv-field="size">
                                            <option v-for="education in educations " :value="education.id">{{ education[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-venus-mars"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>პროფესია</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="candidateProfession"  data-live-search="true" title="" id="" data-bv-field="size" multiple>
                                            <option v-for="profession in professions " :value="profession.id">{{ profession[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-venus-mars"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>სპეციალობა</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="candidateSpecialty"  data-live-search="true" title="" id="" data-bv-field="size" multiple>
                                            <option v-for="specialty in specialties " :value="specialty.id">{{ specialty[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-venus-mars"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>ოჯახური მდგომარეობა</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="candidate.marital_status_id"  data-live-search="false" title="" id="" data-bv-field="size">
                                            <option v-for="marital in maritalStatus " :value="marital.id">{{ marital[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-venus-mars"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidate.marital_status_id && candidate.marital_status_id != 1 " class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>შვილების რაოდენობა</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="candidate.children" type="number" placeholder="">
                                        <i class="fs-input-icon fa fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidate.marital_status_id && candidate.marital_status_id != 1 && candidate.children && candidate.children != 0" class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>შვილების ასაკი</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="candidate.children_age" type="text" placeholder="მაგ: 10,14">
                                        <i class="fs-input-icon fa fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidate.marital_status_id && candidate.marital_status_id == 2 " class="col-md-12">
                                <div class="form-group">
                                    <label>მეუღლის სახელი გვარი და სამუშაო ადგილი </label>
                                    <textarea class="form-control" rows="3" placeholder="გთხოვთ ინფორმაცია შეავსოთ მითითებული მოთხოვნის შესაბამისად."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!--სამედიცინო ინფორმაცია-->
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">სამედიცინო ინფორმაცია</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>ალერგია</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="candidateAllergy"  data-live-search="true" title="" id="" data-bv-field="size">
                                            <option v-for="allergy in allergies " :value="allergy.id">{{ allergy[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-venus-mars"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>ოპერაცია ან ქრონიკული დაავადება </label>
                                    <textarea class="form-control" rows="3" placeholder="გთხოვთ მოგვაწოდოთ ინფორმაცია მნიშვნელოვანი ოპერაციების და ქრონიკული დაავადებების შესახებ ასეთის არსებობის შემთხვევაში."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                 <!--უცხო ენები-->
                 <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">უცხო ენები</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>უცხო ენა</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker"  v-model="language_id"  data-live-search="true" title="" id="" data-bv-field="size">
                                            <option v-for="language in languages " :value="language.id">{{ language[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-venus-mars"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>დონე</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="language_level_id"   data-live-search="false" title="" id="" data-bv-field="size">
                                            <option v-for="languageLevel in languageLevels " :value="languageLevel.id">{{ languageLevel[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-venus-mars"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="text-right ">
                                    <button class="btn btn-success"
                                    @click="addLanguage(language_id, language_level_id)"
                                    title="დამატება" data-bs-toggle="tooltip"
                                    data-bs-placement="top">დამატება
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                                <!-- <div class="text-right  ">
                                    <button type="submit" class="site-button">დამატება</button>
                                </div> -->
                            </div>
                            <div :class="languageTableClass">
                                <!-- <miniTable :key="tableType" :tableType="tableType" :tableRow="tableRow" :tableData="candidateLanguage" @messageFromChild="childMessage"></miniTable> -->
                                <div class="panel-body wt-panel-body">
                                    <div class="p-a20 table-responsive">
                                        <table class="table twm-table table-striped table-borderless">
                                            <thead>
                                                <tr>
                                                <th v-for="row in languageTableRow">{{ row }}</th>
                                                <th>actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <!--1-->
                                                <tr v-for="(data, index) in candidateLanguage">
                                                <td v-for="n in (Object.keys(data).length)"> {{ data[`row_${n}`] }}</td>
                                                <td>
                                                    <button @click="removeRow('language', index)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!--ზოგადი სამუშაო გამოცდილება-->
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">ზოგადი სამუშაო გამოცდილება</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>სამუშაო გამოცდილება</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker"  v-model="candidateWorkExperience.work_experience_id"  data-live-search="true" title="" id="" data-bv-field="size">
                                            <option v-for="workExperience in workExperiences " :value="workExperience.id">{{ workExperience[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-venus-mars"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>პოზიცია</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="candidateWorkExperience.position" type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>ობიექტი</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="candidateWorkExperience.object" type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="text-right ">
                                    <button class="btn btn-success"
                                    @click="addCandidateWorkExperience(candidateWorkExperience.work_experience_id, candidateWorkExperience.position, candidateWorkExperience.object)"
                                    title="დამატება" data-bs-toggle="tooltip" data-bs-placement="top">დამატება
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                            </div>
                            <div :class="ExperienceTableClass">
                                <!-- <miniTable :key="tableType" :tableType="tableType" :tableRow="tableRow" :tableData="candidateExperience" @messageFromChild="childMessage"></miniTable> -->
                                <div class="panel-body wt-panel-body">
                                    <div class="p-a20 table-responsive">
                                        <table class="table twm-table table-striped table-borderless">
                                            <thead>
                                                <tr>
                                                <th v-for="row in experienceTableRow">{{ row }}</th>
                                                <th>actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <!--1-->
                                                <tr v-for="(data, index) in candidateExperience">
                                                <td v-for="n in (Object.keys(data).length)"> {{ data[`row_${n}`] }}</td>
                                                <td>
                                                    <button @click="removeRow('experience',index)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!--რეკომენდაცია-->
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">რეკომენდაცია</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>რეკომენდაციას წარმოადგენთ</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker"  v-model="candidateRecommendation.recommendation_id"  data-live-search="true" title="" id="" data-bv-field="size">
                                            <option v-for="recommendation in recommendations " :value="recommendation.id">{{ recommendation[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-venus-mars"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidateRecommendation.recommendation_id != 4" class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>საიდან წარმოადგენთ</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker"  v-model="candidateRecommendation.recommendation_from_whom_id"  data-live-search="true" title="" id="" data-bv-field="size">
                                            <option v-for="recommendationFrom in recommendationFromWhom " :value="recommendationFrom.id">{{ recommendationFrom[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-venus-mars"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidateRecommendation.recommendation_id != 4 || candidateRecommendation.recommendation_id != 1" class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>რეკომენდატორის სახელი გვარი</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="candidateRecommendation.name" type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidateRecommendation.recommendation_from_whom_id == 1" class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>თანამდებობა</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="candidateRecommendation.position" type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidateRecommendation.recommendation_id != 4 || candidateRecommendation.recommendation_id != 1" class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>ნომერი</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="candidateRecommendation.number" type="text" placeholder="">
                                        <i class="fs-input-icon fa fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="candidateRecommendation.recommendation_id == 3" class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>ფაილი</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" ref="upload" type="file" @change="recommendationFileUpload" placeholder="">
                                        <i class="fs-input-icon fa fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-lg-12 col-md-12">
                                <div class="text-right ">
                                    <button class="btn btn-success"
                                    @click="addCandidateWorkExperience(candidateWorkExperience.work_experience_id, candidateWorkExperience.position, candidateWorkExperience.object)"
                                    title="დამატება" data-bs-toggle="tooltip" data-bs-placement="top">დამატება
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                            </div> -->
                            <!--  -->
                        </div>
                    </div>
                </div>

                <!--Additional information-->
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">Additional Information</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group city-outer-bx has-feedback">
                                    <label>height</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="candidate.height" type="text" placeholder="65K">
                                        <i class="fs-input-icon fa fa-arrows-v" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group city-outer-bx has-feedback">
                                    <label>weight</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="candidate.weight" type="text" placeholder="75K">
                                        <i class="fs-input-icon fa fa-dollar-sign"></i>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>ნასამართლევი ხართ?</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="candidate.convection"  data-live-search="false" title="" id="" data-bv-field="size">
                                            <option :value="0">კი</option>
                                            <option :value="1">არა</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-venus-mars"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>ეწევით?</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="candidate.smoke"  data-live-search="false" title="" id="" data-bv-field="size">
                                            <option :value="0">კი</option>
                                            <option :value="1">არა</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-venus-mars"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>იმუშავებდით საზღარგარეთ?</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="candidate.work_abroad"  data-live-search="false" title="" id="" data-bv-field="size">
                                            <option :value="0">კი</option>
                                            <option :value="1">არა</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-venus-mars"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                 <!--ცნობები-->
                 <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">ცნობები</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>ცნობის დასახელება</label>
                                    <div class="ls-inputicon-box">
                                        <select class="wt-select-box selectpicker" v-model="candidateNotices.notice_id"  data-live-search="true" title="" id="" data-bv-field="size">
                                            <option v-for="notice in notices " :value="notice.id">{{ notice[`name_${getLang}`] }}</option>
                                        </select>
                                        <i class="fs-input-icon fa fa-venus-mars"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>ფაილი</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" type="file" @change="noticeFileUpload"  placeholder="">
                                        <!-- <i class="fs-input-icon fa fa-user"></i> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="text-right ">
                                    <button class="btn btn-success"
                                    @click="addNotice(candidateNotices.notice_id,)"
                                    title="დამატება" data-bs-toggle="tooltip" data-bs-placement="top">დამატება
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                            </div>
                            <div :class="noticeTableClass">
                                <!-- <miniTable :key="tableType" :tableType="tableType" :tableRow="tableRow" :tableData="candidateExperience" @messageFromChild="childMessage"></miniTable> -->
                                <div class="panel-body wt-panel-body">
                                    <div class="p-a20 table-responsive">
                                        <table class="table twm-table table-striped table-borderless">
                                            <thead>
                                                <tr>
                                                <th v-for="row in noticeTableRow">{{ row }}</th>
                                                <th>actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <!--1-->
                                                <tr v-for="(data, index) in candidateExperience">
                                                <td v-for="n in (Object.keys(data).length)"> {{ data[`row_${n}`] }}</td>
                                                <td>
                                                    <button @click="removeRow('notice',index)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Social Network-->
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">Social Network</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">

                        <div class="row">

                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>Facebook</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control wt-form-control" name="company_name" type="text" placeholder="https://www.facebook.com/">
                                            <i class="fs-input-icon fab fa-facebook-f"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>Youtube</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control wt-form-control" name="company_name" type="text" placeholder="https://www.youtube.com/">
                                            <i class="fs-input-icon fab fa-youtube"></i>
                                        </div>
                                    </div>
                                </div>

                            <div class="col-lg-12 col-md-12">
                                    <div class="text-left">
                                        <button type="submit" class="site-button">Save Changes</button>
                                    </div>
                                </div>


                        </div>

                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div>
</template>
<script>
import { I18n } from 'laravel-vue-i18n'
import miniTable from './miniTable.vue'
import _ from 'lodash'
export default {
    components:{
        miniTable
    },
    props:{
        data:Object
    },
    data() {
        return {
            auth: {},
            candidate:{},
            candidateWorkExperience: {},
            candidateRecommendation: {},
            candidateNotices: {},
            //კლასიპიკატორები
            gender: {},
            nationality: {},
            religions: {},
            educations: {},
            maritalStatus: {},
            citizenship: {},
            professions: {},
            specialties: {},
            allergies: {},
            languages: {},
            languageLevels: {},
            workExperiences: {},
            recommendations: {},
            recommendationFromWhom: {},
            notices: {},


            candidateCitizenship: [],
            candidateSpecialty: [],
            candidateProfession: [],
            candidateAllergy: [],
            candidateLanguage: [],
            candidateExperience: [],


            //v-model
            language_id: null,
            language_level_id: null,

            // workExperience_id: null,

            //table component
            languageTableRow: [],
            experienceTableRow: [],
            //file
            noticeFile: {},
            recommendationFile: {},

        }
    },
    created(){
        this.auth = this.data.auth
        this.candidate = this.data.candidate
        this.gender = this.data.gender
        this.nationality = this.data.nationality
        this.religions = this.data.religions
        this.educations = this.data.educations
        this.maritalStatus = this.data.maritalStatus
        this.citizenship = this.data.citizenship
        this.professions = this.data.professions
        this.specialties = this.data.specialties
        this.allergies = this.data.allergies
        this.languages = this.data.languages
        this.languageLevels = this.data.languageLevels
        this.workExperiences = this.data.workExperiences
        this.candidateWorkExperience = this.data.candidateWorkExperience
        this.recommendations = this.data.recommendations
        this.candidateRecommendation = this.data.candidateRecommendation
        this.recommendationFromWhom = this.data.recommendationFromWhom
        // this.tableRow = {'language': this.tableRowL}
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
        languageTableClass(){
            return (this.candidateLanguage.length > 0 )?'col-lg-12 col-md-12':'col-lg-12 col-md-12 visually-hidden'
        },
        ExperienceTableClass(){
            return (this.candidateExperience.length > 0 )?'col-lg-12 col-md-12':'col-lg-12 col-md-12 visually-hidden'
        },
        noticeTableClass(){
            return (this.candidateExperience.length > 0 )?'col-lg-12 col-md-12':'col-lg-12 col-md-12 visually-hidden'
        }
    },
    methods:{
        authUpdate(){
            console.log(this.auth);
            axios.post('/profileUpdate',{
                auth:this.auth
            })
            .then(function (response) {
                // handle success
                console.log(response);
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })

        },
        recommendationFileUpload(event){
            console.log(event.target.files[0]);
            this.recommendationFile = event.target.files[0]
        },
        noticeFileUpload(event){
            console.log(event.target.files[0]);
            this.noticeFile = event.target.files[0]
        },
        addLanguage(language_id, language_level_id){
            var tableData = {}
            var languageObj =  _.find(this.languages, function(o) { return o.id ==  language_id; });
            var languageLevelObj = _.find(this.languageLevels, function(o) { return o.id ==  language_level_id; });
            tableData = {
                'row_1': this.candidateLanguage.length + 1,
                'row_2': languageObj[`name_${this.getLang}`],
                'row_3': languageLevelObj[`name_${this.getLang}`],
            }
            this.candidateLanguage.push(tableData)
            this.languageTableRow = ['N', 'ენა', 'დონე']
        },
        addCandidateWorkExperience(workExperience_id, position, object){
            this.candidateWorkExperience = {
                'work_experience_id':workExperience_id,
                'position': position,
                'object': object,
            }
            var tableData = {}
            var workExperienceObj =  _.find(this.workExperiences, function(o) { return o.id ==  workExperience_id; });

            tableData = {
                'row_1': this.candidateExperience.length + 1,
                'row_2': workExperienceObj[`name_${this.getLang}`],
                'row_3': position,
                'row_4': object,
            }
            this.candidateExperience.push(tableData)
            this.experienceTableRow = ['N', 'გამოცდილება', 'პოზიცია', 'ობიექტი']
        },
        addNotice(){

        },
        removeRow(type, index){
            if (type == 'language') {
                const removed = this.candidateLanguage.splice(index, 1);
            }else if(type == 'experience'){
                const removed = this.candidateExperience.splice(index, 1);
            }

        },
        // childMessage(newData, type){
        //     console.log('newData',newData);
        //     if (type == 'language') {
        //         this.candidateLanguage = newData
        //         console.log('this.candidateLanguage1', this.candidateLanguage);
        //         // this.removeLanguage()
        //     }
        // }
    },

    mounted(){
        // console.log(this.candidateRecommendation);
        // console.log($t);
        console.log(this.getLang)
        // console.log(this.app);

    }
}
</script>
<style lang="">

</style>
