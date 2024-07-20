<template lang="">
    <!-- Modal -->
    <div
        v-if="showConfirm"
        class="modal fade show"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalCenterTitle"
        id="modalMap"
        aria-hidden="true"
        style="display: block"
    >
        <div
            class="modal-dialog modal-dialog-centered modal-xl"
            role="document"
        >
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">
                        რედაქტირება
                    </h6>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                        @click="hide()"
                    >
                        X
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6 mb-1">
                            <span class="text-danger">* </span>
                            <label for="exampleInputEmail1">სახელი გვარი</label>
                            <input
                                class="form-control"
                                :class="
                                    showError &&
                                    !v.employer.name_ka.required.$response
                                        ? 'border border-danger'
                                        : ''
                                "
                                v-model="m.employer.name_ka"
                                type="text"
                                placeholder="საახელი გვარი "
                            />
                            <ErrorMassage
                                v-if="
                                    showError &&
                                    !v.employer.name_ka.required.$response
                                "
                                name="required"
                            />
                        </div>
                        <div class="col-6">
                            <label>მაილი</label>
                            <input
                                class="form-control"
                                v-model="m.employer.email"
                                type="email"
                                placeholder="employer@gmail.com"
                            />
                        </div>
                        <div class="col-6">
                            <span class="text-danger">* </span>
                            <label>{{ "ტელეფონის ნომერი" }}</label>
                            <div class="input-group input-group mb-3">
                                <div class="input-group-prepend">
                                    <button
                                        type="button"
                                        class="btn btn-warning dropdown-toggle"
                                        data-toggle="dropdown"
                                    >
                                        <span
                                            :class="`fi fi-${numberCode.iso.toLowerCase()}`"
                                        ></span
                                        >+{{ numberCode.phonecode }}
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
                                </div>
                                <!-- /btn-group -->
                                <input
                                    type="text"
                                    class="form-control"
                                    :class="
                                        showError &&
                                        (!v.employer.number.required
                                            .$response ||
                                            !v.employer.number.numeric
                                                .$response)
                                            ? 'border border-danger'
                                            : ''
                                    "
                                    aria-label="Text input with dropdown button"
                                    v-model="m.employer.number"
                                    placeholder="555666777"
                                    onkeypress="return /[0-9]/i.test(event.key)"
                                />
                            </div>
                            <ErrorMassage
                                v-if="
                                    showError &&
                                    !v.employer.number.required.$response
                                "
                                name="required"
                            />
                            <ErrorMassage
                                v-if="
                                    showError &&
                                    !v.employer.number.numeric.$response
                                "
                                name="numeric"
                            />
                        </div>
                        <div class="col-6">
                            <span class="text-danger">* </span>
                            <label for="exampleInputEmail1"
                                >ქალაქი, დაბა, უბანი ან სოფელი</label
                            >
                            <input
                                class="form-control"
                                v-model="m.employer.address_ka"
                                type="text"
                            />
                            <ErrorMassage
                                v-if="
                                    showError &&
                                    !v.employer.address_ka.required.$response
                                "
                                name="required"
                            />
                        </div>
                        <div class="col-6">
                            <label for="exampleInputEmail1">ქუჩა</label>
                            <input
                                class="form-control"
                                v-model="m.employer['street_ka']"
                                type="text"
                            />
                        </div>
                    </div>
                    <div class="p-a20 my-3">
                        <h6 class="m-a0">
                            <i class="fa fa-info"></i> ძირითადი ინფორმაცია
                        </h6>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-4">
                            <span class="text-danger">* </span>
                            <label for="exampleInputEmail1">სათაური</label>
                            <input
                                class="form-control"
                                :class="
                                    !m.title_ka ? 'border border-danger' : ''
                                "
                                v-model="m['title_ka']"
                                type="text"
                                :placeholder="
                                    $t(
                                        'lang.employer_add_job_vacancy_name_placeholder'
                                    )
                                "
                            />
                            <ErrorMassage
                                v-if="
                                    showError && !v.title_ka.required.$response
                                "
                                name="required"
                            />
                        </div>
                        <div class="col-4">
                            <span class="text-danger">* </span>
                            <label>კატეგორია</label>
                            <div class="ls-inputicon-box">
                                <multiselect
                                    v-model="m.category"
                                    :options="cla.category"
                                    deselect-label="Can't remove this value"
                                    :track-by="'name_ka'"
                                    :label="'name_ka'"
                                    placeholder="Select one"
                                    :searchable="true"
                                    :allow-empty="false"
                                    @blur="v.category.$touch"
                                    disabled
                                >
                                </multiselect>
                            </div>
                            <ErrorMassage
                                v-if="
                                    showError && !v.category.required.$response
                                "
                                name="required"
                            />
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label
                                    ><span class="text-danger">* </span
                                    >{{ "ვისთვის გესაჭიროებათ?" }}</label
                                >
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.vacancy_for_who_need"
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
                                        :class="
                                            !m.vacancy_for_who_need
                                                ? 'border border-danger'
                                                : ''
                                        "
                                    >
                                    </multiselect>
                                </div>
                                <ErrorMassage
                                    v-if="
                                        showError &&
                                        !v.vacancy_for_who_need.required
                                            .$response
                                    "
                                    name="required"
                                />
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label
                                    for="workSchedule"
                                    class="required-field"
                                >
                                    <span class="text-danger">*</span>
                                    {{
                                        $t(
                                            "lang.user_profile_page_work_schedule_title"
                                        )
                                    }}
                                </label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.work_schedule"
                                        :options="cla.workSchedule"
                                        deselect-label="Can't remove this value"
                                        :track-by="'name_ka'"
                                        :label="'name_ka'"
                                        placeholder="Select one"
                                        :searchable="false"
                                        :allow-empty="false"
                                    >
                                    </multiselect>
                                </div>
                                <ErrorMassage
                                    v-if="
                                        showError &&
                                        !v.work_schedule.required.$response
                                    "
                                    name="required"
                                />
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label
                                    ><span class="text-danger">* </span
                                    >{{
                                        $t(
                                            "lang.user_profile_page_work_salary_title"
                                        )
                                    }}</label
                                >
                                <div class="ls-inputicon-box">
                                    <input
                                        class="form-control"
                                        v-model="m.payment"
                                        type="number"
                                        step="50"
                                    />
                                </div>
                                <ErrorMassage
                                    v-if="
                                        showError &&
                                        !v.payment.required.$response
                                    "
                                    name="required"
                                />
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label
                                    ><span class="text-danger">* </span
                                    >{{
                                        $t(
                                            "lang.user_profile_page_work_currency_title"
                                        )
                                    }}</label
                                >
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.currency"
                                        :options="cla.currency"
                                        deselect-label="Can't remove this value"
                                        :track-by="'name_ka'"
                                        :label="'name_ka'"
                                        placeholder="Select one"
                                        :searchable="false"
                                        :allow-empty="false"
                                    >
                                    </multiselect>
                                </div>
                                <ErrorMassage
                                    v-if="
                                        showError &&
                                        !v.currency.required.$response
                                    "
                                    name="required"
                                />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label
                                    ><span class="text-danger">* </span
                                    >{{
                                        $t("lang.employer_add_job_jobs_day")
                                    }}</label
                                >
                                <div class="ls-inputicon-box">
                                    <textarea
                                        class="form-control"
                                        v-model="m.additional_schedule_ka"
                                        type="text"
                                        placeholder=""
                                        rows="3"
                                    ></textarea>
                                </div>
                                <ErrorMassage
                                    v-if="
                                        showError &&
                                        !v.additional_schedule_ka.required
                                            .$response
                                    "
                                    name="required"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="p-a20 my-3">
                        <h6 class="m-a0">
                            <i class="fa fa-info"></i> დამატებით
                        </h6>
                    </div>
                    <hr />
                    <div
                        class="row mb-4"
                        v-if="
                            m.category.id == 1 ||
                            m.category.id == 2 ||
                            m.category.id == 4
                        "
                    >
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="exampleCheck1"
                                    value="1"
                                    v-model="m.go_vacation"
                                />
                                <label
                                    class="form-check-label"
                                    for="exampleCheck1"
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
                                    v-model="m.stay_night"
                                />
                                <label
                                    class="form-check-label"
                                    for="exampleCheck1"
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
                                    v-model="m.work_additional_hours"
                                />
                                <label
                                    class="form-check-label"
                                    for="exampleCheck1"
                                    >შეეძლო დამატებით საათებში მუშაობა</label
                                >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label
                                    ><span class="text-danger">* </span
                                    >{{
                                        $t("lang.employer_add_job_when_need")
                                    }}</label
                                >
                                <div class="ls-inputicon-box">
                                    <input
                                        class="form-control"
                                        v-model="m.start_date"
                                        type="date"
                                        placeholder=""
                                    />
                                </div>
                                <ErrorMassage
                                    v-if="
                                        showError &&
                                        !v.start_date.required.$response
                                    "
                                    name="required"
                                />
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label
                                    ><span class="text-danger">* </span
                                    >{{
                                        $t("lang.employer_add_job_how_long")
                                    }}</label
                                >
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.term"
                                        :options="cla.term"
                                        deselect-label="Can't remove this value"
                                        :track-by="'name_ka'"
                                        :label="'name_ka'"
                                        placeholder="Select one"
                                        :searchable="true"
                                        :allow-empty="false"
                                    >
                                    </multiselect>
                                </div>
                                <ErrorMassage
                                    v-if="
                                        showError && !v.term.required.$response
                                    "
                                    name="required"
                                />
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>{{ $t("ბენეფიტები") }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.vacancy_benefit"
                                        :options="cla.benefit"
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
                                    >
                                        <template
                                            slot="selection"
                                            slot-scope="{
                                                values,
                                                search,
                                                isOpen,
                                            }"
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

                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>{{
                                    $t(
                                        "lang.employer_add_job_comment_for_agency"
                                    )
                                }}</label>
                                <textarea
                                    class="form-control"
                                    v-model="m.comment"
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
                    </div>
                    <div class="p-a20 my-3">
                        <h6 class="m-a0">
                            <i class="fa fa-user"></i> მოთხოვნები კანდიდატის
                            მიმართ
                        </h6>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{
                                    $t("lang.employer_add_job_minimal_age")
                                }}</label>
                                <div class="ls-inputicon-box">
                                    <input
                                        class="form-control"
                                        v-model="m.demand.min_age"
                                        type="number"
                                        placeholder="25"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{
                                    $t("lang.employer_add_job_max_age")
                                }}</label>
                                <div class="ls-inputicon-box">
                                    <input
                                        class="form-control"
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
                                        :track-by="'name_ka'"
                                        :label="'name_ka'"
                                        :placeholder="
                                            $t('lang.employer_add_job_select')
                                        "
                                        :searchable="true"
                                        :allow-empty="false"
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
                                <label>{{ "სპეციალობა" }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.demand.specialty"
                                        :options="cla.specialties"
                                        deselect-label="Can't remove this value"
                                        :track-by="'name_ka'"
                                        :label="'name_ka'"
                                        :placeholder="
                                            $t('lang.employer_add_job_select')
                                        "
                                        :searchable="true"
                                        :allow-empty="false"
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
                                        :track-by="'name_ka'"
                                        :label="'name_ka'"
                                        :placeholder="
                                            $t('lang.employer_add_job_select')
                                        "
                                        :searchable="true"
                                        :allow-empty="false"
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
                                        "lang.employer_add_job_foreign_language_level"
                                    )
                                }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.demand.language_level"
                                        :options="cla.languageLevels"
                                        deselect-label="Can't remove this value"
                                        :track-by="'name_ka'"
                                        :label="'name_ka'"
                                        :placeholder="
                                            $t('lang.employer_add_job_select')
                                        "
                                        :searchable="true"
                                        :allow-empty="false"
                                    >
                                        <template
                                            slot="singleLabel"
                                            slot-scope="{ option }"
                                        ></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
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
                                    label="name_ka"
                                    track-by="name_ka"
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
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t("მართვის მოწმობა") }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.vacancy_driving_license"
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
                                        :class="
                                            !m.vacancy_duty
                                                ? 'border border-danger'
                                                : ''
                                        "
                                    >
                                        <template
                                            slot="selection"
                                            slot-scope="{
                                                values,
                                                search,
                                                isOpen,
                                            }"
                                            ><span
                                                class="multiselect__single"
                                                v-if="values.length"
                                                v-show="!isOpen"
                                                >{{ values.length }} options
                                                selected</span
                                            ></template
                                        >
                                    </multiselect>
                                    <!-- <span v-if="v$.m.familyWorkedSelected.required.$invalid && v$.m.familyWorkedSelected.$dirty" style='color:red'>* {{ v$.m.candidateFamilyWorkSkill.required.$message}}</span> -->
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-121 col-md-12 mt-2">
                            <div class="form-group">
                                <label>{{
                                    $t("lang.employer_add_job_duties")
                                }}</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.vacancy_duty"
                                        :options="cla.duty"
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
                                        :class="
                                            !m.vacancy_duty
                                                ? 'border border-danger'
                                                : ''
                                        "
                                    >
                                        <template
                                            slot="selection"
                                            slot-scope="{
                                                values,
                                                search,
                                                isOpen,
                                            }"
                                            ><span
                                                class="multiselect__single"
                                                v-if="values.length"
                                                v-show="!isOpen"
                                                >{{ values.length }} options
                                                selected</span
                                            ></template
                                        >
                                    </multiselect>
                                    <!-- <span v-if="v$.m.familyWorkedSelected.required.$invalid && v$.m.familyWorkedSelected.$dirty" style='color:red'>* {{ v$.m.candidateFamilyWorkSkill.required.$message}}</span> -->
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{
                                    $t(
                                        "lang.employer_add_job_additional_duties"
                                    )
                                }}</label>
                                <textarea
                                    class="form-control"
                                    v-model="m['additional_duty_ka']"
                                    type="text"
                                    placeholder=""
                                    rows="3"
                                ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="p-a20 my-3">
                        <h6 class="m-a0">
                            <i class="fa fa-clock"></i> გასაუბრება
                        </h6>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>{{ $t("გასაუბრების თარიღი") }}</label>
                                <div class="ls-inputicon-box">
                                    <input
                                        class="form-control"
                                        v-model="m.interviewDate"
                                        type="date"
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
                                        v-model="m.interview_place"
                                        :options="cla.interviewPlace"
                                        deselect-label="Can't remove this value"
                                        :track-by="'name_ka'"
                                        :label="'name_ka'"
                                        :placeholder="
                                            $t('lang.employer_add_job_select')
                                        "
                                        :searchable="true"
                                        :allow-empty="false"
                                    >
                                        <template
                                            slot="singleLabel"
                                            slot-scope="{ option }"
                                        ></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="exampleCheck4"
                                    value="1"
                                    v-model="m.demand.has_experience"
                                />
                                <label
                                    class="form-check-label"
                                    for="exampleCheck4"
                                    >გამოცდილების ქონა სავალდებულოა</label
                                >
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="exampleCheck5"
                                    value="1"
                                    v-model="m.demand.has_recommendation"
                                />
                                <label
                                    class="form-check-label"
                                    for="exampleCheck5"
                                    >რეკომენდაციის ქონა სავალდებულოა</label
                                >
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="p-a20 my-3 d-flex justify-content-between">
                        <h6 class="m-a0">
                            <i class="fa fa-phone"></i> დამატებითი საკონტაქტო
                            ნომრები
                        </h6>
                        <button
                            class="btn btn-info"
                            @click="openAdditionalNumberModal"
                        >
                            <i class="fa fa-plus"></i> ნომრის დამატება
                        </button>
                    </div>
                    <div
                        v-if="m.employer.additional_numbers.length > 0"
                        class="col-lg-12 col-md-12"
                    >
                        <div class="panel-body wt-panel-body">
                            <div class="p-a20 table-responsive">
                                <table
                                    class="table twm-table table-striped table-borderless"
                                >
                                    <thead>
                                        <tr>
                                            <th>N</th>
                                            <th>ნომერეი</th>
                                            <th>მფლობელი</th>
                                            <th>კომენტარი</th>
                                            <th>მოქმედება</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr
                                            v-for="(item, index) in m.employer
                                                .additional_numbers"
                                        >
                                            <td>{{ index + 1 }}</td>
                                            <td>
                                                {{
                                                    `+${item.number_code.phonecode} ${item.number}`
                                                }}
                                            </td>
                                            <td>
                                                {{ item.number_owner.name_ka }}
                                            </td>
                                            <td>{{ item.comment }}</td>
                                            <td>
                                                <button
                                                    @click="
                                                        removeAdditionalNumber(
                                                            index,
                                                            item.id
                                                        )
                                                    "
                                                    title="delete"
                                                >
                                                    <i
                                                        class="fa fa-trash-alt"
                                                    ></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        @click="hide()"
                    >
                        <i class=""></i>გაუქმება
                    </button>
                    <button
                        type="button"
                        class="btn btn-success"
                        @click.prevent="save()"
                        :disabled="buttonDisabled"
                    >
                        <i class=""></i>შენახვა
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, watch, computed, onMounted } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { required, numeric, maxLength, email } from "@vuelidate/validators";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import _ from "lodash";
import AdditionalNumberModal from "../../../employer/modal/AdditionalNumberModal.vue";
import axios from "axios"; // Ensure axios is imported if used for HTTP requests
import Swal from "sweetalert2";
import moment from "moment";
import ErrorMassage from "../../../plugins/ErrorMassage.vue";
const props = defineProps({
    visible: Boolean,
    item: Object,
});
const emit = defineEmits(["closeModal"]);
const showConfirm = ref(false);
const m = ref({
    category: {},
});
// const item = ref({});
const cla = ref([]);
const classificatory = ref({});
const numberCode = ref({
    phonecode: "",
    iso: "",
});
const editedFields = ref([]);
const showError = ref(false);
const buttonDisabled = ref(false);
const showAdditionalNumberModal = ref(false);

