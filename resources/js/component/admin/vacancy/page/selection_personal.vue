<template lang="">
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">პერსონალის შერჩევა</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <h1 class="m-0 text-right">
                            ID:
                            <u
                                class="text-primary"
                                @click="
                                    openVacancyFullInfoModal(data.vacancy.id)
                                "
                                >{{ data.vacancy.code }}</u
                            >
                        </h1>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <hr />
        </div>
        <section class="content">
            <div class="container-fluid">
                <div id="accordion">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4
                                class="card-title w-100 d-flex justify-content-between"
                            >
                                <a
                                    class="d-block w-100"
                                    data-toggle="collapse"
                                    href="#collapseOne"
                                >
                                    პერსონალის ძიება
                                </a>
                                <i class="fas fa-angle-down float-right"></i>
                            </h4>
                        </div>
                        <div
                            id="collapseOne"
                            class="collapse"
                            :class="colspan"
                            data-parent="#accordion"
                        >
                            <div class="card-body">
                                <!-- <h5 class="ml-2"><i class="fa fa-map" ></i> ინფორმაცია სარეგისტრატორო უბანზე:</h5> -->
                                <div class="row">
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>სახელი გვარი</label>
                                            <div class="ls-inputicon-box">
                                                <input
                                                    class="form-control"
                                                    v-model="m.name"
                                                    type="text"
                                                    placeholder="Devid Smith"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>ტელეფონის ნომერი</label>
                                            <div class="ls-inputicon-box">
                                                <input
                                                    class="form-control"
                                                    v-model="m.number"
                                                    type="text"
                                                    placeholder="555444333"
                                                    onkeypress="return event.which != 32"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>პირადი ნომერი</label>
                                            <div class="ls-inputicon-box">
                                                <input
                                                    class="form-control"
                                                    v-model="m.personal_number"
                                                    type="text"
                                                    placeholder="01234567890"
                                                    onkeypress="return event.which != 32"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>მისამართი</label>
                                            <div class="ls-inputicon-box">
                                                <input
                                                    class="form-control"
                                                    v-model="m.address"
                                                    type="text"
                                                    placeholder="თბილის სამგორი კახეთის გზატკეცილი"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label class="ml-4"> ასაკი</label>
                                            <div class="ls-inputicon-box mt-4">
                                                <!-- <input class="form-control" v-model="m.min_age"  type="number" placeholder="25"> -->
                                                <Slider
                                                    v-model="m.age"
                                                    :min="18"
                                                    :step="10"
                                                    class="slider"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>მაქსიმალური ასაკი</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.max_age"  type="number" placeholder="45">
                                    </div>
                                </div>
                            </div> -->
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>სიმაღლე</label>
                                            <div class="ls-inputicon-box mt-4">
                                                <!-- <input class="form-control" v-model="m.height"  type="number" placeholder="168"> -->
                                                <Slider
                                                    v-model="m.height"
                                                    :min="140"
                                                    :max="220"
                                                    :step="10"
                                                    class="slider"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>წონა</label>
                                            <div class="ls-inputicon-box mt-4">
                                                <!-- <input class="form-control" v-model="m.weight"  type="number" placeholder="75"> -->
                                                <Slider
                                                    v-model="m.weight"
                                                    :min="40"
                                                    :max="180"
                                                    :step="10"
                                                    class="slider"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>სქესი</label>
                                            <div class="ls-inputicon-box">
                                                <multiselect
                                                    v-model="m.gender"
                                                    :options="cla.gender"
                                                    deselect-label="Can't remove this value"
                                                    track-by="name_ka"
                                                    label="name_ka"
                                                    placeholder="Select one"
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
                                            <label>ეროვნება</label>
                                            <div class="ls-inputicon-box">
                                                <multiselect
                                                    v-model="m.nationality"
                                                    :options="cla.nationality"
                                                    :multiple="true"
                                                    :close-on-select="false"
                                                    :clear-on-select="false"
                                                    :preserve-search="true"
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
                                                            >{{
                                                                values.length
                                                            }}
                                                            options
                                                            selected</span
                                                        ></template
                                                    >
                                                </multiselect>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>მოქალაქეობა</label>
                                            <div class="ls-inputicon-box">
                                                <multiselect
                                                    v-model="m.citizenship"
                                                    :options="cla.citizenship"
                                                    :multiple="true"
                                                    :close-on-select="false"
                                                    :clear-on-select="false"
                                                    :preserve-search="true"
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
                                                            >{{
                                                                values.length
                                                            }}
                                                            options
                                                            selected</span
                                                        ></template
                                                    >
                                                </multiselect>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>რელიგია</label>
                                            <div class="ls-inputicon-box">
                                                <multiselect
                                                    v-model="m.religion"
                                                    :options="cla.religions"
                                                    :multiple="true"
                                                    :close-on-select="false"
                                                    :clear-on-select="false"
                                                    :preserve-search="true"
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
                                                            >{{
                                                                values.length
                                                            }}
                                                            options
                                                            selected</span
                                                        ></template
                                                    >
                                                </multiselect>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>განათლება</label>
                                            <div class="ls-inputicon-box">
                                                <multiselect
                                                    v-model="m.education"
                                                    :options="cla.educations"
                                                    :multiple="true"
                                                    :close-on-select="false"
                                                    :clear-on-select="false"
                                                    :preserve-search="true"
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
                                                            >{{
                                                                values.length
                                                            }}
                                                            options
                                                            selected</span
                                                        ></template
                                                    >
                                                </multiselect>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>პროფესია</label>
                                            <div class="ls-inputicon-box">
                                                <multiselect
                                                    v-model="m.profession"
                                                    :options="cla.professions"
                                                    :multiple="true"
                                                    :close-on-select="false"
                                                    :clear-on-select="false"
                                                    :preserve-search="true"
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
                                                            >{{
                                                                values.length
                                                            }}
                                                            options
                                                            selected</span
                                                        ></template
                                                    >
                                                </multiselect>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>სპეციალობა</label>
                                            <div class="ls-inputicon-box">
                                                <multiselect
                                                    v-model="m.specialty"
                                                    :options="cla.specialties"
                                                    :multiple="true"
                                                    :close-on-select="false"
                                                    :clear-on-select="false"
                                                    :preserve-search="true"
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
                                                            >{{
                                                                values.length
                                                            }}
                                                            options
                                                            selected</span
                                                        ></template
                                                    >
                                                </multiselect>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>უცხო ენა</label>
                                            <div class="ls-inputicon-box">
                                                <multiselect
                                                    v-model="m.language"
                                                    :options="cla.languages"
                                                    :multiple="true"
                                                    :close-on-select="false"
                                                    :clear-on-select="false"
                                                    :preserve-search="true"
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
                                                            >{{
                                                                values.length
                                                            }}
                                                            options
                                                            selected</span
                                                        ></template
                                                    >
                                                </multiselect>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>ცოდნის დონე</label>
                                            <div class="ls-inputicon-box">
                                                <multiselect
                                                    v-model="m.language_level"
                                                    :options="
                                                        cla.languageLevels
                                                    "
                                                    :multiple="true"
                                                    :close-on-select="false"
                                                    :clear-on-select="false"
                                                    :preserve-search="true"
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
                                                            >{{
                                                                values.length
                                                            }}
                                                            options
                                                            selected</span
                                                        ></template
                                                    >
                                                </multiselect>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>მართვის მოწმობა</label>
                                            <div class="ls-inputicon-box">
                                                <multiselect
                                                    v-model="m.drivingLicense"
                                                    :options="
                                                        cla.drivingLicense
                                                    "
                                                    :multiple="true"
                                                    :close-on-select="false"
                                                    :clear-on-select="false"
                                                    :preserve-search="true"
                                                    label="name"
                                                    track-by="name"
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
                                                            >{{
                                                                values.length
                                                            }}
                                                            options
                                                            selected</span
                                                        ></template
                                                    >
                                                </multiselect>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>ალერგია</label>
                                            <div class="ls-inputicon-box">
                                                <multiselect
                                                    v-model="m.allergy"
                                                    :options="cla.allergies"
                                                    :multiple="true"
                                                    :close-on-select="false"
                                                    :clear-on-select="false"
                                                    :preserve-search="true"
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
                                                            >{{
                                                                values.length
                                                            }}
                                                            options
                                                            selected</span
                                                        ></template
                                                    >
                                                </multiselect>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>ზოგადი მახასიათებლები</label>
                                            <div class="ls-inputicon-box">
                                                <multiselect
                                                    v-model="m.characteristic"
                                                    :options="
                                                        cla.characteristic
                                                    "
                                                    :multiple="true"
                                                    :close-on-select="false"
                                                    :clear-on-select="false"
                                                    :preserve-search="true"
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
                                                            >{{
                                                                values.length
                                                            }}
                                                            options
                                                            selected</span
                                                        ></template
                                                    >
                                                </multiselect>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>ოჯახური მდგომარეობა</label>
                                            <div class="ls-inputicon-box">
                                                <multiselect
                                                    v-model="m.maritalStatus"
                                                    :options="cla.maritalStatus"
                                                    :multiple="true"
                                                    :close-on-select="false"
                                                    :clear-on-select="false"
                                                    :preserve-search="true"
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
                                                            >{{
                                                                values.length
                                                            }}
                                                            options
                                                            selected</span
                                                        ></template
                                                    >
                                                </multiselect>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-xl-4 col-lg-6 col-md-12" >
                                <div class="form-group">
                                    <label>ალერგია</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.education"  :options="cla.allergies" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false" >
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div> -->
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>შვილების რაოდენობა</label>
                                            <div class="ls-inputicon-box">
                                                <input
                                                    class="form-control"
                                                    v-model="m.children"
                                                    type="text"
                                                    placeholder="2"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 border"></div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>კატეგორია</label>
                                            <div class="ls-inputicon-box">
                                                <multiselect
                                                    v-model="m.category"
                                                    :options="cla.category"
                                                    :multiple="true"
                                                    :close-on-select="false"
                                                    :clear-on-select="false"
                                                    :preserve-search="true"
                                                    label="name_ka"
                                                    track-by="name_ka"
                                                    :preselect-first="false"
                                                    disabled
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
                                                            >{{
                                                                values.length
                                                            }}
                                                            options
                                                            selected</span
                                                        ></template
                                                    >
                                                </multiselect>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>გრაფიკი</label>
                                            <div class="ls-inputicon-box">
                                                <multiselect
                                                    v-model="m.work_schedule"
                                                    :options="cla.workSchedule"
                                                    :multiple="true"
                                                    :close-on-select="false"
                                                    :clear-on-select="false"
                                                    :preserve-search="true"
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
                                                            >{{
                                                                values.length
                                                            }}
                                                            options
                                                            selected</span
                                                        ></template
                                                    >
                                                </multiselect>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>ანაზღაურება</label>
                                            <div class="ls-inputicon-box mt-4">
                                                <!-- <input class="form-control" v-model="m.weight"  type="number" placeholder="75"> -->
                                                <Slider
                                                    v-model="m.payment"
                                                    :min="50"
                                                    :max="5000"
                                                    :step="10"
                                                    class="slider"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 border"></div>
                                    <div
                                        class="col-xl-4 col-lg-6 col-md-12 mt-3"
                                    >
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
                                                >შეეძლოს არდადეგებზე
                                                გაყოლა</label
                                            >
                                        </div>
                                    </div>
                                    <div
                                        class="col-xl-4 col-lg-6 col-md-12 mt-3"
                                    >
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
                                                for="exampleCheck2"
                                                >შეეძლოს ღამე დარჩენა</label
                                            >
                                        </div>
                                    </div>
                                    <div
                                        class="col-xl-4 col-lg-6 col-md-12 mt-3"
                                    >
                                        <div class="form-check">
                                            <input
                                                type="checkbox"
                                                class="form-check-input"
                                                id="exampleCheck3"
                                                value="1"
                                                v-model="
                                                    m.work_additional_hours
                                                "
                                            />
                                            <label
                                                class="form-check-label"
                                                for="exampleCheck3"
                                                >შეეძლო დამატებით საათებში
                                                მუშაობა</label
                                            >
                                        </div>
                                    </div>
                                    <div
                                        class="col-xl-4 col-lg-6 col-md-12 mt-3"
                                    >
                                        <div class="form-check">
                                            <input
                                                type="checkbox"
                                                class="form-check-input"
                                                id="exampleCheck4"
                                                value="1"
                                                v-model="m.convection"
                                            />
                                            <label
                                                class="form-check-label"
                                                for="exampleCheck4"
                                                >არა ნასამართლევი</label
                                            >
                                        </div>
                                    </div>
                                    <div
                                        class="col-xl-4 col-lg-6 col-md-12 mt-3"
                                    >
                                        <div class="form-check">
                                            <input
                                                type="checkbox"
                                                class="form-check-input"
                                                id="exampleCheck5"
                                                value="1"
                                                v-model="m.smoke"
                                            />
                                            <label
                                                class="form-check-label"
                                                for="exampleCheck5"
                                                >არა მწეველი</label
                                            >
                                        </div>
                                    </div>
                                    <div
                                        class="col-xl-4 col-lg-6 col-md-12 mt-3"
                                    >
                                        <div class="form-check">
                                            <input
                                                type="checkbox"
                                                class="form-check-input"
                                                id="exampleCheck6"
                                                value="1"
                                                v-model="m.work_abroad"
                                            />
                                            <label
                                                class="form-check-label"
                                                for="exampleCheck6"
                                                >შეეძლო საზღვარ გარეთ
                                                მუშაობა</label
                                            >
                                        </div>
                                    </div>
                                    <div
                                        class="col-xl-4 col-lg-6 col-md-12 mt-3"
                                    >
                                        <div class="form-check">
                                            <input
                                                type="checkbox"
                                                class="form-check-input"
                                                id="exampleCheck7"
                                                value="1"
                                                v-model="
                                                    m.has_general_work_experience
                                                "
                                            />
                                            <label
                                                class="form-check-label"
                                                for="exampleCheck7"
                                                >ზოგადი სამუშაო
                                                გამოცდილება</label
                                            >
                                        </div>
                                    </div>
                                    <div
                                        class="col-xl-4 col-lg-6 col-md-12 mt-3"
                                    >
                                        <div class="form-check">
                                            <input
                                                type="checkbox"
                                                class="form-check-input"
                                                id="exampleCheck8"
                                                value="1"
                                                v-model="
                                                    m.has_family_work_experience
                                                "
                                            />
                                            <label
                                                class="form-check-label"
                                                for="exampleCheck8"
                                                >ოჯახში მუშაობის
                                                გამოცდილება</label
                                            >
                                        </div>
                                    </div>
                                    <div
                                        class="col-xl-4 col-lg-6 col-md-12 mt-3"
                                    >
                                        <div class="form-check">
                                            <input
                                                type="checkbox"
                                                class="form-check-input"
                                                id="exampleCheck9"
                                                value="1"
                                                v-model="m.has_recommendation"
                                            />
                                            <label
                                                class="form-check-label"
                                                for="exampleCheck9"
                                                >რეკომენდაცია</label
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button
                                    type="button"
                                    class="btn btn-success"
                                    @click="findCandidate()"
                                >
                                    <i class="fa fa-search"></i> ძებნა
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            <select_personal_table
                v-if="candidate.length > 0"
                :data="modalData"
                :key="tableKey"
            ></select_personal_table>
            <div class="mt-2" v-if="candidate.length > 0">
                <paginate
                    v-model="pagination.current_page"
                    :page-count="pagination.last_page"
                    :page-range="3"
                    :margin-pages="2"
                    :click-handler="findCandidate"
                    :prev-text="'უკან'"
                    :next-text="'წინ'"
                    :container-class="'pagination'"
                    :page-class="'page-item'"
                />
            </div>
        </section>
        <vacancyFullInfoModal :visible="vacancyFullInfoModalShow" :vacancyId="vacancy_id"></vacancyFullInfoModal>
    </div>
