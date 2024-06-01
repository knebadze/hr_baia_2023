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
                        <i class="fa fa-"></i> რედაქტირების ისტორია
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
                    <!-- <div class=" p-a20 my-3">
                        <h6 class=" m-a0">დამსაქმებელი </h6>
                    </div>
                    <hr> -->
                    <div class="border border-primary p-2">
                        <div class="row">
                            <!-- <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>ველის სახელი</label>
                                    <div class="ls-inputicon-box">
                                        <select class="form-control" id="exampleFormControlSelect1" v-model="m.column_name">
                                            <option value="">ყველა</option>
                                            <option v-for="(item, index) in column" :key="index" :value="item">{{ item }} </option>
                                        </select>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>თარიღი (დან)</label>
                                    <div class="ls-inputicon-box">
                                        <input
                                            class="form-control"
                                            type="date"
                                            v-model="m.date_from"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>თარიღი (მდე)</label>
                                    <div class="ls-inputicon-box">
                                        <input
                                            class="form-control"
                                            type="date"
                                            v-model="m.date_to"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-wrap">
                            <thead>
                                <tr>
                                    <th>შეცვალა</th>
                                    <th>როლი</th>
                                    <th>შეიცვალა</th>
                                    <th>ძველი მნიშვნელობა</th>
                                    <th>ახალი მნიშვნელობა</th>
                                    <th>თარიღი</th>
                                    <th>მოქმედება</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in data" :key="index" :class="{'bg-info': item.event==='created'}">
                                    <td>
                                        {{ item.name_ka ?? "დამსაქმებელი" }}
                                    </td>
                                    <td>
                                        {{
                                            item.role_id == 1
                                                ? "ადმინი"
                                                : item.role_id == 2
                                                ? "HR"
                                                : item.role_id == 3
                                                ? "კანდიდატი"
                                                : "დამსაქმებელი"
                                        }}
                                    </td>
                                    <td>{{ item.type }}</td>
                                    <td>{{ item.properties.old }}</td>
                                    <td>{{ item.properties.attributes }}</td>
                                    <td>{{ item.created_at }}</td>
                                    <td>{{ item.event }}</td>
                                    <!-- <td>{{ item.column_name }}</td>
                                <td :class="(item.old_value == 'ცარიელი იყო')?'text-danger':''">{{ item.old_value }}</td>
                                <td>{{ item.hr}}</td>
                                <td>{{ item.created_at}}</td> -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary mr-3"
                        @click="hide()"
                    >
                        <i class=""></i>გაუქმება
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import moment from "moment";
export default {
    props: {
        visible: Boolean,
        vacancyId: Number,
    },
    data() {
        return {
            showConfirm: false,
            data: {},
            staticData: {},
            column: {
                name_ka: "სახელი გვარი KA",
                name_en: "სახელი გვარი EN",
                name_ru: "სახელი გვარი RU",
                email: "მაილი",
                number: "ნომერი",
                number_code: "ნომრის კოდი",
                address_ka: "მისამართი KA",
                address_en: "მისამართი EN",
                address_ru: "მისამართი RU",
                street_ka: "ქუჩა KA",
                street_ka: "ქუჩა EN",
                street_ka: "ქუჩა RU",
                title_ka: "სათაური KA",
                title_en: "სათაური EN",
                title_ru: "სათაური RU",
                vacancy_for_who_need: "ვისთვის გესაჭიროებათ?",
                category_id: "კატეგორია_id",
                work_schedule_id: "გრაფიკი_id",
                payment: "ანაზღაურება",
                currency_id: "ვალუტა_id",
                additional_schedule_ka: "სამუშაო დღეები და საათები KA",
                additional_schedule_en: "სამუშაო დღეები და საათები EN",
                additional_schedule_ru: "სამუშაო დღეები და საათები RU",
                status_id: "სტატუსი_id",
                status_change_reason: "სტატუსის შეცვლის მიზეზი",
                go_vacation: "არდადეგებზე გაყოლა",
                stay_night: "ღამე დარჩენა",
                work_additional_hours: "დამატებითი სათები მუშაობა",
                start_date: "დაწყების თარიღი",
                term_id: "ვადა_id",
                vacancy_benefit: "ბენეფიტები",
                comment: "კომენტარი სააგენტოსთვის",
                min_age: "მინიმალური ასაკი",
                max_age: "მაქსიმალური ასაკი",
                education_id: "განათლება_id",
                specialty_id: "სპეციალობა_id",
                language_id: "უცხო ენა_id",
                language_level_id: "უცხო ენის ცოდნის დონე_id",
                characteristic: "მახასიათებლები",
                vacancy_duty: "მოვალეობები",
                additional_duty_ka: "მოვალეობები დამატებით",
                interview_place_id: "გასაუბრების ადგილი_id",
                must_be_enrolled_employer: "დამსაქმებლისგან ჩასარიცხი დარჩა",
                employer_initial_amount: "დამსაქმებლისგან უნდა ჩაირიცხოს",
                must_be_enrolled_candidate: "კანდიდატისგან ჩასარიცხი დარჩა",
                candidate_initial_amount: "კანდიდატისგან უნდა ჩაირიცხოს",
                must_be_enrolled_employer_date:
                    "დამსაქმებლისგან უნდა ჩაირიცხოს თარიღი",
                must_be_enrolled_candidate_date:
                    "კანდიდატისგან უნდა ჩაირიცხოს თარიღი",
                enrolled_candidate: "კანდიდატისგან ჩაირიცხა",
                enrolled_employer: "დამსაქმებლისგან ჩაირიცხა",
                enrolled_candidate_date:
                    "კანდიდატისგან თანხის ჩარიცხვის თარიღი",
                enrolled_employer_date:
                    "დამსაქმებლისგან თანხის ჩარიცხვის თარიღი",
                hr_bonus: "ჰრ_ის ანაზღაურება",
                interview_date: "გასაუბრების თარიღი",
                end_date: "დასრულების თარიღი",
                start_date: "დაწყების თარიღი",
                qualifying_type_id: "შერჩეული კადრის_ტიპის_id",
                "interviewPlace.name_ka": "ინტერვიუს ადგილი",
                "currency.name_ka": "ვალუტა",
                "term.name_ka": "ვადა",
                "workSchedule.name_ka": "გრაფიკი",
                "reasonForCancel.name_ka": "გაუქმების მიზეზი",
                "hr.user.name": "HR",
                "category.name_ka": "კატეგორია",
                "language.name_ka": "უცხო ენა",
                "languageLevel.name_ka": "ცოდნის დონე",
                "education.name_ka": "განათლება",
                "specialty.name_ka": "პროფესია",
            },
            m: {},
        };
    },
    created() {
        // this.showConfirm = this.visible
    },
    computed: {
        getLang() {
            return I18n.getSharedInstance().options.lang;
        },
    },
    methods: {
        async show() {
            try {
                let result = await this.getInfo();
                // return
                this.data = this.makeData(result.data);
                this.staticData = this.makeData(result.data);
                this.showConfirm = true;
            } catch (error) {
                console.log(error);
            }
        },
        getInfo() {
            return axios.post("/get_vacancy_redacted_history_info", {
                data: this.vacancyId,
            });
        },
        hide() {
            this.showConfirm = false;
        },
        makeData(item) {
            const descriptionTypeMap = {
                Sync_driving_license: "მართვის მოწმობა",
                Sync_duty: "მოვალეობა",
                Sync_benefit: "ბენეფიტები",
                Sync_for_who_need: "ვისთვის",
                Sync_characteristic: "მახასიათებელი",
            };

            const subjectTypeMap = {
                "App\\Models\\Vacancy": "ვაკანსია",
                "App\\Models\\VacancyDeposit": "დეპოზიტი",
                "App\\Models\\Employer": "დამსაქმებელი",
                "App\\Models\\VacancyDemand": "ინფორმაცია კადრზე",
                "App\\Models\\QualifyingCandidate": "შერჩეული პერსონალი",
                "App\\Models\\VacancyReminder": "შეხსენება",
            };
            const obj = (item) => {
                let newItem = {};
                // let notFoundKeys = [];
                for (let key in item) {
                    if (this.column.hasOwnProperty(key)) {
                        newItem[this.column[key]] = item[key];
                    } else {
                        newItem[key] = item[key];
                    }
                }
                return newItem;
            };
            for (let i = 0; i < item.length; i++) {
                const element = item[i];
                // Map element.subject_type to element.type
                element.type =
                    subjectTypeMap[element.subject_type] ||
                    element.subject_type;

                // Map element.description to element.type
                element.type =
                    descriptionTypeMap[element.description] || element.type;

                element.created_at = moment(element.created_at).format(
                    "YYYY-MM-DD HH:mm"
                );
                element.properties.old = obj(element.properties.old);
                element.properties.attributes = obj(
                    element.properties.attributes
                );
            }
            return item;
        },
    },
    watch: {
        visible: function () {
            this.show();
        },
        "m.column_name": function (newVal, oldVal) {
            if (newVal == "" && oldVal != undefined) {
                this.data = this.staticData;
                return;
            }
            let data = this.data;
            this.data = _.filter(data, function (o) {
                return o.column_name === newVal;
            });
        },
        "m.date_from": function (newVal, oldVal) {
            if (newVal == "" && oldVal != undefined) {
                this.data = this.staticData;
                return;
            }
            let data = { ...this.staticData };
            this.data = _.filter(data, function (o) {
                return (
                    moment(o.created_at).format("YYYY-MM-DD") >=
                    moment(newVal).format("YYYY-MM-DD")
                );
            });
        },
        "m.date_to": function (newVal, oldVal) {
            if (newVal == "" && oldVal != undefined) {
                this.data = this.staticData;
                return;
            }
            let data = { ...this.staticData };
            this.data = _.filter(data, function (o) {
                return (
                    moment(o.created_at).format("YYYY-MM-DD") <=
                    moment(newVal).format("YYYY-MM-DD")
                );
            });
        },
    },
};
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
