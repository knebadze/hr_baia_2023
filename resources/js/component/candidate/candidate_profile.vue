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
                                    <button class="btn btn-success" @click="addLanguage(language_id, language_level_id)" title="დამატება" data-bs-toggle="tooltip" data-bs-placement="top">
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                                <!-- <div class="text-right  ">
                                    <button type="submit" class="site-button">დამატება</button>
                                </div> -->
                            </div>
                            <div :class="tableClass">
                                <miniTable :key="'language'" :tableType="'language'" :tableRow="tableRow" :tableData="candidateLanguage" @messageFromChild="childMessage"></miniTable>
                            </div>
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

            candidateCitizenship: [],
            candidateSpecialty: [],
            candidateProfession: [],
            candidateAllergy: [],
            candidateLanguage: [],

            //v-model
            language_id: null,
            language_level_id: null,

            //table component
            tableType: '',
            tableRow: {},
            // tableRowL:['N', 'ენა', 'დონე']


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
        // this.tableRow = {'language': this.tableRowL}
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
        tableClass(){
            return (this.candidateLanguage.length > 0 )?'col-lg-12 col-md-12':'col-lg-12 col-md-12 visually-hidden'
        }
    },
    methods:{
        authUpdate(){
            console.log(this.auth);
        },
        addLanguage(language_id, language_level_id){
            var tableData = []
            var languageObj =  _.find(this.languages, function(o) { return o.id ==  language_id; });
            var languageLevelObj = _.find(this.languageLevels, function(o) { return o.id ==  language_level_id; });
            tableData = [
                {'data':this.candidateLanguage.length + 1},
                {'data':languageObj[`name_${this.getLang}`]},
                {'data':languageLevelObj[`name_${this.getLang}`]},
            ]
            this.candidateLanguage.push(tableData)
            // console.log('this.candidateLanguage', this.candidateLanguage);
            var tableRow = ['N', 'ენა', 'დონე']
            this.tableRow = {'language': tableRow}
        },
        trashLanguage(index){
            console.log('this.candidateLanguage2', this.candidateLanguage);
            // const removed = this.candidateLanguage.splice(index, 1);
            // console.log('removed', removed);
            console.log('this.candidateLanguage3', this.candidateLanguage);
        },
        childMessage(type, index){
            console.log(type, index);
            if (type == 'language') {
                console.log('this.candidateLanguage1', this.candidateLanguage);
                this.trashLanguage()
            }
        }
    },

    mounted(){
        console.log(this.candidate);
        // console.log($t);
        console.log(this.getLang)
        // console.log(this.app);

    }
}
</script>
<style lang="">

</style>
