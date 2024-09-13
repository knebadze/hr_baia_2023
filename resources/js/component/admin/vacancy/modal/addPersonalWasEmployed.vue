<template lang="">
    <!-- Modal -->
    <div
        v-if="showConfirm"
        class="modal fade show"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalCenterTitle"
        id="modalMap"
        style="display: block"
    >
        <div
            class="modal-dialog modal-dialog-centered modal-xl"
            role="document"
        >
            <div class="modal-content border border-danger">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">
                        კანდიდატის გადაყვანა ვაკანსის (ID:{{ item.code }})
                        დასაქმებულის სტატუსში
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>აირჩიე კანდიდატი</label>
                                <div class="ls-inputicon-box">
                                    <select
                                        class="form-control"
                                        id="exampleFormControlSelect1"
                                        v-model="m.candidate_id"
                                    >
                                        <option value="">არცერთი</option>
                                        <option
                                            v-for="(
                                                item, index
                                            ) in info.candidates"
                                            :key="index"
                                            :value="item"
                                        >
                                            {{
                                                `${
                                                    item.candidate.user.name_ka
                                                } - (ID: ${
                                                    item.candidate_id
                                                }) - ${
                                                    item.qualifying_type.name
                                                } - (${
                                                    item.status
                                                        ? item.status.name_ka
                                                        : ""
                                                })`
                                            }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>აირჩიე დასაქმების ტიპი</label>
                                <div class="ls-inputicon-box">
                                    <select
                                        class="form-control"
                                        id="exampleFormControlSelect1"
                                        v-model="m.employ_type"
                                        :disabled="disabled"
                                    >
                                        <option value="0">არცერთი</option>
                                        <option
                                            v-for="(
                                                item, index
                                            ) in info.employ_type"
                                            :key="index"
                                            :value="item"
                                        >
                                            {{ item.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div
                            class="row col-md-12"
                            v-if="isWorkScheduleInPeriod"
                        >
                            <div class="col-md-6">
                                <label>აირჩიე სამუშაო დღეები</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.week_day"
                                        :options="day"
                                        :multiple="true"
                                        :close-on-select="false"
                                        :clear-on-select="false"
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
                                                >{{ values.length }} options
                                                selected</span
                                            ></template
                                        >
                                    </multiselect>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>დაწყების თარიღი</label>
                                <div class="ls-inputicon-box">
                                    <input
                                        class="form-control"
                                        type="date"
                                        v-model="m.vacancy.start_date"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 border mb-3"></div>
                    <h6><i class="fa fa-search"></i>ან მოძებნე</h6>
                    <hr />
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>კანდიდატის ID</label>
                                <div class="ls-inputicon-box">
                                    <input
                                        type="text"
                                        class="form-control"
                                        :class="{ 'is-invalid': searchError }"
                                        id=""
                                        v-model="search.id"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>სახელი გვარი</label>
                                <div class="ls-inputicon-box">
                                    <input
                                        type="text"
                                        class="form-control"
                                        :class="{ 'is-invalid': searchError }"
                                        id=""
                                        v-model="search.name"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>ნომერი</label>
                                <div class="ls-inputicon-box">
                                    <input
                                        type="text"
                                        class="form-control"
                                        :class="{ 'is-invalid': searchError }"
                                        id=""
                                        v-model="search.number"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex justify-content-end">
                            <button
                                type="button"
                                class="btn btn-info"
                                @click.prevent="find()"
                            >
                                <i class="fa fa-search"></i> ძებნა
                            </button>
                        </div>
                    </div>
                    <!-- {{ candidate }} -->
                    <div class="mt-2" v-if="candidate.length > 0">
                        <div class="col-md-12 border mb-3"></div>
                        <h6>
                            <i class="fa fa-users"></i> მოიძებნა
                            {{ candidate.length }} კანდიდატი
                        </h6>
                        <hr />
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>სახელი გვარი</th>
                                        <th>ნომერი</th>
                                        <th>სურათი</th>
                                        <th>სტატუსი</th>
                                        <th>არჩევა</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(item, index) in candidate"
                                        :key="index"
                                    >
                                        <td>{{ item.id }}</td>
                                        <td>{{ item.user.name_ka }}</td>
                                        <td>{{ item.user.number }}</td>
                                        <td>
                                            <img
                                                :src="
                                                    '/images/user-avatar/' +
                                                    item.user.avatar
                                                "
                                                alt="#"
                                                style="height: 50px"
                                            />
                                        </td>
                                        <td><span :class="`badge bg-${item.status.color} p-1`">{{ item.status.name_ka}}</span></td>
                                        <td>
                                            <button
                                                v-if="m.candidate_id == item.id"
                                                type="button"
                                                class="btn btn-danger"
                                                @click.prevent="cancel()"
                                                title="გაუქმება"
                                            >
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <button
                                                v-else
                                                type="button"
                                                class="btn btn-warning"
                                                @click.prevent="chose(item.id)"
                                                title="არჩევა"
                                            >
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-success"
                        @click.prevent="save()"
                    >
                        <i class=""></i>შენახვა
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { ref, reactive, computed, watch, onMounted } from "vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import _ from "lodash";
import axios from "axios";

export default {
    props: {
        visible: Boolean,
        item: Object,
    },
    setup(props, { emit }) {
        const showConfirm = ref(false);
        const cla = ref({});
        const m = reactive({});
        const info = ref({});
        const search = reactive({
            id: null,
            name: null,
            number: null,
        });
        const selected = ref(null);
        const candidate = ref([]);
        const day = ref([
            { name: "ორშაბათი", name_en: "MONDAY", filter_name: "Monday" },
            { name: "სამშაბათი", name_en: "TUESDAY", filter_name: "Tuesday" },
            {
                name: "ოთხშაბთი",
                name_en: "WEDNESDAY",
                filter_name: "Wednesday",
            },
            { name: "ხუთშაბათი", name_en: "THURSDAY", filter_name: "Thursday" },
            { name: "პარასკევი", name_en: "FRIDAY", filter_name: "Friday" },
            { name: "შაბათი", name_en: "SATURDAY", filter_name: "Saturday" },
            { name: "კვირა", name_en: "SUNDAY", filter_name: "Sunday" },
        ]);
        const disabled = ref(false);
        const searchError = ref(false);

        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });

        const isWorkScheduleInPeriod = computed(() => {
            return _.includes([6, 7, 8, 9, 10], props.item.work_schedule_id);
        });

        const show = async () => {
            try {
                let result = await getClassificatory();
                console.log(result.data);

                info.value = result.data;
                employType();
                m.vacancy = {
                    id: props.item.id,
                    work_schedule_id: props.item.work_schedule_id,
                    start_date: props.item.start_date,
                    term: props.item.term,
                };
                console.log(props.item);
                if (props.item.work_schedule_id == 8) {
                    m.week_day = null;
                }
                showConfirm.value = true;
            } catch (error) {
                console.log(error);
            }
        };

        const hide = () => {
            showConfirm.value = false;
            emit("modalHide", m);
            search.id = null;
            search.name = null;
            search.number = null;
        };

        const getClassificatory = () => {
            return axios.post("/get_add_personal_was_employed_info", {
                data: props.item.id,
            });
        };

        const employType = () => {


            let period = [6, 7, 8, 9, 10];
            let work_schedule_id = props.item.work_schedule_id;
            let cla = info.value.employ_type;
            console.log('cla', cla);

            console.log('work_schedule_id', work_schedule_id);

            console.log('employType', _.includes(period, work_schedule_id));
            if (_.includes(period, work_schedule_id)) {
                m.employ_type = _.find(cla, function (o) {
                    return o.id == 8;
                });
            } else {
                disabled.value = true;
                m.employ_type = _.find(cla, function (o) {
                    return o.id == 7;
                });
            }
        };

        const save = () => {
            if (!_.has(m, "candidate_id") || !m.candidate_id) {
                toast.error("შესანახად აირჩიეთ კანდიდატი", {
                    theme: "colored",
                    autoClose: 1000,
                });
                return;
            }
            if (!m.employ_type) {
                toast.error("შესანახად აირჩიეთ დასაქმების ტიპი", {
                    theme: "colored",
                    autoClose: 1000,
                });
                return;
            }
            if (
                _.includes([6, 7, 8, 9, 10], props.item.work_schedule_id) &&
                !m.week_day
            ) {
                toast.error("შესანახად აირჩიეთ სამუშაო დღეები", {
                    theme: "colored",
                    autoClose: 1000,
                });
                return;
            }
            m.candidate_id =
                typeof m.candidate_id == "number"
                    ? m.candidate_id
                    : m.candidate_id.candidate.id;
            axios
                .post("/add_vacancy_personal_was_employed", {
                    data: m,
                })
                .then(function (response) {
                    if (response.status == 200) {
                        toast.success("წარმატებით დაემატა", {
                            theme: "colored",
                            autoClose: 1000,
                        });
                        emit("emitSave", true);
                        hide();
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        };

        const find = () => {
            if (!search.id && !search.name && !search.number) {
                toast.error("შეიყვანეთ რაიმე ინფორმაცია", {
                    theme: "colored",
                    autoClose: 1000,
                });
                searchError.value = true;
                return;
            }
            searchError.value = false;
            search.category = props.item.category;
            axios({
                method: "post",
                url: "/find_candidate",
                data: search,
            })
                .then(function (response) {
                    console.log(response.data);

                    if (
                        response.data.length == 0 &&
                        (search.id !== null || search.number !== null)
                    ) {
                        toast.info(
                            "არცერთი კანდიდატი არ მოიძებნა გადაამოწმეთ კანდიდატის სამუშაო კატეგორია ან მისი სტატუსი შესაძლოა იყოს უკვე დასაქმებული",
                            {
                                theme: "colored",
                                autoClose: 4500,
                            }
                        );
                    } else if (response.data.length == 0) {
                        toast.info("არცერთი კანდიდატი არ მოიძებნა", {
                            theme: "colored",
                            autoClose: 1500,
                        });
                    }
                    candidate.value = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        };

        const chose = (id) => {
            if (m.candidate_id && m.vacancy_id) {
                toast.error("თქვენ უკვე აირჩიეთ კანდიდატი", {
                    theme: "colored",
                    autoClose: 1000,
                });
                return;
            }
            m.candidate_id = id;
            m.vacancy_id = props.item.id;
        };

        const cancel = () => {
            m.candidate_id = null;
            m.vacancy_id = null;
        };

        watch(
            () => props.visible,
            (newVal) => {
                if (newVal) {
                    show();
                }
            }
        );

        watch(
            () => m.candidate_id,
            (newValue) => {
                if (typeof newValue == "object") {
                    axios({
                        method: "post",
                        url: "/get_work_day_info",
                        data: { candidate_id: newValue.candidate_id },
                    })
                        .then(function (response) {
                            if (response.data.length > 0) {
                                day.value = day.value.filter(
                                    (item) =>
                                        !response.data.includes(
                                            item.filter_name
                                        )
                                );
                                disabled.value = true;
                            }
                            toast.info(
                                "გადამოწმდა არჩეული კანდიდატის ინფორმაცია",
                                {
                                    theme: "colored",
                                    autoClose: 1000,
                                }
                            );
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            }
        );

        return {
            showConfirm,
            cla,
            m,
            info,
            search,
            selected,
            candidate,
            day,
            disabled,
            searchError,
            getLang,
            show,
            hide,
            getClassificatory,
            employType,
            save,
            find,
            chose,
            cancel,
            isWorkScheduleInPeriod
        };
    },
};
</script>
<style lang=""></style>
