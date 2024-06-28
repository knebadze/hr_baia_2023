<script setup>
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import vacancyFullInfoModal from "../modal/vacancyFullInfoModal.vue";
import moment from "moment";
import { ref, computed, watch, defineEmits } from "vue";
import { getClassificatory } from "../../../http/http";
import Swal from "sweetalert2";

const props = defineProps({
    visible: Boolean,
    item: Object,
    emitResponse: Function,
});
console.log("props.item", props.item);
// data
const showConfirm = ref(false);
const cla = ref({});
const m = ref(null);
const candidateInfo = ref({});
const busy = ref(null);
const modalShow = ref(false);
const vacancy_id = ref(null);
const qualifyingType = ref([]);
const startDateMin = ref(null);
const startDateMax = ref(null);
const endDateMax = ref(null);

const getLang = computed(() => {
    return I18n.getSharedInstance().options.lang;
});

// const emit = defineEmits(['emitResponse']);

const show = async () => {
    try {
        const response = await getClassificatory("/get_add_personal_info", {
            candidate_id: props.item.candidate_id,
            vacancy_id: props.item.vacancy_id,
        });
        const { data } = response;
        cla.value = data.cla;
        candidateInfo.value = data.candidateInfo;
        busy.value = data.busy;

        m.value = { ...props.item };
        m.value["type"] =
            candidateInfo.value && candidateInfo.value.this_vacancy
                ? candidateInfo.value.this_vacancy.qualifying_type
                : null;
        m.value.interview_place = !m.value.interview_place
            ? cla.value.interviewPlace.find(
                  (o) => o.id == m.value.interview_place_id
              )
            : m.value.interview_place;
        const currentDate = moment();
        startDateMin.value = currentDate.format("YYYY-MM-DD");
        const startDateMoment = moment(m.value.start_date);
        const endDateMoment = moment(m.value.start_date);
        console.log("startDateMoment", startDateMoment);
        startDateMax.value = startDateMoment
            .subtract(5, "days")
            .format("YYYY-MM-DD");
        endDateMax.value = endDateMoment
            .subtract(1, "days")
            .format("YYYY-MM-DD");
        qualifyingType.value = filterCla(currentDate);
        showConfirm.value = true;
    } catch (error) {
        console.error("Error fetching data:", error);
    }

    // m.value = { ...props.item }
};

const filterCla = (currentDate) => {
    let filterQualifyingType = null;
    let check =
        candidateInfo.value &&
        candidateInfo.value.hasOwnProperty("this_vacancy") &&
        candidateInfo.value.this_vacancy;

    if (check && candidateInfo.value.this_vacancy.qualifying_type_id == 4) {
        filterQualifyingType = cla.value.qualifyingType.filter(
            (item) =>
                item.id >=
                    candidateInfo.value.this_vacancy.qualifying_type_id &&
                item.id < 7
        );
    } else if (check) {
        filterQualifyingType = cla.value.qualifyingType.filter(
            (item) =>
                item.id >=
                    candidateInfo.value.this_vacancy.qualifying_type_id &&
                item.id != 5 &&
                item.id < 7
        );
    } else {
        filterQualifyingType = cla.value.qualifyingType.filter(
            (item) => item.id !== 5 && item.id !== 7 && item.id !== 8
        );
    }
    const maxDate = moment(startDateMax.value, "YYYY-MM-DD");
    // Compare startDateMax with startDateMoment
    if (maxDate.isBefore(currentDate)) {
        filterQualifyingType = filterQualifyingType.filter(
            (item) => item.id !== 6
        );
    }
    return filterQualifyingType;
};

const save = async () => {
    try {
        const response = await axios.post("/add_vacancy_personal", {
            data: rule(m.value),
        });

        if (response.status === 200) {
            toast.success("წარმატებით დაემატა", {
                theme: "colored",
                autoClose: 1000,
            });
            props.emitResponse({ id: props.item.candidate_id, bool: true });
            hide();
        }
    } catch (error) {
        console.error("Error:", error);
    }
};

