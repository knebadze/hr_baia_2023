<template lang="">
    <div>
        <div class="dropdown">
            <button
                class="btn btn-primary dropdown-toggle"
                type="button"
                id="dropdownMenuButton"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
            >
                <i class="fa fa-cog"></i>
            </button>
            <div
                class="dropdown-menu dropdown-menu-right"
                aria-labelledby="dropdownMenuButton"
            >
                <a
                    v-if="
                        item.status.id != 3 &&
                        item.status.id != 4 &&
                        item.status.id != 5 &&
                        item.status.id != 13 &&
                        (fullPermission ||
                            adminId == item.hr.parent_id ||
                            roleId == 2)
                    "
                    class="dropdown-item"
                    href="#"
                    @click="openModal(item, 1)"
                    >რედაქტირება</a
                >
                <a
                    v-if="
                        item.status.id != 3 &&
                        item.status.id != 4 &&
                        item.status.id != 5 &&
                        item.status.id != 13 &&
                        roleId != 4 &&
                        (fullPermission ||
                            adminId == item.hr.parent_id ||
                            roleId == 2)
                    "
                    class="dropdown-item"
                    href="#"
                    @click="openModal(item, 2)"
                    >სტატუსის შეცვლა</a
                >
                <a
                    v-if="
                        item.status.id == 2 &&
                        roleId != 4 &&
                        (fullPermission ||
                            adminId == item.hr.parent_id ||
                            roleId == 2)
                    "
                    class="dropdown-item"
                    :href="state.personalSelectionUrl + '/' + item.id"
                    >კადრების შერჩევა</a
                >
                <a
                    v-if="item.status.id > 1"
                    class="dropdown-item"
                    :href="state.vacancyPersonalUrl + '/' + item.id"
                    >შერჩეული კადრები</a
                >
                <a
                    v-if="
                        item.status.id != 4 &&
                        item.status.id != 5 &&
                        item.status.id != 13 &&
                        roleId != 4 &&
                        (fullPermission ||
                            adminId == item.hr.parent_id ||
                            roleId == 2)
                    "
                    class="dropdown-item"
                    href="#"
                    @click="openModal(item, 3)"
                    >შეხსენება</a
                >
                <!-- <a v-else-if="item.status.id != 4 && item.status.id != 5  && item.status.id != 13" class="dropdown-item" href="#" @click="openModal(item, 3)">შეხსენება</a> -->
                <a
                    v-if="
                        item.status.id != 4 &&
                        item.status.id != 5 &&
                        item.status.id != 13 &&
                        roleId != 4
                    "
                    class="dropdown-item"
                    :href="state.vacancyDepositUrl + '/' + item.id"
                    >დეპოზიტი</a
                >
                <!-- <a v-else-if="item.status.id != 4 && item.status.id != 5 && item.status.id != 13" class="dropdown-item" :href="vacancyDepositUrl+'/'+item.id" >დეპოზიტი</a> -->
                <a
                    v-if="
                        (item.status.id == 13 || item.status.id == 5) &&
                        (fullPermission ||
                            adminId == item.hr.parent_id ||
                            roleId == 2)
                    "
                    class="dropdown-item"
                    href="#"
                    @click="openModal(item, 4)"
                    >გამეორება</a
                >
                <a
                    v-if="
                        item.status.id !== 3 &&
                        item.status.id !== 4 &&
                        item.status.id !== 5 &&
                        item.status.id !== 13 &&
                        roleId != 4 &&
                        (fullPermission ||
                            adminId == item.hr.parent_id ||
                            roleId == 2)
                    "
                    class="dropdown-item"
                    href="#"
                    @click="carryInHead(item)"
                    >აპინვა
                </a>
                <a class="dropdown-item" href="#" @click="openModal(item, 5)"
                    >ისტორია</a
                >

                <a
                    v-if="
                        roleId == 1 &&
                        (item.status.id == 1 ||
                            item.status.id == 2 ||
                            item.status.id == 6) &&
                        (fullPermission ||
                            adminId == item.hr.parent_id ||
                            roleId == 2)
                    "
                    class="dropdown-item"
                    href="#"
                    @click="openModal(item, 6)"
                >
                    გადაწერა</a
                >
                <a
                    v-if="
                        roleId == 1 &&
                        (fullPermission ||
                            adminId == item.hr.parent_id ||
                            roleId == 2)
                    "
                    class="dropdown-item bg-danger"
                    href="#"
                    @click="vacancyDelete(item.id)"
                    >წაშლა</a
                >
            </div>
        </div>
        <vacancyUpdate
            :visible="state.showUpdateModal"
            :item="state.modalData"
            @closeModal="handelModalClose"
        />

        <changeStatus :visible="state.showStatusModal" />

        <vacancyReminder
            :visible="state.showReminderModal"
            :item="state.modalData"
            :roleId="roleId"
        />

        <redactedHistory
            :visible="state.showHistoryModal"
            :vacancyId="state.vacancyId"
            :roleId="roleId"
        />

        <change_hr :visible="state.hrModelShow" :item="state.modalData" />
    </div>