const getLang = computed(() => {
    const instance = I18n.getSharedInstance(); // Ensure I18n is imported or defined if used
    return instance.options.lang;
});
let currentDate = moment();
const startDateMin = ref(currentDate.add(1, "days").format("YYYY-MM-DD"));
watch(
    () => props.visible,
    (newValue) => {
        if (newValue) show();
    }
);

async function show() {
    try {
        let result = await getClassificatory();
        classificatory.value = { ...result.data };
        cla.value = result.data;
        let item = props.item;
        cla.value.forWhoNeed = _.filter(
            classificatory.value.forWhoNeed,
            function (o) {
                return o.category_id == item.category_id;
            }
        );
        cla.value.duty = _.filter(classificatory.value.duty, function (o) {
            return o.category_id == item.category_id;
        });
        m.value = makeModel(props.item);
        console.log(m.value);
        showConfirm.value = true;
    } catch (error) {
        console.log(error);
    }
}

function hide() {
    showConfirm.value = false;
    emit("closeModal", false);
}

function getClassificatory() {
    return axios.post("/get_classificatory", {});
}

function makeModel(item) {
    let [datePart, timePart] = item.interview_date.split(" ");
    const data = item;
    data.demand = !data.demand ? { vacancy_id: data.id } : data.demand;
    data.interviewDate = datePart;
    data.interviewTime = timePart;
    data.go_vacation = Boolean(data.go_vacation);
    data.stay_night = Boolean(data.stay_night);
    data.work_additional_hours = Boolean(data.work_additional_hours);
    data.demand.has_experience = Boolean(data.demand.has_experience);
    data.demand.has_recommendation = Boolean(data.demand.has_recommendation);
    data.lang = getLang.value;
    return { ...data };
}