const rule = (item) => {
    if (item.type.id == 6) {
        const start_date = moment(item.start_date).format("YYYY-MM-DD");
        const end_date = moment(item.end_date).format("YYYY-MM-DD");
        if (candidateInfo.value.another_vacancy) {
            candidateInfo.value.another_vacancy.forEach((element) => {
                if (element.qualifying_type_id == 6) {
                    let start = moment(element.start_date).format("YYYY-MM-DD");
                    let end = moment(element.end_date).format("YYYY-MM-DD");
                    if (
                        moment(start_date).isBetween(start, end) ||
                        moment(end_date).isBetween(start, end)
                    ) {
                        // Do something if start_date or end_date is between start and end
                        toast.error("არჩეულ დღეებში კანდიდატი დაკავებულია", {
                            theme: "colored",
                            autoClose: 1000,
                        });
                        return;
                    }
                }
                // else if (element.type.id == 3) {
                //     let interview_date = moment(item.interview_date).add(1, 'hours').format('YYYY-MM-DD HH');
                //     let min_interview_date = moment(element.interview_date).subtract(1, 'hours').format('YYYY-MM-DD HH');
                //     let max_interview_date = moment(element.interview_date).add(1, 'hours').format('YYYY-MM-DD HH');
                //     if (moment(interview_date).isBetween(min_interview_date, max_interview_date)) {

                //     }
                // }
            });
        }
    }
    return item;
};

const update = () => {
    axios
        .post("/update_vacancy_personal", {
            data: m.value,
        })
        .then(function (response) {
            // handle success
            if (response.status == 200) {
                toast.success("წარმატებით განახლდა", {
                    theme: "colored",
                    autoClose: 1000,
                });
                let url = new URL(location.href);
                const parts = url.pathname.split("/");
                const link = parts[parts.indexOf("admin") + 1];
                if (link == "selection_personal") {
                    props.emitResponse({
                        id: props.item.candidate_id,
                        bool: false,
                    });
                } else {
                    setTimeout(() => {
                        document.location.reload();
                    }, 1500);
                }
                hide();
            }
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        });
};