</template>
<script setup>
import { ref, reactive } from "vue";
import Swal from "sweetalert2";
import axios from "axios";
import vacancyUpdate from "../../modal/vacancyUpdate.vue";
import changeStatus from "../../modal/changeStatus.vue";
import vacancyReminder from "../../modal/vacancyReminder.vue";
import redactedHistory from "../../modal/redactedHistory.vue";
import change_hr from "../../modal/change_hr.vue";
import { useChangeVacancyStatusStore } from "../../../../../store/admin/vacancy/changeStatusStore";

const props = defineProps({
    item: Object,
    roleId: Number,
    adminId: Number,
    fullPermission: Boolean,
});
// const toast = useToast();
const changeVacancyStatusStore = useChangeVacancyStatusStore();

const state = reactive({
    modalComponent: null,
    showUpdateModal: false,
    showStatusModal: false,
    showReminderModal: false,
    showRepeatModal: false,
    showHistoryModal: false,
    hrModelShow: false,
    modalData: null,
    vacancyId: null,
    personalSelectionUrl:
        new URL(location.href).origin + "/admin/selection_personal",
    vacancyPersonalUrl:
        new URL(location.href).origin + "/admin/vacancy_personal",
    vacancyDepositUrl: new URL(location.href).origin + "/admin/vacancy_deposit",
});

const openModal = (item, index) => {
    changeVacancyStatusStore.setVacancy(item);
    state.modalData = item;
    switch (index) {
        case 1:
            state.showUpdateModal = !state.showUpdateModal;
            break;
        case 2:
            state.showStatusModal = !state.showStatusModal;
            break;
        case 3:
            state.showReminderModal = !state.showReminderModal;
            break;
        case 4:
            window.location.replace(
                `${location.origin}/ka/post_job/${item.id}/${item.code}`
            );
            break;
        case 5:
            state.showHistoryModal = !state.showHistoryModal;
            state.vacancyId = item.id;
            break;
        case 6:
            state.hrModelShow = !state.hrModelShow;
            break;
    }
};

const carryInHead = async (item) => {
    const result = await Swal.fire({
        title: "ნამდვილად გსურთ ვაკანსიის თავში ატანა?",
        cancelButtonText: "არა",
        confirmButtonText: "კი",
        showCancelButton: true,
    });

    if (result.isConfirmed) {
        try {
            const response = await axios.post("/carry_in_head_vacancy", {
                data: {
                    id: item.id,
                    edit: { carry_in_head_date: item.carry_in_head_date },
                },
            });
            if (response.status === 200) {
                toast.success("წარმატებით შესრულდა", {
                    theme: "colored",
                    autoClose: 1000,
                });
                setTimeout(() => location.reload(), 2000);
            }
        } catch (error) {
            console.error(error);
        }
    }
};

const vacancyDelete = (id) => {
    Swal.fire({
        title: "ნამდვილად გსურთ ვაკანსიის წაშლა?",

        showCancelButton: true,
        cancelButtonText: "არა",
        confirmButtonText: "კი",
        showLoaderOnConfirm: true,
        preConfirm: async () => {
            try {
                const response = await axios({
                    method: "post",
                    url: "/delete_vacancy",
                    data: { id: id, check: true },
                });
                if (!response.status == 200) {
                    return Swal.showValidationMessage(`
                ${JSON.stringify(await response.error)}
                `);
                }
                return response;
            } catch (error) {
                Swal.showValidationMessage(`
                Request failed: ${error}
            `);
            }
        },
        allowOutsideClick: () => !Swal.isLoading(),
    }).then((result) => {
        if (result.isConfirmed) {
            if (result.value.data.data) {
                Swal.fire({
                    title: "ამ ვაკანსიას აქვას გამეორების ისტორია. წასაშლელად აუცილებელია ისტრორიის წაშლა, გსურთ ეს?",
                    //   showDenyButton: true,
                    cancelButtonText: "არა",
                    confirmButtonText: "კი",
                    showCancelButton: true,
                }).then((result) => {
                    sendDeleteAxios(id);
                });
            } else {
                sendDeleteAxios(id);
            }
        }
    });
    return;
};

const sendDeleteAxios = (id) => {
    axios({
        method: "post",
        url: "/delete_vacancy",
        data: { id: id, check: false },
    })
        .then(function (response) {
            // items.value = response.data
            if (response.status == 200) {
                toast.success("წარმატებით წაიშალა", {
                    theme: "colored",
                    autoClose: 1000,
                });
                setTimeout(() => {
                    document.location.reload();
                }, 1500);
            }
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        });
};
const handelModalClose =  () => {
    state.showUpdateModal = false;
}
</script>
<style lang=""></style>