</template>
<script setup>
import Slider from "@vueform/slider";
import select_personal_table from "../component/selectionPersonal/select_personal_table.vue";
import paginate from "vuejs-paginate-next";
import { reactive, ref } from "vue";
import vacancyFullInfoModal from '../modal/vacancyFullInfoModal.vue';
const props = defineProps({
    data: Object,
});
const m = reactive({});
const cla = ref(null);
const candidate = ref([]);
const colspan = ref("show");
const modalData = reactive({});
const vacancy = ref(null);
const tableKey = ref(0);
const pagination = ref({
    current_page: 1,
    last_page: 2,
});
cla.value = props.data.classificatory;
m.height = [140, 220];
m.weight = [40, 180];
m.payment = props.data.vacancy.payment
    ? [props.data.vacancy.payment - 300, props.data.vacancy.payment + 300]
    : [100, 2000];
m.category = props.data.vacancy.category;
m.work_schedule = props.data.vacancy.work_schedule;
if (props.data.vacancy.demand) {
    m.age =
        props.data.vacancy.demand.min_age && props.data.vacancy.demand.max_age
            ? [
                  props.data.vacancy.demand.min_age,
                  props.data.vacancy.demand.max_age,
              ]
            : [18, 80];
    m.education = props.data.vacancy.demand.education
        ? [props.data.vacancy.demand.education]
        : "";
    m.specialty = props.data.vacancy.demand.specialty
        ? [props.data.vacancy.demand.specialty]
        : "";
    m.language = props.data.vacancy.demand.language
        ? [props.data.vacancy.demand.language]
        : "";
    m.language_level = props.data.vacancy.demand.language_level
        ? [props.data.vacancy.demand.language_level]
        : "";
} else {
    m.age = [18, 100];
}