const deletePersonal = () => {
    Swal.fire({
        title: "ნამდვილად გსურთ ამ კანდიდატის ამოშლა ვაკანსიიდან?",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "კი",
        denyButtonText: `არა`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            axios
                .post("/delete_vacancy_personal", {
                    data: {
                        candidate_id: props.item.candidate_id,
                        vacancy_id: props.item.vacancy_id,
                    },
                })
                .then(function (response) {
                    // handle success
                    if (response.status == 200) {
                        toast.success("წარმატებით წაიშალა", {
                            theme: "colored",
                            autoClose: 1000,
                        });
                        let url = new URL(location.href);
                        const parts = url.pathname.split("/");
                        const link = parts[parts.indexOf("admin") + 1];
                        if (link == "selection_personal") {
                            props.emitResponse({
                                id: props.item.candidate_id,
                                bool: false,
                            });
                        } else {
                            setTimeout(() => {
                                document.location.reload();
                            }, 1500);
                        }
                        hide();
                        // setTimeout(() => {
                        //     document.location.reload();
                        // }, 2000);
                    }
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
        }
        // else if (result.isDenied) {
        //     Swal.fire('Changes are not saved', '', 'info')
        // }
    });
};
const openModal = (id) => {
    modalShow.value = modalShow.value;
    vacancy_id.value = id;
};

const hide = () => {
    showConfirm.value = false;
};

watch(
    () => props.visible,
    (newValue) => {
        show();
    }
);
</script>
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
            class="modal-dialog modal-dialog-centered modal-lg"
            role="document"
        >
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">
                        ვაკანსიისთვის (ID: {{ item.vacancy_code }}) კანდიდატის
                        შერჩევა
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
                    <div class="row mb-2 border-bottom">
                        <div class="col-12 col-md-6">
                            <span
                                >გასაუბრების თარიღი:
                                {{ item.interview_date }}</span
                            >
                        </div>
                        <div class="col-12 col-md-6">
                            <span>დაწყების თარიღი: {{ item.start_date }}</span>
                        </div>
                    </div>
                    <div
                        v-if="
                            candidateInfo &&
                            candidateInfo.hasOwnProperty('this_vacancy') &&
                            candidateInfo.this_vacancy
                        "
                        class="col-12"
                    >
                        <div class="alert alert-dismissible alert-info">
                            <h5>
                                <i class="icon fas fa-info"></i> შეტყობინება!
                            </h5>
                            <span
                                >ეს კანდიდატი უკვე გყავთ დამატებული ამ
                                ვაკანსიაზე
                                <strong>{{ ` "${m.type.name}" ` }}</strong>
                                ველში</span
                            >
                        </div>
                    </div>

                    <div
                        v-if="
                            candidateInfo &&
                            candidateInfo.hasOwnProperty('another_vacancy') &&
                            candidateInfo.another_vacancy.length > 0
                        "
                        class="col-12"
                    >
                        <div class="alert alert-dismissible alert-danger">
                            <h5>
                                <i class="icon fas fa-info"></i> შეტყობინება!
                            </h5>
                            <span
                                >ეს კანდიდატი უკვე გყავთ დამატებული
                                <u>სხვა</u> ვაკანსიაზე</span
                            >
                            <ul class="border py-2">
                                <li
                                    v-for="(
                                        item, index
                                    ) in candidateInfo.another_vacancy"
                                    :key="index"
                                >
                                    <u
                                        class="text-primary"
                                        @click="openModal(item.vacancy.id)"
                                        >{{ item.vacancy.code }}</u
                                    >
                                    -- {{ item.qualifying_type.name }}
                                </li>
                            </ul>
                            <span
                                >დარწმუნებული ხართ რომ მაინც გსურთ დაამატოთ ამ
                                ვაკანსიაზეც?</span
                            >
                        </div>
                    </div>
                    <div v-if="busy">
                        <p class="text-danger">
                            ეს კანდიდატი უკვე ყავს ქვემოთ ჩამოთვლილ HR_ს (ებს)
                            თავის აქტიურ ვაკანსიებში ჩასმული.
                        </p>
                        <h6>ინსტრუქცია</h6>
                        <p>
                            მიმართეთ hr უთხარით
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            კანდიდატის ID: {{ item.candidate_id }}
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            ვაკანსიის ID: {{ item.vacancy_code }}
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            სასურველი კატეგორია
                        </p>
                        <ul>
                            <li v-for="(item, index) in busy" :key="index">
                                {{ item.vacancy.hr.user.name_ka }} N:
                                {{ item.vacancy.hr.user.number }}
                            </li>
                        </ul>
                    </div>
                    <div v-else class="col-md-12">
                        <div class="form-group">
                            <label>შესარჩევი კატეგორია</label>
                            <div class="ls-inputicon-box">
                                <multiselect
                                    v-model="m.type"
                                    :options="qualifyingType"
                                    deselect-label="Can't remove this value"
                                    track-by="name"
                                    label="name"
                                    placeholder="აირჩიე ტიპი"
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
                    <div class="row" v-if="m.type && m.type.id == 4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>გასაუბრების ადგილი</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.interview_place"
                                        :options="cla.interviewPlace"
                                        deselect-label="Can't remove this value"
                                        track-by="name_ka"
                                        label="name_ka"
                                        placeholder="აირჩიე ტიპი"
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> გასაუბრების დრო </label>
                                <input
                                    class="form-control"
                                    v-model="m.interview_date"
                                    type="datetime-local"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row" v-if="m.type && m.type.id == 6">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> დაწყების თარიღი</label>
                                <input
                                    class="form-control"
                                    v-model="m.start_date"
                                    type="date"
                                    :min="startDateMin"
                                    :max="startDateMax"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> დასრულების თარიღი </label>
                                <input
                                    class="form-control"
                                    v-model="m.end_date"
                                    type="date"
                                    :min="startDateMin"
                                    :max="endDateMax"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        v-if="busy"
                        type="button"
                        class="btn btn-secondary"
                        @click.prevent="hide()"
                    >
                        <i class=""></i>გაუქმება
                    </button>
                    <div v-else>
                        <div
                            v-if="
                                candidateInfo &&
                                candidateInfo.hasOwnProperty('this_vacancy') &&
                                candidateInfo.this_vacancy
                            "
                        >
                            <button
                                type="button"
                                class="btn btn-danger mr-2"
                                @click.prevent="deletePersonal()"
                            >
                                <i class=""></i>წაშლა
                            </button>
                            <button
                                type="button"
                                class="btn btn-success"
                                @click.prevent="update()"
                            >
                                <i class=""></i>განახლება
                            </button>
                        </div>

                        <button
                            v-else
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
        <vacancyFullInfoModal
            :visible="modalShow"
            :vacancyId="vacancy_id"
        ></vacancyFullInfoModal>
    </div>
</template>

<style lang=""></style>
