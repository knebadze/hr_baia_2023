<template lang="">
    <!-- Modal -->
    <div
        v-if="showConfirm && cla"
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
                        სტატუსის შეცვლა
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
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <p
                            v-if="!vacancy.title_en"
                            class="text-center text-danger"
                        >
                            <strong>შეავსეთ ვაკანსიის სათაური!!! </strong>
                        </p>
                        <div class="form-group">
                            <label>{{ $t("სტატუსი") }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect
                                    v-model="m.status"
                                    :options="cla"
                                    deselect-label="Can't remove this value"
                                    :track-by="`name_${getLang}`"
                                    :label="`name_${getLang}`"
                                    :placeholder="
                                        $t('lang.employer_add_job_select')
                                    "
                                    :searchable="true"
                                    :allow-empty="false"
                                    :disabled="!vacancy.title_en"
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
                        class="col-xl-12 col-lg-12 col-md-12"
                        v-if="m.status.id == 5"
                    >
                        <div class="form-group">
                            <label>აირჩიე გაუქმების მიზეზი</label>
                            <div class="ls-inputicon-box">
                                <multiselect
                                    v-model="m.reason_for_cancel"
                                    :options="reasonForCancel"
                                    deselect-label="Can't remove this value"
                                    :track-by="`name_${getLang}`"
                                    :label="`name_${getLang}`"
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
                    <div class="col-md-12" v-if="m.status.id == 7">
                        <div class="form-group">
                            <label> სადამდე </label>
                            <input
                                class="form-control"
                                v-model="m.suspended_date"
                                type="date"
                                placeholder=""
                                :min="minData"
                                rows="3"
                            />
                        </div>
                    </div>
                    <div class="col-md-12" v-if="m.status.id == 7">
                        <div class="form-group">
                            <label> სტატუსის შეცვლის მიზეზი </label>
                            <textarea
                                class="form-control"
                                v-model="m.status_change_reason"
                                type="text"
                                placeholder=""
                                rows="3"
                            ></textarea>
                        </div>
                    </div>

                    <div v-if="m.status.id == 6">
                        <hr />
                        <h6><i class="fa fa-hourglass-start"></i> შეხსენება</h6>
                        <hr />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> შეხსენების დრო </label>
                                    <input
                                        class="form-control"
                                        v-model="reminder.date"
                                        type="datetime-local"
                                        placeholder=""
                                        rows="3"
                                        :min="minData"
                                        :max="maxDate"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="history.length > 0">
                        <hr />
                        <h6><i class="fa fa-list"></i> ისტორია</h6>
                        <hr />
                        <div class="row">
                            <div
                                v-for="(item, index) in history"
                                :key="index"
                                class="col-md-5 ml-1 border"
                            >
                                <p class="">
                                    <strong>შეცვლის თარიღი: </strong
                                    ><span>{{
                                        changeFormat(item.created_at)
                                    }}</span>
                                </p>
                                <p class="">
                                    <strong>ცვლილება: </strong
                                    ><span>{{ item.properties }}</span>
                                </p>
                                <p class="">
                                    <strong>შეცვალა: </strong
                                    ><span>{{ item.name_ka }}</span>
                                </p>
                            </div>
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
    <addPersonalWasEmployed
        :visible="showModal"
        :item="modalItem"
        @emitSave="handlerWasEmployed"
    />
</template>
<script setup>
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import moment from "moment";
import { ref, computed, watch } from "vue";
import addPersonalWasEmployed from "./addPersonalWasEmployed.vue";
import { useChangeVacancyStatusStore } from "../../../../store/admin/vacancy/changeStatusStore";
import { storeToRefs } from "pinia";

const props = defineProps({
    visible: {
        type: Boolean,
        default: false,
    },
});
const changeVacancyStatusStore = useChangeVacancyStatusStore();
const { vacancy, cla, history, minData, maxDate, reasonForCancel } =
    storeToRefs(changeVacancyStatusStore);
const { getInfo, changeStatus } = changeVacancyStatusStore;
const showConfirm = ref(false);
const reminder = ref({});
const showModal = ref(false);
const modalItem = ref(null);
const m = ref({});

const getLang = computed(() => {
    return I18n.getSharedInstance().options.lang;
});
const show = async () => {
    await getInfo();
    m.value = makeModel(vacancy.value);
    showConfirm.value = true;
};
const hide = () => {
    showConfirm.value = false;
};

const makeModel = (item) => {
    let newItem = {};
    newItem.id = item.id;
    newItem.status = item.status;
    newItem.status_change_reason = item.status_change_reason;
    newItem.reason_for_cancel = item.reason_for_cancel;
    return { ...newItem };
};

const changeFormat = (time) => {
    return moment(time).format("YYYY-MM-DD HH:mm");
};


watch(
    () => props.visible,
    (newValue, oldValue) => {
        // This function will be called whenever `props.visible` changes
        show();
    },
    { deep: true }
);


watch(
    () => m.value.status,
    (newValue, oldValue) => {
        if (newValue.id == 7) {
            const currentDate = moment();
            const dateInThreeWeeks = currentDate.add(3, "weeks");
            minData.value = dateInThreeWeeks.format("YYYY-MM-DD");
        }
        if (newValue.id == 3) {
            openModal();
        }
    }
);

const openModal = () => {
    showModal.value = !showModal.value;
    modalItem.value = vacancy.value;
};

const handlerWasEmployed = (item = false) => {
    if (item) {
        save();
    }
};

        const save = () =>{
            // return
            if (m.value.status.id == 6) {
                m.value['reminder'] = reminder.value
            }

            axios.post('/update_vacancy_status' ,{
                data: {'model':m.value},
            })
            .then(function (response) {
                // handle success
                if (response.status == 200 && response.data.data.type == 's') {

                    toast.success(response.data.data.message, {
                        theme: 'colored',
                        autoClose: 1000,
                    });

                    // setTimeout(() => {
                    //     document.location.reload();
                    // }, 2000);
                    changeStatus(m.value)
                    hide()
                }else if(response.status == 200 && response.data.data.type == 'e'){
                    toast.error(response.data.data.message, {
                        theme: 'colored',
                        autoClose: 1000,
                    });

                }else if(response.status == 200 && response.data.data.type == 'w'){
                    toast.error(response.data.data.message, {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    openModal()

                }

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        };
</script>
<style lang=""></style>