m.drivingLicense = props.data.vacancy.get_vacancy_driving_license.map(
    (el) => el.driving_license
);
m.characteristic = props.data.vacancy.characteristic
    ? props.data.vacancy.characteristic
    : "";
m.go_vacation = props.data.vacancy.go_vacation == 1 ? true : "";
m.work_additional_hours =
    props.data.vacancy.work_additional_hours == 1 ? true : "";
m.stay_night = props.data.vacancy.stay_night == 1 ? true : "";
vacancy.value = {
    vacancy_id: props.data.vacancy.id,
    vacancy_code: props.data.vacancy.code,
    interview_place_id: props.data.vacancy.interview_place_id,
    interview_place: props.data.vacancy.interview_place,
    interview_date: props.data.vacancy.interview_date,
    start_date: props.data.vacancy.start_date,
};
modalData["vacancy"] = vacancy.value;

const findCandidate = () => {
    const filteredObject = _.pickBy(
        m,
        (value) => value !== null && !_.isEmpty(value)
    );
    colspan.value = "hide";
    axios
        .post(
            `/find_personal?page=${pagination.value.current_page}`,
            filteredObject
        )
        .then(function (response) {
            // handle success
            console.log(response.data.data);
            candidate.value = response.data.data;
            modalData["candidate"] = response.data.data;
            pagination.value = {
                current_page: response.data.current_page,
                last_page: response.data.last_page,
            };
            tableKey.value++;
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        });
};
const vacancyFullInfoModalShow = ref(false);
const vacancy_id = ref(null);
const openVacancyFullInfoModal = (id) => {
    vacancy_id.value = id;
    vacancyFullInfoModalShow.value = !vacancyFullInfoModalShow.value;
};
</script>
<style scoped>
.slider {
    --slider-height: 12px;
}
</style>