function chooseNumberCode(item) {
    m.value.employer.number_code = item;
    numberCode.value = {
        phonecode: item.phonecode,
        iso: item.iso,
    };
}
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
// const customClasses = computed(() => ({
//     "is-invalid": isCategoryInvalid.value,
// }));
const rules = {
    employer: {
        name_ka: { required },
        number: { required, numeric },
        address_ka: { required },
        email: { email },
    },
    // title: { required, maxLength:maxLength(50) },
    title_ka: { required },
    category: { required },
    payment: { required },
    currency: { required },
    work_schedule: { required },
    additional_schedule_ka: { required },
    start_date: { required },
    term: { required },
    vacancy_for_who_need: { required },
};

const v = useVuelidate(rules, m);
function save() {
    if (m.value.title_ka == null || m.value.vacancy_for_who_need == null) {
        toast.error("აუცილებელია გაწითლებული ველების შევსება", {
            theme: "colored",
            autoClose: 1000,
        });
        return;
    }

    // Convert boolean values to 1 or 0
    m.value.go_vacation = m.value.go_vacation ? 1 : 0;
    m.value.stay_night = m.value.stay_night ? 1 : 0;
    m.value.work_additional_hours = m.value.work_additional_hours ? 1 : 0;
    m.value.demand.has_experience = m.value.demand.has_experience ? 1 : 0;
    m.value.demand.has_recommendation = m.value.demand.has_recommendation
        ? 1
        : 0;
    v.value.$touch();

    showError.value = false;
    if (v.value.$invalid) {
        showError.value = true;
        toast.error("აუცილებელია გაწითლებული ველების შევსება", {
            theme: "colored",
            autoClose: 1000,
        });
        return;
    }
    Swal.fire({
        title: "ნამდვილად გსურთ ვაკანსიის რედაქტირება?",
        cancelButtonText: "არა",
        confirmButtonText: "კი",
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            buttonDisabled.value = true;
            axios
                .post("/update_vacancy", {
                    data: { model: m.value },
                })
                .then(function (response) {
                    if (response.status == 200) {
                        toast.success("წარმატებით დარედაქტირდა", {
                            theme: "colored",
                            autoClose: 1000,
                        });
                        setTimeout(() => {
                            document.location.reload();
                        }, 2000);
                    }
                    buttonDisabled.value = false;
                })
                .catch(function (error) {
                    console.log(error);
                    buttonDisabled.value = false;
                });
        }
    });
    const openAdditionalNumberModal = () => {
        console.log(
            "openAdditionalNumberModal",
            showAdditionalNumberModal.value
        );
        showAdditionalNumberModal.value = !showAdditionalNumberModal.value;
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
                            m.value.employer.additional_numbers.splice(
                                index,
                                1
                            );
                            if (response.data.status == 200) {
                                toast.success("წარმატებით წაიშალა", {
                                    theme: "colored",
                                    autoClose: 1000,
                                });
                            }
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                } else {
                    m.value.employer.additional_numbers.splice(index, 1);
                }
            }
        });
    };
}

// Define other methods like `save` similarly
</script>
<style scoped>
.modal-body {
    height: 250px;
    overflow-y: auto;
}

@media (min-height: 500px) {
    .modal-body {
        height: 400px;
    }
}

@media (min-height: 800px) {
    .modal-body {
        height: 700px;
    }
}
</style>
