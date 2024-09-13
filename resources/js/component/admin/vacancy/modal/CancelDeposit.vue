<script setup>
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import moment from "moment";
import { ref, computed, watch, defineEmits } from "vue";
import Swal from "sweetalert2";
import { useDepositStore } from "../../../../store/admin/vacancy/depositStore";

const props = defineProps({
    visible: Boolean,
    item: Object,
    cancelDepositClassificatory: Array,
    type: String,
});
const showConfirm = ref(false);
const m = ref({});
const reasonsCl = computed(() => props.cancelDepositClassificatory);

const depositStore = useDepositStore();
const { save } = depositStore;
console.log("reasonsCl", reasonsCl.value);

const show = async () => {
    try {
        // const response = await getClassificatory("/get_add_personal_info", {
        //     candidate_id: props.item.candidate_id,
        //     vacancy_id: props.item.vacancy_id,
        // });
        // const { data } = response;

        showConfirm.value = true;
    } catch (error) {
        console.error("Error fetching data:", error);
    }

    m.value = { ...props.item };
};

const hide = () => {
    showConfirm.value = false;
};

const checkAndSave = async (data) => {
    if (!data.cancel_reason_id) {
        toast.error("გთხოვთ აირჩიოთ გაუქმების მიზეზი");
        return;
    }

    if (data.cancel_reason_id.id == 1 && !data.cancel_reason) {
        toast.error("გთხოვთ ჩაწეროთ გაუქმების მიზეზი");
        return;
    }
    data.type = props.type;
    await save(data);
    hide();
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
        style="display: block"
    >
        <div
            class="modal-dialog modal-dialog-centered modal-lg"
            role="document"
        >
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">
                        ვაკანსიისთვის ჩარიცხვის გაუქმება
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
                    <!-- <div class="col-12">
                        <div class="alert alert-dismissible alert-info">
                            <h5>
                                <i class="icon fas fa-info"></i> შეტყობინება!
                            </h5>
                            <span
                                >ეს კანდიდატი უკვე გყავთ დამატებული ამ
                                ვაკანსიაზე
                                <strong></strong>
                                ველში</span
                            >
                        </div>
                    </div> -->

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>გაუქმების მიზეზი</label>
                            <div class="ls-inputicon-box">
                                <multiselect
                                    v-model="m.cancel_reason_id"
                                    :options="reasonsCl"
                                    deselect-label="Can't remove this value"
                                    track-by="name"
                                    label="name"
                                    placeholder="აირჩიე ტიპი"
                                    :searchable="true"
                                    :allow-empty="false"
                                >
                                </multiselect>
                            </div>
                        </div>
                        <div class="form-group" v-if="m.cancel_reason_id && m.cancel_reason_id.id == 1">
                            <!-- <label>გაუქმების მიზეზი</label> -->
                            <div class="ls-inputicon-box">
                                <textarea
                                    class="form-control"
                                    v-model="m.cancel_reason"
                                    type="text"
                                    placeholder="ჩაწერეთ მიზეზი"
                                    rows="3"
                                ></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        @click.prevent="hide()"
                    >
                        <i class=""></i>გაუქმება
                    </button>
                    <button
                        type="button"
                        class="btn btn-success"
                        @click.prevent="checkAndSave(m)"
                    >
                        <i class=""></i>შენახვა
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
