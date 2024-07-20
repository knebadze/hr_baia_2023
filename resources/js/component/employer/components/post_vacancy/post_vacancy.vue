<template lang="">
    <!-- LOADING AREA START ===== -->
    <loading
        :active="loader"
        :can-cancel="true"
        color="#01ecd5"
        :is-full-page="fullPage"
    />
    <!-- LOADING AREA  END ====== -->
    <div class="panel panel-default">
        <div class="text-center">
            <h3>
                {{
                    searchData ? "გაიმეორე ვაკანსია" : "დაამატე ახალი ვაკანსია"
                }}
            </h3>
        </div>
        <div v-if="searchData">
            <div class="panel-heading wt-panel-heading p-a20">
                <h4 class="panel-tittle m-a0">{{ "გამეორების მიზეი" }}</h4>
            </div>
            <div class="panel-body wt-panel-body p-a20 m-b30">
                <div class="col-md-12">
                    <div class="form-group">
                        <label
                            ><span class="text-danger">* </span> გამეორების
                            მიზეზი</label
                        >
                        <div class="ls-inputicon-box">
                            <textarea
                                class="form-control"
                                :class="
                                    !m.repeat_reason
                                        ? 'border border-danger'
                                        : ''
                                "
                                v-model="m.repeat_reason"
                                type="text"
                                placeholder="აუცილებლად შესავსები!!! ჩაწერეთ გამეორების მიზეზი"
                                rows="3"
                            ></textarea>
                            <!-- <span v-if="v$.m.candidate.personal_number.required.$invalid && v$.m.candidate.personal_number.$dirty" style='color:red'>* {{ v$.m.candidate.personal_number.required.$message}}</span> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-heading wt-panel-heading p-a20">
            <h4 class="panel-tittle m-a0">{{ "პირადი ინფორმაცია" }}</h4>
            <!-- <h4 class="panel-tittle m-a0">{{ $t('lang.employer_add_job_general_info') }}</h4> -->
            <small class="text-danger"
                >* {{ $t("lang.employer_add_job_definitely_fields") }}</small
            >
        </div>
        <div class="panel-body wt-panel-body p-a20 m-b30" v-if="formData">
            <div class="row">
                <!--Job title-->
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label
                            ><span class="text-danger">* </span>სახელი
                            გვარი</label
                        >
                        <div class="ls-inputicon-box">
                            <input
                                class="form-control"
                                v-model="m.employer.name"
                                :class="{
                                    'is-invalid':
                                        m.employer.name == null ||
                                        v.employer.name.$error,
                                }"
                                type="text"
                                placeholder="Devid Smith"
                                @blur="v.employer.name.$touch"
                            />
                            <span
                                v-if="
                                    showError &&
                                    !v.employer.name.required.$response
                                "
                                style="color: red"
                                >{{ errorMessage("required") }}
                            </span>
                        </div>
                    </div>
                </div>
                <!--Job title-->
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>მაილი</label>
                        <div class="ls-inputicon-box">
                            <input
                                class="form-control"
                                :class="
                                    m.employer.email == null ||
                                    v.employer.email.$error
                                        ? 'is-invalid'
                                        : ''
                                "
                                v-model="m.employer.email"
                                type="email"
                                placeholder="employer@gmail.com"
                                @blur="v.employer.email.$touch"
                            />
                            <span
                                v-if="
                                    showError &&
                                    !v.employer.email.email.$response
                                "
                                style="color: red"
                                >{{ errorMessage("required") }}
                            </span>
                        </div>
                    </div>
                </div>

                <div
                    class="col-xl-6 col-lg-6 col-md-12"
                    v-if="data.model.role_id && data.model.role_id != 3"
                >
                    <div class="form-group">
                        <label
                            ><span class="text-danger">* </span
                            >{{ "ტელეფონის ნომერი" }}</label
                        >
                        <div class="input-group mb-3">
                            <button
                                style="border-style: none"
                                class="btn btn-outline-secondary dropdown-toggle"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                <span
                                    :class="`fi fi-${m.employer.number_code.iso.toLowerCase()}`"
                                ></span
                                >+{{ m.employer.number_code.phonecode }}
                            </button>
                            <ul
                                class="dropdown-menu"
                                style="
                                    overflow: hidden;
                                    overflow-y: auto;
                                    max-height: calc(100vh - 550px);
                                "
                            >
                                <li
                                    v-for="item in cla.numberCode"
                                    @click="chooseNumberCode(item)"
                                >
                                    <a class="dropdown-item"
                                        ><span
                                            :class="`fi fi-${item.iso.toLowerCase()}`"
                                        ></span
                                        >+{{ item.phonecode }}</a
                                    >
                                </li>
                            </ul>
                            <input
                                type="text"
                                class="form-control"
                                :class="
                                    m.employer.number == null
                                        ? 'is-invalid'
                                        : ''
                                "
                                v-model="m.employer.number"
                                placeholder="555666777"
                                onkeypress="return /[0-9]/i.test(event.key)"
                            />

                            <!-- <span v-if="showError && !v.employer.number.numeric.$response" style='color:red'>* </span> -->
                        </div>
                        <span
                            v-if="
                                showError &&
                                !v.employer.number.required.$response
                            "
                            style="color: red"
                            >{{ errorMessage("required") }}</span
                        >
                        <span
                            v-if="
                                showError &&
                                !v.employer.number.numeric.$response
                            "
                            style="color: red"
                            >{{ errorMessage("numeric") }}</span
                        >
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label
                            ><span class="text-danger">* </span>ქალაქი, დაბა,
                            უბანი ან სოფელი</label
                        >
                        <div class="ls-inputicon-box">
                            <input
                                class="form-control"
                                :class="
                                    m.employer.address == null ||
                                    v.employer.address.$error
                                        ? 'is-invalid'
                                        : ''
                                "
                                v-model="m.employer.address"
                                type="text"
                                placeholder="მაგ: თბილისი, სამგორი"
                                @blur="v.employer.address.$touch"
                            />
                            <span
                                v-if="
                                    showError &&
                                    !v.employer.address.required.$response
                                "
                                style="color: red"
                                >{{ errorMessage("required") }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>ქუჩა</label>
                        <div class="ls-inputicon-box">
                            <input
                                class="form-control"
                                v-model="m.employer.street"
                                type="text"
                                placeholder="მაგ: კახეთის გზატკეცილი 36 ბ"
                            />
                        </div>
                    </div>
                </div>

                <div class="panel-heading wt-panel-heading p-a20 m-b30">
                    <h4 class="panel-tittle m-a0">
                        {{ $t("lang.employer_add_job_general_info") }}
                    </h4>
                    <!-- <small class="text-danger">* {{ $t('lang.employer_add_job_definitely_fields') }}</small> -->
                </div>
                <!-- <div class="panel-body wt-panel-body p-a20 m-b30 "></div> -->
                <!--Job title-->
                <!-- <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label><span class="text-danger">* </span>{{ $t('lang.employer_add_job_vacancy_name') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input
                                            class="form-control"
                                            :class="(m.vacancy.title == null || v.vacancy.title.$error)?'is-invalid':''"
                                            v-model="m.vacancy.title"
                                            type="text"
                                            :placeholder="$t('lang.employer_add_job_vacancy_name_placeholder')"
                                            @blur="v.vacancy.title.$touch"
                                        >
                                        <span v-if="showError && !v.vacancy.title.required.$response" style='color:red'>* </span>
                                        <span v-if="showError && !v.vacancy.title.maxLength.$response" style='color:red'>* </span>
                                    </div>
                                </div>
                            </div> -->

                <!--Job Category-->
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label
                            ><span class="text-danger">* </span
                            >{{ $t("lang.employer_add_job_position") }}</label
                        >
                        <div class="ls-inputicon-box">
                            <multiselect
                                :customClass="customClasses"
                                v-model="m.vacancy.category"
                                :options="cla.category"
                                deselect-label="Can't remove this value"
                                :track-by="trackBy"
                                :label="label"
                                placeholder="Select one"
                                :searchable="true"
                                :allow-empty="false"
                                @blur="v.vacancy.category.$touch"
                                aria-describedby="categoryHelp"
                            >
                            </multiselect>
                            <span
                                v-if="
                                    showError &&
                                    !v.vacancy.category.required.$response
                                "
                                style="color: red"
                            >
                                {{ errorMessage("required") }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label
                            ><span class="text-danger">* </span
                            >{{
                                $t(
                                    !m.vacancy.category
                                        ? "ვისთვის გესაჭიროებათ?"
                                        : m.vacancy.category.id != 4 &&
                                          m.vacancy.category.id != 6
                                        ? "ვისთვის გესაჭიროებათ?"
                                        : "ფართის მოცულობა"
                                )
                            }}</label
                        >
                        <div class="ls-inputicon-box">
                            <multiselect
                                v-model="m.for_who_need"
                                :options="cla.forWhoNeed"
                                :multiple="true"
                                :close-on-select="false"
                                :clear-on-select="false"
                                :preserve-search="true"
                                :placeholder="
                                    $t('lang.employer_add_job_select')
                                "
                                label="name_ka"
                                track-by="name_ka"
                                :preselect-first="false"
                                @blur="v.for_who_need.$touch"
                                :max="3"
                            />
                            <span
                                v-if="
                                    showError &&
                                    !v.for_who_need.required.$response
                                "
                                style="color: red"
                                >{{ errorMessage("required") }}
                            </span>
                        </div>
                    </div>
                </div>
                <div
                    class="col-xl-4 col-lg-6 col-md-12"
                    v-if="m.vacancy.category && m.vacancy.category.id == 7"
                >
                    <div class="form-group">
                        <label>მართვის მოწმობა </label>
                        <div class="ls-inputicon-box">
                            <multiselect
                                v-model="m.driving_license"
                                :options="cla.drivingLicense"
                                :multiple="true"
                                :close-on-select="false"
                                :clear-on-select="false"
                                :preserve-search="true"
                                :placeholder="
                                    $t('lang.employer_add_job_select')
                                "
                                label="name"
                                track-by="name"
                                :preselect-first="false"
                            />
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label
                            ><span class="text-danger">* </span
                            >{{
                                $t("lang.user_profile_page_work_schedule_title")
                            }}</label
                        >
                        <div class="ls-inputicon-box">
                            <multiselect
                                v-model="m.vacancy.work_schedule"
                                :options="cla.workSchedule"
                                deselect-label="Can't remove this value"
                                :track-by="`name_${getLang}`"
                                :label="`name_${getLang}`"
                                placeholder="Select one"
                                :searchable="false"
                                :allow-empty="false"
                                @blur="v.vacancy.work_schedule.$touch"
                            >
                                <template
                                    slot="singleLabel"
                                    slot-scope="{ option }"
                                ></template>
                            </multiselect>
                            <span
                                v-if="
                                    showError &&
                                    !v.vacancy.work_schedule.required.$response
                                "
                                style="color: red"
                                >{{ errorMessage("required") }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label
                            ><span class="text-danger">* </span
                            >{{
                                $t("lang.user_profile_page_work_salary_title")
                            }}</label
                        >
                        <div class="ls-inputicon-box">
                            <input
                                class="form-control"
                                :class="{
                                    'is-invalid':
                                        m.vacancy.payment == null ||
                                        v.vacancy.payment.$error,
                                }"
                                v-model="m.vacancy.payment"
                                type="number"
                                step="50"
                                @blur="v.vacancy.payment.$touch"
                            />
                            <span
                                v-if="
                                    showError &&
                                    !v.vacancy.payment.required.$response
                                "
                                style="color: red"
                                >{{ errorMessage("required") }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label
                            ><span class="text-danger">* </span
                            >{{
                                $t("lang.user_profile_page_work_currency_title")
                            }}</label
                        >
                        <div class="ls-inputicon-box">
                            <multiselect
                                v-model="m.vacancy.currency"
                                :options="cla.currency"
                                deselect-label="Can't remove this value"
                                :track-by="`name_${getLang}`"
                                :label="`name_${getLang}`"
                                placeholder="Select one"
                                :searchable="false"
                                :allow-empty="false"
                                @blur="v.vacancy.currency.$touch"
                            >
                                <template
                                    slot="singleLabel"
                                    slot-scope="{ option }"
                                ></template>
                            </multiselect>
                            <span
                                v-if="
                                    showError &&
                                    !v.vacancy.currency.required.$response
                                "
                                style="color: red"
                                >{{ errorMessage("required") }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label
                            ><span class="text-danger">* </span
                            >{{ $t("lang.employer_add_job_jobs_day") }}</label
                        >
                        <p>
                            <small
                                v-if="m.vacancy.work_schedule"
                                class="text-danger"
                                >* სავალდებულოო სამუშაო დღეების მითითება!!!
                            </small>
                        </p>

                        <div class="ls-inputicon-box">
                            <textarea
                                class="form-control"
                                :class="{
                                    'is-invalid':
                                        m.vacancy.additional_schedule == null ||
                                        v.vacancy.additional_schedule.$error,
                                }"
                                v-model="m.vacancy.additional_schedule"
                                type="text"
                                :placeholder="''"
                                rows="3"
                                @blur="v.vacancy.additional_schedule.$touch"
                            ></textarea>
                            <span
                                v-if="
                                    showError &&
                                    !v.vacancy.additional_schedule.required
                                        .$response
                                "
                                style="color: red"
                                >{{ errorMessage("required") }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="panel-heading wt-panel-heading p-a20 my-3">
                    <h4 class="panel-tittle m-a0">
                        <i class="fa fa-suitcase"></i> დამატებით
                    </h4>
                </div>
                <div
                    class="row mb-4"
                    v-if="
                        m.vacancy.category &&
                        (m.vacancy.category.id == 1 ||
                            m.vacancy.category.id == 2 ||
                            m.vacancy.category.id == 4)
                    "
                >
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-check">
                            <input
                                type="checkbox"
                                class="form-check-input"
                                id="exampleCheck1"
                                value="1"
                                v-model="m.vacancy.go_vacation"
                            />
                            <label class="form-check-label" for="exampleCheck1"
                                >შეეძლოს არდადეგებზე გაყოლა</label
                            >
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-check">
                            <input
                                type="checkbox"
                                class="form-check-input"
                                id="exampleCheck2"
                                value="1"
                                v-model="m.vacancy.stay_night"
                            />
                            <label class="form-check-label" for="exampleCheck2"
                                >შეეძლოს ღამე დარჩენა</label
                            >
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-check">
                            <input
                                type="checkbox"
                                class="form-check-input"
                                id="exampleCheck3"
                                value="1"
                                v-model="m.vacancy.work_additional_hours"
                            />
                            <label class="form-check-label" for="exampleCheck3"
                                >შეეძლო დამატებით საათებში მუშაობა</label
                            >
                        </div>
                    </div>
                </div>

                <!--Start Date-->
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label
                            ><span class="text-danger">* </span
                            >{{ $t("lang.employer_add_job_when_need") }}</label
                        >
                        <div class="ls-inputicon-box">
                            <input
                                class="form-control"
                                @input="startDate(m.vacancy.start_date)"
                                v-model="m.vacancy.start_date"
                                type="date"
                                :min="startDateMin"
                                placeholder=""
                                @blur="v.vacancy.start_date.$touch"
                            />
                            <span
                                v-if="
                                    showError &&
                                    !v.vacancy.start_date.required.$response
                                "
                                style="color: red"
                                >{{ errorMessage("required") }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label
                            ><span class="text-danger">* </span
                            >{{ $t("lang.employer_add_job_how_long") }}</label
                        >
                        <div class="ls-inputicon-box">
                            <multiselect
                                v-model="m.vacancy.term"
                                :options="cla.term"
                                deselect-label="Can't remove this value"
                                :track-by="`name_${getLang}`"
                                :label="`name_${getLang}`"
                                placeholder="Select one"
                                :searchable="true"
                                :allow-empty="false"
                                @blur="v.vacancy.term.$touch"
                                :disabled="termDisable"
                            >
                                <template
                                    slot="singleLabel"
                                    slot-scope="{ option }"
                                ></template>
                            </multiselect>
                            <span
                                v-if="
                                    showError &&
                                    !v.vacancy.term.required.$response
                                "
                                style="color: red"
                                >{{ errorMessage("required") }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>{{ $t("ბენეფიტები") }}</label>
                        <div class="my-4">
                            <span
                                class="text-primary benefitsColor"
                                style="
                                    text-decoration: none;
                                    cursor: pointer;
                                    padding-right: 20px;
                                "
                                v-for="(item, index) in cla.benefit"
                                :key="index"
                                @click="addBenefit(item)"
                                >{{ item[`name_${getLang}`] + ", " }}</span
                            >
                        </div>
                        <textarea
                            class="form-control"
                            v-model="benefitText"
                            type="text"
                            :placeholder="
                                $t(
                                    'lang.employer_add_job_additional_offers_placeholder'
                                )
                            "
                            rows="3"
                        ></textarea>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>{{
                            $t("lang.employer_add_job_comment_for_agency")
                        }}</label>
                        <textarea
                            class="form-control"
                            v-model="m.vacancy.comment"
                            type="text"
                            :placeholder="
                                $t(
                                    'lang.employer_add_job_comment_for_agency_placeholder'
                                )
                            "
                            rows="3"
                        ></textarea>
                    </div>
                </div>

                <div class="panel-heading wt-panel-heading p-a20 my-3">
                    <h4 class="panel-tittle m-a0">
                        <i class="fa fa-suitcase"></i> მოთხოვნები კანდიდატის
                        მიმართ
                    </h4>
                </div>
                <!--Experience-->
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{
                            $t("lang.employer_add_job_minimal_age")
                        }}</label>
                        <div class="ls-inputicon-box">
                            <input
                                class="form-control"
                                @input="minAge(m.demand.min_age)"
                                v-model="m.demand.min_age"
                                type="number"
                                placeholder="18"
                                min="18"
                            />
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ $t("lang.employer_add_job_max_age") }}</label>
                        <div class="ls-inputicon-box">
                            <input
                                class="form-control"
                                @input="maxAge(m.demand.max_age)"
                                v-model="m.demand.max_age"
                                type="number"
                                placeholder="45"
                            />
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{
                            $t("lang.employer_add_job_minimal_edu")
                        }}</label>
                        <div class="ls-inputicon-box">
                            <multiselect
                                v-model="m.demand.education"
                                :options="cla.educations"
                                deselect-label="Can't remove this value"
                                :track-by="`name_${getLang}`"
                                :label="`name_${getLang}`"
                                :placeholder="
                                    $t('lang.employer_add_job_select')
                                "
                                :searchable="true"
                                :allow-empty="true"
                            >
                                <template
                                    slot="singleLabel"
                                    slot-scope="{ option }"
                                ></template>
                            </multiselect>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ "პროფესია" }}</label>
                        <div class="ls-inputicon-box">
                            <multiselect
                                v-model="m.demand.specialty"
                                :options="cla.specialties"
                                deselect-label="Can't remove this value"
                                :track-by="`name_${getLang}`"
                                :label="`name_${getLang}`"
                                :placeholder="
                                    $t('lang.employer_add_job_select')
                                "
                                :searchable="true"
                                :allow-empty="true"
                            >
                                <template
                                    slot="singleLabel"
                                    slot-scope="{ option }"
                                ></template>
                            </multiselect>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{
                            $t(
                                "lang.employer_add_job_preferred_foreign_language"
                            )
                        }}</label>
                        <div class="ls-inputicon-box">
                            <multiselect
                                v-model="m.demand.language"
                                :options="cla.languages"
                                deselect-label="Can't remove this value"
                                :track-by="`name_${getLang}`"
                                :label="`name_${getLang}`"
                                :placeholder="
                                    $t('lang.employer_add_job_select')
                                "
                                :searchable="true"
                                :allow-empty="true"
                            >
                                <template
                                    slot="singleLabel"
                                    slot-scope="{ option }"
                                ></template>
                            </multiselect>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{
                            $t("lang.employer_add_job_foreign_language_level")
                        }}</label>
                        <div class="ls-inputicon-box">
                            <multiselect
                                v-model="m.demand.language_level"
                                :options="cla.languageLevels"
                                deselect-label="Can't remove this value"
                                :track-by="`name_${getLang}`"
                                :label="`name_${getLang}`"
                                :placeholder="
                                    $t('lang.employer_add_job_select')
                                "
                                :searchable="true"
                                :allow-empty="true"
                            >
                                <template
                                    slot="singleLabel"
                                    slot-scope="{ option }"
                                ></template>
                            </multiselect>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{
                            $t("lang.employer_add_job_general_character")
                        }}</label>
                        <div class="ls-inputicon-box">
                            <multiselect
                                v-model="m.characteristic"
                                :options="cla.characteristic"
                                :multiple="true"
                                :close-on-select="false"
                                :clear-on-select="false"
                                :preserve-search="true"
                                :placeholder="
                                    $t('lang.employer_add_job_select')
                                "
                                :label="`name_${getLang}`"
                                :track-by="`name_${getLang}`"
                                :preselect-first="false"
                            >
                                <template
                                    slot="selection"
                                    slot-scope="{ values, search, isOpen }"
                                    ><span
                                        class="multiselect__single"
                                        v-if="values.length"
                                        v-show="!isOpen"
                                        >{{ values.length }} options
                                        selected</span
                                    ></template
                                >
                            </multiselect>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ $t("lang.employer_add_job_duties") }}</label>
                        <div class="ls-inputicon-box">
                            <multiselect
                                v-model="m.duty"
                                :options="cla.duty"
                                :multiple="true"
                                :close-on-select="false"
                                :clear-on-select="false"
                                :preserve-search="true"
                                :placeholder="
                                    $t('lang.employer_add_job_select')
                                "
                                :label="`name_${getLang}`"
                                :track-by="`name_${getLang}`"
                                :preselect-first="false"
                            >
                                <template
                                    slot="selection"
                                    slot-scope="{ values, search, isOpen }"
                                    ><span
                                        class="multiselect__single"
                                        v-if="values.length"
                                        v-show="!isOpen"
                                        >{{ values.length }} options
                                        selected</span
                                    ></template
                                >
                            </multiselect>
                            <!-- <span v-if="v.m.familyWorkedSelected.required.$invalid && v.m.familyWorkedSelected.$dirty" style='color:red'>* {{ v.m.candidateFamilyWorkSkill.required.$message}}</span> -->
                        </div>
                    </div>
                </div>
                <div
                    class="col-xl-4 col-lg-6 col-md-12"
                    v-if="m.vacancy.category && m.vacancy.category.id != 7"
                >
                    <div class="form-group">
                        <label>მართვის მოწმობა </label>
                        <div class="ls-inputicon-box">
                            <multiselect
                                v-model="m.driving_license"
                                :options="cla.drivingLicense"
                                :multiple="true"
                                :close-on-select="false"
                                :clear-on-select="false"
                                :preserve-search="true"
                                :placeholder="
                                    $t('lang.employer_add_job_select')
                                "
                                label="name"
                                track-by="name"
                                :preselect-first="false"
                            >
                                <template
                                    slot="selection"
                                    slot-scope="{ values, search, isOpen }"
                                    ><span
                                        class="multiselect__single"
                                        v-if="values.length"
                                        v-show="!isOpen"
                                        >{{ values.length }} options
                                        selected</span
                                    ></template
                                >
                            </multiselect>
                            <!-- <span v-if="v.m.familyWorkedSelected.required.$invalid && v.m.familyWorkedSelected.$dirty" style='color:red'>* {{ v.m.candidateFamilyWorkSkill.required.$message}}</span> -->
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{
                            $t("lang.employer_add_job_additional_duties")
                        }}</label>
                        <textarea
                            class="form-control"
                            v-model="m.demand[`additional_duty_${getLang}`]"
                            type="text"
                            placeholder=""
                            rows="3"
                        ></textarea>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-check">
                        <input
                            type="checkbox"
                            class="form-check-input"
                            id="exampleCheck4"
                            value="1"
                            v-model="m.demand.has_experience"
                        />
                        <label class="form-check-label" for="exampleCheck4"
                            >გამოცდილების ქონა სავალდებულოა</label
                        >
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-check">
                        <input
                            type="checkbox"
                            class="form-check-input"
                            id="exampleCheck5"
                            value="1"
                            v-model="m.demand.has_recommendation"
                        />
                        <label class="form-check-label" for="exampleCheck5"
                            >რეკომენდაციის ქონა სავალდებულოა</label
                        >
                    </div>
                </div>

                <div class="panel-heading wt-panel-heading p-a20 my-3">
                    <h4 class="panel-tittle m-a0">
                        <i class="fa fa-suitcase"></i> გასაუბრება
                    </h4>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ $t("გასაუბრების თარიღი") }}</label>
                        <div class="ls-inputicon-box">
                            <input
                                class="form-control"
                                v-model="m.interviewDate"
                                type="date"
                                :min="minDate"
                                :max="maxDate"
                            />
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ $t("გასაუბრების დრო") }}</label>
                        <div class="ls-inputicon-box">
                            <input
                                class="form-control"
                                v-model="m.interviewTime"
                                type="time"
                            />
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ $t("გასაუბრების ადგილი") }}</label>
                        <div class="ls-inputicon-box">
                            <multiselect
                                v-model="m.vacancy.interview_place"
                                :options="cla.interviewPlace"
                                deselect-label="Can't remove this value"
                                :track-by="`name_${getLang}`"
                                :label="`name_${getLang}`"
                                :placeholder="
                                    $t('lang.employer_add_job_select')
                                "
                                :searchable="true"
                                :allow-empty="true"
                            >
                                <template
                                    slot="singleLabel"
                                    slot-scope="{ option }"
                                ></template>
                            </multiselect>
                        </div>
                    </div>
                </div>
                <div
                    class="panel-heading wt-panel-heading p-a20 my-3 d-flex justify-content-between"
                >
                    <h4 class="panel-tittle m-a0">
                        <i class="fa fa-phone"></i> დამატებითი საკონტაქტო
                        ნომრები
                    </h4>
                    <button
                        class="btn btn-info"
                        @click="openAdditionalNumberModal"
                    >
                        <i class="fa fa-plus"></i> ნომრის დამატება
                    </button>
                </div>
                <div v-if="m.employer.additional_numbers.length > 0" class="col-lg-12 col-md-12">
                    <div class="panel-body wt-panel-body">
                        <div class="p-a20 table-responsive">
                            <table class="table twm-table table-striped table-borderless">
                                <thead>
                                    <tr>
                                    <th>N</th>
                                    <th>{{ $t('lang.user_profile_page_number') }}</th>
                                    <th>{{ $t('lang.user_profile_page_number_owner') }}</th>
                                    <th>{{ $t('lang.user_profile_page_number_comment') }}</th>
                                    <th>{{ $t('lang.user_profile_page_work_number_actions') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(item, index) in m.employer.additional_numbers">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ `+${item.number_code.phonecode} ${item.number}` }}</td>
                                        <td>{{ item.number_owner[`name_${getLang}`] }}</td>
                                        <td>{{ item.comment }}</td>
                                        <td>
                                            <button @click="removeAdditionalNumber(index, item.id)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                <i class="fa fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr v-if="m.employer.additional_numbers.length > 0"/>
                <div class="col-lg-12 col-md-12">
                    <div class="text-left">
                        <button
                            type="submit"
                            @click.prevent="add(m)"
                            class="site-button m-r5"
                        >
                            {{
                                searchData
                                    ? "გამეორება"
                                    : $t("lang.employer_add_job_button_add")
                            }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <hr />
        <!-- <div class="row text-center border border-info py-4">
                <div class="col-lg-12 col-md-12 mb-4">
                    <div class="twm-error-content">
                        <h4 class="twm-error-title2 site-text-primary">ძველი ვაკანისის გამეორება</h4>
                        <p>გამოიყენეთ თქვენს მიერ ძველ ვაკანსიაში მითითებული ტელეფონის ნომერი.</p>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="twm-error-image">
                        <div class="twm-bnr-search-bar">
                            <form>
                                <div class="row">


                                    <div class="form-group  col-md-9">
                                        <label>{{ ('ტელეფონის ნომერი') }}</label>
                                        <div class="twm-inputicon-box">
                                            <input  type="text"  required class="form-control" :placeholder=" $t('lang.welcome_leftside_bar_search_job_location_job_search')">

                                        </div>
                                    </div>



                                    <div class="form-group col-xl-3 col-lg-6 col-md-6">
                                        <button type="button" class="site-button" >{{ $t('lang.welcome_leftside_bar_search_job_location_job_search') }}</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> -->
        <AdditionalNumberModal
            ref="additionalNumberModal"
            :visible="showAdditionalNumberModal"
            :cla="modalCla"
            @closeModal="handelModalClose"
            @sendData="handelModalData"
        />
    </div>
</template>
<script>
import _ from "lodash";
import { ref, computed, watch, toRefs, onMounted } from "vue";
import { I18n } from "laravel-vue-i18n";
import { useVuelidate } from "@vuelidate/core";
import { required, numeric, maxLength, email } from "@vuelidate/validators";
import Swal from "sweetalert2";
import moment from "moment";
// Import component
import Loading from "vue3-loading-overlay";
// Import stylesheet
import "vue3-loading-overlay/dist/vue3-loading-overlay.css";
import { errorMessage } from "../../../../plugins/vuelidate/validationMessages";
import AdditionalNumberModal from "../../modal/AdditionalNumberModal.vue";
export default {
    components: {
        Loading,
        AdditionalNumberModal,
    },
    props: {
        data: Object,
    },
    setup(props) {
        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });
        const minDate = computed(() => moment().format("YYYY-MM-DD"));
        const maxDate = ref(null);
        let min_age,
            max_age = null;
        const workInformationSchedule = ref(null);
        const loader = ref(false);
        const fullPage = ref(true);
        const send = ref(false);
        const showError = ref(false);
        const cla = ref(_.cloneDeep(props.data.classificatory));
        console.log(cla.value);
        const termDisable = ref(false);
        var currentDate = moment();
        const startDateMin = ref(
            currentDate.add(1, "days").format("YYYY-MM-DD")
        );
        cla.value.workSchedule = props.data.classificatory.workSchedule.filter(
            (item) => item.id !== 10 && item.id !== 11
        );
        cla.value.educations = props.data.classificatory.educations.filter(
            (item) => item.id == 1 || item.id == 8
        );
        let url = new URL(location.href);

        // გამეორების დროს იგზავნება ობიექტი
        const queryString = url.search;
        const urlParams = new URLSearchParams(queryString);
        const searchData = props.data.model.vacancy.id;
        const formData = { ...props.data.model };
        const m = ref(formData);
        console.log('m.value', props.data.model);
        const showAdditionalNumberModal = ref(false);
        const modalCla = ref({
            numberCode: props.data.classificatory.numberCode,
            numberOwner: props.data.classificatory.numberOwner,
        });
        // formData.getLang = getLang;
        // formData.number_code = cla.value.numberCode.find(element => element.phonecode == 995);

        // Computed properties
        const customClasses = computed(() => ({
            "is-invalid": isCategoryInvalid.value,
        }));

        const trackBy = computed(() => `name_${getLang.value}`);

        const label = computed(() => `name_${getLang.value}`);

        const isCategoryInvalid = computed(() => {
            return !m.value.vacancy.category || v.value.vacancy.category.$error;
        });
        const benefitText = ref(
            m.value.benefit
                ? m.value.benefit.map((i) => i.name_ka).join(", ")
                : ""
        );
        const localText = () => {
            return {
                1: {
                    ka: "ორშაბათი_დან პარასკევის ჩათლით, 09:00_დან 18:00_მდე",
                    en: "",
                    ru: "",
                },
                2: {
                    ka: "ორშაბათიდან შაბათის ჩათვლით",
                    en: "",
                    ru: "",
                },
                3: {
                    ka: "ორშაბათი_დან პარასკევის ჩათლით, 08:00_დან 13:00_მდე",
                    en: "",
                    ru: "",
                },
                4: {
                    ka: "ორშაბათი_დან პარასკევის ჩათლით, 13:00_დან 17:00_მდე",
                    en: "",
                    ru: "",
                },
                5: {
                    ka: "ორშაბათი_დან პარასკევის ჩათლით, 21:00_დან 07:00_მდე",
                    en: "",
                    ru: "",
                },
                6: {
                    ka: "შაბათი და კვირა, 09:00_დან 18:00_მდე",
                    en: "",
                    ru: "",
                },
                7: {
                    ka: "ორშაბათი, ოთხშაბათი, პარასკევი, 09:00_დან 18:00_მდე",
                    en: "",
                    ru: "",
                },
                8: {
                    ka: "ხვალ, 09:00_დან 18:00_მდე",
                    en: "",
                    ru: "",
                },
                9: {
                    ka: "ორშაბათი, ხუთშაბათი, შაბათი, 09:00_დან 18:00_მდე",
                    en: "",
                    ru: "",
                },
            };
        };
        // loader.value = false
        const rules = {
            employer: {
                name: { required },
                number:  { required, numeric },
                address: { required },
                email: { email },
            },
            vacancy: {
                // title: { required, maxLength:maxLength(50) },
                category: { required },
                payment: { required },
                currency: { required },
                work_schedule: { required },
                additional_schedule: { required },
                start_date: { required },
                term: { required },
            },
            for_who_need: { required },
        };

        // const errorMessage = (validator) => {
        //     // Handle validators that require parameters (e.g., minLength)
        //     if (typeof validationMessages[validator] === "function") {
        //         return validationMessages[
        //             validator
        //         ](/* pass required parameters */);
        //     }
        //     return validationMessages[validator];
        // };
        const v = useVuelidate(rules, m);
        const watchWorkSchedule = () => m.value.vacancy.work_schedule;
        watch(watchWorkSchedule, (newVal) => {
            if (newVal != "") {
                m.value.vacancy.additional_schedule =
                    localText()[`${newVal.id}`][`${getLang.value}`];
                const priceMap = {
                    1: 1100,
                    2: 1300,
                    3: 500,
                    4: 500,
                    5: 900,
                    6: 500,
                    7: 700,
                    8: 50,
                    9: 600,
                    // Add more cases as needed
                };

                let price = priceMap[newVal.id] || 0;
                m.value.vacancy.payment = price;

                if (newVal.id == 8) {
                    m.value.vacancy.term = cla.value.term.find(
                        (element) => element.id == 13
                    );
                    termDisable.value = true;
                } else {
                    m.value.vacancy.term = "";
                    termDisable.value = false;
                }
            }
        });
        const claFilterByCategory = (category_id) => {
            cla.value.forWhoNeed = _.filter(
                props.data.classificatory.forWhoNeed,
                function (o) {
                    return o.category_id == category_id;
                }
            );
            cla.value.duty = _.filter(
                props.data.classificatory.duty,
                function (o) {
                    return o.category_id == category_id;
                }
            );
        };

        const watchCategory = () => m.value.vacancy.category;
        watch(watchCategory, (newVal) => {
            claFilterByCategory(newVal.id);
        });

        const startDate = (item) => {
            maxDate.value = item;
        };

        const chooseNumberCode = (item) => {
            model.value.number_code = item;
        };
        const handleFileChange = (event) => {
            file.value = event.target.files[0];
            model.value.file_name = file.value.name;
        };
        const addBenefit = (item) => {
            if (!m.value.benefit.some((benefit) => benefit.id == item.id)) {
                m.value.benefit.push(item);
                benefitText.value += `${item[`name_${getLang.value}`]}, `;
            }
        };

        const minAge = (item) => {
            const numberAsString = item.toString();
            if (numberAsString.length == 2 && item < 18) {
                m.value.demand.min_age = 18;
                toast.error("მინიმალური ასაკი არ უნდა იყოს 18 ზე ნაკლები", {
                    theme: "colored",
                    autoClose: 1000,
                });
                return;
            }
            if (numberAsString.length == 2) {
                min_age = item;
            } else if (numberAsString.length > 2) {
                m.value.demand.min_age = min_age;
            }
        };

        const maxAge = (item) => {
            const numberAsString = item.toString();
            if (numberAsString.length == 2 && item > 70) {
                m.value.demand.max_age = 70;
                toast.error(`მაქსიმალური ასაკი არ უნდა იყოს 70 ზე მეტი`, {
                    theme: "colored",
                    autoClose: 1000,
                });
                return;
            }

            if (numberAsString.length == 2) {
                max_age = item;
            } else if (numberAsString.length > 2) {
                m.value.demand.max_age = max_age;
            }
        };
        const checkStartDate = (data) => {
            if (data.vacancy.start_date < startDateMin.value) {
                toast.error(
                    "როდის გჭირდებათ კადრი თარიღი არ შეიძლება იყოს მიმდინარე თარიღზე ნაკლები",
                    {
                        theme: "colored",
                        autoClose: 2000,
                    }
                );
                return false;
            }
            return true;
        };

        const handelModalData = (item) =>{
            console.log('item', item);
            m.value.employer.additional_numbers.push(item);
        }
        const add = (item) => {
            let data = { ...item };
            showError.value = true;
            // if (file.value != null && file.value.type !== 'application/pdf') {
            //     toast.error("გთხოვთ ფაილი ატვირთეთ pdf ფორმატში", {
            //         theme: 'colored',
            //         autoClose: 1000,
            //     });
            //     return
            // }
            // if (data.has_recommendation.id == 1) {
            //     data[`name_${getLang.value}`] = data.name;
            //     data[`position_${getLang.value}`] = data.position;
            // }else{
            //     data[`no_reason_info_${getLang}`] = data.no_reason_info;
            // }
            // data.candidate_id = props.data.candidate_id
            // const sendFormData = new FormData();
            // sendFormData.append('data', JSON.stringify(data))
            // if (file.value) {
            //     sendFormData.append('file', file.value);
            // }
            // loader.value = true

            data.employer[`name_${getLang.value}`] = data.employer.name;
            data.employer[`address_${getLang.value}`] = data.employer.address;
            data.employer[`street_${getLang.value}`] = data.employer.street;
            data.vacancy[`additional_schedule_${getLang.value}`] =
                data.vacancy.additional_schedule;
            data.vacancy[`title_${getLang.value}`] = data.vacancy.title;
            data.lang = getLang.value;
            v.value.$touch();
            console.log("Validation state:", v.value.$invalid, v.value);
            if (!v.value.$invalid && checkStartDate(data)) {
                let html = `
                    ${data.vacancy.start_date}_დან ${
                    data.vacancy.term[`name_${getLang.value}`]
                },
                    ${
                        data.for_who_need
                            ? data.for_who_need
                                  .map((i) => i[`name_${getLang.value}`])
                                  .join(" და ")
                            : ""
                    } _სთვის
                    გვესაჭიროება ${
                        data.vacancy.category[`name_${getLang.value}`]
                    }.
                    მისამართი: ${data.employer[`address_${getLang.value}`]} ${
                    data.employer[`street_${getLang.value}`]
                },
                    გრაფიკი: ${
                        data.vacancy.work_schedule[`name_${getLang.value}`]
                    },
                    ${data.vacancy[`additional_schedule_${getLang.value}`]}.
                    ანაზღაურება: ${data.vacancy.payment} ${
                    data.vacancy.currency[`name_${getLang.value}`]
                }.

                `;
                // მოვალეობები: ${data.duty.map(i => i[`name_${getLang.value}`]).join(', ')}
                Swal.fire({
                    title: "<p>თქვენი ვაკანსია</p>",
                    // icon: 'info',
                    html: html,
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false,
                    confirmButtonText: "დამატება",
                    // icon: 'success',
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger",
                        popup: "swal-popup", // Custom class for the popup
                        title: "swal-title", // Custom class for the title
                        content: "swal-text", // Custom class for the content
                    },
                    width: "60%",
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        validateAndSubmit(data);
                    }
                });
            } else {
                loader.value = false;

                toast.warning("აუცილებელია სავალდებულო ველები იყოს შევსებული", {
                    theme: "colored",
                    autoClose: 2000,
                });
            }
        };
        const validateAndSubmit = (data) => {
            showError.value = false;
            send.value = true;
            loader.value = true;
            const csrfToken = document.head.querySelector(
                'meta[name="csrf-token"]'
            ).content;
            axios({
                method: "post",
                url: "/add_vacancy",
                data: data,
            })
                .then(function (response) {
                    if (response.data.status == 200) {
                        if (response.data.data.type == "e") {
                            toast.error(response.data.data.message, {
                                theme: "colored",
                                autoClose: 1000,
                            });
                            return;
                        }
                        loader.value = false;
                        m.value = formData;
                        showAlert(response.data.data.category_id);
                    }
                })
                .catch(function (error) {
                    // handle error
                    loader.value = false;
                    console.log(error);
                });
        };
        const showAlert = (id) => {
            //let html =  `ეწვიეთ ლინკს სადაც შეგიძლიათ მიიღოთ ინფორმაცია თქვენი ვაკანსიის შესახებ, თქვენი ტელეფონის ნომრის გამოყენებით`;
            Swal.fire({
                title: "<strong>ვაკანსია წარმატებით დაემატა</strong>",
                icon: "success",
                html: "",

                showCloseButton: true,
                confirmButtonText: "მთავარზე დაბრუნება",
                showCancelButton: false,
                focusConfirm: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = new URL(location.href);
                    if (props.data.model.role_id != 3) {
                        window.location.replace(
                            `${url.origin}/admin/vacancy?ka`
                        );
                    } else {
                        window.location.replace(
                            `${url.origin}/${getLang.value}/candidate_search/[${id}]`
                        );
                    }
                }
            });
        };
        const removeAdditionalNumber = (index, id) => {
            Swal.fire({
                title: "ნომრის წაშლა",
                text: "ნამდვილად გსურთ ნომრის წაშლა?",
                showCancelButton: true,
                confirmButtonText: "დიახ",
                cancelButtonText: "არა",
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
            }).then((result) => {
                if (result.isConfirmed) {

                    if (id) {
                        axios
                        .post(`/delete_additional_number/${id}`)
                        .then((response) => {
                            m.value.employer.additional_numbers.splice(index, 1);
                            if (response.data.status == 200) {
                                toast.success('წარმატებით წაიშალა', {
                                    theme: "colored",
                                    autoClose: 1000,
                                });
                            }
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                    }else{
                        m.value.employer.additional_numbers.splice(index, 1);
                    }

                }
            });
        };

        const openAdditionalNumberModal = () => {
            console.log(
                "openAdditionalNumberModal",
                showAdditionalNumberModal.value
            );
            showAdditionalNumberModal.value = !showAdditionalNumberModal.value;
        };
        onMounted(() => {
            if (
                m.value.vacancy &&
                m.value.vacancy.id &&
                m.value.vacancy.category_id
            ) {
                claFilterByCategory(m.value.vacancy.category_id);
            }
        });

        return {
            m,
            cla,
            v,
            validateAndSubmit,
            add,
            getLang,
            chooseNumberCode,
            handleFileChange,
            loader,
            fullPage,
            workInformationSchedule,
            benefitText,
            addBenefit,
            send,
            minAge,
            maxAge,
            localText,
            minDate,
            maxDate,
            startDate,
            termDisable,
            startDateMin,
            formData,
            searchData,
            customClasses,
            trackBy,
            label,
            isCategoryInvalid,
            showError,
            errorMessage,
            showAdditionalNumberModal,
            modalCla,
            openAdditionalNumberModal,
            handelModalClose: () => {
                showAdditionalNumberModal.value = false;
            },
            handelModalData,
            removeAdditionalNumber
        };
    },
};
</script>
<style scoped>
@media (max-width: 575.98px) {
    h2 {
        font-size: 16px;
        font-weight: 600;
    }
    h4 {
        font-size: 14px;
        font-weight: 600;
    }
    label {
        font-size: 12px;
        font-weight: 500;
    }
    .input-d {
        height: 10px;
    }
    .drop-btn {
        width: 30%;
    }
    .drop-span {
        display: none;
    }
    .site-button {
        width: 100%;
    }
}
/* @media (max-width: 768px) {
    .swal-popup {
        width: 90% !important;
    }
    .swal-title {
        font-size: 16px !important;
    }
    .swal-text {
        font-size: 12px !important;
    }
} */
</style>
